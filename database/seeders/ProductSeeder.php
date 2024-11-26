<?php

namespace PreOrder\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use PreOrder\PreOrderBackend\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [];

        for ($i = 0; $i < 50; $i++) {
            $name = fake()->words(2, true);

            $products[] = [
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => fake()->paragraph,
                'price' => fake()->randomFloat(2, 10, 100),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Product::query()->insert($products);
    }
}