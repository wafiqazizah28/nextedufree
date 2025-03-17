<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Http\Requests\StoreJurusanRequest;
use App\Http\Requests\UpdateJurusanRequest;
use App\Models\Artikel;
use App\Models\SaranPekerjaan;
use App\Models\Pertanyaan;
use App\Models\User;
use App\Models\Rule;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusanList = Jurusan::orderBy('jurusan_code', 'asc');
        $saranPekerjaanList = SaranPekerjaan::orderBy('jurusan_id', 'asc');
    
        if (request('search')) {
            $jurusanList = $jurusanList->where('jurusan', 'like', '%' . request('search') . '%');
        }
    
        if (request('searchSol')) {
            $saranPekerjaanList = $saranPekerjaanList->where('saranpekerjaan', 'like', '%' . request('searchSol') . '%');
        }
    
        return view('components.admin.jurusans.view', [
            'jurusanList' => $jurusanList->paginate(10)->withQueryString(),
            'saranPekerjaanList' => $saranPekerjaanList->paginate(10)->withQueryString(),
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
        return view('components.admin.jurusans.add', [
            'jurusanInfo' => Jurusan::all(),
            'pertanyaanInfo' => Pertanyaan::all(),
            'artikelInfo' => Artikel::all(),
            'userInfo' => User::all()
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJurusanRequest $request)
    {
        $validatedData = $request->validate([
            'jurusan_code' => 'required',
            'jurusan' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);
    
        $validatedData['img'] = 'https://source.unsplash.com/bkc-m0iZ4Sk';
    
        $jurusan = Jurusan::create($validatedData);
        
        $pertanyaanList = Pertanyaan::all();
        foreach ($pertanyaanList as $pertanyaan) {
            Rule::create([
                'jurusan_id' => $jurusan->id,
                'pertanyaan_id' => $pertanyaan->id,
                'rule_value' => 0
            ]);
        }
    
        return redirect('/jurusans')->with('success', 'Jurusan berhasil ditambahkan');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        return view('pages.jurusanDetail', [
            'jurusan' => $jurusan,
            'saranPekerjaanList' => SaranPekerjaan::where('jurusan_id', $jurusan->id)->get(),
            'artikelList' => Artikel::where('jurusan_id', $jurusan->id)->get()
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        return view('components.admin.jurusans.edit', [
            'jurusan' => $jurusan,
            'jurusanInfo' => Jurusan::all(),
            'pertanyaanInfo' => Pertanyaan::all(),
            'artikelInfo' => Artikel::all(),
            'userInfo' => User::all()
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJurusanRequest $request, Jurusan $jurusan)
    {
        $validatedData = $request->validate([
            'jurusan_code' => 'required',
            'jurusan' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);
    
        $jurusan->update($validatedData);
        return redirect('/jurusans')->with('success', 'Jurusan berhasil diubah');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect('/jurusans')->with('success', 'Jurusan berhasil dihapus');
    }
    public function getJurusanList()
    {
        return response()->json(Jurusan::select('id', 'jurusan')->get());
    }
    
}    
