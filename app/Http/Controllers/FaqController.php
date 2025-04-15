<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display the FAQ page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Optional: You can pass data to your view if needed
        $faqs = [
            [
                'question' => 'Apa itu NextEdu?',
                'answer' => 'NextEdu adalah platform edukasi yang membantu kamu menemukan jurusan SMK yang sesuai dengan minat dan bakat, melalui sistem pakar dan tes minat online.',
                'icon' => 'email'
            ],
            [
                'question' => 'Bagaimana cara menggunakan tes minat jurusan?',
                'answer' => 'Klik menu "Tes Minat" di halaman utama, isi data yang diminta, lalu jawab semua pertanyaan hingga selesai. Hasil rekomendasi jurusan akan muncul setelahnya.',
                'icon' => 'clipboard'
            ],
            [
                'question' => 'Apa itu Edubot?',
                'answer' => 'Edubot adalah chatbot AI yang siap menjawab pertanyaan seputar jurusan, kuliah, hingga tips pendidikan. Kamu bisa chat langsung di fitur yang tersedia.',
                'icon' => 'chat'
            ],
            [
                'question' => 'Website tidak bisa diakses, apa yang harus saya lakukan?',
                'answer' => 'Coba periksa koneksi internet, bersihkan cache browser, atau buka website dari perangkat lain. Jika masih bermasalah, hubungi kami lewat email official.nextedu@gmail.com atau Instagram @nextedu.id.',
                'icon' => 'alert'
            ],
            [
                'question' => 'Bagaimana cara menghubungi customer service?',
                'answer' => 'Kamu bisa kirim email ke support official.nextedu@gmail.com atau DM ke instagram kami di @nextedu.id. Tim kami siap membantu kamu!',
                'icon' => 'email'
            ],
            [
                'question' => 'Apakah data saya aman?',
                'answer' => 'Ya, NextEdu menjaga privasi dan keamanan data pengguna sesuai standar yang berlaku. Data tidak akan dibagikan ke pihak ketiga tanpa izin.',
                'icon' => 'lock'
            ],
        ];
        
        return view('pages.faq', compact('faqs'));
    }
}