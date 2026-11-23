@extends('layouts.dashboard')

@section('title', 'Dashboard Petugas')
@section('header', 'Dashboard Operasional')

@section('content')
    @php
        $statCards = [
            [route('petugas.barang-temuan.index', ['status' => 'tersedia']), 'Temuan Tersedia', $totalTersedia, 'Siap diklaim di Pos Keamanan', false, 'M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z'],
            [route('petugas.verifikasi-klaim.index', ['status' => 'pending']), 'Klaim Pending', $totalKlaimPending, 'Menunggu verifikasi petugas', $totalKlaimPending > 0, 'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z'],
            [route('petugas.barang-temuan.index', ['status' => 'diklaim']), 'Menunggu Diambil', $totalDiklaim, 'Barang temuan berstatus diklaim', false, 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z'],
            [route('petugas.barang-temuan.index', ['status' => 'dikembalikan']), 'Sudah Dikembalikan', $totalDikembalikan, 'Selesai serah terima ke pemilik', false, 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            [route('petugas.laporan-kehilangan.index', ['status' => 'dicari']), 'Laporan Dicari', $totalLaporanDicari, 'Barang hilang aktif dilaporkan', false, 'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z'],
            [route('petugas.pengguna.index', ['status' => 'aktif']), 'Mahasiswa Aktif', $totalMahasiswaAktif, 'Akun mahasiswa terdaftar aktif', false, 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z'],
        ];
    @endphp

    <div class="space-y-6">
        <div class="flex flex-col gap-4 rounded-2xl border border-[#e7ebf2] bg-white p-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-medium text-ink-muted">Pos Keamanan Utama UNEJ · {{ now()->format('d M Y') }}</p>
                <h2 class="mt-1 text-xl font-semibold tracking-tight text-ink">Ringkasan Operasional</h2>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('petugas.barang-temuan.create') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Temuan
                </a>
                <a href="{{ route('petugas.verifikasi-klaim.index', ['status' => 'pending']) }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-[#d7dde7] bg-white px-4 py-2.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
                    Cek Klaim Pending
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($statCards as [$href, $title, $value, $hint, $highlight, $path])
                <a href="{{ $href }}"
                    class="group flex items-center justify-between rounded-2xl border border-[#e7ebf2] bg-white p-5 transition duration-200 hover:-translate-y-0.5 hover:border-[#cfd6e2] hover:bg-[#fafbfd] hover:shadow-card focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
                    <div>
                        <p class="text-xs font-medium text-ink-muted">{{ $title }}</p>
                        <p class="mt-2 text-3xl font-semibold tabular-nums {{ $highlight ? 'text-brand' : 'text-ink' }}">{{ $value }}</p>
                        <p class="mt-1 text-xs text-ink-muted">{{ $hint }}</p>
                    </div>
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl transition-transform duration-200 group-hover:scale-105 {{ $highlight ? 'bg-brand-soft text-brand' : 'bg-[#f3f5f8] text-ink-muted' }}">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $path }}" />
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
                <div class="flex items-center justify-between border-b border-[#e7ebf2] px-5 py-4">
                    <div>
                        <h3 class="text-base font-semibold text-ink">Klaim Menunggu Verifikasi</h3>
                        <p class="text-xs text-ink-muted">5 pengajuan klaim terbaru</p>
                    </div>
                    <a href="{{ route('petugas.verifikasi-klaim.index') }}" class="text-xs font-medium text-ink-navy hover:text-brand">Lihat Semua</a>
                </div>
                @forelse ($klaimTerbaru as $item)
                    <div class="flex items-center justify-between gap-4 border-t border-[#e7ebf2] px-5 py-3 first:border-t-0 hover:bg-[#f7f8fb]">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-ink">{{ $item->barangTemuan->nama_barang }}</p>
                            <p class="truncate text-xs tabular-nums text-ink-muted">{{ $item->pengguna->nama }} ({{ $item->pengguna->nim }}) · {{ $item->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <a href="{{ route('petugas.verifikasi-klaim.show', $item) }}"
                            class="shrink-0 rounded-lg border border-[#d7dde7] bg-white px-3 py-1.5 text-xs font-medium text-ink transition-colors duration-150 hover:border-ink-navy hover:text-ink-navy focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
                            Periksa
                        </a>
                    </div>
                @empty
                    <div class="px-5 py-10 text-center text-sm text-ink-muted">Tidak ada klaim pending saat ini.</div>
                @endforelse
            </div>

            <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
                <div class="flex items-center justify-between border-b border-[#e7ebf2] px-5 py-4">
                    <div>
                        <h3 class="text-base font-semibold text-ink">Laporan Kehilangan Terbaru</h3>
                        <p class="text-xs text-ink-muted">5 barang hilang yang sedang dicari</p>
                    </div>
                    <a href="{{ route('petugas.laporan-kehilangan.index') }}" class="text-xs font-medium text-ink-navy hover:text-brand">Lihat Semua</a>
                </div>
                @forelse ($laporanTerbaru as $item)
                    <div class="flex items-center justify-between gap-4 border-t border-[#e7ebf2] px-5 py-3 first:border-t-0 hover:bg-[#f7f8fb]">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-ink">{{ $item->nama_barang }}</p>
                            <p class="truncate text-xs tabular-nums text-ink-muted">{{ $item->pengguna->nama }} · {{ $item->lokasi_hilang }} · {{ $item->tanggal_hilang->format('d M Y') }}</p>
                        </div>
                        <span class="shrink-0 rounded-lg bg-[#f3f5f8] px-2.5 py-1 text-xs font-medium text-[#3d4b60]">{{ $item->kategori->nama_kategori }}</span>
                    </div>
                @empty
                    <div class="px-5 py-10 text-center text-sm text-ink-muted">Belum ada laporan kehilangan aktif.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
