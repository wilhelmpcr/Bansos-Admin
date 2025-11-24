<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CreateWargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        $pekerjaanList = [
            'Pelajar/Mahasiswa',
            'Pegawai Negeri',
            'Karyawan Swasta',
            'Wiraswasta',
            'Buruh Harian',
            'Ibu Rumah Tangga',
            'Tidak Bekerja',
        ];

        foreach (range(1, 155) as $index) {
            $rawTelp = $faker->phoneNumber;
            $cleanTelp = preg_replace('/[^0-9+]/', '', $rawTelp);
            $cleanTelp = substr($cleanTelp, 0, 15);

            DB::table('warga')->insert([
                'no_ktp'        => $faker->unique()->numerify('################'),
                'nama'          => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'agama'         => $faker->randomElement($agamaList),
                'pekerjaan'     => $faker->randomElement($pekerjaanList),
                'telp'          => $faker->optional()->passthrough($cleanTelp),
                'email'         => $faker->optional()->safeEmail,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }

        $this->command->info('Data warga dummy (faker Indonesia, 155 baris) berhasil dibuat!');
    }
}
