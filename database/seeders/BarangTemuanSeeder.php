<?php

namespace Database\Seeders;

use App\Models\BarangTemuan;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BarangTemuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriIds = Kategori::pluck('id')->values();
        $katAt = fn(int $index) => $kategoriIds[$index % max($kategoriIds->count(), 1)] ?? 1;

        $publishFoto = function (?string $seedFile, string $targetFolder): ?string {
            if (! $seedFile) {
                return null;
            }

            $cleanName = basename($seedFile);
            $sourceDiskPath = public_path('seed-barang/' . $cleanName);
            $targetPath = trim($targetFolder, '/') . '/' . $cleanName;

            if (is_file($sourceDiskPath)) {
                Storage::disk('public')->put($targetPath, file_get_contents($sourceDiskPath));
                return $targetPath;
            }

            return null;
        };

        $items = [
            [
                'kategori_id' => $katAt(0),
                'nama_barang' => 'Flashdisk Kingston 64GB Tali Hitam',
                'lokasi_ditemukan' => 'Laboratorium Pemrograman Gedung B Fasilkom UNEJ',
                'tanggal_ditemukan' => '2026-11-17',
                'deskripsi' => 'Flashdisk warna hitam dan silver dengan tali gantungan kecil, tertinggal di meja praktikum sisi barat.',
                'foto_barang' => $publishFoto('flashdisk.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katAt(1),
                'nama_barang' => 'Tumbler Stainless Abu-Abu Matte',
                'lokasi_ditemukan' => 'Ruang Kuliah 2.3 Fakultas Ekonomi dan Bisnis UNEJ',
                'tanggal_ditemukan' => '2026-11-18',
                'deskripsi' => 'Botol minum stainless ukuran sekitar 500 ml warna abu-abu doff, ditemukan di kursi baris tengah.',
                'foto_barang' => $publishFoto('tumbler.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katAt(2),
                'nama_barang' => 'Kunci Motor Honda Gantungan Biru',
                'lokasi_ditemukan' => 'Area Parkir Motor Perpustakaan Pusat UNEJ',
                'tanggal_ditemukan' => '2026-11-19',
                'deskripsi' => 'Anak kunci motor Honda lengkap dengan gantungan plastik biru, diserahkan saat patroli pagi.',
                'foto_barang' => $publishFoto('kunci-motor.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katAt(3),
                'nama_barang' => 'Jaket Hoodie Abu-Abu Resleting',
                'lokasi_ditemukan' => 'Selasar Gedung Fakultas Keguruan dan Ilmu Pendidikan UNEJ',
                'tanggal_ditemukan' => '2026-11-20',
                'deskripsi' => 'Jaket hoodie bahan fleece abu-abu muda dengan resleting depan, tertinggal di kursi tunggu selasar.',
                'foto_barang' => $publishFoto('hoddie.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katAt(4),
                'nama_barang' => 'Kalkulator Scientific Casio Hitam',
                'lokasi_ditemukan' => 'Ruang Ujian Gedung Fakultas Teknik UNEJ',
                'tanggal_ditemukan' => '2026-11-21',
                'deskripsi' => 'Kalkulator ilmiah warna hitam dengan tutup geser keras, diamankan setelah sesi ujian selesai.',
                'foto_barang' => $publishFoto('kalkulator.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
        ];

        foreach ($items as $item) {
            $record = BarangTemuan::firstOrCreate(
                ['nama_barang' => $item['nama_barang']],
                $item
            );

            if (! $record->foto_barang && $item['foto_barang']) {
                $record->update(['foto_barang' => $item['foto_barang']]);
            }
        }
    }
}
