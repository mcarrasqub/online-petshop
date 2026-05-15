<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Huellitas',
            'email' => 'admin@huellitas.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'phone_number' => '1234567890',
        ]);

        User::create([
            'name' => 'Usuario Huellitas',
            'email' => 'user@huellitas.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'phone_number' => '0987654321',
        ]);
    }
}
