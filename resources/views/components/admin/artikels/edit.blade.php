@extends('pages.adminDashboard')

@section('content')
  <div class="w-full self-center px-4">
    <div class="flex flex-wrap">
      <div class="self-center lg:w-2/3">
        <div class="space-between flex">
          <h1 class="text-2xl font-bold text-primary lg:text-3xl">
            Edit <span class="text-secondary">Artikel</span>
          </h1>
          <button
            class="btnnn ml-5 rounded-sm border-2 border-black bg-black py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
            <a href="/artikels">Back</a>
          </button>
        </div>
        
        <form class="mt-5" method="post" action="/artikels/{{ $artikel->id }}" enctype="multipart/form-data">
          @method('put')
          @csrf
          
          <div class="w-full lg:mx-auto">
            <div class="mb-4 w-full px-4">
              <label for="judul" class="text-base font-bold text-primary lg:text-xl">
                Judul
              </label>
              <input type="text" id="judul" name="judul" value="{{ old('judul', $artikel->judul) }}"
                class="@error('judul') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500" required />
              @error('judul')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Perbaikan: Ganti input text dengan dropdown kategori --}}
            <div class="mb-4 w-full px-4">
              <label for="kategori_id" class="text-base font-bold text-primary lg:text-xl">
                Kategori
              </label>
              <select id="kategori_id" name="kategori_id"
                class="@error('kategori_id') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500" required>
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach ($kategoriList as $kategori)
                  <option value="{{ $kategori->id }}" {{ old('kategori_id', $artikel->kategori_id) == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                  </option>
                @endforeach
              </select>
              @error('kategori_id')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Perbaikan: Tampilan gambar tetap ada jika belum diubah --}}
            <div class="mb-4 w-full px-4">
              <label for="img" class="text-base font-bold text-primary lg:text-xl">
                Gambar
              </label>
              <input type="file" id="img" name="img"
                class="w-full rounded-sm border border-[#BBBBBB] bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500" />
              @if ($artikel->img)
                <div class="mt-2">
                  <img src="{{ asset('storage/' . $artikel->img) }}" alt="Artikel Image" class="h-32 w-auto rounded-lg">
                  <p class="text-sm text-gray-500">Biarkan kosong jika tidak ingin mengganti gambar</p>
                </div>
              @endif
              @error('img')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-4 w-full px-4">
              <label for="sinopsis" class="text-base font-bold text-primary lg:text-xl">
                Sinopsis
              </label>
              <textarea id="sinopsis" name="sinopsis" rows="4"
                class="@error('sinopsis') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500">{{ old('sinopsis', $artikel->sinopsis) }}</textarea>
              @error('sinopsis')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-4 w-full px-4">
              <label for="link" class="text-base font-bold text-primary lg:text-xl">
                Link
              </label>
              <input type="url" id="link" name="link" value="{{ old('link', $artikel->link) }}"
                class="@error('link') border-red-500 @else border-[#BBBBBB] @enderror w-full rounded-sm border bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500" />
              @error('link')
                <p class="mt-2 text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mt-10 w-full px-4">
              <button type="submit"
                class="btnn w-full rounded-sm border-2 border-black bg-black py-3 px-8 text-white duration-300 ease-out hover:bg-white hover:text-black focus:outline-none focus:ring focus:ring-blue-500">
                Edit Artikel
              </button>
            </div>
          </div>
        </form>
      </div>

      <div class="hidden w-full self-center md:block lg:w-1/3">
        <div class="mt-10 lg:right-0">
          <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
          <lottie-player src="https://assets7.lottiefiles.com/private_files/lf30_thkzdgrl.json" background="transparent"
            speed="0.5" style="width: 300px; height: 300px;" loop autoplay class="mx-auto"></lottie-player>
        </div>
      </div>
    </div>
  </div>
@endsection
