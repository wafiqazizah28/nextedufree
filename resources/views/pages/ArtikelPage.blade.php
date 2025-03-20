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

        <!-- Search Form (Dikecilkan dan Digeser ke Kanan) -->
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
            <div class="flex space-x-8 border-b-2">
                <a href="#" class="text-secondary font-semibold pb-2 border-b-2 border-secondary">Sekolah</a>
                <a href="#" class="text-gray-600 pb-2">Kerja</a>
            </div>

            <!-- Articles Grid -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($artikelList as $artikel)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ $artikel['img'] }}" alt="{{ $artikel['name'] }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $artikel['name'] }}</h3>
                            <p class="text-sm text-gray-500 mt-2">{{ Str::limit($artikel['description'], 80) }}</p>
                            <a href="/artikels/{{ $artikel['id'] }}" class="mt-4 inline-block text-primary font-semibold">Baca Selengkapnya</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
