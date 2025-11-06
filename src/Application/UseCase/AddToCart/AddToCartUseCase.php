<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Application\UseCase\AddToCart;

use Raketa\BackendTestTask\Application\UseCase\AddToCart\AddToCartInterface;
use Ramsey\Uuid\Uuid;
use Raketa\BackendTestTask\Domain\Entity\Cart;
use Raketa\BackendTestTask\Domain\Entity\CartItem;
use Raketa\BackendTestTask\Domain\Repository\CartRepositoryInterface;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;

class AddToCartUseCase implements AddToCartInterface
{
    public function __construct(
        private CartRepositoryInterface $cartRepository,
        private ProductRepositoryInterface $productRepository
    ) {
    }

    /**
     * @param string $cartId
     * @param string $productUuid
     * @param int $quantity
     * @return Cart
     */
    public function execute(string $cartId, string $productUuid, int $quantity): Cart
    {
        $cart = $this->cartRepository->get($cartId) ?? new Cart($cartId);

        $product = $this->productRepository->getByUuid($productUuid);
        if ($product === null) {
            throw new \RuntimeException('Product not found');
        }

        $item = new CartItem(
            Uuid::uuid4()->toString(),
            $product->getUuid(),
            $product->getPrice(),
            $quantity
        );

        $cart->addItem($item);

        $this->cartRepository->save($cart);

        return $cart;
    }
}
