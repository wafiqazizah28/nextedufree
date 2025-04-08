@extends('pages.adminDashboard')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Hasil Tes</h1>

    @if ($hasilTes)
        <div class="bg-white p-4 shadow-md rounded-md">
            <p class="mb-2"><strong>Nama User:</strong> {{ auth()->user()->name }}</p>
            <p class="mb-2"><strong>Hasil Jurusan:</strong> {{ $hasilTes->hasil }}</p>
            <p class="mb-2"><strong>Tanggal Tes:</strong> {{ $hasilTes->created_at->format('d M Y') }}</p>
        </div>

        <h2 class="text-xl font-semibold mt-6 mb-2">Informasi Jurusan</h2>
        @if ($jurusan)
            <div class="bg-gray-100 p-4 rounded-md">
                <p><strong>Nama Jurusan:</strong> {{ $jurusan->nama_jurusan }}</p>
                <p><strong>Deskripsi:</strong> {{ $jurusan->deskripsi }}</p>
            </div>
        @else
            <p class="text-red-500">Informasi jurusan tidak tersedia.</p>
        @endif

        <h2 class="text-xl font-semibold mt-6 mb-2">Saran Pekerjaan</h2>
        @if ($saranPekerjaan->isNotEmpty())
            <ul class="list-disc ml-6">
                @foreach ($saranPekerjaan as $pekerjaan)
                    <li>{{ $pekerjaan->saran_pekerjaan }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">Belum ada saran pekerjaan untuk jurusan ini.</p>
        @endif
    @else
        <p class="text-red-500">Belum ada hasil tes.</p>
    @endif
</div>
@endsection
