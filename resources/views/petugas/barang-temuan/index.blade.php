@extends('layouts.dashboard')

@section('title', 'Kelola Barang Temuan')

@section('header', 'Kelola Barang Temuan')

@section('content')
    <div class="space-y-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-slate-500">Daftar seluruh barang temuan yang diamankan di Pos Keamanan Utama UNEJ.</p>
            <a href="{{ route('petugas.barang-temuan.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Barang Temuan
            </a>
        </div>

        <form action="{{ route('petugas.barang-temuan.index') }}" method="GET" class="grid grid-cols-1 gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm md:grid-cols-12">
            <div class="relative md:col-span-5">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang atau lokasi..." class="w-full rounded-xl border border-slate-300 py-2 pl-10 pr-3.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
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
                    <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="diklaim" {{ request('status') === 'diklaim' ? 'selected' : '' }}>Diklaim</option>
                    <option value="dikembalikan" {{ request('status') === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>

            <div class="flex gap-2 md:col-span-2">
                <button type="submit" class="flex-1 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Filter
                </button>
                @if (request()->filled('search') || request()->filled('kategori_id') || request()->filled('status'))
                    <a href="{{ route('petugas.barang-temuan.index') }}" class="rounded-xl border border-slate-300 px-3 py-2 text-center text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            @if ($barangTemuan->isEmpty())
                <div class="px-6 py-14 text-center text-sm text-slate-500">
                    Belum ada data barang temuan yang sesuai.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-5 py-3.5">Barang</th>
                                <th class="px-5 py-3.5">Lokasi & Tanggal</th>
                                <th class="px-5 py-3.5">Status</th>
                                <th class="px-5 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach ($barangTemuan as $item)
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3.5">
                                            <img src="{{ asset('storage/' . $item->foto_barang) }}" alt="{{ $item->nama_barang }}" class="h-12 w-12 shrink-0 rounded-xl object-cover bg-slate-100">
                                            <div class="min-w-0">
                                                <p class="font-semibold text-slate-900">{{ $item->nama_barang }}</p>
                                                <p class="text-xs text-emerald-600 font-medium">{{ $item->kategori->nama_kategori }}</p>
                                                <p class="mt-0.5 line-clamp-1 max-w-xs text-xs text-slate-500">{{ $item->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-medium text-slate-800">{{ $item->lokasi_ditemukan }}</p>
                                        <p class="text-xs text-slate-500">{{ $item->tanggal_ditemukan->format('d M Y') }}</p>
                                    </td>
                                    <td class="px-5 py-4">
                                        @if ($item->status === 'tersedia')
                                            <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800">
                                                Tersedia
                                            </span>
                                        @elseif ($item->status === 'diklaim')
                                            <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800">
                                                Diklaim
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">
                                                Dikembalikan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('petugas.barang-temuan.edit', $item) }}" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">
                                                Edit
                                            </a>
                                            <form action="{{ route('petugas.barang-temuan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus barang temuan {{ $item->nama_barang }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">
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
            {{ $barangTemuan->links() }}
        </div>
    </div>
@endsection