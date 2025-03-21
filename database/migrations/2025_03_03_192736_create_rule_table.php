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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('jurusan_id')->constrained('jurusan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pertanyaan_id')->constrained('pertanyaan')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('rule_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
