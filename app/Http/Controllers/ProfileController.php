<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user(); // Mengambil data user yang login
        return view('components.profile.show', compact('user')); // Kirim ke view
    }
    
    public function edit()
    {
        return view('components.profile.edit');
    }
    
    public function update(Request $request)
    {
        $user = auth()->user();
    
        // Validasi Input
        $request->validate([
            'nama' => 'required|string|max:255',
            'sekolah' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Pastikan file gambar valid
            'nomer_hp' => 'nullable|string|max:20', // Make sure this rule exists

        ]);
    
        // Update Foto Jika Ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete('public/' . $user->foto);
            }
    
            // Simpan foto baru
            $filePath = $request->file('foto')->store('profile_pictures', 'public');
            $user->foto = $filePath;
        }
    
        // Update Data Lain
        $user->nama = $request->nama;
        $user->sekolah = $request->sekolah;
        $user->nomer_hp = $request->nomer_hp;
        $user->save();
    
        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }
}