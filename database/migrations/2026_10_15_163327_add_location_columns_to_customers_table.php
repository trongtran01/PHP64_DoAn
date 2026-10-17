<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedInteger('province_code')->nullable()->after('phone');
            $table->unsignedInteger('ward_code')->nullable()->after('province_code');

            $table->foreign('province_code')
                ->references('code')
                ->on('provinces')
                ->nullOnDelete();

            $table->foreign('ward_code')
                ->references('code')
                ->on('wards')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['province_code']);
            $table->dropForeign(['ward_code']);
            $table->dropColumn(['province_code', 'ward_code']);
        });
    }
};
