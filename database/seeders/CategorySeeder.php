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
            'name' => 'Jackets',
            'image' => '1701346139_oNA6CGfPz71Ul6J.jpg'
        ]);
        Category::create([
            'uuid' => Str::uuid(),
            'name' => 'Trousers',
            'image' => '1701346152_Zzml0QTCPPVwCuv.jpg'

        ]);
        Category::create([
            'uuid' => Str::uuid(),
            'name' => 'Base',
            'image' => '1701346162_mYxunhEwEqj7KfK.jpg'
        ]);
        Category::create([
            'uuid' => Str::uuid(),
            'name' => 'Shoes',
            'image' => '1701346171_MYFQ8Lab5x7ZgJx.jpg'
        ]);
    }
}
