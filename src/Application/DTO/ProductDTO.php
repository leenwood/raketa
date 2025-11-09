<?php

namespace Raketa\BackendTestTask\Application\DTO;

final class ProductDTO
{
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
    public function __construct(
        private int $id,
        private string $uuid,
        private bool $isActive,
        private string $category,
        private string $name,
        private string $description,
        private string $thumbnail,
        private float $price
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}