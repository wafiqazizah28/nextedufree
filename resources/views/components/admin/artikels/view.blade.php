{{-- @dd($diseasesInfo); --}}
@extends('pages.adminDashboard')

@section('content')
  <button
    class="btnnn mb-3 rounded-sm border-2 border-black bg-black py-3 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black">
    <a href="/artikels/create">Add Artikels</a>
  </button>
  <div class="w-full lg:mx-auto">
    <div class="mb-10 w-full">
      <div class="w-full rounded-sm border border-[#BBBBBB] bg-white p-3">
        <div class="flex items-center justify-between px-4">
          <h1 class="font-base mx-3 mt-3 mb-5 text-lg text-slate-800 lg:text-2xl">Artikels Table</h1>
          <form action="/artikels" method="get">
            <div class="w-full self-center">
              <div class="flex">
                <input type="text" id="search" name="search" placeholder="search for artikels"
                  class="my-2 w-full rounded-sm border-2 border-[#030723] bg-white p-3 focus:outline-none focus:ring focus:ring-blue-500 md:my-4" />
                <button type="submit"
                  class="my-2 mx-3 rounded-sm border-2 border-black bg-black py-3 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black md:my-4">
                  Search
                </button>
              </div>
            </div>
          </form>
        </div>
        @if ($artikelList->count())
          <table class="mb-3 w-full rounded-xl border text-slate-800">
            <thead class="text-slate-700">
              <tr>
                <th class="border bg-slate-50 px-6 py-3">
                  No
                </th>
                <th class="border bg-slate-50 px-6 py-3">
                  Name
                </th>
                <th class="border bg-slate-50 px-6 py-3">
                  Composition
                </th>
                <th class="border bg-slate-50 px-6 py-3">
                  Dose
                </th>
                <th class="border bg-slate-50 px-6 py-3">
                  For Jurusan
                </th>
                <th class="border bg-slate-50 px-6 py-3">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($artikelList as $artikel)
                <tr class="px-6 py-3 text-center">
                  <td class="border px-6 py-2">{{ $loop->iteration }}</td>
                  <td class="border px-6 py-2">{{ $artikel['name'] }}</td>
                  <td class="content-start border px-6 py-2 text-justify">{{ $artikel['composition'] }}</td>
                  <td class="border px-6 py-2 text-justify">{{ $artikel['dose'] }}</td>
                  <td class="border px-6 py-2 text-justify">
                    @foreach($jurusansInfo as $jurusan)
                      @if($artikel['jurusan_id'] == $jurusan['id'])
                        {{ $jurusan['jurusans'] }}
                      @endif
                    @endforeach
                  </td>
                  <td class="flex content-center justify-center border px-6 py-2">
                    <a class="mx-2 text-blue-400" href="/artikels/{{ $artikel['id'] }}">
                      View
                    </a>
                    <a class="mx-2 text-yellow-400" href="/artikels/{{ $artikel['id'] }}/edit">
                      Edit
                    </a>
                    <form class="mx-2 text-red-400" action="/artikels/{{ $artikel['id'] }}" method="post"
                      class="d-inline">
                      @method('delete')
                      @csrf
                      <button onClick="return confirm('Kamu Yakin?')">
                        Delete
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          @else
            <h1 class="mt-2 mb-4 border p-3 text-center text-lg font-light text-primary lg:text-2xl">Tidak ada Artikels.</h1>
        @endif
        </table>
        {{ $artikelList->links() }}
      </div>
    </div>
  </div>
@endsection
