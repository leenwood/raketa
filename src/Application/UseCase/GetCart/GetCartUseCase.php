<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Application\UseCase\GetCart;

use Raketa\BackendTestTask\Application\DTO\CartDTO;
use Raketa\BackendTestTask\Application\DTO\CartItemDTO;
use Raketa\BackendTestTask\Application\DTO\ProductDTO;
use Raketa\BackendTestTask\Application\UseCase\GetProduct\GetProductInterface;
use Raketa\BackendTestTask\Domain\Repository\CartRepositoryInterface;

class GetCartUseCase implements GetCartInterface
{
    public function __construct(
        private CartRepositoryInterface $cartRepository,
        private GetProductInterface $productUseCase
    ) {
    }

    public function execute(string $cartId): ?CartDTO
    {
        $cart = $this->cartRepository->get($cartId);
        /** @var CartItemDTO[] $items */
        $items = [];

        foreach ($cart->getItems() as $item) {
            $product = $this->productUseCase->execute($item->getProductId());
            /**
             * @param int $id
             * @param string $uuid
             * @param bool $isActive
             * @param string $category
             * @param string $name
             * @param string $description
             * @param string $thumbnail
             * @param float $price
             */
            $items[] = new CartItemDTO(
                $item->getId(),
                $item->getProductId(),
                $item->getPrice(),
                $item->getQuantity(),
                new ProductDTO(
                    $product->getId(),
                    $product->getUuid(),
                    $product->isActive(),
                    $product->getCategory(),
                    $product->getName(),
                    $product->getDescription(),
                    $product->getThumbnail(),
                    $product->getPrice()
                ),
            );
        }

        $cartDTO = new CartDTO($cart->getUuid(), $items);
        return $cartDTO;
    }
}