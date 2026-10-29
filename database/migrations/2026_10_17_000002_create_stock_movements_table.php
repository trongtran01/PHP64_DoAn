<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bước 1b: lịch sử biến động tồn kho.
     * Mọi thay đổi products.stock phải đi qua StockService và ghi 1 dòng ở đây.
     * Sản phẩm con (configurable) cũng là 1 dòng products nên không cần variant_id.
     */
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            // Khớp kiểu products.id (INT signed). Chưa đặt FOREIGN KEY để tránh lỗi lệch kiểu/engine.
            $table->integer('product_id');
            $table->integer('quantity_change');          // +5, -2
            $table->unsignedInteger('stock_after');      // tồn sau khi thay đổi
            $table->string('reason', 30);                // initial | order_placed | order_cancelled | admin_adjust
            $table->string('reference_type', 30)->nullable(); // vd: order
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->string('note', 500)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('product_id');
            $table->index(['reference_type', 'reference_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
