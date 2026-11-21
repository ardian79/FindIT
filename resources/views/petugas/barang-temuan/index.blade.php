@extends('layouts.dashboard')

@section('title', 'Kelola Barang Temuan')

@section('header', 'Kelola Barang Temuan')

@section('content')
    <div class="space-y-5">
        <div class="flex items-center justify-start">
            <a href="{{ route('petugas.barang-temuan.create') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-[#c41230] focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#9b1028]">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Barang Temuan
            </a>
        </div>

        <form action="{{ route('petugas.barang-temuan.index') }}" method="GET" class="grid grid-cols-1 gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 md:grid-cols-12">
            <div class="relative md:col-span-5">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang atau lokasi..." class="w-full rounded-xl border border-slate-300 py-2 pl-10 pr-3.5 text-sm text-slate-900 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
            </div>

            <div class="md:col-span-3">
                <select name="kategori_id" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-sm text-slate-700 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <select name="status" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-sm text-slate-700 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="diklaim" {{ request('status') === 'diklaim' ? 'selected' : '' }}>Diklaim</option>
                    <option value="dikembalikan" {{ request('status') === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>

            <div class="flex gap-2 md:col-span-2">
                <button type="submit" class="flex-1 rounded-full bg-[#c41230] focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#9b1028]">
                    Filter
                </button>
                @if (request()->filled('search') || request()->filled('kategori_id') || request()->filled('status'))
                    <a href="{{ route('petugas.barang-temuan.index') }}" class="rounded-xl border border-slate-300 px-3 py-2 text-center text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        @if ($barangTemuan->isEmpty())
            <div class="rounded-[24px] border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-[#f3f5f8] text-slate-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75h16.5v16.5H3.75zM3.75 16.5l4.5-4.5 3.75 3.75 2.25-2.25 6 6" />
                    </svg>
                </div>
                <h3 class="mt-3 text-base font-extrabold text-slate-900">Belum ada barang temuan</h3>
                <p class="mt-1 text-sm text-slate-500">Belum ada data barang temuan yang sesuai dengan filter.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                @foreach ($barangTemuan as $item)
                    <article class="group flex h-full min-w-0 flex-col overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white shadow-[0_6px_18px_rgba(16,42,76,.04)] transition-[transform,box-shadow,border-color] duration-300 ease-[cubic-bezier(.22,1,.36,1)] hover:-translate-y-1 hover:border-[#d8dee8] hover:shadow-[0_14px_28px_rgba(16,42,76,.1)]">
                        <div class="relative h-[150px] overflow-hidden bg-[#eef1f5] sm:h-[160px]">
                            @if ($item->foto_barang)
                                @php
                                    $fotoBarang = ltrim(preg_replace('#^(public/|storage/)#', '', $item->foto_barang), '/');
                                @endphp
                                <img src="{{ Illuminate\Support\Facades\Storage::disk('public')->url($fotoBarang) }}" alt="{{ $item->nama_barang }}" onerror="this.hidden=true;this.nextElementSibling?.classList.remove('hidden')" class="h-full w-full object-cover transition duration-300 group-hover:scale-[1.025]">
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
                            <span class="absolute left-3 top-3 inline-flex rounded-full bg-white/95 px-2.5 py-1 text-xs font-bold text-[#17365d] shadow-sm">{{ $item->kategori->nama_kategori }}</span>
                            @if ($item->status === 'tersedia')
                                <span class="absolute right-3 top-3 inline-flex rounded-full bg-[#102a4c] px-2.5 py-1 text-xs font-bold text-white">Tersedia</span>
                            @elseif ($item->status === 'diklaim')
                                <span class="absolute right-3 top-3 inline-flex rounded-full bg-[#e8eef6] px-2.5 py-1 text-xs font-bold text-[#17365d]">Diklaim</span>
                            @else
                                <span class="absolute right-3 top-3 inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-bold text-slate-700">Dikembalikan</span>
                            @endif
                        </div>

                        <div class="flex min-h-0 flex-1 flex-col p-3">
                            <h2 class="line-clamp-2 min-h-10 text-sm font-extrabold leading-5 text-slate-900">{{ $item->nama_barang }}</h2>
                            <div class="mt-2 space-y-1.5 text-[11px] text-slate-500">
                                <p class="flex items-start gap-2">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                    <span class="line-clamp-1">{{ $item->lokasi_ditemukan }}</span>
                                </p>
                                <p class="flex items-start gap-2">
                                    <svg class="mt-0.5 h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 4.5h15A1.5 1.5 0 0121 6v13.5A1.5 1.5 0 0119.5 21h-15A1.5 1.5 0 013 19.5V6A1.5 1.5 0 014.5 4.5z"/></svg>
                                    <span>{{ $item->tanggal_ditemukan->format('d M Y') }}</span>
                                </p>
                            </div>
                            <p class="mt-2 line-clamp-2 min-h-10 flex-1 text-xs leading-5 text-[#3d4b60]">{{ $item->deskripsi ?: 'Tidak ada deskripsi barang.' }}</p>

                            <div class="mt-3 grid grid-cols-2 gap-1.5 border-t border-[#e7ebf2] pt-3">
                                <a href="{{ route('petugas.barang-temuan.edit', $item) }}" class="inline-flex min-h-9 items-center justify-center rounded-full border border-[#d7dde7] bg-white px-2 text-[11px] font-bold text-[#243044] transition duration-200 hover:border-[#102a4c] hover:bg-[#f8fafc] hover:text-[#102a4c] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 active:scale-[.98]">Edit</a>
                                <form action="{{ route('petugas.barang-temuan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus barang temuan {{ $item->nama_barang }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex min-h-9 w-full items-center justify-center rounded-full border border-[#f3c3c0] bg-white px-2 text-[11px] font-bold text-[#b42318] transition duration-200 hover:border-[#c41230] hover:bg-[#fef3f2] hover:text-[#912018] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 active:scale-[.98]">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

        <div class="mt-2">{{ $barangTemuan->links() }}</div>
    </div>
@endsection