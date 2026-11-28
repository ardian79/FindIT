@extends('layouts.petugas')

@section('title', 'Rekap Laporan Operasional')
@section('header', 'Rekap & Cetak Laporan')

@section('content')
    <div class="space-y-6">
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5 print:hidden">
            <div class="rounded-2xl border border-[#e7ebf2] bg-white p-4">
                <p class="text-xs font-medium text-ink-muted">Total Temuan</p>
                <p class="mt-1.5 text-2xl font-semibold tabular-nums text-ink">{{ $ringkasan['total_temuan'] }}</p>
            </div>
            <div class="rounded-2xl border border-[#e7ebf2] bg-white p-4">
                <p class="text-xs font-medium text-ink-muted">Temuan Tersedia</p>
                <p class="mt-1.5 text-2xl font-semibold tabular-nums text-ink">{{ $ringkasan['total_tersedia'] }}</p>
            </div>
            <div class="rounded-2xl border border-[#e7ebf2] bg-white p-4">
                <p class="text-xs font-medium text-ink-muted">Dikembalikan</p>
                <p class="mt-1.5 text-2xl font-semibold tabular-nums text-ink">{{ $ringkasan['total_dikembalikan'] }}</p>
            </div>
            <div class="rounded-2xl border border-[#e7ebf2] bg-white p-4">
                <p class="text-xs font-medium text-ink-muted">Total Kehilangan</p>
                <p class="mt-1.5 text-2xl font-semibold tabular-nums text-ink">{{ $ringkasan['total_hilang'] }}</p>
            </div>
            <div class="rounded-2xl border border-[#e7ebf2] bg-white p-4">
                <p class="text-xs font-medium text-ink-muted">Klaim Selesai</p>
                <p class="mt-1.5 text-2xl font-semibold tabular-nums text-ink">{{ $ringkasan['total_klaim_selesai'] }}</p>
            </div>
        </div>

        <form action="{{ route('petugas.laporan.index') }}" method="GET"
            class="rounded-2xl border border-[#e7ebf2] bg-white p-4 print:hidden">
            <div class="flex flex-wrap items-end gap-3">
                <div class="min-w-42.5 flex-[1.2_1_170px]">
                    <label for="jenis" class="mb-1 block text-xs font-medium text-ink-muted">Jenis Laporan</label>
                    <select id="jenis" name="jenis"
                        class="h-10.5 w-full rounded-xl border border-[#d7dde7] bg-white px-3 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
                        @foreach (['barang_temuan' => 'Barang Temuan', 'laporan_kehilangan' => 'Laporan Kehilangan', 'klaim' => 'Verifikasi Klaim'] as $val => $text)
                            <option value="{{ $val }}" @selected($jenis === $val)>{{ $text }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="min-w-36 flex-1">
                    <label for="tanggal_mulai" class="mb-1 block text-xs font-medium text-ink-muted">Dari Tanggal</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ $tanggalMulai }}"
                        class="h-10.5 w-full rounded-xl border border-[#d7dde7] bg-white px-3 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10 tabular-nums">
                </div>

                <div class="min-w-36 flex-1">
                    <label for="tanggal_selesai" class="mb-1 block text-xs font-medium text-ink-muted">Sampai
                        Tanggal</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ $tanggalSelesai }}"
                        class="h-10.5 w-full rounded-xl border border-[#d7dde7] bg-white px-3 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10 tabular-nums">
                </div>

                <div class="min-w-36 flex-1">
                    <label for="status" class="mb-1 block text-xs font-medium text-ink-muted">Status</label>
                    <select id="status" name="status"
                        class="h-10.5 w-full rounded-xl border border-[#d7dde7] bg-white px-3 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
                        <option value="">Semua Status</option>
                        @if ($jenis === 'laporan_kehilangan')
                            <option value="dicari" @selected(($status ?? '') === 'dicari')>Dicari</option>
                            <option value="ditemukan" @selected(($status ?? '') === 'ditemukan')>Ditemukan</option>
                        @elseif ($jenis === 'klaim')
                            <option value="pending" @selected(($status ?? '') === 'pending')>Pending</option>
                            <option value="disetujui" @selected(($status ?? '') === 'disetujui')>Disetujui</option>
                            <option value="selesai" @selected(($status ?? '') === 'selesai')>Selesai</option>
                            <option value="ditolak" @selected(($status ?? '') === 'ditolak')>Ditolak</option>
                        @else
                            <option value="tersedia" @selected(($status ?? '') === 'tersedia')>Tersedia</option>
                            <option value="diklaim" @selected(($status ?? '') === 'diklaim')>Diklaim</option>
                            <option value="dikembalikan" @selected(($status ?? '') === 'dikembalikan')>Dikembalikan</option>
                        @endif
                    </select>
                </div>

                <div class="flex w-full shrink-0 items-center gap-2 sm:ml-auto sm:w-auto">
                    <button type="submit"
                        class="inline-flex h-10.5 flex-1 items-center justify-center rounded-xl bg-brand px-5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98] sm:flex-none">Tampilkan</button>
                    <button type="button" onclick="window.print()"
                        class="inline-flex h-10.5 flex-1 items-center justify-center gap-1.5 rounded-xl border border-[#d7dde7] bg-white px-4 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30 sm:flex-none">
                        <svg class="h-4 w-4 text-ink-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.75" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                        </svg>
                        Cetak
                    </button>
                </div>
            </div>
        </form>

        <div
            class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white print:rounded-none print:border-0 print:shadow-none">
            <div class="border-b border-[#e7ebf2] px-6 py-5 print:border-b-2 print:border-ink print:px-0">
                <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-end">
                    <div>
                        <h2 class="mt-1 text-lg font-semibold text-ink">
                            @if ($jenis === 'laporan_kehilangan')
                                Laporan Data Kehilangan Barang
                            @elseif ($jenis === 'klaim')
                                Laporan Data Verifikasi & Serah Terima Klaim
                            @else
                                Laporan Data Barang Temuan
                            @endif
                        </h2>
                        <p class="mt-0.5 text-xs tabular-nums text-ink-muted">
                            Periode: {{ $tanggalMulai ? \Carbon\Carbon::parse($tanggalMulai)->format('d M Y') : 'Awal' }}
                            s/d
                            {{ $tanggalSelesai ? \Carbon\Carbon::parse($tanggalSelesai)->format('d M Y') : 'Sekarang' }}
                            @if ($status)
                                · Status: {{ ucfirst($status) }}
                            @endif
                        </p>
                    </div>
                    <p class="text-xs tabular-nums text-ink-muted">Dicetak: {{ now()->format('d M Y, H:i') }} WIB · Total:
                        {{ $data->count() }} data</p>
                </div>
            </div>

            @if ($data->isEmpty())
                <div class="px-6 py-14 text-center text-sm text-ink-muted">Tidak ada data pada filter yang dipilih.</div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#e7ebf2] text-left text-sm">
                        <thead class="bg-[#f7f8fb] text-xs font-medium text-ink-muted print:bg-slate-100">
                            <tr>
                                <th scope="col" class="w-12 whitespace-nowrap px-4 py-3">No</th>
                                @if ($jenis === 'barang_temuan')
                                    <th scope="col" class="whitespace-nowrap px-4 py-3">Nama Barang</th>
                                    <th scope="col" class="whitespace-nowrap px-4 py-3 text-center">Kategori</th>
                                    <th scope="col" class="whitespace-nowrap px-4 py-3">Lokasi Ditemukan</th>
                                    <th scope="col" class="whitespace-nowrap px-4 py-3 text-center">Tanggal</th>
                                @elseif ($jenis === 'laporan_kehilangan')
                                    <th scope="col" class="whitespace-nowrap px-4 py-3">Nama Barang</th>
                                    <th scope="col" class="whitespace-nowrap px-4 py-3 text-center">Kategori</th>
                                    <th scope="col" class="whitespace-nowrap px-4 py-3">Pelapor</th>
                                    <th scope="col" class="whitespace-nowrap px-4 py-3 text-center">Lokasi & Tanggal
                                        Hilang</th>
                                @else
                                    <th scope="col" class="whitespace-nowrap px-4 py-3">Barang Temuan</th>
                                    <th scope="col" class="whitespace-nowrap px-4 py-3">Pengklaim</th>
                                    <th scope="col" class="whitespace-nowrap px-4 py-3 text-center">Tanggal Klaim</th>
                                    <th scope="col" class="whitespace-nowrap px-4 py-3 text-center">Tanggal Diambil
                                    </th>
                                @endif
                                <th scope="col" class="whitespace-nowrap px-4 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e7ebf2] bg-white">
                            @foreach ($data as $index => $item)
                                <tr>
                                    <td class="whitespace-nowrap px-4 py-3 tabular-nums text-ink-muted">
                                        {{ $index + 1 }}
                                    </td>
                                    @if ($jenis === 'barang_temuan')
                                        <td class="px-4 py-3 font-medium text-ink">{{ $item->nama_barang }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 text-center text-[#3d4b60]">
                                            {{ $item->kategori->nama_kategori }}</td>
                                        <td class="px-4 py-3 text-[#3d4b60]">{{ $item->lokasi_ditemukan }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 text-center tabular-nums text-[#3d4b60]">
                                            {{ $item->tanggal_ditemukan->format('d M Y') }}</td>
                                    @elseif ($jenis === 'laporan_kehilangan')
                                        <td class="px-4 py-3 font-medium text-ink">{{ $item->nama_barang }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 text-center text-[#3d4b60]">
                                            {{ $item->kategori->nama_kategori }}</td>
                                        <td class="px-4 py-3 text-[#3d4b60]">
                                            <p class="font-medium text-ink">{{ $item->pengguna->nama }}</p>
                                            <p class="text-xs tabular-nums text-ink-muted">{{ $item->pengguna->nim }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-center text-[#3d4b60]">
                                            <p>{{ $item->lokasi_hilang }}</p>
                                            <p class="whitespace-nowrap text-xs tabular-nums text-ink-muted">
                                                {{ $item->tanggal_hilang->format('d M Y') }}</p>
                                        </td>
                                    @else
                                        <td class="px-4 py-3">
                                            <p class="font-medium text-ink">{{ $item->barangTemuan->nama_barang }}</p>
                                            <p class="text-xs text-ink-muted">
                                                {{ $item->barangTemuan->kategori->nama_kategori }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-[#3d4b60]">
                                            <p class="font-medium text-ink">{{ $item->pengguna->nama }}</p>
                                            <p class="text-xs tabular-nums text-ink-muted">{{ $item->pengguna->nim }}</p>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-center tabular-nums text-[#3d4b60]">
                                            {{ $item->created_at->format('d M Y') }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 text-center tabular-nums text-[#3d4b60]">
                                            {{ $item->tanggal_diambil?->format('d M Y, H:i') ?? '-' }}</td>
                                    @endif
                                    <td class="whitespace-nowrap px-4 py-3 text-center font-medium text-ink">
                                        {{ ucfirst($item->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="hidden justify-end pt-10 print:flex">
                <div class="text-center text-xs text-ink">
                    <p class="tabular-nums">Jember, {{ now()->format('d M Y') }}</p>
                    <p class="mt-1">Petugas Pos Keamanan UNEJ</p>
                    <div class="h-16"></div>
                    <p class="font-semibold underline">{{ Auth::user()->nama }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
