<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->unsignedInteger('code')->primary();
            $table->string('name');
            $table->string('division_type', 50);
            $table->string('codename')->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
