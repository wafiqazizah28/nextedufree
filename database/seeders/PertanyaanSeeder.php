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
            ['F1', 'Apakah anda senang dengan matematika?'],
            ['F2', 'Apakah anda senang bergaul dan memiliki banyak relasi?'],
            ['F3', 'Apakah anda senang bekerja dengan alat alat?'],
            ['F4', 'Apakah anda senang membaca buku / artikel komputer?'],
            ['F5', 'Apakah anda senang bekerja dengan perangkat jaringan?'],
            ['F6', 'Apakah anda senang menginstal software sistem operasi dan aplikasi?'],
            ['F7', 'Apakah anda senang memperbaiki peripheral computer?'],
            ['F8', 'Apakah anda tertarik dalam bidang komputer jaringan?'],
            ['F9', 'Apakah anda bisa mempengaruhi (persuasive)?'],
            ['F10', 'Apakah anda senang menggunakan kamera?'],
            ['F11', 'Apakah anda senang menggambar / melukis?'],
            ['F12', 'Apakah anda senang memperhatikan gambar daripada tulisan?'],
            ['F13', 'Apakah anda senang mengingat sesuatu melalui gambar atau diagram?'],
            ['F14', 'Apakah anda senang dengan permainan yang menggunakan logika?'],
            ['F15', 'Apakah anda bisa mengurutkan sesuatu agar mudah diingat?'],
            ['F16', 'Apakah anda senang memanajemen pengembangan perangkat lunak?'],
            ['F17', 'Apakah anda senang dengan kode-kode unik?'],
            ['F18', 'Apakah anda senang membuat desain-desain unik?'],
            ['F19', 'Apakah anda senang mengerjakan laporan keuangan?'],
            ['F20', 'Apakah anda senang dengan pekerjaan yang membutuhkan ketelitian?'],
            ['F21', 'Apakah anda senang mengoperasikan aplikasi komputer akuntansi?'],
            ['F22', 'Apakah anda senang dengan program pengolahan angka?'],
            ['F23', 'Apakah anda tertarik mendalami bidang akuntansi?'],
            ['F24', 'Apakah anda menguasai atau senang berbahasa asing?'],
            ['F25', 'Apakah anda senang dengan kegiatan surat-menyurat?'],
            ['F26', 'Apakah anda senang mengatur jadwal atau memanajemen waktu?'],
            ['F27', 'Apakah anda senang mengoperasikan perangkat lunak perbankan?'],
            ['F28', 'Apakah anda tertarik pada pekerjaan perbankan?'],
            ['F29', 'Apakah anda tertarik mendalami permesinan?'],
            ['F30', 'Apakah anda bisa mengoperasikan permesinan?'],
            ['F31', 'Apakah anda bisa berpikir secara logis dan sistematis?'],
            ['F32', 'Apakah anda senang memperbaiki barang-barang elektronik?'],
            ['F33', 'Apakah anda senang dengan ilmu komputasi?'],
            ['F34', 'Apakah anda senang bercerita?'],
            ['F35', 'Apakah anda senang tampil di depan kamera?'],
            ['F36', 'Apakah anda senang mencari berita?'],
            ['F37', 'Apakah anda senang memandu acara?'],
            ['F38', 'Apakah anda tertarik mendalami bidang penyiaran?'],
        ];

        foreach ($pertanyaan as $data) {
            Pertanyaan::create([
                'pertanyaan_code' => $data[0],
                'pertanyaan' => $data[1],
            ]);
        }
    }
}
