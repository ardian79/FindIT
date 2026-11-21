@extends('layouts.app')

@section('title', 'Masuk - FindIT UNEJ')

@section('content')
    <div class="mx-auto max-w-md px-4 py-12 sm:px-6">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <div class="mb-6 text-center">
                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-600 text-white">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-slate-900">Masuk ke FindIT</h1>
                <p class="mt-1 text-sm text-slate-500">Gunakan NIM untuk Mahasiswa atau Email untuk Petugas</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="identifier" class="mb-1.5 block text-sm font-medium text-slate-700">NIM / Email</label>
                    <input type="text" id="identifier" name="identifier" value="{{ old('identifier') }}" required autofocus placeholder="Contoh: 222410101001 atau petugas@unej.ac.id" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <div>
                    <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Masukkan password" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Masuk
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-600">
                Belum punya akun mahasiswa?
                <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">Daftar di sini</a>
            </p>
        </div>
    </div>
@endsection