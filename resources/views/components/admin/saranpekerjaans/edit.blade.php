// edit.blade.php
@extends('pages.adminDashboard')

@section('content')
  <div class="w-full self-center px-4">
    <div class="flex flex-wrap">
      <div class="self-center lg:w-2/3">
        <div class="space-between flex">
          <h1 class="text-2xl font-bold text-primary lg:text-3xl">
            Edit <span class="text-secondary">Saran Pekerjaan</span>
          </h1>
          <button class="btnnn ml-5 rounded-sm border-2 border-black bg-black py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
            <a href="/saranpekerjaans">Back</a>
          </button>
        </div>
        <form class="mt-5" method="post" action="/saranpekerjaans/{{ $saranPekerjaan->id }}">
          @method('put')
          @csrf
          <div class="w-full lg:mx-auto">
            <div class="mb-4 w-full px-4">
              <label for="jurusan_id" class="text-base font-bold text-primary lg:text-xl">Jurusan</label>
              <select name="jurusan_id" id="jurusan_id" class="w-full rounded-sm border bg-white p-3">
                @foreach ($jurusanInfo as $jurusan)
                  <option value="{{ $jurusan->id }}" {{ $jurusan->id == $saranPekerjaan->jurusan_id ? 'selected' : '' }}>{{ $jurusan->jurusans }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-4 w-full px-4">
              <label for="saranpekerjaan" class="text-base font-bold text-primary lg:text-xl">Saran Pekerjaan</label>
              <input type="text" id="saranpekerjaan" name="saranpekerjaan" value="{{ old('saranpekerjaan', $saranPekerjaan->saranpekerjaan) }}" class="w-full rounded-sm border bg-white p-3" />
            </div>
            <div class="mt-10 w-full px-4">
              <button type="submit" class="btnn w-full rounded-sm border-2 border-black bg-black py-3 px-8 text-white duration-300 ease-out hover:bg-white hover:text-black">
                Update Saran Pekerjaan
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection