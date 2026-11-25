<?php

namespace App\Http\Controllers;

use App\Models\BarangTemuan;
use App\Models\Klaim;
use App\Models\LaporanKehilangan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $temuanCounts = BarangTemuan::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $totalTersedia = (int) ($temuanCounts['tersedia'] ?? 0);
        $totalDiklaim = (int) ($temuanCounts['diklaim'] ?? 0);
        $totalDikembalikan = (int) ($temuanCounts['dikembalikan'] ?? 0);
        $totalLaporanDicari = LaporanKehilangan::where('status', 'dicari')->count();
        $totalKlaimPending = Klaim::where('status', 'pending')->count();
        $totalMahasiswaAktif = User::where('role', 'mahasiswa')->where('is_active', true)->count();

        $klaimTerbaru = Klaim::with(['barangTemuan', 'pengguna'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $laporanTerbaru = LaporanKehilangan::with(['kategori', 'pengguna'])
            ->where('status', 'dicari')
            ->latest()
            ->take(5)
            ->get();

        return view('petugas.dashboard', compact(
            'totalTersedia',
            'totalDiklaim',
            'totalDikembalikan',
            'totalLaporanDicari',
            'totalKlaimPending',
            'totalMahasiswaAktif',
            'klaimTerbaru',
            'laporanTerbaru'
        ));
    }
}