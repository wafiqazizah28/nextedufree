@extends('pages.adminDashboard')

@section('content')
<div class="w-full max-w-full px-4 lg:px-6">
  <div class="mb-10 w-full">
    <div class="w-full rounded-sm border border-[#BBBBBB] bg-white p-3">
      <div class="flex items-center justify-between px-4">
        <h1 class="font-base mx-3 mt-3 mb-5 text-lg text-slate-800 lg:text-2xl">Data Tabel Pengguna</h1>
      </div>
      
      <div class="mb-4 px-4">
        <form action="/users" method="get">
          <div class="w-full self-center">
            <div class="flex flex-col sm:flex-row">
              <input type="text" id="search" name="search" placeholder="Cari pengguna..."
                class="my-2 w-full rounded-sm border-2 border-[#030723] bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500 sm:mr-3" />
              <button type="submit"
                class="my-2 rounded-sm border-2 border-black bg-black py-3 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
                Cari
              </button>
            </div>
          </div>
        </form>
      </div>
      
      @if ($users->count())
        <div class="w-full overflow-x-auto">
          <table class="w-full min-w-[800px] rounded-xl border text-slate-800">
            <thead class="text-slate-700">
              <tr>
                <th class="border bg-[#4A42A0] px-4 py-3 text-white sticky left-0 bg-[#4A42A0] z-10">No</th>
                <th class="border bg-[#4A42A0] px-4 py-3 text-white sticky left-[50px] bg-[#4A42A0] z-10">Nama</th>
                <th class="border bg-[#4A42A0] px-4 py-3 text-white">Email</th>
                <th class="border bg-[#4A42A0] px-4 py-3 text-white">Nomor HP</th>
                <th class="border bg-[#4A42A0] px-4 py-3 text-white">Sekolah</th>
                <th class="border bg-[#4A42A0] px-4 py-3 text-white">Status</th>
                <th class="border bg-[#4A42A0] px-4 py-3 text-white">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr class="text-center">
                  <td class="border px-4 py-2 sticky left-0 bg-white">{{ $loop->iteration }}</td>
                  <td class="border px-4 py-2 text-justify capitalize sticky left-[50px] bg-white">{{ $user['nama'] }}</td>
                  <td class="border px-4 py-2 text-justify lowercase">{{ $user['email'] }}</td>
                  <td class="border px-4 py-2 text-justify">{{ $user['nomer_hp'] ?? 'Tidak ada' }}</td>
                  <td class="border px-4 py-2 text-justify">{{ $user['sekolah'] ?? 'Tidak ada' }}</td>
                  <td class="border px-4 py-2 text-justify">
                    @if($user['is_admin'] == 1)
                      <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Admin</span>
                    @else
                      <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Pengguna</span>
                    @endif
                  </td>
                  <td class="border px-4 py-2">
                    <div class="flex justify-center space-x-2">
                      <a href="{{ route('users.edit', $user['id']) }}" class="text-blue-500">
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
      @else
        <h1 class="mt-2 mb-4 border p-3 text-center text-lg font-light text-primary lg:text-2xl">
          Tidak ada data pengguna.
        </h1>
      @endif
      
      <div class="px-4 mt-4">
        {{ $users->links() }}
      </div>
    </div>
  </div>
</div>
@endsection