<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'country' => 'gujranwala',
            'phone' => '03367696680',
        ]);
        $user->assignRole('admin');
    }
}
