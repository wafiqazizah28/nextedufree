<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite('resources/css/app.css')

  <!-- Favicon standar -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon_io/favicon-16x16.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon_io/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/favicon_io/favicon-48x48.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon_io/favicon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/favicon_io/android-chrome-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/favicon_io/android-chrome-512x512.png') }}">
  <title>nextEdu</title>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-white min-h-screen">

  <!-- Navbar -->
  <header id="navbar"
    class="fixed top-0 left-0 z-50 w-full bg-white shadow-md transition-shadow duration-300 lg:hidden">
    <div class="container">
      <div class="relative flex items-center justify-between py-4">
        <!-- Logo -->
        <div class="px-4">
          <a href="/">
            <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="Logo" class="w-28">
          </a>
        </div>

        <!-- Tombol Hamburger -->
        <div class="flex items-center lg:hidden ml-auto mr-4">
          <button id="hamburger" name="hamburger" type="button" class="block">
            <span class="hamburger-line transition duration-300 ease-in-out bg-black w-6 h-1 mb-1 block"></span>
            <span class="hamburger-line transition duration-300 ease-in-out bg-black w-6 h-1 mb-1 block"></span>
            <span class="hamburger-line transition duration-300 ease-in-out bg-black w-6 h-1 block"></span>
          </button>
        </div>
      </div>
    </div>
  </header>
  <!-- Menu Navigasi -->
  <nav id="nav-menu"
    class="fixed top-[60px] right-0 w-1/2 h-screen bg-white shadow-md hidden flex flex-col justify-between z-40 transition-all duration-300">
    <ul class="block w-full text-left mt-6 px-6 space-y-3 text-lg">
      <li><a href="/" class="block py-1 text-black hover:text-purpleMain">Beranda</a></li>
      <li><a href="/tesminatmu" class="block py-1 text-black hover:text-purpleMain">Tes Minatmu</a></li>
      <li><a href="/tanyaJurpan" class="block py-1 text-black hover:text-purpleMain">Edubot</a></li>
      <li><a href="/artikelPage" class="block py-1 text-black hover:text-purpleMain">Artikel</a></li>
      @auth
      <li><a href="/dashboard" class="block py-1 text-black hover:text-purpleMain">Riwayat Tes</a></li>
      <li>
        <form action="/logout" method="post" class="block py-1">
          @csrf
          <button class="w-full text-left text-red-600 hover:text-red-800">Logout</button>
        </form>
      </li>
      @endauth
    </ul>

    <!-- Tombol Login & Signup -->
    @guest
    <div class="px-6 pb-8 w-full mt-8 space-y-8">
      <!-- Tambah space-y-4 untuk jarak antar tombol -->
      <a href="/login"
        class="block w-full text-center bg-purpleMain text-white py-2 rounded-md text-base font-semibold shadow-md hover:bg-purple-700 transition">
        Masuk
      </a>
      <a href="/register"
        class="block w-full text-center border border-purpleMain text-purpleMain py-2 rounded-md text-base font-semibold shadow-md hover:bg-purpleMain hover:text-white transition">
        Daftar
      </a>
    </div>

    @endguest
  </nav>

  <!-- Script -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.getElementById("hamburger");
  const navMenu = document.getElementById("nav-menu");
  const navbar = document.getElementById("navbar");
  const lines = hamburger.querySelectorAll(".hamburger-line");


  // Toggle menu
  hamburger.addEventListener("click", function () {
        navMenu.classList.toggle("hidden");
        navMenu.classList.toggle("flex");

        // Ubah bentuk hamburger jadi "X"
        lines[0].classList.toggle("rotate-45");
        lines[0].classList.toggle("translate-y-2.5");

        lines[1].classList.toggle("opacity-0");

        lines[2].classList.toggle("-rotate-45");
        lines[2].classList.toggle("-translate-y-2.5");
    });

  // Tambah shadow saat discroll
  window.addEventListener("scroll", function () {
      if (window.scrollY > 50) {
          navbar.classList.add("shadow-md", "bg-white");
      } else {
          navbar.classList.remove("shadow-md", "bg-white");
      }
  });
});
  </script>

  <div class="flex flex-col lg:flex-row-reverse w-full h-screen ">
    <!-- Ilustrasi (Di sebelah kanan di desktop) -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-4">
      <img src="{{ asset('assets/img/imgLogin.svg') }}" alt="Login Illustration"
        class="w-full max-w-xs lg:max-w-md transform -translate-y-6">
    </div>

    <!-- Form Login -->
    <div class="w-full lg:w-2/3 flex items-center justify-center bg-white lg:shadow-lg p-4 lg:p-6">
      <div class="w-full max-w-md">
        <div class="text-center mt-4 mb-8 lg:mb-12">
          <!-- Perbaiki margin logo -->
          <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="NextEdu Logo" class="h-10 lg:h-12 mx-auto">
          <p class="text-gray-600 font-semibold mt-1">Masuk ke akun Anda</p>
        </div>

        <form action="/login" method="POST">
          @csrf
          <div class="grid grid-cols-1 gap-y-3">
            <!-- Email -->
            <div class="form-group">
              <label class="label" for="email">Email</label>
              <div class="rectangle">
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="input-field"
                  placeholder="Masukkan email..">
                <div class="icon-container">
                  <div class="icon email-icon"></div>
                </div>
              </div>
              @error('email')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

           <!-- Password -->
<div class="form-group">
  <label class="label" for="password">Password</label>
  <div class="rectangle relative">
    <input type="password" id="password" name="password" class="input-field"
      placeholder="Masukkan password..">
    
    <!-- Added both eye icons with proper positioning -->
    <!-- Toggle button positioned to the left of the lock icon -->
    <div class="absolute right-14 top-1/2 transform -translate-y-1/2 cursor-pointer z-10" id="togglePassword">
      <!-- Eye open icon -->
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="h-5 w-5 text-black hidden" id="showPassword">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
      </svg>
      
      <!-- Eye closed icon -->
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="h-5 w-5 text-black" id="hidePassword">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
      </svg>
    </div>
    
    <!-- Lock icon container -->
    <div class="icon-container">
      <div class="icon lock-icon"></div>
    </div>
  </div>
  @error('password')
  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
</div>

<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');
  const showPasswordIcon = document.getElementById('showPassword');
  const hidePasswordIcon = document.getElementById('hidePassword');
  
  togglePassword.addEventListener('click', function() {
    // Toggle the password field type
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      showPasswordIcon.classList.remove('hidden');
      hidePasswordIcon.classList.add('hidden');
    } else {
      passwordInput.type = 'password';
      showPasswordIcon.classList.add('hidden');
      hidePasswordIcon.classList.remove('hidden');
    }
  });
</script>
            <!-- Lupa Password -->
            <div class="flex justify-end items-center -mt-1 -left-20">
              <!-- In your login page, change this link: -->
              <a href="{{ route('password.request') }}" class="forgot-password">Lupa password?</a>
            </div>

            <!-- Tombol Login -->
            <button type="submit"
              class="w-full text-white py-2.5 lg:py-3 rounded-lg mt-6 lg:mt-8 transition bg-[#493D9E] hover:bg-purpleHover font-semibold">
              Masuk
            </button>

            <div class="flex-row">
              <div class="line"></div>
              <span class="atau">Atau</span>
              <div class="line-6"></div>
            </div>

            <!-- Tombol Login dengan Google (diubah dari tombol Register) -->
            <a href="{{ route('login.google') }}"
            class="flex items-center justify-center gap-2 w-full py-3 rounded-lg border border-gray-300 hover:bg-gray-50 transition-all h-12">
            <img src="{{ asset('assets/icon/google-icon.svg') }}" alt="Google" class="w-5 h-5">
            <span class="font-medium">Masuk dengan Google</span>
            </a>

            <!-- Link Pengalihan ke Register -->
            <div class="text-center mt-4 text-gray-500 text-sm">
              Belum punya akun? <a href="/register" class="text-purpleMain font-semibold">Daftar di sini</a>
            </div>

        </form>
      </div>
    </div>
  </div>


</body>

</html>