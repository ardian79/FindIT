@extends('layouts.dashboard')

@section('title', 'Kelola Pengguna Mahasiswa')

@section('header', 'Kelola Pengguna Mahasiswa')

@section('content')
    <div class="space-y-5">

        <form action="{{ route('petugas.pengguna.index') }}" method="GET" class="grid grid-cols-1 gap-3 rounded-2xl border border-slate-200/80 bg-white p-4 md:grid-cols-12">
            <div class="relative md:col-span-7">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIM, atau nomor HP..." class="w-full rounded-xl border border-slate-300 py-2 pl-10 pr-3.5 text-sm text-slate-900 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
            </div>

            <div class="md:col-span-3">
                <select name="status" class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-sm text-slate-700 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="flex gap-2 md:col-span-2">
                <button type="submit" class="flex-1 rounded-full bg-[#c41230] focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#9b1028]">
                    Filter
                </button>
                @if (request()->filled('search') || request()->filled('status'))
                    <a href="{{ route('petugas.pengguna.index') }}" class="rounded-xl border border-slate-300 px-3 py-2 text-center text-sm font-medium text-slate-600 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white">
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
                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-50 text-sm font-bold text-[#94191d]">
                                                {{ strtoupper(substr($item->nama, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-semibold text-slate-900">{{ $item->nama }}</p>
                                                <p class="text-xs text-slate-500">NIM: {{ $item->nim }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        @if ($wa)
                                            <div class="flex items-center gap-2">
                                                <p class="text-slate-800">{{ $item->no_hp }}</p>
                                                <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" aria-label="Chat WhatsApp {{ $item->nama }}" title="Chat WhatsApp" class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#25D366] text-white shadow-sm transition duration-200 hover:bg-[#1fb85a] hover:shadow-md active:scale-[0.96] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#25D366] focus-visible:ring-offset-2">
                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                        <path d="M20.52 3.48A11.86 11.86 0 0012.07 0C5.52 0 .18 5.33.18 11.89c0 2.1.55 4.15 1.59 5.95L.11 24l6.3-1.65a11.87 11.87 0 005.65 1.44h.01c6.55 0 11.89-5.33 11.89-11.89a11.8 11.8 0 00-3.44-8.42zm-8.45 18.28h-.01a9.86 9.86 0 01-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.38a9.83 9.83 0 01-1.51-5.24c0-5.44 4.43-9.87 9.88-9.87a9.8 9.8 0 019.87 9.87c0 5.45-4.43 9.88-9.86 9.88zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.39-1.48-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.21 5.09 4.5.71.31 1.27.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.07-.12-.27-.2-.57-.35z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        @else
                                            <p class="text-slate-500">{{ $item->no_hp ?? '-' }}</p>
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
                                            <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-[#17365d]">
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
                                                <button type="submit" class="rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-[#94191d] transition hover:bg-red-50">
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