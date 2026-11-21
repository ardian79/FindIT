@extends('layouts.app')

@section('title', 'FindIT - Lost & Found Universitas Jember')

@section('content')
    @php
        $waPetugas = $petugas && $petugas->no_hp ? preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $petugas->no_hp)) : null;
    @endphp

    <section class="mx-auto max-w-7xl px-4 pb-6 pt-4 sm:px-6 lg:px-8">
        <div class="overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-700 via-emerald-600 to-teal-600 p-6 text-white shadow-sm sm:p-10">
            <div class="grid grid-cols-1 items-center gap-8 lg:grid-cols-12">
                <div class="lg:col-span-7">
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-1 text-xs font-medium text-emerald-50 backdrop-blur">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        Pos Keamanan Utama Universitas Jember
                    </span>
                    <h1 class="mt-4 text-2xl font-bold tracking-tight sm:text-4xl">
                        Temukan Barang Hilang Anda di Lingkungan Kampus UNEJ
                    </h1>
                    <p class="mt-3 max-w-2xl text-sm leading-relaxed text-emerald-50/90 sm:text-base">
                        Pantau barang temuan yang diamankan petugas atau publikasikan laporan kehilangan Anda. Seluruh serah terima barang dilakukan terpusat di Pos Keamanan Utama UNEJ.
                    </p>
                    <div class="mt-6 flex flex-wrap items-center gap-3">
                        @auth
                            @if (Auth::user()->role === 'mahasiswa')
                                <a href="{{ route('mahasiswa.laporan.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Buat Laporan Kehilangan
                                </a>
                            @else
                                <a href="{{ route('petugas.dashboard') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50">
                                    Buka Panel Petugas
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Laporkan Kehilangan
                            </a>
                        @endauth

                        @if ($waPetugas)
                            <a href="https://wa.me/{{ $waPetugas }}?text={{ urlencode('Halo Petugas Pos Keamanan UNEJ, saya ingin menanyakan informasi terkait layanan FindIT.') }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl border border-white/30 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-white/20">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                </svg>
                                Hubungi Pos Keamanan
                            </a>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3 lg:col-span-5">
                    <div class="rounded-2xl bg-white/10 p-4 backdrop-blur">
                        <p class="text-2xl font-bold sm:text-3xl">{{ $totalTersedia }}</p>
                        <p class="mt-1 text-xs text-emerald-100">Temuan Tersedia</p>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-4 backdrop-blur">
                        <p class="text-2xl font-bold sm:text-3xl">{{ $totalDicari }}</p>
                        <p class="mt-1 text-xs text-emerald-100">Sedang Dicari</p>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-4 backdrop-blur">
                        <p class="text-2xl font-bold sm:text-3xl">{{ $totalDikembalikan }}</p>
                        <p class="mt-1 text-xs text-emerald-100">Dikembalikan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm lg:flex-row lg:items-center lg:justify-between">
            <div class="inline-flex rounded-xl bg-slate-100 p-1">
                <a href="{{ route('home', array_merge(request()->except(['page_temuan', 'page_hilang']), ['tab' => 'temuan'])) }}" class="flex-1 rounded-lg px-4 py-2 text-center text-sm font-semibold transition sm:flex-none {{ $tab !== 'hilang' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                    Barang Temuan ({{ $totalTersedia }})
                </a>
                <a href="{{ route('home', array_merge(request()->except(['page_temuan', 'page_hilang']), ['tab' => 'hilang'])) }}" class="flex-1 rounded-lg px-4 py-2 text-center text-sm font-semibold transition sm:flex-none {{ $tab === 'hilang' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                    Barang Hilang ({{ $totalDicari }})
                </a>
            </div>

            <form action="{{ route('home') }}" method="GET" class="flex flex-1 flex-col gap-2.5 sm:flex-row lg:max-w-2xl lg:justify-end">
                <input type="hidden" name="tab" value="{{ $tab }}">

                <div class="relative flex-1">
                    <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang atau lokasi..." class="w-full rounded-xl border border-slate-300 py-2 pl-10 pr-3.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <select name="kategori_id" class="rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Cari
                </button>

                @if (request()->filled('search') || request()->filled('kategori_id'))
                    <a href="{{ route('home', ['tab' => $tab]) }}" class="rounded-xl border border-slate-300 px-4 py-2 text-center text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        @if ($tab !== 'hilang')
            @if ($barangTemuan->isEmpty())
                <div class="mt-6 rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <h3 class="mt-3 text-base font-semibold text-slate-900">Belum ada barang temuan yang sesuai</h3>
                    <p class="mt-1 text-sm text-slate-500">Coba ubah kata kunci pencarian atau periksa kembali nanti.</p>
                </div>
            @else
                <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($barangTemuan as $item)
                        <article class="flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                            <div class="relative h-48 bg-slate-100">
                                <img src="{{ asset('storage/' . $item->foto_barang) }}" alt="{{ $item->nama_barang }}" class="h-full w-full object-cover">
                                <span class="absolute left-3 top-3 rounded-lg bg-white/90 px-2.5 py-1 text-xs font-semibold text-slate-700 backdrop-blur">
                                    {{ $item->kategori->nama_kategori }}
                                </span>
                                <span class="absolute right-3 top-3 rounded-lg bg-emerald-600 px-2.5 py-1 text-xs font-semibold text-white">
                                    Tersedia
                                </span>
                            </div>

                            <div class="flex flex-1 flex-col p-5">
                                <h2 class="text-base font-bold text-slate-900">{{ $item->nama_barang }}</h2>

                                <div class="mt-2.5 space-y-1.5 text-xs text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span class="truncate">{{ $item->lokasi_ditemukan }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        <span>Ditemukan {{ $item->tanggal_ditemukan->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <p class="mt-3 line-clamp-2 flex-1 text-sm text-slate-600">{{ $item->deskripsi }}</p>

                                <button type="button"
                                    onclick="openTemuanModal(this)"
                                    data-id="{{ $item->id }}"
                                    data-nama="{{ $item->nama_barang }}"
                                    data-kategori="{{ $item->kategori->nama_kategori }}"
                                    data-lokasi="{{ $item->lokasi_ditemukan }}"
                                    data-tanggal="{{ $item->tanggal_ditemukan->format('d M Y') }}"
                                    data-deskripsi="{{ $item->deskripsi }}"
                                    data-foto="{{ asset('storage/' . $item->foto_barang) }}"
                                    class="mt-4 w-full rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-600">
                                    Lihat Detail & Klaim
                                </button>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $barangTemuan->links() }}
                </div>
            @endif
        @else
            @if ($laporanKehilangan->isEmpty())
                <div class="mt-6 rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <h3 class="mt-3 text-base font-semibold text-slate-900">Belum ada laporan barang hilang yang sesuai</h3>
                    <p class="mt-1 text-sm text-slate-500">Semua laporan kehilangan yang sedang dicari akan tampil di sini.</p>
                </div>
            @else
                <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($laporanKehilangan as $item)
                        @php
                            $waPelapor = $item->pengguna && $item->pengguna->no_hp ? preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $item->pengguna->no_hp)) : '';
                        @endphp
                        <article class="flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                            <div class="relative flex h-48 items-center justify-center bg-slate-100">
                                @if ($item->foto_barang)
                                    <img src="{{ asset('storage/' . $item->foto_barang) }}" alt="{{ $item->nama_barang }}" class="h-full w-full object-cover">
                                @else
                                    <div class="flex flex-col items-center text-slate-400">
                                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                        <span class="mt-1 text-xs">Tanpa Foto</span>
                                    </div>
                                @endif
                                <span class="absolute left-3 top-3 rounded-lg bg-white/90 px-2.5 py-1 text-xs font-semibold text-slate-700 backdrop-blur">
                                    {{ $item->kategori->nama_kategori }}
                                </span>
                                <span class="absolute right-3 top-3 rounded-lg bg-amber-500 px-2.5 py-1 text-xs font-semibold text-white">
                                    Dicari
                                </span>
                            </div>

                            <div class="flex flex-1 flex-col p-5">
                                <h2 class="text-base font-bold text-slate-900">{{ $item->nama_barang }}</h2>

                                <div class="mt-2.5 space-y-1.5 text-xs text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span class="truncate">{{ $item->lokasi_hilang }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        <span>Hilang {{ $item->tanggal_hilang->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="h-4 w-4 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        <span class="truncate">Pelapor: {{ $item->pengguna->nama }}</span>
                                    </div>
                                </div>

                                <p class="mt-3 line-clamp-2 flex-1 text-sm text-slate-600">{{ $item->deskripsi }}</p>

                                <button type="button"
                                    onclick="openHilangModal(this)"
                                    data-nama="{{ $item->nama_barang }}"
                                    data-kategori="{{ $item->kategori->nama_kategori }}"
                                    data-lokasi="{{ $item->lokasi_hilang }}"
                                    data-tanggal="{{ $item->tanggal_hilang->format('d M Y') }}"
                                    data-pelapor="{{ $item->pengguna->nama }}"
                                    data-wa="{{ $waPelapor }}"
                                    data-deskripsi="{{ $item->deskripsi }}"
                                    data-foto="{{ $item->foto_barang ? asset('storage/' . $item->foto_barang) : '' }}"
                                    class="mt-4 w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-emerald-600 hover:bg-emerald-50 hover:text-emerald-700">
                                    Lihat Detail
                                </button>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $laporanKehilangan->links() }}
                </div>
            @endif
        @endif
    </section>

    <div id="modal-temuan" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 p-4 backdrop-blur-sm">
        <div class="relative max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white shadow-xl">
            <div class="sticky top-0 z-10 flex items-center justify-between border-b border-slate-200 bg-white px-6 py-4">
                <div>
                    <span id="temuan-kategori" class="text-xs font-semibold uppercase tracking-wider text-emerald-600"></span>
                    <h3 id="temuan-nama" class="text-lg font-bold text-slate-900"></h3>
                </div>
                <button type="button" onclick="closeTemuanModal()" class="rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6">
                <div class="overflow-hidden rounded-xl bg-slate-100">
                    <img id="temuan-foto" src="" alt="" class="max-h-72 w-full object-contain">
                </div>

                <div class="mt-5 grid grid-cols-1 gap-3 rounded-xl bg-slate-50 p-4 text-sm sm:grid-cols-2">
                    <div>
                        <span class="block text-xs text-slate-500">Lokasi Ditemukan</span>
                        <span id="temuan-lokasi" class="font-semibold text-slate-900"></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Tanggal Ditemukan</span>
                        <span id="temuan-tanggal" class="font-semibold text-slate-900"></span>
                    </div>
                    <div class="sm:col-span-2">
                        <span class="block text-xs text-slate-500">Lokasi Penyimpanan</span>
                        <span class="font-semibold text-emerald-700">Pos Keamanan Utama Universitas Jember</span>
                    </div>
                </div>

                <div class="mt-4">
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-slate-500">Deskripsi Barang</h4>
                    <p id="temuan-deskripsi" class="mt-1.5 whitespace-pre-line text-sm leading-relaxed text-slate-700"></p>
                </div>

                <div class="mt-6 border-t border-slate-200 pt-5">
                    @auth
                        @if (Auth::user()->role === 'mahasiswa')
                            <h4 class="text-sm font-bold text-slate-900">Ajukan Klaim Kepemilikan</h4>
                            <p class="mt-1 text-xs text-slate-500">Jelaskan ciri khusus barang (warna bagian dalam, isi, stiker, atau bukti lainnya) untuk mempermudah verifikasi petugas.</p>

                            <form id="form-klaim" action="" method="POST" class="mt-3 space-y-3">
                                @csrf
                                <textarea name="keterangan_klaim" rows="3" required placeholder="Tuliskan ciri spesifik atau bukti kepemilikan barang..." class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20"></textarea>
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="closeTemuanModal()" class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                                        Batal
                                    </button>
                                    <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                                        Kirim Pengajuan Klaim
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 p-4 text-sm text-slate-600">
                                <span>Anda masuk sebagai Petugas Keamanan.</span>
                                <a href="{{ route('petugas.barang-temuan.index') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">Kelola Barang Temuan</a>
                            </div>
                        @endif
                    @else
                        <div class="flex flex-col items-start justify-between gap-3 rounded-xl bg-emerald-50 p-4 sm:flex-row sm:items-center">
                            <p class="text-sm text-emerald-900">Merasa ini barang milik Anda? Silakan masuk dengan akun mahasiswa untuk mengajukan klaim.</p>
                            <a href="{{ route('login') }}" class="shrink-0 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                                Masuk
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div id="modal-hilang" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 p-4 backdrop-blur-sm">
        <div class="relative max-h-[90vh] w-full max-w-xl overflow-y-auto rounded-2xl bg-white shadow-xl">
            <div class="sticky top-0 z-10 flex items-center justify-between border-b border-slate-200 bg-white px-6 py-4">
                <div>
                    <span id="hilang-kategori" class="text-xs font-semibold uppercase tracking-wider text-amber-600"></span>
                    <h3 id="hilang-nama" class="text-lg font-bold text-slate-900"></h3>
                </div>
                <button type="button" onclick="closeHilangModal()" class="rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6">
                <div id="hilang-foto-wrapper" class="mb-5 hidden overflow-hidden rounded-xl bg-slate-100">
                    <img id="hilang-foto" src="" alt="" class="max-h-72 w-full object-contain">
                </div>

                <div class="grid grid-cols-1 gap-3 rounded-xl bg-slate-50 p-4 text-sm sm:grid-cols-2">
                    <div>
                        <span class="block text-xs text-slate-500">Perkiraan Lokasi Hilang</span>
                        <span id="hilang-lokasi" class="font-semibold text-slate-900"></span>
                    </div>
                    <div>
                        <span class="block text-xs text-slate-500">Tanggal Hilang</span>
                        <span id="hilang-tanggal" class="font-semibold text-slate-900"></span>
                    </div>
                    <div class="sm:col-span-2">
                        <span class="block text-xs text-slate-500">Pelapor</span>
                        <span id="hilang-pelapor" class="font-semibold text-slate-900"></span>
                    </div>
                </div>

                <div class="mt-4">
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-slate-500">Deskripsi & Ciri-Ciri</h4>
                    <p id="hilang-deskripsi" class="mt-1.5 whitespace-pre-line text-sm leading-relaxed text-slate-700"></p>
                </div>

                <div class="mt-6 flex flex-wrap justify-end gap-2 border-t border-slate-200 pt-4">
                    <button type="button" onclick="closeHilangModal()" class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        Tutup
                    </button>
                    <a id="hilang-wa-link" href="#" target="_blank" class="hidden items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                        </svg>
                        Hubungi Pelapor via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
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
            if (form) {
                form.action = klaimActionTemplate.replace('__ID__', btn.dataset.id);
            }

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
                const pesan = encodeURIComponent(`Halo ${btn.dataset.pelapor}, saya melihat laporan kehilangan "${btn.dataset.nama}" di FindIT UNEJ.`);
                waLink.href = `https://wa.me/${btn.dataset.wa}?text=${pesan}`;
                waLink.classList.remove('hidden');
                waLink.classList.add('inline-flex');
            } else {
                waLink.classList.add('hidden');
                waLink.classList.remove('inline-flex');
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

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeTemuanModal();
                closeHilangModal();
            }
        });
    </script>
@endpush