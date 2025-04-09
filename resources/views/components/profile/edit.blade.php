@extends('layouts.app')

@section('content')
<section class="bg-white min-h-screen py-12">
    <div class="container mx-auto px-4 max-w-3xl">
        <!-- Form Edit Profil -->
        <div class="bg-white shadow-md rounded-2xl overflow-hidden">
            <!-- Header with soft pastel gradient -->
            <div class="bg-gradient-to-r from-sky-200 via-pink-100 to-yellow-100 py-6 px-8 text-gray-700">
                <h2 class="text-2xl md:text-3xl font-bold">Edit Profil</h2>
                <p class="text-gray-600 text-sm md:text-base mt-1">Perbarui informasi pribadimu di sini.</p>
            </div>
            
            <div class="p-6 md:p-8">
                <!-- Show notification for Google users -->
                @if(isset($isNewGoogleUser) && $isNewGoogleUser)
                <div class="p-4 mb-6 rounded-lg bg-blue-50 border-l-4 border-blue-500 flex items-start">
                    <div class="flex-shrink-0 mr-3">
                        <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-blue-800">Pendaftaran dengan Google berhasil!</h3>
                        <div class="mt-1 text-sm text-blue-700">
                            <p>Silakan lengkapi informasi berikut untuk menyelesaikan pendaftaran Anda.</p>
                        </div>
                    </div>
                </div>
                @endif
                
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Foto Profil -->
                    <div class="flex flex-col items-center">
                        <div class="relative group">
                            <img id="previewFoto" 
                                src="{{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : asset('assets/img/default-profile.png') }}" 
                                class="w-28 h-28 rounded-full object-cover border-4 border-white shadow-md transition duration-300 group-hover:opacity-90">
                            
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                <label for="fotoInput" class="cursor-pointer p-2 bg-gradient-to-r from-sky-300 via-pink-200 to-yellow-200 rounded-full text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </label>
                            </div>
                        </div>
                        
                        <input type="file" name="foto" id="fotoInput" class="hidden" onchange="previewImage(event)">
                        <span id="fileName" class="mt-2 text-gray-600 text-sm"></span>
                    </div>

                    <!-- Form Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Nama</label>
                            <input type="text" name="nama" value="{{ auth()->user()->nama }}" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-300 focus:border-sky-300 transition">
                            @error('nama')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Asal Sekolah -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Asal Sekolah</label>
                            <input type="text" name="sekolah" value="{{ auth()->user()->sekolah }}" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                            @error('sekolah')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nomor HP -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Nomor HP</label>
                            <input type="text" name="nomer_hp" value="{{ auth()->user()->nomer_hp }}" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                            @error('nomer_hp')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email (readonly) -->
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" readonly
                                class="w-full px-4 py-3 border border-gray-300 bg-gray-50 rounded-lg cursor-not-allowed">
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-4 border-t border-gray-100 flex flex-col sm:flex-row gap-3 justify-end">
                        <a href="{{ route('profile.show') }}" class="px-6 py-3 bg-white border border-purpleMain text-purpleMain font-semibold rounded-lg hover:bg-gray-200 transition text-center">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-purpleMain font-semibold text-white rounded-lg hover:opacity-90 transition shadow-md hover:shadow-lg">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Script untuk Preview Foto dan Nama File -->
<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        const fileName = document.getElementById("fileName");

        reader.onload = function() {
            const img = document.getElementById('previewFoto');
            img.src = reader.result;
        };

        if (input.files.length > 0) {
            reader.readAsDataURL(input.files[0]);
            fileName.textContent = input.files[0].name;
        } else {
            fileName.textContent = "";
        }
    }
</script>
@endsection