@extends('layouts.dashboard')

@section('title', 'Verifikasi Klaim')

@section('header', 'Verifikasi Klaim Barang')

@section('content')
    <div class="space-y-5">

        <form action="{{ route('petugas.verifikasi-klaim.index') }}" method="GET" class="grid grid-cols-1 gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 md:grid-cols-12">
            <div class="relative md:col-span-7">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang, nama pengklaim, atau NIM..." class="w-full rounded-xl border border-slate-300 py-2 pl-10 pr-3.5 text-sm text-slate-900 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
            </div>

            <div class="md:col-span-3">
                <select name="status" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-sm text-slate-700 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="disetujui" {{ request('status') === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="flex gap-2 md:col-span-2">
                <button type="submit" class="flex-1 rounded-full bg-[#c41230] focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#9b1028]">
                    Filter
                </button>
                @if (request()->filled('search') || request()->filled('status'))
                    <a href="{{ route('petugas.verifikasi-klaim.index') }}" class="rounded-xl border border-slate-300 px-3 py-2 text-center text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        @if ($klaim->isEmpty())
            <div class="rounded-[24px] border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-[#f3f5f8] text-slate-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75h16.5v16.5H3.75zM3.75 16.5l4.5-4.5 3.75 3.75 2.25-2.25 6 6" />
                    </svg>
                </div>
                <h3 class="mt-3 text-base font-extrabold text-slate-900">Belum ada pengajuan klaim</h3>
                <p class="mt-1 text-sm text-slate-500">Belum ada pengajuan klaim yang sesuai dengan filter.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                @foreach ($klaim as $item)
                    @php
                        $namaBarang = $item->barangTemuan?->nama_barang ?? 'Barang Temuan';
                        $namaKategori = $item->barangTemuan?->kategori?->nama_kategori ?? 'Umum';
                        $namaPengklaim = $item->pengguna?->nama ?? '-';
                        $nimPengklaim = $item->pengguna?->nim ?? '-';
                        $fotoKlaim = $item->barangTemuan?->foto_barang
                            ? ltrim(preg_replace('#^(public/|storage/)#', '', $item->barangTemuan->foto_barang), '/')
                            : null;
                    @endphp
                    <article class="group flex h-full min-w-0 flex-col overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white shadow-[0_6px_18px_rgba(16,42,76,.04)] transition-[transform,box-shadow,border-color] duration-300 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-1 hover:border-[#d8dee8] hover:shadow-[0_14px_28px_rgba(16,42,76,.1)]">
                        <div class="relative h-[150px] overflow-hidden bg-[#eef1f5] sm:h-[160px]">
                            @if ($fotoKlaim)
                                <img src="{{ Illuminate\Support\Facades\Storage::disk('public')->url($fotoKlaim) }}" alt="{{ $namaBarang }}" onerror="this.hidden=true;this.nextElementSibling?.classList.remove('hidden')" class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.025]">
                                <div class="hidden absolute inset-0 flex items-center justify-center text-slate-400">
                                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75h16.5v16.5H3.75zM3.75 16.5l4.5-4.5 3.75 3.75 2.25-2.25 6 6" />
                                    </svg>
                                </div>
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-slate-400">
                                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75h16.5v16.5H3.75zM3.75 16.5l4.5-4.5 3.75 3.75 2.25-2.25 6 6" />
                                    </svg>
                                </div>
                            @endif

                            <span class="absolute left-3 top-3 inline-flex rounded-full bg-white/95 px-2.5 py-1 text-xs font-bold text-[#17365d] shadow-sm">{{ $namaKategori }}</span>

                            @if ($item->status === 'pending')
                                <span class="absolute right-3 top-3 inline-flex rounded-full bg-[#fff6e8] px-2.5 py-1 text-xs font-bold text-[#9a6700]">Pending</span>
                            @elseif ($item->status === 'disetujui')
                                <span class="absolute right-3 top-3 inline-flex rounded-full bg-[#e8eef6] px-2.5 py-1 text-xs font-bold text-[#17365d]">Disetujui</span>
                            @elseif ($item->status === 'ditolak')
                                <span class="absolute right-3 top-3 inline-flex rounded-full bg-[#fdecee] px-2.5 py-1 text-xs font-bold text-[#9b1028]">Ditolak</span>
                            @else
                                <span class="absolute right-3 top-3 inline-flex rounded-full bg-[#102a4c] px-2.5 py-1 text-xs font-bold text-white">Selesai</span>
                            @endif
                        </div>

                        <div class="flex min-h-0 flex-1 flex-col p-3">
                            <h2 class="line-clamp-2 min-h-10 text-sm font-extrabold leading-5 text-slate-900">{{ $namaBarang }}</h2>

                            <div class="mt-2 space-y-1.5 text-[11px] text-slate-500">
                                <p class="font-bold text-slate-800">{{ $namaPengklaim }}</p>
                                <p>NIM: {{ $nimPengklaim }}</p>
                                <p class="flex items-start gap-2">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 4.5h15A1.5 1.5 0 0121 6v13.5A1.5 1.5 0 0119.5 21h-15A1.5 1.5 0 013 19.5V6A1.5 1.5 0 014.5 4.5z"/></svg>
                                    <span>{{ $item->created_at->format('d M Y') }} · {{ $item->created_at->format('H:i') }} WIB</span>
                                </p>
                            </div>

                            <p class="mt-2 line-clamp-2 min-h-10 flex-1 text-xs leading-5 text-[#3d4b60]">{{ $item->keterangan_klaim ?: 'Tidak ada keterangan klaim.' }}</p>

                            <div class="mt-3 border-t border-[#e7ebf2] pt-3">
                                <a href="{{ route('petugas.verifikasi-klaim.show', $item) }}" class="inline-flex min-h-9 w-full items-center justify-center rounded-full border border-[#d7dde7] bg-white px-3 text-[11px] font-bold text-[#243044] transition duration-200 hover:border-[#102a4c] hover:bg-[#f8fafc] hover:text-[#102a4c] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 active:scale-[.98]">
                                    Detail & Proses
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        <div class="mt-2">
            {{ $klaim->links() }}
        </div>
    </div>
@endsection