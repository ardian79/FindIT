@extends('layouts.dashboard')

@section('title', 'Kelola Pengguna Mahasiswa')

@section('header', 'Kelola Pengguna Mahasiswa')

@section('content')
    <div class="space-y-5">
        <p class="text-sm text-slate-500">Pantau daftar akun mahasiswa terdaftar, hubungi melalui WhatsApp, atau nonaktifkan akun yang melanggar ketentuan layanan.</p>

        <form action="{{ route('petugas.pengguna.index') }}" method="GET" class="grid grid-cols-1 gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm md:grid-cols-12">
            <div class="relative md:col-span-7">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIM, atau nomor HP..." class="w-full rounded-xl border border-slate-300 py-2 pl-10 pr-3.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
            </div>

            <div class="md:col-span-3">
                <select name="status" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="flex gap-2 md:col-span-2">
                <button type="submit" class="flex-1 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Filter
                </button>
                @if (request()->filled('search') || request()->filled('status'))
                    <a href="{{ route('petugas.pengguna.index') }}" class="rounded-xl border border-slate-300 px-3 py-2 text-center text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            @if ($pengguna->isEmpty())
                <div class="px-6 py-14 text-center text-sm text-slate-500">
                    Belum ada data pengguna mahasiswa yang sesuai.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-5 py-3.5">Mahasiswa</th>
                                <th class="px-5 py-3.5">Kontak WA / HP</th>
                                <th class="px-5 py-3.5 text-center">Aktivitas</th>
                                <th class="px-5 py-3.5">Status Akun</th>
                                <th class="px-5 py-3.5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach ($pengguna as $item)
                                @php
                                    $wa = $item->no_hp ? preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $item->no_hp)) : null;
                                @endphp
                                <tr class="hover:bg-slate-50/70">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-sm font-bold text-emerald-700">
                                                {{ strtoupper(substr($item->nama, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-slate-900">{{ $item->nama }}</p>
                                                <p class="text-xs text-slate-500">NIM: {{ $item->nim }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="text-slate-800">{{ $item->no_hp }}</p>
                                        @if ($wa)
                                            <a href="https://wa.me/{{ $wa }}" target="_blank" class="text-xs font-semibold text-emerald-600 hover:text-emerald-700">
                                                Chat WhatsApp
                                            </a>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <div class="inline-flex items-center gap-2 text-xs">
                                            <span class="rounded-lg bg-slate-100 px-2.5 py-1 font-medium text-slate-700">{{ $item->laporan_kehilangan_count }} Laporan</span>
                                            <span class="rounded-lg bg-slate-100 px-2.5 py-1 font-medium text-slate-700">{{ $item->klaim_count }} Klaim</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        @if ($item->is_active)
                                            <span class="inline-flex rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-semibold text-emerald-800">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-800">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <form action="{{ route('petugas.pengguna.toggle-status', $item) }}" method="POST" onsubmit="return confirm('{{ $item->is_active ? 'Nonaktifkan akun ' . $item->nama . '?' : 'Aktifkan kembali akun ' . $item->nama . '?' }}')">
                                            @csrf
                                            @method('PATCH')
                                            @if ($item->is_active)
                                                <button type="submit" class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                                    Nonaktifkan
                                                </button>
                                            @else
                                                <button type="submit" class="rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100">
                                                    Aktifkan
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div>
            {{ $pengguna->links() }}
        </div>
    </div>
@endsection