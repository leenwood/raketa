<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Application\UseCase\GetCart;

use Raketa\BackendTestTask\Application\UseCase\GetCart\GetCartInterface;
use Raketa\BackendTestTask\Domain\Entity\Cart;
use Raketa\BackendTestTask\Domain\Repository\CartRepositoryInterface;

class GetCartUseCase implements GetCartInterface
{
    public function __construct(
        private CartRepositoryInterface $cartRepository
    ) {
    }

    public function execute(string $cartId): ?Cart
    {
        return $this->cartRepository->get($cartId);
    }
}