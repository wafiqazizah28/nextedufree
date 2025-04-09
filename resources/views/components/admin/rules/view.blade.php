@extends('pages.adminDashboard')

@section('content')
<div class="w-full lg:mx-auto">
  <div class="w-full rounded-sm border border-[#BBBBBB] bg-white p-3">
    <div class="flex items-center justify-between px-4">
      <h1 class="font-base mx-3 mt-3 mb-5 text-lg text-slate-800 lg:text-2xl">Data Tabel</h1>
      <button class="bg-indigo-700 text-white py-2 px-4 rounded-md hover:bg-indigo-800">Tambah Data</button>
    </div>

    <div class="overflow-x-auto">
      @if (count($jurusanRelations ?? []))
        <table class="w-full min-w-max table-auto">
          <thead>
            <tr class="bg-indigo-700 text-white">
              <th class="px-4 py-3 text-center">Kode Jurusan</th>
              <th class="px-4 py-3 text-left">Nama Jurusan</th>
              @foreach ($pertanyaanInfo as $pertanyaan)
                <th class="px-4 py-3 text-center">{{ $pertanyaan['pertanyaan_code'] }}</th>
              @endforeach
              <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($jurusanRelations as $jurusan)
              <tr class="border-b border-[#E5E7EB]">
                <td class="px-4 py-3 text-center">{{ $jurusan['id'] }}</td>
                <td class="px-4 py-3 text-left">{{ $jurusan['name'] }}</td>
                @foreach ($jurusan['rules'] as $rule)
                  <td class="px-4 py-3 text-center">{{ $rule ? '✓' : '-' }}</td>
                @endforeach
                <td class="px-4 py-3">
                  <div class="flex justify-center space-x-2">
                    <a href="/rules/{{ $jurusan['id'] }}/edit">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </a>
                    
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <h1 class="mt-2 mb-4 border p-3 text-center text-lg font-light text-primary lg:text-2xl">
          There is no Rules.
        </h1>
      @endif
    </div>
  </div>
</div>
@endsection