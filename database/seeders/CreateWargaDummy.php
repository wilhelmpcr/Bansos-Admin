<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateWargaDummy extends Seeder
{
    public function run(): void
    {
        $namaList = [
            "Adi Prasetyo", "Budi Santoso", "Citra Lestari", "Dewi Anggraini", "Eko Saputra",
            "Fajar Hidayat", "Galih Nugroho", "Hesti Purnama", "Iwan Setiawan", "Joko Widodo",
            "Kartika Sari", "Lina Marlina", "Mira Anggraeni", "Nina Kurniawati", "Oki Pratama",
            "Putri Aulia", "Qomaruddin", "Rina Dewi", "Siti Aminah", "Teguh Priyanto",
            "Umi Salamah", "Vina Melati", "Wawan Kurniawan", "Yulianto", "Zahra Fitriani",
            "Agus Saputra", "Bayu Pratama", "Cahyo Nugroho", "Dian Pertiwi", "Eka Wijaya",
            "Farhan Akbar", "Gita Larasati", "Hadi Prasetyo", "Indah Permatasari", "Jamaludin",
            "Kevin Pratama", "Lilis Suryani", "Miftahul Huda", "Nadia Aulia", "Omar Fauzi",
            "Putu Eka", "Rizky Maulana", "Sari Utami", "Taufik Hidayat", "Ujang Suryana",
            "Vita Ramadhani", "Widianto", "Yenny Kartika", "Zainal Abidin", "Aulia Rahman",
            "Bagus Santoso", "Candra Wijaya", "Diah Puspita", "Elok Handayani", "Fauzan Arifin",
            "Guntur Prasetyo", "Hanafi", "Intan Maharani", "Jihan Safitri", "Kurniawan",
            "Lala Fitriani", "Mahendra", "Novianti", "Oki Prasetyo", "Putra Aditya",
            "Qonita", "Rendi Saputra", "Sinta Dewi", "Tito Nugroho", "Umar Fauzi",
            "Vira Putri", "Wahyu Santoso", "Yusuf Hidayat", "Zulfa Maharani", "Agung Prabowo",
            "Bunga Citra", "Cahya Prasetyo", "Dewi Lestari", "Eko Pratama", "Fitria Ramadhani",
            "Gilang Ramadhan", "Heri Santoso", "Indra Lesmana", "Julianti", "Kiki Amelia",
            "Luthfi Rahman", "Maya Sari", "Nanda Pratama", "Oki Ramadhan", "Putri Rahma",
            "Qoriatul", "Ria Anggraini", "Sandi Putra", "Tia Maharani", "Ulfah Fitriani",
            "Vikri Saputra", "Wulan Sari", "Yudha Pratama", "Zaki Maulana", "Anisa Putri",
            "Bayu Nugroho", "Cinta Larasati", "Dani Prasetyo", "Elsa Ramadhani", "Fikri Hidayat",
            "Ghani Pratama", "Hani Lestari", "Ilham Saputra", "Januar", "Kurnia Fitriani",
            "Lia Marlina", "Mokhamad", "Nabila Rahma", "Omar Prasetyo", "Putri Lestari",
            "Qomarudin", "Rizki Amelia", "Sulaiman", "Tasya Putri", "Udin Santoso",
            "Viona Larasati", "Wira Prasetyo", "Yuni Anggraini", "Zidan Ramadhan", "Alif Pratama",
            "Bella Sari", "Cakra Nugroho", "Dewi Anggraeni", "Eka Pratama", "Fanny Maharani",
            "Gilang Prasetyo", "Hendri Saputra", "Intan Sari", "Joko Prasetyo", "Kiki Putri",
            "Luthfi Hidayat", "Mira Ramadhani", "Nina Pratiwi", "Oki Saputra", "Putra Nugroho",
            "Qonita Maharani", "Rendi Prasetyo", "Sari Anggraini", "Taufik Pratama", "Umi Lestari",
            "Vika Ramadhani", "Wawan Putra", "Yuni Pratiwi", "Zahra Sari", "Agus Pratama",
            "Bayu Anggraini", "Cahyo Prasetyo", "Dian Ramadhani", "Eko Nugroho", "Fajar Pratama",
            "Galih Prasetyo", "Hesti Ramadhani", "Indra Pratama", "Jihan Maharani", "Kevin Saputra",
            "Lilis Prasetyo", "Miftahul Rahman", "Nadia Pratiwi", "Omar Pratama", "Putu Ramadhani"
        ];

        $jenisKelamin = ['L', 'P'];
        $agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $pekerjaan = ['Petani', 'Guru', 'Karyawan Swasta', 'Wiraswasta', 'Nelayan', 'PNS', 'Mahasiswa'];

        $data = [];

        foreach ($namaList as $nama) {
            $data[] = [
                'no_ktp'        => str_pad(rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT),
                'nama'          => $nama,
                'jenis_kelamin' => $jenisKelamin[array_rand($jenisKelamin)],
                'agama'         => $agama[array_rand($agama)],
                'pekerjaan'     => $pekerjaan[array_rand($pekerjaan)],
                'telp'          => '08' . rand(1000000000, 9999999999),
                'email'         => strtolower(str_replace(' ', '.', $nama)) . '@example.com',
                'tanggal_lahir' => Carbon::now()->subYears(rand(18, 60))->subDays(rand(0, 365)),
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        DB::table('warga')->insert($data);

        $this->command->info('✅ 150 data warga Indonesia berhasil di-seed');
    }
}
