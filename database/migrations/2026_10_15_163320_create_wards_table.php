<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->unsignedInteger('code')->primary();
            $table->unsignedInteger('province_code');
            $table->string('name');
            $table->string('division_type', 50);
            $table->string('codename');

            $table->foreign('province_code')
                ->references('code')
                ->on('provinces')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};
