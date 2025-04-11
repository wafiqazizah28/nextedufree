<div class="w-full self-center px-4">
  <div class="flex flex-wrap justify-center">
    <div class="mt-5 mb-6 self-center rounded-sm bg-white text-slate-500 lg:w-11/12 w-full">
      @if (count($person))
              <div class="p-4">
        <table class="w-full">
          <thead>
            <tr class="bg-pink-50 text-black">
              <th class="py-3 px-4 text-left font-medium" style="font-family: 'Poppins', sans-serif;">Tanggal</th>
              <th class="py-3 px-4 text-left font-medium" style="font-family: 'Poppins', sans-serif;">Waktu</th>
              <th class="py-3 px-4 text-left font-medium" style="font-family: 'Poppins', sans-serif;">Hasil</th>
              <th class="py-3 px-4 text-left font-medium" style="font-family: 'Poppins', sans-serif;">Aksi</th>
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
                    {{ $per['hasil'] ?? 'Belum ada hasil' }}
                </span>
              </td>
              <td class="py-4 px-4"> 
                <a href="{{ route('hasiltes.show', $per->id) }}" class="text-purpleMain hover:text-blue-800 transition duration-300 flex items-center">
                  Lihat
               </a>
              </td>
              
            </tr>
            @endforeach
          </tbody>
        </table>
        
        @if (count($person) > 5)
        <div class="mt-4 flex items-center">
          
        </div>
        @endif
      </div>
      @else
      <div class="flex flex-col items-center p-6">
        <div class="my-2 w-full text-lg font-light text-primary md:text-xl text-center">
          Belum ada riwayat tes, mulai tes sekarang!
        </div>
        <a href="/tesminatmu" class="my-2 rounded-sm border-2  bg-purpleMain py-3 px-8 text-white duration-300 ease-out hover:bg-white hover:text-purpleMain focus:outline-none focus:ring focus:ring-purpleMain focus:ring-opacity-50">
          Tes sekarang
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
  
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
</style>