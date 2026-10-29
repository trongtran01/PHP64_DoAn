<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bước 1a: thêm sku, stock, is_active cho products; đổi kiểu cột giá; thêm index.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // SKU: nullable + unique (MySQL cho phép nhiều NULL nên dữ liệu cũ không vướng)
            $table->string('sku', 64)->nullable()->unique()->after('name');

            // Tồn kho: simple dùng trực tiếp; sản phẩm con (configurable) dùng sau này
            $table->unsignedInteger('stock')->default(0)->after('discount');

            // Bật/tắt sản phẩm (kiểu Magento enable/disable), tách biệt với hết hàng
            $table->boolean('is_active')->default(true)->after('stock');

            $table->index('category_id');
            $table->index('parent_id');
        });

        // VND không có số lẻ, float sai số khi giá lớn -> dùng BIGINT UNSIGNED.
        // Dùng SQL thuần nên không cần cài doctrine/dbal. (MySQL/MariaDB)
        DB::statement('ALTER TABLE products MODIFY price BIGINT UNSIGNED NOT NULL DEFAULT 0');
        DB::statement('ALTER TABLE products MODIFY discount INT NOT NULL DEFAULT 0');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE products MODIFY price FLOAT NOT NULL');
        DB::statement('ALTER TABLE products MODIFY discount INT NOT NULL');

        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique(['sku']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['parent_id']);
            $table->dropColumn(['sku', 'stock', 'is_active']);
        });
    }
};
