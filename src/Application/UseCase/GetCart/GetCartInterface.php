<?php

namespace Raketa\BackendTestTask\Application\UseCase\GetCart;

use Raketa\BackendTestTask\Application\DTO\CartDTO;

interface GetCartInterface
{
    public function execute(string $cartId): ?CartDTO;
}