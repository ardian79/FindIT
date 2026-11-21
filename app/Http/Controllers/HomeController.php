<?php

namespace App\Http\Controllers;

use App\Models\BarangTemuan;
use App\Models\Kategori;
use App\Models\LaporanKehilangan;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'temuan');

        $temuanQuery = BarangTemuan::with('kategori')->where('status', 'tersedia');
        $hilangQuery = LaporanKehilangan::with(['kategori', 'pengguna'])->where('status', 'dicari');

        if ($request->filled('search')) {
            $search = $request->search;

            $temuanQuery->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('lokasi_ditemukan', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });

            $hilangQuery->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('lokasi_hilang', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori_id')) {
            $temuanQuery->where('kategori_id', $request->kategori_id);
            $hilangQuery->where('kategori_id', $request->kategori_id);
        }

        $barangTemuan = $temuanQuery->latest()->paginate(3, ['*'], 'page_temuan')->withQueryString();
        $laporanKehilangan = $hilangQuery->latest()->paginate(3, ['*'], 'page_hilang')->withQueryString();
        $kategori = Kategori::orderBy('nama_kategori')->get();
        $petugas = User::where('role', 'petugas')->first();

        $totalTersedia = BarangTemuan::where('status', 'tersedia')->count();
        $totalDikembalikan = BarangTemuan::where('status', 'dikembalikan')->count();
        $totalDicari = LaporanKehilangan::where('status', 'dicari')->count();

        return view('home', compact(
            'tab',
            'barangTemuan',
            'laporanKehilangan',
            'kategori',
            'petugas',
            'totalTersedia',
            'totalDikembalikan',
            'totalDicari'
        ));
    }
}