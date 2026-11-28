@extends('layouts.app')

@section('title', 'Masuk - FindIT UNEJ')

@section('content')
    <div class="mx-auto w-full max-w-290 px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <div
            class="mx-auto grid max-w-5xl overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white shadow-card lg:grid-cols-[.9fr_1.1fr]">
            <div class="relative hidden min-h-135 overflow-hidden bg-ink-deep lg:block">
                <img src="{{ asset('images/gambar-login.webp') }}" alt="Latar Belakang FindIT" decoding="async"
                    fetchpriority="high" class="absolute inset-0 h-full w-full object-cover">
            </div>

            <div class="p-6 sm:p-10">
                <p class="text-xs font-semibold text-brand">Akun FindIT</p>
                <h1 class="mt-2 font-heading text-2xl font-semibold tracking-tight text-ink">Masuk</h1>

                <form action="{{ route('login') }}" method="POST" class="mt-8 space-y-4">
                    @csrf
                    <div>
                        <label for="identifier" class="mb-1.5 block text-sm font-medium text-ink">NIM / Email</label>
                        <input type="text" id="identifier" name="identifier" value="{{ old('identifier') }}" required
                            autofocus placeholder="Contoh: 252410101010"
                            class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585]">
                    </div>
                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-medium text-ink">Kata Sandi</label>
                        <input type="password" id="password" name="password" required placeholder="Masukkan password"
                            class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585]">
                    </div>
                    <label class="flex items-center gap-2 text-sm text-[#3d4b60]">
                        <input type="checkbox" name="remember"
                            class="h-4 w-4 rounded border-[#d7dde7] text-brand focus:ring-brand">
                        <span>Ingat saya</span>
                    </label>
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-xl bg-brand px-5 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">
                        Masuk
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-ink-muted">
                    Belum punya akun mahasiswa?
                    <a href="{{ route('register') }}" class="font-medium text-brand hover:text-brand-dark">Daftar di
                        sini</a>
                </p>
            </div>
        </div>
    </div>
@endsection
