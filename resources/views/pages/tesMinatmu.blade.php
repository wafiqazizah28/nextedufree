@extends('layouts.app')

@section('content')
<section class="pt-14 pb-12 lg:pt-24 bg-white min-h-screen">
    <div class="relative w-full min-h-[580px] flex flex-col justify-center items-center px-4 bg-no-repeat bg-cover bg-center"
    style="background-image: url('{{ asset('assets/img/bannerTes.png') }}');">
</div>

    <div class="mt-6 bg-white shadow-lg rounded-lg p-6">
        <div style="text-align: center;">
            <h2 class="text-xl font-bold text-gray-700" style="font-size: 2rem;">Jawablah yang sesuai dengan dirimu!</h2>
          </div>
          <div class="mt-4 flex items-center">
            <span>Progres</span>
            <div class="w-full bg-gray-300 h-4 rounded-lg overflow-hidden ml-2">
              <div id="progress-bar" class="h-full bg-purpleMain" style="width: 0%;"></div>
            </div>
          </div>
          
          <form id="quiz-form" class="mt-5 text-center">
            @foreach($pertanyaanList as $index => $pertanyaan)
            <div class="question-block mt-8" data-id="{{ $pertanyaan['id'] }}">
                <p class="text-black font-medium text-left mx-auto pl-20" style="max-width: 600px;">
                    {{ $index + 1 }}. {{ $pertanyaan['pertanyaan'] }}
                </p>
                <div class="flex justify-center gap-4 mt-4">
                    <button type="button" class="answer-btn w-24 px-6 py-2 rounded-md border border-purpleMain font-medium" data-value="0">Tidak</button>
                    <button type="button" class="answer-btn w-24 px-6 py-2 rounded-md border border-purpleMain font-medium" data-value="1">Ya</button>
                </div>
            </div>
            @endforeach
            
            
            <!-- Tombol Selanjutnya -->
            <div class="flex justify-center mt-8">
                <button type="button" id="submitButton" class="px-8 py-3 bg-purple-500 hover:bg-purple-700 text-white rounded-md font-medium w-full max-w-xs">Selanjutnya</button>
            </div>
        </form>
        
    </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.answer-btn');
        const progressBar = document.getElementById('progress-bar');
        const totalQuestions = {{ count($pertanyaanList) }};
        let answeredQuestions = 0;

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                if (!this.parentNode.dataset.answered) {
                    answeredQuestions++;
                    this.parentNode.dataset.answered = true;
                    updateProgress();
                }
                this.parentNode.querySelectorAll('.answer-btn').forEach(btn => btn.classList.remove('bg-purple-500', 'text-white'));
                this.classList.add('bg-purple-500', 'text-white');
            });
        });

        function updateProgress() {
            const percentage = (answeredQuestions / totalQuestions) * 100;
            progressBar.style.width = `${percentage}%`;
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.answer-btn');
    const progressBar = document.getElementById('progress-bar');
    const submitButton = document.getElementById('submitButton');
    const totalQuestions = document.querySelectorAll('.question-block').length;
    const user = @json(auth()->user());
    let answeredQuestions = 0;
    let answers = [];

    // Handle answer button clicks
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const questionBlock = this.closest('.question-block');
            const questionId = questionBlock.dataset.id;
            const value = this.dataset.value;

            // Remove previous answer from array if exists
            answers = answers.filter(answer => answer.pertanyaanId !== questionId);

            // Add new answer
            answers.push({
                pertanyaanId: questionId,
                value: value
            });

            // Update button styles
            questionBlock.querySelectorAll('.answer-btn').forEach(btn => {
                btn.classList.remove('bg-purple-500', 'text-white');
            });
            this.classList.add('bg-purple-500', 'text-white');

            // Update progress if not already counted
            if (!questionBlock.dataset.answered) {
                answeredQuestions++;
                questionBlock.dataset.answered = true;
                updateProgress();
            }
        });
    });

    function updateProgress() {
        const percentage = (answeredQuestions / totalQuestions) * 100;
        progressBar.style.width = `${percentage}%`;
    }

    // Handle form submission
    submitButton.addEventListener('click', () => {
        // Check if all questions are answered
        if (answers.length < totalQuestions) {
            // Highlight unanswered questions
            document.querySelectorAll('.question-block').forEach(block => {
                const questionId = block.dataset.id;
                if (!answers.find(a => a.pertanyaanId === questionId)) {
                    block.classList.add('border-red-500', 'bg-red-50');
                }
            });
            alert('Mohon jawab semua pertanyaan terlebih dahulu!');
            return;
        }

        // Submit answers
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: `/submit-answer/${user.id}`,
            dataType: "json",
            data: {
                'data': answers
            },
            success: (response) => {
                if (response.status === 200) {
                    window.location.replace("/hasiltes");
                } else {
                    alert("Gagal mengirim jawaban");
                }
            },
            error: (error) => {
                console.error('Error:', error);
                alert("Terjadi kesalahan saat mengirim jawaban");
            }
        });
    });
});
</script>
</section>

@endsection