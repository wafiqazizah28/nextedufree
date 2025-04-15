@extends('pages.adminDashboard')

@section('content')
  <div class="w-full lg:mx-auto">
    <div class="flex justify-between items-center mb-4 px-4">
      <h1 class="text-2xl font-bold text-slate-800">Daftar Sekolah</h1>
      <a href="{{ route('components.admin.sekolah.create') }}"
         class="bg-indigo-700 text-white py-2 px-4 rounded-md hover:bg-indigo-800">
        Tambah Sekolah
      </a>
    </div>

    <div class="mb-10 w-full bg-white rounded-sm border border-[#BBBBBB] p-3">
      <form action="{{ route('components.admin.sekolah.index') }}" method="get" class="mb-4">
        <div class="flex items-center space-x-2">
          <input type="text" jurusan="search" name="search" placeholder="Search for sekolah"
                 class="w-full rounded-sm border border-[#BBBBBB] bg-white p-2 focus:outline-none focus:ring focus:ring-indigo-300"
                 value="{{ request('search') ?? '' }}" />
          <button type="submit"
                  class="bg-indigo-700 text-white py-2 px-4 rounded-md hover:bg-indigo-800">
            Search
          </button>
        </div>
      </form>

      @if ($sekolah->count())
        <div class="overflow-x-auto">
          <table class="w-full min-w-max table-auto">
            <thead>
              <tr class="bg-indigo-700 text-white">
                <th class="px-4 py-3 text-center">No</th>
                <th class="px-4 py-3 text-left">Nama Sekolah</th>
                <th class="px-4 py-3 text-left">Jurusan</th>
                <th class="px-4 py-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sekolah as $item)
                <tr class="border-b border-[#E5E7EB]">
                  <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                  <td class="px-4 py-3">{{ $item->nama }}</td>
                  <td class="px-4 py-3">{{ $item->jurusan->jurusan ?? '-' }}</td>
                  <td class="px-4 py-3">
                    <div class="flex justify-center space-x-2">
                      <a href="{{ route('components.admin.sekolah.edit', $item) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </a>
                      <form action="{{ route('components.admin.sekolah.destroy', $item) }}" method="post"
                            onsubmit="return confirm('Kamu Yakin?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

        <div class="mt-4">
          {{ $sekolah->links() }}
        </div>
      @else
        <h1 class="mt-2 mb-4 border p-3 text-center text-lg font-light text-primary lg:text-2xl">
          Tidak ada Sekolah.
        </h1>
      @endif
    </div>
  </div>
@endsection