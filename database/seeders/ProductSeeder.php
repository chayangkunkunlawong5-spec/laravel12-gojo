<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Wireless Mouse',
            'description' => 'A comfortable wireless mouse with advanced precision.',
            'price' => 25.99,
            'image' => 'https://picsum.photos/200/300',
        ]);

        Product::create([
            'name' => 'Gaming Headset',
            'description' => 'Immersive audio experience for gaming and entertainment.',
            'price' => 49.99,
            'image' => 'https://picsum.photos/201/300',
        ]);

        Product::create([
            'name' => 'Laptop Stand',
            'description' => 'Adjustable laptop stand for comfortable working.',
            'price' => 39.99,
            'image' => 'https://picsum.photos/202/300',
        ]);

        Product::create([
            'name' => 'USB-C Hub',
            'description' => 'Multi-port USB-C hub for all your connectivity needs.',
            'price' => 29.99,
            'image' => 'https://picsum.photos/203/300',
        ]);

        Product::create([
            'name' => 'Bluetooth Speaker',
            'description' => 'Portable Bluetooth speaker with clear sound.',
            'price' => 45.99,
            'image' => 'https://picsum.photos/204/300',
        ]);
    }
}
