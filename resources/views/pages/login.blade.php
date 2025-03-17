<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - NextEdu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" />
</head>

<body class="bg-white flex items-center justify-center min-h-screen">

  <div class="flex w-full h-screen">

    <!-- Form Login -->
    <div class="w-5/6 flex items-center justify-center bg-white shadow-[0px_10px_30px_rgba(0,0,0,0.2)]">

      <div class="w-4/5">
        <div class="text-center -mt-14 mb-14">
          <img src="assets/logo/logo-typo.svg" alt="NextEdu Logo" class="h-12 mx-auto">
          <p class="text-grayMain font-semibold mt-1">Masuk ke akun Anda</p>
        </div>

        <form action="/login" method="POST">
          @csrf
          
          <div class="grid grid-cols-1 gap-y-6">
            
            <!-- Email -->
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email:</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#493D9E] focus:border-[#493D9E] block w-full p-3">
              @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
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
          </div>

          <!-- Lupa Password -->
          <div class="text-right mt-2">
            <a href="#" class="text-sm text-[#493D9E] hover:underline">Lupa password?</a>
          </div>

          <!-- Tombol Login -->
          <button type="submit" class="w-full text-white py-3 rounded-lg mt-8 transition"
            style="background-color: #493D9E; hover:bg-purple-700;">
            Login
          </button>

          <!-- Daftar -->
          <div class="text-center my-4 text-gray-500">Belum punya akun?</div>
          <a href="/register"
            class="w-full border border-[#493D9E] text-[#493D9E] py-3 rounded-lg text-lg font-semibold text-center block hover:bg-[#493D9E] hover:text-white transition duration-300">
            Daftar
          </a>
          
        </form>
      </div>
    </div>

    <!-- Ilustrasi -->
    <div class="w-1/2 flex items-center justify-center">
      <img src="assets/img/imgLogin.svg" alt="Login Illustration" class="w-[450px] transform -translate-y-6">
    </div>

  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>
