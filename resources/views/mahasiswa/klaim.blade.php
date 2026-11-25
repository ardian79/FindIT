@extends('layouts.app')

@section('title', 'Riwayat Klaim Saya - FindIT UNEJ')

@section('content')
    @php
        $btnPrimary =
            'inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]';
        $btnSecondary =
            'inline-flex items-center justify-center gap-2 rounded-xl border border-[#d7dde7] bg-white px-4 py-2.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30';
    @endphp

    <div class="mx-auto max-w-[1160px] px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-ink">Riwayat Klaim Saya</h1>
                <p class="mt-1 text-sm text-ink-muted">Pantau status verifikasi pengajuan klaim barang temuan Anda di Pos
                    Keamanan Utama UNEJ.</p>
            </div>
            <a href="{{ route('home') }}#katalog" class="{{ $btnSecondary }}">
                <svg class="h-4 w-4 text-ink-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                Cari Barang Temuan
            </a>
        </div>

        @if ($klaim->isEmpty())
            <div class="rounded-2xl border border-dashed border-[#d7dde7] bg-white px-6 py-16 text-center">
                <svg class="mx-auto h-10 w-10 text-ink-muted/60" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
                <h2 class="mt-3 text-base font-semibold text-ink">Belum ada pengajuan klaim</h2>
                <p class="mt-1 text-sm text-ink-muted">Temukan barang milik Anda di katalog beranda dan ajukan klaim
                    kepemilikan.</p>
                <a href="{{ route('home') }}#katalog" class="{{ $btnPrimary }} mt-5">Lihat Barang Temuan</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($klaim as $item)
                    @php
                        [$badgeCls, $badgeLabel] = match ($item->status) {
                            'pending' => [
                                'border border-amber-200/80 bg-amber-50 text-amber-800',
                                'Menunggu Verifikasi',
                            ],
                            'disetujui' => ['bg-[#e8eef6] text-ink-navy', 'Disetujui · Siap Diambil'],
                            'ditolak' => ['bg-brand-soft text-brand-dark', 'Ditolak'],
                            default => ['bg-ink-navy text-white', 'Selesai Diambil'],
                        };
                    @endphp
                    <article
                        class="group overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white p-5 transition duration-200 hover:border-[#cfd6e2] hover:shadow-card">
                        <div class="flex flex-col gap-5 md:flex-row md:items-start">
                            <div class="h-40 w-full shrink-0 overflow-hidden rounded-xl bg-[#eef1f5] md:h-32 md:w-40">
                                <img src="{{ asset('storage/' . $item->barangTemuan->foto_barang) }}"
                                    alt="{{ $item->barangTemuan->nama_barang }}" loading="lazy" decoding="async"
                                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]">
                            </div>

                            <div class="flex-1 space-y-3">
                                <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-start">
                                    <div>
                                        <p class="text-xs font-medium text-brand-dark">
                                            {{ $item->barangTemuan->kategori->nama_kategori }}</p>
                                        <h2 class="mt-0.5 text-lg font-semibold text-ink">
                                            {{ $item->barangTemuan->nama_barang }}</h2>
                                        <p class="mt-0.5 text-xs tabular-nums text-ink-muted">
                                            Ditemukan di {{ $item->barangTemuan->lokasi_ditemukan }} · Diajukan
                                            {{ $item->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                    <span
                                        class="inline-flex w-fit items-center rounded-lg px-2.5 py-1 text-xs font-medium {{ $badgeCls }}">{{ $badgeLabel }}</span>
                                </div>

                                <div class="rounded-xl bg-[#f7f8fb] p-4 text-sm">
                                    <p class="text-xs font-medium text-ink-muted">Keterangan klaim Anda</p>
                                    <p class="mt-1 whitespace-pre-line text-[#3d4b60]">{{ $item->keterangan_klaim }}</p>
                                </div>

                                @if ($item->catatan_petugas)
                                    <div class="rounded-xl border border-[#e7ebf2] bg-white p-4 text-sm">
                                        <p class="text-xs font-medium text-ink-muted">Catatan petugas</p>
                                        <p class="mt-1 whitespace-pre-line text-[#3d4b60]">{{ $item->catatan_petugas }}</p>
                                    </div>
                                @endif

                                @if ($item->status === 'disetujui')
                                    <div
                                        class="flex items-start gap-3 rounded-xl border border-[#cddae9] bg-[#f4f7fb] p-4 text-sm text-ink-navy">
                                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-ink-navy" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                                            aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                        </svg>
                                        <p>Klaim Anda telah disetujui. Silakan datang ke <strong class="font-semibold">Pos
                                                Keamanan Utama UNEJ</strong> dengan membawa KTM atau identitas resmi untuk
                                            serah terima barang.</p>
                                    </div>
                                @elseif ($item->status === 'selesai')
                                    <div
                                        class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-[#e7ebf2] bg-[#f7f8fb] p-4 text-sm text-ink">
                                        <span class="tabular-nums">Barang telah diambil pada <strong
                                                class="font-semibold">{{ $item->tanggal_diambil?->format('d M Y, H:i') }}</strong></span>
                                        @if ($item->foto_serah_terima)
                                            <a href="{{ asset('storage/' . $item->foto_serah_terima) }}" target="_blank"
                                                rel="noopener"
                                                class="font-medium text-ink-navy underline underline-offset-4 hover:text-brand">
                                                Lihat Bukti Serah Terima
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-6">{{ $klaim->links() }}</div>
        @endif
    </div>
@endsection
