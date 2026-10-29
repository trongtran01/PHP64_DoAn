<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bước 1b: chuẩn bị cho trừ kho / hoàn kho và snapshot đơn hàng.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Có giá trị = đã hoàn kho cho đơn này -> chống hoàn 2 lần
            $table->timestamp('stock_restored_at')->nullable()->after('stripe_session_id');
            $table->timestamp('cancelled_at')->nullable()->after('stock_restored_at');
        });

        Schema::table('orderdetails', function (Blueprint $table) {
            // Snapshot tại thời điểm mua: sửa/xóa sản phẩm sau này không làm hỏng đơn cũ
            $table->string('product_name', 500)->nullable()->after('product_id');
            $table->string('sku', 64)->nullable()->after('product_name');
            $table->text('options')->nullable()->after('sku'); // JSON option đã chọn (dùng cho configurable)
        });
    }

    public function down(): void
    {
        Schema::table('orderdetails', function (Blueprint $table) {
            $table->dropColumn(['product_name', 'sku', 'options']);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['stock_restored_at', 'cancelled_at']);
        });
    }
};
