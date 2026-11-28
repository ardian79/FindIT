@extends('layouts.app')

@section('title', 'FindIT - Lost & Found Universitas Jember')

@section('content')
    <section id="beranda"
        class="relative isolate -mt-17 flex min-h-screen scroll-mt-0 items-center overflow-hidden bg-ink-deep text-white contain-[layout_paint]">
        <img src="{{ asset('images/banner-unej.webp') }}" alt="Layanan Lost & Found Universitas Jember" width="1920"
            height="1080" fetchpriority="high" decoding="async" class="fi-hero-bg absolute inset-0 h-full w-full object-cover">
        <div class="absolute inset-0 bg-linear-to-b from-ink-deep/75 via-ink-deep/65 to-ink-deep/85"></div>

        <div
            class="mx-auto flex w-full max-w-290 flex-col items-center justify-center px-4 pb-20 pt-25 text-center relative z-10 sm:px-6 lg:px-8">
            <h1
                class="fi-hero-in fi-hero-in-1 max-w-3xl font-heading text-4xl font-bold leading-[1.08] tracking-tight sm:text-5xl lg:text-[56px]">
                Temukan Kembali Barang Berharga Anda di UNEJ
            </h1>
            <p class="fi-hero-in fi-hero-in-2 mx-auto mt-5 max-w-2xl text-sm leading-7 text-white/85 sm:text-base">
                Layanan resmi untuk melaporkan kehilangan dan menemukan barang temuan secara&nbsp;terverifikasi.
            </p>
            <div
                class="fi-hero-in fi-hero-in-3 mt-8 flex w-full flex-col items-stretch justify-center gap-3 sm:w-auto sm:flex-row sm:items-center">
                <a href="#katalog"
                    class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-brand px-6 py-3 text-sm font-semibold leading-tight text-white transition duration-150 hover:-translate-y-0.5 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    Cari Barang
                </a>
                <a href="{{ auth()->check() && auth()->user()->role !== 'mahasiswa' ? route('petugas.dashboard') : (auth()->check() ? route('mahasiswa.laporan.index') : route('login')) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-white px-6 py-3 text-sm font-semibold leading-tight text-ink-navy transition duration-150 hover:-translate-y-0.5 hover:bg-[#f4f6f8] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">
                    {{ auth()->check() && auth()->user()->role !== 'mahasiswa' ? 'Buka Panel Petugas' : 'Laporkan Kehilangan' }}
                </a>
            </div>
        </div>
    </section>

    <section id="cara-kerja" class="scroll-mt-24 bg-white py-20 contain-[layout_style] lg:py-24">
        <div class="mx-auto w-full max-w-290 px-4 sm:px-6 lg:px-8">
            <div class="fi-reveal mx-auto max-w-2xl text-center">
                <p class="text-xs font-semibold text-brand">Cara kerja</p>
                <h2 class="mt-2 font-heading text-2xl font-semibold tracking-tight text-ink sm:text-3xl lg:text-4xl">
                    Satu alur dari laporan sampai serah terima
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-ink-muted">
                    Tiga langkah mudah yang diverifikasi langsung oleh Pos Keamanan Universitas Jember.
                </p>
            </div>
            <div class="mt-10 grid grid-cols-1 gap-4 md:grid-cols-3">
                <article
                    class="fi-reveal-scale fi-r1 rounded-2xl border border-[#e7ebf2] bg-[#f7f8fb] p-6 transition duration-200 hover:-translate-y-1 hover:border-[#cfd6e2] hover:bg-white hover:shadow-card sm:p-8">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand text-sm font-semibold tabular-nums text-white">1</span>
                    <h3 class="mt-6 font-heading text-lg font-semibold text-ink">Laporkan kehilangan</h3>
                    <p class="mt-2 text-sm leading-7 text-ink-muted">Catat nama barang, lokasi perkiraan, tanggal, dan ciri
                        khusus agar mudah dicocokkan.</p>
                </article>
                <article
                    class="fi-reveal-scale fi-r2 rounded-2xl border border-[#e7ebf2] bg-[#f7f8fb] p-6 transition duration-200 hover:-translate-y-1 hover:border-[#cfd6e2] hover:bg-white hover:shadow-card sm:p-8">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-ink-navy text-sm font-semibold tabular-nums text-white">2</span>
                    <h3 class="mt-6 font-heading text-lg font-semibold text-ink">Cari di katalog</h3>
                    <p class="mt-2 text-sm leading-7 text-ink-muted">Telusuri barang temuan dan laporan hilang dengan kata
                        kunci serta kategori.</p>
                </article>
                <article
                    class="fi-reveal-scale fi-r3 rounded-2xl border border-[#e7ebf2] bg-[#f7f8fb] p-6 transition duration-200 hover:-translate-y-1 hover:border-[#cfd6e2] hover:bg-white hover:shadow-card sm:p-8">
                    <span
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand text-sm font-semibold tabular-nums text-white">3</span>
                    <h3 class="mt-6 font-heading text-lg font-semibold text-ink">Verifikasi dan ambil</h3>
                    <p class="mt-2 text-sm leading-7 text-ink-muted">Ajukan klaim, tunggu persetujuan petugas, lalu ambil
                        barang di Pos Keamanan.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="overflow-x-clip bg-[#f5f6f8] contain-[layout_style]">
        <div class="mx-auto grid w-full max-w-290 items-center gap-10 px-4 py-20 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-24">
            <div
                class="fi-reveal-left group overflow-hidden rounded-2xl shadow-lift transition duration-300 hover:-translate-y-1 hover:shadow-[0_24px_50px_rgba(16,42,76,0.16)]">
                <img src="{{ asset('images/campus-activity.webp') }}" alt="Ilustrasi pencarian barang FindIT" width="1200"
                    height="801" loading="lazy" decoding="async"
                    class="aspect-4/3 w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]">
            </div>
            <div class="fi-reveal-right">
                <p class="text-xs font-semibold text-brand">Pencarian yang terarah</p>
                <h2 class="mt-2 font-heading text-3xl font-semibold tracking-tight text-ink sm:text-4xl">
                    Temukan barang lewat katalog yang mudah dipindai
                </h2>
                <p class="mt-4 text-sm leading-7 text-ink-muted">
                    Setiap kartu menampilkan foto, kategori, lokasi, tanggal, dan status. Detail serta pengajuan klaim tetap
                    dibuka dari kartu barang.
                </p>
                <ul class="mt-6 space-y-3 text-sm text-[#3d4b60]">
                    <li class="fi-reveal fi-r1 flex gap-3">
                        <span
                            class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-brand-soft text-xs font-semibold tabular-nums text-brand-dark">1</span>
                        <span>Filter kategori dan kata kunci memakai pencarian yang sudah ada.</span>
                    </li>
                    <li class="fi-reveal fi-r2 flex gap-3">
                        <span
                            class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-brand-soft text-xs font-semibold tabular-nums text-brand-dark">2</span>
                        <span>Mahasiswa mengajukan klaim dengan ciri kepemilikan.</span>
                    </li>
                    <li class="fi-reveal fi-r3 flex gap-3">
                        <span
                            class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-lg bg-brand-soft text-xs font-semibold tabular-nums text-brand-dark">3</span>
                        <span>Petugas memverifikasi lalu mencatat serah terima di pos keamanan.</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section id="lokasi" class="scroll-mt-24 overflow-x-clip bg-white py-20 contain-[layout_style] lg:py-24">
        <div class="mx-auto w-full max-w-290 px-4 sm:px-6 lg:px-8">
            <div class="fi-reveal mx-auto mb-8 max-w-2xl text-center">
                <p class="text-xs font-semibold text-brand">Lokasi layanan</p>
                <h2 class="mt-2 font-heading text-3xl font-semibold tracking-tight text-ink sm:text-4xl">
                    Pos Keamanan Universitas Jember
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-ink-muted">
                    Lokasi penyerahan dan pengambilan barang temuan yang telah diverifikasi.
                </p>
            </div>

            <div
                class="fi-reveal-scale grid overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white shadow-card lg:grid-cols-[.9fr_1.1fr]">
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
                        class="mt-6 inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-xl border border-transparent bg-brand px-5 py-2.5 text-sm font-medium leading-tight text-white transition duration-150 hover:-translate-y-0.5 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">
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
                    class="min-h-75 border-t border-[#e7ebf2] bg-[#eef1f5] contain-[layout_paint] sm:min-h-90 lg:min-h-105 lg:border-l lg:border-t-0">
                    <iframe src="https://maps.google.com/maps?q=-8.1659263,113.7144346&t=&z=17&ie=UTF8&iwloc=&output=embed"
                        title="Peta Lokasi Pos Keamanan Utama Universitas Jember"
                        class="h-full min-h-75 w-full border-0 sm:min-h-90 lg:min-h-105" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <section id="katalog" class="scroll-mt-24 bg-[#f5f6f8] py-20 contain-[layout_style] lg:py-24">
        <div class="mx-auto w-full max-w-290 px-4 sm:px-6 lg:px-8">
            <div class="fi-reveal mx-auto mb-8 max-w-2xl text-center">
                <p class="text-xs font-semibold text-brand">Katalog</p>
                <h2 class="mt-2 font-heading text-3xl font-semibold tracking-tight text-ink sm:text-4xl">
                    Barang temuan dan laporan hilang
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-ink-muted">
                    Gunakan pencarian dan kategori untuk menemukan barang temuan atau barang hilang.
                </p>
            </div>

            <div id="catalog-content">
                <div id="catalog-content-body">
                    <div
                        class="fi-reveal-scale relative z-20 rounded-2xl border border-[#e7ebf2] bg-white p-4 shadow-card sm:p-5">
                        <div id="catalog-tabs" class="relative mx-auto flex max-w-lg rounded-full bg-[#f3f5f8] p-1"
                            data-active-tab="{{ $tab === 'hilang' ? 'hilang' : 'temuan' }}">
                            <span id="catalog-tab-indicator" aria-hidden="true"
                                class="pointer-events-none absolute top-1 {{ $tab === 'hilang' ? 'left-1/2' : 'left-1' }} h-[calc(100%-8px)] w-[calc(50%-4px)] rounded-full bg-ink-navy transition-[left] duration-150 ease-[cubic-bezier(.22,1,.36,1)]"></span>
                            <a href="{{ route('home', [...request()->except(['page_temuan', 'page_hilang']), 'tab' => 'temuan']) }}"
                                hx-get="{{ route('home', [...request()->except(['page_temuan', 'page_hilang']), 'tab' => 'temuan']) }}"
                                hx-target="#catalog-content" hx-select="#catalog-content-body"
                                hx-swap="innerHTML show:none focus-scroll:false" hx-push-url="true"
                                data-catalog-tab="temuan"
                                class="relative z-1 flex-1 rounded-full px-4 py-2 text-center text-sm font-medium transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/40 {{ $tab === 'hilang' ? 'text-ink-navy' : 'text-white' }}">
                                Barang Temuan
                            </a>
                            <a href="{{ route('home', [...request()->except(['page_temuan', 'page_hilang']), 'tab' => 'hilang']) }}"
                                hx-get="{{ route('home', [...request()->except(['page_temuan', 'page_hilang']), 'tab' => 'hilang']) }}"
                                hx-target="#catalog-content" hx-select="#catalog-content-body"
                                hx-swap="innerHTML show:none focus-scroll:false" hx-push-url="true"
                                data-catalog-tab="hilang"
                                class="relative z-1 flex-1 rounded-full px-4 py-2 text-center text-sm font-medium transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/40 {{ $tab === 'hilang' ? 'text-white' : 'text-ink-navy' }}">
                                Barang Hilang
                            </a>
                        </div>

                        <form action="{{ route('home') }}" method="GET" hx-get="{{ route('home') }}"
                            hx-target="#catalog-content" hx-select="#catalog-content-body"
                            hx-swap="innerHTML show:none focus-scroll:false" hx-push-url="true"
                            class="mt-4 flex flex-col gap-3 lg:flex-row">
                            <input type="hidden" name="tab" value="{{ $tab === 'hilang' ? 'hilang' : 'temuan' }}">
                            <div class="relative flex-1">
                                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-muted"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari nama barang, lokasi, atau deskripsi"
                                    class="h-10.5 w-full rounded-xl border border-[#d7dde7] bg-white pl-10 pr-3.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
                            </div>
                            <select name="kategori_id" hx-get="{{ route('home') }}" hx-include="closest form"
                                hx-target="#catalog-content" hx-select="#catalog-content-body"
                                hx-swap="innerHTML show:none focus-scroll:false" hx-push-url="true"
                                class="h-10.5 w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10 lg:w-52">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}" @selected(request('kategori_id') == $kat->id)>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit"
                                class="inline-flex h-10.5 items-center justify-center gap-2 rounded-xl border border-transparent bg-brand px-5 py-2.5 text-sm font-medium leading-tight text-white transition duration-150 hover:-translate-y-0.5 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">Cari</button>
                            @if (request()->filled('search') || request()->filled('kategori_id'))
                                <a href="{{ route('home', ['tab' => $tab === 'hilang' ? 'hilang' : 'temuan']) }}"
                                    hx-get="{{ route('home', ['tab' => $tab === 'hilang' ? 'hilang' : 'temuan']) }}"
                                    hx-target="#catalog-content" hx-select="#catalog-content-body"
                                    hx-swap="innerHTML show:none focus-scroll:false" hx-push-url="true"
                                    class="inline-flex h-10.5 items-center justify-center gap-2 rounded-xl border border-[#d7dde7] bg-white px-5 py-2.5 text-sm font-medium leading-tight text-ink transition duration-150 hover:-translate-y-0.5 hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30 focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">Reset</a>
                            @endif
                        </form>
                    </div>

                    <div id="catalog-results" class="min-h-120 scroll-mt-24"
                        hx-on::after-swap="if (event.detail.requestConfig?.elt?.tagName === 'A' && this.getBoundingClientRect().top < 96) this.scrollIntoView({ block: 'start', behavior: matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth' })">
                        <div id="catalog-results-body">

                            @if (
                                (($tab === 'hilang' ? $laporanKehilangan : $barangTemuan) instanceof \Illuminate\Pagination\AbstractPaginator
                                    ? ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getCollection()
                                    : collect($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->take(3)
                                )->isEmpty())
                                <div
                                    class="mt-6 rounded-2xl border border-dashed border-[#d7dde7] bg-white p-14 text-center">
                                    <h3 class="text-base font-semibold text-ink">
                                        {{ $tab === 'hilang' ? 'Belum ada laporan barang hilang yang sesuai' : 'Belum ada barang temuan yang sesuai' }}
                                    </h3>
                                    <p class="mt-1 text-sm text-ink-muted">
                                        {{ $tab === 'hilang' ? 'Semua laporan kehilangan yang sedang dicari akan tampil di sini.' : 'Coba ubah kata kunci pencarian atau periksa kembali nanti.' }}
                                    </p>
                                </div>
                            @else
                                <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-3">
                                    @foreach (($tab === 'hilang' ? $laporanKehilangan : $barangTemuan) instanceof \Illuminate\Pagination\AbstractPaginator ? ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getCollection() : collect($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->take(3) as $item)
                                        <article
                                            class="group flex flex-col overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white transition duration-200 hover:-translate-y-1 hover:border-[#cfd6e2] hover:shadow-card">
                                            <div
                                                class="relative flex aspect-16/10 items-center justify-center overflow-hidden bg-[#eef1f5]">
                                                @if ($item->foto_barang)
                                                    <img src="{{ asset('storage/' . $item->foto_barang) }}"
                                                        alt="{{ $item->nama_barang }}" loading="lazy" decoding="async"
                                                        class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]">
                                                @else
                                                    <span class="text-xs font-medium text-ink-muted">Tanpa foto</span>
                                                @endif
                                                <span
                                                    class="absolute left-3 top-3 rounded-lg bg-white/95 px-2.5 py-1 text-xs font-medium text-ink shadow-sm">
                                                    {{ $item->kategori?->nama_kategori ?? 'Umum' }}
                                                </span>
                                                <span
                                                    class="absolute right-3 top-3 rounded-lg px-2.5 py-1 text-xs font-medium {{ $tab === 'hilang' ? 'bg-brand-soft text-brand-dark' : 'bg-ink-navy text-white' }}">
                                                    {{ $tab === 'hilang' ? 'Dicari' : 'Tersedia' }}
                                                </span>
                                            </div>
                                            <div class="flex flex-1 flex-col p-5">
                                                <h3 class="text-base font-semibold text-ink">{{ $item->nama_barang }}</h3>
                                                <div class="mt-2 space-y-1 text-xs text-ink-muted">
                                                    <p class="truncate">
                                                        {{ $tab === 'hilang' ? $item->lokasi_hilang : $item->lokasi_ditemukan }}
                                                    </p>
                                                    <p class="tabular-nums">
                                                        {{ $tab === 'hilang' ? 'Hilang' : 'Ditemukan' }}
                                                        {{ ($tab === 'hilang' ? $item->tanggal_hilang : $item->tanggal_ditemukan)->format('d M Y') }}
                                                    </p>
                                                    @if ($tab === 'hilang')
                                                        <p class="truncate">Pelapor: {{ $item->pengguna?->nama ?? '-' }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <p class="mt-3 line-clamp-2 flex-1 text-sm leading-6 text-[#3d4b60]">
                                                    {{ $item->deskripsi }}</p>
                                                <button type="button"
                                                    popovertarget="modal-{{ $tab === 'hilang' ? 'hilang' : 'temuan' }}-{{ $item->id }}"
                                                    class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-xl border px-5 py-2.5 text-sm font-medium leading-tight transition duration-150 hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98] {{ $tab === 'hilang' ? 'border-[#d7dde7] bg-white text-ink hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:ring-ink-navy/30' : 'border-transparent bg-ink-navy text-white hover:bg-ink-deep focus-visible:ring-ink-navy' }}">
                                                    Lihat Detail
                                                </button>
                                            </div>
                                        </article>
                                    @endforeach
                                </div>

                                @if (($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->lastPage() > 1)
                                    <nav aria-label="Navigasi halaman barang {{ $tab === 'hilang' ? 'hilang' : 'temuan' }}"
                                        hx-target="#catalog-results" hx-select="#catalog-results-body"
                                        hx-swap="innerHTML show:none focus-scroll:false" hx-push-url="true"
                                        class="mt-8 flex flex-wrap items-center justify-center gap-2">

                                        @if (($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage() > 1)
                                            <a href="{{ route('home', [
                                                ...request()->except(($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName()),
                                                'tab' => $tab === 'hilang' ? 'hilang' : 'temuan',
                                                ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName() =>
                                                    ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage() - 1,
                                            ]) }}"
                                                hx-get="{{ route('home', [
                                                    ...request()->except(($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName()),
                                                    'tab' => $tab === 'hilang' ? 'hilang' : 'temuan',
                                                    ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName() =>
                                                        ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage() - 1,
                                                ]) }}"
                                                class="inline-flex h-10 items-center justify-center gap-1 rounded-xl border border-[#d7dde7] bg-white px-4 text-xs font-medium text-ink transition duration-150 hover:-translate-y-0.5 hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">&lsaquo;
                                                Prev</a>
                                        @endif

                                        @if (min(
                                                ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage(),
                                                max(1, ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->lastPage() - 5 + 1)) > 1)
                                            <span
                                                class="inline-flex h-10 select-none items-center justify-center px-1.5 text-xs font-semibold text-ink-muted"
                                                aria-hidden="true">&hellip;</span>
                                        @endif

                                        @for ($p = min(($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage(), max(1, ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->lastPage() - 5 + 1)); $p <= min(($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->lastPage(), min(($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage(), max(1, ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->lastPage() - 5 + 1)) + 5 - 1); $p++)
                                            <a href="{{ route('home', [
                                                ...request()->except(($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName()),
                                                'tab' => $tab === 'hilang' ? 'hilang' : 'temuan',
                                                ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName() => $p,
                                            ]) }}"
                                                hx-get="{{ route('home', [
                                                    ...request()->except(($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName()),
                                                    'tab' => $tab === 'hilang' ? 'hilang' : 'temuan',
                                                    ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName() => $p,
                                                ]) }}"
                                                @if ($p === ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage()) aria-current="page" @endif
                                                class="inline-flex h-10 min-w-10 items-center justify-center rounded-xl px-3 text-xs font-semibold tabular-nums transition duration-150 hover:-translate-y-0.5 focus-visible:outline-none focus-visible:ring-2 {{ $p === ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage() ? 'bg-brand text-white hover:bg-brand-dark focus-visible:ring-brand/40' : 'border border-[#e7ebf2] bg-white text-ink hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:ring-ink-navy/30' }}">
                                                {{ $p }}
                                            </a>
                                        @endfor

                                        @if (min(
                                                ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage(),
                                                max(1, ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->lastPage() - 5 + 1)) +
                                                5 -
                                                1 <
                                                ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->lastPage())
                                            <span
                                                class="inline-flex h-10 select-none items-center justify-center px-1.5 text-xs font-semibold text-ink-muted"
                                                aria-hidden="true">&hellip;</span>
                                        @endif

                                        @if (
                                            ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage() <
                                                ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->lastPage())
                                            <a href="{{ route('home', [
                                                ...request()->except(($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName()),
                                                'tab' => $tab === 'hilang' ? 'hilang' : 'temuan',
                                                ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName() =>
                                                    ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage() + 1,
                                            ]) }}"
                                                hx-get="{{ route('home', [
                                                    ...request()->except(($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName()),
                                                    'tab' => $tab === 'hilang' ? 'hilang' : 'temuan',
                                                    ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getPageName() =>
                                                        ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->currentPage() + 1,
                                                ]) }}"
                                                class="inline-flex h-10 items-center justify-center gap-1 rounded-xl border border-[#d7dde7] bg-white px-4 text-xs font-medium text-ink transition duration-150 hover:-translate-y-0.5 hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Next
                                                &rsaquo;</a>
                                        @endif
                                    </nav>
                                @endif
                            @endif

                            @foreach (($tab === 'hilang' ? $laporanKehilangan : $barangTemuan) instanceof \Illuminate\Pagination\AbstractPaginator ? ($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->getCollection() : collect($tab === 'hilang' ? $laporanKehilangan : $barangTemuan)->take(3) as $item)
                                <div id="modal-{{ $tab === 'hilang' ? 'hilang' : 'temuan' }}-{{ $item->id }}" popover
                                    hx-boost="false"
                                    aria-labelledby="modal-{{ $tab === 'hilang' ? 'hilang' : 'temuan' }}-{{ $item->id }}-title"
                                    class="fi-detail-modal m-0 mt-auto max-h-[92vh] w-full max-w-full overflow-y-auto rounded-t-2xl border border-[#e7ebf2] bg-white p-0 text-left backdrop:bg-ink-deep/60 sm:m-auto sm:w-[calc(100%-2rem)] sm:rounded-2xl {{ $tab === 'hilang' ? 'sm:max-w-xl' : 'sm:max-w-2xl' }}">
                                    <div
                                        class="sticky top-0 z-10 flex items-start justify-between gap-4 border-b border-[#e7ebf2] bg-white px-5 py-4 sm:px-6">
                                        <div>
                                            <span class="text-xs font-medium text-brand-dark">
                                                {{ $item->kategori?->nama_kategori ?? 'Umum' }}
                                            </span>
                                            <h3 id="modal-{{ $tab === 'hilang' ? 'hilang' : 'temuan' }}-{{ $item->id }}-title"
                                                class="mt-0.5 text-lg font-semibold text-ink">{{ $item->nama_barang }}
                                            </h3>
                                        </div>
                                        <button type="button"
                                            popovertarget="modal-{{ $tab === 'hilang' ? 'hilang' : 'temuan' }}-{{ $item->id }}"
                                            popovertargetaction="hide"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg text-ink-muted transition-colors duration-150 hover:bg-[#f3f5f8] hover:text-ink focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30"
                                            aria-label="Tutup">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="p-5 sm:p-6">
                                        @if ($item->foto_barang)
                                            <div
                                                class="mb-4 overflow-hidden rounded-xl {{ $tab === 'hilang' ? 'border border-[#e7ebf2]' : '' }} bg-[#eef1f5]">
                                                <img src="{{ asset('storage/' . $item->foto_barang) }}"
                                                    alt="{{ $item->nama_barang }}" loading="lazy" decoding="async"
                                                    class="max-h-80 w-full object-contain">
                                            </div>
                                        @endif

                                        <div
                                            class="grid grid-cols-1 gap-3 rounded-xl bg-[#f7f8fb] p-4 text-sm sm:grid-cols-2">
                                            <div>
                                                <span class="block text-xs text-ink-muted">
                                                    {{ $tab === 'hilang' ? 'Perkiraan lokasi hilang' : 'Lokasi ditemukan' }}
                                                </span>
                                                <span class="font-medium text-ink">
                                                    {{ $tab === 'hilang' ? $item->lokasi_hilang : $item->lokasi_ditemukan }}
                                                </span>
                                            </div>
                                            <div>
                                                <span class="block text-xs text-ink-muted">
                                                    {{ $tab === 'hilang' ? 'Tanggal hilang' : 'Tanggal ditemukan' }}
                                                </span>
                                                <span class="font-medium tabular-nums text-ink">
                                                    {{ ($tab === 'hilang' ? $item->tanggal_hilang : $item->tanggal_ditemukan)->format('d M Y') }}
                                                </span>
                                            </div>
                                            <div class="sm:col-span-2">
                                                <span class="block text-xs text-ink-muted">
                                                    {{ $tab === 'hilang' ? 'Pelapor' : 'Lokasi penyimpanan' }}
                                                </span>
                                                <span
                                                    class="font-medium {{ $tab === 'hilang' ? 'text-ink' : 'text-ink-navy' }}">
                                                    {{ $tab === 'hilang' ? $item->pengguna?->nama ?? '-' : 'Pos Keamanan Universitas Jember' }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <h4 class="text-xs font-medium text-ink-muted">
                                                {{ $tab === 'hilang' ? 'Deskripsi dan ciri-ciri' : 'Deskripsi barang' }}
                                            </h4>
                                            <p class="mt-1.5 text-sm leading-7 text-[#3d4b60]">
                                                {!! nl2br(e(trim($item->deskripsi))) !!}
                                            </p>
                                        </div>

                                        @if ($tab === 'hilang')
                                            <div
                                                class="mt-6 flex flex-col gap-2 border-t border-[#e7ebf2] pt-4 sm:flex-row sm:justify-end">
                                                <button type="button"
                                                    popovertarget="modal-{{ $tab === 'hilang' ? 'hilang' : 'temuan' }}-{{ $item->id }}"
                                                    popovertargetaction="hide"
                                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#d7dde7] bg-white px-5 py-2.5 text-sm font-medium leading-tight text-ink transition duration-150 hover:-translate-y-0.5 hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30 focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">Tutup</button>

                                                @if ($item->pengguna?->no_hp)
                                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/\D/', '', $item->pengguna->no_hp)) }}?text={{ urlencode('Halo ' . ($item->pengguna?->nama ?? '-') . ', saya melihat laporan kehilangan "' . $item->nama_barang . '" di FindIT UNEJ.') }}"
                                                        target="_blank" rel="noopener"
                                                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-transparent bg-[#25D366] px-5 py-2.5 text-sm font-medium leading-tight text-white transition duration-150 hover:-translate-y-0.5 hover:bg-[#1fb85a] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#25D366] focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">
                                                        <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path
                                                                d="M20.52 3.48A11.86 11.86 0 0012.07 0C5.52 0 .18 5.33.18 11.89c0 2.1.55 4.15 1.59 5.95L.11 24l6.3-1.65a11.87 11.87 0 005.65 1.44h.01c6.55 0 11.89-5.33 11.89-11.89a11.8 11.8 0 00-3.44-8.42zm-8.45 18.28h-.01a9.86 9.86 0 01-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.38a9.83 9.83 0 01-1.51-5.24c0-5.44 4.43-9.87 9.88-9.87a9.8 9.8 0 019.87 9.87c0 5.45-4.43 9.88-9.86 9.88zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.39-1.48-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.21 5.09 4.5.71.31 1.27.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.07-.12-.27-.2-.57-.35z" />
                                                        </svg>
                                                        <span>Hubungi Pelapor via WhatsApp</span>
                                                    </a>
                                                @endif
                                            </div>
                                        @else
                                            <div class="mt-6 border-t border-[#e7ebf2] pt-5">
                                                @auth
                                                    @if (auth()->user()->role !== 'mahasiswa')
                                                        <div
                                                            class="flex flex-col gap-3 rounded-xl bg-[#f7f8fb] p-4 text-sm text-[#3d4b60] sm:flex-row sm:items-center sm:justify-between">
                                                            <span>Anda masuk sebagai petugas keamanan.</span>
                                                            <a href="{{ route('petugas.barang-temuan.index') }}"
                                                                class="font-medium text-ink-navy underline underline-offset-4 hover:text-brand">Kelola
                                                                barang temuan</a>
                                                        </div>
                                                    @else
                                                        <h4 class="text-sm font-semibold text-ink">Ajukan klaim kepemilikan
                                                        </h4>
                                                        <p class="mt-1 text-xs leading-5 text-ink-muted">Jelaskan ciri khusus
                                                            barang agar petugas dapat mencocokkan kepemilikan.</p>
                                                        <form action="{{ route('mahasiswa.klaim.store', $item) }}"
                                                            method="POST" class="mt-3 space-y-3">
                                                            @csrf
                                                            <textarea name="keterangan_klaim" rows="3" required
                                                                placeholder="Tuliskan ciri spesifik atau bukti kepemilikan barang"
                                                                class="min-h-24 w-full resize-y rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10"></textarea>
                                                            <div
                                                                class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                                                                <button type="button"
                                                                    popovertarget="modal-{{ $tab === 'hilang' ? 'hilang' : 'temuan' }}-{{ $item->id }}"
                                                                    popovertargetaction="hide"
                                                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-[#d7dde7] bg-white px-5 py-2.5 text-sm font-medium leading-tight text-ink transition duration-150 hover:-translate-y-0.5 hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30 focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">Batal</button>
                                                                <button type="submit"
                                                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-transparent bg-brand px-5 py-2.5 text-sm font-medium leading-tight text-white transition duration-150 hover:-translate-y-0.5 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">Kirim
                                                                    Pengajuan Klaim</button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                @else
                                                    <div
                                                        class="flex flex-col items-start justify-between gap-3 rounded-xl bg-[#f7f8fb] p-4 sm:flex-row sm:items-center">
                                                        <p class="text-sm text-ink">Masuk dengan akun mahasiswa untuk
                                                            mengajukan klaim.</p>
                                                        <a href="{{ route('login') }}"
                                                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-transparent bg-brand px-4 py-2 text-xs font-medium leading-tight text-white transition duration-150 hover:-translate-y-0.5 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">Masuk</a>
                                                    </div>
                                                @endauth
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto w-full max-w-290 px-4 pb-4 sm:px-6 lg:px-8">
        <div
            class="fi-reveal-scale overflow-hidden rounded-2xl bg-brand px-6 py-10 text-white shadow-card sm:px-10 lg:px-12">
            <div class="grid items-center gap-8 lg:grid-cols-[1fr_auto]">
                <div>
                    <p class="text-xs font-medium text-white/80">Pos Keamanan Utama UNEJ</p>
                    <h2 class="mt-2 font-heading text-2xl font-semibold leading-tight sm:text-3xl">
                        Mulai cari, atau laporkan barang yang hilang hari ini
                    </h2>
                    <p class="mt-3 text-sm leading-7 text-white/85">
                        Pengambilan barang dilakukan di Pos Keamanan Utama Universitas Jember dengan identitas resmi.
                    </p>
                    @if ($petugas?->no_hp)
                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/\D/', '', $petugas->no_hp)) }}"
                            target="_blank" rel="noopener"
                            class="mt-4 inline-flex text-sm font-medium text-white underline decoration-white/50 underline-offset-4 hover:decoration-white">
                            Hubungi petugas jaga
                        </a>
                    @endif
                </div>
                <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
                    <a href="#katalog"
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-white px-6 py-3 text-sm font-semibold leading-tight text-ink-navy transition duration-150 hover:-translate-y-0.5 hover:bg-[#f4f6f8] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">Cari
                        Barang</a>
                    @unless (auth()->check() && auth()->user()->role !== 'mahasiswa')
                        <a href="{{ auth()->check() ? route('mahasiswa.laporan.index') : route('login') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-white/40 bg-transparent px-6 py-3 text-sm font-semibold leading-tight text-white transition duration-150 hover:-translate-y-0.5 hover:bg-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 active:translate-y-0 active:scale-[0.98]">
                            Laporkan Kehilangan
                        </a>
                    @endunless
                </div>
            </div>
        </div>
    </section>
@endsection
