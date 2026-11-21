<nav class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur print:hidden">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-600 text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                <div class="leading-tight">
                    <span class="text-lg font-bold tracking-tight text-slate-900">Find<span class="text-emerald-600">IT</span></span>
                    <span class="block text-[11px] font-medium text-slate-500">Lost & Found UNEJ</span>
                </div>
            </a>

            <div class="hidden items-center gap-1 md:flex">
                <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    Beranda
                </a>

                @auth
                    @if (Auth::user()->role === 'mahasiswa')
                        <a href="{{ route('mahasiswa.laporan.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('mahasiswa.laporan.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            Laporan Saya
                        </a>
                        <a href="{{ route('mahasiswa.klaim.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('mahasiswa.klaim.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                            Klaim Saya
                        </a>
                    @else
                        <a href="{{ route('petugas.dashboard') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-100 transition">
                            Panel Petugas
                        </a>
                    @endif

                    <div class="mx-2 h-5 w-px bg-slate-200"></div>

                    <a href="{{ route('profil.edit') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium transition {{ request()->routeIs('profil.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-700 hover:bg-slate-100' }}">
                        <span class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-100 text-xs font-bold text-emerald-700">
                            {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                        </span>
                        <span class="max-w-[130px] truncate">{{ Auth::user()->nama }}</span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="rounded-lg px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50">
                            Keluar
                        </button>
                    </form>
                @else
                    <div class="ml-2 flex items-center gap-2">
                        <a href="{{ route('login') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>

            <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100 md:hidden">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="hidden border-t border-slate-200 bg-white px-4 py-3 md:hidden">
        <div class="space-y-1">
            <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-100' }}">
                Beranda
            </a>

            @auth
                @if (Auth::user()->role === 'mahasiswa')
                    <a href="{{ route('mahasiswa.laporan.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('mahasiswa.laporan.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-100' }}">
                        Laporan Saya
                    </a>
                    <a href="{{ route('mahasiswa.klaim.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('mahasiswa.klaim.*') ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-100' }}">
                        Klaim Saya
                    </a>
                @else
                    <a href="{{ route('petugas.dashboard') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-emerald-700 bg-emerald-50">
                        Panel Petugas
                    </a>
                @endif

                <a href="{{ route('profil.edit') }}" class="block rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('profil.*') ? 'bg-slate-100 text-slate-900' : 'text-slate-700 hover:bg-slate-100' }}">
                    Profil ({{ Auth::user()->nama }})
                </a>

                <form action="{{ route('logout') }}" method="POST" class="pt-1">
                    @csrf
                    <button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-red-600 hover:bg-red-50">
                        Keluar
                    </button>
                </form>
            @else
                <div class="grid grid-cols-2 gap-2 pt-2">
                    <a href="{{ route('login') }}" class="rounded-lg border border-slate-300 px-3 py-2 text-center text-sm font-medium text-slate-700">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-emerald-600 px-3 py-2 text-center text-sm font-medium text-white">
                        Daftar
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>