<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranPekerjaan extends Model
{
    use HasFactory;
    
    protected $table = 'saran_pekerjaan'; // Make sure this matches your actual table name
    
    protected $fillable = [
        'jurusan_id',
        'saran_pekerjaan'
    ];
    
    // Relationship with Jurusan model
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
}