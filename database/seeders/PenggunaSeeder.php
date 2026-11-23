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
        $now = now();
        $passwordMahasiswa = Hash::make('mahasiswa123');

        DB::table('pengguna')->insert([
            'nama' => 'Petugas',
            'nim' => null,
            'email' => 'petugas@unej.ac.id',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
            'no_hp' => '081234567890',
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $mahasiswa = [
            ['Dimas Pratama Putra', '222410101001', '081234561001', true],
            ['Nabila Aulia Rahma', '222410101014', '081234561002', true],
            ['Bagus Setiawan', '222410102008', '081234561003', true],
            ['Siti Nurhaliza Putri', '222410103019', '081234561004', true],
            ['Fajar Ramadhan', '232410101005', '081234561005', true],
            ['Aisyah Maharani', '232410101022', '081234561006', true],
            ['Rizky Aditya Nugroho', '232410102011', '081234561007', true],
            ['Intan Permata Sari', '232410103009', '081234561008', true],
            ['M. Iqbal Maulana', '231810101016', '081234561009', true],
            ['Dina Kartika Dewi', '231910201004', '081234561010', true],
            ['Hendra Wijaya', '242410101003', '081234561011', true],
            ['Putri Wahyuni', '242410101017', '081234561012', true],
            ['Alif Rahman Hakim', '242410102025', '081234561013', true],
            ['Laila Nur Azizah', '242410103012', '081234561014', true],
            ['Bima Sakti Pradana', '240810201007', '081234561015', true],
            ['Citra Lestari', '240210101031', '081234561016', true],
            ['Galih Kusuma', '241510501018', '081234561017', true],
            ['Nadia Safitri', '242110101009', '081234561018', true],
            ['Wahyu Hidayatullah', '220710101042', '081234561019', false],
            ['Rani Oktaviani', '230910201028', '081234561020', false],
        ];

        $rows = array_map(fn ($m) => [
            'nama' => $m[0],
            'nim' => $m[1],
            'email' => $m[1] . '@mail.unej.ac.id',
            'password' => $passwordMahasiswa,
            'role' => 'mahasiswa',
            'no_hp' => $m[2],
            'is_active' => $m[3],
            'created_at' => $now,
            'updated_at' => $now,
        ], $mahasiswa);

        DB::table('pengguna')->insert($rows);
    }
}