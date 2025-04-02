<header class="absolute top-0 left-0 z-10 w-full bg-transparent">
    <!-- Add Poppins font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        .font-poppins {
            font-family: 'Poppins', sans-serif;
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
                    <li class="group">
                        <div class="px-4 lg:mt-0 mt-[-8px]">
                            <a href="/">
                                <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="Logo"
                                    class="w-28 lg:w-28 sm:w-24">
                            </a>
                        </div>
                    </li>
                    <li class="group">
                        <a href="/"
                            class="text-black font-medium mx-4 lg:mx-6 flex py-2 text-base group-hover:text-purpleMain font-poppins">Beranda</a>
                    </li>
                    <li class="group">
                        <a href="/tesminatmu"
                            class="text-black font-medium mx-4 lg:mx-4 flex py-2 text-base group-hover:text-purpleMain">Tes
                            Minatmu</a>
                    </li>
                    <li class="group">
                        <a href="/tanyaJurpan"
                            class="text-black font-medium mx-4 lg:mx-4 flex py-2 text-base group-hover:text-purpleMain">Edubot</a>
                    </li>
                    <li class="group">
                        <a href="/artikelPage"
                            class="text-black font-medium mx-4 lg:mx-4 flex py-2 text-base group-hover:text-purpleMain">Artikel</a>
                    </li>
                    <li class="group">
                        @auth
                            <a href="/dashboard"
                                class="text-black font-medium mx-4 lg:mx-4 flex py-2 text-base group-hover:text-purpleMain">Riwayat
                                Tes</a>
                        @endauth
                    </li>
                    <li class="lg:hidden block">
                        <div class="flex flex-col space-y-2 px-4 mt-2">
                            @if (auth()->user() !== null)
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

            <div class="ml-auto flex items-center px-4 lg:flex hidden space-x-3">
                @if (auth()->user() !== null)
                    <div class="relative group">
                        <button class="flex items-center space-x-2 focus:outline-none">
                            @if(auth()->user()->foto)
                                <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto Profil"
                                    class="w-10 h-10 rounded-full object-cover border-2 border-gray-300">
                            @else
                                <div
                                    class="w-10 h-10 bg-gray-300 flex items-center justify-center rounded-full text-sm font-bold">
                                    {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                                </div>
                            @endif
                            <span class="text-black font-medium">{{ auth()->user()->nama }}</span>
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden group-hover:block">
                            <a href="/dashboard" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Dashboard</a>
                            <a href="{{ route('profile.show') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Profil Saya</a>
                            <form action='/logout' method="post">
                                @csrf
                                <button class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-200">Logout</button>
                            </form>
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