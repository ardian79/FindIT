@extends('layouts.dashboard')

@section('title', 'Detail Verifikasi Klaim')

@section('header', 'Detail Verifikasi Klaim')

@section('content')
    @php
        $waPengklaim = $klaim->pengguna && $klaim->pengguna->no_hp ? preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $klaim->pengguna->no_hp)) : null;
    @endphp

    <div class="space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route('petugas.verifikasi-klaim.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali ke Daftar Klaim
            </a>

            @if ($klaim->status === 'pending')
                <span class="inline-flex rounded-full bg-amber-100 px-3.5 py-1.5 text-xs font-semibold text-amber-800">
                    Status: Menunggu Verifikasi
                </span>
            @elseif ($klaim->status === 'disetujui')
                <span class="inline-flex rounded-full bg-blue-100 px-3.5 py-1.5 text-xs font-semibold text-blue-800">
                    Status: Disetujui · Menunggu Pengambilan
                </span>
            @elseif ($klaim->status === 'ditolak')
                <span class="inline-flex rounded-full bg-red-100 px-3.5 py-1.5 text-xs font-semibold text-red-800">
                    Status: Ditolak
                </span>
            @else
                <span class="inline-flex rounded-full bg-blue-100 px-3.5 py-1.5 text-xs font-semibold text-[#17365d]">
                    Status: Selesai Diserahkan
                </span>
            @endif
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
            <div class="space-y-6 lg:col-span-7">
                <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white">
                    <div class="border-b border-slate-200 px-6 py-4">
                        <h2 class="text-base font-bold text-slate-900">Informasi Barang Temuan</h2>
                    </div>
                    <div class="p-6">
                        <div class="overflow-hidden rounded-xl bg-slate-100">
                            <img src="{{ asset('storage/' . $klaim->barangTemuan->foto_barang) }}" alt="{{ $klaim->barangTemuan->nama_barang }}" class="max-h-72 w-full object-contain">
                        </div>

                        <div class="mt-5">
                            <span class="text-xs font-semibold uppercase tracking-wider text-[#b12025]">{{ $klaim->barangTemuan->kategori->nama_kategori }}</span>
                            <h3 class="mt-0.5 text-xl font-bold text-slate-900">{{ $klaim->barangTemuan->nama_barang }}</h3>
                        </div>

                        <div class="mt-4 grid grid-cols-1 gap-3 rounded-xl bg-slate-50 p-4 text-sm sm:grid-cols-2">
                            <div>
                                <span class="block text-xs text-slate-500">Lokasi Ditemukan</span>
                                <span class="font-semibold text-slate-900">{{ $klaim->barangTemuan->lokasi_ditemukan }}</span>
                            </div>
                            <div>
                                <span class="block text-xs text-slate-500">Tanggal Ditemukan</span>
                                <span class="font-semibold text-slate-900">{{ $klaim->barangTemuan->tanggal_ditemukan->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div class="mt-4">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Deskripsi Petugas</p>
                            <p class="mt-1.5 whitespace-pre-line text-sm leading-relaxed text-slate-700">{{ $klaim->barangTemuan->deskripsi }}</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white">
                    <div class="border-b border-slate-200 px-6 py-4">
                        <h2 class="text-base font-bold text-slate-900">Data Pengklaim & Bukti Kepemilikan</h2>
                    </div>
                    <div class="space-y-4 p-6">
                        <div class="flex flex-col justify-between gap-4 rounded-xl bg-slate-50 p-4 sm:flex-row sm:items-center">
                            <div>
                                <p class="text-base font-bold text-slate-900">{{ $klaim->pengguna->nama }}</p>
                                <p class="text-sm text-slate-600">NIM: {{ $klaim->pengguna->nim }}</p>
                                <p class="text-xs text-slate-500">No. HP / WA: {{ $klaim->pengguna->no_hp }}</p>
                            </div>
                            @if ($waPengklaim)
                                <a href="https://wa.me/{{ $waPengklaim }}?text={{ urlencode('Halo ' . $klaim->pengguna->nama . ', saya petugas Pos Keamanan Utama UNEJ terkait pengajuan klaim barang "' . $klaim->barangTemuan->nama_barang . '".') }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 rounded-full bg-[#25D366] px-4 py-2 text-xs font-bold text-white transition duration-200 hover:bg-[#1fb85a] active:scale-[0.98] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#25D366] focus-visible:ring-offset-2">
                                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M20.52 3.48A11.86 11.86 0 0012.07 0C5.52 0 .18 5.33.18 11.89c0 2.1.55 4.15 1.59 5.95L.11 24l6.3-1.65a11.87 11.87 0 005.65 1.44h.01c6.55 0 11.89-5.33 11.89-11.89a11.8 11.8 0 00-3.44-8.42zm-8.45 18.28h-.01a9.86 9.86 0 01-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.38a9.83 9.83 0 01-1.51-5.24c0-5.44 4.43-9.87 9.88-9.87a9.8 9.8 0 019.87 9.87c0 5.45-4.43 9.88-9.86 9.88zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.39-1.48-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.21 5.09 4.5.71.31 1.27.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.07-.12-.27-.2-.57-.35z" />
                                    </svg>
                                    <span>Hubungi via WhatsApp</span>
                                </a>
                            @endif
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Keterangan Klaim Mahasiswa</p>
                            <div class="mt-1.5 rounded-xl border border-slate-200 bg-white p-4 text-sm leading-relaxed text-slate-800 whitespace-pre-line">{{ $klaim->keterangan_klaim }}</div>
                        </div>

                        <p class="text-xs text-slate-500">Diajukan pada {{ $klaim->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <div class="space-y-6 lg:col-span-5">
                @if ($klaim->status === 'pending')
                    <div class="overflow-hidden rounded-2xl border border-red-200/80 bg-white">
                        <div class="border-b border-red-50 bg-red-50/70 px-6 py-4">
                            <h2 class="text-base font-bold text-red-900">Setujui Pengajuan Klaim</h2>
                            <p class="mt-0.5 text-xs text-[#94191d]">Status barang akan berubah menjadi Diklaim dan klaim pending lain untuk barang ini akan otomatis ditolak.</p>
                        </div>
                        <form action="{{ route('petugas.verifikasi-klaim.setujui', $klaim) }}" method="POST" class="space-y-4 p-6">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="catatan_setujui" class="mb-1.5 block text-sm font-medium text-slate-700">Catatan Petugas (Opsional)</label>
                                <textarea id="catatan_setujui" name="catatan_petugas" rows="3" placeholder="Contoh: Ciri barang sesuai. Silakan ambil di Pos Keamanan Utama dengan membawa KTM asli." class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">{{ old('catatan_petugas') }}</textarea>
                            </div>

                            <button type="submit" onclick="return confirm('Setujui pengajuan klaim ini?')" class="w-full rounded-full bg-[#c41230] focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 px-4 py-2.5 text-sm font-semibold text-white transition-all duration-150 hover:bg-[#9b1028] active:scale-[0.98]">
                                Setujui Klaim
                            </button>
                        </form>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-red-200/80 bg-white">
                        <div class="border-b border-red-100 bg-red-50/70 px-6 py-4">
                            <h2 class="text-base font-bold text-red-900">Tolak Pengajuan Klaim</h2>
                            <p class="mt-0.5 text-xs text-red-700">Berikan alasan yang jelas jika ciri barang tidak sesuai.</p>
                        </div>
                        <form action="{{ route('petugas.verifikasi-klaim.tolak', $klaim) }}" method="POST" class="space-y-4 p-6">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="catatan_tolak" class="mb-1.5 block text-sm font-medium text-slate-700">Alasan Penolakan</label>
                                <textarea id="catatan_tolak" name="catatan_petugas" rows="3" required placeholder="Tuliskan alasan penolakan klaim..." class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-500/20"></textarea>
                            </div>

                            <button type="submit" onclick="return confirm('Tolak pengajuan klaim ini?')" class="w-full rounded-xl bg-[#c41230] px-4 py-2.5 text-sm font-semibold text-white focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 transition-all duration-150 hover:bg-red-700 active:scale-[0.98]">
                                Tolak Klaim
                            </button>
                        </form>
                    </div>
                @elseif ($klaim->status === 'disetujui')
                    <div class="overflow-hidden rounded-2xl border border-blue-200/80 bg-white">
                        <div class="border-b border-blue-100 bg-blue-50/70 px-6 py-4">
                            <h2 class="text-base font-bold text-blue-900">Selesaikan & Catat Serah Terima</h2>
                            <p class="mt-0.5 text-xs text-blue-700">Unggah foto bukti serah terima saat pemilik mengambil barang di Pos Keamanan Utama UNEJ.</p>
                        </div>
                        <form action="{{ route('petugas.verifikasi-klaim.selesai', $klaim) }}" method="POST" enctype="multipart/form-data" class="space-y-4 p-6">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="foto_serah_terima" class="mb-1.5 block text-sm font-medium text-slate-700">Foto Bukti Serah Terima</label>
                                <input type="file" id="foto_serah_terima" name="foto_serah_terima" accept=".jpg,.jpeg,.png,.webp" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-blue-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-blue-700 hover:file:bg-blue-100">
                                <p class="mt-1 text-xs text-slate-500">Format JPG, PNG, atau WEBP maksimal 2MB.</p>
                            </div>

                            <div>
                                <label for="catatan_selesai" class="mb-1.5 block text-sm font-medium text-slate-700">Catatan Serah Terima (Opsional)</label>
                                <textarea id="catatan_selesai" name="catatan_petugas" rows="3" placeholder="Contoh: Barang diserahkan langsung setelah verifikasi KTM." class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">{{ old('catatan_petugas', $klaim->catatan_petugas) }}</textarea>
                            </div>

                            <button type="submit" onclick="return confirm('Selesaikan serah terima barang ini?')" class="w-full rounded-full bg-[#c41230] focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 px-4 py-2.5 text-sm font-semibold text-white transition-all duration-150 hover:bg-[#9b1028] active:scale-[0.98]">
                                Simpan Serah Terima & Selesaikan
                            </button>
                        </form>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-red-200/80 bg-white">
                        <div class="border-b border-red-100 bg-red-50/70 px-6 py-4">
                            <h2 class="text-base font-bold text-red-900">Batalkan / Tolak Klaim</h2>
                            <p class="mt-0.5 text-xs text-red-700">Jika pengklaim batal mengambil atau bukti fisik tidak cocok, barang akan dikembalikan ke status Tersedia.</p>
                        </div>
                        <form action="{{ route('petugas.verifikasi-klaim.tolak', $klaim) }}" method="POST" class="space-y-4 p-6">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="catatan_batal" class="mb-1.5 block text-sm font-medium text-slate-700">Alasan Pembatalan</label>
                                <textarea id="catatan_batal" name="catatan_petugas" rows="2" required placeholder="Tuliskan alasan pembatalan..." class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-red-500 focus:ring-2 focus:ring-red-500/20"></textarea>
                            </div>

                            <button type="submit" onclick="return confirm('Batalkan persetujuan dan tolak klaim ini?')" class="w-full rounded-xl bg-[#c41230] px-4 py-2.5 text-sm font-semibold text-white focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 transition-all duration-150 hover:bg-red-700 active:scale-[0.98]">
                                Batalkan & Tolak Klaim
                            </button>
                        </form>
                    </div>
                @elseif ($klaim->status === 'selesai')
                    <div class="overflow-hidden rounded-2xl border border-red-200/80 bg-white">
                        <div class="border-b border-red-50 bg-red-50/70 px-6 py-4">
                            <h2 class="text-base font-bold text-red-900">Bukti Serah Terima</h2>
                            <p class="mt-0.5 text-xs text-[#94191d]">Barang telah dikembalikan pada {{ $klaim->tanggal_diambil?->format('d M Y, H:i') }} WIB</p>
                        </div>
                        <div class="space-y-4 p-6">
                            @if ($klaim->foto_serah_terima)
                                <a href="{{ asset('storage/' . $klaim->foto_serah_terima) }}" target="_blank" class="block overflow-hidden rounded-xl bg-slate-100">
                                    <img src="{{ asset('storage/' . $klaim->foto_serah_terima) }}" alt="Bukti Serah Terima" class="max-h-72 w-full object-contain">
                                </a>
                            @endif

                            @if ($klaim->catatan_petugas)
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Catatan Petugas</p>
                                    <p class="mt-1 whitespace-pre-line text-sm text-slate-700">{{ $klaim->catatan_petugas }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="overflow-hidden rounded-2xl border border-red-200/80 bg-white">
                        <div class="border-b border-red-100 bg-red-50/70 px-6 py-4">
                            <h2 class="text-base font-bold text-red-900">Klaim Ditolak</h2>
                        </div>
                        <div class="p-6">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Catatan Petugas</p>
                            <p class="mt-1.5 whitespace-pre-line text-sm text-slate-700">{{ $klaim->catatan_petugas ?? '-' }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection