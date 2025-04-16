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

        <div>
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
                {{-- Testimoni Form --}}
                @php
                // Check if the user has already submitted a testimoni for this test result
                $existingTestimoni = null;
                if(auth()->check() && isset($hasilTes->id)) {
                $existingTestimoni = \App\Models\Testimoni::where('user_id', auth()->id())
                ->where('hasil', $hasilTes->id)
                ->first();
                }
                @endphp

                <form action="{{ route('testimoni.store') }}" method="POST" class="space-y-4 animate-fadeIn"
                    style="animation-delay: 0.3s;">
                    @csrf

                    {{-- Hidden field for hasil (previously jurusan_id) --}}
                    <input type="hidden" name="hasil" value="{{ $hasilTes->id ?? '' }}">

                    <div class="transition-all duration-300 transform hover:translate-y-[-2px]">
                        <label for="testimoni" class="block text-sm font-medium text-gray-700 mb-1">Testimoni
                            Anda</label>
                        <textarea id="testimoni" name="testimoni" rows="4"
                            class="w-full rounded-md border border-purple-200 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50 @error('testimoni') border-red-500 @enderror transition-all duration-300"
                            placeholder="Bagikan pengalaman atau kesan Anda tentang hasil tes jurusan ini..." {{
                            $existingTestimoni ? 'disabled' : ''
                            }}>{{ $existingTestimoni ? $existingTestimoni->testimoni : old('testimoni') }}</textarea>
                        @error('testimoni')
                        <p class="text-red-500 text-xs mt-1 animate-pulse">{{ $message }}</p>
                        @enderror

                        @if($existingTestimoni)
                        <p class="text-purple-500 text-xs mt-1">Anda sudah memberikan testimoni untuk hasil tes ini.</p>
                        @endif
                    </div>

                    <div class="flex justify-end">
                        @if(!$existingTestimoni)
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
                        @else
                        <button type="button" disabled
                            class="px-4 py-2 bg-purpleMain text-white rounded-md hover:bg-purple-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transform hover:scale-105 hover:shadow-md animate-fadeIn opacity-70 cursor-not-allowed"
                            style="animation-delay: 0.5s;">
                            <span class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Testimoni Terkirim
                            </span>
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- Animation styles --}}
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