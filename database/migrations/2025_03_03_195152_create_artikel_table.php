<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migrasi.
     */
    public function up(): void {
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_artikel')->onDelete('cascade')->onUpdate('cascade');
            $table->string('judul', 100);
            $table->string('img', 255)->nullable();
            $table->text('sinopsis');
            $table->text('link');
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void {
        Schema::dropIfExists('artikel');
    }
};
