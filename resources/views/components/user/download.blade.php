<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hasil Tes Jurusan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 2px solid #6366f1;
        }
        .header h1 {
            color: #4338ca;
            margin-bottom: 5px;
        }
        .header p {
            color: #6b7280;
            font-size: 16px;
        }
        .user-info {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #f3f4f6;
            border-radius: 8px;
        }
        .user-info p {
            margin: 5px 0;
        }
        .result-box {
            background-color: #ede9fe;
            border-left: 4px solid #8b5cf6;
            padding: 15px;
            margin-bottom: 30px;
            border-radius: 0 8px 8px 0;
        }
        .result-box h2 {
            color: #7c3aed;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .description {
            margin-bottom: 30px;
        }
        .section-title {
            color: #4338ca;
            border-bottom: 1px solid #d1d5db;
            padding-bottom: 8px;
            margin-top: 30px;
        }
        .career-grid, .school-list {
            margin-top: 15px;
        }
        .career-item {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .career-item h4 {
            color: #6d28d9;
            margin-bottom: 5px;
        }
        .school-item {
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .timestamp {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
            color: #6b7280;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Hasil Tes Jurusan</h1>
            <p>Laporan hasil tes kesesuaian jurusan dan saran karir</p>
        </div>
        
        <div class="user-info">
            <p><strong>Nama:</strong> {{ $user->nama }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Tanggal Tes:</strong> {{ $hasilTes->created_at->format('d F Y') }}</p>
        </div>
        
        <div class="result-box">
            <h2>Hasil Tes: {{ $hasilTes->hasil }}</h2>
            @if(isset($jurusan))
                <p>{{ $jurusan->deskripsi ?? 'Deskripsi tidak tersedia.' }}</p>
            @else
                <p>Informasi jurusan tidak tersedia.</p>
            @endif
        </div>
        
        <h3 class="section-title">Profesi yang Cocok</h3>
        <div class="career-grid">
            @if(count($saranPekerjaanList) > 0)
                @foreach($saranPekerjaanList as $saranPekerjaan)
                    <div class="career-item">
                        <h4>{{ $saranPekerjaan->saran_pekerjaan }}</h4>
                    </div>
                @endforeach
            @else
                <p>Belum ada saran pekerjaan untuk jurusan ini.</p>
            @endif
        </div>
        
        <h3 class="section-title">Rekomendasi Sekolah</h3>
        <div class="school-list">
            @if(count($sekolahList) > 0)
                @foreach($sekolahList as $sekolah)
                    <div class="school-item">
                        <p><strong>{{ $sekolah->nama }}</strong></p>
                    </div>
                @endforeach
            @else
                <p>Belum ada rekomendasi sekolah untuk jurusan ini.</p>
            @endif
        </div>
        
        <div class="timestamp">
            <p>Dokumen ini dihasilkan pada: {{ now()->format('d F Y, H:i') }}</p>
        </div>
    </div>
</body>
</html>