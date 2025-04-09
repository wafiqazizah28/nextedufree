@extends('layouts.app')

@section('content')
<section class="bg-white min-h-screen py-8 md:py-16">
    <div class="container mx-auto px-4 max-w-5xl">

        <!-- Header with subtle animation -->
        <div class="mb-6 md:mb-8 animate-fade-in">
            <h2 class="text-lg md:text-xl font-medium text-gray-600">Hallo, {{ auth()->user()->nama }} 👋🏻
            </h2>
            <h3 class="text-2xl md:text-3xl font-bold mt-1">
                <span class="text-gray-800">Profil </span>
                <span class="text-purpleMain">Anda</span>
            </h3>
        </div>

        <!-- Profile Card with subtle shadow and improved layout -->
        <div class="bg-white shadow-md hover:shadow-lg transition-shadow duration-300 rounded-2xl p-4 md:p-8 relative overflow-hidden border border-gray-100">
            
            <!-- Glass-effect decorative elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-purple-100 rounded-full opacity-20 -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-purpleMain-100 rounded-full opacity-20 -ml-10 -mb-10"></div>
            
            <!-- Update Button with improved hover effect and responsive placement -->
            <div class="absolute top-4 md:top-6 right-4 md:right-6 z-50">
                <form action="{{ route('profile.edit') }}" method="GET">
                    <button type="submit" 
                        class="bg-purpleMain hover:bg-purpleHover text-white text-xs md:text-sm font-medium px-3 py-2 md:px-5 md:py-2.5 rounded-lg transition-all duration-200 flex items-center gap-1 md:gap-2 shadow-sm hover:shadow w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <span class="whitespace-nowrap">Perbarui Profil</span>
                    </button>
                </form>
            </div>


            <!-- Profile Information with improved layout -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-4 md:gap-6 relative z-10 mt-4 md:mt-0">
                <!-- Avatar with animated border on hover -->
                <div class="group">
                    @if(auth()->user()->foto)
                        <div class="w-24 h-24 md:w-28 md:h-28 rounded-full overflow-hidden ring-4 ring-purpleMain group-hover:ring-purple-200 transition-all duration-300 shadow-md">
                            <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto Profil"
                                class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center rounded-full text-xl md:text-2xl font-bold text-white shadow-md ring-4 ring-purple-100 group-hover:ring-purple-200 transition-all duration-300">
                            {{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}
                        </div>
                    @endif
                </div>

                <div class="mt-3 grid gap-2 w-full">
                    <div class="grid grid-cols-[120px_1fr] md:grid-cols-[150px_1fr] text-gray-600">
                        <span class="font-medium text-left">Nomer telepon:</span>
                        <span class="break-words">{{ auth()->user()->nomer_hp ?? 'Belum diatur' }}</span>
                    </div>
                    <div class="grid grid-cols-[120px_1fr] md:grid-cols-[150px_1fr] text-gray-600">
                        <span class="font-medium text-left">Sekolah:</span>
                        <span class="break-words">{{ auth()->user()->sekolah ?? 'Belum diatur' }}</span>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- About NextEdu Card with improved design -->
        <div class="mt-6 md:mt-8">
            <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                <div class="flex flex-col md:flex-row">
                    <!-- Left content -->
                    <div class="p-6 md:p-8 md:w-3/5">
                        <h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4">Tentang <span class="text-purpleMain">nextEdu!</span></h3>
                        <p class="text-sm md:text-base text-gray-600">
                            nextEdu adalah platform yang membantu kamu memilih jurusan dan sekolah terbaik sesuai dengan 
                            <a  class="text-purpleMain font-semibold hover:text-purpleMain transition-colors">minat dan bakat</a>. 
                            Dapatkan informasi seputar <a  class="text-purpleMain font-semibold hover:text-purpleMain transition-colors">info jurusan</a>, 
                            dan prospek kerja untuk masa depan yang lebih cerah.
                        </p>
                        
                        <!-- Call to action button -->
                        
                    </div>
                    
                    <!-- Right image/illustration area -->
                    <div class="bg-gradient-to-br from-blue-100 to-yellow-100 p-4 md:p-6 md:w-2/5 flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-24 h-24 md:w-32 md:h-32 mx-auto bg-white rounded-full flex items-center justify-center shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 md:h-16 md:w-16 text-purpleMain" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <p class="mt-3 md:mt-4 text-sm md:text-base text-purpleMain-700 font-medium">Pelajari Lebih Lanjut</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

<style>
/* Add custom utility classes if needed */
.break-words {
    word-break: break-word;
}
</style>