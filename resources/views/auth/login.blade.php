@extends('layouts.app')

@section('title', 'Masuk - FindIT UNEJ')

@section('content')
    @php
        $loginImage = 'images/background.svg';
        $hasLoginImage = is_file(public_path($loginImage));
    @endphp

    <div class="mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <div class="mx-auto grid max-w-5xl overflow-hidden rounded-[28px] border border-[#e7ebf2] bg-white shadow-card lg:grid-cols-[.9fr_1.1fr]">
            
            <div class="relative hidden min-h-[560px] overflow-hidden bg-ink-deep lg:block">
                @if ($hasLoginImage)
                    <img src="{{ asset($loginImage) }}" alt="Latar Belakang FindIT" class="absolute inset-0 h-full w-full object-cover">
                @endif
            </div>

            <div class="p-6 sm:p-10">
                <p class="inline-flex items-center gap-2 text-[#c41230] text-[12px] font-bold tracking-[.16em] uppercase">Akun FindIT</p>
                <h1 class="mt-2 font-heading text-2xl font-extrabold text-ink">Masuk</h1>

                <form action="{{ route('login') }}" method="POST" class="mt-8 space-y-4">
                    @csrf
                    <div>
                        <label for="identifier" class="mb-1.5 block text-[13px] font-semibold text-[#243044]">NIM / Email</label>
                        <input type="text" id="identifier" name="identifier" value="{{ old('identifier') }}" required autofocus placeholder="Contoh: 252410101010" class="w-full rounded-[14px] border border-[#d7dde7] bg-white px-3.5 py-3 text-sm leading-[1.4] text-[#172033] outline-none transition-[border-color,box-shadow] duration-160 focus:border-[#102a4c] focus:ring-4 focus:ring-[#102a4c]/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585]">
                    </div>
                    <div>
                        <label for="password" class="mb-1.5 block text-[13px] font-semibold text-[#243044]">Kata Sandi</label>
                        <input type="password" id="password" name="password" required placeholder="Masukkan password" class="w-full rounded-[14px] border border-[#d7dde7] bg-white px-3.5 py-3 text-sm leading-[1.4] text-[#172033] outline-none transition-[border-color,box-shadow] duration-160 focus:border-[#102a4c] focus:ring-4 focus:ring-[#102a4c]/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585]">
                    </div>
                    <label class="flex items-center gap-2 text-sm text-[#3d4b60]">
                        <input type="checkbox" name="remember" class="h-4 w-4 rounded border-[#d7dde7] text-brand focus:ring-brand">
                        <span>Ingat saya</span>
                    </label>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-[#c41230] px-5 py-3 text-sm font-bold leading-[1.2] text-white shadow-[0_6px_14px_rgba(196,18,48,.14)] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#9b1028] active:translate-y-0 active:scale-[.98] w-full">Masuk</button>
                </form>

                <p class="mt-6 text-center text-sm text-ink-muted">
                    Belum punya akun mahasiswa?
                    <a href="{{ route('register') }}" class="font-bold text-brand hover:text-brand-dark">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
@endsection