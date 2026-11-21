@extends('layouts.dashboard')

@section('title', 'Verifikasi Klaim')

@section('header', 'Verifikasi Klaim Barang')

@section('content')
    <div class="space-y-5">
        <p class="text-sm text-slate-500">Periksa kecocokan keterangan kepemilikan dari mahasiswa, setujui atau tolak klaim, lalu catat serah terima di Pos Keamanan Utama UNEJ.</p>

        <form action="{{ route('petugas.verifikasi-klaim.index') }}" method="GET" class="grid grid-cols-1 gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm md:grid-cols-12">
            <div class="relative md:col-span-7">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang, nama pengklaim, atau NIM..." class="w-full rounded-xl border border-slate-300 py-2 pl-10 pr-3.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
            </div>

            <div class="md:col-span-3">
                <select name="status" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="disetujui" {{ request('status') === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="flex gap-2 md:col-span-2">
                <button type="submit" class="flex-1 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Filter
                </button>
                @if (request()->filled('search') || request()->filled('status'))
                    <a href="{{ route('petugas.verifikasi-klaim.index') }}" class="rounded-xl border border-slate-300 px-3 py-2 text-center text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            @if ($klaim->isEmpty())
                <div class="px-6 py-14 text-center text-sm text-slate-500">
                    Belum ada pengajuan klaim yang sesuai.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-5 py-3.5">Barang Temuan</th>
                                <th class="px-5 py-3.5">Pengklaim</th>
                                <th class="px-5 py-3.5">Tanggal Pengajuan</th>
                                <th class="px-5 py-3.5">Status</th>
                                <th class="px-5 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach ($klaim as $item)
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3.5">
                                            <img src="{{ asset('storage/' . $item->barangTemuan->foto_barang) }}" alt="{{ $item->barangTemuan->nama_barang }}" class="h-12 w-12 shrink-0 rounded-xl bg-slate-100 object-cover">
                                            <div class="min-w-0">
                                                <p class="font-semibold text-slate-900">{{ $item->barangTemuan->nama_barang }}</p>
                                                <p class="text-xs font-medium text-emerald-600">{{ $item->barangTemuan->kategori->nama_kategori }}</p>
                                                <p class="mt-0.5 line-clamp-1 max-w-xs text-xs text-slate-500">{{ $item->keterangan_klaim }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="font-medium text-slate-900">{{ $item->pengguna->nama }}</p>
                                        <p class="text-xs text-slate-500">NIM: {{ $item->pengguna->nim }}</p>
                                    </td>
                                    <td class="px-5 py-4 text-slate-600">
                                        <p class="font-medium text-slate-800">{{ $item->created_at->format('d M Y') }}</p>
                                        <p class="text-xs text-slate-500">{{ $item->created_at->format('H:i') }} WIB</p>
                                    </td>
                                    <td class="px-5 py-4">
                                        @if ($item->status === 'pending')
                                            <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-800">
                                                Pending
                                            </span>
                                        @elseif ($item->status === 'disetujui')
                                            <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800">
                                                Disetujui
                                            </span>
                                        @elseif ($item->status === 'ditolak')
                                            <span class="inline-flex rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-800">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800">
                                                Selesai
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <a href="{{ route('petugas.verifikasi-klaim.show', $item) }}" class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100">
                                            Detail & Proses
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div>
            {{ $klaim->links() }}
        </div>
    </div>
@endsection