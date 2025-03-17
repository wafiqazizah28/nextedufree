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
            $table->timestamps();
            $table->string('nama_kategori', 100);
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void {
        Schema::dropIfExists('kategori_artikel');
    }
};


 