<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use App\Models\Jurusan;
use App\Models\Pertanyaan;
use App\Models\User;

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
        $artikelList = Artikel::orderby('jurusan_id');
        $artikelListInfo = Artikel::all();
        $jurusansInfo = Jurusan::all();
        $pertanyaansInfo = Pertanyaan::all();
        $usersInfo = User::all();

        if (request('search')){
            $artikelList->where('name', 'like', '%' . request('search') . '%');
        }

        return view('components.admin.artikels.view', [
            'artikelList' => $artikelList->paginate(10)->withQueryString(),
            'artikelListInfo' => $artikelListInfo,
            'jurusansInfo' => $jurusansInfo,
            'pertanyaansInfo' => $pertanyaansInfo,
            'usersInfo' => $usersInfo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artikelListInfo = Artikel::all();
        $jurusansInfo = Jurusan::all();
        $pertanyaansInfo = Pertanyaan::all();
        $usersInfo = User::all();

        return view('components.admin.artikels.add', [
            'artikelListInfo' => $artikelListInfo,
            'jurusansInfo' => $jurusansInfo,
            'pertanyaansInfo' => $pertanyaansInfo,
            'usersInfo' => $usersInfo
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtikelRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'jurusan_id' => 'required',
            'description' => 'required',
            'composition' => 'required',
            'dose' => 'required',
        ]);

        $validatedData['img'] = 'https://source.unsplash.com/w8p9cQDLX7I';

        Artikel::create($validatedData);
        return redirect('/artikels')->with('success', 'Artikel berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artikel $artikel)
    {
        $jurusans = Artikel::all();
        return view('pages.medDetail', [
            'artikel' => $artikel,
            'jurusans' => $jurusans
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artikel $artikel)
    {
        $artikelListInfo = Artikel::all();
        $jurusansInfo = Jurusan::all();
        $pertanyaansInfo = Pertanyaan::all();
        $usersInfo = User::all();

        return view('components.admin.artikels.edit', [
            'artikel' => $artikel,
            'artikelListInfo' => $artikelListInfo,
            'jurusansInfo' => $jurusansInfo,
            'pertanyaansInfo' => $pertanyaansInfo,
            'usersInfo' => $usersInfo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtikelRequest $request, Artikel $artikel)
    {
        $rules = [
            'name' => 'required',
            'jurusan_id' => 'required',
            'description' => 'required',
            'composition' => 'required',
            'dose' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $artikel->update($validatedData);
        return redirect('/artikels')->with('success', 'Artikel berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        Artikel::destroy($artikel['id']);
        return redirect('/artikels')->with('success', 'Artikel berhasil dihapus');
    }
}
