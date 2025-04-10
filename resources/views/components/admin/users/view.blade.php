@extends('pages.adminDashboard')

@section('content')
  <div class="mb-10 w-full">
    <div class="w-full rounded-md border border-[#BBBBBB] bg-white p-4 shadow-sm">
      <div class="flex items-center justify-between px-4 mb-6">
        <h1 class="font-medium mx-3 mt-3 text-xl text-slate-800 lg:text-2xl">Data Tabel Pengguna</h1>
        
        <!-- PDF Export Button -->
        <a href="{{ route('users.export.pdf') }}" class="my-2 rounded-md border-2 border-blue-700 bg-blue-700 py-2 px-4 text-white duration-300 ease-out hover:bg-white hover:text-blue-700 flex items-center shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Export PDF
        </a>
      </div>
      
      <div class="mb-6 px-4">
        <form action="/users" method="get">
          <div class="w-full self-center">
            <div class="flex flex-col sm:flex-row">
              <div class="relative flex-grow sm:mr-3">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>
                </div>
                <input type="text" id="search" name="search" placeholder="Cari pengguna..."
                  class="my-2 w-full rounded-md border-2 border-blue-700 bg-white p-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
              </div>
              <button type="submit"
                class="my-2 rounded-md border-2 border-blue-700 bg-blue-700 py-3 px-5 text-white duration-300 ease-out hover:bg-white hover:text-blue-700 shadow-sm">
                Cari
              </button>
            </div>
          </div>
        </form>
      </div>
      
      @if ($users->count())
        <div class="w-full overflow-x-auto rounded-md">
          <table class="w-full min-w-[800px] text-slate-800 border-collapse">
            <thead class="text-slate-700">
              <tr>
                <!-- First 4 columns fixed and always visible -->
                <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white sticky left-0 z-10">No</th>
                <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white sticky left-[50px] z-10">Nama</th>
                <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3  text-white sticky left-[200px] z-10">Email</th>
                <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3  px-4 py-3 text-white sticky left-[400px] z-10">Status</th>
                
                <!-- These will need to be scrolled horizontally to view -->
                <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white">Nomor HP</th>
                <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white">Sekolah</th>
                <th class="border border-gray-300 bg-[#4A42A0] px-4 py-3 text-white">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr class="text-center hover:bg-gray-50">
                  <!-- First 4 columns fixed and always visible -->
                  <td class="border border-gray-300 px-4 py-2 sticky left-0 bg-white z-10">{{ $loop->iteration }}</td>
                  <td class="border border-gray-300 px-4 py-2 text-left capitalize sticky left-[50px] bg-white z-10">{{ $user['nama'] }}</td>
                  <td class="border-t border-b border-l border-gray-300 px-4 py-2 text-left lowercase sticky left-[200px] bg-white z-10">{{ $user['email'] }}</td>
                  <td class="border-t border-b border-r border-gray-300 px-4 py-2 text-center sticky left-[400px] bg-white z-10">
                    @if($user['is_admin'] == 1)
                      <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Admin</span>
                    @else
                      <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Pengguna</span>
                    @endif
                  </td>
                  
                  <!-- These will need to be scrolled horizontally to view -->
                  <td class="border border-gray-300 px-4 py-2 text-left">{{ $user['nomer_hp'] ?? 'Tidak ada' }}</td>
                  <td class="border border-gray-300 px-4 py-2 text-left">{{ $user['sekolah'] ?? 'Tidak ada' }}</td>
                  <td class="border border-gray-300 px-4 py-2">
                    <div class="flex justify-center space-x-2">
                      <a href="{{ route('users.edit', $user['id']) }}" class="text-blue-500 hover:text-blue-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </a>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        
        <div class="mt-4 px-4 text-sm text-gray-600 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <p>Geser ke kanan untuk melihat kolom lainnya</p>
        </div>
      @else
        <div class="mt-4 mb-6 border border-gray-300 rounded-md p-6 text-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
          </svg>
          <h1 class="text-lg font-medium text-gray-700 lg:text-xl">
            Tidak ada data pengguna.
          </h1>
        </div>
      @endif
      
      <div class="px-4 mt-4">
        {{ $users->links() }}
      </div>
    </div>
  </div>


<!-- Add some custom CSS for better horizontal scrolling indicator -->
<style>
  .overflow-x-auto::-webkit-scrollbar {
    height: 8px;
  }
  
  .overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 8px;
  }
  
  .overflow-x-auto::-webkit-scrollbar-thumb {
    background: #4A42A0;
    border-radius: 8px;
    border: 2px solid #f1f1f1;
  }
  
  .overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #3a3480;
  }
  
  /* Fix untuk hover state pada sticky columns */
  tr:hover td.sticky {
    background-color: #f8fafc !important;
  }
</style>
@endsection