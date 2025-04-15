<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $sekolah = Sekolah::with('jurusan')
        ->when($search, function ($query, $search) {
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhereHas('jurusan', function ($q) use ($search) {
                      $q->where('jurusan', 'like', '%' . $search . '%');
                  });
        })
        ->orderBy('nama', 'asc')
        ->paginate(10)
        ->withQueryString();

    return view('components.admin.sekolah.index', [
        'sekolah' => $sekolah,
        'jurusanInfo' => \App\Models\Jurusan::all(),
        'pertanyaanInfo' => \App\Models\Pertanyaan::all(),
        'artikelInfo' => \App\Models\Artikel::all(),
        'usersInfo' => \App\Models\User::all(),
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