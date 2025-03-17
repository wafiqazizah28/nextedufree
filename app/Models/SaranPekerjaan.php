<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranPekerjaan extends Model
{
    use HasFactory;
    protected $table = 'saran_pekerjaan';
    protected $guarded = ['id'];
}
