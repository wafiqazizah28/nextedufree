<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi.
     */
    public function up(): void {
        Schema::create('kategori_artikel', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 100);
            $table->timestamps();
        });

        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('link_artikel', 255);
            $table->foreignId('jurusan_id')->constrained('jurusan')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategori_artikel')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void {
        Schema::dropIfExists('artikels');
        Schema::dropIfExists('kategori_artikel');
    }
};
