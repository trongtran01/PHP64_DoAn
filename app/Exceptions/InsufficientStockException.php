<?php

namespace App\Exceptions;

use RuntimeException;

class InsufficientStockException extends RuntimeException
{
    public function __construct(
        public readonly int $productId,
        public readonly int $requested,
        public readonly int $available,
        ?string $message = null
    ) {
        parent::__construct(
            $message ?? "Sản phẩm #{$productId} không đủ tồn kho (cần {$requested}, còn {$available})."
        );
    }
}