<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pertanyaan;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pertanyaan = [
            ['pertanyaan_code' => 'F1', 'pertanyaan' => 'Apakah kamu tertarik dengan pemrograman dan jaringan komputer?', 'created_at' => '2025-03-17 02:59:31', 'updated_at' => '2025-03-17 02:59:31'],
            ['pertanyaan_code' => 'F2', 'pertanyaan' => 'Apakah kamu suka memecahkan masalah teknis pada perangkat keras dan lunak?', 'created_at' => '2025-03-17 03:00:02', 'updated_at' => '2025-03-17 03:00:02'],
            ['pertanyaan_code' => 'F3', 'pertanyaan' => 'Apakah kamu tertarik memahami cara kerja sistem operasi dan server?', 'created_at' => '2025-03-17 03:00:21', 'updated_at' => '2025-03-17 03:00:21'],
            ['pertanyaan_code' => 'F4', 'pertanyaan' => 'Apakah kamu senang melakukan troubleshooting pada jaringan?', 'created_at' => '2025-03-17 03:01:28', 'updated_at' => '2025-03-17 03:01:28'],
            ['pertanyaan_code' => 'F5', 'pertanyaan' => 'Apakah kamu tertarik dengan keamanan siber dan proteksi data?', 'created_at' => '2025-03-17 03:01:54', 'updated_at' => '2025-03-17 03:01:54'],
            ['pertanyaan_code' => 'F6', 'pertanyaan' => 'Apakah kamu suka bekerja dengan perangkat keras komputer?', 'created_at' => '2025-03-17 03:02:28', 'updated_at' => '2025-03-17 03:02:28'],
            ['pertanyaan_code' => 'F7', 'pertanyaan' => 'Apakah kamu tertarik dengan teknologi cloud computing?', 'created_at' => '2025-03-17 03:02:59', 'updated_at' => '2025-03-17 03:02:59'],
            ['pertanyaan_code' => 'F8', 'pertanyaan' => 'Apakah kamu suka membongkar dan merakit mesin sepeda motor?', 'created_at' => '2025-03-17 03:03:25', 'updated_at' => '2025-03-17 03:03:25'],
            ['pertanyaan_code' => 'F9', 'pertanyaan' => 'Apakah kamu tertarik memahami sistem kelistrikan pada sepeda motor?', 'created_at' => '2025-03-17 03:03:43', 'updated_at' => '2025-03-17 03:03:43'],
            ['pertanyaan_code' => 'F10', 'pertanyaan' => 'Apakah kamu senang melakukan perawatan dan perbaikan kendaraan roda dua?', 'created_at' => '2025-03-17 03:06:12', 'updated_at' => '2025-03-17 03:06:12'],
            ['pertanyaan_code' => 'F11', 'pertanyaan' => 'Apakah kamu tertarik mempelajari teknologi injeksi bahan bakar?', 'created_at' => '2025-03-17 03:04:24', 'updated_at' => '2025-03-17 03:04:24'],
            ['pertanyaan_code' => 'F12', 'pertanyaan' => 'Apakah kamu ingin mengembangkan keterampilan diagnosa kerusakan mesin?', 'created_at' => '2025-03-17 03:04:41', 'updated_at' => '2025-03-17 03:04:41'],
            ['pertanyaan_code' => 'F13', 'pertanyaan' => 'Apakah kamu tertarik memahami sistem suspensi dan pengereman sepeda motor?', 'created_at' => '2025-03-17 03:07:04', 'updated_at' => '2025-03-17 03:07:04'],
            ['pertanyaan_code' => 'F14', 'pertanyaan' => 'Apakah kamu suka mengikuti perkembangan teknologi motor listrik?', 'created_at' => '2025-03-17 03:07:27', 'updated_at' => '2025-03-17 03:07:27'],
            ['pertanyaan_code' => 'F15', 'pertanyaan' => 'Apakah kamu tertarik memahami sistem mesin mobil dan kendaraan ringan lainnya?', 'created_at' => '2025-03-17 03:08:11', 'updated_at' => '2025-03-17 03:08:11'],
            ['pertanyaan_code' => 'F16', 'pertanyaan' => 'Apakah kamu suka memperbaiki sistem transmisi dan suspensi kendaraan?', 'created_at' => '2025-03-17 03:08:29', 'updated_at' => '2025-03-17 03:08:29'],
            ['pertanyaan_code' => 'F17', 'pertanyaan' => 'Apakah kamu senang bekerja dengan teknologi sistem rem dan kemudi?', 'created_at' => '2025-03-17 03:08:51', 'updated_at' => '2025-03-17 03:08:51'],
            ['pertanyaan_code' => 'F18', 'pertanyaan' => 'Apakah kamu tertarik dengan teknologi kendaraan listrik dan hybrid?', 'created_at' => '2025-03-17 03:09:19', 'updated_at' => '2025-03-17 03:09:19'],
            ['pertanyaan_code' => 'F19', 'pertanyaan' => 'Apakah kamu ingin memahami sistem pendinginan dan pelumasan mesin?', 'created_at' => '2025-03-17 03:09:40', 'updated_at' => '2025-03-17 03:09:40'],
            ['pertanyaan_code' => 'F20', 'pertanyaan' => 'Apakah kamu suka melakukan diagnosis kerusakan elektronik pada kendaraan?', 'created_at' => '2025-03-17 03:10:06', 'updated_at' => '2025-03-17 03:10:06'],
            ['pertanyaan_code' => 'F21', 'pertanyaan' => 'Apakah kamu tertarik mempelajari sistem manajemen mesin modern?', 'created_at' => '2025-03-17 03:10:32', 'updated_at' => '2025-03-17 03:10:32'],
            ['pertanyaan_code' => 'F22', 'pertanyaan' => 'Apakah kamu tertarik dengan sistem kelistrikan yang juga diterapkan pada kendaraan?', 'created_at' => '2025-03-17 04:44:46', 'updated_at' => '2025-03-17 04:44:46'],
            ['pertanyaan_code' => 'F23', 'pertanyaan' => 'Apakah kamu tertarik dengan teknologi kendaraan listrik yang juga diterapkan pada kendaraan ringan?', 'created_at' => '2025-03-17 04:45:29', 'updated_at' => '2025-03-17 04:45:29'],
            ['pertanyaan_code' => 'F24', 'pertanyaan' => 'Apakah kamu tertarik dengan sensor yang digunakan pada kendaraan dan sistem IoT?', 'created_at' => '2025-03-17 04:46:05', 'updated_at' => '2025-03-17 04:46:05'],
            ['pertanyaan_code' => 'F25', 'pertanyaan' => 'Apakah kamu tertarik dengan pekerjaan administratif seperti pengarsipan dan surat-menyurat?', 'created_at' => '2025-03-19 04:53:34', 'updated_at' => '2025-03-19 04:53:34'],
            ['pertanyaan_code' => 'F26', 'pertanyaan' => 'Apakah kamu suka mengatur jadwal dan mengelola dokumen?', 'created_at' => '2025-03-19 04:53:55', 'updated_at' => '2025-03-19 04:53:55'],
            ['pertanyaan_code' => 'F27', 'pertanyaan' => 'Apakah kamu tertarik dengan dunia kesekretariatan dan layanan pelanggan?', 'created_at' => '2025-03-19 04:54:23', 'updated_at' => '2025-03-19 04:54:23'],
            ['pertanyaan_code' => 'F28', 'pertanyaan' => 'Apakah kamu tertarik dengan dunia kesekretariatan dan layanan pelanggan?', 'created_at' => '2025-03-19 04:55:02', 'updated_at' => '2025-03-19 04:55:02'],
            ['pertanyaan_code' => 'F29', 'pertanyaan' => 'Apakah kamu tertarik memahami cara komunikasi bisnis yang efektif?', 'created_at' => '2025-03-19 04:56:29', 'updated_at' => '2025-03-19 04:56:29'],
            ['pertanyaan_code' => 'F30', 'pertanyaan' => 'Apakah kamu suka bekerja dengan data dan membuat laporan keuangan sederhana?', 'created_at' => '2025-03-19 04:56:52', 'updated_at' => '2025-03-19 04:56:52'],
            ['pertanyaan_code' => 'F31', 'pertanyaan' => 'Apakah kamu ingin memahami manajemen sumber daya manusia dalam sebuah perusahaan?', 'created_at' => '2025-03-19 04:57:14', 'updated_at' => '2025-03-19 04:57:14'],
            ['pertanyaan_code' => 'F32', 'pertanyaan' => 'Apakah kamu tertarik dengan etika dan tata cara dalam dunia bisnis?', 'created_at' => '2025-03-19 04:57:31', 'updated_at' => '2025-03-19 04:57:31'],
            ['pertanyaan_code' => 'F33', 'pertanyaan' => 'Apakah kamu suka menyusun agenda rapat dan membuat notulen?', 'created_at' => '2025-03-19 04:57:53', 'updated_at' => '2025-03-19 04:57:53'],
            ['pertanyaan_code' => 'F34', 'pertanyaan' => 'Apakah kamu ingin memahami proses pengelolaan dokumen digital dan arsip?', 'created_at' => '2025-03-19 04:58:25', 'updated_at' => '2025-03-19 04:58:25'],
            ['pertanyaan_code' => 'F35', 'pertanyaan' => 'Apakah kamu tertarik dengan teknologi yang digunakan dalam manajemen kantor modern?', 'created_at' => '2025-03-19 04:59:01', 'updated_at' => '2025-03-19 04:59:01'],
            ['pertanyaan_code' => 'F34', 'pertanyaan' => 'Apakah kamu ingin memahami proses pengelolaan dokumen digital dan arsip?', 'created_at' => '2025-03-19 04:58:25', 'updated_at' => '2025-03-19 04:58:25'],
            ['pertanyaan_code' => 'F35', 'pertanyaan' => 'Apakah kamu tertarik dengan teknologi yang digunakan dalam manajemen kantor modern?', 'created_at' => '2025-03-19 04:59:01', 'updated_at' => '2025-03-19 04:59:01'],
        ];

        foreach ($pertanyaan as $data) {
            Pertanyaan::create($data);
        }
    }
}
