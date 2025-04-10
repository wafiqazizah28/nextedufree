@extends('pages.adminDashboard')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Hasil Tes</h1>

    @if ($hasilTests)
    <table class="w-full min-w-[800px] text-slate-800 border-collapse">
        <thead class="text-slate-700">
          <tr>
            <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white sticky left-0 z-10">No</th>
            <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white sticky left-[50px] z-10">Nama</th>
            <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white sticky left-[200px] z-10">Email</th>
            <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white sticky left-[400px] z-10">Jurusan</th>
            <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white">No HP</th>
            <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white">Sekolah</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($hasilTests as $hasilTes)
            <tr class="text-center hover:bg-gray-50">
              <td class="border border-gray-300 px-4 py-2 sticky left-0 bg-white z-10">{{ $loop->iteration }}</td>
              <td class="border border-gray-300 px-4 py-2 text-left capitalize sticky left-[50px] bg-white z-10">{{ $hasilTes->user->nama ?? '-' }}</td>
              <td class="border-t border-b border-l border-gray-300 px-4 py-2 text-left lowercase sticky left-[200px] bg-white z-10">{{ $hasilTes->user->email ?? '-' }}</td>
              <td class="border-t border-b border-r border-gray-300 px-4 py-2 text-center sticky left-[400px] bg-white z-10">
                {{ $hasilTes->hasil ?? '-' }}
              </td>
              
              <td class="border border-gray-300 px-4 py-2 text-left">{{ $hasilTes->user->nomer_hp ?? 'Tidak ada' }}</td>
              <td class="border border-gray-300 px-4 py-2 text-left">{{ $hasilTes->user->sekolah ?? 'Tidak ada' }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
        <p class="text-red-500">Belum ada hasil tes.</p>
    @endif
</div>
@endsection
