<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand1 = Brand::create([
            'name' => 'brand1'
        ]);

        $brand2 = Brand::create([
            'name' => 'brand2'
        ]);

        $brand3 = Brand::create([
            'name' => 'brand3'
        ]);

        $brand4 = Brand::create([
            'name' => 'brand4'
        ]);

        $brand5 = Brand::create([
            'name' => 'brand5'
        ]);
        

        $product1 = Product::create([
            'name' => 'product1',
            'price' => 123,
            'stock' => 85,
            'brand_id' => $brand1->id
        ]);

        $product2 = Product::create([
            'name' => 'product2',
            'price' => 231,
            'stock' => 46,
            'brand_id' => $brand2->id
        ]);

        $product3 = Product::create([
            'name' => 'product3',
            'price' => 453,
            'stock' => 34,
            'brand_id' => $brand3->id
        ]);

        $product4 = Product::create([
            'name' => 'product4',
            'price' => 433,
            'stock' => 84,
            'brand_id' => $brand4->id
        ]);

        $product5 = Product::create([
            'name' => 'product5',
            'price' => 342,
            'stock' => 25,
            'brand_id' => $brand5->id
        ]);
    }
}
