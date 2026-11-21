@extends('layouts.dashboard')

@section('title', isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori')

@section('header', isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori')

@section('content')
    <div class="mx-auto max-w-xl">
        <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white">
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
                    <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}" required autofocus placeholder="Contoh: Elektronik" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
                </div>

                <div class="flex items-center justify-end gap-2 border-t border-slate-200 pt-4">
                    <a href="{{ route('petugas.kategori.index') }}" class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                        Batal
                    </a>
                    <button type="submit" class="rounded-full bg-[#c41230] focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 px-5 py-2 text-sm font-semibold text-white transition-all duration-150 hover:bg-[#9b1028] active:scale-[0.98]">
                        {{ isset($kategori) ? 'Simpan Perubahan' : 'Simpan Kategori' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection