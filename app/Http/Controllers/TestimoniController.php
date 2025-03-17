<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestimoniController extends Controller
{
    public function index()
    {
        // Update semua testimoni agar user_id menjadi 1 jika masih NULL
        DB::table('testimonis')->whereNull('user_id')->update(['user_id' => 1]);

        // Ambil data testimoni dengan relasi user dan jurusan
        $testimonis = Testimoni::with(['user', 'jurusan'])->latest()->get();

        return view('components.admin.testimoni.index', compact('testimonis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'testimoni' => 'required|string',
            'foto_profil' => 'nullable|image|max:2048',
        ]);

        $fotoPath = $request->file('foto_profil') 
            ? $request->file('foto_profil')->store('profile_photos', 'public') 
            : null;

        Testimoni::create([
            'user_id' => Auth::id(),
            'nama_jurusan_id' => Auth::user()->jurusan_id,
            'asal_sekolah' => Auth::user()->asal_sekolah,
            'testimoni' => $request->testimoni,
            'foto_profil' => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Testimoni berhasil dikirim');
    }
}
