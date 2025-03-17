<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
 
    <link rel="icon" href="{{ asset(path: 'assets//logo.png') }}" sizes="128x128" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<body class="bg-gray-100">
<div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-1/5 bg-purpleMain border-2 border-purpleMain text-white shadow-lg flex flex-col items-center rounded-r-3xl overflow-hidden">
            <!-- Logo area with white background -->
            <div class="w-full bg-white py-8 px-6 flex justify-center items-center">
                <div class="flex items-center">
                    <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="nextEdu Logo" class="w-40 h-auto mr-2">
                   \
                </div>
            </div>

            <!-- Navigation Items -->
            <nav class="w-full px-6 py-6 flex-grow">
                <a href="/adminDashboard" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium hover:bg-white mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    Dashboard
                </a>
                
                <a href="/pertanyaans" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium hover:bg-indigo-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Settings Pertanyaan
                </a>
                
                <a href="/jurusans" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium hover:bg-indigo-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Settings Jurusan
                </a>
                
                <a href="/hasil-tes" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium hover:bg-indigo-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Hasil Tes
                </a>
                
                <a href="/payment" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium hover:bg-indigo-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Data Payment
                </a>
                
                <a href="/artikels" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium hover:bg-indigo-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Settings Artikel
                </a>
                
                <a href="/rules" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium hover:bg-indigo-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    Settings Rules
                </a>
                
                <a href="/users" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium hover:bg-indigo-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Settings User
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="w-4/5 p-8">
            <!-- White box as main container -->
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">Overview</h1>
                    <input type="text" placeholder="Search" class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-indigo-400">
                </div>

                <section class="grid grid-cols-4 gap-4">
                    <div class="bg-white p-6 rounded-md shadow-md text-center">
                        <h2 class="text-4xl font-bold text-indigo-700">{{ count($pertanyaansInfo ?? []) }}</h2>
                        <p class="text-lg text-gray-600">Jumlah Pertanyaan</p>
                    </div>
                    <div class="bg-white p-6 rounded-md shadow-md text-center">
                        <h2 class="text-4xl font-bold text-indigo-700">{{ count($jurusansInfo ?? [])}}</h2>
                        <p class="text-lg text-gray-600">Total List Jurusan</p>
                    </div>
                    <div class="bg-white p-6 rounded-md shadow-md text-center">
                        <h2 class="text-4xl font-bold text-indigo-700">{{ count($artikelsInfo ?? []) }}</h2>
                        <p class="text-lg text-gray-600">Total Artikel Masuk</p>
                    </div>
                    <div class="bg-white p-6 rounded-md shadow-md text-center">
                        <h2 class="text-4xl font-bold text-indigo-700">{{ count($usersInfo ?? []) }}</h2>
                        <p class="text-lg text-gray-600">New Customer</p>
                    </div>
                </section>

                <div class="mt-8">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>