@extends('layouts.app')

@section('content')
<section class="bg-backgroundLight min-h-screen flex items-center justify-center">
    
    <div class="container mx-auto px-4">

        <!-- Form Edit Profil -->
        <div class="bg-white shadow-lg rounded-lg p-6 md:p-8 max-w-3xl mx-auto">
            
            <!-- Header -->
            <div class="text-center mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Edit Profil</h2>
                <p class="text-gray-600 text-sm md:text-base">Perbarui informasi pribadimu di sini.</p>
            </div>

            <!-- Show notification for Google users -->
            @if(isset($isNewGoogleUser) && $isNewGoogleUser)
            <div class="p-4 mb-6 rounded-lg bg-blue-50 border border-blue-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Pendaftaran dengan Google berhasil!</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p>Silakan lengkapi informasi berikut untuk menyelesaikan pendaftaran Anda:</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Foto Profil -->
                <div class="mb-6 text-center">
                    <img id="previewFoto" 
                        src="{{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : asset('assets/img/default-profile.png') }}" 
                        class="w-24 h-24 rounded-full mx-auto object-cover border border-gray-300 shadow-sm">
                    
                    <!-- Input File dengan Custom Button -->
                    <div class="mt-3 flex justify-center">
                        <label for="fotoInput" class="cursor-pointer px-3 py-2 text-sm bg-purpleMain text-white font-semibold rounded-md hover:bg-purple-800 transition">
                            Pilih Foto
                        </label>
                        
                        <input type="file" name="foto" id="fotoInput" class="hidden" onchange="previewImage(event)">
                        <span id="fileName" class="ml-3 text-gray-600 text-sm"></span>
                    </div>
                </div>

                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Nama</label>
                    <input type="text" name="nama" value="{{ auth()->user()->nama }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Asal Sekolah -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Asal Sekolah</label>
                    <input type="text" name="sekolah" value="{{ auth()->user()->sekolah }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                    @error('sekolah')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email (readonly) -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Email</label>
                    <input type="email" value="{{ auth()->user()->email }}" readonly
                        class="w-full px-4 py-2 border border-gray-300 bg-gray-100 rounded-lg cursor-not-allowed">
                </div>

                <!-- Nomor HP -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Nomor HP</label>
                    <input type="text" name="nomer_hp" value="{{ auth()->user()->nomer_hp }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                    @error('nomer_hp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6 flex flex-col md:flex-row gap-4">
                    <button type="submit" class="w-full md:w-auto px-6 py-2 bg-purpleMain text-white font-semibold rounded-lg hover:bg-purple-800 transition">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('profile.show') }}" class="w-full md:w-auto px-6 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition text-center">
                        Batal
                    </a>
                </div>

            </form>

        </div>

    </div>
</section>

<!-- Script untuk Preview Foto dan Nama File -->
<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();
        var fileName = document.getElementById("fileName");

        reader.onload = function() {
            var img = document.getElementById('previewFoto');
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