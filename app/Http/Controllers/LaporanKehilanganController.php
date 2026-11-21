<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\LaporanKehilangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanKehilanganController extends Controller
{
    public function indexMahasiswa()
    {
        $laporan = LaporanKehilangan::with('kategori')
            ->where('pengguna_id', Auth::id())
            ->latest()
            ->paginate(10);

        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('mahasiswa.laporan', compact('laporan', 'kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategori,id'],
            'nama_barang' => ['required', 'string', 'max:255'],
            'lokasi_hilang' => ['required', 'string', 'max:150'],
            'tanggal_hilang' => ['required', 'date'],
            'deskripsi' => ['required', 'string'],
            'foto_barang' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $path = null;
        if ($request->hasFile('foto_barang')) {
            $path = $request->file('foto_barang')->store('laporan_kehilangan', 'public');
        }

        LaporanKehilangan::create([
            'pengguna_id' => Auth::id(),
            'kategori_id' => $validated['kategori_id'],
            'nama_barang' => $validated['nama_barang'],
            'lokasi_hilang' => $validated['lokasi_hilang'],
            'tanggal_hilang' => $validated['tanggal_hilang'],
            'deskripsi' => $validated['deskripsi'],
            'foto_barang' => $path,
            'status' => 'dicari',
        ]);

        return redirect()->route('mahasiswa.laporan.index')
            ->with('success', 'Laporan kehilangan berhasil dibuat.');
    }

    public function update(Request $request, LaporanKehilangan $laporanKehilangan)
    {
        if ($laporanKehilangan->pengguna_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategori,id'],
            'nama_barang' => ['required', 'string', 'max:255'],
            'lokasi_hilang' => ['required', 'string', 'max:150'],
            'tanggal_hilang' => ['required', 'date'],
            'deskripsi' => ['required', 'string'],
            'foto_barang' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data = [
            'kategori_id' => $validated['kategori_id'],
            'nama_barang' => $validated['nama_barang'],
            'lokasi_hilang' => $validated['lokasi_hilang'],
            'tanggal_hilang' => $validated['tanggal_hilang'],
            'deskripsi' => $validated['deskripsi'],
        ];

        if ($request->hasFile('foto_barang')) {
            if ($laporanKehilangan->foto_barang) {
                Storage::disk('public')->delete($laporanKehilangan->foto_barang);
            }
            $data['foto_barang'] = $request->file('foto_barang')->store('laporan_kehilangan', 'public');
        }

        $laporanKehilangan->update($data);

        return redirect()->route('mahasiswa.laporan.index')
            ->with('success', 'Laporan kehilangan berhasil diperbarui.');
    }

    public function tandaiDitemukan(LaporanKehilangan $laporanKehilangan)
    {
        if ($laporanKehilangan->pengguna_id !== Auth::id()) {
            abort(403);
        }

        $laporanKehilangan->update(['status' => 'ditemukan']);

        return redirect()->route('mahasiswa.laporan.index')
            ->with('success', 'Status laporan diperbarui menjadi ditemukan.');
    }

    public function destroyMahasiswa(LaporanKehilangan $laporanKehilangan)
    {
        if ($laporanKehilangan->pengguna_id !== Auth::id()) {
            abort(403);
        }

        if ($laporanKehilangan->foto_barang) {
            Storage::disk('public')->delete($laporanKehilangan->foto_barang);
        }

        $laporanKehilangan->delete();

        return redirect()->route('mahasiswa.laporan.index')
            ->with('success', 'Laporan kehilangan berhasil dihapus.');
    }

    public function indexPetugas(Request $request)
    {
        $query = LaporanKehilangan::with(['kategori', 'pengguna']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('lokasi_hilang', 'like', "%{$search}%")
                    ->orWhereHas('pengguna', function ($u) use ($search) {
                        $u->where('nama', 'like', "%{$search}%")
                            ->orWhere('nim', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $laporan = $query->latest()->paginate(10)->withQueryString();
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('petugas.laporan-kehilangan.index', compact('laporan', 'kategori'));
    }

    public function updateStatus(Request $request, LaporanKehilangan $laporanKehilangan)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:dicari,ditemukan'],
        ]);

        $laporanKehilangan->update(['status' => $validated['status']]);

        return back()->with('success', 'Status laporan kehilangan berhasil diperbarui.');
    }

    public function destroyPetugas(LaporanKehilangan $laporanKehilangan)
    {
        if ($laporanKehilangan->foto_barang) {
            Storage::disk('public')->delete($laporanKehilangan->foto_barang);
        }

        $laporanKehilangan->delete();

        return back()->with('success', 'Laporan kehilangan berhasil dihapus.');
    }
}
