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
            
        ]);
    }
}
