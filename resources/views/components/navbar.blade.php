<script>
    function navigateFromNavbar(event, target) {
        const isHomePage = @json(request()->routeIs('home'));
        if (!isHomePage || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;

        event.preventDefault();
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const behavior = reduceMotion ? 'auto' : 'smooth';
        if (target === 'top') {
            window.history.replaceState(null, '', window.location.pathname);
            window.scrollTo({
                top: 0,
                behavior
            });
            return;
        }
        const section = document.getElementById(target);
        if (section) {
            window.history.replaceState(null, '', '#' + target);
            section.scrollIntoView({
                behavior,
                block: 'start'
            });
        }
    }
</script>

<div x-data="{ mobile: false, account: false, scrolled: window.scrollY > 12, active: 'Beranda', ready: false }" x-init="const updateActive = () => {
    scrolled = window.scrollY > 12;
    if (window.scrollY < 180) {
        active = 'Beranda';
    } else {
        const caraKerja = document.getElementById('cara-kerja');
        const lokasi = document.getElementById('lokasi');
        const katalog = document.getElementById('katalog');
        let next = 'Beranda';
        const marker = window.innerHeight * 0.35;
        if (caraKerja && caraKerja.getBoundingClientRect().top <= marker) next = 'Cara Kerja';
        if (lokasi && lokasi.getBoundingClientRect().top <= marker) next = 'Lokasi';
        if (katalog && katalog.getBoundingClientRect().top <= marker) next = 'Katalog';
        active = next;
    }
};
updateActive();
$nextTick(() => {
    ready = true;
});
window.addEventListener('scroll', updateActive, { passive: true });" @keydown.escape.window="mobile = false; account = false"
    :class="[
        scrolled ? 'px-3 sm:px-5' : 'px-0',
        ready ? 'transition-[padding] duration-[520ms] ease-[cubic-bezier(.22,1,.36,1)]' : 'transition-none'
    ]"
    class="fixed inset-x-0 top-0 z-40 print:hidden">
    <nav :class="[
        scrolled ?
        'mx-auto max-w-[1160px] translate-y-3 rounded-full bg-white/95 shadow-[0_10px_30px_rgba(16,42,76,0.08)]' :
        'mx-0 max-w-none translate-y-0 rounded-none bg-white shadow-[0_2px_8px_rgba(16,42,76,0.03)]',
        ready ?
        'transition-[max-width,border-radius,box-shadow,background-color,transform] duration-[520ms] ease-[cubic-bezier(.22,1,.36,1)]' :
        'transition-none'
    ]"
        class="relative w-full border border-[#e7ebf2] backdrop-blur-md">
        <div class="mx-auto w-full max-w-[1160px] px-3 sm:px-5">
            <div
                class="flex min-h-[68px] items-center justify-between gap-3 lg:grid lg:grid-cols-[1fr_auto_1fr] lg:gap-6">
                <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-2 lg:justify-self-start">
                    @if (is_file(public_path('images/logo-findit.svg')))
                        <img src="{{ asset('images/logo-findit.svg') }}" alt="Logo FindIT"
                            class="h-8 w-8 shrink-0 object-contain">
                    @elseif (is_file(public_path('images/logo-findit.png')))
                        <img src="{{ asset('images/logo-findit.png') }}" alt="Logo FindIT"
                            class="h-8 w-8 shrink-0 object-contain">
                    @endif
                    <span class="leading-tight">
                        <span class="block text-lg font-extrabold tracking-tight text-ink">Find<span
                                class="text-brand">IT</span></span>
                    </span>
                </a>

                <div class="relative hidden items-center justify-center gap-2 lg:flex">
                    <span class="relative inline-flex">
                        <span x-show="active === 'Beranda'"
                            class="absolute inset-0 rounded-full bg-[#fdecee] transition-opacity duration-200 ease-in-out"
                            aria-hidden="true"></span>
                        <a href="{{ route('home') }}" data-nav-section="Beranda"
                            onclick="navigateFromNavbar(event, 'top')"
                            :class="active === 'Beranda' ? 'text-[#c41230]' : 'text-[#102a4c]'"
                            class="relative z-[1] inline-flex min-h-[40px] items-center justify-center rounded-full px-4 py-2.5 text-sm font-bold transition-colors duration-200 ease-in-out hover:bg-[#f3f5f8] hover:text-[#102a4c]">Beranda</a>
                    </span>
                    <span class="relative inline-flex">
                        <span x-show="active === 'Cara Kerja'"
                            class="absolute inset-0 rounded-full bg-[#fdecee] transition-opacity duration-200 ease-in-out"
                            aria-hidden="true"></span>
                        <a href="{{ route('home') }}#cara-kerja" data-nav-section="Cara Kerja"
                            onclick="navigateFromNavbar(event, 'cara-kerja')"
                            :class="active === 'Cara Kerja' ? 'text-[#c41230]' : 'text-[#102a4c]'"
                            class="relative z-[1] inline-flex min-h-[40px] items-center justify-center rounded-full px-4 py-2.5 text-sm font-bold transition-colors duration-200 ease-in-out hover:bg-[#f3f5f8] hover:text-[#102a4c]">Cara
                            Kerja</a>
                    </span>
                    <span class="relative inline-flex">
                        <span x-show="active === 'Lokasi'"
                            class="absolute inset-0 rounded-full bg-[#fdecee] transition-opacity duration-200 ease-in-out"
                            aria-hidden="true"></span>
                        <a href="{{ route('home') }}#lokasi" data-nav-section="Lokasi"
                            onclick="navigateFromNavbar(event, 'lokasi')"
                            :class="active === 'Lokasi' ? 'text-[#c41230]' : 'text-[#102a4c]'"
                            class="relative z-[1] inline-flex min-h-[40px] items-center justify-center rounded-full px-4 py-2.5 text-sm font-bold transition-colors duration-200 ease-in-out hover:bg-[#f3f5f8] hover:text-[#102a4c]">Lokasi</a>
                    </span>
                    <span class="relative inline-flex">
                        <span x-show="active === 'Katalog'"
                            class="absolute inset-0 rounded-full bg-[#fdecee] transition-opacity duration-200 ease-in-out"
                            aria-hidden="true"></span>
                        <a href="{{ route('home') }}#katalog" data-nav-section="Katalog"
                            onclick="navigateFromNavbar(event, 'katalog')"
                            :class="active === 'Katalog' ? 'text-[#c41230]' : 'text-[#102a4c]'"
                            class="relative z-[1] inline-flex min-h-[40px] items-center justify-center rounded-full px-4 py-2.5 text-sm font-bold transition-colors duration-200 ease-in-out hover:bg-[#f3f5f8] hover:text-[#102a4c]">Katalog</a>
                    </span>
                </div>

                <div class="hidden min-w-0 items-center justify-end gap-2 lg:flex lg:justify-self-end">
                    @auth
                        <div class="relative" @keydown.escape.window="account = false">
                            <button type="button" @click="account = !account"
                                class="flex items-center gap-2 rounded-full py-1 pl-1 pr-3 transition hover:bg-[#f4f6f8]"
                                :aria-expanded="account.toString()">
                                <span
                                    class="flex h-9 w-9 items-center justify-center rounded-full bg-ink-navy text-xs font-extrabold text-white">
                                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                                </span>
                                <span
                                    class="max-w-[120px] truncate text-sm font-bold text-ink">{{ Auth::user()->nama }}</span>
                            </button>
                            <div x-show="account" x-cloak x-transition.origin.top.right @click.outside="account = false"
                                class="absolute right-0 mt-2 w-52 overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white py-1.5 shadow-lift">
                                <a href="{{ route('profil.edit') }}"
                                    class="block px-4 py-2.5 text-sm font-semibold text-ink hover:bg-[#f6f7f9]">Profil
                                    saya</a>
                                @if (Auth::user()->role === 'mahasiswa')
                                    <a href="{{ route('mahasiswa.laporan.index') }}"
                                        class="block px-4 py-2.5 text-sm font-semibold text-ink hover:bg-[#f6f7f9]">Laporan
                                        saya</a>
                                    <a href="{{ route('mahasiswa.klaim.index') }}"
                                        class="block px-4 py-2.5 text-sm font-semibold text-ink hover:bg-[#f6f7f9]">Klaim
                                        saya</a>
                                @endif
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full px-4 py-2.5 text-left text-sm font-semibold text-brand hover:bg-brand-soft">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="relative rounded-full px-3.5 py-2 text-sm font-semibold text-[#3d4b60] transition-colors duration-160 ease-[cubic-bezier(.22,1,.36,1)] hover:bg-[#f3f5f8] hover:text-[#172033]">Masuk</a>
                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-[#c41230] px-3.5 py-2 text-xs font-bold leading-[1.2] text-white shadow-[0_6px_14px_rgba(196,18,48,.14)] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#9b1028] active:translate-y-0 active:scale-[.98]">Daftar</a>
                    @endauth
                </div>

                <button type="button" @click="mobile = !mobile" :aria-expanded="mobile.toString()"
                    aria-controls="mobile-menu" aria-label="Buka navigasi"
                    class="ml-auto flex h-10 w-10 shrink-0 items-center justify-center rounded-full text-ink transition hover:bg-[#f3f5f8] active:scale-95 lg:hidden">
                    <svg x-show="!mobile" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="mobile" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <div id="mobile-menu" x-show="mobile" x-cloak x-transition.origin.top.duration.200ms
        @click.outside="mobile = false" :class="scrolled ? 'mx-auto mt-4 max-w-[1160px]' : 'mx-0 mt-1.5 max-w-none'"
        class="w-full rounded-3xl border border-[#e7ebf2] bg-white/98 shadow-lift backdrop-blur-md lg:hidden">
        <div class="flex flex-col gap-1.5 px-4 py-3 sm:px-6">
            <a href="{{ route('home') }}" @click="navigateFromNavbar($event, 'top'); mobile = false"
                :class="active === 'Beranda' ? 'bg-[#fdecee] text-[#c41230]' :
                    'bg-transparent text-[#102a4c] hover:bg-[#f3f5f8] hover:text-[#102a4c]'"
                class="flex min-h-[40px] items-center rounded-full px-4 py-2 text-sm font-bold transition-colors duration-200 ease-in-out">Beranda</a>
            <a href="{{ route('home') }}#cara-kerja"
                @click="navigateFromNavbar($event, 'cara-kerja'); mobile = false"
                :class="active === 'Cara Kerja' ? 'bg-[#fdecee] text-[#c41230]' :
                    'bg-transparent text-[#102a4c] hover:bg-[#f3f5f8] hover:text-[#102a4c]'"
                class="flex min-h-[40px] items-center rounded-full px-4 py-2 text-sm font-bold transition-colors duration-200 ease-in-out">Cara
                Kerja</a>
            <a href="{{ route('home') }}#lokasi" @click="navigateFromNavbar($event, 'lokasi'); mobile = false"
                :class="active === 'Lokasi' ? 'bg-[#fdecee] text-[#c41230]' :
                    'bg-transparent text-[#102a4c] hover:bg-[#f3f5f8] hover:text-[#102a4c]'"
                class="flex min-h-[40px] items-center rounded-full px-4 py-2 text-sm font-bold transition-colors duration-200 ease-in-out">Lokasi</a>
            <a href="{{ route('home') }}#katalog" @click="navigateFromNavbar($event, 'katalog'); mobile = false"
                :class="active === 'Katalog' ? 'bg-[#fdecee] text-[#c41230]' :
                    'bg-transparent text-[#102a4c] hover:bg-[#f3f5f8] hover:text-[#102a4c]'"
                class="flex min-h-[40px] items-center rounded-full px-4 py-2 text-sm font-bold transition-colors duration-200 ease-in-out">Katalog</a>
            @auth
                @if (Auth::user()->role === 'mahasiswa')
                    <a href="{{ route('mahasiswa.laporan.index') }}"
                        class="relative block rounded-full px-4 py-2 text-sm font-semibold text-[#3d4b60] transition-colors duration-160 ease-[cubic-bezier(.22,1,.36,1)] hover:bg-[#f3f5f8] hover:text-[#172033] {{ request()->routeIs('mahasiswa.laporan.*') ? 'bg-[#fdecee] text-[#c41230]' : '' }}">Laporan
                        Saya</a>
                    <a href="{{ route('mahasiswa.klaim.index') }}"
                        class="relative block rounded-full px-4 py-2 text-sm font-semibold text-[#3d4b60] transition-colors duration-160 ease-[cubic-bezier(.22,1,.36,1)] hover:bg-[#f3f5f8] hover:text-[#172033] {{ request()->routeIs('mahasiswa.klaim.*') ? 'bg-[#fdecee] text-[#c41230]' : '' }}">Klaim
                        Saya</a>
                @else
                    <a href="{{ route('petugas.dashboard') }}"
                        class="relative block rounded-full bg-[#fdecee] px-4 py-2 text-sm font-semibold text-[#c41230] transition-colors duration-160 ease-[cubic-bezier(.22,1,.36,1)] hover:bg-[#f3f5f8]">Panel
                        Petugas</a>
                @endif
                <a href="{{ route('profil.edit') }}"
                    class="relative block rounded-full px-4 py-2 text-sm font-semibold text-[#3d4b60] transition-colors duration-160 ease-[cubic-bezier(.22,1,.36,1)] hover:bg-[#f3f5f8] hover:text-[#172033] {{ request()->routeIs('profil.*') ? 'bg-[#fdecee] text-[#c41230]' : '' }}">Profil
                    ({{ Auth::user()->nama }})
                </a>
                <form action="{{ route('logout') }}" method="POST" class="pt-1">
                    @csrf
                    <button type="submit"
                        class="relative block w-full rounded-full px-4 py-2 text-left text-sm font-semibold text-brand transition-colors duration-160 ease-[cubic-bezier(.22,1,.36,1)] hover:bg-brand-soft">Keluar</button>
                </form>
            @else
                <div class="grid grid-cols-2 gap-2 pt-2">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-[#d5dbe6] bg-white px-5 py-3 text-sm font-bold leading-[1.2] text-[#172033] transition-all duration-200 ease-out hover:-translate-y-px hover:border-[#102a4c] hover:text-[#102a4c] active:translate-y-0 active:scale-[.98]">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-[#c41230] px-5 py-3 text-sm font-bold leading-[1.2] text-white shadow-[0_6px_14px_rgba(196,18,48,.14)] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#9b1028] active:translate-y-0 active:scale-[.98]">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</div>
