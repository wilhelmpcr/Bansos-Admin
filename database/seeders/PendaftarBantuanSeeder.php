<?php
// database/seeders/PendaftarBantuanSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PendaftarBantuan;
use App\Models\ProgramBantuan;
use App\Models\Warga;

class PendaftarBantuanSeeder extends Seeder
{
    public function run()
    {
        // Ambil beberapa program dan warga yang sudah ada
        $programs = ProgramBantuan::limit(3)->get();
        $wargas = Warga::limit(10)->get();

        $statuses = ['pending', 'diterima', 'ditolak'];
        $berkasExamples = [
            'berkas_ahmad.pdf',
            'dokumen_siti.jpg',
            'file_budi.docx',
            'kelengkapan_maya.pdf',
            'berkas_rizki.zip'
        ];

        foreach ($wargas as $index => $warga) {
            PendaftarBantuan::create([
                'program_id' => $programs->random()->id,
                'warga_id' => $warga->id,
                'status_seleksi' => $statuses[array_rand($statuses)],
                'berkas_pendaftaran' => $berkasExamples[$index % count($berkasExamples)]
            ]);
        }

        $this->command->info('Data pendaftar bantuan berhasil dibuat!');
    }
}
