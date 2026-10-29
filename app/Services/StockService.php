<?php

namespace App\Services;

use App\Exceptions\InsufficientStockException;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

/**
 * Cổng DUY NHẤT được thay đổi products.stock.
 * Mỗi lần đổi: khóa dòng sản phẩm, cập nhật stock, ghi 1 dòng stock_movements,
 * tất cả trong cùng transaction.
 */
class StockService
{
    public const REASON_INITIAL         = 'initial';
    public const REASON_ORDER_PLACED    = 'order_placed';
    public const REASON_ORDER_CANCELLED = 'order_cancelled';
    public const REASON_ADMIN_ADJUST    = 'admin_adjust';

    /**
     * Trừ kho. Ném InsufficientStockException nếu không đủ hàng.
     * Trả về tồn kho sau khi trừ.
     */
    public function decrease(
        int $productId,
        int $qty,
        string $reason = self::REASON_ORDER_PLACED,
        ?string $referenceType = null,
        ?int $referenceId = null,
        ?string $note = null,
        ?int $userId = null
    ): int {
        $this->assertPositive($qty);

        return $this->change($productId, -$qty, $reason, $referenceType, $referenceId, $note, $userId);
    }

    /**
     * Cộng kho (hoàn đơn, nhập hàng...). Trả về tồn kho sau khi cộng.
     */
    public function increase(
        int $productId,
        int $qty,
        string $reason = self::REASON_ORDER_CANCELLED,
        ?string $referenceType = null,
        ?int $referenceId = null,
        ?string $note = null,
        ?int $userId = null
    ): int {
        $this->assertPositive($qty);

        return $this->change($productId, $qty, $reason, $referenceType, $referenceId, $note, $userId);
    }

    /**
     * Admin chỉnh tay: $delta dương = cộng, âm = trừ. Bắt buộc có ghi chú.
     */
    public function adjust(int $productId, int $delta, string $note, ?int $userId = null): int
    {
        if ($delta === 0) {
            throw new InvalidArgumentException('Số lượng điều chỉnh phải khác 0.');
        }
        if (trim($note) === '') {
            throw new InvalidArgumentException('Điều chỉnh kho bắt buộc phải có lý do.');
        }

        return $this->change($productId, $delta, self::REASON_ADMIN_ADJUST, null, null, $note, $userId);
    }

    /**
     * Admin đặt thẳng số tồn mới (so với tồn hiện tại sẽ ra delta).
     */
    public function setStock(int $productId, int $newStock, string $note, ?int $userId = null): int
    {
        if ($newStock < 0) {
            throw new InvalidArgumentException('Tồn kho không được âm.');
        }

        return DB::transaction(function () use ($productId, $newStock, $note, $userId) {
            $current = (int) $this->lockProduct($productId)->stock;
            $delta = $newStock - $current;

            if ($delta === 0) {
                return $current;
            }

            return $this->adjust($productId, $delta, $note, $userId);
        });
    }

    /** Chỉ đọc: còn đủ hàng không (dùng cho giỏ hàng, không khóa dòng). */
    public function isInStock(int $productId, int $qty = 1): bool
    {
        $p = DB::table('products')
            ->select('stock', 'is_active', 'product_type', 'parent_id')
            ->where('id', $productId)
            ->first();

        if (!$p || !$p->is_active || $this->isConfigurableParent($p)) {
            return false;
        }

        return (int) $p->stock >= $qty;
    }

    /* ------------------------------------------------------------------ */

    private function change(
        int $productId,
        int $delta,
        string $reason,
        ?string $referenceType,
        ?int $referenceId,
        ?string $note,
        ?int $userId
    ): int {
        return DB::transaction(function () use ($productId, $delta, $reason, $referenceType, $referenceId, $note, $userId) {
            $product = $this->lockProduct($productId);

            if ($this->isConfigurableParent($product)) {
                throw new InvalidArgumentException(
                    "Sản phẩm #{$productId} là configurable (vỏ), không có tồn kho. Hãy thao tác trên sản phẩm con."
                );
            }

            $current = (int) $product->stock;
            $after = $current + $delta;

            if ($after < 0) {
                throw new InsufficientStockException($productId, abs($delta), $current);
            }

            DB::table('products')->where('id', $productId)->update(['stock' => $after]);

            DB::table('stock_movements')->insert([
                'product_id'      => $productId,
                'quantity_change' => $delta,
                'stock_after'     => $after,
                'reason'          => $reason,
                'reference_type'  => $referenceType,
                'reference_id'    => $referenceId,
                'note'            => $note,
                'created_by'      => $userId,
                'created_at'      => now(),
            ]);

            return $after;
        });
    }

    /** SELECT ... FOR UPDATE. Phải gọi trong transaction. */
    private function lockProduct(int $productId): object
    {
        $product = DB::table('products')->where('id', $productId)->lockForUpdate()->first();

        if (!$product) {
            throw new InvalidArgumentException("Không tìm thấy sản phẩm #{$productId}.");
        }

        return $product;
    }

    private function isConfigurableParent(object $p): bool
    {
        return $p->product_type === 'configurable' && $p->parent_id === null;
    }

    private function assertPositive(int $qty): void
    {
        if ($qty <= 0) {
            throw new InvalidArgumentException('Số lượng phải lớn hơn 0.');
        }
    }
}