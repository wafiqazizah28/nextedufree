<?php  

namespace App\Http\Controllers;  

use App\Models\HasilTes; 
use App\Http\Requests\StoreHasilTesRequest; 
use App\Http\Requests\UpdateHasilTesRequest;
use App\Models\Jurusan;
use App\Models\SaranPekerjaan;
use App\Models\Sekolah;
use Barryvdh\DomPDF\Facade\Pdf;


class HasilTesController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hasilTerbaru = HasilTes::where('user_id', auth()->id())->latest()->first();
        
        // Ambil semua data jurusan jika hasil tes ada
        $jurusanList = [];
        $jurusan = null;
        $saranPekerjaanList = [];
        $sekolahList = [];
        
        if ($hasilTerbaru) {
            $jurusanList = Jurusan::all();
            
            // Cari jurusan yang sesuai dengan hasil tes
            foreach ($jurusanList as $j) {
                if (strtolower($j->jurusan) == strtolower($hasilTerbaru->hasil)) {
                    $jurusan = $j;
                    break;
                }
            }
            
            // Jika jurusan ditemukan, ambil saran pekerjaan dan sekolah yang sesuai
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHasilTesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data hasil tes
        $hasilTes = HasilTes::findOrFail($id);
        
        // Cek apakah user berhak melihat hasil ini
        if (auth()->id() !== $hasilTes->user_id && !auth()->user()->isAdmin()) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke hasil tes ini.');
        }
        
        // Ambil semua data jurusan
        $jurusanList = Jurusan::all();
        
        // Cari jurusan yang sesuai dengan hasil tes
        $jurusan = null;
        foreach ($jurusanList as $j) {
            if (strtolower($j->jurusan) == strtolower($hasilTes->hasil)) {
                $jurusan = $j;
                break;
            }
        }
        
        // Jika jurusan ditemukan, ambil saran pekerjaan dan sekolah yang sesuai
        $saranPekerjaanList = [];
        $sekolahList = [];
        if ($jurusan) {
            $saranPekerjaanList = SaranPekerjaan::where('jurusan_id', $jurusan->id)->get();
            $sekolahList = Sekolah::where('jurusan_id', $jurusan->id)->orderBy('nama', 'asc')->get();
        }
        
        return view('hasil-tes.show', [
            'hasilTes' => $hasilTes,
            'jurusan' => $jurusan,
            'jurusanList' => $jurusanList,
            'saranPekerjaanList' => $saranPekerjaanList,
            'sekolahList' => $sekolahList
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HasilTes $hasilTes)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHasilTesRequest $request, HasilTes $hasilTes)
    {
        //
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HasilTes $hasilTes)
    {
        //
    }
    public function downloadPDF($id)
    {
        // Ambil data hasil tes
        $hasilTes = HasilTes::findOrFail($id);
        
        // Cek apakah user berhak mengakses hasil ini
        if (auth()->id() !== $hasilTes->user_id && !auth()->user()->isAdmin()) {
            return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke hasil tes ini.');
        }
        
        // Ambil semua data jurusan
        $jurusanList = Jurusan::all();
        
        // Cari jurusan yang sesuai dengan hasil tes
        $jurusan = null;
        foreach ($jurusanList as $j) {
            if (strtolower($j->jurusan) == strtolower($hasilTes->hasil)) {
                $jurusan = $j;
                break;
            }
        }
        
        // Jika jurusan ditemukan, ambil saran pekerjaan dan sekolah yang sesuai
        $saranPekerjaanList = [];
        $sekolahList = [];
        if ($jurusan) {
            $saranPekerjaanList = SaranPekerjaan::where('jurusan_id', $jurusan->id)->get();
            $sekolahList = Sekolah::where('jurusan_id', $jurusan->id)->orderBy('nama', 'asc')->get();
        }
        
        // Generate PDF
        $pdf = PDF::loadView('components.user.download', [
            'hasilTes' => $hasilTes,
            'jurusan' => $jurusan,
            'saranPekerjaanList' => $saranPekerjaanList,
            'sekolahList' => $sekolahList,
            'user' => auth()->user(),
        ]);
        
        // Atur nama file download
        $fileName = 'hasil-tes-' . strtolower(str_replace(' ', '-', $hasilTes->hasil)) . '.pdf';
        
        // Download PDF
        return $pdf->download($fileName);
    }
}