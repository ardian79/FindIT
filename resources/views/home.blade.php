@extends('layouts.app')

@section('title', 'FindIT - Lost & Found Universitas Jember')

@section('content')
    @php
        $toWa = fn(?string $hp) => $hp ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $hp)) : '';
        $waPetugas = $toWa($petugas?->no_hp);

        $isHilang = $tab === 'hilang';
        $activeTab = $isHilang ? 'hilang' : 'temuan';
        $tabQuery = request()->except(['page_temuan', 'page_hilang']);
        $temuanUrl = route('home', [...$tabQuery, 'tab' => 'temuan']);
        $hilangUrl = route('home', [...$tabQuery, 'tab' => 'hilang']);

        $isPetugas = auth()->check() && auth()->user()->role !== 'mahasiswa';
        $laporUrl = auth()->check() ? route('mahasiswa.laporan.index') : route('login');

        $container = 'mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8';
        $eyebrow = 'text-xs font-semibold text-brand';
        $btnBase =
            'inline-flex items-center justify-center gap-2 border px-5 py-2.5 text-sm font-medium leading-tight transition duration-150 hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]';
        $btnHeroBrand = "$btnBase rounded-full border-transparent bg-brand px-6 py-3 font-semibold text-white hover:bg-brand-dark focus-visible:ring-brand";
        $btnHeroWhite = "$btnBase rounded-full border-transparent bg-white px-6 py-3 font-semibold text-ink-navy hover:bg-[#f4f6f8] focus-visible:ring-white";
        $btnBrand = "$btnBase rounded-xl border-transparent bg-brand text-white hover:bg-brand-dark focus-visible:ring-brand";
        $btnNavy = "$btnBase rounded-xl border-transparent bg-ink-navy text-white hover:bg-ink-deep focus-visible:ring-ink-navy";
        $btnOutline = "$btnBase rounded-xl border-[#d7dde7] bg-white text-ink hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:ring-ink-navy/30";

        $stats = [
            [$totalTersedia, 'Barang temuan tersedia'],
            [$totalDicari, 'Laporan sedang dicari'],
            [$totalDikembalikan, 'Barang sudah kembali'],
        ];

        $steps = [
            [
                'bg-brand',
                'Laporkan kehilangan',
                'Catat nama barang, lokasi perkiraan, tanggal, dan ciri khusus agar mudah dicocokkan.',
            ],
            [
                'bg-ink-navy',
                'Cari di katalog',
                'Telusuri barang temuan dan laporan hilang dengan kata kunci serta kategori.',
            ],
            [
                'bg-brand',
                'Verifikasi dan ambil',
                'Ajukan klaim, tunggu persetujuan petugas, lalu ambil barang di Pos Keamanan Utama.',
            ],
        ];

        $features = [
            'Filter kategori dan kata kunci memakai pencarian yang sudah ada.',
            'Mahasiswa mengajukan klaim dengan ciri kepemilikan.',
            'Petugas memverifikasi lalu mencatat serah terima di pos keamanan.',
        ];

        $paginator = $isHilang ? $laporanKehilangan : $barangTemuan;
        $isPaginator = $paginator instanceof \Illuminate\Pagination\AbstractPaginator;
        $items = ($isPaginator ? $paginator->getCollection() : collect($paginator))->take(3);
        $currPage = $isPaginator ? $paginator->currentPage() : 1;
        $lastPage = $isPaginator ? $paginator->lastPage() : 1;
        $pageName = $isPaginator ? $paginator->getPageName() : 'page';
        $pageUrl = fn(int $p) => route('home', [...request()->except($pageName), 'tab' => $activeTab, $pageName => $p]);
    @endphp

    <section class="relative isolate -mt-[80px] overflow-hidden bg-ink-deep text-white">
        <img src="{{ asset('images/banner-unej.svg') }}" alt="Layanan Lost & Found Universitas Jember"
            class="absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-ink-deep/75 via-ink-deep/70 to-ink-deep/85"></div>

        <div
            class="{{ $container }} relative z-10 flex min-h-[520px] flex-col items-center justify-center py-20 text-center sm:min-h-[580px] sm:py-24">
            <h1
                class="mt-4 max-w-3xl font-heading text-4xl font-bold leading-[1.08] tracking-tight sm:text-5xl lg:text-[56px]">
                Temukan Kembali Barang Berharga Anda di UNEJ
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-white/85 sm:text-base">
                Layanan resmi untuk melaporkan kehilangan dan menemukan barang temuan secara terverifikasi.
            </p>
            <div class="mt-8 flex w-full flex-col items-stretch justify-center gap-3 sm:w-auto sm:flex-row sm:items-center">
                <a href="{{ $temuanUrl }}#katalog" data-open-catalog-temuan class="{{ $btnHeroBrand }}">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    Cari Barang
                </a>
                <a href="{{ $isPetugas ? route('petugas.dashboard') : $laporUrl }}" class="{{ $btnHeroWhite }}">
                    {{ $isPetugas ? 'Buka Panel Petugas' : 'Laporkan Kehilangan' }}
                </a>
            </div>
        </div>
    </section>

    <section class="{{ $container }} relative z-20 -mt-8">
        <div
            class="grid grid-cols-1 gap-3 rounded-2xl border border-[#e7ebf2] bg-white p-3 shadow-card sm:grid-cols-3 sm:p-4">
            @foreach ($stats as [$total, $label])
                <div class="rounded-xl bg-[#f7f8fb] px-5 py-4">
                    <p class="text-2xl font-semibold tabular-nums text-ink">{{ $total }}</p>
                    <p class="mt-1 text-sm text-ink-muted">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section id="cara-kerja" class="scroll-mt-[96px] py-16 lg:py-20">
        <div class="{{ $container }}">
            <div class="mx-auto max-w-2xl text-center">
                <p class="{{ $eyebrow }}">Cara kerja</p>
                <h2 class="mt-2 font-heading text-2xl font-semibold tracking-tight text-ink sm:text-3xl lg:text-4xl">
                    Satu alur dari laporan sampai serah terima
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-ink-muted">
                    Tiga langkah mudah yang diverifikasi langsung oleh Pos Keamanan Universitas Jember.
                </p>
            </div>
            <div class="mt-10 grid grid-cols-1 gap-4 md:grid-cols-3">
                @foreach ($steps as $i => [$badgeBg, $title, $desc])
                    <article class="rounded-2xl border border-[#e7ebf2] bg-white p-6 transition duration-200 hover:-translate-y-0.5 hover:border-[#cfd6e2] hover:shadow-card sm:p-8">
                        <span
                            class="flex h-10 w-10 items-center justify-center rounded-xl {{ $badgeBg }} text-sm font-semibold tabular-nums text-white">{{ $i + 1 }}</span>
                        <h3 class="mt-6 font-heading text-lg font-semibold text-ink">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-7 text-ink-muted">{{ $desc }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="{{ $container }} grid items-center gap-10 py-16 lg:grid-cols-2 lg:py-20">
            <div class="group overflow-hidden rounded-2xl border border-[#e7ebf2] bg-[#f3f5f8] transition duration-200 hover:-translate-y-0.5 hover:border-[#cfd6e2] hover:shadow-card">
                <img src="{{ asset('images/campus-activity.svg') }}" alt="Ilustrasi pencarian barang FindIT"
                    class="aspect-[4/3] w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]">
            </div>
            <div>
                <p class="{{ $eyebrow }}">Pencarian yang terarah</p>
                <h2 class="mt-2 font-heading text-3xl font-semibold tracking-tight text-ink sm:text-4xl">
                    Temukan barang lewat katalog yang mudah dipindai
                </h2>
                <p class="mt-4 text-sm leading-7 text-ink-muted">
                    Setiap kartu menampilkan foto, kategori, lokasi, tanggal, dan status. Detail serta pengajuan klaim tetap
                    dibuka dari kartu barang.
                </p>
                <ul class="mt-6 space-y-3 text-sm text-[#3d4b60]">
                    @foreach ($features as $i => $text)
                        <li class="flex gap-3">
                            <span
                                class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-brand-soft text-xs font-semibold tabular-nums text-brand-dark">{{ $i + 1 }}</span>
                            <span>{{ $text }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section id="lokasi" class="scroll-mt-[96px] bg-[#f7f8fb] py-16 lg:py-20">
        <div class="{{ $container }}">
            <div class="mx-auto mb-8 max-w-2xl text-center">
                <p class="{{ $eyebrow }}">Lokasi layanan</p>
                <h2 class="mt-2 font-heading text-3xl font-semibold tracking-tight text-ink sm:text-4xl">
                    Pos Keamanan Universitas Jember
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-ink-muted">
                    Lokasi penyerahan dan pengambilan barang temuan yang telah diverifikasi.
                </p>
            </div>

            <div
                class="grid overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white shadow-card lg:grid-cols-[.9fr_1.1fr]">
                <div class="flex flex-col justify-between p-6 sm:p-8">
                    <div class="space-y-5">
                        <div>
                            <p class="text-xs font-medium text-ink-muted">Alamat</p>
                            <p class="mt-1 text-sm leading-7 text-ink">Fakultas Ilmu Komputer UNEJ, Jl. Kalimantan No. 37,
                                Kampus Tegal Boto, Jember</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-ink-muted">Jam operasional</p>
                            <p class="mt-1 text-sm leading-7 tabular-nums text-ink">Senin - Jumat, 08.00 - 16.00 WIB</p>
                        </div>
                        <div class="rounded-xl bg-[#f7f8fb] p-4">
                            <p class="text-sm font-semibold text-ink">Penyerahan &amp; Pengambilan Barang</p>
                            <p class="mt-1 text-sm leading-6 text-ink-muted">
                                Barang temuan diserahkan dan diambil melalui Pos Keamanan Universitas Jember setelah proses
                                verifikasi selesai dilakukan.
                            </p>
                        </div>
                    </div>

                    <a href="https://maps.app.goo.gl/fjzb7GHBkVuGzDsK9" target="_blank" rel="noopener"
                        class="{{ $btnBrand }} mt-6 min-h-11 w-full">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        Lihat Lokasi di Google Maps
                    </a>
                </div>

                <div
                    class="min-h-[300px] border-t border-[#e7ebf2] bg-[#eef1f5] sm:min-h-[360px] lg:min-h-[420px] lg:border-l lg:border-t-0">
                    <iframe src="https://maps.google.com/maps?q=-8.1659263,113.7144346&t=&z=17&ie=UTF8&iwloc=&output=embed"
                        title="Peta Lokasi Pos Keamanan Utama Universitas Jember"
                        class="h-full min-h-[300px] w-full border-0 sm:min-h-[360px] lg:min-h-[420px]" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <section id="katalog" class="scroll-mt-[96px] py-16 lg:py-20">
        <div class="{{ $container }}">
            <div class="mx-auto mb-8 max-w-2xl text-center">
                <p class="{{ $eyebrow }}">Katalog</p>
                <h2 class="mt-2 font-heading text-3xl font-semibold tracking-tight text-ink sm:text-4xl">
                    Barang temuan dan laporan hilang
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-ink-muted">
                    Gunakan pencarian dan kategori untuk menemukan barang temuan atau barang hilang.
                </p>
            </div>

            <div class="relative z-20 rounded-2xl border border-[#e7ebf2] bg-white p-4 sm:p-5">
                <div id="catalog-tabs" class="relative mx-auto flex max-w-lg rounded-full bg-[#f3f5f8] p-1"
                    data-active-tab="{{ $activeTab }}">
                    <span id="catalog-tab-indicator" aria-hidden="true"
                        class="pointer-events-none absolute top-1 {{ $isHilang ? 'left-1/2' : 'left-1' }} h-[calc(100%-8px)] w-[calc(50%-4px)] rounded-full bg-ink-navy transition-[left] duration-300 ease-[cubic-bezier(.22,1,.36,1)]"></span>
                    @foreach (['temuan' => ['Barang Temuan', $temuanUrl], 'hilang' => ['Barang Hilang', $hilangUrl]] as $key => [$label, $url])
                        <a href="{{ $url }}" data-catalog-tab="{{ $key }}"
                            class="relative z-[1] flex-1 rounded-full px-4 py-2 text-center text-sm font-medium transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/40 {{ $activeTab === $key ? 'text-white' : 'text-ink-navy' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>

                <form action="{{ route('home') }}" method="GET" class="mt-4 flex flex-col gap-3 lg:flex-row">
                    <input type="hidden" name="tab" value="{{ $activeTab }}">
                    <div class="relative flex-1">
                        <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-muted"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama barang, lokasi, atau deskripsi"
                            class="w-full rounded-xl border border-[#d7dde7] bg-white py-2.5 pl-10 pr-3.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
                    </div>
                    <select name="kategori_id"
                        class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 pr-10 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10 lg:w-52">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}" @selected(request('kategori_id') == $kat->id)>{{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="{{ $btnBrand }}">Cari</button>
                    @if (request()->filled('search') || request()->filled('kategori_id'))
                        <a href="{{ route('home', ['tab' => $activeTab]) }}" class="{{ $btnOutline }}">Reset</a>
                    @endif
                </form>
            </div>

            @if ($items->isEmpty())
                <div class="mt-6 rounded-2xl border border-dashed border-[#d7dde7] bg-white p-14 text-center">
                    <h3 class="text-base font-semibold text-ink">
                        {{ $isHilang ? 'Belum ada laporan barang hilang yang sesuai' : 'Belum ada barang temuan yang sesuai' }}
                    </h3>
                    <p class="mt-1 text-sm text-ink-muted">
                        {{ $isHilang ? 'Semua laporan kehilangan yang sedang dicari akan tampil di sini.' : 'Coba ubah kata kunci pencarian atau periksa kembali nanti.' }}
                    </p>
                </div>
            @else
                <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($items as $item)
                        @php
                            $katNama = $item->kategori?->nama_kategori ?? 'Umum';
                            $fotoUrl = $item->foto_barang ? asset('storage/' . $item->foto_barang) : '';
                            $lokasi = $isHilang ? $item->lokasi_hilang : $item->lokasi_ditemukan;
                            $tanggal = ($isHilang ? $item->tanggal_hilang : $item->tanggal_ditemukan)->format('d M Y');
                            $pelapor = $isHilang ? $item->pengguna?->nama ?? '-' : '';
                        @endphp
                        <article
                            class="group flex flex-col overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white transition duration-200 hover:-translate-y-1 hover:border-[#cfd6e2] hover:shadow-card">
                            <div
                                class="relative flex aspect-[16/10] items-center justify-center overflow-hidden bg-[#eef1f5]">
                                @if ($fotoUrl)
                                    <img src="{{ $fotoUrl }}" alt="{{ $item->nama_barang }}"
                                        class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]">
                                @else
                                    <span class="text-xs font-medium text-ink-muted">Tanpa foto</span>
                                @endif
                                <span
                                    class="absolute left-3 top-3 rounded-lg bg-white/95 px-2.5 py-1 text-xs font-medium text-ink shadow-sm">{{ $katNama }}</span>
                                <span
                                    class="absolute right-3 top-3 rounded-lg px-2.5 py-1 text-xs font-medium {{ $isHilang ? 'bg-brand-soft text-brand-dark' : 'bg-ink-navy text-white' }}">
                                    {{ $isHilang ? 'Dicari' : 'Tersedia' }}
                                </span>
                            </div>
                            <div class="flex flex-1 flex-col p-5">
                                <h3 class="text-base font-semibold text-ink">{{ $item->nama_barang }}</h3>
                                <div class="mt-2 space-y-1 text-xs text-ink-muted">
                                    <p class="truncate">{{ $lokasi }}</p>
                                    <p class="tabular-nums">{{ $isHilang ? 'Hilang' : 'Ditemukan' }} {{ $tanggal }}
                                    </p>
                                    @if ($isHilang)
                                        <p class="truncate">Pelapor: {{ $pelapor }}</p>
                                    @endif
                                </div>
                                <p class="mt-3 line-clamp-2 flex-1 text-sm leading-6 text-[#3d4b60]">
                                    {{ $item->deskripsi }}</p>
                                <button type="button" data-modal="{{ $activeTab }}" data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama_barang }}" data-kategori="{{ $katNama }}"
                                    data-lokasi="{{ $lokasi }}" data-tanggal="{{ $tanggal }}"
                                    data-deskripsi="{{ $item->deskripsi }}" data-foto="{{ $fotoUrl }}"
                                    data-pelapor="{{ $pelapor }}"
                                    data-wa="{{ $isHilang ? $toWa($item->pengguna?->no_hp) : '' }}"
                                    class="{{ $isHilang ? $btnOutline : $btnNavy }} mt-4 w-full">
                                    Lihat Detail
                                </button>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($lastPage > 1)
                    @php
                        $pageBtn =
                            'inline-flex h-10 items-center justify-center gap-1 rounded-xl border border-[#d7dde7] bg-white px-4 text-xs font-medium text-ink transition duration-150 hover:-translate-y-0.5 hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30';
                        $window = 5;
                        $startPage = min($currPage, max(1, $lastPage - $window + 1));
                        $endPage = min($lastPage, $startPage + $window - 1);
                    @endphp
                    <nav aria-label="Navigasi halaman barang {{ $activeTab }}"
                        class="mt-8 flex flex-wrap items-center justify-center gap-2">
                        @if ($currPage > 1)
                            <a href="{{ $pageUrl($currPage - 1) }}" class="{{ $pageBtn }}">&lsaquo; Prev</a>
                        @endif

                        @if ($startPage > 1)
                            <span
                                class="inline-flex h-10 select-none items-center justify-center px-1.5 text-xs font-semibold text-ink-muted"
                                aria-hidden="true">&hellip;</span>
                        @endif

                        @for ($p = $startPage; $p <= $endPage; $p++)
                            <a href="{{ $pageUrl($p) }}" @if ($p === $currPage) aria-current="page" @endif
                                class="inline-flex h-10 min-w-10 items-center justify-center rounded-xl px-3 text-xs font-semibold tabular-nums transition duration-150 hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 {{ $p === $currPage ? 'bg-brand text-white hover:bg-brand-dark focus-visible:ring-brand/40' : 'border border-[#e7ebf2] bg-white text-ink hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:ring-ink-navy/30' }}">
                                {{ $p }}
                            </a>
                        @endfor

                        @if ($endPage < $lastPage)
                            <span
                                class="inline-flex h-10 select-none items-center justify-center px-1.5 text-xs font-semibold text-ink-muted"
                                aria-hidden="true">&hellip;</span>
                        @endif

                        @if ($currPage < $lastPage)
                            <a href="{{ $pageUrl($currPage + 1) }}" class="{{ $pageBtn }}">Next &rsaquo;</a>
                        @endif
                    </nav>
                @endif
            @endif
        </div>
    </section>

    <section class="{{ $container }} pb-16">
        <div class="overflow-hidden rounded-2xl bg-brand px-6 py-10 text-white sm:px-10 lg:px-12">
            <div class="grid items-center gap-8 lg:grid-cols-[1fr_auto]">
                <div>
                    <p class="text-xs font-medium text-white/80">Pos Keamanan Utama UNEJ</p>
                    <h2 class="mt-2 max-w-2xl font-heading text-2xl font-semibold leading-tight sm:text-3xl">
                        Mulai cari, atau laporkan barang yang hilang hari ini
                    </h2>
                    <p class="mt-3 max-w-xl text-sm leading-7 text-white/85">
                        Pengambilan barang dilakukan di Pos Keamanan Utama Universitas Jember dengan identitas resmi.
                    </p>
                    @if ($waPetugas)
                        <a href="https://wa.me/{{ $waPetugas }}" target="_blank" rel="noopener"
                            class="mt-4 inline-flex text-sm font-medium text-white underline decoration-white/50 underline-offset-4 hover:decoration-white">
                            Hubungi petugas jaga
                        </a>
                    @endif
                </div>
                <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
                    <a href="{{ $temuanUrl }}#katalog" data-open-catalog-temuan class="{{ $btnHeroWhite }}">Cari
                        Barang</a>
                    @unless ($isPetugas)
                        <a href="{{ $laporUrl }}"
                            class="{{ $btnBase }} rounded-full border-white/40 bg-transparent px-6 py-3 font-semibold text-white hover:bg-white/10 focus-visible:ring-white">
                            Laporkan Kehilangan
                        </a>
                    @endunless
                </div>
            </div>
        </div>
    </section>

    @php
        $dialogClass =
            'm-0 mt-auto max-h-[92vh] w-full max-w-full overflow-y-auto rounded-t-2xl border border-[#e7ebf2] bg-white p-0 text-left backdrop:bg-ink-deep/60 sm:m-auto sm:w-[calc(100%-2rem)] sm:rounded-2xl';
        $closeBtnClass =
            'flex h-9 w-9 items-center justify-center rounded-lg text-ink-muted transition-colors duration-150 hover:bg-[#f3f5f8] hover:text-ink focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30';
    @endphp

    <dialog id="modal-temuan" closedby="any" aria-labelledby="temuan-nama" class="{{ $dialogClass }} sm:max-w-2xl">
        <div
            class="sticky top-0 z-10 flex items-start justify-between gap-4 border-b border-[#e7ebf2] bg-white px-5 py-4 sm:px-6">
            <div>
                <span id="temuan-kategori" class="text-xs font-medium text-brand-dark"></span>
                <h3 id="temuan-nama" class="mt-0.5 text-lg font-semibold text-ink"></h3>
            </div>
            <button type="button" onclick="this.closest('dialog').close()" class="{{ $closeBtnClass }}"
                aria-label="Tutup">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-5 sm:p-6">
            <div class="overflow-hidden rounded-xl bg-[#eef1f5]">
                <img id="temuan-foto" src="" alt="" class="max-h-80 w-full object-contain">
            </div>
            <div class="mt-4 grid grid-cols-1 gap-3 rounded-xl bg-[#f7f8fb] p-4 text-sm sm:grid-cols-2">
                <div><span class="block text-xs text-ink-muted">Lokasi ditemukan</span><span id="temuan-lokasi"
                        class="font-medium text-ink"></span></div>
                <div><span class="block text-xs text-ink-muted">Tanggal ditemukan</span><span id="temuan-tanggal"
                        class="font-medium tabular-nums text-ink"></span></div>
                <div class="sm:col-span-2"><span class="block text-xs text-ink-muted">Lokasi penyimpanan</span><span
                        class="font-medium text-ink-navy">Pos Keamanan Universitas Jember</span></div>
            </div>
            <div class="mt-4">
                <h4 class="text-xs font-medium text-ink-muted">Deskripsi barang</h4>
                <p id="temuan-deskripsi" class="mt-1.5 whitespace-pre-line text-sm leading-7 text-[#3d4b60]"></p>
            </div>
            <div class="mt-6 border-t border-[#e7ebf2] pt-5">
                @auth
                    @if ($isPetugas)
                        <div
                            class="flex flex-col gap-3 rounded-xl bg-[#f7f8fb] p-4 text-sm text-[#3d4b60] sm:flex-row sm:items-center sm:justify-between">
                            <span>Anda masuk sebagai petugas keamanan.</span>
                            <a href="{{ route('petugas.barang-temuan.index') }}"
                                class="font-medium text-ink-navy underline underline-offset-4 hover:text-brand">Kelola barang
                                temuan</a>
                        </div>
                    @else
                        <h4 class="text-sm font-semibold text-ink">Ajukan klaim kepemilikan</h4>
                        <p class="mt-1 text-xs leading-5 text-ink-muted">Jelaskan ciri khusus barang agar petugas dapat
                            mencocokkan kepemilikan.</p>
                        <form id="form-klaim" action="" method="POST" class="mt-3 space-y-3">
                            @csrf
                            <textarea name="keterangan_klaim" rows="3" required
                                placeholder="Tuliskan ciri spesifik atau bukti kepemilikan barang"
                                class="min-h-24 w-full resize-y rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10"></textarea>
                            <div class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                                <button type="button" onclick="this.closest('dialog').close()"
                                    class="{{ $btnOutline }}">Batal</button>
                                <button type="submit" class="{{ $btnBrand }}">Kirim Pengajuan Klaim</button>
                            </div>
                        </form>
                    @endif
                @else
                    <div
                        class="flex flex-col items-start justify-between gap-3 rounded-xl bg-[#f7f8fb] p-4 sm:flex-row sm:items-center">
                        <p class="text-sm text-ink">Masuk dengan akun mahasiswa untuk mengajukan klaim.</p>
                        <a href="{{ route('login') }}" class="{{ $btnBrand }} px-4 py-2 text-xs">Masuk</a>
                    </div>
                @endauth
            </div>
        </div>
    </dialog>

    <dialog id="modal-hilang" closedby="any" aria-labelledby="hilang-nama" class="{{ $dialogClass }} sm:max-w-xl">
        <div
            class="sticky top-0 z-10 flex items-start justify-between gap-4 border-b border-[#e7ebf2] bg-white px-5 py-4 sm:px-6">
            <div>
                <span id="hilang-kategori" class="text-xs font-medium text-brand-dark"></span>
                <h3 id="hilang-nama" class="mt-0.5 text-lg font-semibold text-ink"></h3>
            </div>
            <button type="button" onclick="this.closest('dialog').close()" class="{{ $closeBtnClass }}"
                aria-label="Tutup">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-5 sm:p-6">
            <div id="hilang-foto-wrapper"
                class="mb-4 hidden overflow-hidden rounded-xl border border-[#e7ebf2] bg-[#eef1f5]">
                <img id="hilang-foto" src="" alt="" class="max-h-80 w-full object-contain">
            </div>
            <div class="grid grid-cols-1 gap-3 rounded-xl bg-[#f7f8fb] p-4 text-sm sm:grid-cols-2">
                <div><span class="block text-xs text-ink-muted">Perkiraan lokasi hilang</span><span id="hilang-lokasi"
                        class="font-medium text-ink"></span></div>
                <div><span class="block text-xs text-ink-muted">Tanggal hilang</span><span id="hilang-tanggal"
                        class="font-medium tabular-nums text-ink"></span></div>
                <div class="sm:col-span-2"><span class="block text-xs text-ink-muted">Pelapor</span><span
                        id="hilang-pelapor" class="font-medium text-ink"></span></div>
            </div>
            <div class="mt-4">
                <h4 class="text-xs font-medium text-ink-muted">Deskripsi dan ciri-ciri</h4>
                <p id="hilang-deskripsi" class="mt-1.5 whitespace-pre-line text-sm leading-7 text-[#3d4b60]"></p>
            </div>
            <div class="mt-6 flex flex-col gap-2 border-t border-[#e7ebf2] pt-4 sm:flex-row sm:justify-end">
                <button type="button" onclick="this.closest('dialog').close()"
                    class="{{ $btnOutline }}">Tutup</button>
                <a id="hilang-wa-link" href="#" target="_blank" rel="noopener"
                    class="{{ $btnBase }} hidden rounded-xl border-transparent bg-[#25D366] text-white hover:bg-[#1fb85a] focus-visible:ring-[#25D366]">
                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path
                            d="M20.52 3.48A11.86 11.86 0 0012.07 0C5.52 0 .18 5.33.18 11.89c0 2.1.55 4.15 1.59 5.95L.11 24l6.3-1.65a11.87 11.87 0 005.65 1.44h.01c6.55 0 11.89-5.33 11.89-11.89a11.8 11.8 0 00-3.44-8.42zm-8.45 18.28h-.01a9.86 9.86 0 01-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.38a9.83 9.83 0 01-1.51-5.24c0-5.44 4.43-9.87 9.88-9.87a9.8 9.8 0 019.87 9.87c0 5.45-4.43 9.88-9.86 9.88zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.39-1.48-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.21 5.09 4.5.71.31 1.27.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.07-.12-.27-.2-.57-.35z" />
                    </svg>
                    <span>Hubungi Pelapor via WhatsApp</span>
                </a>
            </div>
        </div>
    </dialog>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const katalog = document.getElementById('katalog');
            const klaimUrl = @json(route('mahasiswa.klaim.store', ['barangTemuan' => '__ID__']));
            const reducedMotion = () => matchMedia('(prefers-reduced-motion: reduce)').matches;
            const hasModKey = (e) => e.ctrlKey || e.metaKey || e.shiftKey || e.altKey;

            const setTabIndicator = (tab) => {
                const indicator = document.getElementById('catalog-tab-indicator');
                if (!indicator) return;
                indicator.classList.toggle('left-1', tab === 'temuan');
                indicator.classList.toggle('left-1/2', tab === 'hilang');
            };

            const fetchCatalog = async (url, pushHistory = true, preserveScroll = true) => {
                const y = scrollY;
                katalog.setAttribute('aria-busy', 'true');
                katalog.classList.add('opacity-95');

                try {
                    const res = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            Accept: 'text/html'
                        }
                    });
                    if (!res.ok) return location.assign(url);

                    const next = new DOMParser().parseFromString(await res.text(), 'text/html')
                        .getElementById('katalog');
                    if (!next) return location.assign(url);

                    katalog.innerHTML = next.innerHTML;
                    if (pushHistory) history.pushState({
                        catalog: true
                    }, '', url);
                    if (preserveScroll) scrollTo(0, y);
                    if (!reducedMotion()) {
                        katalog.animate([{
                            opacity: .82,
                            transform: 'translateY(4px)'
                        }, {
                            opacity: 1,
                            transform: 'none'
                        }], {
                            duration: 240,
                            easing: 'cubic-bezier(.22, 1, .36, 1)'
                        });
                    }
                } catch {
                    location.assign(url);
                } finally {
                    katalog.classList.remove('opacity-95');
                    katalog.removeAttribute('aria-busy');
                }
            };

            const openModal = (btn) => {
                const type = btn.dataset.modal;
                const d = btn.dataset;
                const fields = type === 'hilang' ?
                    ['nama', 'kategori', 'lokasi', 'tanggal', 'pelapor', 'deskripsi'] :
                    ['nama', 'kategori', 'lokasi', 'tanggal', 'deskripsi'];

                fields.forEach((f) => {
                    document.getElementById(`${type}-${f}`).textContent = d[f] ?? '';
                });

                const foto = document.getElementById(`${type}-foto`);
                foto.src = d.foto || '';
                foto.alt = d.nama || '';

                if (type === 'temuan') {
                    const form = document.getElementById('form-klaim');
                    if (form) form.action = klaimUrl.replace('__ID__', d.id);
                } else {
                    document.getElementById('hilang-foto-wrapper').classList.toggle('hidden', !d.foto);
                    const wa = document.getElementById('hilang-wa-link');
                    wa.classList.toggle('hidden', !d.wa);
                    if (d.wa) {
                        const msg = encodeURIComponent(
                            `Halo ${d.pelapor}, saya melihat laporan kehilangan "${d.nama}" di FindIT UNEJ.`
                            );
                        wa.href = `https://wa.me/${d.wa}?text=${msg}`;
                    }
                }

                document.getElementById(`modal-${type}`).showModal();
            };

            katalog?.addEventListener('click', (e) => {
                const modalBtn = e.target.closest('button[data-modal]');
                if (modalBtn) return openModal(modalBtn);

                const link = e.target.closest('a');
                if (!link?.href || hasModKey(e)) return;
                e.preventDefault();
                if (link.dataset.catalogTab) setTabIndicator(link.dataset.catalogTab);
                fetchCatalog(link.href);
            });

            katalog?.addEventListener('submit', (e) => {
                if (!(e.target instanceof HTMLFormElement)) return;
                e.preventDefault();
                const sep = e.target.action.includes('?') ? '&' : '?';
                fetchCatalog(e.target.action + sep + new URLSearchParams(new FormData(e.target)));
            });

            katalog?.addEventListener('change', (e) => {
                if (e.target.matches('select[name="kategori_id"]')) e.target.closest('form')
                ?.requestSubmit();
            });

            addEventListener('popstate', () => fetchCatalog(location.href, false));

            document.querySelectorAll('[data-open-catalog-temuan]').forEach((btn) => {
                btn.addEventListener('click', (e) => {
                    if (hasModKey(e)) return;
                    e.preventDefault();
                    setTabIndicator('temuan');
                    fetchCatalog(btn.getAttribute('href').replace(/#katalog$/, ''), true, false)
                        .then(() => {
                            katalog?.scrollIntoView({
                                behavior: reducedMotion() ? 'auto' : 'smooth',
                                block: 'start'
                            });
                        });
                });
            });

            if (!('closedBy' in HTMLDialogElement.prototype)) {
                const outside = (e, el) => {
                    const r = el.getBoundingClientRect();
                    return e.clientX < r.left || e.clientX > r.right || e.clientY < r.top || e.clientY > r
                        .bottom;
                };
                document.querySelectorAll('dialog[closedby="any"]').forEach((dialog) => {
                    let downOutside = false;
                    dialog.addEventListener('pointerdown', (e) => {
                        downOutside = outside(e, dialog);
                    });
                    dialog.addEventListener('pointerup', (e) => {
                        if (downOutside && outside(e, dialog)) dialog.close();
                    });
                });
            }
        });
    </script>
@endpush
