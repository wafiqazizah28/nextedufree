<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
        }
        .code {
            text-align: center;
            font-size: 32px;
            letter-spacing: 5px;
            margin: 30px 0;
            font-weight: bold;
            color: #6c5ce7;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="nextEdu" style="height: 50px;">
            <h2>Kode Reset Password</h2>
        </div>
        
        <p>Hai,</p>
        
        <p>Kami menerima permintaan untuk mengatur ulang password akun nextEdu Anda. Silakan gunakan kode berikut untuk melanjutkan proses reset password:</p>
        
        <div class="code">{{ $code }}</div>
        
        <p>Kode ini hanya berlaku selama 3 menit. Jika Anda tidak meminta reset password, silakan abaikan email ini.</p>
        
        <p>Salam,<br>Tim nextEdu</p>
        
        <div class="footer">
            <p>Ini adalah email yang dibuat secara otomatis, mohon jangan membalas email ini.</p>
            <p>&copy; {{ date('Y') }} nextEdu. All rights reserved.</p>
        </div>
    </div>
</body>
</html>