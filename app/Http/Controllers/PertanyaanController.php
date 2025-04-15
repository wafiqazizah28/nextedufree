<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use App\Http\Requests\StorePertanyaanRequest;
use App\Http\Requests\UpdatePertanyaanRequest;
use App\Models\Jurusan;
use App\Models\Artikel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertanyaanController extends Controller
{
/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Apply the admin middleware to all methods in this controller.
     * 
     * This middleware will check if the user is an admin before allowing
     * them to access any of the methods in this controller.
     */

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $query = Pertanyaan::orderBy('pertanyaan_code');

        if ($request->has('search')) {
            $query->where('pertanyaan', 'like', '%' . $request->search . '%');
        }

        return view('components.admin.pertanyaan.view', [
            'pertanyaanList' => $query->paginate(10)->withQueryString(),
            'pertanyaanInfo' => Pertanyaan::all(),
            'jurusanInfo' => Jurusan::all(),
            'artikelInfo' => Artikel::all(),
            'usersInfo' => User::all()
        ]);
    }

    public function create()
    {
        return view('components.admin.pertanyaan.add', [
            'pertanyaanInfo' => Pertanyaan::all(),
            'jurusanInfo' => Jurusan::all(),
            'artikelInfo' => Artikel::all(),
            'usersInfo' => User::all()
        ]);
    }

 public function store(StorePertanyaanRequest $request)
{
    Pertanyaan::create([
        'pertanyaan_code' => $request->pertanyaan_code,
        'pertanyaan' => $request->pertanyaan,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('pertanyaan.index')->with('success', 'Pertanyaan berhasil ditambahkan');
}


    public function show(Pertanyaan $pertanyaan)
    {
        return view('components.admin.pertanyaan.show', compact('pertanyaan'));
    }

    public function edit(Pertanyaan $pertanyaan)
    {
        return view('components.admin.pertanyaan.edit', [
            'pertanyaan' => $pertanyaan,
            'pertanyaanInfo' => Pertanyaan::all(),
            'jurusanInfo' => Jurusan::all(),
            'artikelInfo' => Artikel::all(),
            'usersInfo' => User::all()
        ]);
    }

    public function update(UpdatePertanyaanRequest $request, Pertanyaan $pertanyaan)
    {
        $pertanyaan->update($request->validated());
        return redirect()->route('pertanyaan.index')->with('success', 'Pertanyaan berhasil diubah');
    }

    public function destroy(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();
        return redirect()->route('pertanyaan.index')->with('success', 'Pertanyaan berhasil dihapus');
    }
    
}
