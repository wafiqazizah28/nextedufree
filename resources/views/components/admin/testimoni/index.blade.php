@extends('pages.adminDashboard')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Testimoni</h1>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border">Foto</th>
                <th class="py-2 px-4 border">Nama User</th>
                <th class="py-2 px-4 border">Asal Sekolah</th>
                <th class="py-2 px-4 border">Jurusan</th>
                <th class="py-2 px-4 border">Testimoni</th>
                <th class="py-2 px-4 border">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($testimonis as $testimoni)
                <tr>
                    <td class="border px-4 py-2">
                        <img src="{{ $testimoni->user->foto_profil ? asset('storage/' . $testimoni->user->foto_profil) : asset('storage/default.png') }}" 
                             alt="Foto" class="w-12 h-12 rounded-full">
                    </td>
                    <td class="border px-4 py-2">{{ $testimoni->user->name ?? 'User Tidak Diketahui' }}</td>
                    <td class="border px-4 py-2">{{ $testimoni->user->asal_sekolah ?? 'Tidak Diketahui' }}</td>
                    <td class="border px-4 py-2">{{ $testimoni->jurusan->name ?? 'Jurusan Tidak Diketahui' }}</td>
                    <td class="border px-4 py-2">{{ $testimoni->testimoni ?? 'Tidak Ada Testimoni' }}</td>
                    <td class="border px-4 py-2">{{ $testimoni->created_at ? $testimoni->created_at->format('d M Y') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
