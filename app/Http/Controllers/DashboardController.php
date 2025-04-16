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

        return view('components.admin.base', [
            'pertanyaanInfo' => $pertanyaanInfo,
            'jurusanInfo' => $jurusanInfo,
            'artikelInfo' => $artikelInfo,
            'usersInfo' => $usersInfo
        ]);
    }

   
}