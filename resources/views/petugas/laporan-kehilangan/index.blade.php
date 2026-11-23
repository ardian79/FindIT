@extends('layouts.dashboard')

@section('title', 'Pantau Laporan Kehilangan')
@section('header', 'Laporan Kehilangan Mahasiswa')

@section('content')
    @php
        $toWa = fn (?string $hp) => $hp ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $hp)) : null;
        $field = 'w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10';
        $actionBtn = 'inline-flex h-9 w-full items-center justify-center rounded-lg border bg-white px-3 text-xs font-medium transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-1';
    @endphp

    <div class="space-y-5">
        <form action="{{ route('petugas.laporan-kehilangan.index') }}" method="GET" class="grid grid-cols-1 gap-3 rounded-2xl border border-[#e7ebf2] bg-white p-4 md:grid-cols-12">
            <div class="relative md:col-span-5">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang, lokasi, nama, atau NIM" class="{{ $field }} pl-10">
            </div>

            <div class="md:col-span-3">
                <select name="kategori_id" class="{{ $field }}">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" @selected(request('kategori_id') == $kat->id)>{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <select name="status" class="{{ $field }}">
                    <option value="">Semua Status</option>
                    @foreach (['dicari' => 'Dicari', 'ditemukan' => 'Ditemukan'] as $val => $label)
                        <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2 md:col-span-2">
                <button type="submit" class="flex-1 rounded-xl bg-brand px-4 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">Filter</button>
                @if (request()->anyFilled(['search', 'kategori_id', 'status']))
                    <a href="{{ route('petugas.laporan-kehilangan.index') }}" class="inline-flex items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-3 py-2.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Reset</a>
                @endif
            </div>
        </form>

        @if ($laporan->isEmpty())
            <div class="rounded-2xl border border-dashed border-[#d7dde7] bg-white px-6 py-16 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-[#f3f5f8] text-ink-muted">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75h16.5v16.5H3.75zM3.75 16.5l4.5-4.5 3.75 3.75 2.25-2.25 6 6" />
                    </svg>
                </div>
                <h2 class="mt-3 text-base font-semibold text-ink">Belum ada laporan kehilangan</h2>
                <p class="mt-1 text-sm text-ink-muted">Belum ada laporan yang sesuai dengan filter.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($laporan as $item)
                    @php
                        $wa = $toWa($item->pengguna?->no_hp);
                        $foto = $item->foto_barang ? ltrim(preg_replace('#^(public/|storage/)#', '', $item->foto_barang), '/') : null;
                        $isDicari = $item->status === 'dicari';
                        $lebih30Hari = $isDicari && $item->tanggal_hilang->lt(now()->subDays(30));
                    @endphp
                    <article class="group flex h-full min-w-0 flex-col overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white transition duration-200 hover:-translate-y-1 hover:border-[#cfd6e2] hover:shadow-card">
                        <div class="relative h-40 overflow-hidden bg-[#eef1f5]">
                            @if ($foto)
                                <img src="{{ asset('storage/' . $foto) }}" alt="{{ $item->nama_barang }}"
                                    onerror="this.hidden=true;this.nextElementSibling?.classList.remove('hidden')"
                                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]">
                            @endif
                            <div class="{{ $foto ? 'hidden' : '' }} absolute inset-0 flex items-center justify-center text-ink-muted/60">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75h16.5v16.5H3.75zM3.75 16.5l4.5-4.5 3.75 3.75 2.25-2.25 6 6" />
                                </svg>
                            </div>
                            <span class="absolute left-3 top-3 rounded-lg bg-white/95 px-2 py-0.5 text-xs font-medium text-ink shadow-sm">{{ $item->kategori->nama_kategori }}</span>
                            <span class="absolute right-3 top-3 rounded-lg px-2 py-0.5 text-xs font-medium {{ $isDicari ? 'border border-amber-200/80 bg-amber-50 text-amber-800' : 'bg-ink-navy text-white' }}">
                                {{ $isDicari ? 'Dicari' : 'Ditemukan' }}
                            </span>
                        </div>

                        <div class="flex min-h-0 flex-1 flex-col p-4">
                            <div class="flex items-start justify-between gap-2">
                                <h2 class="line-clamp-2 min-h-10 text-sm font-semibold leading-5 text-ink">{{ $item->nama_barang }}</h2>
                                @if ($lebih30Hari)
                                    <span class="shrink-0 rounded-md bg-brand-soft px-2 py-0.5 text-xs font-medium tabular-nums text-brand-dark">&gt; 30 hr</span>
                                @endif
                            </div>

                            <div class="mt-2 space-y-1 text-xs text-ink-muted">
                                <p class="font-medium text-ink">{{ $item->pengguna->nama }}</p>
                                <p class="tabular-nums">NIM: {{ $item->pengguna->nim }}</p>
                                <p class="line-clamp-1">{{ $item->lokasi_hilang }}</p>
                                <p class="tabular-nums">{{ $item->tanggal_hilang->format('d M Y') }}</p>
                            </div>

                            <p class="mt-2 line-clamp-2 min-h-10 flex-1 text-xs leading-5 text-[#3d4b60]">{{ $item->deskripsi ?: 'Tidak ada deskripsi barang.' }}</p>

                            @if ($wa)
                                <a href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo ' . $item->pengguna->nama . ', saya petugas Pos Keamanan UNEJ terkait laporan kehilangan "' . $item->nama_barang . '".') }}"
                                    target="_blank" rel="noopener" aria-label="Hubungi {{ $item->pengguna->nama }} melalui WhatsApp"
                                    class="mt-3 inline-flex h-9 items-center justify-center gap-2 rounded-lg bg-[#25D366] px-3 text-xs font-medium text-white transition-colors duration-150 hover:bg-[#1fb85a] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#25D366] focus-visible:ring-offset-1">
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M20.52 3.48A11.86 11.86 0 0012.07 0C5.52 0 .18 5.33.18 11.89c0 2.1.55 4.15 1.59 5.95L.11 24l6.3-1.65a11.87 11.87 0 005.65 1.44h.01c6.55 0 11.89-5.33 11.89-11.89a11.8 11.8 0 00-3.44-8.42zm-8.45 18.28h-.01a9.86 9.86 0 01-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.38a9.83 9.83 0 01-1.51-5.24c0-5.44 4.43-9.87 9.88-9.87a9.8 9.8 0 019.87 9.87c0 5.45-4.43 9.88-9.86 9.88zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.39-1.48-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.21 5.09 4.5.71.31 1.27.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.07-.12-.27-.2-.57-.35z"/>
                                    </svg>
                                    WhatsApp Pelapor
                                </a>
                            @endif

                            <div class="mt-3 grid grid-cols-1 gap-2 border-t border-[#e7ebf2] pt-3">
                                <form action="{{ route('petugas.laporan-kehilangan.status', $item) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ $isDicari ? 'ditemukan' : 'dicari' }}">
                                    <button type="submit" class="{{ $actionBtn }} border-[#d7dde7] text-ink hover:border-ink-navy hover:bg-[#f7f8fb] hover:text-ink-navy focus-visible:ring-ink-navy/30">
                                        {{ $isDicari ? 'Tandai Ditemukan' : 'Buka Kembali' }}
                                    </button>
                                </form>
                                <form action="{{ route('petugas.laporan-kehilangan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus laporan kehilangan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="{{ $actionBtn }} border-[#f3c3c0] text-[#b42318] hover:border-brand hover:bg-[#fef3f2] focus-visible:ring-brand/30">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif

    </div>
@endsection
