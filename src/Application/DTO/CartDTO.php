<?php

namespace Raketa\BackendTestTask\Application\DTO;

final class CartDTO
{
    /** @var CartItemDTO[] */
    private array $items;

    /**
     * @param string $uuid
     * @param CartItemDTO[] $items
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

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(CartItemDTO $item): void
    {
        $this->items[] = $item;
    }

}