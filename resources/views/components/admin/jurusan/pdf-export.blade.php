<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Jurusan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #4338ca;
            color: white;
            font-weight: bold;
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .img-container {
            width: 60px;
            height: 60px;
            overflow: hidden;
        }
        .img-container img {
            width: 100%;
            height: auto;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Daftar Jurusan</h1>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Jurusan</th>
                <th>Nama Jurusan</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jurusanList as $index => $jurusan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $jurusan->jurusan_code }}</td>
                <td>{{ $jurusan->jurusan }}</td>
                <td>{{ $jurusan->jenis ?? '-' }}</td>
                <td>{{ $jurusan->deskripsi ?? '-' }}</td>
                <td>
                    @if ($jurusan->img)
                    <div class="img-container">
                        <img src="{{ public_path('storage/' . $jurusan->img) }}" alt="{{ $jurusan->jurusan }}">
                    </div>
                    @else
                    -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        Generated on {{ date('Y-m-d H:i:s') }}
    </div>
</body>
</html>