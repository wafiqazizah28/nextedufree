<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Sekolah;
use App\Models\Jurusan;

class SekolahSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua ID jurusan yang sudah ada
        $jurusanIds = Jurusan::pluck('id')->toArray();

        // Pastikan ada jurusan sebelum memasukkan sekolah
        if (empty($jurusanIds)) {
            $this->command->warn("Tidak ada data di tabel jurusan. Jalankan jurusaneeder dulu!");
            return;
        }

        // Data contoh sekolah
        $sekolah = [
            ['nama' => 'SMK Negeri 1 Jakarta', 'jurusan_id' => $jurusanIds[array_rand($jurusanIds)]],
            ['nama' => 'SMK Negeri 2 Bandung', 'jurusan_id' => $jurusanIds[array_rand($jurusanIds)]],
            ['nama' => 'SMK Negeri 3 Surabaya', 'jurusan_id' => $jurusanIds[array_rand($jurusanIds)]],
            ['nama' => 'SMK Teknologi Canggih', 'jurusan_id' => $jurusanIds[array_rand($jurusanIds)]],
            ['nama' => 'SMK Masa Depan', 'jurusan_id' => $jurusanIds[array_rand($jurusanIds)]],
        ];

        // Masukkan ke database
        Sekolah::insert($sekolah);
    }
}
