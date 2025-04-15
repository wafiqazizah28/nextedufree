@extends('pages.adminDashboard')

@section('content')
  <div class="w-full max-w-full px-4 lg:px-6">
    <!-- Button Add Artikel -->
    <div class="flex justify-between items-center mb-6">
      <h1 class="font-medium text-xl text-slate-800 lg:text-2xl">Manajemen Artikel</h1>
      <a href="/artikels/create" class="rounded-md border-2 border-blue-700 bg-blue-700 py-2 px-4 text-white duration-300 ease-out hover:bg-white hover:text-blue-700 flex items-center shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        Tambah Artikel
      </a>
    </div>

    <!-- Artikel Table -->
    <div class="mb-10 w-full">
      <div class="w-full rounded-md border border-gray-300 bg-white p-4 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center justify-between px-4 mb-6">
          <h1 class="font-medium mt-3 mb-4 md:mb-0 text-lg text-slate-800 lg:text-xl">Daftar Artikel</h1>
          
          <form action="/artikels" method="get" class="w-full md:w-auto">
            <div class="flex flex-col sm:flex-row">
              <div class="relative flex-grow sm:mr-3">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </div>
                <input type="text" id="search" name="search" placeholder="Cari artikel..." value="{{ request('search') }}"
                  class="w-full rounded-md border-2 border-blue-700 bg-white p-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
              </div>
              <button type="submit"
                class="mt-2 sm:mt-0 rounded-md border-2 border-blue-700 bg-blue-700 py-2 px-4 text-white duration-300 ease-out hover:bg-white hover:text-blue-700 shadow-sm">
                Cari
              </button>
            </div>
          </form>
        </div>

        @if ($artikelList->count())
          <div class="w-full overflow-x-auto rounded-md">
            <table class="w-full min-w-[800px] text-slate-800 border-collapse">
              <thead class="text-slate-700">
                <tr>
                  <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white sticky left-0 z-10 w-12">No</th>
                  <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white">Judul</th>
                  <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white w-20">Gambar</th>
                  <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white">Sinopsis</th>
                  <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white w-16">Link</th>
                  <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white">Kategori</th>
                  <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white w-40">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($artikelList as $artikel)
                  <tr class="text-center hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 sticky left-0 bg-white z-10">{{ $loop->iteration }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-left">{{ $artikel->judul }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                      @if ($artikel->img)
                        <img src="{{ asset('storage/' . $artikel->img) }}" alt="Gambar Artikel" class="h-16 w-16 object-cover mx-auto rounded-lg">
                      @else
                        <span class="text-gray-500">Tidak ada gambar</span>
                      @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-left">
                      {{ Str::limit($artikel->sinopsis, 50) }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                      <a href="{{ $artikel->link }}" class="text-blue-500 hover:text-blue-700 underline" target="_blank">Baca</a>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-left">
                      {{ $artikel->kategori->nama_kategori ?? 'Tidak Ada Kategori' }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                      <div class="flex justify-center items-center space-x-2">
                         
                        <a href="/artikels/{{ $artikel->id }}/edit" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-full transition-colors" title="Edit">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                          </svg>
                        </a>
                        <form action="/artikels/{{ $artikel->id }}" method="post" onsubmit="return confirm('Kamu Yakin?')" class="inline">
                          @method('delete')
                          @csrf
                          <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-full transition-colors" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          
          <div class="mt-3 px-4 text-sm text-gray-600 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p>Geser ke kanan untuk melihat kolom lainnya</p>
          </div>
        @else
          <div class="mt-4 mb-6 border border-gray-300 rounded-md p-6 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            <h1 class="text-lg font-medium text-gray-700 lg:text-xl">
              Tidak ada artikel.
            </h1>
          </div>
        @endif

        <div class="px-4 mt-4">
          {{ $artikelList->links() }}
        </div>
      </div>
    </div>
    
    <!-- Kategori Artikel Table -->
    <div class="mb-10 w-full">
      <div class="w-full rounded-md border border-gray-300 bg-white p-4 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between px-4 mb-6">
          <h1 class="font-medium mb-4 sm:mb-0 text-lg text-slate-800 lg:text-xl">Kategori Artikel</h1>
          
          <a href="/artikels/kategori/create" class="sm:ml-auto rounded-md border-2 border-blue-700 bg-blue-700 py-2 px-4 text-white duration-300 ease-out hover:bg-white hover:text-blue-700 flex items-center justify-center shadow-sm w-full sm:w-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Tambah Kategori
          </a>
        </div>

        @if ($kategoriList->count())
          <div class="w-full overflow-x-auto rounded-md">
            <table class="w-full text-slate-800 border-collapse">
              <thead class="text-slate-700">
                <tr>
                  <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white w-16">ID</th>
                  <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white">Nama Kategori</th>
                  <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white w-40">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kategoriList as $kategori)
                  <tr class="text-center hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">{{ $kategori->id }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-left">{{ $kategori->nama_kategori }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                      <div class="flex justify-center items-center space-x-3">
                        <a href="/artikels/kategori/{{ $kategori->id }}/edit" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-full transition-colors" title="Edit">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                          </svg>
                        </a>
                        <form action="/artikels/kategori/{{ $kategori->id }}" method="post" onsubmit="return confirm('Kamu Yakin?')" class="inline">
                          @method('delete')
                          @csrf
                          <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-full transition-colors" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <div class="mt-4 mb-6 border border-gray-300 rounded-md p-6 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <h1 class="text-lg font-medium text-gray-700 lg:text-xl">
              Tidak ada kategori.
            </h1>
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- Add some custom CSS for better horizontal scrolling indicator -->
  <style>
    .overflow-x-auto::-webkit-scrollbar {
      height: 8px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 8px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
      background: #4A42A0;
      border-radius: 8px;
      border: 2px solid #f1f1f1;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
      background: #3a3480;
    }
    
    /* Untuk layar mobile */
    @media (max-width: 640px) {
      .flex-wrap {
        margin-bottom: -0.5rem;
      }
      
      .flex-wrap > * {
        margin-bottom: 0.5rem;
      }
    }
  </style>
@endsection