<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Presentation\Http\Controller;

use Psr\Http\Message\RequestInterface;
use Raketa\BackendTestTask\Application\UseCase\AddToCart\AddToCartInterface;
use Raketa\BackendTestTask\Presentation\Http\Response\JsonResponse;
use Raketa\BackendTestTask\Presentation\Http\Transformer\CartTransformer;

class AddToCartController
{
    public function __construct(
        private AddToCartInterface $useCase,
        private CartTransformer $transformer
    ) {
    }

    public function __invoke(RequestInterface $request): JsonResponse
    {
        $data = json_decode($request->getBody()->getContents(), true);

        $cartId = session_id(); // или из токена/куки
        $productUuid = $data['product_uuid'] ?? '';
        $quantity = (int)($data['quantity'] ?? 1);

        $cart = $this->useCase->execute($cartId, $productUuid, $quantity);

        return new JsonResponse([
            'status' => 'success',
            'cart' => $this->transformer->toArray($cart),
        ]);
    }
}