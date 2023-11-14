<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'uuid' => Str::uuid(),
            'name' => 'shirts'
        ]);
        Category::create([
            'uuid' => Str::uuid(),
            'name' => 'trousers'
        ]);
        Category::create([
            'uuid' => Str::uuid(),
            'name' => 'base'
        ]);
        Category::create([
            'uuid' => Str::uuid(),
            'name' => 'shoes'
        ]);
        Category::create([
            'uuid' => Str::uuid(),
            'name' => 'coat'
        ]);
    }
}
