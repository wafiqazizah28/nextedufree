{{-- @dd($disease); --}}
{{-- @dd($user); --}}

@extends('layouts.app')

@section('content')

<section id="Home" class="pt-16 pb-16 lg:pt-24 lg:pb-20 bg-backgroundLight min-h-screen max-w-screen overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-center">
            <div class="w-full self-center px-4 lg:w-1/2">
                <div class="flex flex-col">
                    <div class="flex space-x-2">
                        <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white" data-aos="fade-up">
                            Temukan</h1>
                    </div>
                    <div class="flex space-x-2">
                        <h1 id="typing-text" class="text-5xl lg:text-6xl font-bold text-purpleMain" data-aos="fade-up">
                        </h1>
                        <h1 class="text-5xl lg:text-6xl font-bold text-gray-900" data-aos="fade-up">Sekarang</h1>
                    </div>
                </div>

                <p class="mt-4 mb-4 max-w-md text-slate-500" data-aos="fade-up">
                    Temukan informasi lengkap seputar jurusan yang sesuai dengan minat dan bakatmu.
                </p>

                <div class="mb-6" data-aos="fade-up">
                    <button type="button"
                        class="flex items-center gap-2 text-purpleSecondarry hover:text-white border border-purpleSecondarry hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Lihat potensimu
                        <svg class="rtl:rotate-180 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Bagian Gambar -->
            <div class="w-full lg:w-1/2 flex justify-center lg:justify-end lg:pl-32">
                <img src="/assets/img/hero.svg" class="float-animation max-w-[420px] h-auto" alt="gambar1"
                    data-aos="zoom-in">
            </div>

        </div>

        <!-- Feature Boxes -->
        <div class="container mx-auto mt-6">
            <div class="flex flex-wrap justify-center gap-3">
                <div class="flex flex-wrap justify-center items-stretch gap-3 bg-white rounded-lg p-3 shadow-md">
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

                    <div class="flex items-center">
                        <button
                            class="bg-purpleMain text-white font-bold px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors"
                            data-aos="">
                            Tes minatmu
                        </button>
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
    class="pt-16 pb-20 lg:pt-24 lg:pb-28 bg-backgroundPrimary h-w-screen max-w-screen overflow-hidden">
    <div class="container">
        <!-- Header Section -->
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-5xl font-black mb-4">Hal yang perlu <span class="text-purpleMain">dilakukan</span></h2>
            <p class="text-gray-600 max-w-2xl text-2xl mx-auto">
                Kami memastikan Anda menemukan jurusan yang tepat dengan perencanaan matang dan sesuai dengan kebutuhan
                Anda.
            </p>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">

            <div class="bg-white p-6 rounded-lg shadow-sm border border-purpleMain transition-all duration-300 
            hover:bg-gradient-to-b hover:from-white hover:to-[#FDE3D7] hover:text-black group" data-aos="fade-right">
                <div class="mb-4">
                    <img src="{{ asset('assets/icon/tutorial1.svg') }}" alt="Daftar Account"
                        class="w-10 h-10 text-[#FA7436]">
                </div>
                <h3 class="text-xl font-semibold mb-2 text-black">Daftar Account</h3>
                <p class="text-gray-600 mb-4">
                    Daftar akunmu untuk mendapatkan hasil jurusanmu
                </p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-[#338DFF] transition-all duration-500 
        hover:bg-gradient-to-b hover:from-white hover:via-[#F0F8FF] hover:via-80% hover:to-[#E6F2FF] hover:text-black group"
                data-aos="fade-up">
                <div class="mb-4">
                    <img src="{{ asset('assets/icon/tutorial2.svg') }}" alt="Pembayaran"
                        class="w-10 h-10 text-[#338DFF]">
                </div>
                <h3 class="text-xl font-semibold mb-2 text-[#338DFF]">Pembayaran</h3>
                <p class="text-gray-600 mb-4">
                    Pembayaran dengan mudah agar kamu bisa melakukan tes minatmu
                </p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-[#F4B400] transition-all duration-500 
        hover:bg-gradient-to-b hover:from-white hover:via-[#FEF4E6] hover:via-80% hover:to-[#FDE7C5] hover:text-black group"
                data-aos="fade-left">
                <div class="mb-4">
                    <img src="{{ asset('assets/icon/tutorial3.svg') }}" alt="Lihat Hasil"
                        class="w-10 h-10 text-[#F4B400]">
                </div>
                <h3 class="text-xl font-semibold mb-2 text-[#F4B400]">Lihat Hasil</h3>
                <p class="text-gray-600 mb-4">
                    Setelah itu kamu bisa menyaksikan hasil dari tes minatmu
                </p>
            </div>

        </div>
    </div>
</section>

<section id="tentang"
    class="pt-16 pb-20 lg:pt-20 lg:pb-28 bg-backgroundLight min-h-screen max-w-screen overflow-hidden">
    <div class="container grid lg:grid-cols-10 gap-8">

        <!-- Kolom Kiri: Teks -->
        <div class="lg:col-span-4 pl-10" data-aos="fade-right" data-aos-duration="1000">
            <h1 class="text-4xl font-bold tracking-tight md:text-5xl">
                Apa itu <span>Jurusanku</span>?
            </h1>
            <p class="text-gray-600 md:text-lg my-6">
                Sebuah website yang dirancang untuk membantu kamu menemukan jurusan yang paling sesuai dengan minat dan
                bakatmu menggunakan sistem pakar. Sistem ini menggabungkan pengetahuan dari para ahli di bidang
                pendidikan dan algoritma canggih untuk memberikan rekomendasi jurusan yang paling tepat.
            </p>
            <a href="#"
                class="inline-flex items-center px-5 py-3 text-base font-medium text-white rounded-lg bg-purpleMain hover:bg-purple-700 focus:ring-4 focus:ring-purple-300">
                Selengkapnya
            </a>
        </div>

        <!-- Kolom Kanan: Maskot & Floating Cards -->
        <div class="lg:col-span-5 flex justify-center items-center relative" data-aos="fade-left"
            data-aos-duration="1000">

            <!-- Maskot -->
            <img src="{{ asset('assets/img/jurpan-home.svg') }}" alt="Jurusanku Owl Mascot"
                class="w-[270px] md:w-[320px] lg:w-[300px] z-10 relative" data-aos="zoom-in" data-aos-duration="1200">

            <!-- Floating Cards -->
            <div class="floating-card absolute top-[80%] left-12 bg-white p-3 rounded-lg shadow-lg w-[140px] z-20"
                data-aos="fade-up" data-aos-delay="200">
                <h4 class="text-xs font-semibold mb-1">Penilaian Terbaik</h4>
                <div class="flex gap-1 text-sm">
                    <span>😍</span>
                    <span>😊</span>
                    <span>😄</span>
                    <span>😃</span>
                    <span>😀</span>
                </div>
            </div>

            <div class="floating-card absolute top-[100%] right-[-20px] transform -translate-y-1/3 translate-x-14 bg-white p-4 rounded-lg shadow-lg w-[250px] whitespace-normal z-20"
                data-aos="fade-up" data-aos-delay="400">
                <h3 class="text-lg font-bold text-purpleMain mb-1">95%</h3>
                <p class="text-gray-600 text-sm font-semibold">Masukan Positif</p>
                <p class="text-xs text-gray-500">Pemberian masukan positif membawa dampak baik untuk perkembangan
                    website ini.</p>
            </div>

            <div class="floating-card absolute top-0 right-[-80px] translate-x-4 -translate-y-2 bg-white p-4 rounded-lg shadow-lg w-auto max-w-[260px] z-20"
                data-aos="fade-down" data-aos-delay="600">
                <h3 class="text-lg font-bold text-purpleMain mb-1">30,000+</h3>
                <p class="text-gray-600 text-sm font-semibold">Total Pengguna</p>
                <p class="text-xs text-gray-500">Total penggunaan Jurusanku sebagai penentu masa depan mereka.</p>
            </div>

        </div>
    </div>
</section>

<section id="prospek"
    class="pt-12 pb-20 lg:pt-16 lg:pb-24 bg-backgroundPrimary min-h-screen max-w-screen overflow-hidden">
    <script>
        document.querySelectorAll(".hover-card").forEach(card => {
            card.addEventListener("mouseenter", () => {
                card.classList.add("scale-105", "shadow-lg");
            });
    
            card.addEventListener("mouseleave", () => {
                card.classList.remove("scale-105", "shadow-lg");
            });
        });
    </script>

    <div class="container mx-auto">
        {{-- Header Section --}}
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold mb-4">Top peluang <span class="text-purpleMain">jurusan</span></h2>
            <p class="text-gray-600 text-1xl">
                Jurusan yang banyak diminati dengan prospek kuliah <br> dan kerja terbaik
            </p>
        </div>


        {{-- Cards Container --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8 lg:gap-12 max-w-6xl mx-auto px-4">
            {{-- Card 1 - Sistem IT --}}
            <div class="flex justify-center" data-aos="fade-up">
                <a href="#"
                    class="bg-white w-[290px] h-[320px] rounded-lg shadow-sm hover:shadow-lg transition-transform transform hover:scale-105 duration-300">
                    <img class="w-full h-50 object-cover rounded-t-lg" src="{{ asset('assets/img/prospek1.png') }}"
                        alt="Sistem IT">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Sistem IT</h3>
                        <span class="text-purpleMain font-bold">01</span>
                    </div>
                </a>
            </div>

            {{-- Card 2 - Bisnis --}}
            <div class="flex justify-center" data-aos="fade-up">
                <a href="#"
                    class="bg-white w-[290px] h-[320px] rounded-lg shadow-sm hover:shadow-lg transition-transform transform hover:scale-105 duration-300">
                    <img class="w-full h-50 object-cover rounded-t-lg" src="{{ asset('assets/img/prospek2.png') }}"
                        alt="Bisnis">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Bisnis</h3>
                        <span class="text-purpleMain font-bold">02</span>
                    </div>
                </a>
            </div>

            {{-- Card 3 - Perkantoran --}}
            <div class="flex justify-center" data-aos="fade-up">
                <a href="#"
                    class="bg-white w-[290px] h-[320px] rounded-lg shadow-sm hover:shadow-lg transition-transform transform hover:scale-105 duration-300">
                    <img class="w-full h-50 object-cover rounded-t-lg" src="{{ asset('assets/img/prospek3.png') }}"
                        alt="Perkantoran">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-xl font-semibold">Perkantoran</h3>
                        <span class="text-purpleMain font-bold">03</span>
                    </div>
                </a>
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


<section id="testimoni" class="pt-20 pb-24 lg:pt-28 lg:pb-32 bg-backgroundLight h-auto max-w-screen overflow-hidden">
    <div class="container mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-14 items-center">
            <!-- Bagian Kiri -->
            <div class="ml-10 lg:ml-20" data-aos="fade-right" data-aos-duration="1000">
                <h2 class="text-5xl font-bold mb-3">Testimoni</h2>
                <h3 class="text-5xl font-bold text-purpleMain mb-6">nextEdu.</h3>
                <p class="text-lg text-gray-700 mb-8 leading-relaxed">
                    Sebuah ucapan kepuasan oleh customer yang pernah melakukan tes minat di nextEdu.
                </p>
                <div class="flex gap-6">
                    <button id="prevBtn"
                        class="p-3 rounded-full border border-gray-400 hover:bg-gray-200 transition animate__animated animate__bounceIn">
                        <img src="{{ asset('assets/icon/testimoni1.svg') }}" alt="">

                    </button>
                    <button id="nextBtn"
                        class="p-3 rounded-full bg-purpleMain text-white hover:bg-indigo-700 transition animate__animated animate__bounceIn">
                        <img src="{{ asset('assets/icon/testimoni2.svg') }}" alt="">
                    </button>


                </div>
            </div>

            <!-- Bagian Testimoni -->
            <div class="relative w-full max-w-lg">
                <!-- Testimoni Aktif -->
                <div class="bg-white p-8 rounded-lg shadow-xl transition-all duration-500 relative z-10"
                    id="testimonial" data-aos="zoom-in" data-aos-duration="1200">
                    <p class="text-lg text-gray-700 mb-6 leading-relaxed" id="testiText">
                        "Hasil yang sangat memuaskan, pertanyaan yang disebutkan mudah dipahami, berkat nextEdu kini
                        saya belajar sesuai dengan minat saya."
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('assets/img/profile.png') }}" alt="Zizi"
                            class="w-14 h-14 rounded-full object-cover" id="testiImage">

                        <div>
                            <h4 class="text-lg font-semibold" id="testiName">Zizi</h4>
                            <p class="text-gray-600" id="testiSchool">SMP 1 Purwokerto</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni Berikutnya -->
                <div class="absolute top-16 left-6 bg-white p-8 rounded-lg shadow-lg opacity-40 scale-95 transition-all duration-500 transform translate-x-4"
                    id="nextTestimonial" data-aos="fade-up" data-aos-delay="500">
                    <p class="text-lg text-gray-500 mb-6 leading-relaxed" id="nextTestiText">
                        "Tes minat ini sangat membantu saya dalam menentukan jurusan. Sekarang saya lebih yakin dengan
                        pilihan saya!"
                    </p>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('assets/img/profile2.jpg') }}" alt="Aisyah" class="w-14 h-14 rounded-full"
                            id="nextTestiImage">
                        <div>
                            <h4 class="text-lg font-semibold" id="nextTestiName">Aisyah</h4>
                            <p class="text-gray-500" id="nextTestiSchool">SMA Negeri 3 Jakarta</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    const testimonials = [
        {
            text: "Hasil yang sangat memuaskan, pertanyaan yang disebutkan mudah dipahami, berkat nextEdu kini saya belajar sesuai dengan minat saya.",
            image: "{{ asset('assets/img/profile.jpg') }}",
            name: "Irfan",
            school: "SMP 1 Purwokerto"
        },
        {
            text: "Tes minat ini sangat membantu saya dalam menentukan jurusan. Sekarang saya lebih yakin dengan pilihan saya!",
            image: "{{ asset('assets/img/profile2.jpg') }}",
            name: "Aisyah",
            school: "SMA Negeri 3 Jakarta"
        },
        {
            text: "Menakjubkan! Tes ini membuat saya semakin mengenal potensi diri saya sendiri.",
            image: "{{ asset('assets/img/profile3.jpg') }}",
            name: "Budi",
            school: "SMA 2 Surabaya"
        }
    ];

    let currentIndex = 0;

    document.getElementById("prevBtn").addEventListener("click", function() {
        currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
        updateTestimonial();
    });

    document.getElementById("nextBtn").addEventListener("click", function() {
        currentIndex = (currentIndex + 1) % testimonials.length;
        updateTestimonial();
    });

    function updateTestimonial() {
        // Testimoni utama
        document.getElementById("testiText").innerText = testimonials[currentIndex].text;
        document.getElementById("testiImage").src = testimonials[currentIndex].image;
        document.getElementById("testiName").innerText = testimonials[currentIndex].name;
        document.getElementById("testiSchool").innerText = testimonials[currentIndex].school;

        // Testimoni berikutnya dengan efek bayangan
        let nextIndex = (currentIndex + 1) % testimonials.length;
        document.getElementById("nextTestiText").innerText = testimonials[nextIndex].text;
        document.getElementById("nextTestiImage").src = testimonials[nextIndex].image;
        document.getElementById("nextTestiName").innerText = testimonials[nextIndex].name;
        document.getElementById("nextTestiSchool").innerText = testimonials[nextIndex].school;
    }
</script>

<script>
    const testimonials = [
            {
                text: "Hasil yang sangat memuaskan, pertanyaan yang disebutkan mudah dipahami, berkat nextEdu kini saya belajar sesuai dengan minat saya.",
                image: "{{ asset('assets/img/profile.jpg') }}",
                name: "Irfan",
                school: "SMP 1 Purwokerto"
            },
            {
                text: "Tes minat ini sangat membantu saya dalam menentukan jurusan. Sekarang saya lebih yakin dengan pilihan saya!",
                image: "{{ asset('assets/img/profile2.jpg') }}",
                name: "Aisyah",
                school: "SMA Negeri 3 Jakarta"
            },
            {
                text: "Menakjubkan! Tes ini membuat saya semakin mengenal potensi diri saya sendiri.",
                image: "{{ asset('assets/img/profile3.jpg') }}",
                name: "Budi",
                school: "SMA 2 Surabaya"
            }
        ];
    
        let currentIndex = 0;
    
        document.getElementById("prevBtn").addEventListener("click", function() {
            currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
            updateTestimonial();
        });
    
        document.getElementById("nextBtn").addEventListener("click", function() {
            currentIndex = (currentIndex + 1) % testimonials.length;
            updateTestimonial();
        });
    
        function updateTestimonial() {
            // Testimoni utama
            document.getElementById("testiText").innerText = testimonials[currentIndex].text;
            document.getElementById("testiImage").src = testimonials[currentIndex].image;
            document.getElementById("testiName").innerText = testimonials[currentIndex].name;
            document.getElementById("testiSchool").innerText = testimonials[currentIndex].school;
    
            // Testimoni berikutnya dengan efek bayangan
            let nextIndex = (currentIndex + 1) % testimonials.length;
            document.getElementById("nextTestiText").innerText = testimonials[nextIndex].text;
            document.getElementById("nextTestiImage").src = testimonials[nextIndex].image;
            document.getElementById("nextTestiName").innerText = testimonials[nextIndex].name;
            document.getElementById("nextTestiSchool").innerText = testimonials[nextIndex].school;
        }
</script>
</section>
{{-- Section 3: Subscribe --}}

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