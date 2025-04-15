<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
use App\Models\Jurusan;
use App\Models\Artikel;
use App\Models\SaranPekerjaan;
use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function user()
    {
        $hasilTes = HasilTes::all() ?? collect();
        $jurusan = Jurusan::all() ?? collect();
        $artikel = Artikel::all() ?? collect();
        $saran_pekerjaan = SaranPekerjaan::all() ?? collect();

        return view('pages.dashboard', [
            'hasilTes' => $hasilTes,
            'diseases' => $jurusan,
            'artikel' => $artikel,
            'saran_pekerjaan' => $saran_pekerjaan
        ]);
    }

    public function admin()
    {
        $pertanyaanInfo = Pertanyaan::all() ?? collect();
        $jurusanInfo = Jurusan::all() ?? collect();
        $artikelInfo = Artikel::all() ?? collect();
        $usersInfo = User::all() ?? collect();

        return view('pages.adminDashboard', [
            'pertanyaanInfo' => $pertanyaanInfo,
            'jurusanInfo' => $jurusanInfo,
            'artikelInfo' => $artikelInfo,
            'usersInfo' => $usersInfo
        ]);
    }

    public function statistik()
    {
        // Tambahkan setlocale untuk bahasa Indonesia jika diperlukan
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        
        // Dapatkan tanggal saat ini
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();
        
        // Statistik login per hari dalam bulan ini
        $userLoginByDay = DB::table('users')
            ->select(DB::raw('DATE(created_at) as login_date, COUNT(*) as login_count'))
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy('login_date')
            ->orderBy('login_date')
            ->get();
            
        $loginDates = [];
        $loginCounts = [];
        
        foreach ($userLoginByDay as $data) {
            $loginDates[] = Carbon::parse($data->login_date)->format('d M');
            $loginCounts[] = $data->login_count;
        }
        
        // Statistik hasil tes jurusan (diagram lingkaran)
        $hasilTesData = DB::table('hasil_tes')
            ->join('jurusan', 'hasil_tes.hasil', '=', 'jurusan.id')
            ->select('jurusan as jurusan', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('jurusan')
            ->get();
            
        $jurusanLabels = [];
        $jurusanCounts = [];
        $chartColors = [
            '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', 
            '#5a5c69', '#6610f2', '#fd7e14', '#20c9a6', '#858796'
        ];
        
        foreach ($hasilTesData as $data) {
            $jurusanLabels[] = $data->jurusan_nama;
            $jurusanCounts[] = $data->jumlah;
        }
        
        // Statistik bulanan (kode yang sudah ada)
        $userDataMonthly = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as month, COUNT(*) as user_count'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        $months = [];
        $monthlyCounts = [];
        
        foreach ($userDataMonthly as $data) {
            $months[] = date('M', mktime(0, 0, 0, $data->month, 1));
            $monthlyCounts[] = $data->user_count;
        }
        
        // Hitung total user login bulan ini
        $totalLoginBulanIni = array_sum($loginCounts);
        
        // Format bulan dan tahun saat ini (explicit untuk menghindari error)
        $bulanSekarang = $now->format('F Y');
        
        // Menyiapkan data untuk dikirim ke view
        $data = [
            'loginDates' => $loginDates,
            'loginCounts' => $loginCounts,
            'jurusanLabels' => $jurusanLabels,
            'jurusanCounts' => $jurusanCounts,
            'months' => $months,
            'monthlyCounts' => $monthlyCounts,
            'totalLoginBulanIni' => $totalLoginBulanIni,
            'bulanSekarang' => $bulanSekarang,
            'chartColors' => $chartColors
        ];
        
        // Return view dengan explicit data
        return view('components.admin.statistik', $data);
    }
}