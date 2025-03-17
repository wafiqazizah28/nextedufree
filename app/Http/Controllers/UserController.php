<?php

namespace App\Http\Controllers;

use App\Models\HasilTes;
use App\Models\Jurusan;
use App\Models\Artikel;
use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        // Hanya admin yang bisa mengakses UserController
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hasilTes = HasilTes::all();
        $usersQuery = User::orderBy('id'); // Query Builder
        $pertanyaansInfo = Pertanyaan::all();
        $jurusansInfo = Jurusan::all();
        $artikelsInfo = Artikel::all();

        // Pencarian berdasarkan nama
        if (request('search')) {
            $usersQuery->where('name', 'like', '%' . request('search') . '%');
        }

        $users = $usersQuery->paginate(15)->withQueryString(); // Pagination
        $usersInfo = User::all(); // Data tambahan jika diperlukan

        return view('components.admin.users.view', [
            'hasilTes' => $hasilTes,
            'users' => $users,
            'pertanyaansInfo' => $pertanyaansInfo,
            'jurusansInfo' => $jurusansInfo,
            'artikelsInfo' => $artikelsInfo,
            'usersInfo' => $usersInfo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('components.admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('components.admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$id}",
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
