@extends('layouts.app')

@section('content')
<section class="pt-14 pb-12 lg:pt-24 bg-white min-h-screen">
    <div class="container mx-auto max-w-4xl">
        {{-- Card Hasil Tes --}}
        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col md:flex-row items-center gap-6">
            <img src="{{ asset('images/profile-placeholder.jpg') }}" alt="Foto Profil" class="w-36 h-36 rounded-lg object-cover border-2 border-purple-500">
            
            <div class="flex-1 text-center md:text-left">
                <h2 class="text-xl font-bold text-purple-700 bg-purple-200 px-4 py-2 rounded-md inline-block">{{ $hasilTes->hasil ?? 'Belum ada hasil tes' }}</h2>
                <p class="mt-2 text-gray-600">
                 </p>
                
                {{-- Tombol Download & Share --}}
                <div class="mt-4 flex gap-4">
                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg flex items-center gap-2">
                        <i class="fas fa-download"></i> Unduh
                    </button>
                    <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg flex items-center gap-2">
                        <i class="fas fa-share"></i> Kirim
                    </button>
                </div>
            </div>
        </div>

        {{-- Profesi yang Cocok --}}
        <h3 class="mt-10 text-lg font-semibold text-gray-700 text-center">Profesi yang cocok dengan kepribadianmu adalah</h3>
        <div class="flex justify-center gap-4 mt-4">
            <button class="px-6 py-2 bg-purple-600 text-white rounded-full">Taller</button>
            <button class="px-6 py-2 bg-purple-600 text-white rounded-full">Taller</button>
            <button class="px-6 py-2 bg-purple-600 text-white rounded-full">Taller</button>
            <button class="px-6 py-2 bg-purple-600 text-white rounded-full">Taller</button>
        </div>

        {{-- Sekolah yang Sesuai --}}
        <div class="mt-10 bg-gray-100 p-6 rounded-lg">
           
        </div>

        {{-- Kegiatan untuk Mengembangkan Minat --}}
        <div class="mt-6 bg-gray-100 p-6 rounded-lg">
             <p class="mt-2 text-gray-600">
             </p>
        </div>

        {{-- Rekomendasi Bidang Pekerjaan --}}
        <div class="mt-10">
            <h3 class="text-lg font-semibold text-gray-700 text-center">Rekomendasi Pekerjaan</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
               
            </div>
        </div>
    </div>
</section>
@endsection
