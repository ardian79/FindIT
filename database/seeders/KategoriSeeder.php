<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            ['nama_kategori' => 'Elektronik', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Dokumen & Kartu (KTM/KTP/SIM)', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Dompet & Tas', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Kunci & Aksesori', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Alat Tulis & Buku', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Lainnya', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('kategori')->insert($kategori);
    }
}