@extends('pages.adminDashboard')

@section('content')
    <div class="w-full self-center px-4">
        <div class="flex flex-wrap">
            <div class="self-center lg:w-2/3">
                <div class="space-between flex">
                    <h1 class="text-2xl font-bold text-primary lg:text-3xl">
                        Edit <span class="text-secondary">Saran Pekerjaan</span>
                    </h1>
                    <button class="btnnn ml-5 rounded-sm border-2 border-indigo-700 bg-indigo-700 py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-indigo-700">
                        <a href="/saranpekerjaan">Back</a>
                    </button>
                </div>
                <form class="mt-5" method="post" action="/saranpekerjaan/{{ $saranPekerjaan->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="w-full lg:mx-auto">
                        <div class="mb-4 w-full px-4">
                            <label for="jurusan_id" class="text-base font-bold text-primary lg:text-xl">Jurusan</label>
                            <select name="jurusan_id" id="jurusan_id" class="w-full rounded-sm border bg-white p-3">
                                @foreach ($jurusanInfo as $jurusan)
                                    <option value="{{ $jurusan->id }}" {{ $jurusan->id == $saranPekerjaan->jurusan_id ? 'selected' : '' }}>{{ $jurusan->jurusan }}</option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4 w-full px-4">
                            <label for="saran_pekerjaan" class="text-base font-bold text-primary lg:text-xl">Saran Pekerjaan</label>
                            <input type="text" id="saran_pekerjaan" name="saran_pekerjaan" 
                                   value="{{ old('saran_pekerjaan', $saranPekerjaan->saran_pekerjaan) }}" 
                                   class="w-full rounded-sm border bg-white p-3" required>
                            @error('saran_pekerjaan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input Gambar --}}
                        <div class="mb-4 w-full px-4">
                            <label for="gambar" class="text-base font-bold text-primary lg:text-xl">Gambar (Opsional)</label>

                            @if($saranPekerjaan->gambar)
                                <div class="mb-3">
                                    <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                    <img src="{{ asset('storage/' . $saranPekerjaan->gambar) }}" alt="Gambar Saran Pekerjaan" class="h-40 object-cover rounded-sm border border-gray-200">
                                </div>
                            @endif

                            <div class="mt-2 border border-dashed border-gray-300 rounded-sm p-4">
                                <div id="preview-container" class="mb-3 hidden">
                                    <img id="preview-image" class="h-40 mx-auto object-contain rounded-sm" alt="Preview">
                                </div>

                                <div class="flex flex-col items-center justify-center text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm text-gray-600 mb-1">Klik untuk upload gambar baru</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF hingga 2MB</p>
                                    <input type="file" name="gambar" id="gambar" accept="image/*" onchange="previewImage(this)" class="hidden" />
                                    <button type="button" onclick="document.getElementById('gambar').click()" class="mt-3 px-4 py-2 bg-gray-200 text-gray-700 rounded-sm hover:bg-gray-300 text-sm">
                                        Pilih Gambar
                                    </button>
                                </div>
                            </div>

                            @error('gambar')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-10 w-full px-4">
                            <button type="submit" class="btnn w-full rounded-sm border-2 border-indigo-700 bg-indigo-700 py-3 px-8 text-white duration-300 ease-out hover:bg-white hover:text-indigo-700">
                                Update Saran Pekerjaan
                            </button>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script untuk Preview Gambar --}}
    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview-image');
            const previewContainer = document.getElementById('preview-container');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                previewContainer.classList.add('hidden');
            }
        }
    </script>
@endsection