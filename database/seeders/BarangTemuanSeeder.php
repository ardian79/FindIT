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
        $kategoriMap = Kategori::pluck('id', 'nama_kategori');
        $katBy = fn(string $nama) => $kategoriMap[$nama] ?? $kategoriMap->first() ?? 1;

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
                'kategori_id' => $katBy('Dompet & Tas'),
                'nama_barang' => 'Dompet Kulit Coklat',
                'lokasi_ditemukan' => 'Perpustakaan Pusat Lantai 2 UNEJ',
                'tanggal_ditemukan' => '2026-11-22',
                'deskripsi' => 'Dompet lipat kulit warna coklat tua ditemukan di meja baca dekat rak buku referensi.',
                'foto_barang' => $publishFoto('temuan-dompet-coklat.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Flashdisk SanDisk 32GB',
                'lokasi_ditemukan' => 'Lab Basis Data FASILKOM UNEJ',
                'tanggal_ditemukan' => '2026-11-21',
                'deskripsi' => 'Flashdisk warna hitam-merah tertinggal di PC baris kedua sebelah kanan.',
                'foto_barang' => $publishFoto('temuan-flashdisk.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Lainnya'),
                'nama_barang' => 'Hoodie Hitam Polos',
                'lokasi_ditemukan' => 'Gazebo Masjid Al-Hikmah UNEJ',
                'tanggal_ditemukan' => '2026-11-21',
                'deskripsi' => 'Hoodie katun warna hitam polos ukuran L tanpa resleting, kondisi bersih terlipat.',
                'foto_barang' => $publishFoto('temuan-hoodie-hitam.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Kunci & Aksesori'),
                'nama_barang' => 'Kacamata Minus Frame Hitam',
                'lokasi_ditemukan' => 'Ruang Kuliah 302 Gedung Mas Soerachman',
                'tanggal_ditemukan' => '2026-11-20',
                'deskripsi' => 'Kacamata minus frame tipis warna hitam beserta kotak kain abu-abu di bawah kursi.',
                'foto_barang' => $publishFoto('temuan-kacamata-hitam.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Kalkulator Ilmiah Casio',
                'lokasi_ditemukan' => 'Gedung CDAST Lantai 3 UNEJ',
                'tanggal_ditemukan' => '2026-11-20',
                'deskripsi' => 'Kalkulator scientific Casio FX-991EX tertinggal di meja setelah ujian praktikum.',
                'foto_barang' => $publishFoto('temuan-kalkulator.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Kunci & Aksesori'),
                'nama_barang' => 'Kunci Motor Honda Beat',
                'lokasi_ditemukan' => 'Parkiran Barat FASILKOM UNEJ',
                'tanggal_ditemukan' => '2026-11-19',
                'deskripsi' => 'Kunci motor Honda dengan gantungan karet warna biru, ditemukan dekat pos parkir.',
                'foto_barang' => $publishFoto('temuan-kunci-motor.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Lainnya'),
                'nama_barang' => 'Tumbler Stainless Hitam',
                'lokasi_ditemukan' => 'Kantin Pusat Kampus Tegal Boto UNEJ',
                'tanggal_ditemukan' => '2026-11-19',
                'deskripsi' => 'Tumbler stainless steel 500ml warna hitam doff, ada sedikit goresan di bagian bawah.',
                'foto_barang' => $publishFoto('temuan-tumbler-hitam.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Charger Laptop Type-C 65W',
                'lokasi_ditemukan' => 'Co-Working Space Perpustakaan UNEJ',
                'tanggal_ditemukan' => '2026-11-18',
                'deskripsi' => 'Adaptor charger laptop Type-C 65W warna hitam lengkap dengan kabelnya.',
                'foto_barang' => $publishFoto('temuan-charger-laptop.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Powerbank Anker 10000mAh',
                'lokasi_ditemukan' => 'Tribun Lapangan Stadion UNEJ',
                'tanggal_ditemukan' => '2026-11-18',
                'deskripsi' => 'Powerbank tipis warna hitam doff dengan lampu indikator LED biru.',
                'foto_barang' => $publishFoto('temuan-powerbank.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Earphone TWS Putih',
                'lokasi_ditemukan' => 'Halte Double Way UNEJ',
                'tanggal_ditemukan' => '2026-11-17',
                'deskripsi' => 'TWS warna putih lengkap dengan charging case, ditemukan di bangku tunggu.',
                'foto_barang' => $publishFoto('temuan-tws-putih.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Mouse Wireless Logitech',
                'lokasi_ditemukan' => 'Lab Jaringan Komputer FASILKOM',
                'tanggal_ditemukan' => '2026-11-17',
                'deskripsi' => 'Mouse wireless warna abu-abu gelap, dongle USB masih terpasang di dalamnya.',
                'foto_barang' => $publishFoto('temuan-mouse-wireless.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Dokumen & Kartu (KTM/KTP/SIM)'),
                'nama_barang' => 'Kartu KTM UNEJ & Lanyard',
                'lokasi_ditemukan' => 'Depan ATM Center Kampus Tegal Boto',
                'tanggal_ditemukan' => '2026-11-16',
                'deskripsi' => 'Card holder plastik berisi KTM UNEJ dengan tali lanyard warna merah marun.',
                'foto_barang' => $publishFoto('temuan-ktm-lanyard.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Kunci & Aksesori'),
                'nama_barang' => 'Jam Tangan Casio Digital',
                'lokasi_ditemukan' => 'Tempat Wudhu Masjid Al-Hikmah UNEJ',
                'tanggal_ditemukan' => '2026-11-16',
                'deskripsi' => 'Jam tangan digital strap rantai silver tertinggal di pinggir tembok tempat wudhu.',
                'foto_barang' => $publishFoto('temuan-jam-casio.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Lainnya'),
                'nama_barang' => 'Payung Lipat Navy',
                'lokasi_ditemukan' => 'Selasar Gedung FKIP UNEJ',
                'tanggal_ditemukan' => '2026-11-15',
                'deskripsi' => 'Payung lipat otomatis warna biru navy lengkap dengan sarungnya.',
                'foto_barang' => $publishFoto('temuan-payung-lipat.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Lainnya'),
                'nama_barang' => 'Helm Half Face Hitam Doff',
                'lokasi_ditemukan' => 'Parkiran Gedung Rektorat UNEJ',
                'tanggal_ditemukan' => '2026-11-15',
                'deskripsi' => 'Helm half face hitam doff kaca bening, ditemukan terjatuh di dekat pembatas motor.',
                'foto_barang' => $publishFoto('temuan-helm-hitam.jpg', 'barang_temuan'),
                'status' => 'tersedia',
            ],
            [
                'kategori_id' => $katBy('Alat Tulis & Buku'),
                'nama_barang' => 'Tempat Pensil Kanvas Abu',
                'lokasi_ditemukan' => 'Ruang Seminar Gedung A FEB UNEJ',
                'tanggal_ditemukan' => '2026-11-14',
                'deskripsi' => 'Tempat pensil bahan kanvas abu-abu berisi pulpen, stabilo kuning, dan penggaris.',
                'foto_barang' => $publishFoto('temuan-tempat-pensil.jpg', 'barang_temuan'),
                'status' => 'dikembalikan',
            ],
            [
                'kategori_id' => $katBy('Alat Tulis & Buku'),
                'nama_barang' => 'Buku Catatan Spiral A5',
                'lokasi_ditemukan' => 'Gazebo Fakultas Pertanian UNEJ',
                'tanggal_ditemukan' => '2026-11-13',
                'deskripsi' => 'Buku catatan spiral sampul coklat polos berisi catatan mata kuliah semester ganjil.',
                'foto_barang' => $publishFoto('temuan-buku-catatan.jpg', 'barang_temuan'),
                'status' => 'dikembalikan',
            ],
            [
                'kategori_id' => $katBy('Dokumen & Kartu (KTM/KTP/SIM)'),
                'nama_barang' => 'Card Holder Kulit Hitam',
                'lokasi_ditemukan' => 'Kantin Fakultas Teknik UNEJ',
                'tanggal_ditemukan' => '2026-11-12',
                'deskripsi' => 'Card holder kulit sintetis hitam berisi kartu parkir dan beberapa kartu member.',
                'foto_barang' => $publishFoto('temuan-card-holder.jpg', 'barang_temuan'),
                'status' => 'dikembalikan',
            ],
            [
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Kabel Data USB-C Braided',
                'lokasi_ditemukan' => 'Lobby Gedung Auditorium UNEJ',
                'tanggal_ditemukan' => '2026-11-11',
                'deskripsi' => 'Kabel USB-C to USB-C bahan braided warna hitam panjang sekitar 1 meter.',
                'foto_barang' => $publishFoto('temuan-kabel-usbc.jpg', 'barang_temuan'),
                'status' => 'dikembalikan',
            ],
            [
                'kategori_id' => $katBy('Dompet & Tas'),
                'nama_barang' => 'Tote Bag Kanvas Cream',
                'lokasi_ditemukan' => 'Taman Double Way Kampus Tegal Boto',
                'tanggal_ditemukan' => '2026-11-10',
                'deskripsi' => 'Tote bag kanvas warna cream polos berisi map plastik bening.',
                'foto_barang' => $publishFoto('temuan-totebag-kanvas.jpg', 'barang_temuan'),
                'status' => 'dikembalikan',
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