<?php

namespace Database\Seeders;

use App\Models\BarangTemuan;
use App\Models\Klaim;
use App\Models\User;
use Illuminate\Database\Seeder;

class KlaimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $temuanIds = BarangTemuan::orderBy('id')->pluck('id')->values();
        $penggunaIds = User::where('role', 'mahasiswa')->orderBy('id')->pluck('id')->values();

        if ($temuanIds->count() < 19 || $penggunaIds->count() < 10) {
            return;
        }

        $items = [
            [
                'barang_temuan_id' => $temuanIds[0],
                'pengguna_id' => $penggunaIds[0],
                'keterangan_klaim' => 'Di dalam dompet ada KTM atas nama Dimas Pratama Putra NIM 222410101001 dan struk parkir.',
                'status' => 'pending',
                'catatan_petugas' => null,
                'foto_serah_terima' => null,
                'tanggal_diambil' => null,
            ],
            [
                'barang_temuan_id' => $temuanIds[1],
                'pengguna_id' => $penggunaIds[1],
                'keterangan_klaim' => 'Di dalam flashdisk ada folder bernama Tugas_PBO_Nabila dan file presentasi mata kuliah.',
                'status' => 'pending',
                'catatan_petugas' => null,
                'foto_serah_terima' => null,
                'tanggal_diambil' => null,
            ],
            [
                'barang_temuan_id' => $temuanIds[2],
                'pengguna_id' => $penggunaIds[2],
                'keterangan_klaim' => 'Hoodie hitam ukuran L, bagian ujung tali sebelah kiri agak terurai dan ada jahitan kecil di saku kanan.',
                'status' => 'pending',
                'catatan_petugas' => null,
                'foto_serah_terima' => null,
                'tanggal_diambil' => null,
            ],
            [
                'barang_temuan_id' => $temuanIds[3],
                'pengguna_id' => $penggunaIds[3],
                'keterangan_klaim' => 'Kacamata minus 2.00 kiri-kanan, di dalam kotak kain abu-abu ada lap lensa warna biru muda.',
                'status' => 'pending',
                'catatan_petugas' => null,
                'foto_serah_terima' => null,
                'tanggal_diambil' => null,
            ],
            [
                'barang_temuan_id' => $temuanIds[4],
                'pengguna_id' => $penggunaIds[4],
                'keterangan_klaim' => 'Di bagian belakang tutup kalkulator ada inisial FR yang ditulis pakai spidol silver.',
                'status' => 'disetujui',
                'catatan_petugas' => 'Ciri cocok. Silakan ambil barang di Pos Keamanan Utama UNEJ dengan membawa KTM asli.',
                'foto_serah_terima' => null,
                'tanggal_diambil' => null,
            ],
            [
                'barang_temuan_id' => $temuanIds[5],
                'pengguna_id' => $penggunaIds[5],
                'keterangan_klaim' => 'Kunci motor Honda warna hitam dengan gantungan besi polos.',
                'status' => 'ditolak',
                'catatan_petugas' => 'Ciri gantungan tidak sesuai dengan barang yang diamankan petugas.',
                'foto_serah_terima' => null,
                'tanggal_diambil' => null,
            ],
            [
                'barang_temuan_id' => $temuanIds[15],
                'pengguna_id' => $penggunaIds[6],
                'keterangan_klaim' => 'Di dalam tempat pensil ada pulpen hitam, stabilo kuning, dan penggaris besi 15cm.',
                'status' => 'selesai',
                'catatan_petugas' => 'Barang telah diserahkan kepada pemilik setelah verifikasi KTM.',
                'foto_serah_terima' => null,
                'tanggal_diambil' => '2026-11-15 10:30:00',
            ],
            [
                'barang_temuan_id' => $temuanIds[16],
                'pengguna_id' => $penggunaIds[7],
                'keterangan_klaim' => 'Halaman pertama buku catatan spiral tertulis nama Intan Permata Sari kelas B.',
                'status' => 'selesai',
                'catatan_petugas' => 'Identitas sesuai, serah terima selesai di Pos Keamanan Utama.',
                'foto_serah_terima' => null,
                'tanggal_diambil' => '2026-11-14 14:15:00',
            ],
            [
                'barang_temuan_id' => $temuanIds[17],
                'pengguna_id' => $penggunaIds[8],
                'keterangan_klaim' => 'Card holder berisi kartu akses perpustakaan dan kartu member atas nama M. Iqbal Maulana.',
                'status' => 'selesai',
                'catatan_petugas' => 'Sudah diverifikasi dan diterima langsung oleh yang bersangkutan.',
                'foto_serah_terima' => null,
                'tanggal_diambil' => '2026-11-13 11:00:00',
            ],
            [
                'barang_temuan_id' => $temuanIds[18],
                'pengguna_id' => $penggunaIds[9],
                'keterangan_klaim' => 'Kabel USB-C braided hitam merk Baseus, ada pengikat velcro warna hitam di tengah kabel.',
                'status' => 'selesai',
                'catatan_petugas' => 'Barang cocok dan telah diambil pemilik di pos jaga.',
                'foto_serah_terima' => null,
                'tanggal_diambil' => '2026-11-12 15:45:00',
            ],
        ];

        foreach ($items as $item) {
            Klaim::firstOrCreate(
                [
                    'barang_temuan_id' => $item['barang_temuan_id'],
                    'pengguna_id' => $item['pengguna_id'],
                ],
                $item
            );
        }
    }
}