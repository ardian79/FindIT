@extends('layouts.petugas')

@section('title', 'Detail Verifikasi Klaim')
@section('header', 'Detail Verifikasi Klaim')

@section('content')
    @php
        $waPengklaim = $klaim->pengguna?->no_hp ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $klaim->pengguna->no_hp)) : null;
        [$badgeCls, $badgeText] = match ($klaim->status) {
            'pending' => ['border border-amber-200/80 bg-amber-50 text-amber-800', 'Status: Menunggu Verifikasi'],
            'disetujui' => ['bg-[#e8eef6] text-ink-navy', 'Status: Disetujui · Menunggu Pengambilan'],
            'ditolak' => ['bg-brand-soft text-brand-dark', 'Status: Ditolak'],
            default => ['bg-ink-navy text-white', 'Status: Selesai Diserahkan'],
        };
        $textarea = 'w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10';
        $btnBase = 'w-full rounded-xl px-4 py-2.5 text-sm font-medium transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 active:scale-[0.98]';
    @endphp

    <div class="space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route('petugas.verifikasi-klaim.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-[#d7dde7] bg-white px-4 py-2.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
                <svg class="h-4 w-4 text-ink-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Daftar Klaim
            </a>
            <span class="inline-flex rounded-lg px-3 py-1.5 text-xs font-medium {{ $badgeCls }}">{{ $badgeText }}</span>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
            <div class="space-y-6 lg:col-span-7">
                <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
                    <div class="border-b border-[#e7ebf2] px-6 py-4">
                        <h2 class="text-base font-semibold text-ink">Informasi Barang Temuan</h2>
                    </div>
                    <div class="p-6">
                        <div class="overflow-hidden rounded-xl bg-[#eef1f5]">
                            <img src="{{ asset('storage/' . $klaim->barangTemuan->foto_barang) }}" alt="{{ $klaim->barangTemuan->nama_barang }}" class="max-h-72 w-full object-contain">
                        </div>

                        <div class="mt-5">
                            <p class="text-xs font-medium text-brand-dark">{{ $klaim->barangTemuan->kategori->nama_kategori }}</p>
                            <h3 class="mt-0.5 text-xl font-semibold text-ink">{{ $klaim->barangTemuan->nama_barang }}</h3>
                        </div>

                        <div class="mt-4 grid grid-cols-1 gap-3 rounded-xl bg-[#f7f8fb] p-4 text-sm sm:grid-cols-2">
                            <div>
                                <span class="block text-xs text-ink-muted">Lokasi ditemukan</span>
                                <span class="font-medium text-ink">{{ $klaim->barangTemuan->lokasi_ditemukan }}</span>
                            </div>
                            <div>
                                <span class="block text-xs text-ink-muted">Tanggal ditemukan</span>
                                <span class="font-medium tabular-nums text-ink">{{ $klaim->barangTemuan->tanggal_ditemukan->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-xs font-medium text-ink-muted">Deskripsi petugas</p>
                            <p class="mt-1.5 whitespace-pre-line text-sm leading-relaxed text-[#3d4b60]">{{ $klaim->barangTemuan->deskripsi }}</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
                    <div class="border-b border-[#e7ebf2] px-6 py-4">
                        <h2 class="text-base font-semibold text-ink">Data Pengklaim &amp; Bukti Kepemilikan</h2>
                    </div>
                    <div class="space-y-4 p-6">
                        <div class="flex flex-col justify-between gap-4 rounded-xl bg-[#f7f8fb] p-4 sm:flex-row sm:items-center">
                            <div>
                                <p class="text-base font-semibold text-ink">{{ $klaim->pengguna->nama }}</p>
                                <p class="text-sm tabular-nums text-[#3d4b60]">NIM: {{ $klaim->pengguna->nim }}</p>
                                <p class="text-xs tabular-nums text-ink-muted">No. HP / WA: {{ $klaim->pengguna->no_hp }}</p>
                            </div>
                            @if ($waPengklaim)
                                <a href="https://wa.me/{{ $waPengklaim }}?text={{ urlencode('Halo ' . $klaim->pengguna->nama . ', saya petugas Pos Keamanan Utama UNEJ terkait pengajuan klaim barang "' . $klaim->barangTemuan->nama_barang . '".') }}"
                                    target="_blank" rel="noopener"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#25D366] px-4 py-2.5 text-xs font-medium text-white transition-colors duration-150 hover:bg-[#1fb85a] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#25D366] focus-visible:ring-offset-2">
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M20.52 3.48A11.86 11.86 0 0012.07 0C5.52 0 .18 5.33.18 11.89c0 2.1.55 4.15 1.59 5.95L.11 24l6.3-1.65a11.87 11.87 0 005.65 1.44h.01c6.55 0 11.89-5.33 11.89-11.89a11.8 11.8 0 00-3.44-8.42zm-8.45 18.28h-.01a9.86 9.86 0 01-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.38a9.83 9.83 0 01-1.51-5.24c0-5.44 4.43-9.87 9.88-9.87a9.8 9.8 0 019.87 9.87c0 5.45-4.43 9.88-9.86 9.88zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.39-1.48-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.21 5.09 4.5.71.31 1.27.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.07-.12-.27-.2-.57-.35z" />
                                    </svg>
                                    <span>Hubungi via WhatsApp</span>
                                </a>
                            @endif
                        </div>

                        <div>
                            <p class="text-xs font-medium text-ink-muted">Keterangan klaim mahasiswa</p>
                            <div class="mt-1.5 whitespace-pre-line rounded-xl border border-[#e7ebf2] bg-white p-4 text-sm leading-relaxed text-[#3d4b60]">{{ $klaim->keterangan_klaim }}</div>
                        </div>

                        <p class="text-xs tabular-nums text-ink-muted">Diajukan pada {{ $klaim->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <div class="space-y-6 lg:col-span-5">
                @if ($klaim->status === 'pending')
                    <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
                        <div class="border-b border-[#e7ebf2] bg-[#f7f8fb] px-6 py-4">
                            <h2 class="text-base font-semibold text-ink">Setujui Pengajuan Klaim</h2>
                            <p class="mt-0.5 text-xs text-ink-muted">Status barang akan berubah menjadi Diklaim dan klaim pending lain untuk barang ini otomatis ditolak.</p>
                        </div>
                        <form action="{{ route('petugas.verifikasi-klaim.setujui', $klaim) }}" method="POST" class="space-y-4 p-6">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label for="catatan_setujui" class="mb-1.5 block text-sm font-medium text-ink">Catatan Petugas (Opsional)</label>
                                <textarea id="catatan_setujui" name="catatan_petugas" rows="3" placeholder="Contoh: Ciri barang sesuai. Silakan ambil di Pos Keamanan Utama dengan membawa KTM asli." class="{{ $textarea }}">{{ old('catatan_petugas') }}</textarea>
                            </div>
                            <button type="button" popovertarget="confirm-setujui" class="{{ $btnBase }} bg-ink-navy text-white hover:bg-ink-deep focus-visible:ring-ink-navy">Setujui Klaim</button>
                            <div id="confirm-setujui" popover class="m-auto w-[calc(100%-2rem)] max-w-sm rounded-2xl border border-[#e7ebf2] bg-white p-6 text-left backdrop:bg-ink-deep/60">
                                <h3 class="text-base font-semibold text-ink">Setujui Klaim</h3>
                                <p class="mt-2 text-sm text-ink-muted">Setujui pengajuan klaim ini?</p>
                                <div class="mt-5 flex justify-end gap-2">
                                    <button type="button" popovertarget="confirm-setujui" popovertargetaction="hide" class="inline-flex h-10 items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-4 text-sm font-medium text-ink hover:bg-[#f7f8fb]">Batal</button>
                                    <button type="submit" class="inline-flex h-10 items-center justify-center rounded-xl bg-ink-navy px-4 text-sm font-medium text-white hover:bg-ink-deep">Ya, Setujui</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @elseif ($klaim->status === 'disetujui')
                    <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
                        <div class="border-b border-[#e7ebf2] bg-[#f7f8fb] px-6 py-4">
                            <h2 class="text-base font-semibold text-ink">Selesaikan &amp; Catat Serah Terima</h2>
                            <p class="mt-0.5 text-xs text-ink-muted">Unggah foto bukti serah terima saat pemilik mengambil barang di Pos Keamanan Utama UNEJ.</p>
                        </div>
                        <form action="{{ route('petugas.verifikasi-klaim.selesai', $klaim) }}" method="POST" enctype="multipart/form-data" class="space-y-4 p-6">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label for="foto_serah_terima" class="mb-1.5 block text-sm font-medium text-ink">Foto Bukti Serah Terima</label>
                                <input type="file" id="foto_serah_terima" name="foto_serah_terima" accept=".jpg,.jpeg,.png,.webp" required
                                    class="w-full rounded-xl border border-[#d7dde7] px-3 py-2 text-sm text-[#3d4b60] file:mr-3 file:rounded-lg file:border-0 file:bg-[#f3f5f8] file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-ink hover:file:bg-[#e7ebf2]">
                                <p class="mt-1 text-xs text-ink-muted">Format JPG, PNG, atau WEBP maksimal 2MB.</p>
                            </div>
                            <div>
                                <label for="catatan_selesai" class="mb-1.5 block text-sm font-medium text-ink">Catatan Serah Terima (Opsional)</label>
                                <textarea id="catatan_selesai" name="catatan_petugas" rows="3" placeholder="Contoh: Barang diserahkan langsung setelah verifikasi KTM." class="{{ $textarea }}">{{ old('catatan_petugas', $klaim->catatan_petugas) }}</textarea>
                            </div>
                            <button type="button" popovertarget="confirm-selesai" class="{{ $btnBase }} bg-ink-navy text-white hover:bg-ink-deep focus-visible:ring-ink-navy">Simpan Serah Terima &amp; Selesaikan</button>
                            <div id="confirm-selesai" popover class="m-auto w-[calc(100%-2rem)] max-w-sm rounded-2xl border border-[#e7ebf2] bg-white p-6 text-left backdrop:bg-ink-deep/60">
                                <h3 class="text-base font-semibold text-ink">Selesaikan Serah Terima</h3>
                                <p class="mt-2 text-sm text-ink-muted">Selesaikan serah terima barang ini?</p>
                                <div class="mt-5 flex justify-end gap-2">
                                    <button type="button" popovertarget="confirm-selesai" popovertargetaction="hide" class="inline-flex h-10 items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-4 text-sm font-medium text-ink hover:bg-[#f7f8fb]">Batal</button>
                                    <button type="submit" class="inline-flex h-10 items-center justify-center rounded-xl bg-ink-navy px-4 text-sm font-medium text-white hover:bg-ink-deep">Ya, Selesaikan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif

                @if (in_array($klaim->status, ['pending', 'disetujui']))
                    @php
                        $isPending = $klaim->status === 'pending';
                    @endphp
                    <div class="overflow-hidden rounded-2xl border border-[#f3c7c3] bg-white">
                        <div class="border-b border-[#f3c7c3] bg-[#fff6f5] px-6 py-4">
                            <h2 class="text-base font-semibold text-[#7a271a]">{{ $isPending ? 'Tolak Pengajuan Klaim' : 'Batalkan / Tolak Klaim' }}</h2>
                            <p class="mt-0.5 text-xs text-[#9b1028]">
                                {{ $isPending ? 'Berikan alasan yang jelas jika ciri barang tidak sesuai.' : 'Jika pengklaim batal mengambil atau bukti fisik tidak cocok, barang akan dikembalikan ke status Tersedia.' }}
                            </p>
                        </div>
                        <form action="{{ route('petugas.verifikasi-klaim.tolak', $klaim) }}" method="POST" class="space-y-4 p-6">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label for="catatan_tolak" class="mb-1.5 block text-sm font-medium text-ink">{{ $isPending ? 'Alasan Penolakan' : 'Alasan Pembatalan' }}</label>
                                <textarea id="catatan_tolak" name="catatan_petugas" rows="{{ $isPending ? 3 : 2 }}" required
                                    placeholder="{{ $isPending ? 'Tuliskan alasan penolakan klaim' : 'Tuliskan alasan pembatalan' }}"
                                    class="{{ $textarea }} focus:border-brand focus:ring-brand/10"></textarea>
                            </div>
                            <button type="button" popovertarget="confirm-tolak" class="{{ $btnBase }} border border-[#f3c3c0] bg-white text-[#b42318] hover:border-brand hover:bg-[#fef3f2] focus-visible:ring-brand">
                                {{ $isPending ? 'Tolak Klaim' : 'Batalkan & Tolak Klaim' }}
                            </button>
                            <div id="confirm-tolak" popover class="m-auto w-[calc(100%-2rem)] max-w-sm rounded-2xl border border-[#e7ebf2] bg-white p-6 text-left backdrop:bg-ink-deep/60">
                                <h3 class="text-base font-semibold text-ink">{{ $isPending ? 'Tolak Klaim' : 'Batalkan & Tolak Klaim' }}</h3>
                                <p class="mt-2 text-sm text-ink-muted">{{ $isPending ? 'Tolak pengajuan klaim ini?' : 'Batalkan persetujuan dan tolak klaim ini?' }}</p>
                                <div class="mt-5 flex justify-end gap-2">
                                    <button type="button" popovertarget="confirm-tolak" popovertargetaction="hide" class="inline-flex h-10 items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-4 text-sm font-medium text-ink hover:bg-[#f7f8fb]">Batal</button>
                                    <button type="submit" class="inline-flex h-10 items-center justify-center rounded-xl bg-brand px-4 text-sm font-medium text-white hover:bg-brand-dark">Ya, Tolak</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @elseif ($klaim->status === 'selesai')
                    <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
                        <div class="border-b border-[#e7ebf2] bg-[#f7f8fb] px-6 py-4">
                            <h2 class="text-base font-semibold text-ink">Bukti Serah Terima</h2>
                            <p class="mt-0.5 text-xs tabular-nums text-ink-muted">Barang telah dikembalikan pada {{ $klaim->tanggal_diambil?->format('d M Y, H:i') }} WIB</p>
                        </div>
                        <div class="space-y-4 p-6">
                            @if ($klaim->foto_serah_terima)
                                <a href="{{ asset('storage/' . $klaim->foto_serah_terima) }}" target="_blank" rel="noopener" class="block overflow-hidden rounded-xl bg-[#eef1f5]">
                                    <img src="{{ asset('storage/' . $klaim->foto_serah_terima) }}" alt="Bukti Serah Terima" class="max-h-72 w-full object-contain">
                                </a>
                            @endif
                            @if ($klaim->catatan_petugas)
                                <div>
                                    <p class="text-xs font-medium text-ink-muted">Catatan petugas</p>
                                    <p class="mt-1 whitespace-pre-line text-sm text-[#3d4b60]">{{ $klaim->catatan_petugas }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="overflow-hidden rounded-2xl border border-[#f3c7c3] bg-white">
                        <div class="border-b border-[#f3c7c3] bg-[#fff6f5] px-6 py-4">
                            <h2 class="text-base font-semibold text-[#7a271a]">Klaim Ditolak</h2>
                        </div>
                        <div class="p-6">
                            <p class="text-xs font-medium text-ink-muted">Catatan petugas</p>
                            <p class="mt-1.5 whitespace-pre-line text-sm text-[#3d4b60]">{{ $klaim->catatan_petugas ?? '-' }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
