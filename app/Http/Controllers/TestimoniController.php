<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use App\Models\HasilTes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource for admin view.
     */
    public function index(Request $request)
{
    // Update semua testimoni agar user_id menjadi 1 jika masih NULL
    DB::table('testimonis')->whereNull('user_id')->update(['user_id' => 1]);

    // Get search parameter
    $search = $request->input('search');
    
    // Query with search condition
    $testimonisQuery = Testimoni::with(['user', 'Hasil'])
        ->when($search, function($query) use ($search) {
            return $query->where('testimoni', 'like', '%' . $search . '%')
                ->orWhereHas('user', function($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                })
                ->orWhereHas('Hasil', function($query) use ($search) {
                    $query->where('hasil', 'like', '%' . $search . '%');
                });
        })
        ->latest();
    
    // Paginate the results
    $testimonis = $testimonisQuery->paginate(10);

    // Return view with all needed data
    return view('components.admin.testimoni.index', [
        'testimonis' => $testimonis,
        'jurusanInfo' => \App\Models\Jurusan::all(),
        'pertanyaanInfo' => \App\Models\Pertanyaan::all(),
        'artikelInfo' => \App\Models\Artikel::all(),
        'usersInfo' => \App\Models\User::all()
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // If you need a form to create testimonials
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'testimoni' => 'required|string',
                'hasil' => 'required|exists:hasil_tes,id',
            ]);
    
            // Check for existing testimoni
            $existingTestimoni = Testimoni::where('user_id', Auth::id())
                ->where('hasil', $request->hasil)
                ->first();
    
            if ($existingTestimoni) {
                return redirect()->back()->with('error', 'Anda sudah memberikan testimoni untuk hasil tes ini.');
            }
    
            // Create the testimoni record
            $testimoni = Testimoni::create([
                'user_id' => Auth::id(),
                'hasil' => $request->hasil,
                'testimoni' => $request->testimoni,
            ]);
    
            if ($testimoni) {
                return redirect()->back()->with('success', 'Testimoni berhasil dikirim');
            } else {
                return redirect()->back()->with('error', 'Gagal menyimpan testimoni');
            }
        } catch (\Exception $e) {
            \Log::error('Testimoni Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Testimoni $testimoni)
    {
        // Load the necessary relationships
        $testimoni->load(['user', 'Hasil']);
        
        // Return the view with the testimoni data
        return view('components.admin.testimoni.show', compact('testimoni'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $testimoni)
    {
        // If you need an edit form
        return view('components.admin.testimoni.edit', compact('testimoni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $request->validate([
            'testimoni' => 'required|string',
        ]);

        $testimoni->update([
            'testimoni' => $request->testimoni,
            // Add other fields that can be updated
        ]);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $testimoni)
    {
        $testimoni->delete();
        
        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil dihapus');
    }

    /**
     * Export data to PDF.
     */
    public function exportPDF()
    {
        try {
            // Get all testimonials with relationships
            $testimonis = Testimoni::with(['user', 'Hasil'])
                ->orderBy('created_at', 'desc')
                ->get();
            
            // First render the view to HTML
            $html = view('components.admin.testimoni.pdf', [
                'testimonis' => $testimonis
            ])->render();
            
            // Then load the HTML into the PDF generator
            $pdf = PDF::loadHTML($html);
            
            // Add debugging
            if ($testimonis->count() === 0) {
                \Log::info('No testimoni data found for PDF export');
            } else {
                \Log::info('Found ' . $testimonis->count() . ' testimoni records for PDF export');
            }
            
            return $pdf->download('testimoni-data.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF Export Error: ' . $e->getMessage());
            return redirect('/testimoni')->with('error', 'Gagal mengekspor PDF: ' . $e->getMessage());
        }
    }
}