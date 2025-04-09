@php
  $person = $hasilTes->where('user_id', auth()->user()->id);
  // dd($person);
  foreach ($person as $p) {
      // echo $p;
  }
@endphp

@extends('layouts.app')

@section('content')
  <section class="pt-10 pb-16 lg:pt-16 lg:pb-20 bg-backgroundPrimary">
    <div class="container">
      <div class="flex flex-col lg:flex-row justify-between">
        <div class="w-full lg:w-1/2 self-center pl-4 lg:pl-20 px-4">
          <div class="text-left">
            <h1 class="text-xl md:text-xl font-light text-black">
              Hallo, <span class="font-light capitalize text-black">{{ auth()->user()->nama }}</span> 👋
            </h1>
            
            <h2 class="mb-3 mt-2 text-base font-medium text-black lg:text-4xl">
              Lihat <span class="font-medium text-purpleMain">Riwayat</span> Tesmu
            </h2>
          </div>
        </div>
        
        <div class="w-full lg:w-1/2 self-center lg:pl-0 lg:pr-20 mt-4 lg:mt-0">
          <!-- Modified card layout to be more rectangular (horizontally wider) -->
          <div class="flex flex-col md:flex-row gap-4 px-4 md:px-8 lg:px-0 lg:pr-8">
            <div class="bg-cover bg-center bg-no-repeat p-4 md:p-6 rounded-lg text-white flex flex-col items-center justify-center w-full h-32 md:h-40" style="background-image: url('assets/img/bg-riwayat.png');">
              <h2 class="text-blackUnder font-extralight underline mb-2 text-lg sm:text-xl lg:text-2xl">
                Hasil Deteksi
              </h2>
                        
              <h1 class="text-2xl font-bold text-white text-center">
                @if (count($person))
                  {{ count($person) }}x
                @else
                  <span class="text-white">0x</span>
                @endif
              </h1>
            </div>
            <div class="bg-cover bg-center bg-no-repeat p-4 md:p-6 rounded-lg text-white flex flex-col items-center justify-center w-full h-32 md:h-40" style="background-image: url('assets/img/bg-riwayat2.png');">
              <h2 class="text-blackUnder font-extralight underline mb-2 text-lg sm:text-xl lg:text-2xl text-center">
                Hasil Terbaru
              </h2>     
              <h1 class="text-2xl font-bold text-white text-center">
                @if (count($person))
                  {{ $p['hasil'] }}
                @else
                  <span class="text-white">Tidak Ada Hasil</span>
                @endif
              </h1>
            </div>
          </div>
        </div>
      </div>
      @include('components.user.result')
    </div>
  </section>
@endsection