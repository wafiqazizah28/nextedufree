@extends('pages.adminDashboard')

@section('content')
  <div class="w-full max-w-full px-4 lg:px-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-indigo-800">Data Saran Pekerjaan</h1>
      <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
        <a href="/saranpekerjaan/create"
          class="inline-flex items-center justify-center rounded bg-indigo-700 py-2 px-4 text-white hover:bg-indigo-800 transition duration-300 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
          </svg>
          Tambah Data
        </a>
        <a href="/saranpekerjaan/export-pdf" 
          class="inline-flex items-center justify-center rounded bg-green-600 py-2 px-4 text-white hover:bg-green-700 transition duration-300 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Export PDF
        </a>
      </div>
    </div>

    {{-- Wrapper Tabel Saran Pekerjaan --}}
    <div class="mb-10 w-full bg-white rounded-md shadow-sm overflow-hidden border border-gray-200">
      {{-- Form Pencarian Saran Pekerjaan --}}
      <form action="/saranpekerjaan" method="get" class="p-4 border-b">
        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
          <div class="relative flex-grow">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
            <input type="text" id="search" name="search" placeholder="Cari saran pekerjaan..."
                   class="w-full rounded-md border border-gray-300 p-2 pl-10 focus:outline-none focus:ring-2 focus:ring-indigo-300 text-sm"
                   value="{{ request('search') ?? '' }}" />
          </div>
          <button type="submit"
                  class="rounded-md bg-indigo-700 py-2 px-4 text-white hover:bg-indigo-800 transition duration-300 text-sm flex-shrink-0">
            Cari
          </button>
        </div>
      </form>

      {{-- Cek apakah ada data --}}
      @if ($saranPekerjaanList->count())
        <div class="overflow-x-auto">
          <table class="w-full border-collapse text-sm">
            <thead>
              <tr class="bg-indigo-700 text-white">
                <th class="py-3 px-4 text-left border-b border-indigo-800">No</th>
                <th class="py-3 px-4 text-left border-b border-indigo-800">Nama Jurusan</th>
                <th class="py-3 px-4 text-left border-b border-indigo-800">Saran Pekerjaan</th>
                <th class="py-3 px-4 text-center border-b border-indigo-800">Gambar</th>
                <th class="py-3 px-4 text-center border-b border-indigo-800">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($saranPekerjaanList as $saranpekerjaan)
                <tr class="hover:bg-gray-50 border-b">
                  <td class="py-3 px-4">{{ ($saranPekerjaanList->currentPage() - 1) * 10 + $loop->iteration }}</td>
                  <td class="py-3 px-4">
                    @php
                      $jurusanName = '';
                      if (isset($jurusanInfo)) {
                        foreach ($jurusanInfo as $jurusan) {
                          if ($jurusan->id == $saranpekerjaan->jurusan_id) {
                            $jurusanName = $jurusan->jurusan;
                            break;
                          }
                        }
                      }
                      echo $jurusanName ?: '-';
                    @endphp
                  </td>
                  <td class="py-3 px-4 text-justify">{{ $saranpekerjaan->saran_pekerjaan }}</td>
                  <td class="py-3 px-4 text-center">
                    @if ($saranpekerjaan->gambar)
                      <img src="{{ asset('storage/' . $saranpekerjaan->gambar) }}" alt="Gambar Saran Pekerjaan" 
                           class="h-16 w-16 object-cover mx-auto rounded-md shadow-sm hover:scale-150 transition-transform duration-300">
                    @else
                      <div class="flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                      </div>
                    @endif
                  </td>
                  <td class="py-3 px-4">
                    <div class="flex justify-center items-center space-x-3">
                      {{-- Hapus tombol lihat --}}
                      <a href="/saranpekerjaan/{{ $saranpekerjaan->id }}/edit" class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-full transition-colors" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </a>
                      <form action="/saranpekerjaan/{{ $saranpekerjaan->id }}" method="post" onsubmit="return confirm('Kamu Yakin?')" class="inline">
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
        {{-- Pagination --}}
        <div class="p-4">
          {{ $saranPekerjaanList->links() }}
        </div>
      @else
        <div class="p-8 text-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
          </svg>
          <h1 class="text-lg font-medium text-gray-500">
            Tidak ada data Saran Pekerjaan.
          </h1>
        </div>
      @endif
    </div>
  </div>
@endsection
