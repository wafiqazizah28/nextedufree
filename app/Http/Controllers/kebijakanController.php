<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kebijakanController extends Controller
{
    /**
     * Menampilkan halaman kebijakan privasi
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Untuk data yang statis seperti kebijakan privasi, kita hanya perlu
        // mengembalikan view tanpa data tambahan
        return view('pages.kebijakan');
    }
}