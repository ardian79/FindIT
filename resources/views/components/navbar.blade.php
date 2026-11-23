@php
    $isHome = request()->routeIs('home');
    $navLinks = [
        ['Beranda', route('home'), 'top'],
        ['Cara Kerja', route('home') . '#cara-kerja', 'cara-kerja'],
        ['Lokasi', route('home') . '#lokasi', 'lokasi'],
        ['Katalog', route('home') . '#katalog', 'katalog'],
    ];
    $mobileUserLink = 'block rounded-xl px-4 py-2 text-sm font-medium text-[#3d4b60] transition-colors duration-150 hover:bg-[#f3f5f8] hover:text-ink';
    $btnBrand = 'inline-flex items-center justify-center gap-2 rounded-full bg-brand text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]';
@endphp

<script>
    function navigateFromNavbar(event, target) {
        if (!@json($isHome) || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
        event.preventDefault();
        const behavior = matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth';
        if (target === 'top') {
            history.replaceState(null, '', location.pathname);
            return scrollTo({ top: 0, behavior });
        }
        const el = document.getElementById(target);
        if (el) {
            history.replaceState(null, '', '#' + target);
            el.scrollIntoView({ behavior, block: 'start' });
        }
    }
</script>

<div x-data="{
        mobile: false,
        account: false,
        isHome: @json($isHome),
        scrolled: scrollY > 12,
        active: @json($isHome) ? 'Beranda' : null,
        ready: false,
        update() {
            this.scrolled = scrollY > 12;
            if (!this.isHome) return (this.active = null);
            if (scrollY < 180) return (this.active = 'Beranda');
            let next = 'Beranda', marker = innerHeight * 0.35;
            for (const [id, name] of [['cara-kerja', 'Cara Kerja'], ['lokasi', 'Lokasi'], ['katalog', 'Katalog']]) {
                if ((document.getElementById(id)?.getBoundingClientRect().top ?? Infinity) <= marker) next = name;
            }
            this.active = next;
        }
    }"
    x-init="update(); $nextTick(() => ready = true); addEventListener('scroll', () => update(), { passive: true })"
    @keydown.escape.window="mobile = false; account = false"
    :class="[scrolled ? 'px-3 sm:px-5' : 'px-0', ready ? 'transition-[padding] duration-[420ms] ease-[cubic-bezier(.22,1,.36,1)]' : 'transition-none']"
    class="fixed inset-x-0 top-0 z-40 print:hidden">

    <nav :class="[
            scrolled ? 'mx-auto max-w-[1160px] translate-y-3 rounded-full bg-white/95 shadow-card' : 'mx-0 max-w-none translate-y-0 rounded-none bg-white',
            ready ? 'transition-[max-width,border-radius,box-shadow,background-color,transform] duration-[420ms] ease-[cubic-bezier(.22,1,.36,1)]' : 'transition-none'
        ]"
        class="relative w-full border border-[#e7ebf2] backdrop-blur-md">
        <div class="mx-auto w-full max-w-[1160px] px-3 sm:px-5">
            <div class="flex min-h-[68px] items-center justify-between gap-3 lg:grid lg:grid-cols-[1fr_auto_1fr] lg:gap-6">
                <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30 lg:justify-self-start">
                    <img src="{{ asset('images/logo-findit.svg') }}" alt="Logo FindIT" class="h-8 w-8 shrink-0 object-contain">
                    <span class="text-lg font-bold leading-tight tracking-tight text-ink">Find<span class="text-brand">IT</span></span>
                </a>

                <div class="relative hidden items-center justify-center gap-1 lg:flex">
                    @foreach ($navLinks as [$label, $href, $target])
                        <span class="relative inline-flex">
                            <span x-show="active === '{{ $label }}'" class="absolute inset-0 rounded-full bg-brand-soft transition-opacity duration-150" aria-hidden="true"></span>
                            <a href="{{ $href }}" data-nav-section="{{ $label }}" onclick="navigateFromNavbar(event, '{{ $target }}')"
                                :class="active === '{{ $label }}' ? 'text-brand font-semibold' : 'text-ink-navy font-medium'"
                                class="relative z-[1] inline-flex min-h-10 items-center justify-center rounded-full px-4 py-2 text-sm transition-colors duration-150 hover:bg-[#f3f5f8] hover:text-ink-navy focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
                                {{ $label }}
                            </a>
                        </span>
                    @endforeach
                </div>

                <div class="hidden min-w-0 items-center justify-end gap-2 lg:flex lg:justify-self-end">
                    @auth
                        <div class="relative">
                            <button type="button" @click="account = !account" :aria-expanded="account.toString()"
                                class="flex items-center gap-2 rounded-full py-1 pl-1 pr-3 transition-colors duration-150 hover:bg-[#f3f5f8] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-ink-navy text-xs font-semibold text-white">
                                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                                </span>
                                <span class="max-w-[120px] truncate text-sm font-medium text-ink">{{ Auth::user()->nama }}</span>
                            </button>
                            <div x-show="account" x-cloak x-transition.origin.top.right @click.outside="account = false"
                                class="absolute right-0 mt-2 w-52 overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white p-1.5 shadow-lift">
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
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full px-3.5 py-2 text-sm font-medium text-[#3d4b60] transition-colors duration-150 hover:bg-[#f3f5f8] hover:text-ink focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Masuk</a>
                        <a href="{{ route('register') }}" class="{{ $btnBrand }} px-4 py-2 text-xs font-semibold">Daftar</a>
                    @endauth
                </div>

                <button type="button" @click="mobile = !mobile" :aria-expanded="mobile.toString()"
                    aria-controls="mobile-menu" aria-label="Buka navigasi"
                    class="ml-auto flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-ink transition-colors duration-150 hover:bg-[#f3f5f8] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30 lg:hidden">
                    <svg x-show="!mobile" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="mobile" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <div id="mobile-menu" x-show="mobile" x-cloak x-transition.origin.top.duration.150ms @click.outside="mobile = false"
        :class="scrolled ? 'mx-auto mt-3 max-w-[1160px]' : 'mx-0 mt-1.5 max-w-none'"
        class="w-full rounded-2xl border border-[#e7ebf2] bg-white shadow-lift lg:hidden">
        <div class="flex flex-col gap-1 px-4 py-3 sm:px-6">
            @foreach ($navLinks as [$label, $href, $target])
                <a href="{{ $href }}" @click="navigateFromNavbar($event, '{{ $target }}'); mobile = false"
                    :class="active === '{{ $label }}' ? 'bg-brand-soft text-brand font-semibold' : 'bg-transparent text-ink-navy font-medium hover:bg-[#f3f5f8]'"
                    class="flex min-h-10 items-center rounded-xl px-4 py-2 text-sm transition-colors duration-150">
                    {{ $label }}
                </a>
            @endforeach
            @auth
                <div class="my-1 border-t border-[#e7ebf2]"></div>
                @if (Auth::user()->role === 'mahasiswa')
                    <a href="{{ route('mahasiswa.laporan.index') }}" class="{{ $mobileUserLink }} {{ request()->routeIs('mahasiswa.laporan.*') ? 'bg-brand-soft font-semibold text-brand' : '' }}">Laporan Saya</a>
                    <a href="{{ route('mahasiswa.klaim.index') }}" class="{{ $mobileUserLink }} {{ request()->routeIs('mahasiswa.klaim.*') ? 'bg-brand-soft font-semibold text-brand' : '' }}">Klaim Saya</a>
                @else
                    <a href="{{ route('petugas.dashboard') }}" class="{{ $mobileUserLink }} bg-brand-soft font-semibold text-brand">Panel Petugas</a>
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
