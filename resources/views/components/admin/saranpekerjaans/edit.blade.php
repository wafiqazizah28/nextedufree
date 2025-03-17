@extends('pages.adminDashboard')

@section('content')
  <div class="w-full self-center px-4">
    <div class="flex flex-wrap">
      <div class="self-center lg:w-2/3">
        <div class="space-beetween flex">
          <h1 class="text-2xl font-bold text-primary lg:text-3xl">
            Edit <span class="text-secondary">Saranpekerjaan</span>
          </h1>
          <button
            class="btnnn ml-5 rounded-sm border-2 border-black bg-black py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
            <a href="/jurusans">Back</a>
          </button>
        </div>
        <form class="mt-5" method="post" action="/saranpekerjaans/{{ $saranpekerjaan['id'] }}">
          @method('put')
          @csrf
          <div class="w-full lg:mx-auto">
            <div class="mb-4 w-full px-4">
              <label for="saranpekerjaan_id" class="text-base font-bold text-primary lg:text-xl">
                Jurusans
              </label>
              <select name="jurusan_id" id="jurusan_id"
                class="@error('jurusan_id') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500">
                @foreach ($jurusansInfo as $jurusan)
                  @if ($jurusan['id'] == $saranpekerjaan['jurusan_id'])
                    <option value="{{ $jurusan['id'] }}" selected>{{ $jurusan['jurusans'] }}</option>
                  @else
                    <option value="{{ $jurusan['id'] }}">{{ $jurusan['jurusans'] }}</option>
                  @endif
                @endforeach
              </select>
              @error('jurusan_id')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mb-4 w-full px-4">
              <label for="saranpekerjaan" class="text-base font-bold text-primary lg:text-xl">
                Saranpekerjaans
              </label>
              <input type="text" id="saranpekerjaan " name="saranpekerjaan" value="{{ @old('saranpekerjaan', $saranpekerjaan['saranpekerjaan']) }}"
                class="@error('saranpekerjaan') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500" />
              @error('saranpekerjaan')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>
            <div class="mt-10 w-full px-4">
              <button type="submit"
                class="btnn w-full rounded-sm border-2 border-black bg-black py-3 px-8 text-white duration-300 ease-out hover:bg-white hover:text-black focus:outline-none focus:ring focus:ring-blue-500">
                Edit Saranpekerjaan
              </button>
            </div>
          </div>
        </form>

      </div>
      <div class="hidden w-full self-center md:block lg:w-1/3">
        <div class="mt-10 lg:right-0">
          <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
          <lottie-player src="https://assets1.lottiefiles.com/private_files/lf30_pzpxyd5w.json" background="transparent"
            speed="1" style="width: 300px; height: 300px;" loop autoplay class="mx-auto"></lottie-player>
        </div>
      </div>
    </div>
  </div>
@endsection
