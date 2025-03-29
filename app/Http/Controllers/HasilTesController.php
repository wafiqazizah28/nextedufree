<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
use App\Http\Requests\StoreHasilTesRequest;
use App\Http\Requests\UpdateHasilTesRequest; // Ensure this class exists in the specified namespace

class HasilTesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $hasilTerbaru = HasilTes::where('user_id', auth()->id())->latest()->first();

    return view('documents.admin.pages.hasilTes', [
        'hasilTes' => $hasilTerbaru
    ]);
}
public function hasilTes()
{
    $userId = auth()->id(); // Ambil ID user yang login
    $hasilTes = HasilTes::where('user_id', $userId)->latest()->first(); // Ambil hasil tes terbaru

    if (!$hasilTes) {
        return view('hasil_tes', [
            'hasilTes' => null,
            'jurusan' => null,
            'saranPekerjaan' => collect([]) // Kirim array kosong agar tidak error di Blade
        ]);
    }

    $jurusan = Jurusan::where('nama_jurusan', $hasilTes->hasil)->first(); // Cocokkan hasil tes dengan jurusan

    if (!$jurusan) {
        return view('hasil_tes', [
            'hasilTes' => $hasilTes,
            'jurusan' => null,
            'saranPekerjaan' => collect([])
        ]);
    }

    // Ambil pekerjaan sesuai jurusan
    $saranPekerjaan = SaranPekerjaan::where('jurusan_id', $jurusan->id)->get();

    return view('hasil_tes', [
        'hasilTes' => $hasilTes,
        'jurusan' => $jurusan,
        'saranPekerjaan' => $saranPekerjaan
    ]);
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHasilTesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HasilTes $hasilTes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HasilTes $hasilTes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHasilTesRequest $request, HasilTes $hasilTes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HasilTes $hasilTes)
    {
        //
    }
}