@php
    $isHome = request()->routeIs('home');
    $navLinks = [
        ['Beranda', $isHome ? '#beranda' : route('home'), 'beranda'],
        ['Cara Kerja', $isHome ? '#cara-kerja' : route('home') . '#cara-kerja', 'cara-kerja'],
        ['Lokasi', $isHome ? '#lokasi' : route('home') . '#lokasi', 'lokasi'],
        ['Katalog', $isHome ? '#katalog' : route('home') . '#katalog', 'katalog'],
    ];
    $mobileUserLink = 'block rounded-xl px-4 py-2 text-sm font-medium text-[#3d4b60] transition-colors duration-150 hover:bg-[#f3f5f8] hover:text-ink';
    $btnBrand = 'inline-flex items-center justify-center gap-2 rounded-full bg-brand text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]';
@endphp

<div class="fi-nav-wrap fixed inset-x-0 top-0 z-40 print:hidden">
    <input type="checkbox" id="nav-mobile-toggle" class="peer hidden" aria-hidden="true">

    <nav class="fi-nav-bar relative mx-auto w-full border border-[#e7ebf2] bg-white backdrop-blur-md peer-checked:[&_.nav-icon-close]:block peer-checked:[&_.nav-icon-open]:hidden">
        <div class="mx-auto w-full max-w-[1160px] px-3 sm:px-5">
            <div class="flex min-h-[68px] items-center justify-between gap-3 lg:grid lg:grid-cols-[1fr_auto_1fr] lg:gap-6">
                <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30 lg:justify-self-start">
                    <img src="{{ asset('images/logo-findit.svg') }}" alt="Logo FindIT" class="h-8 w-8 shrink-0 object-contain">
                    <span class="text-lg font-bold leading-tight tracking-tight text-ink">Find<span class="text-brand">IT</span></span>
                </a>

                <div class="{{ $isHome ? 'fi-nav-links' : '' }} relative hidden items-center justify-center gap-1 lg:flex">
                    @foreach ($navLinks as [$label, $href, $target])
                        <a href="{{ $href }}"
                            class="inline-flex min-h-10 items-center justify-center rounded-full px-4 py-2 text-sm font-medium text-ink-navy transition-colors duration-150 hover:bg-[#f3f5f8] hover:text-ink-navy focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                <div class="hidden min-w-0 items-center justify-end gap-2 lg:flex lg:justify-self-end">
                    @auth
                        <details class="group relative">
                            <summary class="flex cursor-pointer list-none items-center gap-2 rounded-full py-1 pl-1 pr-3 transition-colors duration-150 hover:bg-[#f3f5f8] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30 [&::-webkit-details-marker]:hidden">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-ink-navy text-xs font-semibold text-white">
                                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                                </span>
                                <span class="max-w-[120px] truncate text-sm font-medium text-ink">{{ Auth::user()->nama }}</span>
                            </summary>
                            <div class="absolute right-0 mt-2 w-52 overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white p-1.5 shadow-lift">
                                <a href="{{ route('profil.edit') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-ink transition-colors hover:bg-[#f3f5f8]">Profil saya</a>
                                @if (Auth::user()->role === 'mahasiswa')
                                    <a href="{{ route('mahasiswa.laporan.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-ink transition-colors hover:bg-[#f3f5f8]">Laporan saya</a>
                                    <a href="{{ route('mahasiswa.klaim.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-ink transition-colors hover:bg-[#f3f5f8]">Klaim saya</a>
                                @else
                                    <a href="{{ route('petugas.dashboard') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-ink transition-colors hover:bg-[#f3f5f8]">Panel petugas</a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST" class="mt-1 border-t border-[#e7ebf2] pt-1">
                                    @csrf
                                    <button type="submit" class="block w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-brand transition-colors hover:bg-brand-soft">Keluar</button>
                                </form>
                            </div>
                        </details>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full px-3.5 py-2 text-sm font-medium text-[#3d4b60] transition-colors duration-150 hover:bg-[#f3f5f8] hover:text-ink focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Masuk</a>
                        <a href="{{ route('register') }}" class="{{ $btnBrand }} px-4 py-2 text-xs font-semibold">Daftar</a>
                    @endauth
                </div>

                <label for="nav-mobile-toggle" role="button" tabindex="0" aria-controls="mobile-menu" aria-label="Buka navigasi"
                    class="ml-auto flex h-10 w-10 shrink-0 cursor-pointer items-center justify-center rounded-xl text-ink transition-colors duration-150 hover:bg-[#f3f5f8] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30 lg:hidden">
                    <svg class="nav-icon-open h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg class="nav-icon-close hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </label>
            </div>
        </div>
    </nav>

    <div id="mobile-menu" class="fi-nav-mobile mx-auto mt-1.5 hidden w-full rounded-2xl border border-[#e7ebf2] bg-white shadow-lift peer-checked:block lg:hidden">
        <div class="{{ $isHome ? 'fi-nav-links' : '' }} flex flex-col gap-1 px-4 py-3 sm:px-6">
            @foreach ($navLinks as [$label, $href, $target])
                <a href="{{ $href }}"
                    class="flex min-h-10 items-center rounded-xl bg-transparent px-4 py-2 text-sm font-medium text-ink-navy transition-colors duration-150 hover:bg-[#f3f5f8]">
                    {{ $label }}
                </a>
            @endforeach
            @auth
                <div class="my-1 border-t border-[#e7ebf2]"></div>
                @if (Auth::user()->role === 'mahasiswa')
                    <a href="{{ route('mahasiswa.laporan.index') }}" class="{{ $mobileUserLink }} {{ request()->routeIs('mahasiswa.laporan.*') ? 'bg-brand-soft font-semibold text-brand' : '' }}">Laporan Saya</a>
                    <a href="{{ route('mahasiswa.klaim.index') }}" class="{{ $mobileUserLink }} {{ request()->routeIs('mahasiswa.klaim.*') ? 'bg-brand-soft font-semibold text-brand' : '' }}">Klaim Saya</a>
                @else
                    <a href="{{ route('petugas.dashboard') }}" class="{{ $mobileUserLink }} {{ request()->routeIs('petugas.*') ? 'bg-brand-soft font-semibold text-brand' : '' }}">Panel Petugas</a>
                @endif
                <a href="{{ route('profil.edit') }}" class="{{ $mobileUserLink }} {{ request()->routeIs('profil.*') ? 'bg-brand-soft font-semibold text-brand' : '' }}">Profil ({{ Auth::user()->nama }})</a>
                <form action="{{ route('logout') }}" method="POST" class="pt-1">
                    @csrf
                    <button type="submit" class="block w-full rounded-xl px-4 py-2 text-left text-sm font-medium text-brand transition-colors duration-150 hover:bg-brand-soft">Keluar</button>
                </form>
            @else
                <div class="grid grid-cols-2 gap-2 pt-2">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-4 py-2.5 text-sm font-medium text-ink transition-colors duration-150 hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy">Masuk</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl bg-brand px-4 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</div>
