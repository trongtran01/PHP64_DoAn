<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class LocationController extends Controller
{
    public function wards(Province $province): JsonResponse
    {
        $wards = Cache::rememberForever(
            "locations.provinces.{$province->code}.wards",
            fn () => $province->wards()->orderBy('name')->get(['code', 'name'])
        );

        return response()->json($wards);
    }
}