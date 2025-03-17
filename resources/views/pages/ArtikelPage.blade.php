@extends('layouts.app')

@section('content')
<section class="pt-10 pb-12 lg:pt-20 bg-white min-h-screen">
  <!-- Hero Banner Section -->
    <div class="relative h-screen bg-cover bg-top flex flex-col justify-center items-center" 
         style="background-image: url('{{ asset('assets/img/banner2.png') }}');">
    </div>

    <!-- Main Content Section -->
    <div class="container">
        <!-- Welcome Text -->
        <div class="w-full self-center px-4">
            <h1 class="text-base font-medium text-primary md:text-xl">
                Welcome to
                <p class="mt-1 block text-4xl font-bold text-secondary lg:text-5xl">
                    next<span class="text-primary">Edu</span>.
                </p>
            </h1>
            <h2 class="mt-2 text-lg font-light text-primary lg:text-2xl">Education Platform.</h2>
        </div>

        <!-- Search Form -->
        <form action="/artikels" method="get">
            <div class="w-full self-center px-4">
                <div class="flex flex-col md:flex-row">
                    <input type="text" 
                           id="search" 
                           name="search" 
                           placeholder="Search for articles"
                           class="bayangan_field my-2 w-full rounded-sm border-2 border-[#030723] bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500 md:my-4 lg:w-1/2" />
                    <button type="submit"
                            class="btnnn my-2 mx-3 rounded-sm border-2 border-black bg-black py-3 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black md:my-4">
                        Search
                    </button>
                </div>
            </div>
        </form>

        <!-- Articles Grid -->
        @if ($artikelList->count())
            <!-- Pagination Links Top -->
            <div class="mx-4 mt-2">
                {{ $artikelList->links() }}
            </div>

            <!-- Articles Grid -->
            <div class="mt-5 grid w-full grid-cols-1 flex-wrap gap-5 px-4 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($artikelList as $artikel)
                    <div class="mb-5 flex flex-col justify-between rounded-sm border-2 border-primary bg-white p-4 shadow-lg">
                        <!-- Article Image -->
                        <div class="h-[170px] overflow-hidden rounded-sm border-2 border-secondary shadow-lg">
                            <img src="{{ $artikel['img'] }}" 
                                 alt="{{ $artikel['name'] }}" 
                                 class="h-full w-full object-cover" />
                        </div>

                        <!-- Article Content -->
                        <h3 class="mt-5 mb-3 text-xl font-semibold text-secondary">
                            {{ $artikel['name'] }}
                        </h3>

                        <p class="my-3 text-justify text-primary">
                            Category: <span class="font-light text-slate-700">{{ $artikel['category'] }}</span>
                        </p>

                        <p class="my-3 text-justify text-primary">
                            Description: <span class="font-light text-slate-700">{{ $artikel['description'] }}</span>
                        </p>


                        <!-- Detail Button -->
                        <button class="w-full place-self-end rounded-sm border-2 border-black bg-black py-3 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black hover:shadow-xl md:my-4">
                            <a href="/artikels/{{ $artikel['id'] }}">Detail</a>
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links Bottom -->
            <div class="mx-4 mt-2">
                {{ $artikelList->links() }}
            </div>

        @else
            <!-- No Articles Found Message -->
            <div class="mx-4 mt-5 w-full rounded-sm border border-[#BBBBBB] bg-white p-3">
                <h1 class="mt-2 mb-4 text-center text-lg font-light text-primary lg:text-2xl">
                    Articles Not Found.
                </h1>
            </div>
        @endif
    </div>
</section>
@endsection