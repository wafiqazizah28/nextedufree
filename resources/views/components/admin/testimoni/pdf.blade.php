<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Daftar Testimoni</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }
        .empty-message {
            color: red;
            text-align: center;
            font-weight: bold;
        }
        .testimoni-text {
            text-align: justify;
        }
    </style>
</head>
<body>
    <h1>Daftar Testimoni</h1>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Asal Sekolah</th>
                <th>Jurusan</th>
                <th>Testimoni</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($testimonis) && $testimonis->count() > 0)
                @foreach($testimonis as $index => $testimoni)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $testimoni->user->name ?? 'User Tidak Diketahui' }}</td>
                        <td>
                            @if(isset($testimoni->jurusan))
                                {{ $testimoni->jurusan->jurusan ?? 'Jurusan Tidak Diketahui' }}
                            @else
                                Jurusan Tidak Diketahui
                            @endif
                        </td>
                        <td class="testimoni-text">{{ $testimoni->testimoni ?? 'Tidak Ada Testimoni' }}</td>
                        <td>{{ $testimoni->created_at ? $testimoni->created_at->format('d M Y') : '-' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="empty-message">
                        Tidak ada data testimoni
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
    
    <div style="text-align: right; margin-top: 20px;">
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>
</body>
</html>