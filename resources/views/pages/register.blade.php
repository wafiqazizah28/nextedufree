<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - NextEdu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" />
</head>

<body class="bg-white flex items-center justify-center min-h-screen">

  <div class="flex w-full h-screen">

    <!-- Form Pendaftaran dengan Shadow lebih jelas di bawah -->
    <div class="w-5/6 flex items-center justify-center bg-white shadow-[0px_10px_30px_rgba(0,0,0,0.2)] ">

      <div class="w-4/5">
        <div class="text-center -mt-14 mb-14">
          <!-- Tambahkan margin-top negatif -->
          <img src="assets/logo/logo-typo.svg" alt="NextEdu Logo" class="h-12 mx-auto">
          <p class="text-grayMain font-semibold mt-1">Daftar ke akun Anda</p>
        </div>


        <form action="/register" method="POST">
          @csrf          <div class="grid grid-cols-2 gap-x-12 gap-y-6">
            <!-- Nama -->
            <div>
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama:</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#493D9E] focus:border-[#493D9E] block w-full p-3">
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <!-- Asal Sekolah -->
            <div>
                <label for="sekolah" class="block mb-2 text-sm font-medium text-gray-900">Asal Sekolah:</label>
                <input type="text" id="sekolah" name="sekolah" value="{{ old('sekolah') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#493D9E] focus:border-[#493D9E] block w-full p-3">
            </div>
    
            <!-- Email -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#493D9E] focus:border-[#493D9E] block w-full p-3">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <!-- No Handphone -->
            <div>
                <label for="nomer_hp" class="block mb-2 text-sm font-medium text-gray-900">No Handphone:</label>
                <input type="text" id="nomer_hp" name="nomer_hp" value="{{ old('nomer_hp') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#493D9E] focus:border-[#493D9E] block w-full p-3">
            </div>
    
            <!-- Password -->
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password:</label>
                <input type="password" id="password" name="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#493D9E] focus:border-[#493D9E] block w-full p-3">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
    
            <!-- Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#493D9E] focus:border-[#493D9E] block w-full p-3">
            </div>
        </div>
    
        <!-- Tombol Sign Up -->
        <button type="submit" class="w-full text-white py-3 rounded-lg mt-8 transition"
            style="background-color: #493D9E; hover:bg-purple-700;">
            Sign Up
        </button>
    </form>
      </div>
    </div>

    <!-- Ilustrasi -->
    <div class="w-1/2 flex items-center justify-center">
      <img src="assets/img/imgRegister.svg" alt="Sign Up Illustration" class="w-[450px] transform -translate-y-6">
    </div>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>