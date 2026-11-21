@extends('layouts.dashboard')

@section('title', isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori')

@section('header', isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori')

@section('content')
    <div class="mx-auto max-w-xl">
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-base font-bold text-slate-900">
                    {{ isset($kategori) ? 'Perbarui Data Kategori' : 'Form Kategori Baru' }}
                </h2>
                <p class="mt-0.5 text-xs text-slate-500">Pastikan nama kategori unik dan mudah dipahami pengguna.</p>
            </div>

            <form action="{{ isset($kategori) ? route('petugas.kategori.update', $kategori) : route('petugas.kategori.store') }}" method="POST" class="space-y-5 p-6">
                @csrf
                @if (isset($kategori))
                    @method('PUT')
                @endif

                <div>
                    <label for="nama_kategori" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}" required autofocus placeholder="Contoh: Elektronik" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <div class="flex items-center justify-end gap-2 border-t border-slate-200 pt-4">
                    <a href="{{ route('petugas.kategori.index') }}" class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                        {{ isset($kategori) ? 'Simpan Perubahan' : 'Simpan Kategori' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection