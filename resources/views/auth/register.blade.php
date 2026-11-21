@extends('layouts.app')

@section('title', 'Daftar Mahasiswa - FindIT UNEJ')

@section('content')
    <div class="mx-auto max-w-md px-4 py-10 sm:px-6">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <div class="mb-6 text-center">
                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-600 text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-slate-900">Daftar Akun Mahasiswa</h1>
                <p class="mt-1 text-sm text-slate-500">Buat akun untuk melapor kehilangan dan mengajukan klaim barang</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="nama" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required autofocus placeholder="Masukkan nama lengkap" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <div>
                    <label for="nim" class="mb-1.5 block text-sm font-medium text-slate-700">NIM</label>
                    <input type="text" id="nim" name="nim" value="{{ old('nim') }}" required placeholder="Contoh: 222410101001" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <div>
                    <label for="no_hp" class="mb-1.5 block text-sm font-medium text-slate-700">Nomor WhatsApp / HP</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required placeholder="Contoh: 081234567890" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <div>
                    <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Minimal 6 karakter" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <div>
                    <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-slate-700">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Daftar Sekarang
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">Masuk di sini</a>
            </p>
        </div>
    </div>
@endsection