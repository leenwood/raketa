<?php

namespace Raketa\BackendTestTask\Infrastructure\Database\mysql;

use Doctrine\DBAL\Connection;
use Raketa\BackendTestTask\Domain\Entity\Product;
use Raketa\BackendTestTask\Domain\Repository\ProductRepositoryInterface;

class DoctrineProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private Connection $connection
    ) {
    }

    public function getByUuid(string $uuid): ?Product
    {
        $row = $this->connection->createQueryBuilder()
            ->select('*')
            ->from('products')
            ->where('uuid = :uuid')
            ->setParameter('uuid', $uuid)
            ->fetchAssociative();

        if (!$row) {
            return null;
        }

        return $this->map($row);
    }

    public function getByCategory(string $category): array
    {
        $rows = $this->connection->createQueryBuilder()
            ->select('*')
            ->from('products')
            ->where('category = :category')
            ->setParameter('category', $category)
            ->fetchAllAssociative();

        return array_map([$this, 'map'], $rows);
    }

    private function map(array $row): Product
    {
        return new Product(
            (int)$row['id'],
            $row['uuid'],
            (bool)$row['is_active'],
            $row['category'],
            $row['name'],
            $row['description'],
            $row['thumbnail'],
            (float)$row['price'],
        );
    }
}