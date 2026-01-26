<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::create([
            'name' => 'Admin Deniswears',
            'email' => 'admin@deniswears.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // USER BIASA
        User::create([
            'name' => 'User Deniswears',
            'email' => 'user@deniswears.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
