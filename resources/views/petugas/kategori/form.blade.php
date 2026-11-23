@extends('layouts.dashboard')

@php
    $isEdit = isset($kategori);
@endphp

@section('title', $isEdit ? 'Edit Kategori' : 'Tambah Kategori')
@section('header', $isEdit ? 'Edit Kategori' : 'Tambah Kategori')

@section('content')
    <div class="mx-auto max-w-xl">
        <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
            <div class="border-b border-[#e7ebf2] px-6 py-4">
                <h2 class="text-base font-semibold text-ink">{{ $isEdit ? 'Perbarui Data Kategori' : 'Form Kategori Baru' }}</h2>
                <p class="mt-0.5 text-xs text-ink-muted">Pastikan nama kategori unik dan mudah dipahami pengguna.</p>
            </div>

            <form action="{{ $isEdit ? route('petugas.kategori.update', $kategori) : route('petugas.kategori.store') }}" method="POST" class="space-y-5 p-6">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div>
                    <label for="nama_kategori" class="mb-1.5 block text-sm font-medium text-ink">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}" required autofocus
                        placeholder="Contoh: Elektronik"
                        class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
                </div>

                <div class="flex items-center justify-end gap-2 border-t border-[#e7ebf2] pt-4">
                    <a href="{{ route('petugas.kategori.index') }}" class="rounded-xl border border-[#d7dde7] bg-white px-4 py-2.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Batal</a>
                    <button type="submit" class="rounded-xl bg-brand px-5 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">
                        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Kategori' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
