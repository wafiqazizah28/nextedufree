<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolahs = Sekolah::with('jurusan')->get();
        return view('components.admin.sekolah.index', compact('sekolahs'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('components.admin.sekolah.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nama_jurusan_id' => 'required|exists:jurusans,id',
        ]);

        Sekolah::create($request->all());
        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil ditambahkan');
    }

    public function edit(Sekolah $sekolah)
    {
        $jurusans = Jurusan::all();
        return view('components.admin.sekolah.edit', compact('sekolah', 'jurusans'));
    }

    public function update(Request $request, Sekolah $sekolah)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nama_jurusan_id' => 'required|exists:jurusans,id',
        ]);

        $sekolah->update($request->all());
        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil diperbarui');
    }

    public function destroy(Sekolah $sekolah)
    {
        $sekolah->delete();
        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil dihapus');
    }
}
