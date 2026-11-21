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
        $totalTersedia = BarangTemuan::where('status', 'tersedia')->count();
        $totalDiklaim = BarangTemuan::where('status', 'diklaim')->count();
        $totalDikembalikan = BarangTemuan::where('status', 'dikembalikan')->count();
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