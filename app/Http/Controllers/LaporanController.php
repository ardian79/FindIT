<?php

namespace App\Http\Controllers;

use App\Models\BarangTemuan;
use App\Models\Klaim;
use App\Models\LaporanKehilangan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->get('jenis', 'barang_temuan');
        $tanggalMulai = $request->get('tanggal_mulai');
        $tanggalSelesai = $request->get('tanggal_selesai');
        $status = $request->get('status');

        if ($jenis === 'laporan_kehilangan') {
            $query = LaporanKehilangan::with(['kategori', 'pengguna']);

            if ($tanggalMulai) {
                $query->where('tanggal_hilang', '>=', $tanggalMulai);
            }
            if ($tanggalSelesai) {
                $query->where('tanggal_hilang', '<=', $tanggalSelesai);
            }
            if ($status) {
                $query->where('status', $status);
            }

            $data = $query->latest('tanggal_hilang')->get();
        } elseif ($jenis === 'klaim') {
            $query = Klaim::with(['barangTemuan.kategori', 'pengguna']);

            if ($tanggalMulai) {
                $query->where('created_at', '>=', $tanggalMulai . ' 00:00:00');
            }
            if ($tanggalSelesai) {
                $query->where('created_at', '<=', $tanggalSelesai . ' 23:59:59');
            }
            if ($status) {
                $query->where('status', $status);
            }

            $data = $query->latest()->get();
        } else {
            $jenis = 'barang_temuan';
            $query = BarangTemuan::with('kategori');

            if ($tanggalMulai) {
                $query->where('tanggal_ditemukan', '>=', $tanggalMulai);
            }
            if ($tanggalSelesai) {
                $query->where('tanggal_ditemukan', '<=', $tanggalSelesai);
            }
            if ($status) {
                $query->where('status', $status);
            }

            $data = $query->latest('tanggal_ditemukan')->get();
        }

        $temuanCounts = BarangTemuan::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $ringkasan = [
            'total_temuan' => (int) $temuanCounts->sum(),
            'total_tersedia' => (int) ($temuanCounts['tersedia'] ?? 0),
            'total_dikembalikan' => (int) ($temuanCounts['dikembalikan'] ?? 0),
            'total_hilang' => LaporanKehilangan::count(),
            'total_klaim_selesai' => Klaim::where('status', 'selesai')->count(),
        ];

        return view('petugas.laporan.index', compact(
            'jenis',
            'tanggalMulai',
            'tanggalSelesai',
            'status',
            'data',
            'ringkasan'
        ));
    }
}