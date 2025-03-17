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
<<<<<<< HEAD
            pertanyaanSeeder::class,
            JurusanSeeder::class,
            SaranPekerjaanSeeder::class,
            ArtikelSeeder::class,
            RuleSeeder::class,
            HasilTesSeeder::class,
            KategoriArtikelSeeder::class,
=======
            
>>>>>>> bc85eeeee83a1be0a32ba675f333ff110d3cf2d8
        ]);
    }
}
