<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaranPekerjaanSeeder extends Seeder
{
    /**
     * Jalankan database seed.
     */
    public function run(): void
    {
        $saran_pekerjaan = [
            ['jurusan_id' => 1, 'saran_pekerjaan' => 'Software Engineer'],
            ['jurusan_id' => 1, 'saran_pekerjaan' => 'Web Developer'],
            ['jurusan_id' => 1, 'saran_pekerjaan' => 'Data Scientist'],
            ['jurusan_id' => 1, 'saran_pekerjaan' => 'Cyber Security Specialist'],

            ['jurusan_id' => 2, 'saran_pekerjaan' => 'Akuntan'],
            ['jurusan_id' => 2, 'saran_pekerjaan' => 'Analis Keuangan'],
            ['jurusan_id' => 2, 'saran_pekerjaan' => 'Auditor'],
            ['jurusan_id' => 2, 'saran_pekerjaan' => 'Konsultan Pajak'],

            ['jurusan_id' => 3, 'saran_pekerjaan' => 'Desainer Grafis'],
            ['jurusan_id' => 3, 'saran_pekerjaan' => 'Animator'],
            ['jurusan_id' => 3, 'saran_pekerjaan' => 'UI/UX Designer'],
            ['jurusan_id' => 3, 'saran_pekerjaan' => 'Creative Director'],

            ['jurusan_id' => 4, 'saran_pekerjaan' => 'Insinyur Teknik Sipil'],
            ['jurusan_id' => 4, 'saran_pekerjaan' => 'Manajer Konstruksi'],
            ['jurusan_id' => 4, 'saran_pekerjaan' => 'Surveyor'],
            ['jurusan_id' => 4, 'saran_pekerjaan' => 'Ahli Struktur'],

            ['jurusan_id' => 5, 'saran_pekerjaan' => 'Ahli Bioteknologi'],
            ['jurusan_id' => 5, 'saran_pekerjaan' => 'Peneliti'],
            ['jurusan_id' => 5, 'saran_pekerjaan' => 'Ahli Gizi'],
            ['jurusan_id' => 5, 'saran_pekerjaan' => 'Farmasis'],

            ['jurusan_id' => 6, 'saran_pekerjaan' => 'Jurnalis'],
            ['jurusan_id' => 6, 'saran_pekerjaan' => 'Editor'],
            ['jurusan_id' => 6, 'saran_pekerjaan' => 'Penulis Konten'],
            ['jurusan_id' => 6, 'saran_pekerjaan' => 'Humas'],

            ['jurusan_id' => 7, 'saran_pekerjaan' => 'Psikolog'],
            ['jurusan_id' => 7, 'saran_pekerjaan' => 'Konselor'],
            ['jurusan_id' => 7, 'saran_pekerjaan' => 'HRD'],
            ['jurusan_id' => 7, 'saran_pekerjaan' => 'Dosen Psikologi'],
        ];

        // Insert ke database dengan timestamp
        foreach ($saran_pekerjaan as &$saran) {
            $saran['created_at'] = Carbon::now();
            $saran['updated_at'] = Carbon::now();
        }

        DB::table('saran_pekerjaan')->insert($saran_pekerjaan);
    }
}
