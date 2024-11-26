<?php

namespace PreOrder\PreOrderBackend\Features\API;

use PreOrder\PreOrderBackend\Http\Resources\ProductResource;
use PreOrder\PreOrderBackend\Jobs\API\ProductListJob;
use Symfony\Component\HttpFoundation\Response;

class ProductListFeature
{
    public function __construct(
        private  ?string $query = '',
        private  int     $perPage = 15,
    )
    {
    }

    public function handle(): array
    {
        $products = (new ProductListJob(query: $this->query, perPage: $this->perPage))->handle();

        return [
            'message' => 'Success',
            'data' => [
                'products' => ProductResource::collection($products),
                'meta' => [
                    'current_page' => $products->currentPage(),
                    'total_items' => $products->total(),
                    'per_page' => $products->perPage(),
                    'total_pages' => $products->lastPage(),
                    'next_page_url' => $products->nextPageUrl(),
                    'previous_page_url' => $products->previousPageUrl(),
                ]
            ],
            'errors' => [],
            'statusCode' => Response::HTTP_OK,
        ];
    }
}