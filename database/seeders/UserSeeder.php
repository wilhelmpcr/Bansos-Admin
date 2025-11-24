<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // KOSONGKAN TABEL USERS DULU
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // 1) User admin pertama (default)
        User::create([
            'name'     => 'Admin Utama',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // 2) Tambah minimal 100 user dummy
        foreach (range(1, 100) as $index) {
            User::create([
                'name'     => $faker->name,
                'email'    => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'role'     => 'user',
            ]);
        }

        $this->command->info('UserSeeder: 1 admin + 100 user dummy berhasil dibuat ulang!');
    }
}
