<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage; // Tambahkan titik koma di sini

class ArtikelController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['show']);
    }

    /**
     * Menampilkan daftar artikel.
     */
    public function index(Request $request)
{
    $kategoriList = Kategori::all(); // Ambil semua kategori
    $artikelList = Artikel::query();

    if ($request->has('kategori')) {
        $artikelList->where('kategori_id', $request->kategori);
    }

    if ($request->has('search')) {
        $artikelList->where('judul', 'like', '%' . $request->search . '%');
    }

    return view('components.admin.artikels.view', [
        'artikelList' => $artikelList->paginate(10)->withQueryString(),
        'kategoriList' => $kategoriList,
        'jurusanInfo' => \App\Models\Jurusan::all(),
        'pertanyaanInfo' => \App\Models\Pertanyaan::all(),
        'artikelInfo' => \App\Models\Artikel::all(),
        'usersInfo' => \App\Models\User::all(),
    ]);
}

    
    /**
     * Menampilkan form tambah artikel.
     */
    public function create()
    {
        $kategoriList = Kategori::all(); // Mengambil semua kategori
        return view('components.admin.artikels.add', compact('kategoriList'));
    }

    /**
     * Menyimpan artikel baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required|integer|exists:kategori_artikel,id',
            'judul' => 'required|string|max:100',
            'sinopsis' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            'link' => 'required|url',
        ]);

        // Jika ada gambar yang diunggah, simpan ke storage
        if ($request->hasFile('img')) {
            $validatedData['img'] = $request->file('img')->store('artikel_images', 'public');
        }

        Artikel::create($validatedData);
        return redirect('/artikels')->with('success', 'Artikel berhasil ditambahkan');
    }

    /**
     * Menampilkan detail artikel.
     */
    public function show(Artikel $artikel)
    {
        return view('pages.artikelDetail', compact('artikel'));
    }

    /**
     * Menampilkan form edit artikel.
     */
    public function edit(Artikel $artikel)
    {
        $kategoriList = Kategori::all();
        return view('components.admin.artikels.edit', compact('artikel','kategoriList'));
        
    }

    /**
     * Memperbarui artikel di database.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required|integer|exists:kategori_artikel,id',
            'judul' => 'required|string|max:100',
            'sinopsis' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|url',
        ]);

        // Jika ada gambar baru yang diunggah, simpan dan hapus yang lama
        if ($request->hasFile('img')) {
            if ($artikel->img) {
                Storage::disk('public')->delete($artikel->img);
            }
            $validatedData['img'] = $request->file('img')->store('artikel_images', 'public');
        }

        $artikel->update($validatedData);
        return redirect('/artikels')->with('success', 'Artikel berhasil diperbarui');
    }

    /**
     * Menghapus artikel dari database.
     */
    public function destroy(Artikel $artikel)
    {
        if ($artikel->img) {
            Storage::disk('public')->delete($artikel->img);
        }

        $artikel->delete();
        return redirect('/artikels')->with('success', 'Artikel berhasil dihapus');
    }
    
}
