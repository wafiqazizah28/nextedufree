@extends('layouts.app')

@section('content')
  <section class="pt-28 pb-24 lg:pt-36 lg:pb-32">
    <div class="container">
      <div class="w-full self-center px-4">
        <h1 class="text-base font-medium text-primary md:text-xl">
          Welcome to
          <p class="mt-1 block text-4xl font-bold text-secondary lg:text-5xl">next<span class="text-primary">Edu</span>.
          </p>
        </h1>
        <div class="space-beetween my-2 flex">
          <h2 class="my-3 text-lg font-light text-primary lg:text-2xl">Detail jurusan</h2>
          <button
            class="btnnn my-2 ml-5 rounded-sm border-2 border-black bg-black py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
            <a href="/jurusans">Back</a>
          </button>
        </div>

      </div>

      <div class="container">
        <div class="w-full rounded-sm border border-[#BBBBBB] bg-white p-3">
          <div class="m-3">
            <p class="mb-3 text-lg font-bold text-primary lg:text-3xl">{{ $jurusan['jurusans'] }}</p>
            <div class="h-[170px] overflow-hidden rounded-sm border-2 border-secondary shadow-lg">
              <img src="{{ $jurusan['img'] }}" alt="{{ $jurusan['jurusans'] }}" class="h-full w-full object-cover" />
            </div>
            <p class="mt-5 text-justify text-lg font-bold text-primary">Type:</p>
            <p class="mt-1 text-justify text-lg font-light text-primary">{{ $jurusan['type'] }}</p>
            <p class="mt-5 text-justify text-lg font-bold text-primary">Description:</p>
            <p class="mt-1 text-justify text-lg font-light text-primary">{{ $jurusan['description'] }}</p>
            @if ($jurusan['jurusans'] !== 'Negative')
              <p class="mt-5 text-justify text-lg font-bold text-primary">Saranpekerjaans:</p>
              <ol>
                @foreach ($saranpekerjaans as $saranpekerjaan)
                  @if ($saranpekerjaan['jurusan_id'] == $jurusan['id'])
                    <li class="mt-1 text-justify text-lg font-light text-primary">• {{ $saranpekerjaan['saranpekerjaan'] }}
                    </li>
                  @endif
                @endforeach
              </ol>
              <p class="mt-5 text-justify text-lg font-bold text-primary">Artikels:</p>
              <ol>
                @foreach ($artikels as $artikel)
                  @if ($artikel['jurusan_id'] == $jurusan['id'])
                    <li class="mt-1 text-justify text-lg font-light text-primary">• {{ $artikel['name'] }}
                    </li>
                  @endif
                @endforeach
              </ol>
            @endif
          </div>
        </div>
      </div>
  </section>
@endsection
