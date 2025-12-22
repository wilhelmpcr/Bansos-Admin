<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,

            // DUMMY MASTER DATA
            CreateWargaDummy::class,
            CreateProgramBantuanDummy::class,

            // TRANSAKSI
            PendaftarBantuanSeeder::class,
            PenerimaBantuanSeeder::class,
            VerifikasiLapanganSeeder::class,
            RiwayatPenyaluranSeeder::class,
        ]);
    }
}
