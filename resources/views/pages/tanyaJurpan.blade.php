<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon_io/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/favicon_io/favicon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon_io/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/favicon_io/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/favicon_io/android-chrome-512x512.png') }}">
      <title>nextEdu</title>
    <style>
        /* Mencegah scroll di seluruh halaman */
        html,
        body {
            overflow: hidden;
            height: 100%;
        }

        /* Memastikan container utama tetap memenuhi layar */
        .container-full {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Animation for welcome container - improved smooth transition */
        #welcome-container {
            transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
            transform: translateY(0);
            opacity: 1;
            position: relative;
        }

        #welcome-container.chat-active {
            transform: translateY(-100px);
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: -1;
        }
        
        .chat-started .container {
            padding-top: 10px !important;
        }
        
        /* Mascot animation */
        #mascot-img {
            transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1);
            transform: translateY(0);
        }
        
        #welcome-container.chat-active #mascot-img {
            transform: translateY(-20px);
            transition-delay: 0.1s;
        }
        
        /* Welcome text animation */
        #welcome-text {
            transition: all 0.6s cubic-bezier(0.22, 1, 0.36, 1);
            transform: translateY(0);
        }
        
        #welcome-container.chat-active #welcome-text {
            transform: translateY(-20px);
            transition-delay: 0.2s;
        }

        #chat-container {
            transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
            opacity: 0;
            transform: translateY(50px);
            display: none;
            margin-top: -40px;
        }

        #chat-container.active {
            opacity: 1;
            transform: translateY(0);
            display: block;
        }
        
        /* Comic-style bubble chat */
        .user-bubble {
            position: relative;
            background-color: #8b5cf6;
            color: white;
            border-radius: 18px;
            padding: 10px 15px;
            max-width: 280px;
            margin-left: auto;
            word-wrap: break-word;
            filter: drop-shadow(0px 1px 2px rgba(0, 0, 0, 0.1));
        }
        
        .user-bubble::after {
            content: '';
            position: absolute;
            right: -12px;
            bottom: 10px;
            width: 20px;
            height: 20px;
            background-color: #8b5cf6;
            border-radius: 0 0 25px 0;
            clip-path: polygon(0 0, 0% 100%, 100% 0);
            transform: rotate(-15deg);
        }
        
        .bot-bubble {
            position: relative;
            background-color: #e5e7eb;
            border-radius: 18px;
            padding: 10px 15px;
            max-width: 280px;
            word-wrap: break-word;
            filter: drop-shadow(0px 1px 2px rgba(0, 0, 0, 0.1));
        }
        
        .bot-bubble::after {
            content: '';
            position: absolute;
            left: -12px;
            bottom: 10px;
            width: 20px;
            height: 20px;
            background-color: #e5e7eb;
            border-radius: 25px 0 0 0;
            clip-path: polygon(0 0, 100% 0, 100% 100%);
            transform: rotate(-15deg);
        }
        
        /* Bot message with loading animation */
        .bot-message-loading {
            display: flex;
            align-items: flex-start;
            margin-top: 0.75rem;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
        
        .bot-message-loading.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .loading-dots {
            display: flex;
            padding: 12px 16px;
            background-color: #e5e7eb;
            border-radius: 18px;
            position: relative;
        }
        
        .loading-dots::after {
            content: '';
            position: absolute;
            left: -12px;
            bottom: 10px;
            width: 20px;
            height: 20px;
            background-color: #e5e7eb;
            border-radius: 25px 0 0 0;
            clip-path: polygon(0 0, 100% 0, 100% 100%);
            transform: rotate(-15deg);
        }
        
        .dot {
            width: 8px;
            height: 8px;
            margin: 0 2px;
            background-color: #9ca3af;
            border-radius: 50%;
            animation: pulse 1.5s infinite ease-in-out;
        }
        
        .dot:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .dot:nth-child(3) {
            animation-delay: 0.4s;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(0.8);
                opacity: 0.6;
            }
            50% {
                transform: scale(1.2);
                opacity: 1;
            }
        }
    </style>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-backgroundPrimary min-h-screen">
    @include('components.navbar')
    
    <!-- Added more padding-top to avoid navbar overlap -->
    <div class="pt-16 pb-24 lg:pt-24 lg:pb-28 bg-backgroundPrimary">
        <div class="container mx-auto text-center py-8 sm:py-12 md:py-16 relative transition-all duration-500">
            <!-- Welcome container that will move up -->
            <div id="welcome-container">
                <img id="mascot-img" src="/assets/img/jurpan.svg" alt="Maskot" class="mx-auto w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32">
                <div id="welcome-text">
                    <h2 class="text-xl sm:text-2xl font-semibold mt-4">Hai, {{ Auth::user()->nama }}!</h2>
                    <p class="text-base sm:text-lg text-gray-600">Mau nanya apa?</p>
                </div>
            </div>

            <!-- Chat container that will appear with fixed height and scroll -->
            <div id="chat-container">
                <!-- Chat box with scrollable content -->
                <div id="chat-box" class="p-10 w-full max-w-6xl mx-auto h-[600px] overflow-y-auto">
                    <!-- Chat messages will be added here -->
                </div>
            </div>
        </div>

        <!-- Textarea with responsive margins, removed fixed position to prevent overlap issues -->
        <div class="fixed bottom-8 left-0 right-0 px-4 sm:px-6 md:px-8 z-10">
            <div class="container mx-auto max-w-6xl bg-white rounded-lg shadow-md">
                <div class="relative">
                    <textarea id="prompt" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-purple-500 
                        focus:ring focus:ring-purple-200 focus:outline-none resize-none align-text-top" 
                        placeholder="Tanyakan sesuatu..." rows="1" style="overflow: hidden; line-height: 1.5;"></textarea>

                    <button id="send" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <img src="{{ asset('assets/icon/send.svg') }}" class="h-5 w-5" alt="Send">
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    document.getElementById('send').addEventListener('click', async function() {
        const prompt = document.getElementById('prompt').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (prompt.trim() === '') return;

        // Handle the welcome to chat transition
        const welcomeContainer = document.getElementById('welcome-container');
        const chatContainer = document.getElementById('chat-container');
        const chatBox = document.getElementById('chat-box');
        
        // If this is the first message, animate the welcome section to top
        if (!welcomeContainer.classList.contains('chat-active')) {
            welcomeContainer.classList.add('chat-active');
            chatContainer.style.display = 'block';
            document.body.classList.add('chat-started');
            document.querySelector('.container').style.paddingTop = '10px';
            document.querySelector('.container').style.paddingBottom = '10px';
            
            // Add a small delay to make the animation visible
            setTimeout(() => {
                chatContainer.classList.add('active');
            }, 200);
        }

        // Add user message to chat with comic bubble style
        chatBox.innerHTML += `<div class='text-right flex items-center justify-end mt-3'>
            <div class='user-bubble'>${prompt}</div>
        </div>`;
        
        // Add bot message with loading animation
        const botMessageId = 'bot-message-' + Date.now();
        chatBox.innerHTML += `<div id="${botMessageId}" class='bot-message-loading'>
            <img src='/assets/img/jurpan.svg' alt='Jurpan' class='w-8 h-8 rounded-full mr-2'>
            <div class='loading-dots'>
                <div class='dot'></div>
                <div class='dot'></div>
                <div class='dot'></div>
            </div>
        </div>`;
        
        // Show the loading message with a slight delay for smooth transition
        setTimeout(() => {
            document.getElementById(botMessageId).classList.add('visible');
        }, 100);
        
        // Scroll to the bottom of the chat
        chatBox.scrollTop = chatBox.scrollHeight;

        try {
            const response = await fetch('/generate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    prompt
                })
            });

            const data = await response.json();
            
            // Remove the loading message
            const loadingMessage = document.getElementById(botMessageId);
            if (loadingMessage) {
                loadingMessage.remove();
            }

            if (data.message) {
                const formattedMessage = data.message.replace(/\*\*/g, ''); // Remove **
                chatBox.innerHTML += `<div class='text-left flex items-center mt-3'>
                    <img src='/assets/img/jurpan.svg' alt='Jurpan' class='w-8 h-8 rounded-full mr-2'>
                    <div class='bot-bubble'>${formattedMessage}</div>
                </div>`;
            } else {
                chatBox.innerHTML += `<div class='text-left flex items-center mt-3'>
                    <img src='/assets/img/jurpan.svg' alt='Jurpan' class='w-8 h-8 rounded-full mr-2'>
                    <div class='bot-bubble'>Tidak ada respon dari AI.</div>
                </div>`;
            }
        } catch (error) {
            console.error("Error fetching data:", error);
            
            // Remove the loading message
            const loadingMessage = document.getElementById(botMessageId);
            if (loadingMessage) {
                loadingMessage.remove();
            }
            
            chatBox.innerHTML += `<div class='text-left flex items-center mt-3'>
                <img src='/assets/img/jurpan.svg' alt='Jurpan' class='w-8 h-8 rounded-full mr-2'>
                <div class='bot-bubble'>Terjadi kesalahan.</div>
            </div>`;
        }

        // Clear the input field
        document.getElementById('prompt').value = '';
        
        // Scroll to the bottom of the chat
        chatBox.scrollTop = chatBox.scrollHeight;
    });
</script>