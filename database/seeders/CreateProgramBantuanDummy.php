<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateProgramBantuanDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Locale Indonesia
        $programs = [];

        for ($i = 1; $i <= 150; $i++) {
            $programs[] = [
                'kode' => 'PRG-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_program' => $faker->words(rand(2,4), true), // nama program acak 2-4 kata
                'deskripsi' => $faker->sentence(rand(8, 15)), // deskripsi acak
                'anggaran' => $faker->numberBetween(100000, 5000000), // anggaran acak Rp100rb - Rp5jt
                'tahun' => $faker->numberBetween(2023, 2030), // tahun acak
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach ($programs as $program) {
            DB::table('program_bantuan')->updateOrInsert(
                ['kode' => $program['kode']], // pastikan unik
                $program
            );
        }

        $this->command->info('✅ 150 Data program bantuan acak berhasil di-seed!');
    }
}
