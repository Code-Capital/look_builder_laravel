<?php

namespace Database\Seeders;

use App\Models\Fabric;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FabricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fabric::create([
            'uuid' => Str::uuid(),
            'name' => 'Burgundy Wool Mohair',
            'image' => 'fabric.jpg',
            'price' => '600',
            'composition' => '84% Wool, 16% Mohair',
            'weight' => '230gr/m2',
            'season' => 'All Season',
            'woven_by' => 'Vitale Barberis Canonico (It)',
            'fabric_code' => '834.601/4804'
        ]);
        Fabric::create([
            'uuid' => Str::uuid(),
            'name' => 'Fabric 2',
            'image' => 'fabric.jpg',
            'price' => '500',
            'composition' => '80% Wool, 16% Mohair',
            'weight' => '23gr/m2',
            'season' => 'winter Season',
            'woven_by' => 'Vitale Barberis Canonico (It)',
            'fabric_code' => '835.601/4804'
        ]);
    }
}
