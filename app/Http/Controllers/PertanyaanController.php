<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use App\Http\Requests\StorePertanyaanRequest;
use App\Http\Requests\UpdatePertanyaanRequest;
use App\Models\Jurusan;
use App\Models\Artikel;
use App\Models\NamaJurusan;
use App\Models\User;

class PertanyaanController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pertanyaans = Pertanyaan::orderBy('pertanyaan_code');
        $pertanyaansInfo = Pertanyaan::all();
        $namajurusansInfo = Jurusan::all();
        $artikelsInfo = Artikel::all();
        $usersInfo = User::all();

        if (request('search')){
            $pertanyaans->where('pertanyaan', 'like', '%' . request('search') . '%');
        }

        return view('components.admin.pertanyaans.view', [
            'pertanyaans' => $pertanyaans->paginate(10)->withQueryString(),
            'pertanyaanInfo' => $pertanyaansInfo,
            'namajurusansInfo' => $namajurusansInfo,
            'artikelsInfo' => $artikelsInfo,
            'usersInfo' => $usersInfo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pertanyaansInfo = Pertanyaan::all();
        $namajurusansInfo = Jurusan::all();
        $artikelsInfo = Artikel::all();
        $usersInfo = User::all();

        return view('components.admin.pertanyaans.add', [
            'pertanyaansInfo' => $pertanyaansInfo,
            'namajurusansInfo' => $namajurusansInfo,
            'artikelsInfo' => $artikelsInfo,
            'usersInfo' => $usersInfo
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePertanyaanRequest $request)
    {
        $validatedData = $request->validate([
            'pertanyaan_code' => 'required',
            'pertanyaans' => 'required',
        ]);

        Pertanyaan::create($validatedData);
        return redirect('/pertanyaans')->with('success', 'Pertanyaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pertanyaan $pertanyaan)
    {
        $pertanyaansInfo = Pertanyaan::all();
        $namajurusansInfo = Jurusan::all();
        $artikelsInfo = Artikel::all();
        $usersInfo = User::all();

        return view('components.admin.pertanyaans.edit', [
            'pertanyaan' => $pertanyaan,
            'pertanyaansInfo' => $pertanyaansInfo,
            'namajurusansInfo' => $namajurusansInfo,
            'artikelsInfo' => $artikelsInfo,
            'usersInfo' => $usersInfo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePertanyaanRequest $request, Pertanyaan $pertanyaan)
    {
        $rules = [
            'pertanyaan_code' => 'required',
            'pertanyaans' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $pertanyaan->update($validatedData);
        return redirect('/pertanyaans')->with('success', 'Pertanyaan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pertanyaan $pertanyaan)
    {
        Pertanyaan::destroy($pertanyaan['id']);
        return redirect('/pertanyaans')->with('success', 'Pertanyaan berhasil dihapus');
    }
}