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

        foreach (range(1, 20) as $index) {
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

        $this->command->info('Data program_bantuan dummy berhasil dibuat!');
    }
}
