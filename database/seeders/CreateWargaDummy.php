<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class CreateWargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    $faker = \Faker\Factory::create('id_ID');

    $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
    $pekerjaanList = [
        'Pelajar/Mahasiswa',
        'Pegawai Negeri',
        'Karyawan Swasta',
        'Wiraswasta',
        'Buruh Harian',
        'Ibu Rumah Tangga',
        'Tidak Bekerja'
    ];

    foreach (range(1, 100) as $index) {

        // generate nomor telepon lalu dibersihkan max 15 char
        $rawTelp = $faker->phoneNumber;
        // hapus semua karakter kecuali angka dan +
        $cleanTelp = preg_replace('/[^0-9+]/', '', $rawTelp);
        // batasi maksimal 15 karakter
        $cleanTelp = substr($cleanTelp, 0, 15);

        DB::table('warga')->insert([
            'no_ktp'        => $faker->unique()->numerify('################'), // 16 digit
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

    $this->command->info('Data warga (faker Indonesia) berhasil dibuat!');
}

}
