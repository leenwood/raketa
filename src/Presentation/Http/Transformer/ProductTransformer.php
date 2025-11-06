<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Presentation\Http\Transformer;

use Raketa\BackendTestTask\Domain\Entity\Product;

class ProductTransformer
{
    public function toArray(Product $product): array
    {
        return [
            'id' => $product->getId(),
            'uuid' => $product->getUuid(),
            'category' => $product->getCategory(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'thumbnail' => $product->getThumbnail(),
            'price' => $product->getPrice(),
        ];
    }
}