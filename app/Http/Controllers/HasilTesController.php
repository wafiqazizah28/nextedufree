<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\SaranPekerjaan;
use App\Models\HasilTes;
use App\Models\Sekolah;
use App\Models\Pertanyaan;
use App\Models\Artikel;
use App\Models\User;
use App\Http\Requests\StoreHasilTesRequest;
use App\Http\Requests\UpdateHasilTesRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilTesController extends Controller
{
    public function index()
    {
        // Ambil semua hasil tes beserta data user-nya (nama, email, dll)
        $hasilTests = HasilTes::with('user')->latest()->get();
        $pertanyaanInfo = Pertanyaan::all();
        $jurusanInfo = Jurusan::all();
        $artikelInfo = Artikel::all();
        $usersInfo = User::all();

        return view('components.admin.hasiltes.hasiltes', compact(
            'hasilTests',
            'pertanyaanInfo',
            'jurusanInfo',
            'artikelInfo',
            'usersInfo'
        ));
    }

    public function hasilTes()
    {
        $userId = auth()->id();
        $hasilTerbaru = HasilTes::where('user_id', $userId)->latest()->first();

        $jurusanList = [];
        $jurusan = null;
        $saranPekerjaanList = [];
        $sekolahList = [];

        if ($hasilTerbaru) {
            $jurusanList = Jurusan::all();

            foreach ($jurusanList as $j) {
                if (strtolower($j->jurusan) == strtolower($hasilTerbaru->hasil)) {
                    $jurusan = $j;
                    break;
                }
            }

            if ($jurusan) {
                $saranPekerjaanList = SaranPekerjaan::where('jurusan_id', $jurusan->id)->get();
                $sekolahList = Sekolah::where('jurusan_id', $jurusan->id)->orderBy('nama', 'asc')->get();
            }
        }

        return view('pages.hasilTes', [
            'hasilTes' => $hasilTerbaru,
            'jurusan' => $jurusan,
            'jurusanList' => $jurusanList,
            'saranPekerjaanList' => $saranPekerjaanList,
            'sekolahList' => $sekolahList
        ]);
    }

    public function show($id)
    {
        $hasilTes = HasilTes::findOrFail($id);

        if (auth()->id() !== $hasilTes->user_id) {
            return redirect()->route('/')->with('error', 'Anda tidak memiliki akses ke hasil tes ini.');
        }

        $jurusanList = Jurusan::all();
        $jurusan = null;

        foreach ($jurusanList as $j) {
            if (strtolower($j->jurusan) == strtolower($hasilTes->hasil)) {
                $jurusan = $j;
                break;
            }
        }

        $saranPekerjaanList = [];
        $sekolahList = [];

        if ($jurusan) {
            $saranPekerjaanList = SaranPekerjaan::where('jurusan_id', $jurusan->id)->get();
            $sekolahList = Sekolah::where('jurusan_id', $jurusan->id)->orderBy('nama', 'asc')->get();
        }

        return view('pages.hasilTes', [
            'hasilTes' => $hasilTes,
            'jurusan' => $jurusan,
            'jurusanList' => $jurusanList,
            'saranPekerjaanList' => $saranPekerjaanList,
            'sekolahList' => $sekolahList
        ]);
    }

    public function downloadPDF($id)
    {
        $hasilTes = HasilTes::findOrFail($id);

        if (auth()->id() !== $hasilTes->user_id && !auth()->user()->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke hasil tes ini.');
        }

        $jurusanList = Jurusan::all();
        $jurusan = null;

        foreach ($jurusanList as $j) {
            if (strtolower($j->jurusan) == strtolower($hasilTes->hasil)) {
                $jurusan = $j;
                break;
            }
        }

        $saranPekerjaanList = [];
        $sekolahList = [];

        if ($jurusan) {
            $saranPekerjaanList = SaranPekerjaan::where('jurusan_id', $jurusan->id)->get();
            $sekolahList = Sekolah::where('jurusan_id', $jurusan->id)->orderBy('nama', 'asc')->get();
        }

        $pdf = PDF::loadView('components.user.download', [
            'hasilTes' => $hasilTes,
            'jurusan' => $jurusan,
            'saranPekerjaanList' => $saranPekerjaanList,
            'sekolahList' => $sekolahList,
            'user' => auth()->user(),
        ]);

        $fileName = 'hasil-tes-' . strtolower(str_replace(' ', '-', $hasilTes->hasil)) . '.pdf';
        return $pdf->download($fileName);
    }
}
