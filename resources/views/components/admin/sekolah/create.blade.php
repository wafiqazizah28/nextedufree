@extends('pages.adminDashboard')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Sekolah</h1>

    <form action="{{ route('sekolah.store') }}" method="POST">
        @csrf
        <label for="nama">Nama Sekolah:</label>
        <input type="text" id="nama" name="nama" class="border p-2 rounded w-full">

        <label for="jurusan">Jurusan:</label>
        <input type="text" id="jurusan" name="jurusan" class="border p-2 rounded w-full">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Simpan</button>
    </form>
</div>
@endsection
