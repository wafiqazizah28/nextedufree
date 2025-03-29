<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'jurusan_id']; // Fix: Pastikan sesuai dengan kolom di tabel

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
