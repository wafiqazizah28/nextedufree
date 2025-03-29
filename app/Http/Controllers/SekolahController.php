<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index()
{
    $sekolahs = Sekolah::with('jurusan')->orderBy('nama', 'asc');

    // Tambahkan logika pencarian
    if (request('search')) {
        $sekolahs = $sekolahs->where('nama', 'like', '%' . request('search') . '%');
    }

    return view('components.admin.sekolahs.index', [
        'sekolahs' => $sekolahs->paginate(10)->withQueryString()
    ]);
}


    public function create()
    {
        $jurusanInfo = Jurusan::all();
        return view('components.admin.sekolahs.create', compact('jurusanInfo')); // Ubah path view
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusan,id', // Perbaiki nama tabel
        ]);

        Sekolah::create([
            'nama' => $request->nama,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect()->route('components.admin.sekolahs.index')->with('success', 'Sekolah berhasil ditambahkan');
    }

    public function edit(Sekolah $sekolah)
    {
        $jurusanInfo = Jurusan::all();
        return view('components.admin.sekolahs.edit', compact('sekolah', 'jurusanInfo'));
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

        return redirect()->route('components.admin.sekolahs.index')->with('success', 'Sekolah berhasil diperbarui');
    }

    public function destroy(Sekolah $sekolah)
    {
        $sekolah->delete();
        return redirect()->route('components.admin.sekolahs.index')->with('success', 'Sekolah berhasil dihapus');
    }

   

}
