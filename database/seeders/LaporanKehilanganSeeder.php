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
        $kategoriMap = Kategori::pluck('id', 'nama_kategori');
        $penggunaIds = User::where('role', 'mahasiswa')->pluck('id')->values();
        if ($penggunaIds->isEmpty()) {
            $penggunaIds = User::pluck('id')->values();
        }

        $katBy = fn(string $nama) => $kategoriMap[$nama] ?? $kategoriMap->first() ?? 1;
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
                'kategori_id' => $katBy('Dompet & Tas'),
                'nama_barang' => 'Dompet Lipat Kulit Hitam',
                'lokasi_hilang' => 'Kantin Pusat Kampus Tegal Boto UNEJ',
                'tanggal_hilang' => '2026-11-22',
                'deskripsi' => 'Dompet kulit hitam polos, di dalamnya ada KTP, KTM, dan STNK motor.',
                'foto_barang' => $publishFoto('hilang-dompet-hitam.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(1),
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'TWS Hitam Matte',
                'lokasi_hilang' => 'Perpustakaan Pusat Lantai 1 UNEJ',
                'tanggal_hilang' => '2026-11-22',
                'deskripsi' => 'TWS hitam matte dalam case, ada stiker kecil huruf N di bagian tutupnya.',
                'foto_barang' => $publishFoto('hilang-tws-hitam.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(2),
                'kategori_id' => $katBy('Kunci & Aksesori'),
                'nama_barang' => 'Kunci Kos Gantungan Kayu',
                'lokasi_hilang' => 'Parkiran FASILKOM UNEJ',
                'tanggal_hilang' => '2026-11-21',
                'deskripsi' => 'Dua buah anak kunci kamar kos dengan gantungan kayu ukiran nama.',
                'foto_barang' => $publishFoto('hilang-kunci-kos.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(3),
                'kategori_id' => $katBy('Kunci & Aksesori'),
                'nama_barang' => 'Kacamata Frame Transparan',
                'lokasi_hilang' => 'Gedung Kuliah Bersama UNEJ',
                'tanggal_hilang' => '2026-11-21',
                'deskripsi' => 'Kacamata minus frame bening transparan, kemungkinan jatuh dari saku tas.',
                'foto_barang' => $publishFoto('hilang-kacamata-bening.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(4),
                'kategori_id' => $katBy('Lainnya'),
                'nama_barang' => 'Botol Minum Hijau Sage',
                'lokasi_hilang' => 'Lapangan Basket Kampus Tegal Boto',
                'tanggal_hilang' => '2026-11-20',
                'deskripsi' => 'Tumbler warna hijau sage kapasitas 600ml, tutup ulir warna hitam.',
                'foto_barang' => $publishFoto('hilang-tumbler-sage.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(5),
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Adapter Charger HP Putih',
                'lokasi_hilang' => 'Ruang Baca Fakultas Hukum UNEJ',
                'tanggal_hilang' => '2026-11-20',
                'deskripsi' => 'Kepala charger fast charging 33W warna putih tertinggal di stopkontak.',
                'foto_barang' => $publishFoto('hilang-charger-hp.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(6),
                'kategori_id' => $katBy('Lainnya'),
                'nama_barang' => 'Jaket Denim Biru Tua',
                'lokasi_hilang' => 'Auditorium Universitas Jember',
                'tanggal_hilang' => '2026-11-19',
                'deskripsi' => 'Jaket jeans warna biru tua ukuran XL, tertinggal di kursi baris tengah.',
                'foto_barang' => $publishFoto('hilang-jaket-denim.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(7),
                'kategori_id' => $katBy('Kunci & Aksesori'),
                'nama_barang' => 'Jam Tangan Kulit Coklat',
                'lokasi_hilang' => 'Mushola Fakultas Ekonomi dan Bisnis',
                'tanggal_hilang' => '2026-11-19',
                'deskripsi' => 'Jam tangan analog dial putih dengan tali kulit warna coklat muda.',
                'foto_barang' => $publishFoto('hilang-jam-kulit.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(8),
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Harddisk Eksternal 1TB',
                'lokasi_hilang' => 'Lab Pemrograman FASILKOM UNEJ',
                'tanggal_hilang' => '2026-11-18',
                'deskripsi' => 'HDD eksternal Seagate 1TB warna hitam di dalam pouch resleting abu-abu.',
                'foto_barang' => $publishFoto('hilang-hdd.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(9),
                'kategori_id' => $katBy('Kunci & Aksesori'),
                'nama_barang' => 'Kunci Motor Yamaha Vario',
                'lokasi_hilang' => 'Area Parkir Masjid Al-Hikmah UNEJ',
                'tanggal_hilang' => '2026-11-18',
                'deskripsi' => 'Kunci motor dengan remote hitam dan gantungan tali paracord hijau.',
                'foto_barang' => $publishFoto('hilang-kunci-yamaha.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(10),
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'USB Hub Type-C 6-in-1',
                'lokasi_hilang' => 'Ruang Diskusi Perpustakaan UNEJ',
                'tanggal_hilang' => '2026-11-17',
                'deskripsi' => 'USB Hub bahan aluminium warna silver merk Ugreen, ada port HDMI dan LAN.',
                'foto_barang' => $publishFoto('hilang-usbhub.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(11),
                'kategori_id' => $katBy('Dompet & Tas'),
                'nama_barang' => 'Pouch Kosmetik Kecil',
                'lokasi_hilang' => 'Toilet Gedung Fakultas Farmasi UNEJ',
                'tanggal_hilang' => '2026-11-17',
                'deskripsi' => 'Pouch resleting warna krem berisi lip balm, cermin kecil, dan tisu.',
                'foto_barang' => $publishFoto('hilang-pouch.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(12),
                'kategori_id' => $katBy('Alat Tulis & Buku'),
                'nama_barang' => 'Buku Algoritma & Struktur Data',
                'lokasi_hilang' => 'Gazebo Depan FASILKOM UNEJ',
                'tanggal_hilang' => '2026-11-16',
                'deskripsi' => 'Buku teks sampul biru putih, di halaman depan ada tulisan nama pemilik.',
                'foto_barang' => $publishFoto('hilang-buku-kuliah.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(13),
                'kategori_id' => $katBy('Kunci & Aksesori'),
                'nama_barang' => 'Topi Baseball Hitam Polos',
                'lokasi_hilang' => 'Sepanjang Jalan Kalimantan Kampus',
                'tanggal_hilang' => '2026-11-16',
                'deskripsi' => 'Topi baseball warna hitam polos bahan katun dengan pengait besi di belakang.',
                'foto_barang' => $publishFoto('hilang-topi-hitam.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(14),
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Stylus Pen Tablet Putih',
                'lokasi_hilang' => 'Ruang Kelas 204 Gedung FKIP UNEJ',
                'tanggal_hilang' => '2026-11-15',
                'deskripsi' => 'Stylus pen magnetik warna putih untuk iPad/tablet, ujung nib baru diganti.',
                'foto_barang' => $publishFoto('hilang-stylus.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(15),
                'kategori_id' => $katBy('Dokumen & Kartu (KTM/KTP/SIM)'),
                'nama_barang' => 'Card Holder Biru Dongker',
                'lokasi_hilang' => 'Koperasi Mahasiswa UNEJ',
                'tanggal_hilang' => '2026-11-14',
                'deskripsi' => 'Card holder tipis warna navy berisi kartu ATM dan kartu e-money.',
                'foto_barang' => $publishFoto('hilang-cardholder-navy.webp', 'laporan_kehilangan'),
                'status' => 'dicari',
            ],
            [
                'pengguna_id' => $userAt(16),
                'kategori_id' => $katBy('Lainnya'),
                'nama_barang' => 'Jas Hujan Lipat Pouch',
                'lokasi_hilang' => 'Parkiran Fakultas Teknik UNEJ',
                'tanggal_hilang' => '2026-11-13',
                'deskripsi' => 'Jas hujan setelan warna hitam terlipat di dalam tas serut kecil.',
                'foto_barang' => $publishFoto('hilang-jashujan.webp', 'laporan_kehilangan'),
                'status' => 'ditemukan',
            ],
            [
                'pengguna_id' => $userAt(17),
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Flashdisk Metal 64GB',
                'lokasi_hilang' => 'Lab Komputer Fakultas Ekonomi UNEJ',
                'tanggal_hilang' => '2026-11-12',
                'deskripsi' => 'Flashdisk bodi besi warna silver merk Kingston 64GB berisi file tugas akhir.',
                'foto_barang' => $publishFoto('hilang-flashdisk-metal.webp', 'laporan_kehilangan'),
                'status' => 'ditemukan',
            ],
            [
                'pengguna_id' => $userAt(18),
                'kategori_id' => $katBy('Kunci & Aksesori'),
                'nama_barang' => 'Kacamata Hitam Polarized',
                'lokasi_hilang' => 'Taman Fakultas Kedokteran Gigi UNEJ',
                'tanggal_hilang' => '2026-11-11',
                'deskripsi' => 'Sunglasses frame hitam doff dengan lensa gelap, jatuh saat istirahat siang.',
                'foto_barang' => $publishFoto('hilang-sunglasses.webp', 'laporan_kehilangan'),
                'status' => 'ditemukan',
            ],
            [
                'pengguna_id' => $userAt(19),
                'kategori_id' => $katBy('Elektronik'),
                'nama_barang' => 'Headset Kabel Lipat',
                'lokasi_hilang' => 'Studio Mini FISIP UNEJ',
                'tanggal_hilang' => '2026-11-10',
                'deskripsi' => 'Headset over-ear warna hitam merk Sony, kabel jack 3.5mm bentuk L.',
                'foto_barang' => $publishFoto('hilang-headset.webp', 'laporan_kehilangan'),
                'status' => 'ditemukan',
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