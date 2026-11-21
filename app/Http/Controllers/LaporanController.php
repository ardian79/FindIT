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
                $query->whereDate('tanggal_hilang', '>=', $tanggalMulai);
            }
            if ($tanggalSelesai) {
                $query->whereDate('tanggal_hilang', '<=', $tanggalSelesai);
            }
            if ($status) {
                $query->where('status', $status);
            }

            $data = $query->latest('tanggal_hilang')->get();
        } elseif ($jenis === 'klaim') {
            $query = Klaim::with(['barangTemuan.kategori', 'pengguna']);

            if ($tanggalMulai) {
                $query->whereDate('created_at', '>=', $tanggalMulai);
            }
            if ($tanggalSelesai) {
                $query->whereDate('created_at', '<=', $tanggalSelesai);
            }
            if ($status) {
                $query->where('status', $status);
            }

            $data = $query->latest()->get();
        } else {
            $jenis = 'barang_temuan';
            $query = BarangTemuan::with('kategori');

            if ($tanggalMulai) {
                $query->whereDate('tanggal_ditemukan', '>=', $tanggalMulai);
            }
            if ($tanggalSelesai) {
                $query->whereDate('tanggal_ditemukan', '<=', $tanggalSelesai);
            }
            if ($status) {
                $query->where('status', $status);
            }

            $data = $query->latest('tanggal_ditemukan')->get();
        }

        $ringkasan = [
            'total_temuan' => BarangTemuan::count(),
            'total_tersedia' => BarangTemuan::where('status', 'tersedia')->count(),
            'total_dikembalikan' => BarangTemuan::where('status', 'dikembalikan')->count(),
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