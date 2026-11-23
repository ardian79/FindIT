@extends('layouts.dashboard')

@section('title', 'Master Kategori')
@section('header', 'Master Kategori')

@section('content')
    <div class="space-y-5">
        <div>
            <a href="{{ route('petugas.kategori.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Kategori
            </a>
        </div>

        <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
            @if ($kategori->isEmpty())
                <div class="px-6 py-14 text-center text-sm text-ink-muted">Belum ada data kategori.</div>
            @else
                @php
                    $iconBtn = 'inline-flex h-9 w-9 items-center justify-center rounded-lg border bg-white transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2';
                @endphp
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#e7ebf2] text-left text-sm">
                        <thead class="bg-[#f7f8fb] text-xs font-medium text-ink-muted">
                            <tr>
                                <th scope="col" class="w-14 px-5 py-3">No</th>
                                <th scope="col" class="px-5 py-3">Nama Kategori</th>
                                <th scope="col" class="px-5 py-3 text-center">Barang Temuan</th>
                                <th scope="col" class="px-5 py-3 text-center">Laporan Kehilangan</th>
                                <th scope="col" class="w-px whitespace-nowrap px-5 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e7ebf2] bg-white">
                            @foreach ($kategori as $index => $item)
                                <tr class="transition-colors duration-150 hover:bg-[#f7f8fb]">
                                    <td class="px-5 py-4 tabular-nums text-ink-muted">{{ $index + 1 }}</td>
                                    <td class="px-5 py-4 font-medium text-ink">{{ $item->nama_kategori }}</td>
                                    <td class="px-5 py-4 text-center tabular-nums text-[#3d4b60]">{{ $item->barang_temuan_count }}</td>
                                    <td class="px-5 py-4 text-center tabular-nums text-[#3d4b60]">{{ $item->laporan_kehilangan_count }}</td>
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <a href="{{ route('petugas.kategori.edit', $item) }}" title="Edit" aria-label="Edit {{ $item->nama_kategori }}"
                                                class="{{ $iconBtn }} border-[#d7dde7] text-ink hover:bg-[#f3f5f8] focus-visible:ring-ink-navy/30">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zM19.5 7.125L16.862 4.487M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('petugas.kategori.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus kategori {{ $item->nama_kategori }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Hapus" aria-label="Hapus {{ $item->nama_kategori }}"
                                                    class="{{ $iconBtn }} border-[#f3c3c0] text-[#b42318] hover:border-brand hover:bg-[#fef3f2] focus-visible:ring-brand/30">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
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