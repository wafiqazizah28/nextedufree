@extends('pages.adminDashboard')

@section('content')
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-indigo-800">Data Saran Pekerjaan</h1>
    <div class="flex space-x-2">
      <a href="/saranpekerjaan/create"
         class="inline-block rounded bg-indigo-700 py-2 px-4 text-white hover:bg-indigo-800 transition duration-300 text-sm">
        Tambah Data
      </a>
      <a href="/saranpekerjaan/export-pdf" 
         class="inline-block rounded bg-green-600 py-2 px-4 text-white hover:bg-green-700 transition duration-300 text-sm">
        Save as PDF
      </a>
    </div>
  </div>

  {{-- Wrapper Tabel Saran Pekerjaan --}}
  <div class="mb-10 w-full bg-white rounded shadow-sm overflow-hidden border border-gray-200">
    {{-- Form Pencarian Saran Pekerjaan --}}
    <form action="/saranpekerjaan" method="get" class="p-4 border-b">
      <div class="flex items-center space-x-2">
        <input type="text" id="search" name="search" placeholder="Search for saran pekerjaan"
               class="w-full rounded border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-indigo-300 text-sm"
               value="{{ request('search') ?? '' }}" />
        <button type="submit"
                class="rounded bg-indigo-700 py-2 px-4 text-white hover:bg-indigo-800 transition duration-300 text-sm">
          Search
        </button>
      </div>
    </form>

    {{-- Cek apakah ada data --}}
    @if ($saranPekerjaanList->count())
      <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
          <thead>
            <tr class="bg-indigo-700 text-white">
              <th class="py-3 px-4 text-left border border-indigo-800">No</th>
              <th class="py-3 px-4 text-left border border-indigo-800">Nama Jurusan</th>
              <th class="py-3 px-4 text-left border border-indigo-800">Saran Pekerjaan</th>
              <th class="py-3 px-4 text-center border border-indigo-800">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($saranPekerjaanList as $saranpekerjaan)
              <tr class="border-b hover:bg-gray-50">
                <td class="py-2 px-4 border border-gray-200">{{ ($saranPekerjaanList->currentPage() - 1) * 10 + $loop->iteration }}</td>
                <td class="py-2 px-4 border border-gray-200">
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
                <td class="py-2 px-4 text-justify border border-gray-200">{{ $saranpekerjaan->saran_pekerjaan }}</td>
                <td class="py-2 px-4 border border-gray-200">
                  <div class="flex justify-center items-center space-x-2">
                    <a href="/saranpekerjaan/{{ $saranpekerjaan->id }}/edit" class="p-1">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </a>
                    <form action="/saranpekerjaan/{{ $saranpekerjaan->id }}" method="post" onsubmit="return confirm('Kamu Yakin?')">
                      @method('delete')
                      @csrf
                      <button type="submit" class="p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
      <div class="p-6 text-center">
        <h1 class="text-sm text-gray-600">
          Tidak ada Saran Pekerjaan.
        </h1>
      </div>
    @endif
  </div>
@endsection