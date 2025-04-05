<div class="w-full self-center px-4">
  <div class="flex flex-wrap justify-center">
    <div class="mt-5 mb-6 self-center rounded-sm bg-white text-slate-500 lg:w-4/5 w-full">
      @if (count($person))
              <div class="p-4">
        <table class="w-full">
          <thead>
            <tr class="bg-pink-50 text-black">
              <th class="py-3 px-4 text-left">Tanggal Tes</th>
              <th class="py-3 px-4 text-left">Waktu</th>
              <th class="py-3 px-4 text-left">Hasil</th>
              <th class="py-3 px-4 text-left">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($person as $per)
            <tr class="border-b hover:bg-gray-50">
              <td class="py-4 px-4">
                <div class="inline-block p-1 text-black">
                  {{ \Carbon\Carbon::parse($per['created_at'])->translatedFormat('l, d F Y') }}
                </div>
              </td>
              <td class="py-4 px-4">
                {{ \Carbon\Carbon::parse($per['created_at'])->format('H.i') }} WIB
              </td>
              <td class="py-4 px-4">
                @php
                $colors = ['text-blue-500', 'text-orange-500', 'text-red-500', 'text-purple-500', 'text-green-500'];
                $index = $loop->index % count($colors);
                $colorClass = $colors[$index];
                @endphp
                
                <span class="{{ $colorClass }}">
                    {{ $per['hasil'] ?? 'Akutansi' }}
                </span>
              </td>
              <td class="py-4 px-4">
                <a href="{{ route('testdetail.detail', $per->id) }}" class="text-blue-600 hover:text-blue-800 transition duration-300 flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye mr-2">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                  Lihat
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        
        @if (count($person) > 5)
        <div class="mt-4 flex items-center">
          <button class="flex items-center py-2 px-3 text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
            <span class="ml-1">Lihat Lebih Banyak</span>
          </button>
        </div>
        @endif
      </div>
      @else
      <div class="flex flex-col items-center p-6">
        <div class="my-2 w-full text-lg font-light text-primary md:text-xl text-center">
          Belum ada riwayat tes, mulai diagnosa sekarang!
        </div>
        <a href="/diagnose" class="my-2 rounded-sm border-2 border-black bg-black py-3 px-8 text-white duration-300 ease-out hover:bg-white hover:text-black focus:outline-none focus:ring focus:ring-blue-500">
          Diagnosa Sekarang
        </a>
      </div>
      @endif
    </div>
  </div>
</div>

<style>
  .bayangan_field {
    box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
  }
</style>