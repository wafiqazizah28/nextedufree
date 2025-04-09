@extends('pages.adminDashboard')

@section('content')
  <div class="w-full self-center px-4">
    <div class="flex flex-wrap">
      <div class="self-center lg:w-2/3">
        <div class="space-between flex">
          <h1 class="text-2xl font-bold text-primary lg:text-3xl">
            Tambah <span class="text-secondary">Sekolah</span>
          </h1>
          <button class="btnnn ml-5 rounded-sm border-2 border-black bg-black py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
            <a href="{{ route('components.admin.sekolah.index') }}">Back</a>
          </button>
        </div>

        {{-- Formulir --}}
        <form class="mt-5" method="post" action="{{ route('components.admin.sekolah.store') }}">
          @csrf

          <div class="w-full lg:mx-auto">

            {{-- Input Nama Sekolah --}}
            <div class="mb-4 w-full px-4">
              <label for="nama" class="text-base font-bold text-primary lg:text-xl">Nama Sekolah</label>
              <input type="text" id="nama" name="nama" value="{{ old('nama') }}" 
                     class="w-full rounded-sm border bg-white p-3" required />

              {{-- Pesan Error --}}
              @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            {{-- Input Pilihan Jurusan --}}
            <div class="mb-4 w-full px-4">
              <label for="jurusan_id" class="text-base font-bold text-primary lg:text-xl">Jurusan</label>
              <select name="jurusan_id" id="jurusan_id" class="w-full rounded-sm border bg-white p-3">
                <option value="" disabled selected>Pilih Jurusan</option>
                
                {{-- Jika ada jurusan dalam database --}}
                @forelse ($jurusanInfo as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                        {{ $jurusan->jurusan }}
                    </option>
                @empty
                    <option disabled>Data jurusan tidak tersedia</option>
                @endforelse
              </select>

              {{-- Pesan Error --}}
              @error('jurusan_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            {{-- Tombol Submit --}}
            <div class="mt-10 w-full px-4">
              <button type="submit" class="btnn w-full rounded-sm border-2 border-black bg-black py-3 px-8 text-white duration-300 ease-out hover:bg-white hover:text-black">
                Tambah Sekolah
              </button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
