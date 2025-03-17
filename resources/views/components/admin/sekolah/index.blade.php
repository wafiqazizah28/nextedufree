@extends('pages.adminDashboard')

@section('content')
  {{-- Tombol Tambah Sekolah --}}
  <div class="flex justify-between items-center mb-4 px-4">
    <h1 class="text-2xl font-bold text-slate-800">Daftar Sekolah</h1>
    <a href="{{ route('sekolah.create') }}"
       class="inline-block rounded-sm border-2 border-black bg-black py-2 px-4 text-white duration-300 ease-out hover:bg-white hover:text-black">
      Tambah Sekolah
    </a>
  </div>

  {{-- Wrapper Tabel Sekolah --}}
  <div class="mb-10 w-full bg-white rounded-sm border border-[#BBBBBB] p-3 lg:mx-auto">
    {{-- Form Pencarian Sekolah --}}
    <form action="{{ route('sekolah.index') }}" method="get" class="mb-4">
      <div class="flex items-center space-x-2">
        <input type="text" id="search" name="search" placeholder="Search for sekolah"
               class="w-full rounded-sm border-2 border-[#030723] bg-white p-2 focus:outline-none focus:ring focus:ring-blue-500"
               value="{{ request('search') ?? '' }}" />
        <button type="submit"
                class="rounded-sm border-2 border-black bg-black py-2 px-4 text-white duration-300 ease-out hover:bg-white hover:text-black">
          Search
        </button>
      </div>
    </form>

    {{-- Cek apakah ada data --}}
    @if ($sekolahs->count())
      <div class="overflow-x-auto">
        <table class="w-full border-collapse rounded-xl text-slate-800">
          <thead>
            <tr class="bg-slate-50 text-slate-700 text-sm uppercase">
              <th class="border px-6 py-3">No</th>
              <th class="border px-6 py-3">Nama Sekolah</th>
              <th class="border px-6 py-3">Jurusan</th>
              <th class="border px-6 py-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sekolahs as $sekolah)
              <tr class="text-center hover:bg-gray-50">
                <td class="border px-6 py-2">{{ $loop->iteration }}</td>
                <td class="border px-6 py-2">{{ $sekolah->nama }}</td>
                <td class="border px-6 py-2">{{ $sekolah->jurusan->name ?? '-' }}</td>
                <td class="border px-6 py-2">
                  <div class="flex justify-center items-center space-x-2">
                    <a class="text-yellow-400 hover:text-yellow-600"
                       href="{{ route('sekolah.edit', $sekolah) }}">
                      Edit
                    </a>
                    <form action="{{ route('sekolah.destroy', $sekolah) }}" method="post"
                          onsubmit="return confirm('Kamu Yakin?')">
                      @csrf
                      @method('DELETE')
                      <button class="text-red-400 hover:text-red-600" type="submit">
                        Delete
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
      <div class="mt-4">
        {{ $sekolahs->links() }}
      </div>
    @else
      <h1 class="mt-2 mb-4 border p-3 text-center text-lg font-light text-primary lg:text-2xl">
        Tidak ada Sekolah.
      </h1>
    @endif
  </div>
@endsection
