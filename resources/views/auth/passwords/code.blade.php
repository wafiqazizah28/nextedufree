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
  <title>Verifikasi Kode - nextEdu</title>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .digit-input {
      width: 60px;
      height: 60px;
      text-align: center;
      font-size: 24px;
      border-radius: 8px;
      border: 1px solid #493D9E;
    }
    .timer {
      font-size: 14px;
      color: #666;
    }
  </style>
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

  <div class="flex flex-col lg:flex-row w-full h-screen">
    <!-- Ilustrasi (Di sebelah kanan di desktop) -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-4 order-2 lg:order-1">
      <div class="w-full max-w-md p-6">
        <div class="text-center mb-8">
          <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="NextEdu Logo" class="h-10 lg:h-12 mx-auto">
          <h5 class="text-gray-600 font-semibold mt-3">Konfirmasi Kode</h5>
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

        <div class="text-center mb-6">
          <p class="text-gray-600">Silahkan masukkan 4 digit kode<br>yang dikirimkan ke {{ $email }}</p>
        </div>

        <form method="POST" action="{{ route('password.code.verify') }}" id="codeForm">
          @csrf

          <div class="flex justify-center gap-3 mb-6">
            <input type="text" name="digit1" class="digit-input" maxlength="1" inputmode="numeric" required autofocus 
              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input type="text" name="digit2" class="digit-input" maxlength="1" inputmode="numeric" required 
              oninput="this.value = this.value.replace(/[^0-9]/g, '')">  
            <input type="text" name="digit3" class="digit-input" maxlength="1" inputmode="numeric" required
              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input type="text" name="digit4" class="digit-input" maxlength="1" inputmode="numeric" required
              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
          </div>

          <div class="flex justify-between items-center mb-6">
            <span class="timer">Kode Kadaluarsa <span id="countdown">03:00</span></span>
            
            <button type="button" id="resendBtn" class="text-[#493D9E] hover:text-purple-700 text-sm font-medium">
              Kirim Ulang
            </button>
          </div>

          <button type="submit" class="w-full text-white py-2.5 lg:py-3 rounded-lg transition bg-[#493D9E] hover:bg-purple-700">
            Verifikasi
          </button>
        </form>
      </div>
    </div>

    <!-- Image on the right -->
    <div class="w-full lg:w-1/2 bg-[#493D9E] flex items-center justify-center p-6 order-1 lg:order-2">
      <img src="{{ asset('assets/img/imgReset.png') }}" alt="Security Illustration" class="w-full max-w-md">
    </div>
  </div>

  <script>
    // Auto-focus to next input
    document.addEventListener('DOMContentLoaded', function() {
      const digitInputs = document.querySelectorAll('.digit-input');
      
      digitInputs.forEach((input, index) => {
        input.addEventListener('input', function() {
          if (this.value.length === 1) {
            if (index < digitInputs.length - 1) {
              digitInputs[index + 1].focus();
            } else {
              this.blur();
            }
          }
        });
        
        input.addEventListener('keydown', function(e) {
          // Allow backspace to go to previous input
          if (e.key === 'Backspace' && this.value.length === 0 && index > 0) {
            digitInputs[index - 1].focus();
          }
        });
      });
      // Add this to your script section
document.getElementById('resendBtn').addEventListener('click', function() {
  // Create a form programmatically
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = '{{ route("password.code.resend") }}';
  
  // Add CSRF token
  const csrfToken = document.createElement('input');
  csrfToken.type = 'hidden';
  csrfToken.name = '_token';
  csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  form.appendChild(csrfToken);
  
  // Append form to body, submit it, and remove it
  document.body.appendChild(form);
  form.submit();
  document.body.removeChild(form);
});
      // Set up countdown timer
      let timeLeft = 180; // 3 minutes in seconds
      const countdownEl = document.getElementById('countdown');
      
      const timer = setInterval(() => {
        const minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        
        countdownEl.innerHTML = `${minutes}:${seconds}`;
        
        if (timeLeft <= 0) {
          clearInterval(timer);
          countdownEl.innerHTML = "00:00";
        }
        timeLeft--;
      }, 1000);
    });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>