<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengguna')->insert([
            'nama' => 'Petugas Pos Keamanan UNEJ',
            'nim' => null,
            'email' => 'petugas@unej.ac.id',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
            'no_hp' => '081234567890',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}