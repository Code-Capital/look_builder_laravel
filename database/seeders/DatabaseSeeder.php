<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'country' => 'gujranwala',
            'phone' => '03367696680',
        ]);
        $this->call([
            CategorySeeder::class,
            FabricSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
