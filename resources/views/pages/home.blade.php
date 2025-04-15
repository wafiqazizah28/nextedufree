@extends('layouts.app')

@section('content')


<section id="Home" class="pt-16 pb-16 lg:pt-24 lg:pb-20 bg-backgroundLight min-h-screen max-w-screen overflow-hidden">
    <div class="container mx-auto px-4">
        <!-- Hero Section -->
        <div class="flex flex-wrap items-center">
            <!-- Text Content - Full width on mobile, half on desktop -->
            <div class="w-full self-center px-4 lg:w-1/2 mb-8 lg:mb-0">
                <div class="flex flex-col">
                    <div>
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900" data-aos="fade-up">
                            Temukan
                        </h1>
                    </div>
                    <div class="flex space-x-2">
                        <h1 id="typing-text" class="text-3xl md:text-4xl lg:text-5xl font-bold text-purpleMain"
                            data-aos="fade-up">
                        </h1>
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900" data-aos="fade-up">
                            Sekarang
                        </h1>
                    </div>
                </div>
                <p class="mt-6 mb-4 text-slate-400 text-lg  max-w-xl  text-left text-textsecondary" data-aos="fade-up">
                    Temukan informasi lengkap seputar jurusan yang sesuai dengan minat dan bakatmu.
                </p>


                <div class="mb-6 mt-4" data-aos="fade-up">
                    <button type="button" onclick="window.location.href='/tesminatmu'"
                        class="flex items-center gap-2 text-purpleSecondarry hover:text-white border border-purpleSecondarry hover:bg-purpleHover focus:ring-4 focus:outline-none focus:ring-purple-200 font-medium rounded-lg text-base px-6 py-3 text-center">
                        Lihat Potensi
                        <svg class="rtl:rotate-180 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Hero Image - Full width on mobile, half on desktop -->
            <div class="w-full lg:w-1/2 flex justify-center lg:justify-end px-4 lg:pr-20 lg:pl-32">
                <img src="/assets/img/hero.svg" class="float-animation max-w-full lg:max-w-[420px] h-auto" alt="gambar1"
                    data-aos="zoom-in">
            </div>
        </div>

        <!-- Feature Boxes - Centered on all screens -->
        <div class="container mx-auto mt-7 px-4">
            <div class="flex flex-wrap justify-center gap-3">
                <div
                    class="flex flex-wrap justify-center items-stretch gap-3 bg-white rounded-lg p-3 shadow-md w-full md:w-auto">
                    <!-- Mobile: Stack vertically, Desktop: All in one row -->
                    <div class="flex flex-col lg:flex-row justify-center items-center gap-4 w-full">
                        <div class="flex flex-col items-center p-2 min-w-[75px]" data-aos="fade-up">
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">Minat</h3>
                            <p class="text-xxs text-gray-500 text-center">Hal yang kamu senangi</p>
                        </div>

                        <div class="flex flex-col items-center p-2 min-w-[75px]" data-aos="fade-up">
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">Bakat</h3>
                            <p class="text-xxs text-gray-500 text-center">Skills yang kamu miliki</p>
                        </div>

                        <div class="flex flex-col items-center p-2 min-w-[75px]" data-aos="fade-up">
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">Hasil</h3>
                            <p class="text-xxs text-gray-500 text-center">Lihat Hasilnya</p>
                        </div>

                        <!-- Button integrated in the same row for desktop -->
                        <div class="flex items-center justify-center w-full lg:w-auto mt-4 lg:mt-0">
                            <button onclick="window.location.href='/tanyaJurpan/page'"
                                class="w-full lg:w-auto bg-purpleMain text-white font-bold px-6 py-3 rounded-lg hover:bg-purpleHover transition-colors">
                                Tanya Jurpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const text = "Jurusanmu"; 
        const typingElement = document.getElementById("typing-text");
        let index = 0;
        let isDeleting = false;

        function typeText() {
            if (!isDeleting) {
                typingElement.innerHTML = text.substring(0, index);
                index++;
                if (index > text.length) {
                    isDeleting = true;
                    setTimeout(typeText, 1000);
                } else {
                    setTimeout(typeText, 150);
                }
            } else {
                typingElement.innerHTML = text.substring(0, index);
                index--;
                if (index === 0) {
                    isDeleting = false;
                }
                setTimeout(typeText, 100);
            }
        }

        typeText();
    });
</script>

<section id="tutorial"
    class="pt-12 pb-16 lg:pt-24 lg:pb-28 bg-backgroundPrimary h-w-screen max-w-screen overflow-hidden">
    <div class="container px-4 mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-8 lg:mb-12" data-aos="fade-up">
            <h2 class="text-3xl lg:text-5xl font-black mb-3 lg:mb-4">Hal yang perlu <span
                    class="text-purpleMain">dilakukan</span></h2>
            <p class="text-gray-600 max-w-2xl text-lg lg:text-2xl mx-auto">
                Kami memastikan Anda menemukan jurusan yang tepat dengan perencanaan matang dan sesuai dengan kebutuhan
                Anda.
            </p>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6 max-w-6xl mx-auto">

            <div class="bg-white p-5 lg:p-6 rounded-lg shadow-sm border border-purpleMain transition-all duration-300 
            hover:bg-gradient-to-b hover:from-white hover:to-[#FDE3D7] hover:text-black group" data-aos="fade-right">
                <div class="mb-3 lg:mb-4">
                    <img src="{{ asset('assets/icon/tutorial1.svg') }}" alt="Daftar Account"
                        class="w-8 h-8 lg:w-10 lg:h-10 text-[#FA7436]">
                </div>
                <h3 class="text-lg lg:text-xl font-semibold mb-2 text-[#FA7436]">Daftar Account</h3>
                <p class="text-sm lg:text-base text-gray-600 mb-4">
                    Daftar akunmu untuk mendapatkan hasil jurusanmu
                </p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-5 lg:p-6 rounded-lg shadow-sm border border-[#338DFF] transition-all duration-500 
        hover:bg-gradient-to-b hover:from-white hover:via-[#F0F8FF] hover:via-80% hover:to-[#E6F2FF] hover:text-black group"
                data-aos="fade-up">
                <div class="mb-3 lg:mb-4">
                    <img src="{{ asset('assets/icon/tutorial2.svg') }}" alt="tes"
                        class="w-8 h-8 lg:w-10 lg:h-10 text-[#338DFF]">
                </div>
                <h3 class="text-lg lg:text-xl font-semibold mb-2 text-[#338DFF]">Tes Minat</h3>
                <p class="text-sm lg:text-base text-gray-600 mb-4">
                    Lakukan Tes minatmu untuk mengetahui jurusan yang tepat.                </p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-5 lg:p-6 rounded-lg shadow-sm border border-[#F4B400] transition-all duration-500 
        hover:bg-gradient-to-b hover:from-white hover:via-[#FEF4E6] hover:via-80% hover:to-[#FDE7C5] hover:text-black group"
                data-aos="fade-left">
                <div class="mb-3 lg:mb-4">
                    <img src="{{ asset('assets/icon/tutorial3.svg') }}" alt="Lihat Hasil"
                        class="w-8 h-8 lg:w-10 lg:h-10 text-[#F4B400]">
                </div>
                <h3 class="text-lg lg:text-xl font-semibold mb-2 text-[#F4B400]">Lihat Hasil</h3>
                <p class="text-sm lg:text-base text-gray-600 mb-4">
                    Setelah itu kamu bisa menyaksikan hasil dari tes minatmu
                </p>
            </div>

        </div>
    </div>
</section>

<section id="tentang"
    class="pt-10 pb-32 lg:pt-20 lg:pb-28 bg-backgroundLight min-h-screen max-w-screen overflow-hidden">
    <div class="container grid lg:grid-cols-10 gap-8">

        <!-- Kolom Kiri: Teks -->
        <div class="lg:col-span-4 px-4 lg:pl-10" data-aos="fade-right" data-aos-duration="1000">
            <h1 class="text-3xl lg:text-4xl font-bold tracking-tight md:text-5xl">
                Apa itu <span>nextEdu</span>?
            </h1>
            <p class="text-gray-600 text-base md:text-lg my-4 lg:my-6">
                Sebuah website yang dirancang untuk membantu kamu menemukan jurusan yang paling sesuai dengan minat dan
                bakatmu menggunakan sistem pakar. Sistem ini menggabungkan pengetahuan dari para ahli di bidang
                pendidikan dan algoritma canggih untuk memberikan rekomendasi jurusan yang paling tepat.
            </p>
            <a href="https://www.instagram.com/nextedu.id/?igsh=OTY5Y2d4dzA5YW5t"
                class="inline-flex items-center px-4 py-2 lg:px-5 lg:py-3 text-sm lg:text-base font-medium text-white rounded-lg bg-purpleMain hover:bg-purpleHover focus:ring-4 focus:ring-purple-300">
                Selengkapnya
            </a>
        </div>

        <!-- Kolom Kanan: Maskot & Floating Cards -->
        <div class="lg:col-span-5 flex justify-center items-center relative mt-16 mb-24 lg:mt-0 lg:mb-0"
            data-aos="fade-left" data-aos-duration="1000">

            <!-- Maskot -->
            <img src="{{ asset('assets/img/jurpan-home.svg') }}" alt="Jurusanku Owl Mascot"
                class="w-[220px] md:w-[280px] lg:w-[300px] z-10 relative" data-aos="zoom-in" data-aos-duration="1200">

            <!-- Floating Cards -->
            <!-- Card 1 -->
            <div class="floating-card absolute top-[80%] left-2 lg:left-12 bg-white p-2 lg:p-3 rounded-lg shadow-lg w-[120px] lg:w-[140px] z-20"
                data-aos="fade-up" data-aos-delay="200">
                <h4 class="text-xs font-semibold mb-1">Penilaian Terbaik</h4>
                <div class="flex gap-1 text-xs lg:text-sm">
                    <span>😍</span>
                    <span>😊</span>
                    <span>😄</span>
                    <span>😃</span>
                    <span>😀</span>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="floating-card absolute top-[100%] right-2 lg:right-[-20px] transform -translate-y-1/2 translate-x-0 lg:translate-x-14 bg-white p-3 lg:p-4 rounded-lg shadow-lg w-[180px] lg:w-[250px] whitespace-normal z-20"
                data-aos="fade-up" data-aos-delay="400">
                <h3 class="text-base lg:text-lg font-bold text-purpleMain mb-1">95%</h3>
                <p class="text-gray-600 text-xs lg:text-sm font-semibold">Masukan Positif</p>
                <p class="text-xs text-gray-500">Pemberian masukan positif membawa dampak baik untuk perkembangan
                    website ini.</p>
            </div>

            <!-- Card 3 -->
            <div class="floating-card absolute top-0 right-0 lg:right-[-80px] translate-x-0 lg:translate-x-4 -translate-y-10 sm:-translate-y-2 bg-white p-3 lg:p-4 rounded-lg shadow-lg w-[160px] sm:w-auto max-w-[200px] lg:max-w-[260px] z-20"
                data-aos="fade-down" data-aos-delay="600">
                <h3 class="text-base lg:text-lg font-bold text-purpleMain mb-1">30,000+</h3>
                <p class="text-gray-600 text-xs lg:text-sm font-semibold">Total Pengguna</p>
                <p class="text-xs text-gray-500">Total penggunaan Jurusanku sebagai penentu masa depan mereka.</p>
            </div>

        </div>
    </div>
</section>

<section id="prospek"
    class="pt-12 pb-20 lg:pt-16 lg:pb-24 bg-backgroundPrimary min-h-screen max-w-screen overflow-hidden">
    <div class="container mx-auto">
        {{-- Header Section --}}
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold mb-4">Top peluang <span class="text-purpleMain">jurusan</span></h2>
            <p class="text-gray-600 text-1xl">
                Jurusan yang ada di SMK Muhammadiyah Kroya, dengan peluang <br> kerja dan kuliah terjamin.
            </p>
        </div>

        {{-- Cards Container --}}
        <div class="max-w-6xl mx-auto px-4 py-6">
            {{-- Grid Layout for Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- Card 1 - Sistem IT --}}
                <div data-aos="fade-up">
                    <a href="#"
                        class="bg-white rounded-lg shadow-orange transition-transform transform hover:scale-105 duration-300 block h-full border border-gray-200">
                        <img class="w-full h-64 object-cover rounded-t-lg" src="{{ asset('assets/img/prospek1.png') }}"
                            alt="Sistem IT">
                        <div class="p-8 flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Sistem IT</h3>
                            <span class="text-purpleMain font-bold">01</span>
                        </div>
                    </a>
                </div>

                {{-- Card 2 - Bisnis --}}
                <div data-aos="fade-up">
                    <a href="#"
                        class="bg-white rounded-lg shadow-orange transition-transform transform hover:scale-105 duration-300 block h-full border border-gray-200">
                        <img class="w-full h-64 object-cover rounded-t-lg" src="{{ asset('assets/img/prospek2.png') }}"
                            alt="Bisnis">
                        <div class="p-8 flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Bisnis</h3>
                            <span class="text-purpleMain font-bold">02</span>
                        </div>
                    </a>
                </div>

                {{-- Card 3 - Perkantoran --}}
                <div data-aos="fade-up">
                    <a href="#"
                        class="bg-white rounded-lg shadow-orange transition-transform transform hover:scale-105 duration-300 block h-full border border-gray-200">
                        <img class="w-full h-64 object-cover rounded-t-lg" src="{{ asset('assets/img/prospek3.png') }}"
                            alt="Perkantoran">
                        <div class="p-8 flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Perkantoran</h3>
                            <span class="text-purpleMain font-bold">03</span>
                        </div>
                    </a>
                </div>

                {{-- Card 4 - Admin Perkantoran --}}
                <div data-aos="fade-up">
                    <a href="#"
                        class="bg-white rounded-lg shadow-orange transition-transform transform hover:scale-105 duration-300 block h-full border border-gray-200">
                        <img class="w-full h-64 object-cover rounded-t-lg" src="{{ asset('assets/img/prospek4.png') }}"
                            alt="Admin Perkantoran">
                        <div class="p-8 flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Admin Perkantoran</h3>
                            <span class="text-purpleMain font-bold">04</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    
</section>

<section id="fitur"
    class="pt-16 pb-20 lg:pt-24 lg:pb-28 bg-backgroundLight min-h-screen max-w-screen overflow-hidden pl-8">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-8 items-center">
            <div class="space-y-6" data-aos="fade-right">
                <div class="max-w-xl">
                    <h2 class="text-5xl font-bold mb-4">Hal yang <span
                            class="text-indigo-600 text-purpleMain">didapatkan</span></h2>
                    <p class="text-gray-600 mb-8">
                        Kamu akan mendapatkan beberapa hal yang bermanfaat untuk jenjangmu kedepan
                    </p>
                </div>

                <div class="space-y-4">
                    {{-- Feature 1 --}}
                    <div class="flex items-start gap-4 p-4 bg-white rounded-lg transition shadow-md hover:shadow-lg hover:shadow-orange-200"
                        data-aos="fade-up" data-aos-delay="100">
                        <div class="p-2 bg-purpleMain rounded-full flex items-center justify-center w-10 h-10">
                            <img src="{{ asset('assets/icon/fitur1.svg') }}" alt="Prospek Kerja" class="w-6 h-6  ">
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-indigo-600">Prospek Kerja</h3>
                            <p class="text-gray-600">Jurusan yang telah dianalisis akan memiliki berapa persen prospek
                                kerja</p>
                        </div>
                    </div>

                    {{-- Feature 2 --}}
                    <div class="flex items-start gap-4 p-4 bg-white rounded-lg transition shadow-md hover:shadow-lg hover:shadow-orange-200"
                        data-aos="fade-up" data-aos-delay="200">
                        <div class="p-2 bg-purpleMain rounded-full flex items-center justify-center w-10 h-10">
                            <img src="{{ asset('assets/icon/fitur2.svg') }}" alt="Chat Bot" class="w-6 h-6  ">
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-indigo-600">Chat Bot</h3>
                            <p class="text-gray-600">Chat Bot AI untuk menemukan jawaban yang cepat</p>
                        </div>
                    </div>

                    {{-- Feature 3 --}}
                    <div class="flex items-start gap-4 p-4 bg-white rounded-lg transition shadow-md hover:shadow-lg hover:shadow-orange-200"
                        data-aos="fade-up" data-aos-delay="300">
                        <div class="p-2 bg-purpleMain rounded-full flex items-center justify-center w-10 h-10">
                            <img src="{{ asset('assets/icon/fitur3.svg') }}" alt="Jurusan yang sesuai" class="w-6 h-6 ">
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-indigo-600">Jurusan yang sesuai</h3>
                            <p class="text-gray-600">Kamu akan mendapatkan hasil jurusan sesuai dengan minat bakat kamu
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative w-4/5 mx-auto" data-aos="zoom-in">
                <img src="{{ asset('assets/img/fitur.png') }}" alt="Video Preview"
                    class="w-full h-auto max-w-3xl animate__animated animate__pulse animate__infinite animate__slower">
            </div>



        </div>
    </div>
</section>
<section id="testimoni" class="pt-20 pb-24 lg:pt-28 lg:pb-32 bg-backgroundLight">
    <div class="container mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-14 items-center">
            <!-- Left Section -->
            <div class="ml-10 lg:ml-20">
                <h2 class="text-5xl font-bold mb-3">Testimoni</h2>
                <h3 class="text-5xl font-bold text-purpleMain mb-6">nextEdu.</h3>
                <p class="text-lg text-gray-700 mb-8 leading-relaxed">
                    Sebuah ucapan kepuasan oleh customer yang pernah melakukan tes minat di nextEdu.
                </p>
                <div class="flex gap-6">
                    <button id="prevBtn" class="p-3 rounded-full border border-gray-400 hover:bg-gray-200 transition">
                        <img src="{{ asset('assets/icon/testimoni1.svg') }}" alt="Previous">
                    </button>
                    <button id="nextBtn"
                        class="p-3 rounded-full bg-purpleMain text-white hover:bg-indigo-700 transition">
                        <img src="{{ asset('assets/icon/testimoni2.svg') }}" alt="Next">
                    </button>
                </div>
            </div>

            <!-- Testimonial Cards Section -->
            <div class="relative w-full shadow-lg rounded-lg">
                @if ($testimonis->isEmpty())
                <p class="text-red-500">Tidak ada testimoni yang tersedia.</p>
                @else
                <div id="testimonialContainer" class="relative overflow-hidden">
                    @foreach ($testimonis as $index => $testimoni)
                    <div class="testimonial-item absolute w-full transition-all duration-500"
                        style="{{ $index === 0 ? 'opacity: 1; transform: translateX(0);' : 'opacity: 0; transform: translateX(100%);' }}"
                        data-index="{{ $index }}">
                        <!-- Main testimonial card -->
                        <div class="p-6 bg-white rounded-lg shadow-lg">
                            <div class="mb-4">
                                <svg class="w-8 h-8 text-purpleMain opacity-50" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                </svg>
                            </div>

                            <!-- Testimonial Content -->
                            <div class="text-lg text-gray-700 leading-relaxed mb-6">
                                {{ $testimoni->testimoni }}
                            </div>

                            <!-- User Info - Anonymous Only -->
                            <div class="flex items-center">

                                <div>
                                    <h4 class="text-lg font-semibold">
                                        Anonymous
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <!-- Shadow card for next testimonial -->
                        <div class="absolute top-2 left-2 -z-10 w-full h-full bg-gray-200 rounded-lg shadow-md"></div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    // Get all testimonial items
    const testimonials = document.querySelectorAll('.testimonial-item');
    const container = document.getElementById('testimonialContainer');
    let currentIndex = 0;
    
    if (testimonials.length === 0) {
        console.warn("No testimonials available");
        return;
    }
    
    // Set container height based on current testimonial
    function updateContainerHeight() {
        // Make all testimonials visible temporarily to get their true height
        testimonials.forEach(item => {
            const originalDisplay = item.style.display;
            const originalPosition = item.style.position;
            const originalVisibility = item.style.visibility;
            
            item.style.position = 'static';
            item.style.visibility = 'hidden';
            item.style.display = 'block';
            
            // After measurements, restore
            setTimeout(() => {
                item.style.position = originalPosition;
                item.style.visibility = originalVisibility;
                item.style.display = originalDisplay;
            }, 0);
        });
        
        // Set height to active testimonial
        const activeTestimonial = testimonials[currentIndex];
        if (activeTestimonial) {
            container.style.height = activeTestimonial.offsetHeight + 'px';
        }
    }
    
    // Initialize heights
    setTimeout(updateContainerHeight, 100);
    
    // Function to show testimonial at specific index
    function showTestimonial(index) {
        if (index < 0 || index >= testimonials.length) {
            console.error("Invalid testimonial index");
            return;
        }
        
        // Hide current testimonial
        testimonials[currentIndex].style.opacity = '0';
        testimonials[currentIndex].style.transform = 'translateX(-100%)';
        
        // Show new testimonial
        testimonials[index].style.opacity = '1';
        testimonials[index].style.transform = 'translateX(0)';
        
        // Update current index
        currentIndex = index;
        
        // Update container height
        setTimeout(updateContainerHeight, 300);
    }
    
    // Event listeners for navigation buttons
    document.getElementById("nextBtn").addEventListener("click", function() {
        const nextIndex = (currentIndex + 1) % testimonials.length;
        showTestimonial(nextIndex);
    });
    
    document.getElementById("prevBtn").addEventListener("click", function() {
        const prevIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
        showTestimonial(prevIndex);
    });
    
    // Handle window resize
    window.addEventListener('resize', updateContainerHeight);
    
    // Auto-play
    let interval = setInterval(() => {
        const nextIndex = (currentIndex + 1) % testimonials.length;
        showTestimonial(nextIndex);
    }, 6000);
    
    // Pause auto-play on hover
    container.addEventListener('mouseenter', () => {
        clearInterval(interval);
    });
    
    container.addEventListener('mouseleave', () => {
        interval = setInterval(() => {
            const nextIndex = (currentIndex + 1) % testimonials.length;
            showTestimonial(nextIndex);
        }, 6000);
    });
});
    </script>
</section>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
           duration: 1000, // Durasi animasi dalam milidetik
           easing: 'ease-in-out', // Efek transisi animasi
           once: false, // Biarkan animasi berjalan setiap kali masuk viewport
           mirror: true // Animasi tetap berjalan saat scroll ke atas
       });
</script>
@endsection