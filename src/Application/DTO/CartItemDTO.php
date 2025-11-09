<?php

namespace Raketa\BackendTestTask\Application\DTO;

final class CartItemDTO
{
    /**
     * @param string $id
     * @param string $productId
     * @param float $price
     * @param int $quantity
     * @param ProductDTO $productDTO
     */
    public function __construct(
        private string $id,
        private string $productId,
        private float $price,
        private int $quantity,
        private ProductDTO $product
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

    public function getProduct(): ProductDTO
    {
        return $this->product;
    }
}