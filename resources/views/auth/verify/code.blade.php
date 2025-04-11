<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite('resources/css/app.css')

  <!-- Favicon standar -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon_io/favicon-16x16.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon_io/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/favicon_io/favicon-48x48.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon_io/favicon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/favicon_io/android-chrome-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/favicon_io/android-chrome-512x512.png') }}">
  <title>Verifikasi Email - nextEdu</title>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .digit-input {
      width: 60px;
      height: 60px;
      text-align: center;
      font-size: 24px;
      border-radius: 8px;
      border: 1px solid #493D9E;
    }
    .digit-input.error {
      border-color: #EF4444;
      background-color: #FEF2F2;
    }
    .timer {
      font-size: 14px;
      color: #666;
    }
    
    .verification-success {
      display: none;
      background-color: #F0FDF4;
      border: 1px solid #16A34A;
      color: #16A34A;
      padding: 10px;
      border-radius: 8px;
      text-align: center;
      margin-bottom: 15px;
      animation: fadeIn 0.5s;
    }
    .verification-error {
      display: none;
      background-color: #FEF2F2;
      border: 1px solid #EF4444;
      color: #EF4444;
      padding: 10px;
      border-radius: 8px;
      text-align: center;
      margin-bottom: 15px;
      animation: fadeIn 0.5s;
    }
    .btn-loading {
      position: relative;
      color: transparent !important;
    }
    .btn-loading:after {
      content: "";
      position: absolute;
      width: 20px;
      height: 20px;
      top: 50%;
      left: 50%;
      margin: -10px 0 0 -10px;
      border: 3px solid rgba(255, 255, 255, 0.3);
      border-top-color: #fff;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
  </style>
</head>
<body class="bg-white min-h-screen">
  @if(!auth()->check())
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    <div class="flex flex-col items-center justify-center h-screen">
        <div class="text-center">
            <p class="text-gray-600 mb-4">Sesi Anda telah berakhir. Silakan login kembali.</p>
            <a href="{{ route('login') }}" class="bg-[#493D9E] text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                Login
            </a>
        </div>
    </div>
  @else

  <!-- Navbar -->
  <header id="navbar"
    class="fixed top-0 left-0 z-50 w-full bg-white shadow-md transition-shadow duration-300 lg:hidden">
    <div class="container">
      <div class="relative flex items-center justify-between py-4">
        <!-- Logo -->
        <div class="px-4">
          <a href="/" class="{{ session('verified') ? '' : 'disabled-link' }}" id="logoLink">
            <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="Logo" class="w-28">
          </a>
        </div>

        <!-- Tombol Hamburger -->
        <div class="flex items-center lg:hidden ml-auto mr-4">
          <button id="hamburger" name="hamburger" type="button" class="block">
            <span class="hamburger-line transition duration-300 ease-in-out bg-black w-6 h-1 mb-1 block"></span>
            <span class="hamburger-line transition duration-300 ease-in-out bg-black w-6 h-1 mb-1 block"></span>
            <span class="hamburger-line transition duration-300 ease-in-out bg-black w-6 h-1 block"></span>
          </button>
        </div>
      </div>
    </div>
  </header>
  <!-- Menu Navigasi -->
  <nav id="nav-menu"
    class="fixed top-[60px] right-0 w-1/2 h-screen bg-white shadow-md hidden flex flex-col justify-between z-40 transition-all duration-300">
    <ul class="block w-full text-left mt-6 px-6 space-y-3 text-lg">
      <li><a href="/" class="block py-1 text-black hover:text-purpleMain nav-link {{ session('verified') ? '' : 'disabled-link' }}">Beranda</a></li>
      <li><a href="/tesminatmu" class="block py-1 text-black hover:text-purpleMain nav-link {{ session('verified') ? '' : 'disabled-link' }}">Tes Minatmu</a></li>
      <li><a href="/tanyaJurpan" class="block py-1 text-black hover:text-purpleMain nav-link {{ session('verified') ? '' : 'disabled-link' }}">Edubot</a></li>
      <li><a href="/artikelPage" class="block py-1 text-black hover:text-purpleMain nav-link {{ session('verified') ? '' : 'disabled-link' }}">Artikel</a></li>
    </ul>
  </nav>

  <div class="flex flex-col lg:flex-row w-full h-screen">
    <!-- Main content (left on desktop) -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-4 order-2 lg:order-1">
      <div class="w-full max-w-md p-6">
        <div class="text-center mb-8">
          <img src="{{ asset('assets/logo/logo-typo.svg') }}" alt="NextEdu Logo" class="h-10 lg:h-12 mx-auto">
          <h5 class="text-gray-600 font-semibold mt-3">Verifikasi Email</h5>
        </div>

        <!-- Success Message -->
        <div id="successMessage" class="verification-success">
          <p>Kode verifikasi berhasil diverifikasi!</p>
        </div>

        <!-- Error Message -->
        <div id="errorMessage" class="verification-error">
          <p>Kode verifikasi tidak valid. Silakan coba lagi.</p>
        </div>

        <div class="text-center mb-6">
          <p class="text-gray-600">Silahkan masukkan 4 digit kode<br>yang dikirimkan ke {{ $email }}</p>
        </div>

        <form id="codeForm">
          @csrf
          <div class="flex justify-center gap-3 mb-6">
            <input type="text" name="digit1" class="digit-input" maxlength="1" inputmode="numeric" required autofocus 
              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input type="text" name="digit2" class="digit-input" maxlength="1" inputmode="numeric" required 
              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input type="text" name="digit3" class="digit-input" maxlength="1" inputmode="numeric" required
              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <input type="text" name="digit4" class="digit-input" maxlength="1" inputmode="numeric" required
              oninput="this.value = this.value.replace(/[^0-9]/g, '')">
          </div>

          <div class="flex justify-between items-center mb-6">
            <span class="timer">Kode Kadaluarsa <span id="countdown">03:00</span></span>
            
            <button type="button" id="resendBtn" class="text-[#493D9E] hover:text-purple-700 text-sm font-medium">
              Kirim Ulang
            </button>
          </div>

          <button type="submit" id="verifyBtn" class="w-full text-white py-2.5 lg:py-3 rounded-lg transition bg-[#493D9E] hover:bg-purple-700">
            Verifikasi
          </button>
        </form>
      </div>
    </div>

    <!-- Image (right on desktop) -->
    <div class="w-full lg:w-1/2 bg-[#493D9E] flex items-center justify-center p-6 order-1 lg:order-2">
      <img src="{{ asset('assets/img/imgReset.svg') }}" alt="Security Illustration" class="w-full max-w-md">
    </div>
  </div>
  @endif

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.getElementById("hamburger");
    const navMenu = document.getElementById("nav-menu");
    const navbar = document.getElementById("navbar");
    const lines = hamburger ? hamburger.querySelectorAll(".hamburger-line") : null;
    const isVerified = {{ session('verified') ? 'true' : 'false' }};
    const navLinks = document.querySelectorAll('.nav-link');
    const digitInputs = document.querySelectorAll('.digit-input');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    const codeForm = document.getElementById('codeForm');
    const verifyBtn = document.getElementById('verifyBtn');
    const resendBtn = document.getElementById('resendBtn');
    
    // Exit early if user is not authenticated (prevents JS errors)
    if (!document.getElementById('codeForm')) {
      return;
    }
    
    let isVerifying = false;
    let redirectTimer = null;

    // Fokus ke input pertama dan scroll ke form verifikasi
    if (digitInputs.length > 0) {
      digitInputs[0].focus();
      const verificationForm = document.getElementById('codeForm');
      if (verificationForm) {
        // Smooth scroll to verification form
        verificationForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Add a subtle highlight animation to the input fields
        digitInputs.forEach(input => {
          input.classList.add('animate__animated', 'animate__pulse');
          setTimeout(() => {
            input.classList.remove('animate__animated', 'animate__pulse');
          }, 1000);
        });
      }
    }

    // Toggle menu
    if (hamburger) {
      hamburger.addEventListener("click", function () {
        navMenu.classList.toggle("hidden");
        navMenu.classList.toggle("flex");

        // Ubah bentuk hamburger jadi "X"
        lines[0].classList.toggle("rotate-45");
        lines[0].classList.toggle("translate-y-2.5");

        lines[1].classList.toggle("opacity-0");

        lines[2].classList.toggle("-rotate-45");
        lines[2].classList.toggle("-translate-y-2.5");
      });
    }

    // Tambah shadow saat discroll
    window.addEventListener("scroll", function () {
      if (navbar) {
        if (window.scrollY > 50) {
          navbar.classList.add("shadow-md", "bg-white");
        } else {
          navbar.classList.remove("shadow-md", "bg-white");
        }
      }
    });

    // Auto-focus to next input and handle backspace
    digitInputs.forEach((input, index) => {
      input.addEventListener('input', function() {
        // Clear error indicator when typing
        input.classList.remove('error');
        errorMessage.style.display = 'none';
        
        // Only allow numeric input
        this.value = this.value.replace(/[^0-9]/g, '');
        
        if (this.value.length === 1) {
          if (index < digitInputs.length - 1) {
            digitInputs[index + 1].focus();
          } else {
            this.blur();
            // Auto-submit when all fields are filled
            if (areAllFieldsFilled()) {
              submitForm();
            }
          }
        }
      });
      
      // Support for paste event (to handle pasting full code)
      input.addEventListener('paste', function(e) {
        e.preventDefault();
        const pasteData = (e.clipboardData || window.clipboardData).getData('text');
        const numericData = pasteData.replace(/[^0-9]/g, '').substring(0, 4);
        
        if (numericData.length > 0) {
          // Fill all inputs with pasted data
          for (let i = 0; i < Math.min(numericData.length, digitInputs.length); i++) {
            digitInputs[i].value = numericData[i];
          }
          
          // Move focus to appropriate input or submit if complete
          if (numericData.length < 4) {
            digitInputs[numericData.length].focus();
          } else {
            digitInputs[3].blur();
            if (areAllFieldsFilled()) {
              submitForm();
            }
          }
        }
      });
      
      input.addEventListener('keydown', function(e) {
        // Allow backspace to go to previous input
        if (e.key === 'Backspace' && this.value.length === 0 && index > 0) {
          digitInputs[index - 1].focus();
        }
      });
    });
    
    // Check if all fields are filled
    function areAllFieldsFilled() {
      return Array.from(digitInputs).every(input => input.value.length === 1);
    }
    
    // Set up countdown timer - 3 minutes
    let timeLeft = 180; // 3 minutes in seconds
    const countdownEl = document.getElementById('countdown');
    
    const timer = setInterval(() => {
      const minutes = Math.floor(timeLeft / 60);
      let seconds = timeLeft % 60;
      seconds = seconds < 10 ? '0' + seconds : seconds;
      
      countdownEl.innerHTML = `${minutes}:${seconds}`;
      
      if (timeLeft <= 0) {
        clearInterval(timer);
        countdownEl.innerHTML = "00:00";
        resendBtn.classList.remove('opacity-50', 'pointer-events-none');
      }
      timeLeft--;
    }, 1000);
    
    // Disable form during submission to prevent multiple submissions
    function disableForm(disable) {
      verifyBtn.disabled = disable;
      digitInputs.forEach(input => {
        input.disabled = disable;
      });
      
      if (disable) {
        verifyBtn.classList.add('btn-loading');
      } else {
        verifyBtn.classList.remove('btn-loading');
      }
    }
    
    // Handle form submission via AJAX
    function submitForm() {
      if (isVerifying) return;
      isVerifying = true;
      
      // Hide any previous messages
      errorMessage.style.display = 'none';
      successMessage.style.display = 'none';
      
      // Disable form during submission
      disableForm(true);
      
      // Get code from inputs
      const verificationCode = Array.from(digitInputs).map(input => input.value).join('');
      
      // Prepare form data
      const formData = new FormData();
      formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
      formData.append('verification_code', verificationCode);
      
      // Send AJAX request
      fetch('{{ route("verification.verify") }}', {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
      .then(data => {
        isVerifying = false;
        disableForm(false);
        
        if (data.success) {
          // Show success message
          successMessage.style.display = 'block';
          
          // Clear the redirect timer if it exists
          if (redirectTimer) {
            clearTimeout(redirectTimer);
          }
          
          // Set a new redirect timer
          redirectTimer = setTimeout(() => {
            window.location.href = data.redirect || '/';
          }, 1500);
          
        } else {
          // Show error message
          errorMessage.style.display = 'block';
          errorMessage.querySelector('p').textContent = data.message || 'Kode verifikasi tidak valid. Silakan coba lagi.';
          
          // Highlight input fields with error
          digitInputs.forEach(input => {
            input.classList.add('error');
          });
          
          // Focus on first input
          digitInputs[0].focus();
          
          // Clear all inputs
          digitInputs.forEach(input => {
            input.value = '';
          });
        }
      })
      .catch(error => {
        isVerifying = false;
        disableForm(false);
        
        console.error('Error:', error);
        errorMessage.style.display = 'block';
        errorMessage.querySelector('p').textContent = 'Terjadi kesalahan. Silakan coba lagi.';
      });
    }
    
    // Handle form submission
    if (codeForm) {
      codeForm.addEventListener('submit', function(e) {
        e.preventDefault();
        submitForm();
      });
    }
    
    // Resend verification code via AJAX
    if (resendBtn) {
      resendBtn.addEventListener('click', function() {
        if (resendBtn.classList.contains('opacity-50')) {
          return; // Already in progress
        }
        
        // Disable resend button temporarily
        resendBtn.classList.add('opacity-50', 'pointer-events-none');
        resendBtn.textContent = 'Mengirim...';
        
        // Prepare form data
        const formData = new FormData();
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        // Send AJAX request
        fetch('{{ route("verification.resend") }}', {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Reset timer
            timeLeft = 180;
            
            // Clear inputs
            digitInputs.forEach(input => {
              input.value = '';
              input.classList.remove('error');
            });
            digitInputs[0].focus();
            
            // Hide error message if shown
            errorMessage.style.display = 'none';
            
            // Show success notification
            const notif = document.createElement('div');
            notif.className = 'fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded z-50 animate__animated animate__fadeIn';
            notif.innerHTML = '<p>Kode verifikasi baru telah dikirim.</p>';
            document.body.appendChild(notif);
            
            setTimeout(() => {
              notif.classList.add('animate__fadeOut');
              setTimeout(() => {
                notif.remove();
              }, 500);
            }, 2500);
          } else {
            // Show error notification
            const notif = document.createElement('div');
            notif.className = 'fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded z-50 animate__animated animate__fadeIn';
            notif.innerHTML = '<p>' + (data.message || 'Gagal mengirim kode verifikasi.') + '</p>';
            document.body.appendChild(notif);
            
            setTimeout(() => {
              notif.classList.add('animate__fadeOut');
              setTimeout(() => {
                notif.remove();
              }, 500);
            }, 2500);
          }
          
          // Re-enable resend button after 30 seconds
          setTimeout(() => {
            resendBtn.classList.remove('opacity-50', 'pointer-events-none');
            resendBtn.textContent = 'Kirim Ulang';
          }, 30000);
        })
        .catch(error => {
          console.error('Error:', error);
          
          // Show error notification
          const notif = document.createElement('div');
          notif.className = 'fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded z-50 animate__animated animate__fadeIn';
          notif.innerHTML = '<p>Terjadi kesalahan. Silakan coba lagi.</p>';
          document.body.appendChild(notif);
          
          setTimeout(() => {
            notif.classList.add('animate__fadeOut');
            setTimeout(() => {
              notif.remove();
            }, 500);
          }, 2500);
          
          // Re-enable resend button
          resendBtn.classList.remove('opacity-50', 'pointer-events-none');
          resendBtn.textContent = 'Kirim Ulang';
        });
      });
    }
  });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</body>
</html>