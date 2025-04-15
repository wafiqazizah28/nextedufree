@extends('layouts.app')

@section('content')
<section class="bg-white min-h-screen">
    <!-- Hero Banner Background -->
    <div class="relative w-full aspect-[16/9] sm:aspect-[16/8] md:aspect-[16/7] lg:min-h-[580px] bg-no-repeat bg-cover bg-center flex flex-col justify-center items-center px-4 sm:px-6 md:px-9"
        style="background-image: url('{{ asset('assets/img/banner2.png') }}');">

        <!-- Hero Content -->
        <div class="flex flex-col text-left max-w-xl ml-auto pr-6">
            <h1
                class="text-[1rem] xs:text-[1.2rem] sm:text-[1.75rem] lg:text-[2.22rem] text-white font-bold leading-tight mb-2 xs:mb-3 sm:mb-6">
                Informasi
                <a href="#artikel-list" class="text-white underline cursor-pointer">Artikel</a>
                untuk kamu!
            </h1>

            <div class="w-full max-w-full xs:max-w-sm sm:max-w-md mt-1 xs:mt-2 sm:mt-3">
                <form id="search-form" action="/artikel" method="get"
                    class="search-form flex items-center bg-white bg-opacity-90 rounded-lg px-2 xs:px-3 sm:px-4 py-1.5 xs:py-2 shadow-lg"
                    onsubmit="return validateSearchForm()">
                    <button type="submit" class="search-icon text-gray-600 mr-1.5 xs:mr-2 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 xs:h-4.5 sm:h-5 sm:w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <input id="search-input" type="text" name="search"
                        placeholder="Ingin mencari tahu info sekolah dan artikel lainnya?"
                        class="search-input w-full bg-transparent border-none focus:outline-none text-xs xs:text-xs sm:text-sm"
                        pattern="[A-Za-z0-9\s]+" title="Hanya huruf, angka, dan spasi yang diperbolehkan"
                        maxlength="100">
                </form>
            </div>

            <!-- Tambahkan styling ini di bagian head atau file CSS Anda -->
            <style>
                @media (max-width: 360px) {
                    .search-input::placeholder {
                        font-size: 10px;
                    }
                }
            </style>

            <script>
                function validateSearchForm() {
                const searchInput = document.getElementById('search-input');
                const searchValue = searchInput.value.trim();
                
                // Validasi input: hanya izinkan alfanumerik dan spasi
                const regex = /^[A-Za-z0-9\s]+$/;
                
                if (!regex.test(searchValue)) {
                    alert('Pencarian hanya boleh berisi huruf, angka, dan spasi.');
                    return false;
                }
                
                // Sanitasi input
                searchInput.value = searchValue
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
                
                return true;
            }
            
                document.getElementById("search-form").addEventListener("submit", function(event) {
                    event.preventDefault(); // Mencegah reload halaman
                    
                    let searchQuery = document.getElementById("search-input").value.trim();
                    if (!searchQuery) return; // Jika kosong, tidak melakukan apa-apa
            
                    let apiUrl = `/artikel/search?query=${encodeURIComponent(searchQuery)}`;
            
                    fetch(apiUrl)
                        .then(response => response.json())
                        .then(data => {
                            let artikelContainer = document.getElementById('artikel-list');
                            artikelContainer.innerHTML = ''; // Kosongkan hasil sebelumnya
            
                            if (data.length === 0) {
                                artikelContainer.innerHTML = '<p class="text-gray-500 col-span-1 sm:col-span-2 lg:col-span-4 text-center">Tidak ada artikel ditemukan.</p>';
                                return;
                            }
            
                            data.forEach(artikel => {
                                let imgPath = artikel.img ? `/storage/${artikel.img.replace(/^public\//, '')}` : '/assets/img/default-article.png';
                                
                                let artikelHTML = `
                                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                                        <img src="${imgPath}" alt="${artikel.judul}" class="w-full h-48 object-cover" 
                                             onerror="this.onerror=null; this.src='/assets/img/default-article.png';">
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-gray-800">${artikel.judul}</h3>
                                            <p class="text-sm text-gray-500 mt-2">${artikel.sinopsis ? artikel.sinopsis.substring(0, 80) + '...' : ''}</p>
                                            <a href="/artikel/${artikel.id}" class="mt-4 inline-block text-primary font-semibold">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                `;
                                artikelContainer.innerHTML += artikelHTML;
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            let artikelContainer = document.getElementById('artikel-list');
                            artikelContainer.innerHTML = '<p class="text-red-500 col-span-1 sm:col-span-2 lg:col-span-4 text-center">Terjadi kesalahan saat mencari artikel.</p>';
                        });
                });
            </script>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-20 bg-white py-8 sm:py-10 lg:py-12">
        <div class="container mx-auto px-4">
            <!-- Tabs Section -->
            @if (isset($kategoriList) && $kategoriList->isEmpty())
            <p class="text-gray-500 text-sm sm:text-base">Kategori tidak ditemukan.</p>
            @endif

            <div
                class="flex flex-wrap gap-3 sm:gap-4 md:space-x-4 lg:space-x-8 border-b-2 pb-2 overflow-x-auto scrollbar-hide">
                <button onclick="filterArtikel('all')"
                    class="category-btn text-gray-600 hover:text-secondary pb-2 border-b-2 border-transparent hover:border-secondary whitespace-nowrap text-sm sm:text-base px-2 sm:px-4"
                    data-id="all">
                    Semua
                </button>

                @if(isset($kategoriList))
                @foreach ($kategoriList as $kategori)
                <button onclick="filterArtikel({{ $kategori->id }})"
                    class="category-btn text-gray-600 hover:text-secondary pb-2 border-b-2 border-transparent hover:border-secondary whitespace-nowrap text-sm sm:text-base px-2 sm:px-4"
                    data-id="{{ $kategori->id }}">
                    {{ $kategori->nama_kategori }}
                </button>
                @endforeach
                @endif
            </div>

            <script>
                function filterArtikel(kategoriId) {
                    // First, remove highlighting from all buttons
                    document.querySelectorAll('.category-btn').forEach(btn => {
                        btn.classList.remove('text-secondary', 'border-secondary');
                        btn.classList.add('text-gray-600', 'border-transparent');
                    });
                    
                    // Add highlighting to the clicked button
                    const activeButton = document.querySelector(`.category-btn[data-id="${kategoriId}"]`);
                    if (activeButton) {
                        activeButton.classList.remove('text-gray-600', 'border-transparent');
                        activeButton.classList.add('text-secondary', 'border-secondary');
                    }

                    // Determine the API endpoint
                    let apiUrl = '/artikel/filter';
                    if (kategoriId === 'all') {
                        apiUrl += '?kategori=all';
                    } else {
                        apiUrl += `?kategori=${kategoriId}`;
                    }

                    // Add a loading indicator
                    let artikelContainer = document.getElementById('artikel-list');
                    artikelContainer.innerHTML = '<p class="text-gray-500 col-span-full text-center">Memuat artikel...</p>';

                    fetch(apiUrl)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            artikelContainer.innerHTML = '';

                            if (data.length === 0) {
                                artikelContainer.innerHTML = '<p class="text-gray-500 col-span-1 sm:col-span-2 lg:col-span-4 text-center">Tidak ada artikel ditemukan.</p>';
                                return;
                            }

                            data.forEach(artikel => {
                                // Fix image path handling
                                let imgPath = '/assets/img/default-article.png'; // Default image path
                                if (artikel.img) {
                                    // Handle different possible formats of image path
                                    if (artikel.img.startsWith('http')) {
                                        imgPath = artikel.img;
                                    } else if (artikel.img.startsWith('/storage/')) {
                                        imgPath = artikel.img;
                                    } else if (artikel.img.startsWith('storage/')) {
                                        imgPath = `/${artikel.img}`;
                                    } else {
                                        // Remove 'public/' if present as Storage::url handles this
                                        let cleanImgPath = artikel.img.replace(/^public\//, '');
                                        imgPath = `/storage/${cleanImgPath}`;
                                    }
                                }
                                
                                // Determine link URL - use artikel.id or fall back to artikel.link
                                let linkUrl = artikel.link ? artikel.link : `/artikel/${artikel.id}`;
                                
                                let artikelHTML = `
                                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                                        <img src="${imgPath}" alt="${artikel.judul}" class="w-full h-48 object-cover" 
                                             onerror="this.onerror=null; this.src='/assets/img/default-article.png';">
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-gray-800">${artikel.judul}</h3>
                                            <p class="text-sm text-gray-500 mt-2">${artikel.sinopsis ? artikel.sinopsis.substring(0, 80) + '...' : ''}</p>
                                            <a href="${linkUrl}" class="mt-4 inline-block text-primary font-semibold">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                `;
                                artikelContainer.innerHTML += artikelHTML;
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            artikelContainer.innerHTML = '<p class="text-red-500 col-span-1 sm:col-span-2 lg:col-span-4 text-center">Terjadi kesalahan saat memuat artikel.</p>';
                        });
                }

                // Add event listener to highlight the active category on page load
                document.addEventListener('DOMContentLoaded', function() {
                    // Get the current category from URL parameter if any
                    const urlParams = new URLSearchParams(window.location.search);
                    const currentCategory = urlParams.get('kategori') || 'all';
                    
                    // Highlight the appropriate button
                    const activeButton = document.querySelector(`.category-btn[data-id="${currentCategory}"]`);
                    if (activeButton) {
                        activeButton.classList.remove('text-gray-600', 'border-transparent');
                        activeButton.classList.add('text-secondary', 'border-secondary');
                    }
                    
                    // Always call filterArtikel when the page loads
                    filterArtikel(currentCategory);
                });
            </script>

            <!-- Articles Grid -->
            <div id="artikel-list"
                class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
                <!-- Articles will be loaded here via JavaScript -->
                <p class="text-gray-500 col-span-full text-center">Memuat artikel...</p>
            </div>
        </div>
    </div>
</section>
@endsection