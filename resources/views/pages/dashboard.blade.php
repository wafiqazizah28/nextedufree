@php
  $person = $hasilTes->where('user_id', auth()->user()->id);
  // dd($person);
  foreach ($person as $p) {
      // echo $p;
  }
@endphp

@extends('layouts.app')

@section('content')
  <section class="pt-28 pb-24 lg:pt-36 lg:pb-20 bg-backgroundPrimary">
    <div class="container">
      <div class="flex flex-col lg:flex-row">
        <div class="w-full self-center px-4">
          <h1 class="text-3xl md:text-3xl font-light text-black">
            Hallo, <span class="font-light capitalize text-black">{{ auth()->user()->nama }}</span> 👋
        </h1>
        
        <h2 class="mb-3 mt-2 text-lg font-medium text-black lg:text-6xl">
          Lihat <span class="font-medium text-purpleMain">Riwayat</span> Tesmu
      </h2>
      
        
      </div>
      
        <div class="grid w-full grid-cols-2 gap-1 self-center px-4">
          <div class="bg-cover bg-center bg-no-repeat p-16 rounded-lg text-white" style="background-image: url('assets/img/bg-riwayat.png');">
            <h2>Hasil Deteksi</h2>
          
            <h1 class="text-2xl font-bold text-primary">
              @if (count($person))
                {{ count($person) }}x
              @else
                <span class="text-slate-500">0x</span>
              @endif
            </h1>
          </div>
          <div class="bg-cover bg-center bg-no-repeat p-16 rounded-lg text-white" style="background-image: url('assets/img/bg-riwayat2.png');">
            <p class="font-base pb-2 text-base text-primary lg:text-xl">
              Hasil Terbaru
            </p>
            <h1 class="text-2xl font-bold text-primary">
              @if (count($person))
                {{ $p['hasil'] }}
              @else
                <span class="text-slate-500">Tidak Ada Hasil</span>
              @endif
            </h1>
          </div>
        </div>
      </div>
      @include('components.user.result')
    </div>
  </section>
@endsection
