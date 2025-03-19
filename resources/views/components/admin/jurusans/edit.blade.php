@extends('pages.adminDashboard')

@section('content')
  <div class="w-full self-center px-4">
    <div class="flex flex-wrap">
      <div class="self-center lg:w-2/3">
        <div class="space-between flex">
          <h1 class="text-2xl font-bold text-primary lg:text-3xl">
            Edit <span class="text-secondary">Jurusan</span>
          </h1>
          <button
            class="btnnn ml-5 rounded-sm border-2 border-black bg-black py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
            <a href="/jurusans">Back</a>
          </button>
        </div>
        <form class="mt-5" method="post" action="/jurusans/{{ $jurusan->id }}" enctype="multipart/form-data">
          @method('put')
          @csrf
          <div class="w-full lg:mx-auto">
            <div class="mb-4 w-full px-4">
              <label for="jurusan_code" class="text-base font-bold text-primary lg:text-xl">
                Jurusan Code
              </label>
              <input type="text" id="jurusan_code" name="jurusan_code"
                value="{{ old('jurusan_code', $jurusan->jurusan_code) }}"
                class="@error('jurusan_code') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500" />
              @error('jurusan_code')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-4 w-full px-4">
              <label for="jurusan" class="text-base font-bold text-primary lg:text-xl">
                Jurusan
              </label>
              <input type="text" id="jurusan" name="jurusan" value="{{ old('jurusan', $jurusan->jurusan) }}"
                class="@error('jurusan') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500" />
              @error('jurusan')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-4 w-full px-4">
              <label for="img" class="text-base font-bold text-primary lg:text-xl">
                Upload Image
              </label>
              <input type="file" id="img" name="img"
                class="@error('img') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500" />
              @error('img')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Tombol Update --}}
            <div class="w-full px-4 mt-4">
              <button type="submit"
                class="w-full rounded-sm border-2 border-black bg-black py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
                Update Jurusan
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
