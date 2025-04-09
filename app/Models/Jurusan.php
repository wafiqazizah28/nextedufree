<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    
    protected $table = 'jurusan'; // Sesuaikan dengan nama tabel di database
    protected $guarded = ['id'];
    public function saranPekerjaan()
    {
        return $this->hasMany(SaranPekerjaan::class, 'jurusan_id');
    }

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class);
    }

}


