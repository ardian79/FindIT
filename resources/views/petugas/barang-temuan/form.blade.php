@extends('layouts.dashboard')

@section('title', isset($barangTemuan) ? 'Edit Barang Temuan' : 'Tambah Barang Temuan')

@section('header', isset($barangTemuan) ? 'Edit Barang Temuan' : 'Tambah Barang Temuan')

@section('content')
    <div class="mx-auto max-w-3xl">
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-base font-bold text-slate-900">
                    {{ isset($barangTemuan) ? 'Perbarui Data Barang Temuan' : 'Input Barang Temuan Baru' }}
                </h2>
                <p class="mt-0.5 text-xs text-slate-500">Barang temuan otomatis tercatat berada di Pos Keamanan Utama UNEJ.</p>
            </div>

            <form action="{{ isset($barangTemuan) ? route('petugas.barang-temuan.update', $barangTemuan) : route('petugas.barang-temuan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 p-6">
                @csrf
                @if (isset($barangTemuan))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="nama_barang" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barangTemuan->nama_barang ?? '') }}" required autofocus placeholder="Contoh: Kunci Motor Honda Gantungan Biru" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                    </div>

                    <div>
                        <label for="kategori_id" class="mb-1.5 block text-sm font-medium text-slate-700">Kategori</label>
                        <select id="kategori_id" name="kategori_id" required class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id', $barangTemuan->kategori_id ?? '') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tanggal_ditemukan" class="mb-1.5 block text-sm font-medium text-slate-700">Tanggal Ditemukan</label>
                        <input type="date" id="tanggal_ditemukan" name="tanggal_ditemukan" value="{{ old('tanggal_ditemukan', isset($barangTemuan) ?$barangTemuan->tanggal_ditemukan->format('Y-m-d') : date('Y-m-d')) }}" required max="{{ date('Y-m-d') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                    </div>

                    <div class="{{ isset($barangTemuan) ? '' : 'sm:col-span-2' }}">
                        <label for="lokasi_ditemukan" class="mb-1.5 block text-sm font-medium text-slate-700">Lokasi Ditemukan</label>
                        <input type="text" id="lokasi_ditemukan" name="lokasi_ditemukan" value="{{ old('lokasi_ditemukan', $barangTemuan->lokasi_ditemukan ?? '') }}" required placeholder="Contoh: Ruang Baca Perpustakaan Pusat" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                    </div>

                    @if (isset($barangTemuan))
                        <div>
                            <label for="status" class="mb-1.5 block text-sm font-medium text-slate-700">Status Barang</label>
                            <select id="status" name="status" required class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                                <option value="tersedia" {{ old('status', $barangTemuan->status) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="diklaim" {{ old('status', $barangTemuan->status) === 'diklaim' ? 'selected' : '' }}>Diklaim</option>
                                <option value="dikembalikan" {{ old('status', $barangTemuan->status) === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                            </select>
                        </div>
                    @endif
                </div>

                <div>
                    <label for="deskripsi" class="mb-1.5 block text-sm font-medium text-slate-700">Deskripsi Barang</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required placeholder="Tuliskan ciri umum barang tanpa membocorkan detail rahasia untuk keperluan verifikasi pemilik..." class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">{{ old('deskripsi', $barangTemuan->deskripsi ?? '') }}</textarea>
                </div>

                <div>
                    <label for="foto_barang" class="mb-1.5 block text-sm font-medium text-slate-700">
                        Foto Barang {{ isset($barangTemuan) ? '(Opsional jika tidak diganti)' : '' }}
                    </label>
                    @if (isset($barangTemuan) &&$barangTemuan->foto_barang)
                        <div class="mb-3 flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 p-3">
                            <img src="{{ asset('storage/' . $barangTemuan->foto_barang) }}" alt="{{ $barangTemuan->nama_barang }}" class="h-16 w-16 rounded-lg object-cover">
                            <div class="text-xs text-slate-600">
                                <p class="font-semibold text-slate-800">Foto saat ini</p>
                                <p>Pilih file baru di bawah jika ingin mengganti foto.</p>
                            </div>
                        </div>
                    @endif
                    <input type="file" id="foto_barang" name="foto_barang" accept=".jpg,.jpeg,.png,.webp" {{ isset($barangTemuan) ? '' : 'required' }} class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="mt-1 text-xs text-slate-500">Format JPG, PNG, atau WEBP maksimal 2MB.</p>
                </div>

                <div class="flex items-center justify-end gap-2 border-t border-slate-200 pt-4">
                    <a href="{{ route('petugas.barang-temuan.index') }}" class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                        {{ isset($barangTemuan) ? 'Simpan Perubahan' : 'Simpan Barang Temuan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection