@extends('pages.adminDashboard')

@section('content')
  <div class="w-full self-center px-4">
    <div class="flex flex-wrap">
      <div class="self-center lg:w-2/3">
        <div class="space-beetween flex">
          <h1 class="text-2xl font-bold text-primary lg:text-3xl">
            Edit <span class="text-secondary">Jurusans</span>
          </h1>
          <button
            class="btnnn ml-5 rounded-sm border-2 border-black bg-black py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
            <a href="/jurusans">Back</a>
          </button>
        </div>
        <form class="mt-5" method="post" action="/jurusans/{{ $jurusan['id'] }}">
          @method('put')
          @csrf
          <div class="w-full lg:mx-auto">
            <div class="mb-4 w-full px-4">
              <label for="jurusans_code" class="text-base font-bold text-primary lg:text-xl">
                Diseases Code
              </label>
              <input type="text" id="jurusan_code" name="jurusan_code"
                value="{{ @old('jurusan_code', $jurusan['jurusan_code']) }}"
                class="@error('jurusan_code') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500" />
              @error('jurusan_code')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-4 w-full px-4">
              <label for="jurusan" class="text-base font-bold text-primary lg:text-xl">
                Jurusans
              </label>
              <input type="text" id="jurusan " name="jurusan" value="{{ @old('jurusan', $jurusan['jurusan']) }}"
                class="@error('jurusans') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500" />
              @error('jurusan')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-4 w-full px-4">
              <label for="type" class="text-base font-bold text-primary lg:text-xl">
                Type
              </label>
              <input type="text" id="type " name="type" value="{{ @old('type', $jurusan['type']) }}"
                class="@error('type') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500" />
              @error('type')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-4 w-full px-4">
              <label for="description" class="text-base font-bold text-primary lg:text-xl">
                Description
              </label>
              <textarea id="description " name="description"
                class="@error('description') border-red-500 @else border-[#BBBBBB] @enderror h-[100px] w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500">{{ @old('description', $disease['description']) }}</textarea>
              @error('description')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mt-10 w-full px-4">
              <button type="submit"
                class="btnn w-full rounded-sm border-2 border-black bg-black py-3 px-8 text-white duration-300 ease-out hover:bg-white hover:text-black focus:outline-none focus:ring focus:ring-blue-500">
                Edit Jurusans
              </button>
            </div>
          </div>
        </form>

      </div>
      <div class="hidden w-full self-center md:block lg:w-1/3">
        <div class="mt-10 lg:right-0">
          <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
          <lottie-player src="https://assets5.lottiefiles.com/private_files/lf30_mvurfbs7.json" background="transparent"
            speed="1" style="width: 300px; height: 300px;" loop autoplay class="mx-auto"></lottie-player>
        </div>
      </div>
    </div>
  </div>
@endsection
