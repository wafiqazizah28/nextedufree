<header class="absolute top-0 left-0 z-10 flex w-full items-center bg-transparent">
    <div class="container">
        <div class="relative flex w-full items-center justify-between">


            <nav id="nav-menu" class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg 
          lg:static lg:block lg:max-w-full lg:rounded-none lg:bg-transparent lg:shadow-none lg:ml-auto">

                <ul class="block lg:flex">
                    <li class="group">
                        <div class="px-4 mt-[-8px]">
                            <a href="/">
                                <img src="{{ asset(path: 'assets/logo/logo-typo.svg') }}" alt="Logo"
                                    class="w-28 lg:w-32 sm:w-24">
                            </a>

                        </div>

                    </li>
                    <li class="group">
                        <a href="/" class="text-black font-medium mx-8 flex py-2 text-base group-hover:text-purpleMain">Beranda</a>
                    </li>
                    <li class="group">
                        <a href="/tesMinatmu" class="text-black font-medium mx-8 flex py-2 text-base group-hover:text-purpleMain">Tes Minatmu</a>
                    </li>
                    <li class="group">
                        <a href="/tanyaJurpan" class="text-black font-medium mx-8 flex py-2 text-base group-hover:text-purpleMain">Edubot</a>
                    </li>
                    <li class="group">
                        <a href="/artikelPage" class="text-black font-medium mx-8 flex py-2 text-base group-hover:text-purpleMain">Artikel</a>
                    </li>
                    <li class="group">
                        @auth
                        <a href="/dashboard" class="text-black font-medium mx-8 flex py-2 text-base group-hover:text-purpleMain">Riwayat Tes</a>
                        @endauth
                    </li>
                    
                    <li class="lg:hidden block">
                        <div class="flex flex-col">
                            @if (auth()->user() !== null)
                            <form action='/logout' method="post" class="px-8 py-2">
                                @csrf
                                <button
                                    class="bg-purpleMain text-white font-bold px-6 py-3 rounded-lg hover:bg-purple-800 transition">
                                    Logout </button>

                            </form>
                            @else
                            <a href="/login"
                                class="btnnn rounded-sm border-2 border-black bg-black py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black block mx-8 my-2">
                                Login
                            </a>
                            <a href="/register"
                                class="btnnn rounded-sm border-2 border-black bg-black py-2 px-5 text-white duration-300 ease-out hover:bg-white hover:text-black block mx-8 my-2">
                                Register
                            </a>
                            @endif
                        </div>
                    </li>

                </ul>
            </nav>

            <!-- HAMBURGER MENU (Dipindah ke kanan) -->
            <div class="flex items-center lg:hidden ml-auto">
                <button id="hamburger" name="hamburger" type="button" class="block">
                    <span class="hamburger-line origin-top-left transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line origin-bottom-left transition duration-300 ease-in-out"></span>
                </button>
            </div>

            <div class="ml-auto flex items-center px-4 lg:flex hidden space-x-3">
                @if (auth()->user() !== null)
                <form action='/logout' method="post">
                    @csrf
                    <button
                        class="bg-purpleMain text-white font-bold px-6 py-3 rounded-lg hover:bg-purple-800 transition">
                        Logout </button>

                </form>
                @else
                <div class="flex space-x-3">
                    <a href="/login"
                        class="bg-purpleMain text-white font-bold px-6 py-3 rounded-lg hover:bg-purple-800 transition">
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