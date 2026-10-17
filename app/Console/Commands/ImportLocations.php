<?php

namespace App\Console\Commands;

use App\Models\Province;
use App\Models\Ward;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ImportLocations extends Command
{
    protected $signature = 'locations:import';

    protected $description = 'Import tỉnh/thành phố và phường/xã từ provinces.open-api.vn (API v2)';

    private const API_URL = 'https://provinces.open-api.vn/api/v2';

    public function handle(): int
    {
        $provinces = $this->fetch('/');

        $provinceRows = [];
        $wardRows = [];

        $this->withProgressBar($provinces, function (array $province) use (&$provinceRows, &$wardRows) {
            $detail = $this->fetch('/p/' . $province['code'], ['depth' => 2]);

            $provinceRows[] = [
                'code' => $detail['code'],
                'name' => $detail['name'],
                'division_type' => $detail['division_type'],
                'codename' => $detail['codename'],
            ];

            foreach ($detail['wards'] as $ward) {
                $wardRows[] = [
                    'code' => $ward['code'],
                    'province_code' => $detail['code'],
                    'name' => $ward['name'],
                    'division_type' => $ward['division_type'],
                    'codename' => $ward['codename'],
                ];
            }
        });

        DB::transaction(function () use ($provinceRows, $wardRows) {
            Province::upsert($provinceRows, ['code'], ['name', 'division_type', 'codename']);

            foreach (array_chunk($wardRows, 500) as $chunk) {
                Ward::upsert($chunk, ['code'], ['province_code', 'name', 'division_type', 'codename']);
            }
        });

        foreach ($provinceRows as $row) {
            Cache::forget("locations.provinces.{$row['code']}.wards");
        }

        $this->newLine(2);
        $this->info(sprintf(
            'Đã import %d tỉnh/thành phố và %d phường/xã.',
            count($provinceRows),
            count($wardRows)
        ));

        return self::SUCCESS;
    }

    private function fetch(string $path, array $query = []): array
    {
        return Http::baseUrl(self::API_URL)
            ->acceptJson()
            ->timeout(30)
            ->retry(3, 500)
            ->get($path, $query)
            ->throw()
            ->json();
    }
}