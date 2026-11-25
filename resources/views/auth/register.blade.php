@extends('layouts.app')

@section('title', 'Daftar Mahasiswa - FindIT UNEJ')

@section('content')
    @php
        $label = 'mb-1.5 block text-sm font-medium text-ink';
        $input = 'w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585]';
    @endphp

    <div class="mx-auto w-full max-w-[1160px] px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <div class="mx-auto grid max-w-5xl overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white shadow-card lg:grid-cols-[.9fr_1.1fr]">
            <div class="relative hidden min-h-[540px] overflow-hidden bg-ink-deep lg:block">
                <img src="{{ asset('images/gambar-register.webp') }}" alt="Latar Belakang FindIT" decoding="async" fetchpriority="high" class="absolute inset-0 h-full w-full object-cover">
            </div>

            <div class="p-6 sm:p-10">
                <p class="text-xs font-semibold text-brand">Pendaftaran</p>
                <h1 class="mt-2 font-heading text-2xl font-semibold tracking-tight text-ink">Daftar</h1>

                <form action="{{ route('register') }}" method="POST" class="mt-8 space-y-4">
                    @csrf
                    <div>
                        <label for="nama" class="{{ $label }}">Nama lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required autofocus
                            placeholder="Masukkan nama lengkap" class="{{ $input }}">
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="nim" class="{{ $label }}">NIM</label>
                            <input type="text" id="nim" name="nim" value="{{ old('nim') }}" required
                                placeholder="Contoh: 252410101010" class="{{ $input }} tabular-nums">
                        </div>
                        <div>
                            <label for="no_hp" class="{{ $label }}">Nomor WhatsApp</label>
                            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required
                                placeholder="Contoh: 081234567890" class="{{ $input }} tabular-nums">
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="password" class="{{ $label }}">Kata Sandi</label>
                            <input type="password" id="password" name="password" required
                                placeholder="Minimal 6 karakter" class="{{ $input }}">
                        </div>
                        <div>
                            <label for="password_confirmation" class="{{ $label }}">Konfirmasi Kata Sandi</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                placeholder="Ulangi kata sandi" class="{{ $input }}">
                        </div>
                    </div>
                    <button type="submit"
                        class="inline-flex w-full items-center justify-center rounded-xl bg-brand px-5 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">
                        Daftar sekarang
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-ink-muted">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-brand hover:text-brand-dark">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
@endsection
