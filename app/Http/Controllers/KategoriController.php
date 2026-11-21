<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::withCount(['barangTemuan', 'laporanKehilangan'])
            ->orderBy('nama_kategori')
            ->get();

        return view('petugas.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('petugas.kategori.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:100', 'unique:kategori,nama_kategori'],
        ]);

        Kategori::create($validated);

        return redirect()->route('petugas.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
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
    public function edit(Kategori $kategori)
    {
        return view('petugas.kategori.form', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:100', 'unique:kategori,nama_kategori,' . $kategori->id],
        ]);

        $kategori->update($validated);

        return redirect()->route('petugas.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        if ($kategori->barangTemuan()->exists() || $kategori->laporanKehilangan()->exists()) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan.');
        }

        $kategori->delete();

        return redirect()->route('petugas.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}