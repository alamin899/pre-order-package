<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\API;

use PreOrder\PreOrderBackend\Features\API\StorePreOrderFeature;
use PreOrder\PreOrderBackend\Helpers\JsonResponder;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;
use PreOrder\PreOrderBackend\Http\Requests\PreOrderRequest;

class StorePreOrderController extends Controller
{
    public function __invoke(PreOrderRequest $request): \Illuminate\Http\JsonResponse
    {
        $order = (new StorePreOrderFeature(
            orderProducts: $request->products ?? [],
            customer_name: $request->customer_name ?? '',
            customer_email: $request->customer_email ?? '',
            customer_phone: $request->customer_phone ?? '',
        ))->handle();

        return JsonResponder::response(message: $order['message'], errors: $order['errors'], data: $order['data'], statusCode: $order['statusCode']);

    }
}