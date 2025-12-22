<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenerimaBantuanSeeder extends Seeder
{
    public function run(): void
    {
        $wargaIds   = DB::table('warga')->pluck('warga_id');
        $programIds = DB::table('program_bantuan')->pluck('program_id');

        if ($programIds->isEmpty()) {
            $this->command->error('Program bantuan masih kosong');
            return;
        }

        $data = [];

        for ($i = 1; $i <= 150; $i++) {
            $data[] = [
                'nama'           => 'Penerima Bantuan ' . $i,
                'nik'            => str_pad($i, 16, '0', STR_PAD_LEFT), // UNIQUE
                'alamat'         => 'Alamat dummy ke-' . $i,
                'tanggal_daftar' => now(),
                'warga_id'       => $wargaIds->isNotEmpty()
                                    ? $wargaIds->random()
                                    : null,
                'program_id'     => $programIds->random(),
                'keterangan'     => 'Penerima bantuan dummy ke-' . $i,
                'status'         => 'menunggu',
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        DB::table('penerima_bantuan')->insert($data);

        $this->command->info('✅ 150 data penerima_bantuan berhasil di-seed');
    }
}
