@extends('pages.adminDashboard')

@section('content')
<div class="w-full lg:w-3/4 lg:mx-auto">
  <div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-slate-800 mb-6">Edit Pengguna</h2>
    
    <form action="{{ route('users.update', $user['id']) }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="nama" class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" value="{{ old('nama', $user['nama']) }}" 
            class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#4A42A0]" 
            required>
        </div>
        
        <div>
          <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email', $user['email']) }}" 
            class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#4A42A0]" 
            required>
        </div>
      </div>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="nomer_hp" class="block text-sm font-medium text-slate-700 mb-2">Nomor HP</label>
          <input type="text" id="nomer_hp" name="nomer_hp" value="{{ old('nomer_hp', $user['nomer_hp'] ?? '') }}" 
            class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#4A42A0]">
        </div>
        
        <div>
          <label for="sekolah" class="block text-sm font-medium text-slate-700 mb-2">Sekolah</label>
          <input type="text" id="sekolah" name="sekolah" value="{{ old('sekolah', $user['sekolah'] ?? '') }}" 
            class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#4A42A0]">
        </div>
      </div>
      
      <div>
        <label for="is_admin" class="block text-sm font-medium text-slate-700 mb-2">Status</label>
        <select id="is_admin" name="is_admin" 
          class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#4A42A0]" 
          required>
          <option value="0" {{ $user['is_admin'] == 0 ? 'selected' : '' }}>Pengguna</option>
          <option value="1" {{ $user['is_admin'] == 1 ? 'selected' : '' }}>Admin</option>
        </select>
      </div>
      
      <div class="flex justify-end space-x-4 mt-6">
        <a href="{{ route('users.index') }}" 
          class="px-4 py-2 bg-slate-200 text-slate-700 rounded-md hover:bg-slate-300 transition duration-300">
          Batal
        </a>
        <button type="submit" 
          class="px-4 py-2 bg-[#4A42A0] text-white rounded-md hover:bg-[#3B3580] transition duration-300">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>
@endsection