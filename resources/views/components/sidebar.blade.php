@php
    $linkBase = 'group flex items-center gap-3 rounded-xl px-3 py-2 text-sm transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30';
    $sections = [
        'Operasional' => [
            ['petugas.dashboard', 'petugas.dashboard', 'Dashboard', 'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z'],
            ['petugas.barang-temuan.index', 'petugas.barang-temuan.*', 'Barang Temuan', 'M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'],
            ['petugas.verifikasi-klaim.index', 'petugas.verifikasi-klaim.*', 'Verifikasi Klaim', 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z'],
            ['petugas.laporan-kehilangan.index', 'petugas.laporan-kehilangan.*', 'Laporan Kehilangan', 'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z'],
        ],
        'Kelola' => [
            ['petugas.kategori.index', 'petugas.kategori.*', 'Kategori', 'M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3zM6 6h.008v.008H6V6z'],
            ['petugas.pengguna.index', 'petugas.pengguna.*', 'Pengguna', 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'],
            ['petugas.laporan.index', 'petugas.laporan.*', 'Rekap Laporan', 'M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z'],
        ],
    ];
    $footerLinks = [
        ['home', null, 'Halaman Publik', 'M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418'],
        ['profil.edit', 'profil.*', 'Profil Saya', 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z'],
    ];
@endphp

<label id="sidebar-backdrop" for="sidebar-toggle" aria-label="Tutup sidebar" class="fixed inset-0 z-40 hidden cursor-pointer bg-ink-deep/50 peer-checked:block lg:hidden print:hidden"></label>

<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 flex w-[248px] -translate-x-full flex-col border-r border-[#e7ebf2] bg-white transition-transform duration-200 peer-checked:translate-x-0 lg:translate-x-0 print:hidden">
    <div class="h-1 bg-brand"></div>
    <div class="flex h-16 items-center justify-between px-4">
        <a href="{{ route('petugas.dashboard') }}" class="flex items-center gap-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
            <img src="{{ asset('images/logo-findit.svg') }}" alt="Logo FindIT" class="h-8 w-auto object-contain">
            <span class="text-base font-bold leading-tight tracking-tight text-ink">Find<span class="text-brand">IT</span></span>
        </a>
        <label for="sidebar-toggle" role="button" tabindex="0" aria-label="Tutup sidebar"
            class="flex h-9 w-9 cursor-pointer items-center justify-center rounded-lg text-ink-muted transition-colors hover:bg-[#f3f5f8] hover:text-ink focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30 lg:hidden">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </label>
    </div>

    <nav class="flex-1 space-y-6 overflow-y-auto px-3 py-3">
        @foreach ($sections as $heading => $links)
            <div>
                <p class="px-3 pb-2 text-xs font-medium text-ink-muted">{{ $heading }}</p>
                <div class="space-y-1">
                    @foreach ($links as [$route, $pattern, $label, $path])
                        @php
                            $active = request()->routeIs($pattern);
                        @endphp
                        <a href="{{ route($route) }}"
                            class="{{ $linkBase }} {{ $active ? 'bg-brand-soft font-semibold text-brand' : 'font-medium text-[#3d4b60] hover:bg-[#f3f5f8] hover:text-ink' }}">
                            <svg class="h-[18px] w-[18px] shrink-0 transition-transform duration-150 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}" /></svg>
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </nav>

    <div class="space-y-1 border-t border-[#e7ebf2] p-3">
        @foreach ($footerLinks as [$route, $pattern, $label, $path])
            @php
                $active = $pattern && request()->routeIs($pattern);
            @endphp
            <a href="{{ route($route) }}"
                class="{{ $linkBase }} {{ $active ? 'bg-brand-soft font-semibold text-brand' : 'font-medium text-[#3d4b60] hover:bg-[#f3f5f8] hover:text-ink' }}">
                <svg class="h-[18px] w-[18px] shrink-0 transition-transform duration-150 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}" /></svg>
                {{ $label }}
            </a>
        @endforeach
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="{{ $linkBase }} w-full font-medium text-brand hover:bg-brand-soft focus-visible:ring-brand/30">
                <svg class="h-[18px] w-[18px] shrink-0 transition-transform duration-150 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" /></svg>
                Keluar
            </button>
        </form>
    </div>
</aside>
