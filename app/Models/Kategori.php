<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    
    protected $table = 'kategori_artikel'; // Nama tabel sesuai database
    protected $primaryKey = 'id';
    public $timestamps = true; // Karena ada created_at dan updated_at

    protected $fillable = ['nama_kategori']; // Sesuaikan dengan kolom di tabel
}
