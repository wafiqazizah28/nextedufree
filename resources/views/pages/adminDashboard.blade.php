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
            min-height: calc(100vh - 4rem);
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

        /* Modern navbar styles */
        .navbar {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .navbar-scrolled {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            background-color: rgba(255, 255, 255, 0.95);
        }

        .profile-dropdown {
            transform-origin: top right;
            transform: scale(0.95);
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
        }

        .profile-dropdown.active {
            transform: scale(1);
            opacity: 1;
            visibility: visible;
        }

        .dropdown-item {
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(124, 58, 237, 0.1);
        }

        .page-title {
            position: relative;
            display: inline-block;
        }

        .page-title::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #7C3AED;
            transition: all 0.3s ease;
        }

        /* Mobile Sidebar Styles */
        #sidebar {
            transition: transform 0.3s ease;
            width: 250px;
            position: fixed;
            height: 100%;
            z-index: 1030;
        }

        .content-container {
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 1024px) {
            #sidebar {
                transform: translateX(0) !important;
            }

            .content-container {
                margin-left: 250px;
            }

            .navbar {
                width: calc(100% - 250px) !important;
                left: 250px;
            }
        }

        @media (max-width: 1023px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.sidebar-active {
                transform: translateX(0);
            }

            .content-container {
                margin-left: 0;
                width: 100%;
            }

            .navbar {
                width: 100% !important;
                left: 0;
            }
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1020;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body class="bg-white">
    <div class="flex min-h-screen">
        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        <!-- Sidebar with scroll container -->
        <aside id="sidebar"
            class="bg-purpleMain border-2 border-purpleMain text-white shadow-lg flex flex-col items-center rounded-r-3xl overflow-hidden">
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

                    <a href="/jurusan"
                        class="flex items-center px-3 py-2 rounded-lg text-sm font-medium hover:bg-white hover:text-purpleMain mb-2 transition-colors duration-200 btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Settings Jurusan
                    </a>

                    <a href="/hasil-tes"
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
                </svg >                      Settings Sekolah
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

        <div class="content-container flex-1 flex flex-col">
            <!-- Modern Sticky Navbar -->
            <nav
            class="navbar fixed top-0 left-0 right-0 w-full bg-white/95 shadow-sm py-4 px-6 flex items-center justify-between transition-all duration-300 z-50">
            <!-- Mobile Menu Button -->
                <button id="mobile-menu-button"
                    class="lg:hidden flex items-center justify-center text-gray-700 hover:text-purple-600 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Judul Halaman dengan animasi underline -->
                <div class="flex items-center">
                    <h1 class="page-title text-gray-700 font-semibold text-lg">
                        @yield('title', 'Admin Nextedu')
                    </h1>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button class="flex items-center focus:outline-none group" id="profile-menu-button">
                            <div class="flex items-center space-x-3">
                                <!-- Profile Image with purple gradient -->
                                <div
                                    class="h-10 w-10 rounded-full bg-gradient-to-r from-purple-500 to-indigo-600 flex items-center justify-center text-white shadow-md overflow-hidden transition duration-300 group-hover:shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>

                                <!-- Admin Name -->
                                <div class="text-left hidden md:block">
                                    <p
                                        class="text-sm font-medium text-gray-700 group-hover:text-purple-700 transition-colors duration-200">
                                        {{ Auth::user()->nama }}</p>
                                    <p class="text-xs text-gray-500">Administrator</p>
                                </div>

                                <!-- Dropdown indicator -->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-400 transition-transform duration-200 group-hover:text-purple-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="profile-dropdown absolute right-0 mt-2 w-60 bg-white rounded-xl shadow-lg py-2 ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
                            id="profile-menu" role="menu" aria-orientation="vertical"
                            aria-labelledby="profile-menu-button">

                            <!-- Profile Header -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-1">
                                <!-- Profile settings options could go here -->
                            </div>

                            <!-- Logout -->
                            <!-- Logout - Replace the existing logout link in the dropdown menu with this code -->
                            <form method="POST" action="/logout"
                            id="logout-form">
                                @csrf
                                <button type="submit"
                                    class="dropdown-item flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full text-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-red-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Spacer for fixed navbar -->
            <div class="h-20"></div>

            <!-- Main Content -->
            <main class="flex-1 p-8">
                <!-- Dashboard Content -->
                <div class="content-wrapper bg-white rounded-lg shadow-md p-6 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Statistik</h1>
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
                                <h2 class="text-4xl font-bold text-purpleMain">{{ count($pertanyaanInfo ?? []) }}</h2>
                                <p class="text-gray-600 mt-2">Jumlah Pertanyaan</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg border p-6 shadow-sm">
                            <div class="flex flex-col items-center">
                                <h2 class="text-4xl font-bold text-purpleMain">{{ count($jurusanInfo ?? [])}}</h2>
                                <p class="text-gray-600 mt-2">Total List Jurusan</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg border p-6 shadow-sm">
                            <div class="flex flex-col items-center">
                                <h2 class="text-4xl font-bold text-purpleMain">{{ count($artikelInfo ?? []) }}</h2>
                                <p class="text-gray-600 mt-2">Total Artikel Masuk</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg border p-6 shadow-sm">
                            <div class="flex flex-col items-center">
                                <h2 class="text-4xl font-bold text-purpleMain">{{ count($usersInfo ?? []) }}</h2>
                                <p class="text-gray-600 mt-2">Total Pengguna</p>
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
        document.addEventListener('DOMContentLoaded', function() {
       // Elements
       const mobileMenuBtn = document.getElementById('mobile-menu-button');
       const sidebar = document.getElementById('sidebar');
       const overlay = document.getElementById('sidebar-overlay');
       const profileButton = document.getElementById('profile-menu-button');
       const profileMenu = document.getElementById('profile-menu');
       
       // 1. Mobile sidebar toggle functionality
       function toggleSidebar() {
           sidebar.classList.toggle('sidebar-active');
           overlay.classList.toggle('active');
           document.body.classList.toggle('overflow-hidden');
       }
       
       if (mobileMenuBtn) {
           // Make sure we use proper event binding 
           mobileMenuBtn.addEventListener('click', function(e) {
               e.preventDefault(); // Prevent default behavior
               toggleSidebar();
           });
       }
       
       if (overlay) {
           overlay.addEventListener('click', toggleSidebar);
       }
       
       // 2. Profile dropdown toggle functionality
       function toggleProfileMenu(e) {
           e.preventDefault(); // Prevent default behavior
           e.stopPropagation(); // Prevent event bubbling
           profileMenu.classList.toggle('active');
       }
       
       if (profileButton && profileMenu) {
           profileButton.addEventListener('click', toggleProfileMenu);
           
           // Close the dropdown when clicking outside
           document.addEventListener('click', function(event) {
               if (profileMenu.classList.contains('active') && 
                   !profileButton.contains(event.target) && 
                   !profileMenu.contains(event.target)) {
                   profileMenu.classList.remove('active');
               }
           });
       }
       
       // 3. Close sidebar when clicking on a link (mobile)
       const sidebarLinks = document.querySelectorAll('#sidebar a');
       sidebarLinks.forEach(link => {
           link.addEventListener('click', function() {
               if (window.innerWidth < 1024 && sidebar.classList.contains('sidebar-active')) {
                   toggleSidebar();
               }
           });
       });
       
       // 4. Handle window resize
       window.addEventListener('resize', function() {
           if (window.innerWidth >= 1024) {
               sidebar.classList.remove('sidebar-active');
               overlay.classList.remove('active');
               document.body.classList.remove('overflow-hidden');
           }
       });
       
       // 5. Sticky navbar effect on scroll
       const navbar = document.querySelector('.navbar');
       window.addEventListener('scroll', function() {
           if (window.scrollY > 10) {
               navbar.classList.add('navbar-scrolled');
           } else {
               navbar.classList.remove('navbar-scrolled');
           }
       });
       
       // 6. Content transition effect for sidebar links
       sidebarLinks.forEach(link => {
           link.addEventListener('click', function(e) {
               // Only apply for internal links
               if (!e.ctrlKey && !e.metaKey && !e.shiftKey) {
                   const contentContainer = document.getElementById('content-container');
                   
                   if (contentContainer) {
                       // Add fade out animation
                       contentContainer.style.opacity = '0.5';
                       contentContainer.style.transition = 'opacity 0.2s ease';
                       
                       // Restore opacity after new page loads
                       setTimeout(() => {
                           contentContainer.style.opacity = '1';
                       }, 300);
                   }
               }
           });
       });
       
       // 7. Form submission handling
       const forms = document.querySelectorAll('form');
       forms.forEach(form => {
           form.addEventListener('submit', function() {
               // Disable all buttons to prevent double clicks
               const buttons = form.querySelectorAll('button[type="submit"]');
               buttons.forEach(button => {
                   button.disabled = true;
                   button.classList.add('opacity-75', 'cursor-not-allowed');
                   
                   // Add spinner if needed
                   const originalText = button.innerHTML;
                   button.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Loading...';
                   
                   // Restore button after timeout (if request takes too long)
                   setTimeout(() => {
                       button.disabled = false;
                       button.classList.remove('opacity-75', 'cursor-not-allowed');
                       button.innerHTML = originalText;
                   }, 5000); // 5 seconds timeout
               });
           });
       });
              function setInitialState() {
           // Check for desktop/mobile view
           if (window.innerWidth >= 1024) {
               sidebar.classList.remove('sidebar-active');
               overlay.classList.remove('active');
               document.body.classList.remove('overflow-hidden');
           }
           
           // Initialize navbar state
           if (window.scrollY > 10) {
               navbar.classList.add('navbar-scrolled');
           }
       }
       
       // Execute initial setup
       setInitialState();
   });
    </script>