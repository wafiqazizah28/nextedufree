<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolah = Sekolah::with('jurusan')->orderBy('nama', 'asc');

        // Tambahkan logika pencarian
        if (request('search')) {
            $sekolah = $sekolah->where('nama', 'like', '%' . request('search') . '%');
        }

        return view('components.admin.sekolah.index', [
            'sekolah' => $sekolah->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        $jurusanInfo = Jurusan::all();
        return view('components.admin.sekolah.create', compact('jurusanInfo')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusan,id',
        ]);

        Sekolah::create([
            'nama' => $request->nama,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect()->route('components.admin.sekolah.index')->with('success', 'Sekolah berhasil ditambahkan');
    }

    public function edit(Sekolah $sekolah)
    {
        $jurusanInfo = Jurusan::all();
        return view('components.admin.sekolah.edit', compact('sekolah', 'jurusanInfo'));
    }

    public function update(Request $request, Sekolah $sekolah)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusan,id',
        ]);

        $sekolah->update([
            'nama' => $request->nama,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect()->route('components.admin.sekolah.index')->with('success', 'Sekolah berhasil diperbarui');
    }

    public function destroy(Sekolah $sekolah)
    {
        $sekolah->delete();
        return redirect()->route('components.admin.sekolah.index')->with('success', 'Sekolah berhasil dihapus');
    }
}