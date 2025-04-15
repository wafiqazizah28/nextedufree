<!-- resources/views/faq.blade.php -->
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextEdu - FAQ</title>
    <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280;
        }
        .faq-card {
            transition: all 0.3s ease;
        }
        .hidden-card {
            display: none;
        }
    </style>
</head>
<body class="bg-lightcream">
    <!-- FAQ Section -->
    <section class="bg-lightcream py-10">
        <div class="container mx-auto px-4">
            <!-- FAQ Header -->
            <div class="text-center mb-8">
                <span class="text-gray-500 text-sm">FAQs</span>
                <h1 class="text-purpleMain text-3xl font-semibold mt-2">Tanyakan apa saja kepada kami</h1>
                <p class="text-gray-600 mt-2">Ada pertanyaan? Kami siap membantu Anda.</p>
            </div>

            <!-- Search Bar -->
            <div class="max-w-md mx-auto mb-12 relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="search-icon h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input 
                    type="text" 
                    id="faqSearch" 
                    placeholder="Cari di sini" 
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- FAQ Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="faqContainer">
                @foreach($faqs as $faq)
                    <!-- FAQ Card -->
                    <div class="bg-white p-6 rounded-lg shadow-sm faq-card" data-faq-content="{{ strtolower($faq['question']) }} {{ strtolower($faq['answer']) }}">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-orange-100 text-orange-500 mb-4">
                            @if($faq['icon'] == 'email')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            @elseif($faq['icon'] == 'clipboard')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            @elseif($faq['icon'] == 'chat')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            @elseif($faq['icon'] == 'alert')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @elseif($faq['icon'] == 'lock')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $faq['question'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $faq['answer'] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="text-center py-8 hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-700">Tidak ditemukan hasil</h3>
                <p class="text-gray-500 mt-2">Coba dengan kata kunci lain</p>
            </div>

            <!-- Additional Help -->
            <div class="bg-amber-50 p-6 rounded-lg mt-12 max-w-4xl mx-auto">
                <h3 class="text-lg font-medium text-gray-800 mb-2">Masih ada pertanyaan?</h3>
                <p class="text-gray-600 mb-4">Tidak menemukan jawaban yang Anda cari? Silakan mengobrol dengan tim kami yang ramah.</p>
                <div class="flex justify-end">
                    <a href="mailto:official.nextedu@gmail.com" class="bg-purpleMain text-white px-5 py-2 rounded-md hover:bg-indigo-700 transition">
                      Hubungi kami
                    </a>
                  </div>
                  
            </div>
        </div>
    </section>

    <!-- JavaScript for Search Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('faqSearch');
            const faqCards = document.querySelectorAll('.faq-card');
            const noResultsElement = document.getElementById('noResults');
            const faqContainer = document.getElementById('faqContainer');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();
                let hasResults = false;

                faqCards.forEach(card => {
                    const content = card.getAttribute('data-faq-content');
                    
                    if (content.includes(searchTerm)) {
                        card.classList.remove('hidden-card');
                        hasResults = true;
                    } else {
                        card.classList.add('hidden-card');
                    }
                });

                // Show/hide no results message
                if (hasResults) {
                    noResultsElement.classList.add('hidden');
                    faqContainer.classList.remove('hidden');
                } else {
                    noResultsElement.classList.remove('hidden');
                    faqContainer.classList.add('hidden');
                }
            });

            // Clear search when pressing Escape
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    this.value = '';
                    // Trigger the input event to update the display
                    this.dispatchEvent(new Event('input'));
                }
            });
        });
    </script>
</body>
</html>
@endsection