@extends('pages.adminDashboard')

@section('content')
<div class="w-full max-w-full px-4 lg:px-6">
  <div class="bg-white rounded border border-[#BBBBBB] shadow-sm">
    <div class="p-3 border-b">
      <h1 class="font-medium text-lg text-slate-800">Data Tabel Transpose</h1>
    </div>

    <div class="bg-white relative">
      @if (count($jurusanRelations ?? []))
        <div class="overflow-x-auto custom-scrollbar">
          <div class="overflow-y-auto custom-scrollbar-y max-h-[480px]">
            <table class="min-w-max w-full border-collapse text-sm">
              <thead class="bg-indigo-700 text-white text-center sticky top-0 z-10">
                <tr>
                  <th class="px-3 py-2 border-r w-10 text-center sticky top-0 bg-indigo-700 z-10">No</th>
                  <th class="px-3 py-2 border-r text-left sticky top-0 bg-indigo-700 z-10">Pertanyaan</th>
                  @foreach ($jurusanRelations as $jurusan)
                    <th class="px-3 py-2 border-r text-center whitespace-nowrap sticky top-0 bg-indigo-700 z-10">
                      {{ $jurusan['name'] }}
                      <a href="/rules/{{ $jurusan['id'] }}/edit" class="inline-block ml-1 text-white hover:text-gray-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </a>
                    </th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @foreach ($pertanyaanInfo as $index => $pertanyaan)
                  <tr class="border-b hover:bg-gray-50">
                    <td class="px-3 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="px-3 py-2">{{ $pertanyaan['pertanyaan_code'] }}</td>
                    @foreach ($jurusanRelations as $jurusan)
                      <td class="px-3 py-2 text-center">
                        {{ $jurusan['rules'][$index] ? '✓' : '-' }}
                      </td>
                    @endforeach
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="flex items-center justify-end py-2 px-3 border-t bg-gray-50">
          <span class="text-xs text-gray-500 italic">
            scroll untuk melihat semua jurusan
          </span>
        </div>
      @else
        <div class="py-4 px-3">
          <p class="text-center text-sm font-light text-gray-600">
            There is no Rules.
          </p>
        </div>
      @endif
    </div>
  </div>
</div>

<style>
  .custom-scrollbar {
    width: 100%;
    overflow-x: auto;
    scrollbar-width: thin;
    scrollbar-color: #818cf8 #e0e7ff;
    -webkit-overflow-scrolling: touch;
  }

  .custom-scrollbar::-webkit-scrollbar {
    height: 8px;
  }

  .custom-scrollbar::-webkit-scrollbar-track {
    background: #e0e7ff;
    border-radius: 4px;
  }

  .custom-scrollbar::-webkit-scrollbar-thumb {
    background: #818cf8;
    border-radius: 4px;
    border: 1px solid #e0e7ff;
  }

  .custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #6366f1;
  }

  .custom-scrollbar-y {
    scrollbar-width: thin;
    scrollbar-color: #818cf8 #e0e7ff;
  }

  .custom-scrollbar-y::-webkit-scrollbar {
    width: 8px;
  }

  .custom-scrollbar-y::-webkit-scrollbar-track {
    background: #e0e7ff;
    border-radius: 4px;
  }

  .custom-scrollbar-y::-webkit-scrollbar-thumb {
    background: #818cf8;
    border-radius: 4px;
    border: 1px solid #e0e7ff;
  }

  .custom-scrollbar-y::-webkit-scrollbar-thumb:hover {
    background: #6366f1;
  }
</style>
@endsection
