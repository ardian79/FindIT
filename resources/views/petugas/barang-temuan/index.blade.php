@extends('layouts.petugas')

@section('title', 'Kelola Barang Temuan')
@section('header', 'Kelola Barang Temuan')

@section('content')
    @php
        $field =
            'h-[42px] w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10';
        $actionBtn =
            'inline-flex h-9 w-full items-center justify-center rounded-lg border bg-white px-3 text-xs font-medium transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-1';
    @endphp

    <div class="space-y-5">
        <div>
            <a href="{{ route('petugas.barang-temuan.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Barang Temuan
            </a>
        </div>

        <form action="{{ route('petugas.barang-temuan.index') }}" method="GET"
            class="flex flex-col gap-3 rounded-2xl border border-[#e7ebf2] bg-white p-4 md:flex-row md:flex-wrap md:items-center">
            <div class="relative min-w-[200px] flex-1">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-muted"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama barang atau lokasi" class="{{ $field }} pl-10">
            </div>

            <div class="w-full md:w-48">
                <select name="kategori_id" class="{{ $field }}">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" @selected(request('kategori_id') == $kat->id)>{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-40">
                <select name="status" class="{{ $field }}">
                    <option value="">Semua Status</option>
                    @foreach (['tersedia' => 'Tersedia', 'diklaim' => 'Diklaim', 'dikembalikan' => 'Dikembalikan'] as $val => $label)
                        <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex shrink-0 items-center gap-2">
                <button type="submit"
                    class="inline-flex h-[42px] flex-1 items-center justify-center rounded-xl bg-brand px-5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98] md:flex-none">Filter</button>
                @if (request()->anyFilled(['search', 'kategori_id', 'status']))
                    <a href="{{ route('petugas.barang-temuan.index') }}"
                        class="inline-flex h-[42px] items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-3.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Reset</a>
                @endif
            </div>
        </form>

        @if ($barangTemuan->isEmpty())
            <div class="rounded-2xl border border-dashed border-[#d7dde7] bg-white px-6 py-16 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-[#f3f5f8] text-ink-muted">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3.75h16.5v16.5H3.75zM3.75 16.5l4.5-4.5 3.75 3.75 2.25-2.25 6 6" />
                    </svg>
                </div>
                <h2 class="mt-3 text-base font-semibold text-ink">Belum ada barang temuan</h2>
                <p class="mt-1 text-sm text-ink-muted">Belum ada data barang temuan yang sesuai dengan filter.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($barangTemuan as $item)
                    @php
                        $foto = $item->foto_barang
                            ? ltrim(preg_replace('#^(public/|storage/)#', '', $item->foto_barang), '/')
                            : null;
                        $hasFoto = $foto && is_file(public_path('storage/' . $foto));
                        [$badgeCls, $badgeLabel] = match ($item->status) {
                            'tersedia' => ['bg-ink-navy text-white', 'Tersedia'],
                            'diklaim' => ['bg-[#e8eef6] text-ink-navy', 'Diklaim'],
                            default => ['bg-[#f3f5f8] text-[#3d4b60]', 'Dikembalikan'],
                        };
                    @endphp
                    <article
                        class="group flex h-full min-w-0 flex-col overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white transition duration-200 hover:-translate-y-1 hover:border-[#cfd6e2] hover:shadow-card">
                        <div class="relative h-40 overflow-hidden bg-[#eef1f5]">
                            @if ($hasFoto)
                                <img src="{{ asset('storage/' . $foto) }}" alt="{{ $item->nama_barang }}" loading="lazy"
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
                                class="absolute left-3 top-3 rounded-lg bg-white/95 px-2 py-0.5 text-xs font-medium text-ink shadow-sm">{{ $item->kategori->nama_kategori }}</span>
                            <span
                                class="absolute right-3 top-3 rounded-lg px-2 py-0.5 text-xs font-medium {{ $badgeCls }}">{{ $badgeLabel }}</span>
                        </div>

                        <div class="flex min-h-0 flex-1 flex-col p-4">
                            <h2 class="line-clamp-2 min-h-10 text-sm font-semibold leading-5 text-ink">
                                {{ $item->nama_barang }}</h2>
                            <div class="mt-2 space-y-1 text-xs text-ink-muted">
                                <p class="flex items-start gap-2">
                                    <svg class="mt-0.5 h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                    </svg>
                                    <span class="line-clamp-1">{{ $item->lokasi_ditemukan }}</span>
                                </p>
                                <p class="flex items-start gap-2 tabular-nums">
                                    <svg class="mt-0.5 h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M4.5 4.5h15A1.5 1.5 0 0121 6v13.5A1.5 1.5 0 0119.5 21h-15A1.5 1.5 0 013 19.5V6A1.5 1.5 0 014.5 4.5z" />
                                    </svg>
                                    <span>{{ $item->tanggal_ditemukan->format('d M Y') }}</span>
                                </p>
                            </div>
                            <p class="mt-2 line-clamp-2 min-h-10 flex-1 text-xs leading-5 text-[#3d4b60]">
                                {{ $item->deskripsi ?: 'Tidak ada deskripsi barang.' }}</p>

                            <div class="mt-3 grid grid-cols-2 gap-2 border-t border-[#e7ebf2] pt-3">
                                <a href="{{ route('petugas.barang-temuan.edit', $item) }}"
                                    class="{{ $actionBtn }} border-[#d7dde7] text-ink hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:ring-ink-navy/30">Edit</a>
                                <button type="button" popovertarget="confirm-hapus-{{ $item->id }}"
                                    class="{{ $actionBtn }} border-[#f3c3c0] text-[#b42318] hover:border-brand hover:bg-[#fef3f2] focus-visible:ring-brand/30">Hapus</button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            @foreach ($barangTemuan as $item)
                <div id="confirm-hapus-{{ $item->id }}" popover
                    class="m-auto w-[calc(100%-2rem)] max-w-sm rounded-2xl border border-[#e7ebf2] bg-white p-6 text-left backdrop:bg-ink-deep/60">
                    <h3 class="text-base font-semibold text-ink">Hapus Barang Temuan</h3>
                    <p class="mt-2 text-sm text-ink-muted">Hapus barang temuan <strong>{{ $item->nama_barang }}</strong>?
                    </p>
                    <div class="mt-5 flex justify-end gap-2">
                        <button type="button" popovertarget="confirm-hapus-{{ $item->id }}"
                            popovertargetaction="hide"
                            class="inline-flex h-10 items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-4 text-sm font-medium text-ink hover:bg-[#f7f8fb]">Batal</button>
                        <form action="{{ route('petugas.barang-temuan.destroy', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex h-10 items-center justify-center rounded-xl bg-brand px-4 text-sm font-medium text-white hover:bg-brand-dark">Ya,
                                Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@endsection
