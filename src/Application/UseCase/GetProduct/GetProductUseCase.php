<?php

namespace Raketa\BackendTestTask\Application\UseCase\GetProduct;

use Raketa\BackendTestTask\Domain\Entity\Product;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;

class GetProductUseCase implements GetProductInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    )
    {
    }

    public function execute(string $productID): ?Product
    {
        return $this->productRepository->getByUuid($productID);
    }
}