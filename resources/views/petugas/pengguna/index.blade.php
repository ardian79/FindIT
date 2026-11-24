@extends('layouts.petugas')

@section('title', 'Kelola Pengguna Mahasiswa')
@section('header', 'Kelola Pengguna Mahasiswa')

@section('content')
    @php
        $toWa = fn (?string $hp) => $hp ? preg_replace('/^0/', '62', preg_replace('/\D/', '', $hp)) : null;
        $field = 'h-[42px] w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10';
    @endphp

    <div class="space-y-5">
        <form action="{{ route('petugas.pengguna.index') }}" method="GET" class="flex flex-col gap-3 rounded-2xl border border-[#e7ebf2] bg-white p-4 md:flex-row md:flex-wrap md:items-center">
            <div class="relative min-w-[200px] flex-1">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-ink-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIM, atau nomor HP" class="{{ $field }} pl-10">
            </div>

            <div class="w-full md:w-44">
                <select name="status" class="{{ $field }}">
                    <option value="">Semua Status</option>
                    @foreach (['aktif' => 'Aktif', 'nonaktif' => 'Nonaktif'] as $val => $label)
                        <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex shrink-0 items-center gap-2">
                <button type="submit" class="inline-flex h-[42px] flex-1 items-center justify-center rounded-xl bg-brand px-5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98] md:flex-none">Filter</button>
                @if (request()->anyFilled(['search', 'status']))
                    <a href="{{ route('petugas.pengguna.index') }}" class="inline-flex h-[42px] items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-3.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Reset</a>
                @endif
            </div>
        </form>

        <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
            @if ($pengguna->isEmpty())
                <div class="px-6 py-14 text-center text-sm text-ink-muted">Belum ada data pengguna mahasiswa yang sesuai.</div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#e7ebf2] text-left text-sm">
                        <thead class="bg-[#f7f8fb] text-xs font-medium text-ink-muted">
                            <tr>
                                <th scope="col" class="px-5 py-3">Mahasiswa</th>
                                <th scope="col" class="whitespace-nowrap px-5 py-3 text-center">Kontak WA / HP</th>
                                <th scope="col" class="whitespace-nowrap px-5 py-3 text-center">Aktivitas</th>
                                <th scope="col" class="whitespace-nowrap px-5 py-3 text-center">Status Akun</th>
                                <th scope="col" class="w-px whitespace-nowrap px-5 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e7ebf2] bg-white">
                            @foreach ($pengguna as $item)
                                @php
                                    $wa = $toWa($item->no_hp);
                                @endphp
                                <tr class="transition-colors duration-150 hover:bg-[#f7f8fb]">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#eef1f5] text-xs font-semibold text-ink-navy">
                                                {{ strtoupper(substr($item->nama, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-ink">{{ $item->nama }}</p>
                                                <p class="text-xs tabular-nums text-ink-muted">NIM: {{ $item->nim }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-center">
                                        @if ($wa)
                                            <div class="inline-flex items-center gap-2">
                                                <span class="tabular-nums text-[#3d4b60]">{{ $item->no_hp }}</span>
                                                <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" aria-label="Chat WhatsApp {{ $item->nama }}" title="Chat WhatsApp"
                                                    class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[#25D366] text-white transition-colors duration-150 hover:bg-[#1fb85a] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#25D366] focus-visible:ring-offset-1">
                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                        <path d="M20.52 3.48A11.86 11.86 0 0012.07 0C5.52 0 .18 5.33.18 11.89c0 2.1.55 4.15 1.59 5.95L.11 24l6.3-1.65a11.87 11.87 0 005.65 1.44h.01c6.55 0 11.89-5.33 11.89-11.89a11.8 11.8 0 00-3.44-8.42zm-8.45 18.28h-.01a9.86 9.86 0 01-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.38a9.83 9.83 0 01-1.51-5.24c0-5.44 4.43-9.87 9.88-9.87a9.8 9.8 0 019.87 9.87c0 5.45-4.43 9.88-9.86 9.88zm5.42-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.39-1.48-.88-.79-1.48-1.76-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.21 5.09 4.5.71.31 1.27.49 1.7.63.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.07-.12-.27-.2-.57-.35z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        @else
                                            <span class="text-ink-muted">{{ $item->no_hp ?? '-' }}</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-center text-xs tabular-nums text-ink-muted">
                                        {{ $item->laporan_kehilangan_count }} laporan · {{ $item->klaim_count }} klaim
                                    </td>
                                    <td class="whitespace-nowrap px-5 py-4 text-center">
                                        <span class="inline-flex rounded-lg px-2.5 py-1 text-xs font-medium {{ $item->is_active ? 'bg-[#e8eef6] text-ink-navy' : 'bg-brand-soft text-brand-dark' }}">
                                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="w-px whitespace-nowrap px-5 py-4 text-center">
                                        <button type="button" popovertarget="confirm-toggle-{{ $item->id }}"
                                            class="rounded-lg border px-3 py-1.5 text-xs font-medium transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 {{ $item->is_active ? 'border-[#f3c3c0] bg-white text-[#b42318] hover:border-brand hover:bg-[#fef3f2] focus-visible:ring-brand/30' : 'border-transparent bg-[#e8eef6] text-ink-navy hover:bg-[#dce5f2] focus-visible:ring-ink-navy/30' }}">
                                            {{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @foreach ($pengguna as $item)
                    <div id="confirm-toggle-{{ $item->id }}" popover class="m-auto w-[calc(100%-2rem)] max-w-sm rounded-2xl border border-[#e7ebf2] bg-white p-6 text-left backdrop:bg-ink-deep/60">
                        <h3 class="text-base font-semibold text-ink">{{ $item->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}</h3>
                        <p class="mt-2 text-sm text-ink-muted">{{ $item->is_active ? 'Nonaktifkan akun' : 'Aktifkan kembali akun' }} <strong>{{ $item->nama }}</strong>?</p>
                        <div class="mt-5 flex justify-end gap-2">
                            <button type="button" popovertarget="confirm-toggle-{{ $item->id }}" popovertargetaction="hide" class="inline-flex h-10 items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-4 text-sm font-medium text-ink hover:bg-[#f7f8fb]">Batal</button>
                            <form action="{{ route('petugas.pengguna.toggle-status', $item) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex h-10 items-center justify-center rounded-xl px-4 text-sm font-medium text-white {{ $item->is_active ? 'bg-brand hover:bg-brand-dark' : 'bg-ink-navy hover:bg-ink-deep' }}">
                                    {{ $item->is_active ? 'Ya, Nonaktifkan' : 'Ya, Aktifkan' }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
@endsection