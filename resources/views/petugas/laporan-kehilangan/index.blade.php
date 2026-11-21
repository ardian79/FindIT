@extends('layouts.dashboard')

@section('title', 'Pantau Laporan Kehilangan')

@section('header', 'Laporan Kehilangan Mahasiswa')

@section('content')
    <div class="space-y-5">
        <p class="text-sm text-slate-500">Pantau laporan barang hilang dari mahasiswa, ubah status jika sudah ditemukan, atau bersihkan laporan yang sudah melewati 30 hari.</p>

        <form action="{{ route('petugas.laporan-kehilangan.index') }}" method="GET" class="grid grid-cols-1 gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm md:grid-cols-12">
            <div class="relative md:col-span-5">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang, lokasi, nama, atau NIM..." class="w-full rounded-xl border border-slate-300 py-2 pl-10 pr-3.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
            </div>

            <div class="md:col-span-3">
                <select name="kategori_id" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <select name="status" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                    <option value="">Semua Status</option>
                    <option value="dicari" {{ request('status') === 'dicari' ? 'selected' : '' }}>Dicari</option>
                    <option value="ditemukan" {{ request('status') === 'ditemukan' ? 'selected' : '' }}>Ditemukan</option>
                </select>
            </div>

            <div class="flex gap-2 md:col-span-2">
                <button type="submit" class="flex-1 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Filter
                </button>
                @if (request()->filled('search') || request()->filled('kategori_id') || request()->filled('status'))
                    <a href="{{ route('petugas.laporan-kehilangan.index') }}" class="rounded-xl border border-slate-300 px-3 py-2 text-center text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            @if ($laporan->isEmpty())
                <div class="px-6 py-14 text-center text-sm text-slate-500">
                    Belum ada laporan kehilangan yang sesuai.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-5 py-3.5">Barang</th>
                                <th class="px-5 py-3.5">Pelapor</th>
                                <th class="px-5 py-3.5">Lokasi & Tanggal</th>
                                <th class="px-5 py-3.5">Status</th>
                                <th class="px-5 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach ($laporan as $item)
                                @php
                                    $wa = $item->pengguna && $item->pengguna->no_hp ? preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $item->pengguna->no_hp)) : null;
                                    $lebihDari30Hari = $item->status === 'dicari' && $item->tanggal_hilang->lt(now()->subDays(30));
                                @endphp
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3.5">
                                            @if ($item->foto_barang)
                                                <img src="{{ asset('storage/' . $item->foto_barang) }}" alt="{{ $item->nama_barang }}" class="h-12 w-12 shrink-0 rounded-xl object-cover">
                                            @else
                                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-400">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <p class="font-semibold text-slate-900">{{ $item->nama_barang }}</p>
                                                <p class="text-xs font-medium text-emerald-600">{{ $item->kategori->nama_kategori }}</p>
                                                <p class="mt-0.5 line-clamp-1 max-w-xs text-xs text-slate-500">{{ $item->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-medium text-slate-900">{{ $item->pengguna->nama }}</p>
                                        <p class="text-xs text-slate-500">NIM: {{ $item->pengguna->nim }}</p>
                                        @if ($wa)
                                            <a href="https://wa.me/{{ $wa }}?text={{ urlencode('Halo ' . $item->pengguna->nama . ', saya petugas Pos Keamanan UNEJ terkait laporan kehilangan "' . $item->nama_barang . '".') }}" target="_blank" class="mt-1 inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                                Hubungi WA
                                            </a>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-medium text-slate-800">{{ $item->lokasi_hilang }}</p>
                                        <div class="mt-0.5 flex items-center gap-1.5">
                                            <span class="text-xs text-slate-500">{{ $item->tanggal_hilang->format('d M Y') }}</span>
                                            @if ($lebihDari30Hari)
                                                <span class="rounded bg-rose-100 px-1.5 py-0.5 text-[10px] font-semibold text-rose-700">&gt; 30 Hari</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        @if ($item->status === 'dicari')
                                            <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-800">
                                                Dicari
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800">
                                                Ditemukan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <form action="{{ route('petugas.laporan-kehilangan.status', $item) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="{{ $item->status === 'dicari' ? 'ditemukan' : 'dicari' }}">
                                                <button type="submit" class="rounded-lg border border-slate-300 px-2.5 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">
                                                    {{ $item->status === 'dicari' ? 'Tandai Ditemukan' : 'Buka Kembali' }}
                                                </button>
                                            </form>

                                            <form action="{{ route('petugas.laporan-kehilangan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus laporan kehilangan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg bg-red-50 px-2.5 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div>
            {{ $laporan->links() }}
        </div>
    </div>
@endsection