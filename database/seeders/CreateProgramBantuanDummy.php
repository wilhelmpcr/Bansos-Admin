<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateProgramBantuanDummy extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $namaProgramList = [
            'Bantuan Sembako',
            'Bantuan Pendidikan',
            'Bantuan Kesehatan',
            'Bantuan Perumahan',
            'Bantuan Modal Usaha',
            'Bantuan Lansia',
            'Bantuan Difabel',
            'Bantuan Beasiswa Mahasiswa',
        ];

        // MATIKAN FOREIGN KEY CHECKS DULU (kalau ada relasi)
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Kosongkan tabel tanpa error foreign key
        DB::table('program_bantuan')->truncate();

        // HIDUPKAN LAGI FOREIGN KEY CHECKS
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Insert ulang 100 data
        foreach (range(1, 100) as $index) {
            $namaProgram = $faker->randomElement($namaProgramList);

            DB::table('program_bantuan')->insert([
                'kode'         => 'PRG-' . str_pad($index, 3, '0', STR_PAD_LEFT), // PRG-001, PRG-002, ...
                'nama_program' => $namaProgram,
                'tahun'        => $faker->numberBetween(2020, 2025),
                'deskripsi'    => $faker->sentence(10),
                'anggaran'     => $faker->randomFloat(2, 100000000, 5000000000), // 100 jt - 5 M
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }

        $this->command->info('Data program_bantuan dummy (100 baris) berhasil dibuat ulang!');
    }
}
