<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use PreOrder\PreOrderBackend\Features\API\ProductListFeature;
use PreOrder\PreOrderBackend\Helpers\JsonResponder;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductListController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $response = (new ProductListFeature())->handle();

        return JsonResponder::response(
            message: $response['message'] ?? '',
            errors: $response['errors'] ?? [],
            data: $response['data'] ?? [],
            statusCode: $response['statusCode'] ?? Response::HTTP_OK,
        );
    }
}