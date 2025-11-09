<?php

namespace Raketa\BackendTestTask\Application\UseCase\GetProduct;

use Raketa\BackendTestTask\Domain\Entity\Product;

interface GetProductInterface
{
    public function execute(string $productID): ?Product;
}