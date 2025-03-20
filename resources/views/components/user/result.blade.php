<div class="w-full self-center px-4">
  <div class="flex flex-wrap justify-center">
    <div class=" mt-5 mb-6 self-center rounded-sm   bg-white text-slate-500 lg:w-4/5 w-full">
      @if (count($person))
       
      <div class="p-4">
        <table class="w-full">
          <thead>
            <tr class="bg-pink-50 text-black">
              <th class="py-3 px-4 text-left">Tanggal</th>
              <th class="py-3 px-4 text-left">Waktu</th>
              <th class="py-3 px-4 text-left">Hasil</th>
              <th class="py-3 px-4 text-left">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($person as $per)
            <tr class="border-b hover:bg-gray-50">
              <td class="py-4 px-4">
                <div class="inline-block border border-blue-400 border-dashed p-1 text-black">
                  {{ date('l, d F Y', strtotime($per['created_at'])) }}
                </div>
              </td>
              <td class="py-4 px-4">{{ date('H.i', strtotime($per['created_at'])) }} - {{ date('H.i', strtotime($per['created_at'] . ' +15 minutes')) }}</td>
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
                <button class="text-black">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                  </svg>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="mt-4 flex items-center">
          <button class="flex items-center py-2 px-3 text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>
            <span class="ml-1">Lihat</span>
          </button>
        </div>
      </div>
      @else
      <div class="flex items-center">
        <div class="my-2 mx-3 w-full text-lg font-light text-primary md:text-xl">
          There is no history, diagnose now!
        </div>
        <button
          class="my-2 mx-3 w-full rounded-sm border-2 border-black bg-black py-3 px-8 text-white duration-300 ease-out hover:bg-white hover:text-black focus:outline-none focus:ring focus:ring-blue-500">
          <a href="/diagnose">Diagnose Right Now!</a>
        </button>
      </div>
      @endif
    </div>
  </div>
</div>

<style>
  /* Additional CSS for the table styling */
  .bayangan_field {
    box-shadow: 4px 4px 0px rgba(0, 0, 0, 0.2);
  }
</style>