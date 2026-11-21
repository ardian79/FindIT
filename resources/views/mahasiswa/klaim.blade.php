@extends('layouts.app')

@section('title', 'Riwayat Klaim Saya - FindIT UNEJ')

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Riwayat Klaim Saya</h1>
                <p class="mt-1 text-sm text-slate-500">Pantau status verifikasi pengajuan klaim barang temuan Anda di Pos Keamanan Utama UNEJ.</p>
            </div>
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                Cari Barang Temuan
            </a>
        </div>

        @if ($klaim->isEmpty())
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
                <h3 class="mt-3 text-base font-semibold text-slate-900">Belum ada pengajuan klaim</h3>
                <p class="mt-1 text-sm text-slate-500">Temukan barang milik Anda di halaman beranda dan ajukan klaim kepemilikan.</p>
                <a href="{{ route('home') }}" class="mt-5 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Lihat Barang Temuan
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($klaim as $item)
                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex flex-col gap-5 md:flex-row">
                            <div class="h-36 w-full shrink-0 overflow-hidden rounded-xl bg-slate-100 md:h-32 md:w-40">
                                <img src="{{ asset('storage/' . $item->barangTemuan->foto_barang) }}" alt="{{ $item->barangTemuan->nama_barang }}" class="h-full w-full object-cover">
                            </div>

                            <div class="flex-1 space-y-3">
                                <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-start">
                                    <div>
                                        <span class="text-xs font-semibold text-emerald-600">{{ $item->barangTemuan->kategori->nama_kategori }}</span>
                                        <h2 class="text-lg font-bold text-slate-900">{{ $item->barangTemuan->nama_barang }}</h2>
                                        <p class="text-xs text-slate-500">
                                            Ditemukan di {{ $item->barangTemuan->lokasi_ditemukan }} · Diajukan {{ $item->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>

                                    @if ($item->status === 'pending')
                                        <span class="inline-flex w-fit items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                                            Menunggu Verifikasi
                                        </span>
                                    @elseif ($item->status === 'disetujui')
                                        <span class="inline-flex w-fit items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-800">
                                            Disetujui · Siap Diambil
                                        </span>
                                    @elseif ($item->status === 'ditolak')
                                        <span class="inline-flex w-fit items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">
                                            Ditolak
                                        </span>
                                    @else
                                        <span class="inline-flex w-fit items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-800">
                                            Selesai Diambil
                                        </span>
                                    @endif
                                </div>

                                <div class="rounded-xl bg-slate-50 p-3.5 text-sm">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Keterangan Klaim Anda</p>
                                    <p class="mt-1 whitespace-pre-line text-slate-700">{{ $item->keterangan_klaim }}</p>
                                </div>

                                @if ($item->catatan_petugas)
                                    <div class="rounded-xl border border-slate-200 bg-white p-3.5 text-sm">
                                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Catatan Petugas</p>
                                        <p class="mt-1 whitespace-pre-line text-slate-700">{{ $item->catatan_petugas }}</p>
                                    </div>
                                @endif

                                @if ($item->status === 'disetujui')
                                    <div class="flex items-start gap-2.5 rounded-xl border border-blue-200 bg-blue-50 p-3.5 text-sm text-blue-900">
                                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                        </svg>
                                        <p>Klaim Anda telah disetujui. Silakan datang ke <strong>Pos Keamanan Utama UNEJ</strong> dengan membawa KTM atau identitas resmi untuk proses serah terima barang.</p>
                                    </div>
                                @endif

                                @if ($item->status === 'selesai')
                                    <div class="flex flex-wrap items-center justify-between gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-3.5 text-sm text-emerald-900">
                                        <span>Barang telah diambil pada <strong>{{ $item->tanggal_diambil?->format('d M Y, H:i') }}</strong></span>
                                        @if ($item->foto_serah_terima)
                                            <a href="{{ asset('storage/' . $item->foto_serah_terima) }}" target="_blank" class="inline-flex items-center gap-1.5 font-semibold text-emerald-700 underline hover:text-emerald-800">
                                                Lihat Bukti Serah Terima
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $klaim->links() }}
            </div>
        @endif
    </div>
@endsection