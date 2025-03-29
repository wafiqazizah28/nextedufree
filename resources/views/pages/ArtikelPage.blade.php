

@extends('layouts.app')

@section('content')
<section class="pt-14 pb-12 lg:pt-24 bg-white min-h-screen">
    <!-- Hero Banner Background -->
    <div class="relative w-full min-h-[580px] flex flex-col justify-center items-end px-9 bg-no-repeat bg-cover bg-center text-right"
        style="background-image: url('{{ asset('assets/img/banner2.png') }}');">
        
        <!-- Hero Content -->
        <h1 class="text-3xl text-white lg:text-4xl font-bold leading-tight">
            Informasi <span class="text-white">Artikel</span> untuk kamu!
        </h1>

        <!-- Search Form -->
        <div class="w-full max-w-md mt-4 ml-auto">
            <form action="/artikels" method="get" class="flex items-center justify-end">
                <input type="text" name="search" placeholder="Cari artikel..."
                    class="w-full md:w-[250px] p-2 text-sm rounded-l-md border-2 border-gray-300 text-black focus:outline-none">
                <button type="submit" class="bg-secondary text-white px-4 py-2 text-sm rounded-r-md">Cari</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-20 bg-white py-12">
        <div class="container mx-auto px-4">
            <!-- Tabs Section -->
            @if ($kategoriList->isEmpty())
    <p class="text-gray-500">Kategori tidak ditemukan.</p>
@endif

<div class="flex space-x-8 border-b-2 pb-2">
    @foreach ($kategoriList as $kategori)
        <button onclick="filterArtikel({{ $kategori->id }})" 
            class="text-gray-600 hover:text-secondary pb-2 border-b-2 border-transparent hover:border-secondary">
            {{ $kategori->nama_kategori }}
        </button>
    @endforeach
</div>


<script>
    function filterArtikel(kategoriId) {
        fetch(`/artikels/filter?kategori=${kategoriId}`)
            .then(response => response.json())
            .then(data => {
                let artikelContainer = document.getElementById('artikel-list');
                artikelContainer.innerHTML = '';
    
                if (data.length === 0) {
                    artikelContainer.innerHTML = '<p class="text-gray-500">Tidak ada artikel ditemukan.</p>';
                    return;
                }
    
                data.forEach(artikel => {
                    let artikelHTML = `
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <img src="/${artikel.img}" alt="${artikel.judul}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800">${artikel.judul}</h3>
                                <p class="text-sm text-gray-500 mt-2">${artikel.sinopsis.substring(0, 80)}...</p>
                                <a href="${artikel.link}" class="mt-4 inline-block text-primary font-semibold">Baca Selengkapnya</a>
                            </div>
                        </div>
                    `;
                    artikelContainer.innerHTML += artikelHTML;
                });
            })
            .catch(error => console.error('Error:', error));
    }
    </script>
    
    

    <!-- Articles Grid -->
<div id="artikel-list" class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse ($artikelList as $artikel)
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="{{ Storage::url($artikel->img) }}" alt="{{ $artikel->judul }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $artikel->judul }}</h3>
                <p class="text-sm text-gray-500 mt-2">{{ Str::limit($artikel->sinopsis, 80) }}</p>
                <a href="{{ $artikel->link }}" class="mt-4 inline-block text-primary font-semibold">Baca Selengkapnya</a>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Tidak ada artikel ditemukan.</p>
    @endforelse
</div>


        </div>
    </div>
</section>
@endsection