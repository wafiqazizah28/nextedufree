<!-- resources/views/privacy-policy.blade.php -->
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextEdu - Kebijakan Privasi</title>
    <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .policy-section {
            margin-bottom: 2rem;
        }

        .policy-section h2 {
            color: #4F46E5;
            margin-bottom: 1rem;
        }

        .policy-section ul {
            margin-left: 1.5rem;
        }

        .policy-section li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body class="bg-lightcream">
    <!-- Privacy Policy Section -->
    <section class="bg-lightcream py-10">
        <div class="container mx-auto px-4 max-w-4xl">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-purpleMain text-3xl font-semibold">Kebijakan Privasi</h1>
                    <p class="text-[#53686A] mt-2">
                        Butuh Bantuan Lebih Lanjut?
                        <a href="mailto:official.nextedu@gmail.com" class="text-[#53686A]">Hubungi Kami</a>
                    </p>

                </div>

            </div>

            <!-- Introduction -->
            <div class="bg-white p-8 rounded-lg shadow-sm">
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-purpleMain">Kebijakan Privasi – NextEdu</h2>
                    <p class="text-gray-600 text-sm mt-2">
                        Di NextEdu, kami menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi yang Anda
                        berikan saat menggunakan layanan kami di nextedu.my.id. Berikut adalah penjelasan bagaimana kami
                        mengumpulkan, menggunakan, dan melindungi data Anda.
                    </p>
                </div>
            
                <div class="policy-section">
                    <div class="text-lg font-semibold text-purpleMain flex items-center">
                        <span class="text-purpleMain mr-2">1.</span>
                        <span class="text-purpleMain">Informasi yang Kami Kumpulkan</span>
                    </div>
                    <p class="text-gray-600 mb-3 ml-6">Kami dapat mengumpulkan informasi berikut:</p>
                    <ul class="list-disc text-gray-600 ml-12">
                        <li>Nama, alamat email, dan data kontak lainnya saat Anda mendaftar atau menghubungi kami.</li>
                        <li>Jawaban dan hasil dari tes minat jurusan.</li>
                        <li>Informasi teknis seperti alamat IP, jenis browser, dan data perangkat untuk keperluan
                            analisis.</li>
                    </ul>
                </div>
            
                <div class="policy-section">
                    <div class="text-lg font-semibold text-purpleMain flex items-center">
                        <span class="text-purpleMain mr-2">2.</span>
                        Bagaimana Kami Menggunakan Informasi
                    </div>
                    <p class="text-gray-600 mb-3 ml-6">Data yang kami kumpulkan digunakan untuk:</p>
                    <ul class="list-disc text-gray-600 ml-12">
                        <li>Memberikan hasil tes minat jurusan yang sesuai.</li>
                        <li>Menyediakan layanan chatbot dan personalisasi pengalaman pengguna.</li>
                        <li>Menyempurnakan konten dan fitur website.</li>
                        <li>Menanggapi pertanyaan atau permintaan Anda.</li>
                    </ul>
                </div>
            
                <div class="policy-section">
                    <div class="text-lg font-semibold text-purpleMain flex items-center">
                        <span class="text-purpleMain mr-2">3</span>
                        Keamanan Data
                    </div>
                    <p class="text-gray-600 ml-6">
                        Kami menggunakan langkah-langkah teknis dan organisasi yang sesuai untuk melindungi data pribadi
                        dari akses tidak sah, kehilangan, atau penyalahgunaan.
                    </p>
                </div>
            
                <div class="policy-section">
                    <div class="text-lg font-semibold text-purpleMain flex items-center">
                        <span class="text-purpleMain mr-2">4</span>
                        Berbagi Data
                    </div>
                    <p class="text-gray-600 ml-6">
                        Kami tidak akan <strong>membagikan</strong> informasi pribadi Anda kepada pihak ketiga, kecuali
                        jika diwajibkan oleh hukum atau atas persetujuan Anda.
                    </p>
                </div>
            
                <div class="policy-section">
                    <div class="text-lg font-semibold text-purpleMain flex items-center">
                        <span class="text-purpleMain mr-2">5.</span>
                        Cookie
                    </div>
                    <p class="text-gray-600 ml-6">
                        Website kami menggunakan cookie untuk meningkatkan pengalaman pengguna. Anda dapat memilih
                        untuk menonaktifkan cookie melalui pengaturan browser Anda.
                    </p>
                </div>
            
                <div class="policy-section">
                    <div class="text-lg font-semibold text-purpleMain flex items-center">
                        <span class="text-purpleMain mr-2">6.</span>
                        Hak Pengguna
                    </div>
                    <p class="text-gray-600 mb-3 ml-6">Anda berhak untuk:</p>
                    <ul class="list-disc text-gray-600 ml-12">
                        <li>Meminta akses ke data pribadi Anda.</li>
                        <li>Memperbaiki atau menghapus data Anda.</li>
                        <li>Menarik persetujuan kapan saja jika sebelumnya telah memberikan izin.</li>
                    </ul>
                </div>
            
                <div class="policy-section">
                    <div class="text-lg font-semibold text-purpleMain flex items-center">
                        <span class="text-purpleMain mr-2">7.</span>
                        Perubahan Kebijakan
                    </div>
                    <p class="text-gray-600 ml-6">
                        Kami dapat memperbarui kebijakan ini sewaktu-waktu. Perubahan akan diinformasikan melalui
                        website dan berlaku sejak tanggal diperbarui.
                    </p>
                </div>
            
                <div class="policy-section">
                    <div class="text-lg font-semibold text-purpleMain flex items-center">
                        <span class="text-purpleMain mr-2">8.</span>
                        Kontak
                    </div>
                    <p class="text-gray-600 mb-3 ml-6">
                        Jika Anda memiliki pertanyaan terkait kebijakan privasi ini, silakan hubungi kami di:
                    </p>
                    <ul class="text-gray-600 ml-12">
                        <li class="flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>official.nextedu@gmail.com</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span>Instagram: @nextedu.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
          

            <!-- Last Updated -->
            <div class="text-center text-gray-500 text-sm mt-8">
                Terakhir diperbarui: {{ date('d F Y') }}
            </div>
        </div>
    </section>
</body>

</html>
@endsection