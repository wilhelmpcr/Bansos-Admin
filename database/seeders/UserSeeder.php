<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User admin pertama
        User::create([
            'name'      => 'Admin Utama',
            'email'     => 'admin@example.com',
            'password'  => Hash::make('password123'), // ganti nanti di production
            'role'      => 'admin', // kalau ada kolom role
        ]);
    }
}
