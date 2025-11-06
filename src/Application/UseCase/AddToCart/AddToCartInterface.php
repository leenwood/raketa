<?php

namespace Raketa\BackendTestTask\Application\UseCase\AddToCart;

use Raketa\BackendTestTask\Domain\Entity\Cart;

interface AddToCartInterface
{
    /**
     * @param string $cartId
     * @param string $productUuid
     * @param int $quantity
     * @return Cart
     */
    public function execute(string $cartId, string $productUuid, int $quantity): Cart;
}