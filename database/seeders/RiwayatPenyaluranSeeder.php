<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RiwayatPenyaluranSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID dari penerima_bantuan
        $penerimaIds = DB::table('penerima_bantuan')->pluck('penerima_id');

        if ($penerimaIds->isEmpty()) {
            $this->command->warn('❌ Tabel penerima_bantuan kosong');
            return;
        }

        for ($i = 0; $i < 150; $i++) {
            DB::table('riwayat_penyaluran')->insert([
                'pendaftar_id' => $penerimaIds->random(), // sesuai kolom migration
                'verifikasi_id'=> null,
                'tanggal'      => Carbon::now()->subDays(rand(1, 365)),
                'jumlah'       => rand(300000, 3000000),
                'keterangan'   => 'Penyaluran tahap ke-' . rand(1, 4),
                'status'       => 'selesai',
                'dokumen'      => null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        $this->command->info('✅ Riwayat penyaluran berhasil di-seed (150 data)');
    }
}
