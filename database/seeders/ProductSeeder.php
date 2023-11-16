<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LookBuilderProduct;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LookBuilderProduct::create([
            'uuid' => Str::uuid(),
            'title' => 'shirt',
            'product_image' => 'shirt.png',
            'layer_image' => 'shirt.png',
            'color' => 'sky',
            'size' => '42',
            'price' => 300,
            'description' => 'description',
            'category_id' => 1,
            'fabric_id' => 1,
        ]);
        LookBuilderProduct::create([
            'uuid' => Str::uuid(),
            'title' => 'trouser',
            'product_image' => 'trouser.jpg',
            'layer_image' => 'trouser.jpg',
            'color' => 'black',
            'size' => '34',
            'price' => 340.00,
            'description' => 'description',
            'category_id' => 2,
            'fabric_id' => 2,
        ]);
    }
}
