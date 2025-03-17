<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50); // Nama
            $table->string('sekolah', 100)->nullable(); // Asal Sekolah
            $table->string('email', 50)->unique(); // Email
            $table->string('nomer_hp', 15)->nullable(); // No Handphone
            $table->string('password'); // Password
            $table->boolean('is_admin')->default(false); // Status admin
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
