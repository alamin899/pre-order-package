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
        $slugs = [];
        for ($i = 0; $i < 50; $i++) {
            $name = fake()->words(2, true);
            $slug = Str::slug($name);

            while (in_array($slug, $slugs)) {
                $name = fake()->words(2, true);
                $slug = Str::slug($name);
            }

            $slugs[] = $slug; // Add slug to the list of used slugs

            $products[] = [
                'name' => $name,
                'slug' => $slug,
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