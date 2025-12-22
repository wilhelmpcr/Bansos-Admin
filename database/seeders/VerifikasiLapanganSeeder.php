<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VerifikasiLapanganSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua pendaftar yang ada
        $pendaftarIds = DB::table('pendaftar_bantuan')->pluck('pendaftar_id');

        if ($pendaftarIds->isEmpty()) {
            $this->command->warn('❌ Tidak ada data pendaftar_bantuan. Seed terlebih dahulu.');
            return;
        }

        $nama_petugas = [
            'Budi Santoso','Siti Aminah','Ahmad Fauzi','Dewi Lestari','Agus Setiawan',
            'Rina Wijaya','Andi Saputra','Fitri Handayani','Hendra Gunawan','Indah Permata',
            'Joko Susanto','Lina Marlina','Rudy Pratama','Tina Sari','Dedi Kurniawan',
            'Eka Putri','Fajar Ramadhan','Gita Anggraini','Hadi Pranoto','Intan Pertiwi',
            'Jumadi','Kiki Maulana','Lia Oktaviani','Mulyadi','Nina Safitri',
            'Oki Prasetyo','Putri Ramadhani','Qoriatul','Rian Prakoso','Sari Wulandari',
            'Teguh Prasetya','Umi Kalsum','Vina Anggraeni','Wawan Setiawan','Yulianti',
            'Zulkifli','Agung Nugroho','Bunga Citra','Cahyo Pratama','Dian Lestari',
            'Eko Saputra','Feni Marlina','Galih Setiawan','Hesti Wulandari','Irwan Pratama',
            'Jihan Nur','Kartika Sari','Lukman Hakim','Mega Putri','Novita Rahma',
            'Oktavian','Putra Wijaya','Qolbi Hidayat','Ririn Anggraini','Samsul Bahri'
        ];

        $data = [];
        for ($i = 1; $i <= 150; $i++) {
            $data[] = [
                'pendaftar_id'     => $pendaftarIds->random(),
                'petugas'          => $nama_petugas[array_rand($nama_petugas)],
                'tanggal'          => Carbon::now()->subDays(rand(0, 365))->format('Y-m-d'),
                'catatan'          => 'Verifikasi lapangan oleh petugas nomor ' . $i,
                'skor'             => rand(50, 100),
                'foto_verifikasi'  => null,
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ];
        }

        DB::table('verifikasi_lapangan')->insert($data);

        $this->command->info('✅ 150 data verifikasi_lapangan berhasil di-seed!');
    }
}
