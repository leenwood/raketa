<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Presentation\Http\Transformer;

use Raketa\BackendTestTask\Domain\Entity\Cart;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;

class CartTransformer
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    public function toArray(Cart $cart): array
    {
        $total = 0.0;
        $items = [];

        foreach ($cart->getItems() as $item) {
            $product = $this->productRepository->getByUuid($item->getProductId());

            $total += $item->getPrice() * $item->getQuantity();

            $items[] = [
                'id' => $item->getId(),
                'product_uuid' => $item->getProductId(),
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice(),
                'product' => $product ? [
                    'uuid' => $item->getProductId(),
                    'name' => $product->getName(),
                    'thumbnail' => $product->getThumbnail(),
                    'price' => $product->getPrice(),
                ] : null,
            ];
        }

        return [
            'id' => $cart->getUuid(),
            'items' => $items,
            'total' => $total,
        ];
    }
}