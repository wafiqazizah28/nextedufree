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
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('assets/favicon_io/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512"
        href="{{ asset('assets/favicon_io/android-chrome-512x512.png') }}">
    <title>nextEdu</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        .content-wrapper {
            min-height: calc(100vh - 2rem);
            transition: all 0.2s ease-in-out;
        }

        .btn-action {
            position: relative;
            overflow: hidden;
        }

        .btn-action::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%, -50%);
            transform-origin: 50% 50%;
        }

        .btn-action:focus::after {
            animation: ripple 0.6s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(30, 30);
                opacity: 0;
            }
        }

        /* Fixed sidebar scrolling */
        .sidebar-container {
            height: 100vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
        }

        .sidebar-container::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-container::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        /* Pre-load state untuk mencegah layout shift */
        .preload-container {
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body class="bg-white">
    <div class="flex min-h-screen">
        <!-- Sidebar with scroll container -->
        <aside
            class="w-1/5 h-screen bg-purpleMain border-2 border-purpleMain text-white shadow-lg flex flex-col items-center rounded-r-3xl overflow-hidden fixed">
            <div class="sidebar-container w-full">
                <!-- Logo area with white background -->
                <div class="w-full bg-white py-6 px-4 flex justify-center items-center">
                    <div class="flex items-center">
                        <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="nextEdu Logo" class="w-32 h-auto">
                    </div>
                </div>

                <!-- Navigation Items -->
                <nav class="w-full px-4 py-4 flex-grow">
                    <a href="/adminDashboard"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="/pertanyaan"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Settings Pertanyaan
                    </a>

                    <!-- More menu items... (lainnya tetap sama) -->
                    <a href="/jurusan"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Settings Jurusan
                    </a>

                    <a href="/hasiltes"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Hasil Tes
                    </a>

                    <a href="/saranpekerjaan"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Saran Pekerjaan
                    </a>

                    <a href="/sekolah"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Setting Sekolah
                    </a>

                    <a href="/payment"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Data Payment
                    </a>

                    <a href="/artikels"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Settings Artikel
                    </a>

                    <a href="/testimoni"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Settings Testimoni
                    </a>

                    <a href="/rules"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Settings Rules
                    </a>

                    <a href="/users"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Settings User
                    </a>
                </nav>
            </div>
        </aside>

        <div class="w-1/5">
            <!-- Spacer untuk mengatasi sidebar fixed -->
        </div>

        <div class="flex-1 flex flex-col">
        
            <nav class="bg-white shadow-sm py-4 px-0 w-100 flex items-center justify-between">
                <!-- Judul Halaman (opsional) -->
                <div class="text-gray-600 font-medium text-lg border-b-2 border-purpleMain pb-2">
                    @yield('title', 'Admin Dashboard')
                </div>
                
                <!-- Profile Dropdown -->
                <div class="relative ml-4">
                    <button class="flex items-center focus:outline-none" id="profile-menu-button">
                        <div class="flex items-center">
                            <!-- Profile Image -->
                            <div class="h-10 w-10 rounded-full bg-purpleMain flex items-center justify-center text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            
                            <!-- Admin Name -->
                            <div class="ml-3 text-left">
                                <p class="text-sm font-medium text-gray-700">Admin Name</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </div>
                    </button>
        
                    <!-- Dropdown Menu -->
                    <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 focus:outline-none" 
                         id="profile-menu"
                         role="menu"
                         aria-orientation="vertical"
                         aria-labelledby="profile-menu-button">
                         
                       
                    </div>
                </div>
            </nav>
            <!-- Main Content -->
            <main class="flex-1 p-8">
                <!-- Dashboard Content -->
                <div class="content-wrapper bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Overview</h1>
                        <div class="flex items-center">
                            <div class="relative mr-4">
                                 <div class="absolute left-3 top-2.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <div class="bg-white rounded-lg border p-6 shadow-sm">
                            <div class="flex flex-col items-center">
                                <h2 class="text-4xl font-bold text-purple-600">{{ count($pertanyaanInfo ?? []) }}</h2>
                                <p class="text-gray-600 mt-2">Jumlah Pertanyaan</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg border p-6 shadow-sm">
                            <div class="flex flex-col items-center">
                                <h2 class="text-4xl font-bold text-purple-600">{{ count($jurusanInfo ?? [])}}</h2>
                                <p class="text-gray-600 mt-2">Total List Jurusan</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg border p-6 shadow-sm">
                            <div class="flex flex-col items-center">
                                <h2 class="text-4xl font-bold text-purple-600">{{ count($artikelInfo ?? []) }}</h2>
                                <p class="text-gray-600 mt-2">Total Artikel Masuk</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg border p-6 shadow-sm">
                            <div class="flex flex-col items-center">
                                <h2 class="text-4xl font-bold text-purple-600">{{ count($usersInfo ?? []) }}</h2>
                                <p class="text-gray-600 mt-2">New Customer</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8" id="content-container">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        // Script untuk menangani transisi halus saat button diklik
        document.addEventListener('DOMContentLoaded', function() {
            // Tangani semua button di sidebar
            const sidebarLinks = document.querySelectorAll('nav a');
            
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Hanya jika bukan link eksternal yang dibuka di tab baru
                    if (!e.ctrlKey && !e.metaKey && !e.shiftKey) {
                        const contentContainer = document.getElementById('content-container');
                        
                        // Tambahkan kelas loading untuk animasi fade out
                        contentContainer.style.opacity = '0.5';
                        contentContainer.style.transition = 'opacity 0.2s ease';
                        
                        // Kembalikan opacity setelah halaman baru dimuat
                        setTimeout(() => {
                            contentContainer.style.opacity = '1';
                        }, 300);
                    }
                });
            });
            
            // Form submission handling
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    // Disable semua button untuk mencegah klik ganda
                    const buttons = document.querySelectorAll('button[type="submit"]');
                    buttons.forEach(button => {
                        button.disabled = true;
                        button.classList.add('opacity-75', 'cursor-not-allowed');
                        
                        // Tambahkan spinner jika diperlukan
                        const originalText = button.innerHTML;
                        button.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Loading...';
                        
                        // Kembalikan tampilan button setelah timeout (jika request lama)
                        setTimeout(() => {
                            button.disabled = false;
                            button.classList.remove('opacity-75', 'cursor-not-allowed');
                            button.innerHTML = originalText;
                        }, 5000); // 5 detik timeout
                    });
                });
            });
        });
    </script>
</body>

</html>