@extends('layouts.app')

@section('content')
<section class="pt-8 pb-4 lg:pt-6 lg:pb-20 bg-backgroundPrimary">
    <div class="container">
        <div class="flex flex-col items-center text-center mb-6">
            <div class="w-full self-center px-4">
                <h1 class="text-3xl md:text-3xl font-light text-black">
                    Hallo, <span class="font-light capitalize text-black">{{ auth()->user()->nama }}</span> 👋
                </h1>
                
                <h2 class="mb-3 mt-2 text-lg font-medium text-black lg:text-4xl">
                    Detail <span class="font-medium text-purpleMain">Hasil Tes</span>
                </h2>
            </div>
        </div>
        
        <div class="flex flex-wrap justify-center">
            <div class="mt-5 mb-6 self-center rounded-sm bg-white text-slate-500 lg:w-4/5 w-full p-6 shadow-md">
                <div class="grid md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <strong class="text-black">Nama Lengkap:</strong>
                        <p>{{ $testDetail->user->nama }}</p>
                    </div>
                    <div>
                        <strong class="text-black">Tanggal Tes:</strong>
                        <p>{{ \Carbon\Carbon::parse($testDetail->created_at)->translatedFormat('l, d F Y') }}</p>
                    </div>
                    <div>
                        <strong class="text-black">Waktu Tes:</strong>
                        <p>{{ \Carbon\Carbon::parse($testDetail->created_at)->format('H.i') }} WIB</p>
                    </div>
                    <div>
                        <strong class="text-black">Hasil Tes:</strong>
                        <p class="font-bold text-purpleMain">{{ $testDetail->hasil }}</p>
                    </div>
                </div>
                
                <!-- Memastikan jurusan dan saran pekerjaan ada -->
                @php
                // Inisialisasi variabel
                $jurusan = null;
                $saranPekerjaan = collect();
                
                // Pastikan hasil tes ada sebelum mencari jurusan
                if (isset($testDetail->hasil)) {
                    $jurusan = \App\Models\Jurusan::where('jurusan', $testDetail->hasil)->first();
                    
                    // Pastikan jurusan ditemukan sebelum mencari saran pekerjaan
                    if ($jurusan) {
                        $saranPekerjaan = \App\Models\SaranPekerjaan::where('jurusan_id', $jurusan->id)->get();
                    }
                }
                @endphp
            
                <!-- Profesi yang Cocok dengan Card Layout -->
                <div class="border-t pt-6 mt-6">
                    <h3 class="text-xl font-semibold mb-6 text-center">Profesi yang Cocok</h3>
                    
                    @if(isset($saranPekerjaan) && $saranPekerjaan->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($saranPekerjaan as $saran)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                            <div class="h-36 bg-gray-100 overflow-hidden">
                                @if(isset($saran->gambar) && $saran->gambar)
                                <img src="{{ asset('storage/' . $saran->gambar) }}" 
                                     alt="{{ $saran->pekerjaan }}"
                                     class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full bg-purple-50 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h4 class="text-lg font-semibold text-purple-700">{{ $saran->saran_pekerjaan ?? 'Tidak ada judul' }}</h4>                                @if(isset($jurusan) && $jurusan)
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $jurusan->jurusan }}</span>
                                </div>
                                @endif
                                @if(isset($saran->deskripsi) && $saran->deskripsi)
                                <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $saran->deskripsi }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8 bg-gray-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-gray-500">Belum ada saran pekerjaan untuk jurusan ini.</p>
                    </div>
                    @endif
                </div>
                
                <!-- Rekomendasi Sekolah -->
                <div class="border-t pt-6 mt-6">
                    <h3 class="text-xl font-semibold mb-6 text-center">Rekomendasi Sekolah</h3>
                    
                    @php
                    $sekolahList = isset($jurusan) && $jurusan ? \App\Models\Sekolah::where('jurusan_id', $jurusan->id)->orderBy('nama', 'asc')->get() : collect();
                    @endphp
                    
                    @if(isset($sekolahList) && $sekolahList->count() > 0)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <ul class="divide-y divide-gray-200">
                            @foreach($sekolahList as $sekolah)
                            <li class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-purple-100 p-2 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-medium text-gray-800">{{ $sekolah->nama }}</h4>
                                        @if(isset($jurusan) && $jurusan)
                                        <p class="text-sm text-gray-500">Program Jurusan: {{ $jurusan->jurusan }}</p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @else
                    <div class="text-center py-8 bg-gray-50 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <p class="text-gray-500">Belum ada rekomendasi sekolah untuk jurusan ini.</p>
                    </div>
                    @endif
                </div>
                
                <div class="mt-6 flex justify-center">
                    <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 transition duration-300 flex items-center bg-blue-50 px-4 py-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left mr-2">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script untuk animasi -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.bg-white.shadow-md');
        
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('animate-fadeIn');
            }, 100 * index);
        });
    });
</script>

<style>
    .animate-fadeIn {
        animation: fadeIn 0.5s ease-in-out forwards;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection