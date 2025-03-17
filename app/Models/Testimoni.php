<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $table = 'testimonis';
    protected $guarded = ['id'];

    // Relasi ke User (Menghubungkan testimoni dengan user yang memberikan testimoni)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'User Tidak Diketahui', // Default jika user_id NULL
            'foto_profil' => 'default.png',  // Default foto jika tidak ada
            'asal_sekolah' => 'Tidak Diketahui', // Default asal sekolah
        ]);
    }

    // Relasi ke Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'nama_jurusan_id')->withDefault([
            'name' => 'Jurusan Tidak Diketahui', // Default jika jurusan tidak ada
        ]);
    }
}
