<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Domain\Repository;

use Raketa\BackendTestTask\Domain\Entity\Cart;

interface CartRepositoryInterface
{
    public function get(string $cartId): ?Cart;

    public function save(Cart $cart): void;
}