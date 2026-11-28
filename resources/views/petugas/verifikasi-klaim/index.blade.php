@extends('layouts.petugas')

@section('title', 'Verifikasi Klaim')
@section('header', 'Verifikasi Klaim Barang')

@section('content')
    <div class="space-y-5">
        <form action="{{ route('petugas.verifikasi-klaim.index') }}" method="GET"
            class="flex flex-col gap-3 rounded-2xl border border-[#e7ebf2] bg-white p-4 md:flex-row md:flex-wrap md:items-center">
            <div class="relative min-w-50 flex-1">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-muted"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari barang, pengklaim, atau NIM"
                    class="h-10.5 w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10 pl-10">
            </div>

            <div class="w-full md:w-44">
                <select name="status"
                    class="h-10.5 w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
                    <option value="">Semua Status</option>
                    @foreach (['pending' => 'Pending', 'disetujui' => 'Disetujui', 'selesai' => 'Selesai', 'ditolak' => 'Ditolak'] as $val => $label)
                        <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex shrink-0 items-center gap-2">
                <button type="submit"
                    class="inline-flex h-10.5 flex-1 items-center justify-center rounded-xl bg-brand px-5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98] md:flex-none">Filter</button>
                @if (request()->anyFilled(['search', 'status']))
                    <a href="{{ route('petugas.verifikasi-klaim.index') }}"
                        class="inline-flex h-10.5 items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-3.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Reset</a>
                @endif
            </div>
        </form>

        @if ($klaim->isEmpty())
            <div class="rounded-2xl border border-dashed border-[#d7dde7] bg-white px-6 py-16 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-[#f3f5f8] text-ink-muted">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3.75h16.5v16.5H3.75zM3.75 16.5l4.5-4.5 3.75 3.75 2.25-2.25 6 6" />
                    </svg>
                </div>
                <h2 class="mt-3 text-base font-semibold text-ink">Belum ada pengajuan klaim</h2>
                <p class="mt-1 text-sm text-ink-muted">Belum ada pengajuan klaim yang sesuai dengan filter.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($klaim as $item)
                    <article
                        class="group flex h-full min-w-0 flex-col overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white transition duration-200 hover:-translate-y-1 hover:border-[#cfd6e2] hover:shadow-card">
                        <div class="relative h-40 overflow-hidden bg-[#eef1f5]">
                            @if (
                                $item->barangTemuan?->foto_barang &&
                                    is_file(public_path('storage/' . ltrim(preg_replace('#^(public/|storage/)#', '', $item->barangTemuan->foto_barang), '/'))))
                                <img src="{{ asset('storage/' . ltrim(preg_replace('#^(public/|storage/)#', '', $item->barangTemuan->foto_barang), '/')) }}"
                                    alt="{{ $item->barangTemuan?->nama_barang ?? 'Barang Temuan' }}" loading="lazy"
                                    decoding="async"
                                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-ink-muted/60">
                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="1.5" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 3.75h16.5v16.5H3.75zM3.75 16.5l4.5-4.5 3.75 3.75 2.25-2.25 6 6" />
                                    </svg>
                                </div>
                            @endif
                            <span
                                class="absolute left-3 top-3 rounded-lg bg-white/95 px-2 py-0.5 text-xs font-medium text-ink shadow-sm">{{ $item->barangTemuan?->kategori?->nama_kategori ?? 'Umum' }}</span>
                            
                            @if ($item->status === 'pending')
                                <span class="absolute right-3 top-3 rounded-lg px-2 py-0.5 text-xs font-medium border border-amber-200/80 bg-amber-50 text-amber-800">Pending</span>
                            @elseif ($item->status === 'disetujui')
                                <span class="absolute right-3 top-3 rounded-lg px-2 py-0.5 text-xs font-medium bg-[#e8eef6] text-ink-navy">Disetujui</span>
                            @elseif ($item->status === 'ditolak')
                                <span class="absolute right-3 top-3 rounded-lg px-2 py-0.5 text-xs font-medium bg-brand-soft text-brand-dark">Ditolak</span>
                            @else
                                <span class="absolute right-3 top-3 rounded-lg px-2 py-0.5 text-xs font-medium bg-ink-navy text-white">Selesai</span>
                            @endif
                            
                        </div>

                        <div class="flex min-h-0 flex-1 flex-col p-4">
                            <h2 class="line-clamp-2 min-h-10 text-sm font-semibold leading-5 text-ink">
                                {{ $item->barangTemuan?->nama_barang ?? 'Barang Temuan' }}
                            </h2>
                            <div class="mt-2 space-y-1 text-xs text-ink-muted">
                                <p class="font-medium text-ink">{{ $item->pengguna?->nama ?? '-' }}</p>
                                <p class="tabular-nums">NIM: {{ $item->pengguna?->nim ?? '-' }}</p>
                                <p class="flex items-start gap-2 tabular-nums">
                                    <svg class="mt-0.5 h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 4.5h15A1.5 1.5 0 0121 6v13.5A1.5 1.5 0 0119.5 21h-15A1.5 1.5 0 013 19.5V6A1.5 1.5 0 014.5 4.5z" />
                                    </svg>
                                    <span>{{ $item->created_at->format('d M Y · H:i') }} WIB</span>
                                </p>
                            </div>
                            <p class="mt-2 line-clamp-2 min-h-10 flex-1 text-xs leading-5 text-[#3d4b60]">
                                {{ $item->keterangan_klaim ?: 'Tidak ada keterangan klaim.' }}</p>

                            <div class="mt-3 border-t border-[#e7ebf2] pt-3">
                                <a href="{{ route('petugas.verifikasi-klaim.show', $item) }}"
                                    class="inline-flex h-9 w-full items-center justify-center rounded-lg border border-[#d7dde7] bg-white px-3 text-xs font-medium text-ink transition-colors duration-150 hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
                                    Detail &amp; Proses
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

    </div>
@endsection