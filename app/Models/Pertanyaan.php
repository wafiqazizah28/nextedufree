<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan';
    // App\Models\Pertanyaan.php
protected $fillable = ['pertanyaan_code', 'pertanyaan'];

    protected $guarded = ['id'];
}
