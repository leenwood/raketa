<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Presentation\Http\Controller;

use Psr\Http\Message\RequestInterface;
use Raketa\BackendTestTask\Application\UseCase\GetProducts\GetProductsInterface;
use Raketa\BackendTestTask\Presentation\Http\Response\JsonResponse;
use Raketa\BackendTestTask\Presentation\Http\Transformer\ProductTransformer;

class GetProductsController
{
    public function __construct(
        private GetProductsInterface $useCase,
        private ProductTransformer $transformer
    ) {
    }

    public function __invoke(RequestInterface $request): JsonResponse
    {
        $data = json_decode($request->getBody()->getContents(), true);
        $category = $data['category'] ?? '';

        $products = $this->useCase->execute($category);

        return new JsonResponse(
            array_map([$this->transformer, 'toArray'], $products)
        );
    }
}