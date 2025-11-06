<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Domain\Entity;

final class CartItem
{
    /**
     * @param string $id
     * @param string $productId
     * @param float $price
     * @param int $quantity
     */
    public function __construct(
        private string $id,
        private string $productId,
        private float $price,
        private int $quantity
    )
    {
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

}