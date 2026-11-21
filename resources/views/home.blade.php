@extends('layouts.app')

@section('title', 'FindIT - Lost & Found Universitas Jember')

@section('content')
    @php
        $waPetugas =
            $petugas && $petugas->no_hp
                ? preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $petugas->no_hp))
                : null;
        $heroPath = 'images/banner-unej.svg';
        $featurePath = 'images/campus-activity.svg';
        $hasHeroImage = is_file(public_path($heroPath));
        $hasFeatureImage = is_file(public_path($featurePath));
    @endphp

    <section class="relative isolate -mt-[68px] overflow-hidden bg-ink-deep text-white">
        @if ($hasHeroImage)
            <img src="{{ asset($heroPath) }}" alt="Layanan Lost & Found Universitas Jember"
                class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-ink-deep/75 via-ink-deep/70 to-ink-deep/85"></div>
        @else
            <div
                class="bg-[#0a1c33] [background-image:radial-gradient(circle_at_18%_20%,rgba(196,18,48,.35),transparent_32%),radial-gradient(circle_at_82%_0%,rgba(255,255,255,.08),transparent_28%),linear-gradient(180deg,rgba(10,28,51,.2),rgba(10,28,51,.72))] absolute inset-0">
            </div>
        @endif

        <div
            class="mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8 relative z-10 flex min-h-[520px] flex-col items-center justify-center py-20 text-center sm:min-h-[580px] sm:py-24">
            <h1
                class="mt-5 max-w-3xl font-heading text-4xl font-extrabold leading-[1.08] tracking-tight sm:text-5xl lg:text-[60px]">
                Temukan Kembali Barang Berharga Anda di UNEJ
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-sm leading-7 text-white/80 sm:text-base">
                Layanan resmi untuk melaporkan kehilangan dan menemukan barang temuan secara terverifikasi.
            </p>
            <div class="mt-8 flex w-full flex-col items-stretch justify-center gap-3 sm:w-auto sm:flex-row sm:items-center">
                <a href="{{ route('home', array_merge(request()->except(['page_temuan', 'page_hilang']), ['tab' => 'temuan'])) }}#katalog"
                    data-open-catalog-temuan
                    class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-[#c41230] px-5 py-3 text-sm font-bold leading-[1.2] text-white shadow-[0_6px_14px_rgba(196,18,48,.14)] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#9b1028] active:translate-y-0 active:scale-[.98]">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    Cari Barang
                </a>
                @auth
                    @if (Auth::user()->role === 'mahasiswa')
                        <a href="{{ route('mahasiswa.laporan.index') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-white px-5 py-3 text-sm font-bold leading-[1.2] text-[#102a4c] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#f4f6f8] active:translate-y-0 active:scale-[.98]">Laporkan
                            Kehilangan</a>
                    @else
                        <a href="{{ route('petugas.dashboard') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-white px-5 py-3 text-sm font-bold leading-[1.2] text-[#102a4c] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#f4f6f8] active:translate-y-0 active:scale-[.98]">Buka
                            Panel Petugas</a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-white px-5 py-3 text-sm font-bold leading-[1.2] text-[#102a4c] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#f4f6f8] active:translate-y-0 active:scale-[.98]">Laporkan
                        Kehilangan</a>
                @endauth
            </div>
        </div>
    </section>

    <section class="mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8 relative z-20 -mt-8">
        <div
            class="transition-[transform,box-shadow,border-color,background-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#d1d8e4] hover:shadow-[0_14px_30px_rgba(16,42,76,.08)] grid grid-cols-1 gap-3 rounded-[24px] border border-[#e7ebf2] bg-white p-3 shadow-card sm:grid-cols-3 sm:p-4">
            <div
                class="transition-[transform,box-shadow,border-color,background-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#d1d8e4] hover:shadow-[0_14px_30px_rgba(16,42,76,.08)] rounded-2xl bg-[#f7f8fb] px-5 py-4">
                <p class="text-2xl font-extrabold text-ink">{{ $totalTersedia }}</p>
                <p class="mt-1 text-sm text-ink-muted">Barang temuan tersedia</p>
            </div>
            <div
                class="transition-[transform,box-shadow,border-color,background-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#d1d8e4] hover:shadow-[0_14px_30px_rgba(16,42,76,.08)] rounded-2xl bg-[#f7f8fb] px-5 py-4">
                <p class="text-2xl font-extrabold text-ink">{{ $totalDicari }}</p>
                <p class="mt-1 text-sm text-ink-muted">Laporan sedang dicari</p>
            </div>
            <div
                class="transition-[transform,box-shadow,border-color,background-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#d1d8e4] hover:shadow-[0_14px_30px_rgba(16,42,76,.08)] rounded-2xl bg-[#f7f8fb] px-5 py-4">
                <p class="text-2xl font-extrabold text-ink">{{ $totalDikembalikan }}</p>
                <p class="mt-1 text-sm text-ink-muted">Barang sudah kembali</p>
            </div>
        </div>
    </section>

    <section id="cara-kerja" class="scroll-mt-[96px] py-14 sm:py-[72px] lg:py-[88px]">
        <div class="mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="inline-flex items-center gap-2 text-[#c41230] text-[12px] font-bold tracking-[.16em] uppercase">
                    Cara kerja</p>
                <h2 class="mt-3 font-heading text-3xl font-extrabold tracking-tight text-ink sm:text-4xl">Satu alur dari
                    laporan sampai serah terima</h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-ink-muted">Tiga langkah mudah yang diverifikasi
                    langsung oleh Pos Keamanan Universitas Jember.</p>
            </div>
            <div class="mt-10 grid grid-cols-1 gap-4 md:grid-cols-3">
                <article
                    class="rounded-[24px] border border-[#e7ebf2]/95 bg-white shadow-[0_10px_30px_rgba(16,42,76,.05)] transition-[transform,box-shadow,border-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-[3px] hover:border-[#d7dde7] hover:shadow-[0_16px_34px_rgba(16,42,76,.09)] p-6 sm:p-8">
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand text-sm font-extrabold text-white">1</span>
                    <h3 class="mt-6 font-heading text-lg font-extrabold text-ink">Laporkan kehilangan</h3>
                    <p class="mt-2 text-sm leading-7 text-ink-muted">Catat nama barang, lokasi perkiraan, tanggal, dan ciri
                        khusus agar mudah dicocokkan.</p>
                </article>
                <article
                    class="rounded-[24px] border border-[#e7ebf2]/95 bg-white shadow-[0_10px_30px_rgba(16,42,76,.05)] transition-[transform,box-shadow,border-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-[3px] hover:border-[#d7dde7] hover:shadow-[0_16px_34px_rgba(16,42,76,.09)] p-6 sm:p-8">
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-2xl bg-ink-navy text-sm font-extrabold text-white">2</span>
                    <h3 class="mt-6 font-heading text-lg font-extrabold text-ink">Cari di katalog</h3>
                    <p class="mt-2 text-sm leading-7 text-ink-muted">Telusuri barang temuan dan laporan hilang dengan kata
                        kunci serta kategori.</p>
                </article>
                <article
                    class="rounded-[24px] border border-[#e7ebf2]/95 bg-white shadow-[0_10px_30px_rgba(16,42,76,.05)] transition-[transform,box-shadow,border-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-[3px] hover:border-[#d7dde7] hover:shadow-[0_16px_34px_rgba(16,42,76,.09)] p-6 sm:p-8">
                    <span
                        class="flex h-11 w-11 items-center justify-center rounded-2xl bg-brand text-sm font-extrabold text-white">3</span>
                    <h3 class="mt-6 font-heading text-lg font-extrabold text-ink">Verifikasi dan ambil</h3>
                    <p class="mt-2 text-sm leading-7 text-ink-muted">Ajukan klaim, tunggu persetujuan petugas, lalu ambil
                        barang di Pos Keamanan Utama.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div
            class="mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8 grid items-center gap-10 py-16 lg:grid-cols-2 lg:py-20">
            <div
                class="transition-[transform,box-shadow,border-color,background-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#d1d8e4] hover:shadow-[0_14px_30px_rgba(16,42,76,.08)] group overflow-hidden rounded-[28px] bg-[#f3f5f8]">
                @if ($hasFeatureImage)
                    <img src="{{ asset($featurePath) }}" alt="Ilustrasi pencarian barang FindIT"
                        class="transition-transform duration-[320ms] ease-[cubic-bezier(.22,1,.36,1)] aspect-[4/3] w-full object-cover">
                @else
                    <div class="aspect-[4/3] w-full bg-[#f3f5f8]"></div>
                @endif
            </div>
            <div>
                <p class="inline-flex items-center gap-2 text-[#c41230] text-[12px] font-bold tracking-[.16em] uppercase">
                    Pencarian yang terarah</p>
                <h2 class="mt-3 font-heading text-3xl font-extrabold tracking-tight text-ink sm:text-4xl">Temukan barang
                    lewat katalog yang mudah dipindai</h2>
                <p class="mt-4 text-sm leading-7 text-ink-muted">Setiap kartu menampilkan foto, kategori, lokasi, tanggal,
                    dan status. Detail serta pengajuan klaim tetap dibuka dari kartu barang.</p>
                <ul class="mt-6 space-y-3 text-sm text-ink">
                    <li class="flex gap-3"><span
                            class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-brand-soft text-xs font-extrabold text-brand">1</span><span>Filter
                            kategori dan kata kunci memakai pencarian yang sudah ada.</span></li>
                    <li class="flex gap-3"><span
                            class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-brand-soft text-xs font-extrabold text-brand">2</span><span>Mahasiswa
                            mengajukan klaim dengan ciri kepemilikan.</span></li>
                    <li class="flex gap-3"><span
                            class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-brand-soft text-xs font-extrabold text-brand">3</span><span>Petugas
                            memverifikasi lalu mencatat serah terima di pos keamanan.</span></li>
                </ul>
            </div>
        </div>
    </section>

    @php
        $lokasiAlamat = 'Fakultas Ilmu Komputer UNEJ, Jl. Kalimantan No. 37, Kampus Tegal Boto, Jember';
        $lokasiJam = 'Senin - Jumat, 08.00 - 16.00 WIB';
        $lokasiMapsUrl = 'https://maps.app.goo.gl/fjzb7GHBkVuGzDsK9';
        $lokasiEmbedUrl = 'https://maps.google.com/maps?q=-8.1659263,113.7144346&t=&z=17&ie=UTF8&iwloc=&output=embed';
    @endphp

    <section id="lokasi" class="scroll-mt-[96px] bg-[#f7f8fb] py-14 sm:py-[72px]">
        <div class="mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-8 max-w-2xl text-center">
                <p class="inline-flex items-center gap-2 text-[#c41230] text-[12px] font-bold tracking-[.16em] uppercase">
                    Lokasi Layanan
                </p>
                <h2 class="mt-3 font-heading text-3xl font-extrabold tracking-tight text-ink sm:text-4xl">
                    Pos Keamanan Universitas Jember
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-ink-muted">
                    Lokasi penyerahan dan pengambilan barang temuan yang telah diverifikasi.
                </p>
            </div>

            <div
                class="grid overflow-hidden rounded-[28px] border border-[#e7ebf2] bg-white shadow-[0_10px_30px_rgba(16,42,76,.06)] lg:grid-cols-[.9fr_1.1fr]">
                <div class="flex flex-col justify-between p-6 sm:p-8">
                    <div class="space-y-6">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[.14em] text-[#5e6a7d]">Alamat</p>
                            <p class="mt-2 text-sm leading-7 text-[#243044]">{{ $lokasiAlamat }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[.14em] text-[#5e6a7d]">Jam Operasional</p>
                            <p class="mt-2 text-sm leading-7 text-[#243044]">{{ $lokasiJam }}</p>
                        </div>
                        <div class="rounded-2xl bg-[#f7f8fb] p-4">
                            <p class="text-sm font-bold text-[#172033]">Penyerahan & Pengambilan Barang</p>
                            <p class="mt-1 text-sm leading-6 text-[#5e6a7d]">
                                Barang temuan diserahkan dan diambil melalui Pos Keamanan Universitas Jember setelah
                                proses verifikasi selesai dilakukan.
                            </p>
                        </div>
                    </div>

                    <a href="{{ $lokasiMapsUrl }}" target="_blank" rel="noopener"
                        class="mt-6 inline-flex min-h-11 w-full items-center justify-center gap-2 rounded-full border border-transparent bg-[#c41230] px-5 py-3 text-sm font-bold text-white shadow-[0_6px_14px_rgba(196,18,48,.14)] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#9b1028] active:translate-y-0 active:scale-[.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        Lihat Lokasi di Google Maps
                    </a>
                </div>

                <div
                    class="min-h-[300px] border-t border-[#e7ebf2] bg-[#eef1f5] sm:min-h-[360px] lg:min-h-[420px] lg:border-l lg:border-t-0">
                    @if ($lokasiEmbedUrl)
                        <iframe src="{{ $lokasiEmbedUrl }}" title="Peta Lokasi Pos Keamanan Utama Universitas Jember"
                            class="h-full min-h-[300px] w-full border-0 sm:min-h-[360px] lg:min-h-[420px]" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                    @else
                        <div
                            class="flex h-full min-h-[300px] flex-col items-center justify-center px-6 text-center sm:min-h-[360px] lg:min-h-[420px]">
                            <span
                                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#102a4c] shadow-[0_8px_20px_rgba(16,42,76,.08)]">
                                <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="1.7">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </span>
                            <p class="mt-4 text-sm font-bold text-[#172033]">Area embed Google Maps</p>
                            <p class="mt-1 max-w-sm text-xs leading-6 text-[#5e6a7d]">Tambahkan URL embed Google Maps pada
                                variable $lokasiEmbedUrl.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section id="katalog" class="scroll-mt-[96px] py-14 sm:py-[72px] lg:py-[88px]">
        <div class="mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-8 max-w-2xl text-center">
                <p class="inline-flex items-center gap-2 text-[#c41230] text-[12px] font-bold tracking-[.16em] uppercase">
                    Katalog</p>
                <h2 class="mt-3 font-heading text-3xl font-extrabold tracking-tight text-ink sm:text-4xl">Barang temuan dan
                    laporan hilang</h2>
                <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-ink-muted">Gunakan pencarian dan kategori untuk
                    menemukan barang di lingkungan UNEJ.</p>
            </div>

            <div
                class="relative z-20 rounded-[24px] border border-[#e7ebf2]/95 bg-white p-4 shadow-[0_10px_30px_rgba(16,42,76,.05)] transition-[box-shadow,border-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:border-[#d1d8e4] hover:shadow-[0_14px_30px_rgba(16,42,76,.08)] sm:p-5">
                <div id="catalog-tabs" class="relative mx-auto flex max-w-lg rounded-full bg-[#f3f5f8] p-1"
                    data-active-tab="{{ $tab !== 'hilang' ? 'temuan' : 'hilang' }}">
                    <span id="catalog-tab-indicator"
                        class="pointer-events-none absolute top-1 {{ $tab !== 'hilang' ? 'left-1' : 'left-1/2' }} h-[calc(100%-8px)] w-[calc(50%-4px)] rounded-full bg-[#102a4c] shadow-[0_4px_10px_rgba(16,42,76,.14)] transition-[left] duration-[500ms] ease-[cubic-bezier(.22,1,.36,1)]"
                        aria-hidden="true"></span>
                    <a href="{{ route('home', array_merge(request()->except(['page_temuan', 'page_hilang']), ['tab' => 'temuan'])) }}"
                        data-catalog-tab="temuan"
                        class="relative z-[1] flex-1 rounded-full px-4 py-2.5 text-center text-sm font-bold transition-[color,transform] duration-[450ms] ease-[cubic-bezier(.22,1,.36,1)] active:scale-[.99] {{ $tab !== 'hilang' ? 'text-white' : 'text-[#102a4c]' }}">
                        Barang Temuan
                    </a>
                    <a href="{{ route('home', array_merge(request()->except(['page_temuan', 'page_hilang']), ['tab' => 'hilang'])) }}"
                        data-catalog-tab="hilang"
                        class="relative z-[1] flex-1 rounded-full px-4 py-2.5 text-center text-sm font-bold transition-[color,transform] duration-[450ms] ease-[cubic-bezier(.22,1,.36,1)] active:scale-[.99] {{ $tab === 'hilang' ? 'text-white' : 'text-[#102a4c]' }}">
                        Barang Hilang
                    </a>
                </div>

                <form action="{{ route('home') }}" method="GET" class="mt-4 flex flex-col gap-2.5 lg:flex-row">
                    <input type="hidden" name="tab" value="{{ $tab }}">
                    <div class="relative flex-1">
                        <svg class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-muted"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama barang, lokasi, atau deskripsi..."
                            class="w-full rounded-full border border-[#d7dde7] bg-white py-3 pl-[42px] pr-3.5 text-sm leading-[1.4] text-[#172033] outline-none transition-[border-color,box-shadow] duration-160 focus:border-[#102a4c] focus:ring-4 focus:ring-[#102a4c]/10">
                    </div>
                    <select name="kategori_id"
                        class="w-full rounded-[14px] border border-[#d7dde7] bg-white px-3.5 py-3 pr-10 text-sm leading-[1.4] text-[#172033] outline-none transition-[border-color,box-shadow] duration-160 focus:border-[#c41230] focus:ring-4 focus:ring-[#c41230]/10 lg:w-52">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}"
                                {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-[#c41230] px-5 py-3 text-sm font-bold leading-[1.2] text-white shadow-[0_6px_14px_rgba(196,18,48,.14)] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#9b1028] active:translate-y-0 active:scale-[.98]">Cari</button>
                    @if (request()->filled('search') || request()->filled('kategori_id'))
                        <a href="{{ route('home', ['tab' => $tab]) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-[#d5dbe6] bg-white px-5 py-3 text-sm font-bold leading-[1.2] text-[#172033] transition-all duration-200 ease-out hover:-translate-y-px hover:border-[#102a4c] hover:text-[#102a4c] active:translate-y-0 active:scale-[.98]">Reset</a>
                    @endif
                </form>
            </div>

            @if ($tab !== 'hilang')
                @php
                    $itemsTemuan =
                        $barangTemuan instanceof \Illuminate\Pagination\AbstractPaginator
                            ? $barangTemuan->getCollection()->take(3)
                            : collect($barangTemuan)->take(3);
                    $currPageTemuan =
                        $barangTemuan instanceof \Illuminate\Pagination\AbstractPaginator
                            ? $barangTemuan->currentPage()
                            : 1;
                    $lastPageTemuan =
                        $barangTemuan instanceof \Illuminate\Pagination\AbstractPaginator
                            ? $barangTemuan->lastPage()
                            : 1;
                    $pageNameTemuan =
                        $barangTemuan instanceof \Illuminate\Pagination\AbstractPaginator
                            ? $barangTemuan->getPageName()
                            : 'page';
                @endphp
                @if ($itemsTemuan->isEmpty())
                    <div class="rounded-[24px] border border-dashed border-[#d5dbe6] bg-white p-14 text-center mt-6">
                        <h3 class="text-base font-extrabold text-ink">Belum ada barang temuan yang sesuai</h3>
                        <p class="mt-1 text-sm text-ink-muted">Coba ubah kata kunci pencarian atau periksa kembali nanti.
                        </p>
                    </div>
                @else
                    <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($itemsTemuan as $item)
                            @php
                                $namaKategoriTemuan = $item->kategori?->nama_kategori ?? 'Umum';
                            @endphp
                            <article
                                class="flex flex-col overflow-hidden rounded-[22px] border border-[#e7ebf2] bg-white shadow-[0_8px_24px_rgba(16,42,76,.04)] transition-[transform,box-shadow,border-color] duration-[280ms] ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-1 hover:border-[#d8dee8] hover:shadow-[0_18px_40px_rgba(16,42,76,.1)] group">
                                <div class="relative aspect-[16/10] overflow-hidden bg-[#eef1f5]">
                                    <img src="{{ asset('storage/' . $item->foto_barang) }}"
                                        alt="{{ $item->nama_barang }}"
                                        class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.025]">
                                    <span
                                        class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full bg-white px-2.5 py-1 text-xs font-bold leading-[1.3] text-[#3e4a5c] absolute left-3 top-3 bg-white/95">{{ $namaKategoriTemuan }}</span>
                                    <span
                                        class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-bold leading-[1.3] absolute right-3 top-3 bg-ink-navy text-white">Tersedia</span>
                                </div>
                                <div class="flex flex-1 flex-col p-5">
                                    <h2 class="text-base font-extrabold text-ink">{{ $item->nama_barang }}</h2>
                                    <div class="mt-3 space-y-1.5 text-xs text-ink-muted">
                                        <p class="truncate">{{ $item->lokasi_ditemukan }}</p>
                                        <p>Ditemukan {{ $item->tanggal_ditemukan->format('d M Y') }}</p>
                                    </div>
                                    <p class="mt-3 line-clamp-2 flex-1 text-sm leading-6 text-[#3d4b60]">
                                        {{ $item->deskripsi }}</p>
                                    <button type="button" onclick="openTemuanModal(this)" data-id="{{ $item->id }}"
                                        data-nama="{{ $item->nama_barang }}" data-kategori="{{ $namaKategoriTemuan }}"
                                        data-lokasi="{{ $item->lokasi_ditemukan }}"
                                        data-tanggal="{{ $item->tanggal_ditemukan->format('d M Y') }}"
                                        data-deskripsi="{{ $item->deskripsi }}"
                                        data-foto="{{ asset('storage/' . $item->foto_barang) }}"
                                        class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-[#102a4c] px-5 py-3 text-sm font-bold leading-[1.2] text-white transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#0a1c33] active:translate-y-0 active:scale-[.98] mt-4 w-full">Lihat
                                        Detail</button>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if ($lastPageTemuan > 1)
                        <nav aria-label="Navigasi halaman barang temuan"
                            class="mt-8 flex flex-wrap items-center justify-center gap-2">
                            @if ($currPageTemuan > 1)
                                <a href="{{ route('home', array_merge(request()->except($pageNameTemuan), ['tab' => 'temuan', $pageNameTemuan => $currPageTemuan - 1])) }}"
                                    class="group inline-flex h-10 items-center justify-center gap-1 rounded-full border border-[#d5dbe6] bg-white px-4 text-xs font-bold text-[#172033] shadow-[0_2px_8px_rgba(16,42,76,.03)] transition-all duration-200 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#102a4c] hover:bg-[#f7f8fb] hover:text-[#102a4c] hover:shadow-[0_8px_18px_rgba(16,42,76,.08)] active:translate-y-0 active:scale-[.95] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#102a4c]/30">
                                    <span
                                        class="transition-transform duration-200 ease-out group-hover:-translate-x-0.5">&lsaquo;</span>
                                    <span>Prev</span>
                                </a>
                            @endif

                            @for ($p = 1; $p <= $lastPageTemuan; $p++)
                                <a href="{{ route('home', array_merge(request()->except($pageNameTemuan), ['tab' => 'temuan', $pageNameTemuan => $p])) }}"
                                    aria-current="{{ $p === $currPageTemuan ? 'page' : 'false' }}"
                                    class="inline-flex h-10 min-w-10 items-center justify-center rounded-full px-3 text-xs font-extrabold transition-all duration-200 ease-[cubic-bezier(.22,1,.36,1)] active:translate-y-0 active:scale-[.95] focus-visible:outline-none {{ $p === $currPageTemuan ? 'bg-[#c41230] text-white shadow-[0_8px_18px_rgba(196,18,48,.24)] hover:-translate-y-0.5 hover:bg-[#9b1028] focus-visible:ring-2 focus-visible:ring-[#c41230]/40' : 'border border-[#e7ebf2] bg-white text-[#172033] shadow-[0_2px_8px_rgba(16,42,76,.03)] hover:-translate-y-0.5 hover:scale-105 hover:border-[#102a4c] hover:bg-[#f7f8fb] hover:text-[#102a4c] hover:shadow-[0_8px_18px_rgba(16,42,76,.08)] focus-visible:ring-2 focus-visible:ring-[#102a4c]/30' }}">
                                    {{ $p }}
                                </a>
                            @endfor

                            @if ($currPageTemuan < $lastPageTemuan)
                                <a href="{{ route('home', array_merge(request()->except($pageNameTemuan), ['tab' => 'temuan', $pageNameTemuan => $currPageTemuan + 1])) }}"
                                    class="group inline-flex h-10 items-center justify-center gap-1 rounded-full border border-[#d5dbe6] bg-white px-4 text-xs font-bold text-[#172033] shadow-[0_2px_8px_rgba(16,42,76,.03)] transition-all duration-200 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#102a4c] hover:bg-[#f7f8fb] hover:text-[#102a4c] hover:shadow-[0_8px_18px_rgba(16,42,76,.08)] active:translate-y-0 active:scale-[.95] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#102a4c]/30">
                                    <span>Next</span>
                                    <span
                                        class="transition-transform duration-200 ease-out group-hover:translate-x-0.5">&rsaquo;</span>
                                </a>
                            @endif
                        </nav>
                    @endif
                @endif
            @else
                @php
                    $itemsHilang =
                        $laporanKehilangan instanceof \Illuminate\Pagination\AbstractPaginator
                            ? $laporanKehilangan->getCollection()->take(3)
                            : collect($laporanKehilangan)->take(3);
                    $currPageHilang =
                        $laporanKehilangan instanceof \Illuminate\Pagination\AbstractPaginator
                            ? $laporanKehilangan->currentPage()
                            : 1;
                    $lastPageHilang =
                        $laporanKehilangan instanceof \Illuminate\Pagination\AbstractPaginator
                            ? $laporanKehilangan->lastPage()
                            : 1;
                    $pageNameHilang =
                        $laporanKehilangan instanceof \Illuminate\Pagination\AbstractPaginator
                            ? $laporanKehilangan->getPageName()
                            : 'page';
                @endphp
                @if ($itemsHilang->isEmpty())
                    <div class="rounded-[24px] border border-dashed border-[#d5dbe6] bg-white p-14 text-center mt-6">
                        <h3 class="text-base font-extrabold text-ink">Belum ada laporan barang hilang yang sesuai</h3>
                        <p class="mt-1 text-sm text-ink-muted">Semua laporan kehilangan yang sedang dicari akan tampil di
                            sini.</p>
                    </div>
                @else
                    <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($itemsHilang as $item)
                            @php
                                $namaKategoriHilang = $item->kategori?->nama_kategori ?? 'Umum';
                                $namaPelaporHilang = $item->pengguna?->nama ?? '-';
                                $waPelapor =
                                    $item->pengguna && $item->pengguna->no_hp
                                        ? preg_replace(
                                            '/^0/',
                                            '62',
                                            preg_replace('/[^0-9]/', '', $item->pengguna->no_hp),
                                        )
                                        : '';
                            @endphp
                            <article
                                class="flex flex-col overflow-hidden rounded-[22px] border border-[#e7ebf2] bg-white shadow-[0_8px_24px_rgba(16,42,76,.04)] transition-[transform,box-shadow,border-color] duration-[280ms] ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-1 hover:border-[#d8dee8] hover:shadow-[0_18px_40px_rgba(16,42,76,.1)] group">
                                <div
                                    class="relative flex aspect-[16/10] items-center justify-center overflow-hidden bg-[#eef1f5]">
                                    @if ($item->foto_barang)
                                        <img src="{{ asset('storage/' . $item->foto_barang) }}"
                                            alt="{{ $item->nama_barang }}"
                                            class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.025]">
                                    @else
                                        <div class="text-center text-xs font-semibold text-ink-muted">Tanpa foto</div>
                                    @endif
                                    <span
                                        class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full bg-white px-2.5 py-1 text-xs font-bold leading-[1.3] text-[#3e4a5c] absolute left-3 top-3 bg-white/95">{{ $namaKategoriHilang }}</span>
                                    <span
                                        class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full bg-[#fdecee] px-2.5 py-1 text-xs font-bold leading-[1.3] text-[#9b1028] absolute right-3 top-3">Dicari</span>
                                </div>
                                <div class="flex flex-1 flex-col p-5">
                                    <h2 class="text-base font-extrabold text-ink">{{ $item->nama_barang }}</h2>
                                    <div class="mt-3 space-y-1.5 text-xs text-ink-muted">
                                        <p class="truncate">{{ $item->lokasi_hilang }}</p>
                                        <p>Hilang {{ $item->tanggal_hilang->format('d M Y') }}</p>
                                        <p class="truncate">Pelapor: {{ $namaPelaporHilang }}</p>
                                    </div>
                                    <p class="mt-3 line-clamp-2 flex-1 text-sm leading-6 text-[#3d4b60]">
                                        {{ $item->deskripsi }}</p>
                                    <button type="button" onclick="openHilangModal(this)"
                                        data-nama="{{ $item->nama_barang }}" data-kategori="{{ $namaKategoriHilang }}"
                                        data-lokasi="{{ $item->lokasi_hilang }}"
                                        data-tanggal="{{ $item->tanggal_hilang->format('d M Y') }}"
                                        data-pelapor="{{ $namaPelaporHilang }}" data-wa="{{ $waPelapor }}"
                                        data-deskripsi="{{ $item->deskripsi }}"
                                        data-foto="{{ $item->foto_barang ? asset('storage/' . $item->foto_barang) : '' }}"
                                        class="inline-flex items-center justify-center gap-2 rounded-full border border-[#d5dbe6] bg-white px-5 py-3 text-sm font-bold leading-[1.2] text-[#172033] transition-all duration-200 ease-out hover:-translate-y-px hover:border-[#102a4c] hover:text-[#102a4c] active:translate-y-0 active:scale-[.98] mt-4 w-full">Lihat
                                        Detail</button>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if ($lastPageHilang > 1)
                        <nav aria-label="Navigasi halaman barang hilang"
                            class="mt-8 flex flex-wrap items-center justify-center gap-2">
                            @if ($currPageHilang > 1)
                                <a href="{{ route('home', array_merge(request()->except($pageNameHilang), ['tab' => 'hilang', $pageNameHilang => $currPageHilang - 1])) }}"
                                    class="group inline-flex h-10 items-center justify-center gap-1 rounded-full border border-[#d5dbe6] bg-white px-4 text-xs font-bold text-[#172033] shadow-[0_2px_8px_rgba(16,42,76,.03)] transition-all duration-200 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#102a4c] hover:bg-[#f7f8fb] hover:text-[#102a4c] hover:shadow-[0_8px_18px_rgba(16,42,76,.08)] active:translate-y-0 active:scale-[.95] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#102a4c]/30">
                                    <span
                                        class="transition-transform duration-200 ease-out group-hover:-translate-x-0.5">&lsaquo;</span>
                                    <span>Prev</span>
                                </a>
                            @endif

                            @for ($p = 1; $p <= $lastPageHilang; $p++)
                                <a href="{{ route('home', array_merge(request()->except($pageNameHilang), ['tab' => 'hilang', $pageNameHilang => $p])) }}"
                                    aria-current="{{ $p === $currPageHilang ? 'page' : 'false' }}"
                                    class="inline-flex h-10 min-w-10 items-center justify-center rounded-full px-3 text-xs font-extrabold transition-all duration-200 ease-[cubic-bezier(.22,1,.36,1)] active:translate-y-0 active:scale-[.95] focus-visible:outline-none {{ $p === $currPageHilang ? 'bg-[#c41230] text-white shadow-[0_8px_18px_rgba(196,18,48,.24)] hover:-translate-y-0.5 hover:bg-[#9b1028] focus-visible:ring-2 focus-visible:ring-[#c41230]/40' : 'border border-[#e7ebf2] bg-white text-[#172033] shadow-[0_2px_8px_rgba(16,42,76,.03)] hover:-translate-y-0.5 hover:scale-105 hover:border-[#102a4c] hover:bg-[#f7f8fb] hover:text-[#102a4c] hover:shadow-[0_8px_18px_rgba(16,42,76,.08)] focus-visible:ring-2 focus-visible:ring-[#102a4c]/30' }}">
                                    {{ $p }}
                                </a>
                            @endfor

                            @if ($currPageHilang < $lastPageHilang)
                                <a href="{{ route('home', array_merge(request()->except($pageNameHilang), ['tab' => 'hilang', $pageNameHilang => $currPageHilang + 1])) }}"
                                    class="group inline-flex h-10 items-center justify-center gap-1 rounded-full border border-[#d5dbe6] bg-white px-4 text-xs font-bold text-[#172033] shadow-[0_2px_8px_rgba(16,42,76,.03)] transition-all duration-200 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#102a4c] hover:bg-[#f7f8fb] hover:text-[#102a4c] hover:shadow-[0_8px_18px_rgba(16,42,76,.08)] active:translate-y-0 active:scale-[.95] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#102a4c]/30">
                                    <span>Next</span>
                                    <span
                                        class="transition-transform duration-200 ease-out group-hover:translate-x-0.5">&rsaquo;</span>
                                </a>
                            @endif
                        </nav>
                    @endif
                @endif
            @endif
        </div>
    </section>

    <section class="mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8 pb-16">
        <div
            class="transition-[transform,box-shadow,border-color,background-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#d1d8e4] hover:shadow-[0_14px_30px_rgba(16,42,76,.08)] overflow-hidden rounded-[28px] bg-brand px-6 py-10 text-white sm:px-10 lg:px-12">
            <div class="grid items-center gap-8 lg:grid-cols-[1fr_auto]">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-white/80">Pos Keamanan Utama UNEJ</p>
                    <h2 class="mt-3 max-w-2xl font-heading text-3xl font-extrabold leading-tight">Mulai cari, atau laporkan
                        barang yang hilang hari ini.</h2>
                    <p class="mt-3 max-w-xl text-sm leading-7 text-white/85">Pengambilan barang dilakukan di Pos Keamanan
                        Utama Universitas Jember dengan identitas resmi.</p>
                    @if ($waPetugas)
                        <a href="https://wa.me/{{ $waPetugas }}" target="_blank"
                            class="mt-4 inline-flex text-sm font-bold text-white underline decoration-white/40 underline-offset-4">Hubungi
                            petugas jaga</a>
                    @endif
                </div>
                <div class="flex flex-col gap-3 sm:flex-row lg:flex-col">
                    <a href="{{ route('home', array_merge(request()->except(['page_temuan', 'page_hilang']), ['tab' => 'temuan'])) }}#katalog"
                        data-open-catalog-temuan
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-white px-5 py-3 text-sm font-bold leading-[1.2] text-[#102a4c] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#f4f6f8] active:translate-y-0 active:scale-[.98]">Cari
                        Barang</a>
                    @auth
                        @if (Auth::user()->role === 'mahasiswa')
                            <a href="{{ route('mahasiswa.laporan.index') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-full border border-white/30 bg-transparent px-5 py-3 text-sm font-bold leading-[1.2] text-white transition-all duration-200 ease-out hover:-translate-y-px hover:bg-white/10 active:translate-y-0 active:scale-[.98]">Laporkan
                                Kehilangan</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-white/30 bg-transparent px-5 py-3 text-sm font-bold leading-[1.2] text-white transition-all duration-200 ease-out hover:-translate-y-px hover:bg-white/10 active:translate-y-0 active:scale-[.98]">Laporkan
                            Kehilangan</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <div id="modal-temuan"
        class="fixed inset-0 z-50 hidden items-end justify-center bg-ink-deep/60 p-0 sm:items-center sm:p-4"
        onclick="if (event.target === this) closeTemuanModal()">
        <div class="max-h-[92vh] w-full max-w-2xl overflow-y-auto rounded-t-[28px] bg-white sm:rounded-[28px]">
            <div
                class="sticky top-0 z-10 flex items-start justify-between gap-4 border-b border-[#e7ebf2] bg-white px-5 py-4 sm:px-6">
                <div>
                    <span id="temuan-kategori" class="text-xs font-bold uppercase tracking-wider text-brand"></span>
                    <h3 id="temuan-nama" class="text-lg font-extrabold text-ink"></h3>
                </div>
                <button type="button" onclick="closeTemuanModal()"
                    class="flex h-10 w-10 items-center justify-center rounded-full text-ink-muted hover:bg-[#f3f5f8]"
                    aria-label="Tutup">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-5 sm:p-6">
                <div
                    class="transition-[transform,box-shadow,border-color,background-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#d1d8e4] hover:shadow-[0_14px_30px_rgba(16,42,76,.08)] overflow-hidden rounded-2xl bg-[#eef1f5]">
                    <img id="temuan-foto" src="" alt="" class="max-h-80 w-full object-contain">
                </div>
                <div
                    class="transition-[transform,box-shadow,border-color,background-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#d1d8e4] hover:shadow-[0_14px_30px_rgba(16,42,76,.08)] mt-5 grid grid-cols-1 gap-3 rounded-2xl bg-[#f7f8fb] p-4 text-sm sm:grid-cols-2">
                    <div><span class="block text-xs text-ink-muted">Lokasi ditemukan</span><span id="temuan-lokasi"
                            class="font-bold text-ink"></span></div>
                    <div><span class="block text-xs text-ink-muted">Tanggal ditemukan</span><span id="temuan-tanggal"
                            class="font-bold text-ink"></span></div>
                    <div class="sm:col-span-2"><span class="block text-xs text-ink-muted">Lokasi penyimpanan</span><span
                            class="font-bold text-ink-navy">Pos Keamanan Utama Universitas Jember</span></div>
                </div>
                <div class="mt-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-ink-muted">Deskripsi barang</h4>
                    <p id="temuan-deskripsi" class="mt-1.5 whitespace-pre-line text-sm leading-7 text-[#243044]"></p>
                </div>
                <div class="mt-6 border-t border-[#e7ebf2] pt-5">
                    @auth
                        @if (Auth::user()->role === 'mahasiswa')
                            <h4 class="text-sm font-extrabold text-ink">Ajukan klaim kepemilikan</h4>
                            <p class="mt-1 text-xs leading-5 text-ink-muted">Jelaskan ciri khusus barang agar petugas dapat
                                mencocokkan kepemilikan.</p>
                            <form id="form-klaim" action="" method="POST" class="mt-3 space-y-3">
                                @csrf
                                <textarea name="keterangan_klaim" rows="3" required
                                    placeholder="Tuliskan ciri spesifik atau bukti kepemilikan barang..."
                                    class="min-h-24 w-full resize-y rounded-[14px] border border-[#d7dde7] bg-white px-3.5 py-3 text-sm leading-[1.4] text-[#172033] outline-none transition-[border-color,box-shadow] duration-160 focus:border-[#102a4c] focus:ring-4 focus:ring-[#102a4c]/10"></textarea>
                                <div class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                                    <button type="button" onclick="closeTemuanModal()"
                                        class="inline-flex items-center justify-center gap-2 rounded-full border border-[#d5dbe6] bg-white px-5 py-3 text-sm font-bold leading-[1.2] text-[#172033] transition-all duration-200 ease-out hover:-translate-y-px hover:border-[#102a4c] hover:text-[#102a4c] active:translate-y-0 active:scale-[.98]">Batal</button>
                                    <button type="submit"
                                        class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-[#c41230] px-5 py-3 text-sm font-bold leading-[1.2] text-white shadow-[0_6px_14px_rgba(196,18,48,.14)] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#9b1028] active:translate-y-0 active:scale-[.98]">Kirim
                                        Pengajuan Klaim</button>
                                </div>
                            </form>
                        @else
                            <div
                                class="flex flex-col gap-3 rounded-2xl bg-[#f7f8fb] p-4 text-sm text-[#3d4b60] sm:flex-row sm:items-center sm:justify-between">
                                <span>Anda masuk sebagai petugas keamanan.</span>
                                <a href="{{ route('petugas.barang-temuan.index') }}" class="font-bold text-brand">Kelola
                                    barang temuan</a>
                            </div>
                        @endif
                    @else
                        <div
                            class="flex flex-col items-start justify-between gap-3 rounded-2xl bg-brand-soft p-4 sm:flex-row sm:items-center">
                            <p class="text-sm text-ink-navy">Masuk dengan akun mahasiswa untuk mengajukan klaim.</p>
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-[#c41230] px-3.5 py-2 text-xs font-bold leading-[1.2] text-white shadow-[0_6px_14px_rgba(196,18,48,.14)] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#9b1028] active:translate-y-0 active:scale-[.98]">Masuk</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div id="modal-hilang"
        class="fixed inset-0 z-50 hidden items-end justify-center bg-ink-deep/60 p-0 sm:items-center sm:p-4"
        onclick="if (event.target === this) closeHilangModal()">
        <div class="max-h-[92vh] w-full max-w-xl overflow-y-auto rounded-t-[28px] bg-white sm:rounded-[28px]">
            <div
                class="sticky top-0 z-10 flex items-start justify-between gap-4 border-b border-[#e7ebf2] bg-white px-5 py-4 sm:px-6">
                <div>
                    <span id="hilang-kategori" class="text-xs font-bold uppercase tracking-wider text-brand"></span>
                    <h3 id="hilang-nama" class="text-lg font-extrabold text-ink"></h3>
                </div>
                <button type="button" onclick="closeHilangModal()"
                    class="flex h-10 w-10 items-center justify-center rounded-full text-ink-muted hover:bg-[#f3f5f8]"
                    aria-label="Tutup">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-5 sm:p-6">
                <div id="hilang-foto-wrapper"
                    class="group mb-5 hidden overflow-hidden rounded-2xl border border-[#e7ebf2] bg-[#eef1f5] transition-[transform,box-shadow,border-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#d1d8e4] hover:shadow-[0_14px_30px_rgba(16,42,76,.08)]">
                    <img id="hilang-foto" src="" alt=""
                        class="max-h-80 w-full object-contain transition-transform duration-300 ease-[cubic-bezier(.22,1,.36,1)] group-hover:scale-[1.03]">
                </div>
                <div
                    class="transition-[transform,box-shadow,border-color,background-color] duration-220 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-0.5 hover:border-[#d1d8e4] hover:shadow-[0_14px_30px_rgba(16,42,76,.08)] grid grid-cols-1 gap-3 rounded-2xl bg-[#f7f8fb] p-4 text-sm sm:grid-cols-2">
                    <div><span class="block text-xs text-ink-muted">Perkiraan lokasi hilang</span><span id="hilang-lokasi"
                            class="font-bold text-ink"></span></div>
                    <div><span class="block text-xs text-ink-muted">Tanggal hilang</span><span id="hilang-tanggal"
                            class="font-bold text-ink"></span></div>
                    <div class="sm:col-span-2"><span class="block text-xs text-ink-muted">Pelapor</span><span
                            id="hilang-pelapor" class="font-bold text-ink"></span></div>
                </div>
                <div class="mt-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-ink-muted">Deskripsi dan ciri-ciri</h4>
                    <p id="hilang-deskripsi" class="mt-1.5 whitespace-pre-line text-sm leading-7 text-[#243044]"></p>
                </div>
                <div class="mt-6 flex flex-col gap-2 border-t border-[#e7ebf2] pt-4 sm:flex-row sm:justify-end">
                    <button type="button" onclick="closeHilangModal()"
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-[#d5dbe6] bg-white px-5 py-3 text-sm font-bold leading-[1.2] text-[#172033] transition-all duration-200 ease-out hover:-translate-y-px hover:border-[#102a4c] hover:text-[#102a4c] active:translate-y-0 active:scale-[.98]">Tutup</button>
                    <a id="hilang-wa-link" href="#" target="_blank" rel="noopener"
                        class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-[#25D366] px-5 py-3 text-sm font-bold leading-[1.2] text-white transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#1fb85a] active:translate-y-0 active:scale-[.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#25D366] focus-visible:ring-offset-2 hidden">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path
                                d="M20.52 3.48A11.86 11.86 0 0012.07 0C5.52 0 .18 5.33.18 11.89c0 2.1.55 4.15 1.59 5.95L.11 24l6.3-1.65a11.87 11.87 0 005.65 1.44h.01c6.55 0 11.89-5.33 11.89-11.89a11.8 11.8 0 00-3.44-8.42zm-8.45 18.28h-.01a9.86 9.86 0 01-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.38a9.83 9.83 0 01-1.51-5.24c0-5.44 4.43-9.87 9.88-9.87a9.8 9.8 0 019.87 9.87c0 5.45-4.43 9.88-9.86 9.88zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.39-1.48-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.21 5.09 4.5.71.31 1.27.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.07-.12-.27-.2-.57-.35z" />
                        </svg>
                        <span>Hubungi Pelapor via WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const katalog = document.getElementById('katalog');
            if (!katalog) return;

            const syncCatalogTabIndicator = function() {
                requestAnimationFrame(function() {
                    const tabs = document.querySelector('[id="catalog-tabs"]');
                    if (!tabs) return;
                    const activeTab = tabs.dataset.activeTab;
                    const indicator = tabs.querySelector('#catalog-tab-indicator');
                    if (!indicator) return;

                    indicator.classList.toggle('left-1', activeTab === 'temuan');
                    indicator.classList.toggle('left-1/2', activeTab === 'hilang');
                    indicator.classList.add('bg-[#102a4c]');
                });
            };
            syncCatalogTabIndicator();
            window.addEventListener('resize', syncCatalogTabIndicator, {
                passive: true
            });

            const fetchCatalog = async function(url, updateHistory = true, preserveScroll = true) {
                const position = window.scrollY;
                katalog.setAttribute('aria-busy', 'true');
                katalog.classList.add('opacity-95');

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }
                    });
                    if (!response.ok) {
                        window.location.assign(url);
                        return;
                    }

                    const parsed = new DOMParser().parseFromString(await response.text(), 'text/html');
                    const nextCatalog = parsed.getElementById('katalog');
                    if (!nextCatalog) {
                        window.location.assign(url);
                        return;
                    }

                    katalog.innerHTML = nextCatalog.innerHTML;
                    if (updateHistory) window.history.pushState({
                        catalog: true
                    }, '', url);
                    if (preserveScroll) window.scrollTo(0, position);
                    syncCatalogTabIndicator();
                    if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                        katalog.animate(
                            [{
                                    opacity: .78,
                                    transform: 'translateY(2px)'
                                },
                                {
                                    opacity: 1,
                                    transform: 'translateY(0)'
                                }
                            ], {
                                duration: 520,
                                easing: 'cubic-bezier(.22, 1, .36, 1)'
                            }
                        );
                    }
                } catch (error) {
                    window.location.assign(url);
                } finally {
                    katalog.classList.remove('opacity-95');
                    katalog.removeAttribute('aria-busy');
                }
            };

            katalog.addEventListener('click', function(event) {
                const link = event.target.closest('a');
                if (!link || !link.href || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey)
                    return;
                event.preventDefault();
                if (link.dataset.catalogTab) {
                    const tabs = document.getElementById('catalog-tabs');
                    if (tabs) {
                        tabs.dataset.activeTab = link.dataset.catalogTab;
                        syncCatalogTabIndicator();
                    }
                }
                fetchCatalog(link.href);
            });

            katalog.addEventListener('submit', function(event) {
                const form = event.target;
                if (!(form instanceof HTMLFormElement)) return;
                event.preventDefault();
                const params = new URLSearchParams(new FormData(form));
                const separator = form.action.includes('?') ? '&' : '?';
                fetchCatalog(form.action + separator + params.toString());
            });

            katalog.addEventListener('change', function(event) {
                if (event.target.matches('select[name="kategori_id"]')) {
                    event.target.closest('form')?.requestSubmit();
                }
            });

            window.addEventListener('popstate', function() {
                fetchCatalog(window.location.href, false);
            });

            document.querySelectorAll('[data-open-catalog-temuan]').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    if (event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;
                    event.preventDefault();

                    const temuanUrl = button.getAttribute('href').replace(/#katalog$/, '');
                    const tabs = document.getElementById('catalog-tabs');
                    if (tabs) {
                        tabs.dataset.activeTab = 'temuan';
                        syncCatalogTabIndicator();
                    }

                    fetchCatalog(temuanUrl, true, false).then(function() {
                        const catalogSection = document.getElementById('katalog');
                        if (!catalogSection) return;
                        catalogSection.scrollIntoView({
                            behavior: window.matchMedia(
                                    '(prefers-reduced-motion: reduce)').matches ?
                                'auto' : 'smooth',
                            block: 'start'
                        });
                    });
                });
            });
        });

        const klaimActionTemplate = "{{ route('mahasiswa.klaim.store', ['barangTemuan' => '__ID__']) }}";

        function openTemuanModal(btn) {
            document.getElementById('temuan-nama').textContent = btn.dataset.nama;
            document.getElementById('temuan-kategori').textContent = btn.dataset.kategori;
            document.getElementById('temuan-lokasi').textContent = btn.dataset.lokasi;
            document.getElementById('temuan-tanggal').textContent = btn.dataset.tanggal;
            document.getElementById('temuan-deskripsi').textContent = btn.dataset.deskripsi;
            const foto = document.getElementById('temuan-foto');
            foto.src = btn.dataset.foto;
            foto.alt = btn.dataset.nama;
            const form = document.getElementById('form-klaim');
            if (form) form.action = klaimActionTemplate.replace('__ID__', btn.dataset.id);
            const modal = document.getElementById('modal-temuan');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeTemuanModal() {
            const modal = document.getElementById('modal-temuan');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openHilangModal(btn) {
            document.getElementById('hilang-nama').textContent = btn.dataset.nama;
            document.getElementById('hilang-kategori').textContent = btn.dataset.kategori;
            document.getElementById('hilang-lokasi').textContent = btn.dataset.lokasi;
            document.getElementById('hilang-tanggal').textContent = btn.dataset.tanggal;
            document.getElementById('hilang-pelapor').textContent = btn.dataset.pelapor;
            document.getElementById('hilang-deskripsi').textContent = btn.dataset.deskripsi;
            const fotoWrapper = document.getElementById('hilang-foto-wrapper');
            const foto = document.getElementById('hilang-foto');
            if (btn.dataset.foto) {
                foto.src = btn.dataset.foto;
                foto.alt = btn.dataset.nama;
                fotoWrapper.classList.remove('hidden');
            } else {
                foto.src = '';
                fotoWrapper.classList.add('hidden');
            }
            const waLink = document.getElementById('hilang-wa-link');
            if (btn.dataset.wa) {
                const pesan = encodeURIComponent(
                    `Halo ${btn.dataset.pelapor}, saya melihat laporan kehilangan "${btn.dataset.nama}" di FindIT UNEJ.`
                );
                waLink.href = `https://wa.me/${btn.dataset.wa}?text=${pesan}`;
                waLink.classList.remove('hidden');
            } else {
                waLink.classList.add('hidden');
            }
            const modal = document.getElementById('modal-hilang');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeHilangModal() {
            const modal = document.getElementById('modal-hilang');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeTemuanModal();
                closeHilangModal();
            }
        });
    </script>
@endpush
