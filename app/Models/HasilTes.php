<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilTes extends Model
{
    use HasFactory;
    protected $table = 'hasil_tes';

    protected $guarded = ['id'];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
