@extends('pages.adminDashboard')

@section('content')
  <div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-indigo-800">Edit Jurusan</h1>
    <a href="/jurusan"
       class="inline-block rounded bg-indigo-700 py-2 px-4 text-white hover:bg-indigo-800 transition duration-300 text-sm">
      Kembali
    </a>
  </div>

  <div class="w-full bg-white rounded shadow-sm overflow-hidden border border-gray-200 p-6">
    <form method="post" action="/jurusan/{{ $jurusan->id }}" enctype="multipart/form-data">
      @method('put')
      @csrf
      
      <!-- Jurusan Code -->
      <div class="mb-4">
        <label for="jurusan_code" class="block text-sm font-medium text-gray-700 mb-1">
          Kode Jurusan
        </label>
        <input type="text" id="jurusan_code" name="jurusan_code"
          value="{{ old('jurusan_code', $jurusan->jurusan_code) }}"
          class="w-full rounded border @error('jurusan_code') border-red-500 @else border-gray-300 @enderror p-2 focus:outline-none focus:ring focus:ring-indigo-300 text-sm" />
        @error('jurusan_code')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Jurusan Name -->
      <div class="mb-4">
        <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-1">
          Nama Jurusan
        </label>
        <input type="text" id="jurusan" name="jurusan" 
          value="{{ old('jurusan', $jurusan->jurusan) }}"
          class="w-full rounded border @error('jurusan') border-red-500 @else border-gray-300 @enderror p-2 focus:outline-none focus:ring focus:ring-indigo-300 text-sm" />
        @error('jurusan')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Jenis Jurusan -->
      <div class="mb-4">
        <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">
          Jenis
        </label>
        <input type="text" id="jenis" name="jenis" 
          value="{{ old('jenis', $jurusan->jenis) }}"
          class="w-full rounded border @error('jenis') border-red-500 @else border-gray-300 @enderror p-2 focus:outline-none focus:ring focus:ring-indigo-300 text-sm" />
        @error('jenis')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Deskripsi Jurusan -->
      <div class="mb-4">
        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">
          Deskripsi
        </label>
        <textarea id="deskripsi" name="deskripsi" rows="4"
          class="w-full rounded border @error('deskripsi') border-red-500 @else border-gray-300 @enderror p-2 focus:outline-none focus:ring focus:ring-indigo-300 text-sm">{{ old('deskripsi', $jurusan->deskripsi) }}</textarea>
        @error('deskripsi')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <!-- Upload Image -->
      <div class="mb-4">
        <label for="img" class="block text-sm font-medium text-gray-700 mb-1">
          Upload Gambar
        </label>
        <input type="file" id="img" name="img"
          class="w-full rounded border @error('img') border-red-500 @else border-gray-300 @enderror p-2 focus:outline-none focus:ring focus:ring-indigo-300 text-sm" />
        @error('img')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
        
        @if($jurusan->img)
          <div class="mt-2">
            <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
            <img src="{{ asset('storage/' . $jurusan->img) }}" alt="{{ $jurusan->jurusan }}" class="w-16 h-16 object-cover rounded">
          </div>
        @endif
      </div>

      <!-- Update Button -->
      <div class="mt-6">
        <button type="submit"
          class="w-full rounded bg-indigo-700 py-2 px-4 text-white hover:bg-indigo-800 transition duration-300 text-sm">
          Update Jurusan
        </button>
      </div>
    </form>
  </div>
@endsection