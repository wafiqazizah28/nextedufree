<!-- Simpan file ini sebagai components/navbar.blade.php -->

<header id="navbar" class="fixed top-0 left-0 z-10 w-full bg-white transition-all duration-300">
    <!-- Add Poppins font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
        
        /* Style untuk hamburger menu */
        .hamburger-line {
            @apply my-2 block h-[2px] w-[30px] bg-dark;
        }
        
        .hamburger-active > span:nth-child(1) {
            @apply rotate-45;
        }
        
        .hamburger-active > span:nth-child(2) {
            @apply scale-0;
        }
        
        .hamburger-active > span:nth-child(3) {
            @apply -rotate-45;
        }
        
        /* Style untuk navbar saat scroll */
        .navbar-fixed {
            @apply fixed z-[9999] bg-white bg-opacity-80 backdrop-blur-sm;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Style untuk avatar dan dropdown */
        .avatar-dropdown {
            transition: all 0.2s ease-in-out;
        }

        .avatar-dropdown:hover .dropdown-menu {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
        }

        .dropdown-menu {
            visibility: hidden;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
    </style>
    <div class="container max-w-6xl mx-auto">
        <div class="relative flex items-center justify-between lg:py-2 py-1">
            <!-- Logo for mobile view -->
            <div class="lg:hidden flex items-center ml-8">
                <a href="/">
                    <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="Logo" class="w-28 sm:w-28">
                </a>
            </div>
            
            <nav id="nav-menu"
                class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg lg:static lg:block lg:max-w-full lg:rounded-none lg:bg-transparent lg:shadow-none lg:ml-auto lg:py-2 transition-all duration-300 ease-in-out">
                <ul class="block lg:flex lg:items-center">
                    <!-- Logo aligned with navigation but positioned higher -->
                    <li class="group">
                        <div class="px-4 lg:flex lg:items-center hidden lg:-mt-3">
                            <a href="/">
                                <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="Logo" class="w-28">
                            </a>
                        </div>
                    </li>
                    <li class="group">
                        <a href="/"
                            class="text-black font-medium mx-4 lg:mx-8 flex py-2 text-base group-hover:text-purpleMain font-poppins">Beranda</a>
                    </li>
                    <li class="group">
                        <a href="/tesminatmu"
                            class="text-black font-medium mx-4 lg:mx-8 flex py-2 text-base group-hover:text-purpleMain">Tes
                            Minatmu</a>
                    </li>
                    <li class="group">
                        <a href="/tanyaJurpan"
                            class="text-black font-medium mx-4 lg:mx-8 flex py-2 text-base group-hover:text-purpleMain">Edubot</a>
                    </li>
                    <li class="group">
                        <a href="/artikelPage"
                            class="text-black font-medium mx-4 lg:mx-8 flex py-2 text-base group-hover:text-purpleMain">Artikel</a>
                    </li>
                    @auth
                        <li class="group">
                            <a href="/dashboard"
                                class="text-black font-medium mx-4 lg:mx-8 flex py-2 text-base group-hover:text-purpleMain">Riwayat
                                Tes</a>
                        </li>
                        
                    @endauth
                    <li class="lg:hidden block">
                        <div class="flex flex-col space-y-2 px-4 mt-2">
                            @if (auth()->user() !== null)
                                <a href="{{ route('profile.show') }}" class="w-full text-center bg-gray-200 text-gray-800 py-2 rounded-lg text-base font-semibold hover:bg-gray-300 transition mb-2">
                                    Profil Saya
                                </a>
                                <form action='/logout' method="post" class="w-full">
                                    @csrf
                                    <button
                                        class="w-full bg-purpleMain text-white font-bold py-2 rounded-lg hover:bg-purple-800 transition text-center">
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="/login"
                                class="w-full text-center bg-purpleMain text-white py-2 rounded-lg text-base font-semibold hover:bg-purple-800 transition">
                                Login
                                </a>
                                <a href="/register"
                                class="w-full text-center bg-purpleMain text-white py-2 rounded-lg text-base font-semibold hover:bg-purple-800 transition">
                                Register
                                </a>
                            @endif
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="flex items-center lg:hidden ml-auto mr-4">
                <button id="hamburger" name="hamburger" type="button" class="block p-2">
                    <span class="hamburger-line origin-top-left transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line origin-bottom-left transition duration-300 ease-in-out"></span>
                </button>
            </div>

            <!-- Updated User Avatar Section -->
            <div class="ml-auto flex items-center px-4 lg:flex hidden">
                @if (auth()->user() !== null)
                    <div class="avatar-dropdown relative">
                        <button class="flex items-center space-x-3 focus:outline-none py-1 px-2 rounded-lg hover:bg-gray-100 transition-all max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg">
                            @if(auth()->user()->foto)
                                <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto Profil"
                                    class="w-10 h-10 rounded-full object-cover  shadow-sm">
                            @else
                                <div
                                    class="w-10 h-10 bg-purple-100 flex items-center justify-center rounded-full text-sm font-bold text-purpleMain border-2 border-purple-200 shadow-sm">
                                    {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                                </div>
                            @endif
                        
                            <div class="flex flex-col items-start truncate">
                                <span class="text-gray-800 font-medium text-sm font-poppins truncate">{{ auth()->user()->nama }}</span>
                            </div>
                        
                            <!-- Dropdown arrow icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        

                        <!-- Improved dropdown menu styling -->
                        <div class="dropdown-menu absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg overflow-hidden z-50">
                            <div class="py-3 px-4 bg-purple-50 border-b border-gray-200">
                                <p class="text-sm font-medium text-gray-700">Selamat datang</p>
                                <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->nama }}</p>
                            </div>
                            <div class="py-1">
                                <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purpleMain">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        Dashboard
                                    </div>
                                </a>
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purpleMain">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profil Saya
                                    </div>
                                </a>
                                @if(auth()->user()->is_admin)
                                <a href="/adminDashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purpleMain">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Admin Dashboard
                                    </div>
                                </a>
                                @endif
                            </div>
                            <div class="border-t border-gray-200">
                                <form action='/logout' method="post">
                                    @csrf
                                    <button class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Logout
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex space-x-3">
                        <a href="/login"
                            class="bg-purpleMain text-white font-bold px-6 py-3 rounded-lg hover:bg-purple-800 transition font-poppins">
                            Login
                        </a>
                        <a href="/register"
                            class="bg-purpleMain text-white font-bold px-6 py-3 rounded-lg hover:bg-purple-800 transition">
                            Register
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>

<!-- Tambahkan script ini di bagian bawah file atau di app.js -->
<script>
    // Fungsi untuk mengatur navbar fixed saat scrolling
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        const fixedNav = navbar.offsetTop;
        
        if (window.pageYOffset > fixedNav) {
            navbar.classList.add('navbar-fixed');
        } else {
            navbar.classList.remove('navbar-fixed');
        }
    });
    
    // Fungsi hamburger menu
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');
    
    hamburger.addEventListener('click', function() {
        hamburger.classList.toggle('hamburger-active');
        navMenu.classList.toggle('hidden');
    });
    
    // Klik di luar hamburger untuk menutup menu
    window.addEventListener('click', function(e) {
        if (!hamburger.contains(e.target) && !navMenu.contains(e.target)) {
            navMenu.classList.add('hidden');
            hamburger.classList.remove('hamburger-active');
        }
    });
</script>