<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreatePendaftarBantuanDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua warga_id dan program_id yang sudah ada
        $wargaIds   = DB::table('warga')->pluck('warga_id')->toArray();
        $programIds = DB::table('program_bantuan')->pluck('program_id')->toArray();

        // Cegah error kalau tabel referensi masih kosong
        if (empty($wargaIds) || empty($programIds)) {
            $this->command->error('Tabel warga atau program_bantuan masih kosong. Seed dua tabel itu dulu.');
            return;
        }

        $statuses = ['pending', 'diterima', 'ditolak'];

        // Buat 100 data pendaftar dummy
        foreach (range(1, 100) as $index) {
            DB::table('pendaftar_bantuan')->insert([
                'warga_id'       => $faker->randomElement($wargaIds),
                'program_id'     => $faker->randomElement($programIds),
                'status_seleksi' => $faker->randomElement($statuses),
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }

        $this->command->info('Data pendaftar_bantuan dummy berhasil dibuat!');
    }
}
