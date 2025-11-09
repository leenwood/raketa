<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Application\UseCase\AddToCart;

use Raketa\BackendTestTask\Application\DTO\CartDTO;
use Raketa\BackendTestTask\Application\UseCase\AddToCart\AddToCartInterface;
use Raketa\BackendTestTask\Application\UseCase\GetCart\GetCartInterface;
use Ramsey\Uuid\Uuid;
use Raketa\BackendTestTask\Domain\Entity\Cart;
use Raketa\BackendTestTask\Domain\Entity\CartItem;
use Raketa\BackendTestTask\Domain\Repository\CartRepositoryInterface;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;

class AddToCartUseCase implements AddToCartInterface
{
    public function __construct(
        private CartRepositoryInterface $cartRepository,
        private ProductRepositoryInterface $productRepository,
        private GetCartInterface $getCart
    ) {
    }

    /**
     * @param string $cartId
     * @param string $productUuid
     * @param int $quantity
     * @return Cart
     */
    public function execute(string $cartId, string $productUuid, int $quantity): ?CartDTO
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

        return $this->getCart->execute($cart->getUuid());
    }
}
