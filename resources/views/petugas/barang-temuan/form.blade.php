@extends('layouts.dashboard')

@php
    $isEdit = isset($barangTemuan);
@endphp

@section('title', $isEdit ? 'Edit Barang Temuan' : 'Tambah Barang Temuan')
@section('header', $isEdit ? 'Edit Barang Temuan' : 'Tambah Barang Temuan')

@section('content')
    @php
        $label = 'mb-1.5 block text-sm font-medium text-ink';
        $input = 'w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10';
    @endphp

    <div class="mx-auto max-w-3xl">
        <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
            <div class="border-b border-[#e7ebf2] px-6 py-4">
                <h2 class="text-base font-semibold text-ink">{{ $isEdit ? 'Perbarui Data Barang Temuan' : 'Input Barang Temuan Baru' }}</h2>
                <p class="mt-0.5 text-xs text-ink-muted">Barang temuan otomatis tercatat berada di Pos Keamanan Utama UNEJ.</p>
            </div>

            <form action="{{ $isEdit ? route('petugas.barang-temuan.update', $barangTemuan) : route('petugas.barang-temuan.store') }}"
                method="POST" enctype="multipart/form-data" class="space-y-5 p-6">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="nama_barang" class="{{ $label }}">Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barangTemuan->nama_barang ?? '') }}" required autofocus
                            placeholder="Contoh: Kunci motor Honda gantungan biru" class="{{ $input }}">
                    </div>

                    <div>
                        <label for="kategori_id" class="{{ $label }}">Kategori</label>
                        <select id="kategori_id" name="kategori_id" required class="{{ $input }}">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}" @selected(old('kategori_id', $barangTemuan->kategori_id ?? '') == $kat->id)>{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tanggal_ditemukan" class="{{ $label }}">Tanggal Ditemukan</label>
                        <input type="date" id="tanggal_ditemukan" name="tanggal_ditemukan"
                            value="{{ old('tanggal_ditemukan', $isEdit ? $barangTemuan->tanggal_ditemukan->format('Y-m-d') : date('Y-m-d')) }}"
                            required max="{{ date('Y-m-d') }}" class="{{ $input }} tabular-nums">
                    </div>

                    <div class="{{ $isEdit ? '' : 'sm:col-span-2' }}">
                        <label for="lokasi_ditemukan" class="{{ $label }}">Lokasi Ditemukan</label>
                        <input type="text" id="lokasi_ditemukan" name="lokasi_ditemukan" value="{{ old('lokasi_ditemukan', $barangTemuan->lokasi_ditemukan ?? '') }}" required
                            placeholder="Contoh: Ruang Baca Perpustakaan Pusat" class="{{ $input }}">
                    </div>

                    @if ($isEdit)
                        <div>
                            <label for="status" class="{{ $label }}">Status Barang</label>
                            <select id="status" name="status" required class="{{ $input }}">
                                @foreach (['tersedia' => 'Tersedia', 'diklaim' => 'Diklaim', 'dikembalikan' => 'Dikembalikan'] as $val => $text)
                                    <option value="{{ $val }}" @selected(old('status', $barangTemuan->status) === $val)>{{ $text }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>

                <div>
                    <label for="deskripsi" class="{{ $label }}">Deskripsi Barang</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" required
                        placeholder="Tuliskan ciri umum barang tanpa membocorkan detail rahasia untuk keperluan verifikasi pemilik"
                        class="{{ $input }}">{{ old('deskripsi', $barangTemuan->deskripsi ?? '') }}</textarea>
                </div>

                <div>
                    <label for="foto_barang" class="{{ $label }}">Foto Barang {{ $isEdit ? '(Opsional jika tidak diganti)' : '' }}</label>
                    @if ($isEdit && $barangTemuan->foto_barang)
                        <div class="mb-3 flex items-center gap-3 rounded-xl border border-[#e7ebf2] bg-[#f7f8fb] p-3">
                            <img src="{{ asset('storage/' . $barangTemuan->foto_barang) }}" alt="{{ $barangTemuan->nama_barang }}" class="h-16 w-16 rounded-lg object-cover">
                            <div class="text-xs text-ink-muted">
                                <p class="font-medium text-ink">Foto saat ini</p>
                                <p>Pilih file baru di bawah jika ingin mengganti foto.</p>
                            </div>
                        </div>
                    @endif
                    <input type="file" id="foto_barang" name="foto_barang" accept=".jpg,.jpeg,.png,.webp" @required(!$isEdit)
                        class="w-full rounded-xl border border-[#d7dde7] px-3 py-2 text-sm text-[#3d4b60] file:mr-3 file:rounded-lg file:border-0 file:bg-[#f3f5f8] file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-ink hover:file:bg-[#e7ebf2]">
                    <p class="mt-1 text-xs text-ink-muted">Format JPG, PNG, atau WEBP maksimal 2MB.</p>
                </div>

                <div class="flex items-center justify-end gap-2 border-t border-[#e7ebf2] pt-4">
                    <a href="{{ route('petugas.barang-temuan.index') }}" class="rounded-xl border border-[#d7dde7] bg-white px-4 py-2.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Batal</a>
                    <button type="submit" class="rounded-xl bg-brand px-5 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Barang Temuan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
