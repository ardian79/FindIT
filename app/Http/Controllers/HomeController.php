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
        $isHilang = $tab === 'hilang';
        $isHtmx = $request->hasHeader('HX-Request');
        $isResultsOnly = $request->header('HX-Target') === 'catalog-results';

        $barangTemuan = collect();
        $laporanKehilangan = collect();

        if ($isHilang) {
            $hilangQuery = LaporanKehilangan::with(['kategori', 'pengguna'])->where('status', 'dicari');

            if ($request->filled('search')) {
                $search = $request->search;
                $hilangQuery->where(function ($q) use ($search) {
                    $q->where('nama_barang', 'like', "%{$search}%")
                        ->orWhere('lokasi_hilang', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            }

            if ($request->filled('kategori_id')) {
                $hilangQuery->where('kategori_id', $request->kategori_id);
            }

            $laporanKehilangan = $hilangQuery->latest()->paginate(3, ['*'], 'page_hilang')->withQueryString();
        } else {
            $temuanQuery = BarangTemuan::with('kategori')->where('status', 'tersedia');

            if ($request->filled('search')) {
                $search = $request->search;
                $temuanQuery->where(function ($q) use ($search) {
                    $q->where('nama_barang', 'like', "%{$search}%")
                        ->orWhere('lokasi_ditemukan', 'like', "%{$search}%")
                        ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            }

            if ($request->filled('kategori_id')) {
                $temuanQuery->where('kategori_id', $request->kategori_id);
            }

            $barangTemuan = $temuanQuery->latest()->paginate(3, ['*'], 'page_temuan')->withQueryString();
        }

        $kategori = $isResultsOnly ? collect() : Kategori::orderBy('nama_kategori')->get();
        $petugas = $isHtmx ? null : User::where('role', 'petugas')->first(['no_hp']);

        return view('home', compact(
            'tab',
            'barangTemuan',
            'laporanKehilangan',
            'kategori',
            'petugas'
        ));
    }
}