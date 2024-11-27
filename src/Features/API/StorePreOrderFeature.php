<?php

namespace PreOrder\PreOrderBackend\Features\API;

use Illuminate\Support\Facades\DB;
use PreOrder\PreOrderBackend\Jobs\API\GetProductBySlugJob;
use PreOrder\PreOrderBackend\Jobs\API\StorePreOrderJob;
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
                'quantity' => $quantity,
                'total_amount' => $quantity*$price,
                'status' => true
            ];
            $totalOrderQuantity += $quantity;
            $totalOrderPrice += ($quantity*$price);
        }
        $orderInfo['quantity'] = $totalOrderQuantity;
        $orderInfo['total_amount'] = $totalOrderPrice;

        DB::transaction(function () use ($orderInfo, $orderProductsInfo) {
            $order = (new StorePreOrderJob($orderInfo))->handle();

            $order->preOrderProducts()->createMany($orderProductsInfo);

//            $this->sendMailToClient($user, $order);
//            $this->sendMailToAdmin($order);
        });

        return [
            'message' => 'Your order successfully created.',
            'data' => [],
            'errors' => [],
            'statusCode' => Response::HTTP_CREATED,
        ];
    }
}