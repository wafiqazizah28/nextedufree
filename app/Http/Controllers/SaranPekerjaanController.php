<?php

namespace App\Http\Controllers;

use App\Models\SaranPekerjaan;
use App\Http\Requests\StoreSaranPekerjaanRequest;
use App\Http\Requests\UpdateSaranPekerjaanRequest;
use App\Models\Jurusan;
use App\Models\Artikel;
use App\Models\Pertanyaan;
use App\Models\User;

class SaranPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saranPekerjaanList = SaranPekerjaan::orderBy('jurusan_id', 'asc')->paginate(10);

        return view('components.admin.saranpekerjaans.view', [
            'saranPekerjaanList' => $saranPekerjaanList,
            'jurusanInfo' => Jurusan::all(),
            'pertanyaanInfo' => Pertanyaan::all(),
            'artikelInfo' => Artikel::all(),
            'userInfo' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.admin.saranpekerjaans.add', [
            'jurusanInfo' => Jurusan::all(),
            'pertanyaanInfo' => Pertanyaan::all(),
            'artikelInfo' => Artikel::all(),
            'userInfo' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaranPekerjaanRequest $request)
    {
        $validatedData = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'saranpekerjaan' => 'required|string|max:255'
        ]);

        SaranPekerjaan::create($validatedData);
        return redirect('/saranpekerjaan')->with('success', 'Saran Pekerjaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(SaranPekerjaan $saranPekerjaan)
    {
        return view('pages.saranPekerjaanDetail', [
            'saranPekerjaan' => $saranPekerjaan,
            'jurusan' => $saranPekerjaan->jurusan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaranPekerjaan $saranPekerjaan)
    {
        return view('components.admin.saranpekerjaans.edit', [
            'saranPekerjaan' => $saranPekerjaan,
            'jurusanInfo' => Jurusan::all(),
            'pertanyaanInfo' => Pertanyaan::all(),
            'artikelInfo' => Artikel::all(),
            'userInfo' => User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaranPekerjaanRequest $request, SaranPekerjaan $saranPekerjaan)
    {
        $validatedData = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'saranpekerjaan' => 'required|string|max:255',
        ]);

        $saranPekerjaan->update($validatedData);
        return redirect('/saranpekerjaan')->with('success', 'Saran Pekerjaan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaranPekerjaan $saranPekerjaan)
    {
        $saranPekerjaan->delete();
        return redirect('/saranpekerjaan')->with('success', 'Saran Pekerjaan berhasil dihapus');
    }
}
