<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Presentation\Http\Transformer;

use Raketa\BackendTestTask\Application\DTO\CartDTO;

class CartTransformer
{
    public function toArray(CartDTO $cart): array
    {
        $total = 0.0;
        $items = [];

        foreach ($cart->getItems() as $item) {

            $total += $item->getPrice() * $item->getQuantity();

            $items[] = [
                'id' => $item->getId(),
                'product_uuid' => $item->getProductId(),
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice(),
                'product' => $item->getProduct() ? [
                    'uuid' => $item->getProduct()?->getUuid(),
                    'name' => $item->getProduct()?->getName(),
                    'thumbnail' => $item->getProduct()?->getThumbnail(),
                    'price' => $item->getProduct()?->getPrice(),
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