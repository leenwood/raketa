<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Domain\Entity;

use Raketa\BackendTestTask\Domain\Entity\CartItem;

final class Cart
{

    /** @var CartItem[] */
    private array $items;

    /**
     * @param string $uuid
     * @param CartItem[] $items
     */
    public function __construct(
        private string $uuid,
        array $items = []
    )
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param CartItem $item
     * @return void
     */
    public function addItem(CartItem $item): void
    {
        $this->items[] = $item;
    }
}
