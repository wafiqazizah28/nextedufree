{{-- @dd($solutions); --}}

@extends('pages.adminDashboard')

@section('content')
  {{-- Tombol Add Jurusan --}}
  <div class="flex justify-between items-center mb-4 px-4">
    <h1 class="text-2xl font-bold text-slate-800">Jurusan Table</h1>
    <a href="/jurusans/create"
       class="inline-block rounded-sm border-2 border-black bg-black py-2 px-4 text-white duration-300 ease-out hover:bg-white hover:text-black">
      Add Jurusans
    </a>
  </div>

  {{-- Wrapper Tabel Jurusan --}}
  <div class="mb-10 w-full bg-white rounded-sm border border-[#BBBBBB] p-3 lg:mx-auto">
    {{-- Form Pencarian Jurusan --}}
    <form action="/jurusans" method="get" class="mb-4">
      <div class="flex items-center space-x-2">
        <input type="text" id="search" name="search" placeholder="Search for jurusans"
               class="w-full rounded-sm border-2 border-[#030723] bg-white p-2 focus:outline-none focus:ring focus:ring-blue-500"
               value="{{ request('search') ?? '' }}" />
        <button type="submit"
                class="rounded-sm border-2 border-black bg-black py-2 px-4 text-white duration-300 ease-out hover:bg-white hover:text-black">
          Search
        </button>
      </div>
    </form>

    {{-- Cek apakah ada data --}}
    @if ($jurusanList->count())
      <div class="overflow-x-auto">
        <table class="w-full border-collapse rounded-xl text-slate-800">
          <thead>
            <tr class="bg-slate-50 text-slate-700 text-sm uppercase">
              <th class="border px-6 py-3">No</th>
              <th class="border px-6 py-3">Jurusan Code</th>
              <th class="border px-6 py-3">Jurusan</th>
              <th class="border px-6 py-3">Type</th>
              <th class="border px-6 py-3">Description</th>
              <th class="border px-6 py-3 text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($jurusanList as $jurusan)
              <tr class="text-center hover:bg-gray-50">
                <td class="border px-6 py-2">{{ $loop->iteration }}</td>
                <td class="border px-6 py-2">{{ $jurusan->jurusan_code }}</td>
                <td class="border px-6 py-2">{{ $jurusan->jurusan }}</td>
                <td class="border px-6 py-2">{{ $jurusan->type ?? '-' }}</td>
                <td class="border px-6 py-2 text-justify">{{ $jurusan->description ?? '-' }}</td>
                <td class="border px-6 py-2">
                  <div class="flex justify-center items-center space-x-2">
                    <a class="text-blue-400 hover:text-blue-600"
                       href="/jurusans/{{ $jurusan->id }}">
                      View
                    </a>
                    <a class="text-yellow-400 hover:text-yellow-600"
                       href="/jurusans/{{ $jurusan->id }}/edit">
                      Edit
                    </a>
                    <form action="/jurusans/{{ $jurusan->id }}" method="post"
                          onsubmit="return confirm('Kamu Yakin?')">
                      @method('delete')
                      @csrf
                      <button class="text-red-400 hover:text-red-600"
                              type="submit">
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
        {{ $jurusanList->links() }}
      </div>
    @else
      <h1 class="mt-2 mb-4 border p-3 text-center text-lg font-light text-primary lg:text-2xl">
        Tidak ada Jurusan.
      </h1>
    @endif
  </div>

  {{-- Saran Pekerjaan Section --}}
  <div class="flex justify-between items-center mb-4 px-4">
    <h1 class="text-2xl font-bold text-slate-800">Saran Pekerjaan Table</h1>
    <a href="/saranpekerjaans/create"
       class="inline-block rounded-sm border-2 border-black bg-black py-2 px-4 text-white duration-300 ease-out hover:bg-white hover:text-black">
      Add SaranPekerjaans
    </a>
  </div>

  <div class="mb-10 w-full bg-white rounded-sm border border-[#BBBBBB] p-3 lg:mx-auto">
    {{-- Form Pencarian Saran Pekerjaan --}}
    <form action="/saranpekerjaans" method="get" class="mb-4">
      <div class="flex items-center space-x-2">
        <input type="text" id="searchSol" name="searchSol" placeholder="Search for saranpekerjaans"
               class="w-full rounded-sm border-2 border-[#030723] bg-white p-2 focus:outline-none focus:ring focus:ring-blue-500"
               value="{{ request('searchSol') ?? '' }}" />
        <button type="submit"
                class="rounded-sm border-2 border-black bg-black py-2 px-4 text-white duration-300 ease-out hover:bg-white hover:text-black">
          Search
        </button>
      </div>
    </form>

    @if ($saranPekerjaanList->count())
      <div class="overflow-x-auto">
        <table class="w-full border-collapse rounded-xl text-slate-800">
          <thead>
            <tr class="bg-slate-50 text-slate-700 text-sm uppercase">
              <th class="border px-6 py-3">No</th>
              <th class="border px-6 py-3">Jurusan</th>
              <th class="border px-6 py-3">Saran Pekerjaan</th>
              <th class="border px-6 py-3 text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($saranPekerjaanList as $saranpekerjaan)
              <tr class="text-center hover:bg-gray-50">
                <td class="border px-6 py-2">{{ $loop->iteration }}</td>
                <td class="border px-6 py-2">
                  {{ $saranpekerjaan->jurusan->jurusans ?? 'N/A' }}
                </td>
                <td class="border px-6 py-2 text-justify">
                  {{ $saranpekerjaan->saranpekerjaan }}
                </td>
                <td class="border px-6 py-2">
                  <div class="flex justify-center items-center space-x-2">
                    <a class="text-yellow-400 hover:text-yellow-600"
                       href="/saranpekerjaans/{{ $saranpekerjaan->id }}/edit">
                      Edit
                    </a>
                    <form action="/saranpekerjaans/{{ $saranpekerjaan->id }}" method="post"
                          onsubmit="return confirm('Kamu Yakin?')">
                      @method('delete')
                      @csrf
                      <button class="text-red-400 hover:text-red-600"
                              type="submit">
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
        {{ $saranPekerjaanList->links() }}
      </div>
    @else
      <h1 class="mt-2 mb-4 border p-3 text-center text-lg font-light text-primary lg:text-2xl">
        Tidak ada Saran Pekerjaan.
      </h1>
    @endif
  </div>
@endsection
