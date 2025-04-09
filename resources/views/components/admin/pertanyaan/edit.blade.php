@extends('pages.adminDashboard')

@section('content')
<div class="w-full bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
  <div class="p-6">
    <h1 class="text-2xl font-semibold text-purpleMain mb-6">Edit Pertanyaan</h1>
    
    <form action="{{ route('pertanyaan.update', $pertanyaan->id) }}" method="POST">
      @csrf
      @method('PUT')
      
      <div class="mb-4">
        <label for="pertanyaan_code" class="block text-gray-700 text-sm font-medium mb-2">Kode Pertanyaan</label>
        <input 
          type="text" 
          id="pertanyaan_code" 
          name="pertanyaan_code" 
          value="{{ old('pertanyaan_code', $pertanyaan->pertanyaan_code) }}"
          class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purpleMain"
          required
        >
        @error('pertanyaan_code')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      
      <div class="mb-6">
        <label for="pertanyaan" class="block text-gray-700 text-sm font-medium mb-2">Pertanyaan</label>
        <textarea
          id="pertanyaan"
          name="pertanyaan"
          rows="4"
          class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purpleMain"
          required
        >{{ old('pertanyaan', $pertanyaan->pertanyaan) }}</textarea>
        @error('pertanyaan')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>
      
      <div class="flex items-center justify-between">
        <a href="{{ route('pertanyaan.index') }}" class="rounded-lg bg-gray-300 py-2 px-4 text-gray-700 hover:bg-gray-400 transition-all duration-300">
          Batal
        </a>
        <button type="submit" class="rounded-lg bg-purpleMain py-2 px-4 text-white hover:bg-purple-800 transition-all duration-300">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>
@endsection