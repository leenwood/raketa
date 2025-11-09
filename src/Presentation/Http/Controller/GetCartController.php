<?php

namespace Raketa\BackendTestTask\Presentation\Http\Controller;

use Psr\Http\Message\RequestInterface;
use Raketa\BackendTestTask\Application\UseCase\GetCart\GetCartInterface;
use Raketa\BackendTestTask\Application\UseCase\GetProduct\GetProductInterface;
use Raketa\BackendTestTask\Presentation\Http\Response\JsonResponse;
use Raketa\BackendTestTask\Presentation\Http\Transformer\CartTransformer;

class GetCartController
{
    public function __construct(
        private GetCartInterface $useCase,
        private CartTransformer $transformer,
    )
    {
    }


    public function get(RequestInterface $request): JsonResponse
    {
        $cartId = session_id();

        $cartDTO = $this->useCase->execute($cartId);

        if ($cartDTO === null) {
            return new JsonResponse([
                'id' => $cartId,
                'items' => [],
                'total' => 0.0,
            ]);
        }

        return new JsonResponse(
            $this->transformer->toArray($cartDTO)
        );
    }
}