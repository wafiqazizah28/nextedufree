@extends('pages.adminDashboard')
@section('content')
  <div class="w-full self-center px-6">
    <div class="flex flex-wrap">
      <div class="self-center lg:w-3/4">
        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-bold text-blue-700 lg:text-3xl">
            Tambah <span class="text-purple-600">pertanyaan</span>
          </h1>
          <button
            class="ml-5 rounded-md border-2 border-blue-700 bg-blue-700 py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-blue-700 shadow-md">
            <a href="/pertanyaan">Kembali</a>
          </button>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
          <form class="mt-3" method="post" action="/pertanyaan">
            @csrf
            <div class="w-full lg:mx-auto">
              <div class="mb-6 w-full px-4">
                <label for="pertanyaan_code" class="text-base font-bold text-gray-700 lg:text-lg mb-2 block">
                  Kode Pertanyaan
                </label>
                <input type="text" id="pertanyaan_code" name="pertanyaan_code" value="{{ old('pertanyaan_code') }}"
                  class="@error('pertanyaan_code') border-red-500 @else border-gray-300 @enderror w-full rounded-md border bg-gray-50 p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200" />
                @error('pertanyaan_code')
                  <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
              </div>
              <div class="mb-6 w-full px-4">
                <label for="pertanyaan" class="text-base font-bold text-gray-700 lg:text-lg mb-2 block">
                  Pertanyaan
                </label>
                <input type="text" id="pertanyaan" name="pertanyaan" value="{{ old('pertanyaan') }}"
                class="@error('pertanyaan') border-red-500 @else border-gray-300 @enderror w-full rounded-md border bg-gray-50 p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-200" />
                @error('pertanyaan')
                  <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                @enderror
              </div>
              <div class="mt-8 w-full px-4">
                <button type="submit"
                  class="w-full rounded-md border-2 border-purple-600 bg-purple-600 py-3 px-8 text-white font-medium duration-300 ease-out hover:bg-white hover:text-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-400 shadow-md">
                  Simpan Pertanyaan
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="hidden w-full self-center md:block lg:w-1/4 pl-6">
        <!-- Area untuk konten tambahan atau ilustrasi -->
        <div class="bg-gradient-to-r from-blue-100 to-purple-100 rounded-lg p-6 shadow-lg">
          <h3 class="text-lg font-bold text-blue-700 mb-3">Petunjuk</h3>
          <p class="text-gray-700 mb-3">Pastikan kode pertanyaan bersifat unik dan deskriptif.</p>
          <p class="text-gray-700">Gunakan bahasa yang jelas dan mudah dipahami untuk pertanyaan.</p>
        </div>
      </div>
    </div>
  </div>
@endsection