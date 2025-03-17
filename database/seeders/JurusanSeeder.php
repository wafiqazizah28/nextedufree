<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use Carbon\Carbon;

class JurusanSeeder extends Seeder
{
    /**
     * Jalankan database seed.
     */
    public function run(): void
    {
        $jurusan = [
            [
                'jurusan_code' => 'J1',
                'jurusan'      => 'Teknik Komputer dan Jaringan',
                'jenis'        => 'Teknik',
                'img'          => 'tkj.jpg',
                'deskripsi'    => 'Jurusan yang mempelajari tentang jaringan komputer, perangkat keras, dan pemrograman dasar.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'jurusan_code' => 'J2',
                'jurusan'      => 'Multimedia',
                'jenis'        => 'Kreatif',
                'img'          => 'multimedia.jpg',
                'deskripsi'    => 'Jurusan yang mengajarkan desain grafis, animasi, videografi, dan produksi media digital.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'jurusan_code' => 'J3',
                'jurusan'      => 'Rekayasa Perangkat Lunak',
                'jenis'        => 'Teknologi',
                'img'          => 'rpl.jpg',
                'deskripsi'    => 'Jurusan yang fokus pada pengembangan perangkat lunak, pemrograman, dan sistem berbasis teknologi.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'jurusan_code' => 'J4',
                'jurusan'      => 'Akuntansi',
                'jenis'        => 'Keuangan',
                'img'          => 'akuntansi.jpg',
                'deskripsi'    => 'Jurusan yang mempelajari tentang pencatatan keuangan, perpajakan, dan pengelolaan bisnis.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'jurusan_code' => 'J5',
                'jurusan'      => 'Perbankan',
                'jenis'        => 'Keuangan',
                'img'          => 'perbankan.jpg',
                'deskripsi'    => 'Jurusan yang mempersiapkan siswa untuk bekerja di bidang perbankan, manajemen keuangan, dan layanan keuangan.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'jurusan_code' => 'J6',
                'jurusan'      => 'Teknik Mekatronika',
                'jenis'        => 'Teknik',
                'img'          => 'mekatronika.jpg',
                'deskripsi'    => 'Jurusan yang menggabungkan teknik elektro, mekanik, dan sistem kontrol otomatis.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'jurusan_code' => 'J7',
                'jurusan'      => 'Produksi Siaran Televisi',
                'jenis'        => 'Kreatif',
                'img'          => 'broadcasting.jpg',
                'deskripsi'    => 'Jurusan yang mengajarkan produksi televisi, penyiaran, dan media digital.',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ];

        // Insert data ke database
        Jurusan::insert($jurusan);
    }
}
