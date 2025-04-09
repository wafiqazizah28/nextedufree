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
  <title>Reset Password - nextEdu</title>
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
    </ul>
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

    <!-- Form Reset Password -->
    <div class="w-full lg:w-2/3 flex items-center justify-center bg-white lg:shadow-lg p-4 lg:p-6">
      <div class="w-full max-w-md">
        <div class="text-center mt-4 mb-8 lg:mb-12">
          <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="NextEdu Logo" class="h-10 lg:h-12 mx-auto">
          <p class="text-gray-600 font-semibold mt-1">Reset Password</p>
        </div>

        @if (session('success'))
          <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
          </div>
        @endif

        @if (session('error'))
          <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
            {{ session('error') }}
          </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">
          <input type="hidden" name="email" value="{{ $email }}">
          
          <div class="grid grid-cols-1 gap-y-3">
            <!-- Password Baru -->
            <div class="form-group">
              <label class="label" for="password">Password Baru</label>
              <div class="rectangle">
                <input type="password" id="password" name="password" class="input-field"
                    placeholder="Masukkan password baru..">
                <div class="icon-container">
                    <div class="icon lock-icon"></div>
                </div>
              </div>
              @error('password')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group">
              <label class="label" for="password_confirmation">Konfirmasi Password</label>
              <div class="rectangle">
                <input type="password" id="password_confirmation" name="password_confirmation" class="input-field"
                    placeholder="Konfirmasi password baru..">
                <div class="icon-container">
                    <div class="icon lock-icon"></div>
                </div>
              </div>
            </div>

            <!-- Tombol Reset Password -->
            <button type="submit"
              class="w-full text-white py-2.5 lg:py-3 rounded-lg mt-6 lg:mt-8 transition bg-[#493D9E] hover:bg-purple-700">
              Reset Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>

</body>

</html>