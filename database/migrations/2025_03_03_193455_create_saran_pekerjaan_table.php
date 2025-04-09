<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saran_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('jurusan_id')->constrained('jurusan')->onDelete('cascade')->onUpdate('cascade');
            $table->string('saran_pekerjaan');
            $table->string('gambar')->nullable(); // Kolom untuk menyimpan path gambar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saran_pekerjaan');
    }
};