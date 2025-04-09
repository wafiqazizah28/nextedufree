<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4A42A0;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .admin-badge {
            background-color: #e0f2ff;
            color: #1a56db;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .user-badge {
            background-color: #e0f7e6;
            color: #067a32;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Daftar Pengguna</h1>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor HP</th>
                <th>Sekolah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->nomer_hp ?? 'Tidak ada' }}</td>
                    <td>{{ $user->sekolah ?? 'Tidak ada' }}</td>
                    <td>
                        @if($user->is_admin == 1)
                            <span class="admin-badge">Admin</span>
                        @else
                            <span class="user-badge">Pengguna</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>
</body>
</html>