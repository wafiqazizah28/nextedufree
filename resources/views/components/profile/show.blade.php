@extends('layouts.app')

@section('content')
<section class="bg-backgroundLight min-h-screen flex items-center justify-center py-24 md:py-32">
    
    <div class="container mx-auto px-4">

        <!-- Kartu Profil -->
        <div class="bg-white shadow-lg rounded-lg p-6 md:p-8 max-w-4xl mx-auto">
            
            <!-- Header Profil -->
            <div class="text-center mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Profil Saya</h2>
                <p class="text-gray-600 text-sm md:text-base">Kelola dan perbarui informasi pribadimu di sini.</p>
            </div>

            <!-- Informasi Profil -->
            <div class="flex items-center bg-purple-700 text-white rounded-lg p-6 shadow-md">
                <!-- Avatar -->
               <!-- Cek apakah user punya foto -->
@if(auth()->user()->foto)
<img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover">
@else
<div class="w-24 h-24 bg-gray-300 flex items-center justify-center rounded-full text-2xl font-bold">
    {{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}
</div>
@endif

            
                <div class="ml-6">
                    <h3 class="text-xl font-semibold">Halo, {{ auth()->user()->nama }}</h3>
                    <p class="text-sm mt-1">🏫 Sekolah: {{ auth()->user()->sekolah ?? '-' }}</p>
                    <p class="text-sm">📞 No. HP: {{ auth()->user()->nomer_hp ?? '-' }}</p>
                    <p class="text-sm">✉️ Email: {{ auth()->user()->email }}</p>
                </div>
            
                <!-- Tombol Aksi -->
                <div class="ml-auto">
                    <a href="{{ route('profile.edit') }}" class="bg-white text-purple-700 font-semibold px-4 py-2 rounded-lg border border-white hover:bg-purple-100 transition">
                        Perbarui Profil
                    </a>
                </div>
            </div>
            
            <!-- Informasi Tambahan -->
            <div class="mt-8 bg-gray-100 p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800">Tentang NextEdu</h3>
                <p class="text-gray-600 text-sm md:text-base">
                    NextEdu adalah platform yang membantu kamu memilih jurusan dan kampus terbaik sesuai dengan 
                    <a href="#" class="text-blue-500 underline">minat dan bakat</a>. 
                    Dapatkan informasi seputar <a href="#" class="text-blue-500 underline">info jurusan</a>, biaya, 
                    dan <a href="#" class="text-blue-500 underline">prospek kerja</a> untuk masa depan yang lebih cerah.
                </p>
            </div>

        </div>

    </div>
</section>
@endsection
