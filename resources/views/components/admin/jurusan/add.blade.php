@extends('pages.adminDashboard')

@section('content')
  <div class="w-full self-center px-4">
    <div class="flex flex-wrap">
      <div class="self-center lg:w-2/3">
        <div class="space-beetween flex">
          <h1 class="text-2xl font-bold text-indigo-800 lg:text-3xl">
            Add <span class="text-indigo-600">Jurusan</span>
          </h1>
          <a href="/jurusan" 
             class="ml-5 rounded bg-indigo-700 py-2 px-5 text-white hover:bg-indigo-800 transition duration-300 text-sm">
            Back
          </a>
        </div>
        
        @if(session('error'))
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
          </div>
        @endif
        
        <form class="mt-5" method="post" action="/jurusan" enctype="multipart/form-data">
          @csrf
          <div class="w-full lg:mx-auto">
            <div class="mb-4 w-full px-4">
              <label for="jurusan_code" class="text-base font-bold text-indigo-800">
                Jurusan Code
              </label>
              <input type="text" id="jurusan_code" name="jurusan_code" value="{{ old('jurusan_code') }}"
              class="@error('jurusan_code') border-red-500 @else border-gray-300 @enderror w-full rounded border bg-white p-3 focus:outline-none focus:ring focus:ring-indigo-500" />
              @error('jurusan_code')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-4 w-full px-4">
              <label for="jurusan" class="text-base font-bold text-indigo-800">
                Jurusan
              </label>
              <input type="text" id="jurusan" name="jurusan" value="{{ old('jurusan') }}"
                class="@error('jurusan') border-red-500 @else border-gray-300 @enderror w-full rounded border bg-white p-3 focus:outline-none focus:ring focus:ring-indigo-500" />
              @error('jurusan')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-4 w-full px-4">
              <label for="jenis" class="text-base font-bold text-indigo-800">
                Jenis
              </label>
              <input type="text" id="jenis" name="jenis" value="{{ old('jenis') }}"
                class="@error('jenis') border-red-500 @else border-gray-300 @enderror w-full rounded border bg-white p-3 focus:outline-none focus:ring focus:ring-indigo-500" />
              @error('jenis')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-4 w-full px-4">
              <label for="deskripsi" class="text-base font-bold text-indigo-800">
                Deskripsi
              </label>
              <textarea id="deskripsi" name="deskripsi"
                class="@error('deskripsi') border-red-500 @else border-gray-300 @enderror h-[100px] w-full rounded border bg-white p-3 focus:outline-none focus:ring focus:ring-indigo-500">{{ old('deskripsi') }}</textarea>
              @error('deskripsi')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-4 w-full px-4">
              <label for="img" class="text-base font-bold text-indigo-800">
                Upload Image
              </label>
              <input type="file" id="img" name="img"
                class="@error('img') border-red-500 @else border-gray-300 @enderror w-full rounded border bg-white p-3 focus:outline-none focus:ring focus:ring-indigo-500" />
              @error('img')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mt-10 w-full px-4">
              <button type="submit"
                class="w-full rounded bg-indigo-700 py-3 px-8 text-white hover:bg-indigo-800 transition duration-300 focus:outline-none focus:ring focus:ring-indigo-500">
                Add Jurusan
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection