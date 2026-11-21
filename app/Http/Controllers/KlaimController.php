<?php

namespace App\Http\Controllers;

use App\Models\BarangTemuan;
use App\Models\Klaim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlaimController extends Controller
{
    public function indexMahasiswa()
    {
        $klaim = Klaim::with(['barangTemuan.kategori'])
            ->where('pengguna_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('mahasiswa.klaim', compact('klaim'));
    }

    public function store(Request $request, BarangTemuan $barangTemuan)
    {
        if ($barangTemuan->status !== 'tersedia') {
            return back()->with('error', 'Barang ini sudah tidak tersedia untuk diklaim.');
        }

        $sudahKlaim = Klaim::where('barang_temuan_id', $barangTemuan->id)
            ->where('pengguna_id', Auth::id())
            ->whereIn('status', ['pending', 'disetujui'])
            ->exists();

        if ($sudahKlaim) {
            return back()->with('error', 'Anda sudah mengajukan klaim untuk barang ini.');
        }

        $validated = $request->validate([
            'keterangan_klaim' => ['required', 'string'],
        ]);

        Klaim::create([
            'barang_temuan_id' => $barangTemuan->id,
            'pengguna_id' => Auth::id(),
            'keterangan_klaim' => $validated['keterangan_klaim'],
            'status' => 'pending',
        ]);

        return redirect()->route('mahasiswa.klaim.index')
            ->with('success', 'Pengajuan klaim berhasil dikirim. Silakan tunggu verifikasi petugas.');
    }

    public function indexPetugas(Request $request)
    {
        $query = Klaim::with(['barangTemuan.kategori', 'pengguna']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('barangTemuan', function ($b) use ($search) {
                    $b->where('nama_barang', 'like', "%{$search}%");
                })->orWhereHas('pengguna', function ($u) use ($search) {
                    $u->where('nama', 'like', "%{$search}%")
                      ->orWhere('nim', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $klaim = $query->latest()->paginate(10)->withQueryString();

        return view('petugas.verifikasi-klaim.index', compact('klaim'));
    }

    public function show(Klaim $klaim)
    {
        $klaim->load(['barangTemuan.kategori', 'pengguna']);

        return view('petugas.verifikasi-klaim.show', compact('klaim'));
    }

    public function setujui(Request $request, Klaim $klaim)
    {
        if ($klaim->status !== 'pending') {
            return back()->with('error', 'Hanya klaim berstatus pending yang dapat disetujui.');
        }

        $validated = $request->validate([
            'catatan_petugas' => ['nullable', 'string'],
        ]);

        $klaim->update([
            'status' => 'disetujui',
            'catatan_petugas' => $validated['catatan_petugas'] ?? null,
        ]);

        $klaim->barangTemuan->update(['status' => 'diklaim']);

        Klaim::where('barang_temuan_id', $klaim->barang_temuan_id)
            ->where('id', '!=', $klaim->id)
            ->where('status', 'pending')
            ->update([
                'status' => 'ditolak',
                'catatan_petugas' => 'Barang telah disetujui untuk pengklaim lain.',
            ]);

        return back()->with('success', 'Klaim berhasil disetujui. Silakan hubungi mahasiswa untuk pengambilan di Pos.');
    }

    public function tolak(Request $request, Klaim $klaim)
    {
        if (!in_array($klaim->status, ['pending', 'disetujui'])) {
            return back()->with('error', 'Status klaim ini tidak dapat ditolak.');
        }

        $validated = $request->validate([
            'catatan_petugas' => ['required', 'string'],
        ]);

        if ($klaim->status === 'disetujui') {
            $klaim->barangTemuan->update(['status' => 'tersedia']);
        }

        $klaim->update([
            'status' => 'ditolak',
            'catatan_petugas' => $validated['catatan_petugas'],
        ]);

        return back()->with('success', 'Klaim telah ditolak.');
    }

    public function selesai(Request $request, Klaim $klaim)
    {
        if ($klaim->status !== 'disetujui') {
            return back()->with('error', 'Hanya klaim yang sudah disetujui yang dapat diselesaikan.');
        }

        $validated = $request->validate([
            'foto_serah_terima' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'catatan_petugas' => ['nullable', 'string'],
        ]);

        $path = $request->file('foto_serah_terima')->store('serah_terima', 'public');

        $klaim->update([
            'status' => 'selesai',
            'foto_serah_terima' => $path,
            'tanggal_diambil' => now(),
            'catatan_petugas' => $validated['catatan_petugas'] ?? $klaim->catatan_petugas,
        ]);

        $klaim->barangTemuan->update(['status' => 'dikembalikan']);

        return back()->with('success', 'Serah terima barang berhasil dicatat dan klaim selesai.');
    }
}