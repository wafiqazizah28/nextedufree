@extends('pages.adminDashboard')

@section('content')
  <button class="btnnn mb-3 rounded-sm border-2 border-black bg-black py-3 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
    <a href="/artikels">Back</a>
  </button>

  <div class="w-full lg:mx-auto">
    <div class="mb-10 w-full">
      <div class="w-full rounded-sm border border-[#BBBBBB] bg-white p-5">
        <h1 class="text-xl font-semibold text-slate-800 lg:text-2xl">Tambah Artikel</h1>
        
        <form action="/artikels" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-4">
            <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="judul" id="judul" class="mt-1 w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
          </div>

          <div class="mb-4">
            <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
            <input type="text" name="jurusan" id="jurusan" class="mt-1 w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
          </div>

          <div class="mb-4">
            <label for="img" class="block text-sm font-medium text-gray-700">Gambar</label>
            <input type="file" name="img" id="img" class="mt-1 w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>

          <div class="mb-4">
            <label for="sinopsis" class="block text-sm font-medium text-gray-700">Sinopsis</label>
            <textarea name="sinopsis" id="sinopsis" rows="4" class="mt-1 w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
          </div>

          <div class="mb-4">
            <label for="link" class="block text-sm font-medium text-gray-700">Link</label>
            <input type="url" name="link" id="link" class="mt-1 w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500">
          </div>

          <button type="submit" class="rounded-sm border-2 border-black bg-black py-3 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
            Simpan
          </button>
        </form>
      </div>
    </div>
  </div>
@endsection
