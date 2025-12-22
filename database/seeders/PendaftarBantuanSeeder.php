<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftarBantuanSeeder extends Seeder
{
    public function run(): void
    {
        $wargaIds   = DB::table('warga')->pluck('warga_id');
        $programIds = DB::table('program_bantuan')->pluck('program_id');

        if ($wargaIds->isEmpty() || $programIds->isEmpty()) {
            $this->command->warn('Seeder dibatalkan: warga / program kosong');
            return;
        }

        $statuses = ['pending', 'diterima', 'ditolak'];
        $data = [];

        for ($i = 0; $i < 150; $i++) {
            $data[] = [
                'warga_id'       => $wargaIds->random(),
                'program_id'     => $programIds->random(),
                'status_seleksi' => $statuses[array_rand($statuses)],
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        DB::table('pendaftar_bantuan')->insert($data);
        $this->command->info('Pendaftar bantuan berhasil di-seed (150 data)');
    }
}
