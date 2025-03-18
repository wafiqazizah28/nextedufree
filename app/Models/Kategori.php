<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori_artikel'; // Ubah sesuai dengan nama tabel

    protected $fillable = ['nama_kategori']; // Sesuaikan dengan kolom di tabel
}
