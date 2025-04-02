<?php

namespace App\Http\Controllers;

use App\Models\SaranPekerjaan;
use App\Http\Requests\StoreSaranPekerjaanRequest;
use App\Http\Requests\UpdateSaranPekerjaanRequest;
use App\Models\Jurusan;
use App\Models\Artikel;
use App\Models\Pertanyaan;
use App\Models\User;

class SaranPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Add search functionality
        $search = request('search');
        
        $saranPekerjaanList = SaranPekerjaan::query()
            ->when($search, function($query) use ($search) {
                return $query->where('saran_pekerjaan', 'like', '%' . $search . '%')
                    ->orWhereHas('jurusan', function($query) use ($search) {
                        $query->where('jurusan', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('jurusan_id', 'asc')
            ->paginate(10);

        return view('components.admin.saranpekerjaan.view', [
            'saranPekerjaanList' => $saranPekerjaanList,
            'jurusanInfo' => Jurusan::all(),
            'pertanyaanInfo' => Pertanyaan::all(),
            'artikelInfo' => Artikel::all(),
            'userInfo' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.admin.saranpekerjaan.add', [
            'jurusanInfo' => Jurusan::all(),
            'pertanyaanInfo' => Pertanyaan::all(),
            'artikelInfo' => Artikel::all(),
            'userInfo' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaranPekerjaanRequest $request)
    {
        $validatedData = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'saran_pekerjaan' => 'required|string|max:255'
        ]);
        
        SaranPekerjaan::create([
            'jurusan_id' => $validatedData['jurusan_id'],
            'saran_pekerjaan' => $validatedData['saran_pekerjaan']
        ]);
        
        return redirect('/saranpekerjaan')->with('success', 'Saran Pekerjaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SaranPekerjaan $saranPekerjaan)
    {
        return view('components.admin.saranpekerjaan.pdf', [
            'saranPekerjaan' => $saranPekerjaan,
            'jurusan' => $saranPekerjaan->jurusan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaranPekerjaan $saranPekerjaan)
    {
        return view('components.admin.saranpekerjaan.edit', [
            'saranPekerjaan' => $saranPekerjaan,
            'jurusanInfo' => Jurusan::all(),
            'pertanyaanInfo' => Pertanyaan::all(),
            'artikelInfo' => Artikel::all(),
            'userInfo' => User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaranPekerjaanRequest $request, SaranPekerjaan $saranPekerjaan)
    {
        $validatedData = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'saran_pekerjaan' => 'required|string|max:255' // Changed from saranpekerjaan to saran_pekerjaan
        ]);
        
        $saranPekerjaan->update($validatedData);
        return redirect('/saranpekerjaan')->with('success', 'Saran Pekerjaan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaranPekerjaan $saranPekerjaan)
    {
        $saranPekerjaan->delete();
        return redirect('/saranpekerjaan')->with('success', 'Saran Pekerjaan berhasil dihapus');
    }

    /**
     * Export data to PDF.
     */
    public function exportPDF()
    {
        try {
            // Ambil semua data saran pekerjaan
            $saranPekerjaanList = SaranPekerjaan::orderBy('jurusan_id')->get();
            $jurusanInfo = Jurusan::all();
    
            // Cek apakah data benar-benar ada
            dd($saranPekerjaanList); // Hentikan eksekusi dan tampilkan data
    
            // Buat PDF
            $pdf = \PDF::loadView('components.admin.saranpekerjaan.pdf', [
                'saranPekerjaanList' => $saranPekerjaanList,
                'jurusanInfo' => $jurusanInfo
            ]);
    
            return $pdf->download('saran-pekerjaan-data.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF Export Error: ' . $e->getMessage());
            return redirect('/saranpekerjaan')->with('error', 'Gagal mengekspor PDF: ' . $e->getMessage());
        }
    }
    
}