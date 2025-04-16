<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verifikasi Email</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            margin-bottom: 30px;
        }
        .header h2 {
            color: #493D9E;
            margin: 0;
            font-weight: 600;
        }
        .code-container {
            text-align: center;
            margin: 30px 0;
        }
        .code {
            display: inline-block;
            font-size: 32px;
            letter-spacing: 5px;
            font-weight: bold;
            color: #493D9E;
            background-color: #f0edff;
            padding: 15px 25px;
            border-radius: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Verifikasi Email</h2>
        </div>
        
        <p>Hai,</p>
        
        <p>Terima kasih telah mendaftar di nextEdu. Untuk menyelesaikan proses pendaftaran, silakan gunakan kode berikut untuk memverifikasi email Anda:</p>
        
        <div class="code-container">
            <div class="code">{{ $code }}</div>
        </div>
        
        <p>Kode ini hanya berlaku selama 3 menit. Jika Anda tidak mendaftar di nextEdu, silakan abaikan email ini.</p>
        
        <p>Salam,<br>Tim nextEdu</p>
        
        <div class="footer">
            <p>Ini adalah email yang dibuat secara otomatis, mohon jangan membalas email ini.</p>
            <p>&copy; {{ date('Y') }} nextEdu. All rights reserved.</p>
        </div>
    </div>
</body>
</html>