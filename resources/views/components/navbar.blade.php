@php
    $isHome = request()->routeIs('home');
    $navLinks = [
        ['Beranda', route('home'), 'top'],
        ['Cara Kerja', route('home') . '#cara-kerja', 'cara-kerja'],
        ['Lokasi', route('home') . '#lokasi', 'lokasi'],
        ['Katalog', route('home') . '#katalog', 'katalog'],
    ];
    $mobileUserLink = 'block rounded-full px-4 py-2 text-sm font-semibold text-[#3d4b60] transition hover:bg-[#f3f5f8] hover:text-ink';
    $btnBrand = 'inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-brand text-white shadow-[0_6px_14px_rgba(196,18,48,.14)] transition hover:-translate-y-px hover:bg-brand-dark active:scale-[.98]';
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
    :class="[scrolled ? 'px-3 sm:px-5' : 'px-0', ready ? 'transition-[padding] duration-[520ms] ease-[cubic-bezier(.22,1,.36,1)]' : 'transition-none']"
    class="fixed inset-x-0 top-0 z-40 print:hidden">

    <nav :class="[
            scrolled ? 'mx-auto max-w-[1160px] translate-y-3 rounded-full bg-white/95 shadow-[0_10px_30px_rgba(16,42,76,0.08)]' : 'mx-0 max-w-none translate-y-0 rounded-none bg-white shadow-[0_2px_8px_rgba(16,42,76,0.03)]',
            ready ? 'transition-[max-width,border-radius,box-shadow,background-color,transform] duration-[520ms] ease-[cubic-bezier(.22,1,.36,1)]' : 'transition-none'
        ]"
        class="relative w-full border border-[#e7ebf2] backdrop-blur-md">
        <div class="mx-auto w-full max-w-[1160px] px-3 sm:px-5">
            <div class="flex min-h-[68px] items-center justify-between gap-3 lg:grid lg:grid-cols-[1fr_auto_1fr] lg:gap-6">
                <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2 lg:justify-self-start">
                    <img src="{{ asset('images/logo-findit.svg') }}" alt="Logo FindIT" class="h-8 w-8 shrink-0 object-contain">
                    <span class="text-lg font-extrabold leading-tight tracking-tight text-ink">Find<span class="text-brand">IT</span></span>
                </a>

                <div class="relative hidden items-center justify-center gap-2 lg:flex">
                    @foreach ($navLinks as [$label, $href, $target])
                        <span class="relative inline-flex">
                            <span x-show="active === '{{ $label }}'" class="absolute inset-0 rounded-full bg-brand-soft transition-opacity duration-200" aria-hidden="true"></span>
                            <a href="{{ $href }}" data-nav-section="{{ $label }}" onclick="navigateFromNavbar(event, '{{ $target }}')"
                                :class="active === '{{ $label }}' ? 'text-brand' : 'text-ink-navy'"
                                class="relative z-[1] inline-flex min-h-[40px] items-center justify-center rounded-full px-4 py-2.5 text-sm font-bold transition-colors hover:bg-[#f3f5f8] hover:text-ink-navy">
                                {{ $label }}
                            </a>
                        </span>
                    @endforeach
                </div>

                <div class="hidden min-w-0 items-center justify-end gap-2 lg:flex lg:justify-self-end">
                    @auth
                        <div class="relative">
                            <button type="button" @click="account = !account" :aria-expanded="account.toString()"
                                class="flex items-center gap-2 rounded-full py-1 pl-1 pr-3 transition hover:bg-[#f4f6f8]">
                                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-ink-navy text-xs font-extrabold text-white">
                                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                                </span>
                                <span class="max-w-[120px] truncate text-sm font-bold text-ink">{{ Auth::user()->nama }}</span>
                            </button>
                            <div x-show="account" x-cloak x-transition.origin.top.right @click.outside="account = false"
                                class="absolute right-0 mt-2 w-52 overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white py-1.5 shadow-lift">
                                <a href="{{ route('profil.edit') }}" class="block px-4 py-2.5 text-sm font-semibold text-ink hover:bg-[#f6f7f9]">Profil saya</a>
                                @if (Auth::user()->role === 'mahasiswa')
                                    <a href="{{ route('mahasiswa.laporan.index') }}" class="block px-4 py-2.5 text-sm font-semibold text-ink hover:bg-[#f6f7f9]">Laporan saya</a>
                                    <a href="{{ route('mahasiswa.klaim.index') }}" class="block px-4 py-2.5 text-sm font-semibold text-ink hover:bg-[#f6f7f9]">Klaim saya</a>
                                @else
                                    <a href="{{ route('petugas.dashboard') }}" class="block px-4 py-2.5 text-sm font-semibold text-ink hover:bg-[#f6f7f9]">Panel petugas</a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2.5 text-left text-sm font-semibold text-brand hover:bg-brand-soft">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full px-3.5 py-2 text-sm font-semibold text-[#3d4b60] transition hover:bg-[#f3f5f8] hover:text-ink">Masuk</a>
                        <a href="{{ route('register') }}" class="{{ $btnBrand }} px-3.5 py-2 text-xs font-bold">Daftar</a>
                    @endauth
                </div>

                <button type="button" @click="mobile = !mobile" :aria-expanded="mobile.toString()"
                    aria-controls="mobile-menu" aria-label="Buka navigasi"
                    class="ml-auto flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-ink transition hover:bg-[#f3f5f8] active:scale-95 lg:hidden">
                    <svg x-show="!mobile" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="mobile" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <div id="mobile-menu" x-show="mobile" x-cloak x-transition.origin.top.duration.200ms @click.outside="mobile = false"
        :class="scrolled ? 'mx-auto mt-4 max-w-[1160px]' : 'mx-0 mt-1.5 max-w-none'"
        class="w-full rounded-3xl border border-[#e7ebf2] bg-white shadow-lift lg:hidden">
        <div class="flex flex-col gap-1.5 px-4 py-3 sm:px-6">
            @foreach ($navLinks as [$label, $href, $target])
                <a href="{{ $href }}" @click="navigateFromNavbar($event, '{{ $target }}'); mobile = false"
                    :class="active === '{{ $label }}' ? 'bg-brand-soft text-brand' : 'bg-transparent text-ink-navy hover:bg-[#f3f5f8]'"
                    class="flex min-h-[40px] items-center rounded-full px-4 py-2 text-sm font-bold transition-colors">
                    {{ $label }}
                </a>
            @endforeach
            @auth
                @if (Auth::user()->role === 'mahasiswa')
                    <a href="{{ route('mahasiswa.laporan.index') }}" class="{{ $mobileUserLink }} {{ request()->routeIs('mahasiswa.laporan.*') ? 'bg-brand-soft text-brand' : '' }}">Laporan Saya</a>
                    <a href="{{ route('mahasiswa.klaim.index') }}" class="{{ $mobileUserLink }} {{ request()->routeIs('mahasiswa.klaim.*') ? 'bg-brand-soft text-brand' : '' }}">Klaim Saya</a>
                @else
                    <a href="{{ route('petugas.dashboard') }}" class="block rounded-full bg-brand-soft px-4 py-2 text-sm font-semibold text-brand transition hover:bg-[#f3f5f8]">Panel Petugas</a>
                @endif
                <a href="{{ route('profil.edit') }}" class="{{ $mobileUserLink }} {{ request()->routeIs('profil.*') ? 'bg-brand-soft text-brand' : '' }}">Profil ({{ Auth::user()->nama }})</a>
                <form action="{{ route('logout') }}" method="POST" class="pt-1">
                    @csrf
                    <button type="submit" class="block w-full rounded-full px-4 py-2 text-left text-sm font-semibold text-brand transition hover:bg-brand-soft">Keluar</button>
                </form>
            @else
                <div class="grid grid-cols-2 gap-2 pt-2">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full border border-[#d5dbe6] bg-white px-5 py-3 text-sm font-bold text-ink transition hover:-translate-y-px hover:border-ink-navy hover:text-ink-navy active:scale-[.98]">Masuk</a>
                    <a href="{{ route('register') }}" class="{{ $btnBrand }} px-5 py-3 text-sm font-bold">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</div>
