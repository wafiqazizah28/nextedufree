<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use Carbon\Carbon;

class jurusanSeeder extends Seeder
{
    /**
     * Jalankan database seed.
     */
    public function run(): void
    {
        $jurusan = [
            [
                'jurusan_code' => 'J1',
                'jurusan'      => 'Teknik Komputer Jaringan',
                'jenis'        => 'Teknik',
                'img'          => 'tkj.jpg',
                'deskripsi'    => 'Jurusan yang berfokus pada jaringan komputer, pemrograman dasar, dan perbaikan perangkat keras.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'jurusan_code' => 'J2',
                'jurusan'      => 'Teknik Sepeda Motor',
                'jenis'        => 'Engineering',
                'img'          => 'tsm.jpg',
                'deskripsi'    => 'Jurusan yang mempelajari perawatan, perbaikan, dan teknologi sistem kelistrikan serta mesin sepeda motor.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'jurusan_code' => 'J3',
                'jurusan'      => 'Teknik Kendaraan Ringan',
                'jenis'        => 'Engineering',
                'img'          => 'tkr.jpg',
                'deskripsi'    => 'Jurusan yang berfokus pada sistem mesin mobil, transmisi, suspensi, dan teknologi kendaraan ringan.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'jurusan_code' => 'J4',
                'jurusan'      => 'Admin Perkantoran',
                'jenis'        => 'Business', // atau bisa 'Administration'
                'img'          => 'admin_perkantoran.jpg',
                'deskripsi'    => 'Jurusan yang berfokus pada administrasi perkantoran, manajemen dokumen, pelayanan publik, dan keterampilan komunikasi dalam lingkungan bisnis.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            
        ];

        // Insert data ke database
        Jurusan::insert($jurusan);
    }
}
