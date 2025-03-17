{{-- @dd($diseaseRelations); --}}
@extends('pages.adminDashboard')

@section('content')
<div class="w-full lg:mx-auto">
  <div class="w-full rounded-sm border border-[#BBBBBB] bg-white p-3">
    <div class="flex items-center justify-between px-4">
      <h1 class="font-base mx-3 mt-3 mb-5 text-lg text-slate-800 lg:text-2xl">Rule Base Table</h1>
      <button type="button"
        class="my-2 mx-3 rounded-sm border-2 border-black bg-black py-3 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black md:my-4">
        <a href="#list">List of Symptoms</a>
      </button>
    </div>

    <div class="overflow-x-auto">
      @if (count($jurusanRelations ?? []))
        <table class="w-full min-w-max table-auto border-collapse border text-slate-800">
          <thead class="bg-slate-50 text-slate-700">
            <tr>
              <th class="border px-4 py-3">No</th>
              <th class="border px-4 py-3">Jurusans</th>
              @foreach ($pertanyaanInfo as $pertanyaan)
                <th class="border px-4 py-3 text-center">{{ $pertanyaan['pertanyaan_code'] }}</th>
              @endforeach
              <th class="border px-4 py-3">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($jurusanRelations as $jurusan)
              <tr class="text-center">
                <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2 text-left">{{ $jurusan['name'] }}</td>
                @foreach ($jurusan['rules'] as $rule)
                  <td class="border px-4 py-2 text-center">{{ $rule ? '✓' : '-' }}</td>
                @endforeach
                <td class="border px-4 py-2">
                  <a class="text-yellow-400 hover:text-yellow-500" href="/rules/{{ $jurusan['id'] }}/edit">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <h1 class="mt-2 mb-4 border p-3 text-center text-lg font-light text-primary lg:text-2xl">
          There is no Rules.
        </h1>
      @endif
    </div>
  </div>

  <!-- List of Symptoms -->
  <h2 id="list" class="font-md mb-3 pt-24 text-lg text-secondary lg:text-2xl">List of Symptoms</h2>
  <div class="overflow-x-auto w-full rounded-sm border border-[#BBBBBB] bg-white p-3">
    @if (count($pertanyaanList ?? []))
      <table class="w-full min-w-max table-auto border-collapse border text-slate-800">
        <thead class="bg-slate-50 text-slate-700">
          <tr>
            <th class="border px-4 py-3">No</th>
            <th class="border px-4 py-3">Pertanyaan Code</th>
            <th class="border px-4 py-3">Pertanyaan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pertanyaanList as $pertanyaan)
            <tr>
              <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
              <td class="border px-4 py-2 text-center">{{ $pertanyaan['pertanyaan_code'] }}</td>
              <td class="border px-4 py-2 text-left">{{ $pertanyaan['pertanyaan'] }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <h1 class="mt-2 mb-4 border p-3 text-center text-lg font-light text-primary lg:text-2xl">
        There is no Symptoms.
      </h1>
    @endif
  </div>
</div>

@endsection
