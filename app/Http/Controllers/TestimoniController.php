<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
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
        $testimonisQuery = Testimoni::with(['user', 'jurusan'])
            ->when($search, function($query) use ($search) {
                return $query->where('testimoni', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                              ->orWhere('asal_sekolah', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('jurusan', function($query) use ($search) {
                        $query->where('jurusan', 'like', '%' . $search . '%');
                    });
            })
            ->latest();
        
        // Paginate the results
        $testimonis = $testimonisQuery->paginate(10);
        
        return view('components.admin.testimoni.index', compact('testimonis'));
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
        $request->validate([
            'testimoni' => 'required|string',
            'jurusan_id' => 'required|exists:jurusan,id',
            'asal_sekolah' => 'nullable|string|max:255',
        ]);
    
        // Get user's school if they're logged in
        $Sekolah = null;
        if (Auth::check()) {
            $Sekolah = Auth::user()->sekolah;
        }
    
        // Create the testimoni record
        Testimoni::create([
            'user_id' => Auth::id() ?? 1, // Use 1 as fallback if not logged in
            'jurusan_id' => $request->jurusan_id,
            'testimoni' => $request->testimoni,
            'asal_sekolah' => $request->sekolah ?? $Sekolah, // Use provided value or user's value
        ]);
    
        // If user is logged in, update their asal_sekolah field if provided
        if (Auth::check() && $request->filled('asal_sekolah')) {
            $user = Auth::user();
            $user->sekolah = $request->sekolah;
            $user->save();
        }
    
        return redirect()->back()->with('success', 'Testimoni berhasil dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimoni $testimoni)
    {
        // Load the necessary relationships
        $testimoni->load(['user', 'jurusan']);
        
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
            $testimonis = Testimoni::with(['user', 'jurusan'])
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