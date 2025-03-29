@extends('layouts.app')

@section('content')
<section class="pt-14 pb-12 lg:pt-24 bg-white min-h-screen">
    <div class="container mx-auto max-w-4xl">

        {{-- Card Hasil Tes --}}
        <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col md:flex-row items-center gap-6">
            <img src="{{ asset('storage/' . ($jurusan->gambar ?? 'default.jpg')) }}" 
                 alt="Foto Jurusan" class="w-36 h-36 rounded-lg object-cover border-2 border-purple-500">
            
            <div class="flex-1 text-center md:text-left">
                <h2 class="text-xl font-bold text-purple-700 bg-purple-200 px-4 py-2 rounded-md inline-block">
                    {{ $hasilTes->hasil ?? 'Belum ada hasil tes' }}
                </h2>
                <p class="mt-2 text-gray-600">
                    {{ $jurusan->deskripsi ?? 'Deskripsi tidak tersedia' }}
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
        <h3 class="mt-10 text-lg font-semibold text-gray-700 text-center">Profesi yang cocok dengan jurusan ini:</h3>
        
\        
        </div>

    </div>
</section>
@endsection
