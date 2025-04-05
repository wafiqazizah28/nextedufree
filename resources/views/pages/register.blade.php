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
    <div class="w-full lg:w-1/2 flex items-center justify-center px-4 py-4 lg:py-0">
      <img src="{{ asset('assets/img/imgRegister.svg') }}" alt="Login Illustration"
      class="w-full max-w-xs md:max-w-sm lg:max-w-md mx-auto lg:transform lg:-translate-y-6">
    </div>


    <!-- Form Pendaftaran -->
    <div class="w-full lg:w-2/3 flex items-center justify-center bg-white lg:shadow-lg p-4 lg:p-6 mt-[-50px]">
      <div class="w-full max-w-md">
        <div class="text-center mt-20 mb-8 lg:mb-12">
          <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="NextEdu Logo" class="h-10 lg:h-12 mx-auto">
          <p class="text-gray-600 font-semibold mt-2">Buat akun Anda</p>
        </div>

        <div class="form-container-register">
          <form action="/register" method="POST">
            @csrf
            <div class="grid-register">
              <!-- Form fields unchanged -->
              <!-- Nama -->
              <div>
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama:</label>
                <div class="input-box">
                  <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="input-field-register"
                    placeholder="Masukkan nama..">
                  @error('nama')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <!-- Asal Sekolah -->
              <div>
                <label for="sekolah" class="block mb-2 text-sm font-medium text-gray-900">Asal Sekolah:</label>
                <div class="input-box">
                  <input type="text" id="sekolah" name="sekolah" value="{{ old('sekolah') }}"
                    class="input-field-register" placeholder="Masukkan asal sekolah..">
                  @error('sekolah')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email:</label>
                <div class="input-box">
                  <input type="email" id="email" name="email" value="{{ old('email') }}" class="input-field-register"
                    placeholder="Masukkan email..">
                  @error('email')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <!-- No Handphone -->
              <div>
                <label for="nomer_hp" class="block mb-2 text-sm font-medium text-gray-900">No Handphone:</label>
                <div class="input-box">
                  <input type="text" id="nomer_hp" name="nomer_hp" value="{{ old('nomer_hp') }}"
                    class="input-field-register" placeholder="Masukkan nomor HP..">
                  @error('nomer_hp')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <!-- Password -->
              <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password:</label>
                <div class="input-box">
                  <input type="password" id="password" name="password" class="input-field-register"
                    placeholder="Masukkan password..">
                  @error('password')
                  <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <!-- Konfirmasi Password -->
              <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Konfirmasi
                  Password:</label>
                <div class="input-box">
                  <input type="password" id="password_confirmation" name="password_confirmation"
                    class="input-field-register" placeholder="Konfirmasi password..">
                </div>
              </div>
            </div>

            <!-- Both buttons container -->
            <div class="mt-8 space-y-4 button-container max-w-sm mx-auto">
              <!-- Tombol Sign Up - Fixed consistency in height and padding -->
              <button type="submit"
                class="w-full bg-purpleMain text-white py-3 rounded-lg transition hover:bg-purple-700 h-12 flex items-center justify-center">
                Daftar </button>

              <!-- Improved divider with equal lines -->
              <div class="flex items-center justify-center my-4">
                <div class="flex-grow h-px bg-gray-300"></div>
                <span class="px-4 text-sm text-gray-500">Atau</span>
                <div class="flex-grow h-px bg-gray-300"></div>
              </div>

              <!-- Google Sign-up Button - Consistent height -->
              <a href="{{ route('login.google') }}"
                class="flex items-center justify-center gap-2 w-full py-3 rounded-lg border border-gray-300 hover:bg-gray-50 transition-all h-12">
                <img src="{{ asset('assets/icon/google-icon.svg') }}" alt="Google" class="w-5 h-5">
                <span class="font-medium">Daftar dengan Google</span>
              </a>

              <!-- Login Link for Existing Users -->
              <div class="text-center mt-6 pb-4">
                <p class="text-gray-600">
                  Sudah punya akun?
                  <a href="/login" class="text-purpleMain font-medium hover:text-purple-800 transition">
                    Login di sini
                  </a>
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>

</html>