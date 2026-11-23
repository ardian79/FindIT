<?php

namespace App\Http\Controllers;

use App\Models\BarangTemuan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangTemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BarangTemuan::with('kategori');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('lokasi_ditemukan', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $barangTemuan = $query->latest()->get();
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('petugas.barang-temuan.index', compact('barangTemuan', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('petugas.barang-temuan.form', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategori,id'],
            'nama_barang' => ['required', 'string', 'max:255'],
            'lokasi_ditemukan' => ['required', 'string', 'max:150'],
            'tanggal_ditemukan' => ['required', 'date'],
            'deskripsi' => ['required', 'string'],
            'foto_barang' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $path = $request->file('foto_barang')->store('barang_temuan', 'public');

        BarangTemuan::create([
            'kategori_id' => $validated['kategori_id'],
            'nama_barang' => $validated['nama_barang'],
            'lokasi_ditemukan' => $validated['lokasi_ditemukan'],
            'tanggal_ditemukan' => $validated['tanggal_ditemukan'],
            'deskripsi' => $validated['deskripsi'],
            'foto_barang' => $path,
            'status' => 'tersedia',
        ]);

        return redirect()->route('petugas.barang-temuan.index')
            ->with('success', 'Barang temuan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangTemuan $barangTemuan)
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('petugas.barang-temuan.form', compact('barangTemuan', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangTemuan $barangTemuan)
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategori,id'],
            'nama_barang' => ['required', 'string', 'max:255'],
            'lokasi_ditemukan' => ['required', 'string', 'max:150'],
            'tanggal_ditemukan' => ['required', 'date'],
            'deskripsi' => ['required', 'string'],
            'status' => ['required', 'in:tersedia,diklaim,dikembalikan'],
            'foto_barang' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $data = [
            'kategori_id' => $validated['kategori_id'],
            'nama_barang' => $validated['nama_barang'],
            'lokasi_ditemukan' => $validated['lokasi_ditemukan'],
            'tanggal_ditemukan' => $validated['tanggal_ditemukan'],
            'deskripsi' => $validated['deskripsi'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('foto_barang')) {
            if ($barangTemuan->foto_barang) {
                Storage::disk('public')->delete($barangTemuan->foto_barang);
            }
            $data['foto_barang'] = $request->file('foto_barang')->store('barang_temuan', 'public');
        }

        $barangTemuan->update($data);

        return redirect()->route('petugas.barang-temuan.index')
            ->with('success', 'Data barang temuan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangTemuan $barangTemuan)
    {
        if ($barangTemuan->foto_barang) {
            Storage::disk('public')->delete($barangTemuan->foto_barang);
        }

        $barangTemuan->delete();

        return redirect()->route('petugas.barang-temuan.index')
            ->with('success', 'Data barang temuan berhasil dihapus.');
    }
}
