<?php

namespace Raketa\BackendTestTask\Application\UseCase\AddToCart;

use Raketa\BackendTestTask\Application\DTO\CartDTO;

interface AddToCartInterface
{
    /**
     * @param string $cartId
     * @param string $productUuid
     * @param int $quantity
     * @return null|CartDTO
     */
    public function execute(string $cartId, string $productUuid, int $quantity): ?CartDTO;
}