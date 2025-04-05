<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranPekerjaan extends Model
{
    use HasFactory;
    
    // Pastikan nama tabelnya benar
    protected $table = 'saran_pekerjaan';
    
    // Pastikan kolom yang bisa diisi (fillable) termasuk saran_pekerjaan
    protected $fillable = [
        'jurusan_id',
        'saran_pekerjaan',
        'gambar'
    ];
    // Di model SaranPekerjaan
protected $primaryKey = 'id'; // Pastikan ini benar sesuai dengan kolom di tabel
    // Relasi ke Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}