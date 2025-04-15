<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;
    
    // Set timestamp fields
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $table = 'testimonis';
    protected $fillable = ['user_id', 'hasil', 'testimoni'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => 'User Tidak Diketahui',
        ]);
    }

    // Relasi ke Jurusan (sekarang menggunakan kolom 'hasil')
    public function Hasil()
    {
        return $this->belongsTo(HasilTes::class, 'hasil')->withDefault([
            'hasil' => 'hasil Tidak Diketahui',
        ]);
    }
    // In your User model
public function testimonials()
{
    return $this->hasMany(Testimoni::class);
}
}