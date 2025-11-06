<?php

namespace Raketa\BackendTestTask\Application\UseCase\GetCart;

use Raketa\BackendTestTask\Domain\Entity\Cart;

interface GetCartInterface
{
    public function execute(string $cartId): ?Cart;
}