<?php

namespace Raketa\BackendTestTask\Application\UseCase\GetProducts;

use Raketa\BackendTestTask\Application\UseCase\GetProducts\GetProductsInterface;
use Raketa\BackendTestTask\Domain\Entity\Product;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;

class GetProductsUseCase implements GetProductsInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    /**
     * @return Product[]
     */
    public function execute(string $category): array
    {
        return $this->productRepository->getByCategory($category);
    }
}