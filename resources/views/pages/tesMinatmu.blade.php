@extends('layouts.app')

@section('content')
<section class="bg-backgroundLight min-h-screen max-w-screen overflow-hidden">
    <!-- Responsive Banner - No shadow, user greeting on the right -->
    <div class="relative w-full aspect-[16/9] sm:aspect-[16/8] md:aspect-[16/7] lg:min-h-[580px] bg-no-repeat bg-cover bg-center flex flex-col justify-center items-center px-4 sm:px-6 md:px-9"
    style="background-image: url('{{ asset('assets/img/bannerTes.png') }}');">
</div>


    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-700">Jawablah yang sesuai dengan dirimu!</h2>
        </div>
        
        <!-- Progress Bar -->
        <div class="mt-4 flex items-center max-w-3xl mx-auto">
            <span class="text-sm md:text-base font-medium">Progres</span>
            <div class="w-full bg-gray-200 h-4 rounded-lg overflow-hidden ml-2">
                <div id="progress-bar" class="h-full bg-purpleMain transition-all duration-300" style="width: 0%;"></div>
            </div>
            <span id="progress-text" class="ml-2 text-sm md:text-base font-medium">0%</span>
        </div>

        <form id="quiz-form" class="mt-8 max-w-3xl mx-auto">
            <!-- Pagination numbers -->
            <div class="flex justify-center mb-6">
                <div class="flex space-x-2 md:space-x-3">
                    @php
                        $pageCount = ceil(count($pertanyaanList) / 5);
                    @endphp
                    
                    @for($i = 0; $i < $pageCount; $i++)
                        <button type="button" class="page-number w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center border border-purpleMain {{ $i == 0 ? 'bg-purpleMain text-white' : 'text-purpleMain' }}" data-page="{{ $i + 1 }}">
                            {{ $i + 1 }}
                        </button>
                    @endfor
                </div>
            </div>

            <!-- Question pages -->
            @php
                $chunks = array_chunk($pertanyaanList->toArray(), 5);
            @endphp
            
            @foreach($chunks as $pageIndex => $questions)
                <div class="question-page {{ $pageIndex == 0 ? 'block' : 'hidden' }}" data-page="{{ $pageIndex + 1 }}">
                    <div class="question-container p-6 bg-white rounded-lg border border-gray-100">
                        @foreach($questions as $questionIndex => $pertanyaan)
                            <div class="question-block py-4 {{ $questionIndex > 0 ? 'border-t border-gray-100 mt-4' : '' }}" data-id="{{ $pertanyaan['id'] }}">
                                <p class="text-black font-medium text-left mb-4 pl-1">
                                    {{ ($pageIndex * 5) + $questionIndex + 1 }}. {{ $pertanyaan['pertanyaan'] }}
                                </p>
                                <div class="flex justify-start gap-4">
                                    <button type="button" class="answer-btn w-28 px-4 py-2 rounded-md border border-purpleMain font-medium transition-all" data-value="0">Tidak</button>
                                    <button type="button" class="answer-btn w-28 px-4 py-2 rounded-md border border-purpleMain font-medium transition-all" data-value="1">Ya</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation buttons -->
                    <div class="flex justify-between mt-8">
                        @if($pageIndex > 0)
                            <button type="button" class="prev-page px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md font-medium">Sebelumnya</button>
                        @else
                            <div></div>
                        @endif

                        @if($pageIndex < count($chunks) - 1)
                            <button type="button" class="next-page px-6 py-2 bg-purpleMain hover:bg-purple-700 text-white rounded-md font-medium">Selanjutnya</button>
                        @else
                            <button type="button" id="submitButton" class="px-8 py-3 bg-purpleMain hover:bg-purple-700 text-white rounded-md font-medium">Selesai</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');
    const submitButton = document.getElementById('submitButton');
    const totalQuestions = {{ count($pertanyaanList) }};
    const user = @json(auth()->user());
    let answeredQuestions = 0;
    let answers = [];
    let currentPage = 1;
    
    // Initialize buttons
    const answerButtons = document.querySelectorAll('.answer-btn');
    const pageNumbers = document.querySelectorAll('.page-number');
    const nextButtons = document.querySelectorAll('.next-page');
    const prevButtons = document.querySelectorAll('.prev-page');

    // Handle answer button clicks
    answerButtons.forEach(button => {
        button.addEventListener('click', function() {
            const questionBlock = this.closest('.question-block');
            const questionId = questionBlock.dataset.id;
            const value = this.dataset.value;

            // Remove previous answer if exists
            answers = answers.filter(answer => answer.pertanyaanId !== questionId);

            // Add new answer
            answers.push({
                pertanyaanId: questionId,
                value: value
            });

            // Update button styles
            questionBlock.querySelectorAll('.answer-btn').forEach(btn => {
                btn.classList.remove('bg-purpleMain', 'text-white');
            });
            this.classList.add('bg-purpleMain', 'text-white');

            // Update progress if not already counted
            if (!questionBlock.dataset.answered) {
                answeredQuestions++;
                questionBlock.dataset.answered = true;
                updateProgress();
            }
        });
    });

    // Handle page navigation
    pageNumbers.forEach(button => {
        button.addEventListener('click', function() {
            changePage(parseInt(this.dataset.page));
        });
    });

    nextButtons.forEach(button => {
        button.addEventListener('click', function() {
            changePage(currentPage + 1);
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener('click', function() {
            changePage(currentPage - 1);
        });
    });

    // Change page function
    function changePage(pageNumber) {
        // Hide all pages
        document.querySelectorAll('.question-page').forEach(page => {
            page.classList.add('hidden');
        });
        
        // Show selected page
        const selectedPage = document.querySelector(`.question-page[data-page="${pageNumber}"]`);
        if (selectedPage) {
            selectedPage.classList.remove('hidden');
            currentPage = pageNumber;
            
            // Update page number indicators
            pageNumbers.forEach(btn => {
                btn.classList.remove('bg-purpleMain', 'text-white');
                btn.classList.add('text-purpleMain');
                
                if (parseInt(btn.dataset.page) === currentPage) {
                    btn.classList.add('bg-purpleMain', 'text-white');
                    btn.classList.remove('text-purpleMain');
                }
            });
            
            // Smooth scroll to top of quiz form
            document.getElementById('quiz-form').scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Update progress function
    function updateProgress() {
        const percentage = Math.round((answeredQuestions / totalQuestions) * 100);
        progressBar.style.width = `${percentage}%`;
        progressText.textContent = `${percentage}%`;
    }

    // Handle form submission
    if (submitButton) {
        submitButton.addEventListener('click', () => {
            // Check if all questions are answered
            if (answers.length < totalQuestions) {
                // Count unanswered questions
                const unanswered = totalQuestions - answers.length;
                alert(`Mohon jawab semua pertanyaan terlebih dahulu! Masih ada ${unanswered} pertanyaan yang belum dijawab.`);
                
                // Highlight unanswered questions and navigate to first page with unanswered question
                let firstUnansweredPage = null;
                
                document.querySelectorAll('.question-block').forEach(block => {
                    const questionId = block.dataset.id;
                    if (!answers.find(a => a.pertanyaanId === questionId)) {
                        block.classList.add('bg-red-50');
                        
                        if (!firstUnansweredPage) {
                            const page = block.closest('.question-page');
                            firstUnansweredPage = parseInt(page.dataset.page);
                        }
                    } else {
                        block.classList.remove('bg-red-50');
                    }
                });
                
                if (firstUnansweredPage) {
                    changePage(firstUnansweredPage);
                }
                
                return;
            }

            $.ajax({
    type: "POST",
    url: `/submit-answer/${user.id}`,
    dataType: "json",
    data: {
        '_token': $('meta[name="csrf-token"]').attr('content'),
        'data': answers
    },
    success: (response) => {
        if (response.status === 200) {
            window.location.replace(response.redirect);
        } else {
            alert("Gagal mengirim jawaban: " + (response.message || "Unknown error"));
        }
    },
    error: (error) => {
        console.error('Error details:', error);
        // Show more detailed error information
        if (error.responseJSON && error.responseJSON.message) {
            alert("Error: " + error.responseJSON.message);
        } else if (error.status === 419) {
            alert("CSRF token mismatch. Please refresh the page and try again.");
        } else {
            alert("Terjadi kesalahan saat mengirim jawaban (Status: " + error.status + ")");
        }
    }
});
        });
    }
});
</script>
@endsection