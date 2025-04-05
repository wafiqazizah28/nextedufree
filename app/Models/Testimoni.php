<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    public $timestamps = false;

    use HasFactory;

    protected $table = 'testimonis';
    protected $fillable = ['user_id', 'jurusan_id', 'asal_sekolah', 'testimoni'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'User Tidak Diketahui',
            'foto_profil' => 'assets/img/default-profile.png',  // Sesuai dengan path di Blade
            'asal_sekolah' => 'Tidak Diketahui',
        ]);
    }

    // Relasi ke Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id')->withDefault([
            'name' => 'Jurusan Tidak Diketahui',
        ]);
    }
}
