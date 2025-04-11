@extends('layouts.app')

@section('content')
<section class="pt-4 b-8 lg:pt-12 bg-white min-h-screen">
    <div class="container mx-auto max-w-4xl px-4">

        {{-- Card Hasil Tes --}}
        <div
            class="bg-white shadow-md rounded-xl p-6 flex flex-col md:flex-row items-center gap-6 border border-purpleMain">
            <!-- Gambar jurusan -->
            <img src="{{ asset('storage/' . ($jurusan->img ?? 'default.jpg')) }}" alt="Foto Jurusan"
                class="w-36 h-36 rounded-lg object-cover border-2 border-purpleMain shadow-sm">

            <!-- Konten jurusan -->
            <div class="flex-1 text-center md:text-left">
                <!-- Nama jurusan -->
                <h2 class="text-xl font-bold text-purpleMain bg-purple-50 px-4 py-2 rounded-md inline-block shadow-sm">
                    {{ $hasilTes->hasil ?? 'Belum ada hasil tes' }}
                </h2>

                <!-- Deskripsi -->
                <p class="mt-2 text-gray-600">
                    {{ $jurusan->deskripsi ?? 'Deskripsi tidak tersedia' }}
                </p>

                <!-- Tombol aksi -->
                <div class="mt-4 flex flex-wrap gap-3">
                    <a href="{{ route('hasil-tes.download', $hasilTes->id) }}"
                        class="px-4 py-2 bg-purpleMain text-white rounded-md flex items-center gap-2 hover:bg-purple-700 transition-colors text-sm font-medium shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Unduh PDF
                    </a>

                    <button type="button" onclick="openShareModal()"
                        class="px-4 py-2 bg-purpleMain text-white rounded-md flex items-center gap-2 hover:bg-purple-700 transition-colors text-sm font-medium shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        Bagikan
                    </button>
                </div>
            </div>
        </div>


        {{-- Modal Share --}}
        <div id="shareModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
            <div class="bg-white rounded-xl p-6 max-w-2xl w-full mx-4 shadow-2xl">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Bagikan Hasil Tes</h3>
                    <button type="button" onclick="closeShareModal()"
                        class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Image Preview -->
                    <div
                        class="w-full md:w-1/2 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center p-2 border">
                        <img id="shareImagePreview" src="/images/loading.gif" alt="Preview hasil tes"
                            class="max-w-full h-auto">
                    </div>

                    <!-- Share Options -->
                    <div class="w-full md:w-1/2">
                        <p class="mb-4 text-gray-600">Bagikan hasil tes jurusan {{ $hasilTes->hasil ?? '' }} ke platform
                            sosial media:</p>

                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <a id="facebookShareBtn" href="#" target="_blank" rel="noopener noreferrer"
                                class="flex items-center justify-center gap-2 p-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                                Facebook
                            </a>

                            <a id="twitterShareBtn" href="#" target="_blank" rel="noopener noreferrer"
                                class="flex items-center justify-center gap-2 p-2 bg-sky-500 text-white rounded-md hover:bg-sky-600 transition-colors text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                                Twitter
                            </a>

                            <a id="whatsappShareBtn" href="#" target="_blank" rel="noopener noreferrer"
                                class="flex items-center justify-center gap-2 p-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                WhatsApp
                            </a>

                            <a id="telegramShareBtn" href="#" target="_blank" rel="noopener noreferrer"
                                class="flex items-center justify-center gap-2 p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                                </svg>
                                Telegram
                            </a>
                        </div>

                        <!-- Instagram-specific sharing -->
                        <div class="mb-4">
                            <a id="downloadForInstaBtn" href="#" download
                                class="w-full flex items-center justify-center gap-2 p-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-md hover:from-purple-600 hover:to-pink-600 transition-colors text-sm font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download untuk Instagram
                            </a>
                            <p class="mt-2 text-sm text-gray-500 text-center">Simpan gambar dan unggah ke Instagram
                                Stories atau Post</p>
                        </div>

                        <div class="pt-3 border-t">
                            <div class="relative mb-3">
                                <input type="text" id="shareLink" value="{{ route('hasiltes.show', $hasilTes->id) }}"
                                    class="w-full p-2 pr-20 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm"
                                    readonly>
                                <button type="button" onclick="copyShareLink()"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-indigo-500 text-white px-3 py-1 rounded-md text-sm hover:bg-indigo-600 transition-colors">
                                    Salin
                                </button>
                            </div>
                            <p id="copyMessage" class="text-green-600 text-sm hidden">Link berhasil disalin!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Profesi yang Cocok --}}
        <h3 class="mt-10 text-xl font-semibold text-purpleMain text-center">
            Profesi yang cocok dengan jurusan ini:
        </h3>

        {{-- Grid Saran Pekerjaan --}}
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
            if(!isset($jurusanList)) {
            $jurusanList = \App\Models\Jurusan::all();
            }

            $jurusanTerkait = null;
            foreach($jurusanList as $j) {
            if(isset($hasilTes->hasil) && strtolower($j->jurusan) == strtolower($hasilTes->hasil)) {
            $jurusanTerkait = $j;
            break;
            }
            }

            $saranPekerjaanList = [];
            if($jurusanTerkait) {
            $saranPekerjaanList = \App\Models\SaranPekerjaan::where('jurusan_id', $jurusanTerkait->id)->get();
            }
            @endphp

            @if(count($saranPekerjaanList) > 0)
            @foreach($saranPekerjaanList as $saranPekerjaan)
            <div
                class="bg-white border border-purple-100 rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden">
                <div class="h-48 bg-gray-100">
                    @if($saranPekerjaan->gambar)
                    <img src="{{ asset('storage/' . $saranPekerjaan->gambar) }}"
                        alt="{{ $saranPekerjaan->saran_pekerjaan }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-purple-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-purple-200" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                </div>

                <div class="p-4">
                    <h4 class="text-lg font-semibold text-purpleMain mb-1">
                        {{ $saranPekerjaan->saran_pekerjaan }}
                    </h4>
                    <div class="flex items-center text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-purple-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $jurusanTerkait->jurusan }}</span>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-span-full text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-purple-200 mb-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-purple-400">Belum ada saran pekerjaan untuk jurusan ini.</p>
            </div>
            @endif
        </div>

        <di>
            < {{-- Rekomendasi Sekolah --}} <h3 class="mt-16 text-lg font-semibold  text-purpleMain text-center">
                Rekomendasi Sekolah untuk jurusan ini:</h3>

                {{-- List Rekomendasi Sekolah --}}
                <div class="mt-6 bg-white shadow-md rounded-lg overflow-hidden">
                    @php
                    // Ambil sekolah berdasarkan jurusan yang terkait
                    $sekolahList = [];
                    if($jurusanTerkait) {
                    $sekolahList = \App\Models\Sekolah::where('jurusan_id', $jurusanTerkait->id)->orderBy('nama',
                    'asc')->get();
                    }
                    @endphp

                    @if(count($sekolahList) > 0)
                    <ul class="divide-y divide-purple-100">
                        @foreach($sekolahList as $sekolah)
                        <li class="p-4 hover:bg-purple-50 transition-colors rounded-lg">
                            <div class="flex items-center gap-4">
                                <div class="flex-shrink-0 bg-purple-100 p-3 rounded-full shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purpleMain" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base md:text-lg font-semibold text-purple-800">{{ $sekolah->nama }}
                                    </h4>
                                    {{-- Tambahkan info tambahan jika perlu, misalnya lokasi --}}
                                    {{-- <p class="text-sm text-gray-500">Kabupaten/Kota: {{ $sekolah->lokasi }}</p>
                                    --}}
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-purple-200 mb-3"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <p class="text-purple-400">Belum ada rekomendasi sekolah untuk jurusan ini.</p>
                    </div>
                    @endif

                </div>

    </div>
    {{-- Testimoni Section --}}
    {{-- Testimoni Section --}}
    <div class="mt-24 lg:mt-32 container mx-auto max-w-4xl px-4 pb-32 lg:pb-40">
        <div
            class="bg-white shadow-md rounded-xl p-6 border border-purple-100 transform transition-all duration-500 hover:shadow-lg animate-fadeIn">
            <h3 class="text-xl font-semibold text-purpleMain text-center mb-6">
                <span class="inline-block animate-slideDown">Bagikan Pengalaman Anda</span>
            </h3>

            {{-- Flash Messages --}}
            @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded animate-fadeInRight"
                role="alert">
                <p>{{ session('success') }}</p>
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded animate-fadeInRight"
                role="alert">
                <p>{{ session('error') }}</p>
            </div>
            @endif

            {{-- Testimoni Form --}}
            <form action="{{ route('testimoni.store') }}" method="POST" class="space-y-4 animate-fadeIn"
                style="animation-delay: 0.3s;">
                @csrf

                {{-- Hidden field for jurusan_id --}}
                <input type="hidden" name="jurusan_id" value="{{ $jurusanTerkait->id ?? '' }}">

                <div class="transition-all duration-300 transform hover:translate-y-[-2px]">
                    <label for="testimoni" class="block text-sm font-medium text-gray-700 mb-1">Testimoni Anda</label>
                    <textarea id="testimoni" name="testimoni" rows="4"
                        class="w-full rounded-md border border-purple-200 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 @error('testimoni') border-red-500 @enderror transition-all duration-300"
                        placeholder="Bagikan pengalaman atau kesan Anda tentang hasil tes jurusan ini...">{{ old('testimoni') }}</textarea>
                    @error('testimoni')
                    <p class="text-red-500 text-xs mt-1 animate-pulse">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="hidden" id="asal_sekolah" name="asal_sekolah"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 @error('asal_sekolah') border-red-500 @enderror"
                        value="{{ old('asal_sekolah') ?? Auth::user()->sekolah ?? '' }}"
                        placeholder="Masukkan nama sekolah Anda">
                    @error('asal_sekolah')
                    <p class="text-red-500 text-xs mt-1 animate-pulse">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-purpleMain text-white rounded-md hover:bg-purple-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transform hover:scale-105 hover:shadow-md animate-fadeIn"
                        style="animation-delay: 0.5s;">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Kirim Testimoni
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Add these animation styles to your CSS or in a style tag --}}
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.8s ease-in-out forwards;
        }

        .animate-fadeInRight {
            animation: fadeInRight 0.6s ease-out forwards;
        }

        .animate-slideDown {
            animation: slideDown 0.7s ease-out forwards;
        }
    </style>
</section>


@endsection
<script>
    // Functions untuk modal share
    let shareImageUrl = ''; // Variable to store the share image URL
    
    function openShareModal() {
        const modal = document.getElementById('shareModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Show loading indicator
        document.getElementById('shareImagePreview').src = '/images/loading.gif';
        
        // Generate share image
        fetch(`/api/hasil-tes/${hasilTesId}/generate-share-image`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update the image preview with the full URL
                    shareImageUrl = data.imageUrl;
                    
                    // Make sure the URL is absolute
                    if (!shareImageUrl.startsWith('http') && !shareImageUrl.startsWith('/')) {
                        shareImageUrl = '/' + shareImageUrl;
                    }
                    
                    document.getElementById('shareImagePreview').src = shareImageUrl;
                    
                    // Update share buttons with the image URL
                    updateShareButtons(shareImageUrl);
                } else {
                    console.error('Error generating share image:', data.message);
                    document.getElementById('shareImagePreview').src = '/images/error.png';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('shareImagePreview').src = '/images/error.png';
            });
    }
    
    function closeShareModal() {
        const modal = document.getElementById('shareModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    
    function updateShareButtons(imageUrl) {
        const shareText = `Hasil tes jurusan saya: ${hasilTesJurusan}! Cek di: `;
        const shareUrl = window.location.href;
        
        // Facebook
        document.getElementById('facebookShareBtn').href = 
            `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`;
        
        // Twitter
        document.getElementById('twitterShareBtn').href = 
            `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}&url=${encodeURIComponent(shareUrl)}`;
        
        // WhatsApp
        document.getElementById('whatsappShareBtn').href = 
            `https://wa.me/?text=${encodeURIComponent(shareText + shareUrl)}`;
        
        // Telegram
        document.getElementById('telegramShareBtn').href = 
            `https://telegram.me/share/url?url=${encodeURIComponent(shareUrl)}&text=${encodeURIComponent(shareText)}`;
        
        // Download button for Instagram - use fetch to get the image as blob
        const downloadButton = document.getElementById('downloadForInstaBtn');
        downloadButton.addEventListener('click', function(e) {
            e.preventDefault();
            // Prevent default to handle the download manually
            
            // Create a loading indicator or change button text
            this.innerHTML = '<span class="animate-spin mr-2">↻</span> Downloading...';
            
            // Fetch the image as a blob
            fetch(imageUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.blob();
                })
                .then(blob => {
                    // Create a blob URL
                    const blobUrl = URL.createObjectURL(blob);
                    
                    // Create a temporary anchor element
                    const a = document.createElement('a');
                    a.href = blobUrl;
                    a.download = `hasil-tes-jurusan-${hasilTesId}.png`;
                    document.body.appendChild(a);
                    
                    // Trigger the download
                    a.click();
                    
                    // Clean up
                    document.body.removeChild(a);
                    URL.revokeObjectURL(blobUrl);
                    
                    // Reset button
                    this.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download untuk Instagram
                    `;
                })
                .catch(error => {
                    console.error('Error downloading image:', error);
                    this.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Error! Try Again
                    `;
                });
        });
    }
    
    function copyShareLink() {
        const linkInput = document.getElementById('shareLink');
        linkInput.select();
        
        try {
            // Try the modern clipboard API first
            navigator.clipboard.writeText(linkInput.value)
                .then(() => {
                    showCopyMessage();
                })
                .catch(() => {
                    // Fallback to the older execCommand method
                    document.execCommand('copy');
                    showCopyMessage();
                });
        } catch (err) {
            // Final fallback
            document.execCommand('copy');
            showCopyMessage();
        }
    }
    
    function showCopyMessage() {
        // Tampilkan pesan
        const copyMessage = document.getElementById('copyMessage');
        copyMessage.classList.remove('hidden');
        
        // Sembunyikan pesan setelah 3 detik
        setTimeout(() => {
            copyMessage.classList.add('hidden');
        }, 3000);
    }
</script>