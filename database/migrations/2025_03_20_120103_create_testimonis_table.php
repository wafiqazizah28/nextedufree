<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('testimonis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke users
            $table->foreignId('nama_jurusan_id')->constrained('jurusan')->onDelete('cascade'); // Relasi ke jurusan
            $table->string('asal_sekolah');
            $table->text('testimoni');
            $table->string('foto_profil')->nullable(); // Menyimpan path foto profil
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('testimonis');
    }
};
