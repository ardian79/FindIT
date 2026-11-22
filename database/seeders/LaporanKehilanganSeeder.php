<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\LaporanKehilangan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class LaporanKehilanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriIds = Kategori::pluck('id')->values();
        $penggunaIds = User::where('role', 'mahasiswa')->pluck('id')->values();
        if ($penggunaIds->isEmpty()) {
            $penggunaIds = User::pluck('id')->values();
        }

        $katAt = fn(int $index) => $kategoriIds[$index % max($kategoriIds->count(), 1)] ?? 1;
        $userAt = fn(int $index) => $penggunaIds[$index % max($penggunaIds->count(), 1)] ?? 1;

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
                'pengguna_id' => $userAt(0),
                'kategori_id' => $katAt(0),
                'nama_barang' => 'Earphone TWS Putih Case Silikon',
                'lokasi_hilang' => 'Kantin Pusat Kampus Tegal Boto UNEJ',
                'tanggal_hilang' => '2026-11-16',
                'deskripsi' => 'Casing earphone warna putih dengan pelindung silikon bening, terakhir terlihat saat istirahat siang.',
                'foto_barang' => null,
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(1),
                'kategori_id' => $katAt(1),
                'nama_barang' => 'Dompet Lipat Kulit Coklat Tua',
                'lokasi_hilang' => 'Area Gazebo Masjid Al-Hikmah UNEJ',
                'tanggal_hilang' => '2026-11-17',
                'deskripsi' => 'Dompet lipat bahan kulit coklat tua berisi kartu identitas dan kartu ATM, hilang menjelang sore.',
                'foto_barang' => $publishFoto('dompet.jpg', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(2),
                'kategori_id' => $katAt(2),
                'nama_barang' => 'Kacamata Minus Frame Hitam',
                'lokasi_hilang' => 'Perpustakaan Pusat Lantai 2 UNEJ',
                'tanggal_hilang' => '2026-11-18',
                'deskripsi' => 'Kacamata minus bingkai hitam tipis beserta kotak kain abu-abu, tertinggal saat belajar mandiri.',
                'foto_barang' => $publishFoto('kacamata.jpg', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
        ];

        foreach ($items as $item) {
            $record = LaporanKehilangan::firstOrCreate(
                ['nama_barang' => $item['nama_barang']],
                $item
            );

            if (! $record->foto_barang && $item['foto_barang']) {
                $record->update(['foto_barang' => $item['foto_barang']]);
            }
        }
    }
}
