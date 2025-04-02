<!DOCTYPE html>
<html>
<head>
    <title>Daftar Saran Pekerjaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
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
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <h1>Daftar Saran Pekerjaan</h1>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jurusan</th>
                <th>Saran Pekerjaan</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($saranPekerjaanList) && count($saranPekerjaanList) > 0)
                @foreach($saranPekerjaanList as $index => $saranPekerjaan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @php
                                $jurusanName = '-';
                                if (isset($jurusanInfo)) {
                                    foreach ($jurusanInfo as $jurusan) {
                                        if ($jurusan->id == $saranPekerjaan->jurusan_id) {
                                            $jurusanName = $jurusan->jurusan;
                                            break;
                                        }
                                    }
                                }
                                echo $jurusanName;
                            @endphp
                        </td>
                        <td>{{ $saranPekerjaan->saran_pekerjaan }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" style="text-align: center; font-weight: bold; color: red;">
                        Tidak ada data saran pekerjaan
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