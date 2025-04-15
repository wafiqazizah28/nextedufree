<?php

namespace App\Http\Controllers;

use App\Models\SaranPekerjaan;
use App\Http\Requests\StoreSaranPekerjaanRequest;
use App\Http\Requests\UpdateSaranPekerjaanRequest;
use App\Models\Jurusan;
use App\Models\Artikel;
use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'usersInfo' => User::all()
        ]);
    }
/**
 * Remove the specified resource from storage.
 */
public function destroy($id)
{
    $saranPekerjaan = SaranPekerjaan::findOrFail($id);
    
    // Delete the associated image if it exists
    if ($saranPekerjaan->gambar) {
        Storage::delete('public/' . $saranPekerjaan->gambar);
    }
    
    // Delete the record
    $saranPekerjaan->delete();
    
    return redirect('/saranpekerjaan')->with('success', 'Saran Pekerjaan berhasil dihapus');
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'saran_pekerjaan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $data = [
            'jurusan_id' => $validatedData['jurusan_id'],
            'saran_pekerjaan' => $validatedData['saran_pekerjaan']
        ];
        
        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('public/saran-pekerjaan');
            $data['gambar'] = str_replace('public/', '', $gambarPath);
        }
        
        SaranPekerjaan::create($data);
        
        return redirect('/saranpekerjaan')->with('success', 'Saran Pekerjaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SaranPekerjaan $saranPekerjaan)
    {
        return view('components.admin.saranpekerjaan.show', [
            'saranPekerjaan' => $saranPekerjaan,
            'jurusan' => $saranPekerjaan->jurusan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $saranPekerjaan = SaranPekerjaan::findOrFail($id);
    
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
   /**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    // Temukan model
    $saranPekerjaan = SaranPekerjaan::findOrFail($id);
    
    // Validasi input
    $validatedData = $request->validate([
        'jurusan_id' => 'required|exists:jurusan,id',
        'saran_pekerjaan' => 'required|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);
    
    // Update data
    $saranPekerjaan->jurusan_id = $validatedData['jurusan_id'];
    $saranPekerjaan->saran_pekerjaan = $validatedData['saran_pekerjaan'];
    
    // Handle file upload jika ada
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($saranPekerjaan->gambar) {
            Storage::delete('public/' . $saranPekerjaan->gambar);
        }
        
        // Simpan gambar baru
        $imagePath = $request->file('gambar')->store('saran-pekerjaan', 'public');
        $saranPekerjaan->gambar = $imagePath;
    }
    
    // Tambahkan debugging
    // dd($saranPekerjaan, $request->all(), 'About to save');
    
    // Simpan perubahan
    $saranPekerjaan->save();
    
    // Redirect dengan pesan sukses
    return redirect('/saranpekerjaan')->with('success', 'Saran Pekerjaan berhasil diupdate');
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