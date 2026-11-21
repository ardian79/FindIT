@extends('layouts.dashboard')

@section('title', 'Master Kategori')

@section('header', 'Master Kategori')

@section('content')
    <div class="space-y-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-slate-500">Kelola daftar kategori untuk pengelompokan barang temuan dan laporan kehilangan.</p>
            <a href="{{ route('petugas.kategori.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Kategori
            </a>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            @if ($kategori->isEmpty())
                <div class="px-6 py-14 text-center text-sm text-slate-500">
                    Belum ada data kategori.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="w-14 px-5 py-3.5">No</th>
                                <th class="px-5 py-3.5">Nama Kategori</th>
                                <th class="px-5 py-3.5 text-center">Barang Temuan</th>
                                <th class="px-5 py-3.5 text-center">Laporan Kehilangan</th>
                                <th class="px-5 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach ($kategori as $index => $item)
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-5 py-4 text-slate-500">{{ $index + 1 }}</td>
                                    <td class="px-5 py-4 font-semibold text-slate-900">{{ $item->nama_kategori }}</td>
                                    <td class="px-5 py-4 text-center">
                                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-700">
                                            {{ $item->barang_temuan_count }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-0.5 text-xs font-semibold text-slate-700">
                                            {{ $item->laporan_kehilangan_count }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('petugas.kategori.edit', $item) }}" class="rounded-lg border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">
                                                Edit
                                            </a>
                                            <form action="{{ route('petugas.kategori.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus kategori {{ $item->nama_kategori }}?')">
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
    </div>
@endsection