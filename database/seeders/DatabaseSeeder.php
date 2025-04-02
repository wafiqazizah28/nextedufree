<?php

namespace Database\Seeders;
use App\Models\Jurusan;
use App\Models\KategoriArtikel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            pertanyaanSeeder::class,
            jurusaneeder::class,
            saranpekerjaaneeder::class,
            ArtikelSeeder::class,
            RuleSeeder::class,
            HasilTesSeeder::class,
            KategoriArtikelSeeder::class,
        ]);
    }
}
