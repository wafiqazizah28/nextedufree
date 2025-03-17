<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel users.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin NextEdu',
            'sekolah' => 'SMAN 1 Jakarta',
            'email' => 'admin@gmail.com',
            'nomer_hp' => '081234567890',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        User::create([
            'nama' => 'Vincent',
            'sekolah' => 'SMK Telkom',
            'email' => 'vincent@gmail.com',
            'nomer_hp' => '082233445566',
            'password' => Hash::make('vincent123'),
        ]);

        User::create([
            'nama' => 'Rucci',
            'sekolah' => 'SMA Negeri 5',
            'email' => 'rucci@gmail.com',
            'nomer_hp' => '081298765432',
            'password' => Hash::make('rucci123'),
        ]);

        User::create([
            'nama' => 'Darren',
            'sekolah' => 'SMK Negeri 2',
            'email' => 'darren@gmail.com',
            'nomer_hp' => '081377788899',
            'password' => Hash::make('darren123'),
        ]);
    }
}
