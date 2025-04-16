@extends('pages.adminDashboard')

@section('content')
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-indigo-800">Daftar Testimoni</h1>
    <div class="flex space-x-2">
      <a href="{{ route('testimoni.export-pdf') }}" 
   class="inline-block rounded bg-green-600 py-2 px-4 text-white hover:bg-green-700 transition duration-300 text-sm">
  Save as PDF
</a>
    </div>
  </div>

  {{-- Wrapper Tabel Testimoni --}}
  <div class="mb-10 w-full bg-white rounded shadow-sm overflow-hidden border border-gray-200">
    {{-- Form Pencarian Testimoni --}}
    <form action="/testimoni" method="get" class="p-4 border-b">
      <div class="flex items-center space-x-2">
        <input type="text" id="search" name="search" placeholder="Cari testimoni"
               class="w-full rounded border border-gray-300 p-2 focus:outline-none focus:ring focus:ring-indigo-300 text-sm"
               value="{{ request('search') ?? '' }}" />
        <button type="submit"
                class="rounded bg-indigo-700 py-2 px-4 text-white hover:bg-indigo-800 transition duration-300 text-sm">
          Cari
        </button>
      </div>
    </form>

    {{-- Cek apakah ada data --}}
    @if ($testimonis->count())
      <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm">
          <thead>
            <tr class="bg-indigo-700 text-white">
              <th class="py-3 px-4 text-left border border-indigo-800">No</th>
              <th class="py-3 px-4 text-left border border-indigo-800">Nama User</th>
              <th class="py-3 px-4 text-left border border-indigo-800">Hasil Tes</th>
              <th class="py-3 px-4 text-left border border-indigo-800">Testimoni</th>
              <th class="py-3 px-4 text-left border border-indigo-800">Tanggal</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($testimonis as $index => $testimoni)
              <tr class="border-b hover:bg-gray-50">
                <td class="py-2 px-4 border border-gray-200">{{ ($testimonis->currentPage() - 1) * $testimonis->perPage() + $loop->iteration }}</td>
            
                <td class="py-2 px-4 border border-gray-200">{{ $testimoni->user->nama ?? 'User Tidak Diketahui' }}</td>
                <td class="py-2 px-4 border border-gray-200">
                  @if(isset($testimoni->Hasil))
                    {{ $testimoni->Hasil->hasil ?? 'Jurusan Tidak Diketahui' }}
                  @else
                    Jurusan Tidak Diketahui
                  @endif
                </td>
                <td class="py-2 px-4 text-justify border border-gray-200">{{ $testimoni->testimoni ?? 'Tidak Ada Testimoni' }}</td>
                <td class="py-2 px-4 border border-gray-200">{{ $testimoni->created_at ? $testimoni->created_at->format('d M Y') : '-' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- Pagination --}}
      <div class="p-4">
        {{ $testimonis->links() }}
      </div>
    @else
      <div class="p-6 text-center">
        <h1 class="text-sm text-gray-600">
          Tidak ada Testimoni.
        </h1>
      </div>
    @endif
  </div>
@endsection