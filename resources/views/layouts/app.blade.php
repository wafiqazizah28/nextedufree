<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

  <!-- CSS untuk adjustment navbar fixed -->
  <style>
    /* Memberikan padding atas pada main content untuk kompensasi navbar fixed */
    main {
      padding-top: 70px; /* Sesuaikan dengan tinggi navbar */
    }
    
    /* Flash messages adjustment */
    .flash-message {
      top: 80px; /* Sesuaikan posisi flash message agar tidak tertutup navbar */
    }
    
    /* Untuk halaman dengan header hero, hapus padding-top */
    .has-hero-header main {
      padding-top: 0;
    }
    
    /* Navbar transparent khusus untuk halaman dengan hero image */
    .has-hero-header #navbar {
      background-color: transparent;
      box-shadow: none;
    }
    
    /* Navbar akan menjadi putih saat di-scroll */
    .has-hero-header #navbar.navbar-fixed {
      background-color: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(5px);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<!-- Tambahkan class has-hero-header pada body halaman yang memiliki hero image di bagian atas -->
<body class="{{ request()->is('/') ? 'has-hero-header' : '' }}">
  @include('components.navbar')

  @if (session()->has('success'))
    <div
      class="flash-message sticky left-1/2 z-20 flex min-h-[50px] w-[300px] -translate-x-1/2 justify-between gap-x-4 bg-secondary px-5 pt-3.5 pb-4 text-white">
      <p>{{ session('success') }}</p>
      <button class="h-fit hover:text-white/75" onclick="this.parentNode.parentNode.removeChild(this.parentNode)">
        X
      </button>
    </div>
  @elseif(session()->has('error'))
    <div
      class="flash-message sticky left-1/2 z-20 flex min-h-[50px] w-[300px] -translate-x-1/2 justify-between gap-x-4 bg-red-500 px-5 pt-3.5 pb-4 text-white">
      <p>{{ session('error') }}</p>
      <button class="h-fit hover:text-white/75" onclick="this.parentNode.parentNode.removeChild(this.parentNode)">
        X
      </button>
    </div>
  @endif
  <main>
    @yield('content')
  </main>

  @include('components.footer')
  <script src="js/script.js"></script>
  @vite('resources/js/app.js')
</body>

</html>