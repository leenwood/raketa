<?php

namespace Raketa\BackendTestTask\Infrastructure\Database\redis;

use Redis;
use Raketa\BackendTestTask\Domain\Entity\Cart;
use Raketa\BackendTestTask\Domain\Repository\CartRepositoryInterface;

class RedisCartRepository implements CartRepositoryInterface
{
    private const TTL = 86400;
    public function __construct(
        private Redis $redis
    ) {
    }

    public function get(string $cartId): ?Cart
    {
        $data = $this->redis->get($cartId);
        if ($data === false) {
            return null;
        }

        $unserialized = @unserialize($data);
        if ($unserialized instanceof Cart) {
            return $unserialized;
        }

        return null;
    }

    public function save(Cart $cart): void
    {
        $this->redis->setex($cart->getUuid(), self::TTL, serialize($cart));
    }
}