<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function __construct(){
        $this->middleware('admin')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikelList = Artikel::query(); // Hapus with('jurusan') karena tidak ada relasi

        if (request('search')){
            $artikelList->where('judul', 'like', '%' . request('search') . '%');
        }

        return view('components.admin.artikels.view', [
            'artikelList' => $artikelList->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.admin.artikels.add'); // Hapus pengambilan data dari tabel 'jurusans'
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:100',
            'jurusan' => 'required|string', // Hanya string, tidak dicek di tabel 'jurusans'
            'sinopsis' => 'nullable|string',
            'img' => 'nullable|url',
            'link' => 'required|url',
        ]);

        Artikel::create($validatedData);
        return redirect('/artikels')->with('success', 'Artikel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $artikel)
    {
        return view('pages.artikelDetail', [
            'artikel' => $artikel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        return view('components.admin.artikels.edit', [
            'artikel' => $artikel
        ]); // Hapus pengambilan data dari tabel 'jurusans'
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artikel $artikel)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:100',
            'jurusan' => 'required|string', // Hanya string, tidak dicek di tabel 'jurusans'
            'sinopsis' => 'nullable|string',
            'img' => 'nullable|url',
            'link' => 'required|url',
        ]);

        $artikel->update($validatedData);
        return redirect('/artikels')->with('success', 'Artikel berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        return redirect('/artikels')->with('success', 'Artikel berhasil dihapus');
    }
}
