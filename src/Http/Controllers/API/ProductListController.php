<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PreOrder\PreOrderBackend\Features\API\ProductListFeature;
use PreOrder\PreOrderBackend\Helpers\JsonResponder;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;
use PreOrder\PreOrderBackend\Operations\ProductSearchValue;
use Symfony\Component\HttpFoundation\Response;

class ProductListController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $filters = (new ProductSearchValue($request))->format();

        $response = (new ProductListFeature(
            query: $filters['query'],
            perPage: $filters['per_page'],
        ))->handle();

        return JsonResponder::response(
            message: $response['message'] ?? '',
            errors: $response['errors'] ?? [],
            data: $response['data'] ?? [],
            statusCode: $response['statusCode'] ?? Response::HTTP_OK,
        );
    }
}