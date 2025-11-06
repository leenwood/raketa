<?php

namespace Raketa\BackendTestTask\Application\UseCase\GetProducts;

use Raketa\BackendTestTask\Domain\Entity\Product;

interface GetProductsInterface
{
    /**
     * @return Product[]
     */
    public function execute(string $category): array;
}