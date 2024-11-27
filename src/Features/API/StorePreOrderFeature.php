<?php

namespace PreOrder\PreOrderBackend\Features\API;

use Illuminate\Support\Facades\DB;
use PreOrder\PreOrderBackend\Jobs\GetProductBySlugJob;
use PreOrder\PreOrderBackend\Jobs\SendOrderEmail;
use PreOrder\PreOrderBackend\Jobs\StorePreOrderJob;
use Symfony\Component\HttpFoundation\Response;

class StorePreOrderFeature
{
    public function __construct(
        public array $orderProducts = [],
        public ?string $customer_name = '',
        public ?string $customer_email = '',
        public ?string $customer_phone = '',
    )
    {
    }

    public function handle(): array
    {
        $productSlugs = collect($this->orderProducts)->pluck('slug')->toArray();
        $products = (new GetProductBySlugJob($productSlugs))->handle();
        $productsArray = collect($products)->keyBy('slug')->toArray();

        $orderInfo = [
            'customer_name' => $this->customer_name,
            'customer_phone' => $this->customer_phone,
            'customer_email' => $this->customer_email,
            'status' => true
        ];

        $orderProductsInfo =[];

        $totalOrderPrice = 0;
        $totalOrderQuantity = 0;
        foreach ($this->orderProducts as $orderProduct) {
            $product = $productsArray[$orderProduct['slug'] ?? ''];
            $quantity = $orderProduct['quantity'] ?? 1;
            $price = $product['price'] ?? 0;
            $orderProductsInfo[] = [
                'product_id' => $product['id'] ?? null,
                'unit_price' => $product['price'] ?? 0,
                'quantity' => $quantity,
                'total_amount' => $quantity*$price,
                'status' => true
            ];
            $totalOrderQuantity += $quantity;
            $totalOrderPrice += ($quantity*$price);
        }
        $orderInfo['quantity'] = $totalOrderQuantity;
        $orderInfo['total_amount'] = $totalOrderPrice;

        $order = DB::transaction(function () use ($orderInfo, $orderProductsInfo) {
            $order = (new StorePreOrderJob($orderInfo))->handle();

            $order->preOrderProducts()->createMany($orderProductsInfo);

            return $order;
        });

        SendOrderEmail::dispatch($order);

        return [
            'message' => 'Your order successfully created.',
            'data' => [],
            'errors' => [],
            'statusCode' => Response::HTTP_CREATED,
        ];
    }
}