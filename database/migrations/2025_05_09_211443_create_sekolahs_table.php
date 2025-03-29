<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('sekolahs')) { // Cek apakah tabel sudah ada
            Schema::create('sekolahs', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->unsignedBigInteger('jurusan_id')->constrained('jurusan')->onDelete('cascade');;
                $table->timestamps();
            });
        }
    }
    

    public function down()
    {
        Schema::dropIfExists('sekolahs');
    }
};
