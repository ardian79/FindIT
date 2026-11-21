@extends('layouts.dashboard')

@section('title', 'Dashboard Petugas')

@section('header', 'Dashboard Operasional')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-4 rounded-2xl border border-red-200 bg-red-50 p-6 text-slate-900 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-[#94191d]">Pos Keamanan UNEJ</p>
                <h2 class="mt-1 text-xl font-bold">Selamat datang, {{ Auth::user()->nama }}</h2>
            </div>
            <div class="flex flex-wrap gap-2.5">
                <a href="{{ route('petugas.barang-temuan.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-[#94191d] transition hover:bg-red-50">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Temuan
                </a>
                <a href="{{ route('petugas.verifikasi-klaim.index', ['status' => 'pending']) }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition-all duration-150 hover:bg-slate-50 active:scale-[0.98]">
                    Cek Klaim Pending
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
            <a href="{{ route('petugas.barang-temuan.index', ['status' => 'tersedia']) }}" class="flex items-center justify-between rounded-2xl border border-slate-200/80 bg-white p-5 transition-all duration-150 hover:border-red-300 active:scale-[0.98]">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Temuan Tersedia</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalTersedia }}</p>
                    <p class="mt-1 text-xs text-slate-500">Siap diklaim di Pos Keamanan</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50 text-[#b12025]">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('petugas.verifikasi-klaim.index', ['status' => 'pending']) }}" class="flex items-center justify-between rounded-2xl border border-slate-200/80 bg-white p-5 transition-all duration-150 hover:border-red-300 active:scale-[0.98]">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Klaim Pending</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalKlaimPending }}</p>
                    <p class="mt-1 text-xs text-slate-500">Menunggu verifikasi petugas</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('petugas.barang-temuan.index', ['status' => 'diklaim']) }}" class="flex items-center justify-between rounded-2xl border border-slate-200/80 bg-white p-5 transition-all duration-150 hover:border-red-300 active:scale-[0.98]">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Menunggu Diambil</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalDiklaim }}</p>
                    <p class="mt-1 text-xs text-slate-500">Barang temuan berstatus diklaim</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('petugas.barang-temuan.index', ['status' => 'dikembalikan']) }}" class="flex items-center justify-between rounded-2xl border border-slate-200/80 bg-white p-5 transition-all duration-150 hover:border-red-300 active:scale-[0.98]">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Sudah Dikembalikan</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalDikembalikan }}</p>
                    <p class="mt-1 text-xs text-slate-500">Selesai serah terima ke pemilik</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-[#17365d]">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('petugas.laporan-kehilangan.index', ['status' => 'dicari']) }}" class="flex items-center justify-between rounded-2xl border border-slate-200/80 bg-white p-5 transition-all duration-150 hover:border-red-300 active:scale-[0.98]">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Laporan Dicari</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalLaporanDicari }}</p>
                    <p class="mt-1 text-xs text-slate-500">Barang hilang aktif dilaporkan</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
            </a>

            <a href="{{ route('petugas.pengguna.index', ['status' => 'aktif']) }}" class="flex items-center justify-between rounded-2xl border border-slate-200/80 bg-white p-5 transition-all duration-150 hover:border-red-300 active:scale-[0.98]">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Mahasiswa Aktif</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalMahasiswaAktif }}</p>
                    <p class="mt-1 text-xs text-slate-500">Akun mahasiswa terdaftar aktif</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">
            <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white">
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Klaim Menunggu Verifikasi</h3>
                        <p class="text-xs text-slate-500">5 pengajuan klaim terbaru</p>
                    </div>
                    <a href="{{ route('petugas.verifikasi-klaim.index') }}" class="text-xs font-semibold text-[#b12025] hover:text-[#94191d]">Lihat Semua</a>
                </div>

                @if ($klaimTerbaru->isEmpty())
                    <div class="px-5 py-10 text-center text-sm text-slate-500">
                        Tidak ada klaim pending saat ini.
                    </div>
                @else
                    <div class="divide-y divide-slate-200">
                        @foreach ($klaimTerbaru as $item)
                            <div class="flex items-center justify-between gap-4 px-5 py-3.5 hover:bg-slate-50/70">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-slate-900">{{ $item->barangTemuan->nama_barang }}</p>
                                    <p class="truncate text-xs text-slate-500">
                                        {{ $item->pengguna->nama }} ({{ $item->pengguna->nim }}) · {{ $item->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                                <a href="{{ route('petugas.verifikasi-klaim.show', $item) }}" class="shrink-0 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-[#94191d] transition hover:bg-red-50">
                                    Periksa
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white">
                <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Laporan Kehilangan Terbaru</h3>
                        <p class="text-xs text-slate-500">5 barang hilang yang sedang dicari</p>
                    </div>
                    <a href="{{ route('petugas.laporan-kehilangan.index') }}" class="text-xs font-semibold text-[#b12025] hover:text-[#94191d]">Lihat Semua</a>
                </div>

                @if ($laporanTerbaru->isEmpty())
                    <div class="px-5 py-10 text-center text-sm text-slate-500">
                        Belum ada laporan kehilangan aktif.
                    </div>
                @else
                    <div class="divide-y divide-slate-200">
                        @foreach ($laporanTerbaru as $item)
                            <div class="flex items-center justify-between gap-4 px-5 py-3.5 hover:bg-slate-50/70">
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-slate-900">{{ $item->nama_barang }}</p>
                                    <p class="truncate text-xs text-slate-500">
                                        {{ $item->pengguna->nama }} · {{ $item->lokasi_hilang }} · {{ $item->tanggal_hilang->format('d M Y') }}
                                    </p>
                                </div>
                                <span class="shrink-0 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-800">
                                    {{ $item->kategori->nama_kategori }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection