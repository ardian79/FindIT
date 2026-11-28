@extends('layouts.app')

@section('title', 'Laporan Kehilangan Saya - FindIT UNEJ')

@section('content')
    <div class="mx-auto max-w-290 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-ink">Laporan Kehilangan Saya</h1>
                <p class="mt-1 text-sm text-ink-muted">Kelola daftar barang hilang yang Anda laporkan agar dapat dipantau
                    petugas dan sivitas kampus.</p>
            </div>
            <button type="button" popovertarget="modal-laporan-create"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Buat Laporan Baru
            </button>
        </div>

        @if ($laporan->isEmpty())
            <div class="rounded-2xl border border-dashed border-[#d7dde7] bg-white px-6 py-16 text-center">
                <svg class="mx-auto h-10 w-10 text-ink-muted/60" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <h2 class="mt-3 text-base font-semibold text-ink">Belum ada laporan kehilangan</h2>
                <p class="mt-1 text-sm text-ink-muted">Kehilangan barang di area kampus? Buat laporan agar lebih mudah
                    ditemukan.</p>
                <button type="button" popovertarget="modal-laporan-create"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98] mt-5">Buat
                    Laporan
                    Pertama</button>
            </div>
        @else
            <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#e7ebf2] text-left text-sm">
                        <thead class="bg-[#f7f8fb] text-xs font-medium text-ink-muted">
                            <tr>
                                <th scope="col" class="px-5 py-3">Barang</th>
                                <th scope="col" class="px-5 py-3">Lokasi &amp; Tanggal Hilang</th>
                                <th scope="col" class="px-5 py-3 text-center">Status</th>
                                <th scope="col" class="px-5 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e7ebf2] bg-white">
                            @foreach ($laporan as $item)
                                <tr class="transition-colors duration-150 hover:bg-[#f7f8fb]">
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            @if ($item->foto_barang)
                                                <img src="{{ asset('storage/' . $item->foto_barang) }}"
                                                    alt="{{ $item->nama_barang }}" loading="lazy" decoding="async"
                                                    class="h-12 w-12 shrink-0 rounded-lg object-cover">
                                            @else
                                                <div
                                                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#f3f5f8] text-ink-muted">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <p class="font-medium text-ink">{{ $item->nama_barang }}</p>
                                                <p class="text-xs text-ink-muted">{{ $item->kategori->nama_kategori }}</p>
                                                <p class="mt-0.5 line-clamp-1 max-w-xs text-xs text-ink-muted">
                                                    {{ $item->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 text-[#3d4b60]">
                                        <p class="font-medium text-ink">{{ $item->lokasi_hilang }}</p>
                                        <p class="text-xs tabular-nums text-ink-muted">
                                            {{ $item->tanggal_hilang->format('d M Y') }}</p>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if ($item->status === 'dicari')
                                            <span
                                                class="inline-flex items-center rounded-lg border border-amber-200/80 bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-800">
                                                Dicari
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center rounded-lg bg-[#e8eef6] px-2.5 py-1 text-xs font-medium text-ink-navy">
                                                Ditemukan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-center gap-1.5">
                                            @if ($item->status === 'dicari')
                                                <button type="button" popovertarget="confirm-ditemukan-{{ $item->id }}"
                                                    title="Tandai sudah ditemukan"
                                                    aria-label="Tandai {{ $item->nama_barang }} sudah ditemukan"
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 bg-[#e8eef6] text-ink-navy hover:bg-[#dce5f2] focus-visible:ring-ink-navy/30">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            @endif

                                            <button type="button" popovertarget="modal-laporan-edit-{{ $item->id }}"
                                                title="Edit" aria-label="Edit {{ $item->nama_barang }}"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 border border-[#d7dde7] bg-white text-ink hover:bg-[#f3f5f8] focus-visible:ring-ink-navy/30">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zM19.5 7.125L16.862 4.487M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </button>

                                            <button type="button" popovertarget="confirm-hapus-{{ $item->id }}"
                                                title="Hapus" aria-label="Hapus {{ $item->nama_barang }}"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 border border-[#f3c3c0] bg-white text-[#b42318] hover:border-brand hover:bg-[#fef3f2] focus-visible:ring-brand/30">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6">{{ $laporan->links() }}</div>
        @endif
    </div>

    <div id="modal-laporan-create" popover aria-labelledby="modal-laporan-create-title"
        class="m-auto max-h-[90vh] w-[calc(100%-2rem)] max-w-lg overflow-y-auto rounded-2xl border border-[#e7ebf2] bg-white p-0 text-left backdrop:bg-ink-deep/60">
        <div class="sticky top-0 z-10 flex items-center justify-between border-b border-[#e7ebf2] bg-white px-6 py-4">
            <h2 id="modal-laporan-create-title" class="text-base font-semibold text-ink">Buat Laporan Kehilangan</h2>
            <button type="button" popovertarget="modal-laporan-create" popovertargetaction="hide" aria-label="Tutup"
                class="rounded-lg p-1.5 text-ink-muted transition-colors hover:bg-[#f3f5f8] hover:text-ink focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('mahasiswa.laporan.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 p-6">
            @csrf
            <div>
                <label for="nama_barang" class="mb-1.5 block text-sm font-medium text-ink">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" required
                    placeholder="Contoh: Dompet kulit hitam"
                    class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="kategori_id" class="mb-1.5 block text-sm font-medium text-ink">Kategori</label>
                    <select id="kategori_id" name="kategori_id" required
                        class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tanggal_hilang" class="mb-1.5 block text-sm font-medium text-ink">Tanggal Hilang</label>
                    <input type="date" id="tanggal_hilang" name="tanggal_hilang" required max="{{ date('Y-m-d') }}"
                        class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10 tabular-nums">
                </div>
            </div>

            <div>
                <label for="lokasi_hilang" class="mb-1.5 block text-sm font-medium text-ink">Perkiraan Lokasi
                    Hilang</label>
                <input type="text" id="lokasi_hilang" name="lokasi_hilang" required
                    placeholder="Contoh: Parkiran Gedung Fakultas Ilmu Komputer"
                    class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
            </div>

            <div>
                <label for="deskripsi" class="mb-1.5 block text-sm font-medium text-ink">Deskripsi &amp; Ciri-Ciri</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" required
                    placeholder="Jelaskan warna, merek, atau ciri khusus barang"
                    class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10"></textarea>
            </div>

            <div>
                <label for="foto_barang" class="mb-1.5 block text-sm font-medium text-ink">Foto Barang (Opsional)</label>
                <input type="file" id="foto_barang" name="foto_barang" accept=".jpg,.jpeg,.png,.webp"
                    class="w-full rounded-xl border border-[#d7dde7] px-3 py-2 text-sm text-[#3d4b60] file:mr-3 file:rounded-lg file:border-0 file:bg-[#f3f5f8] file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-ink hover:file:bg-[#e7ebf2]">
                <p class="mt-1 text-xs text-ink-muted">Format JPG, PNG, atau WEBP maksimal 2MB.</p>
            </div>

            <div class="flex justify-end gap-2 border-t border-[#e7ebf2] pt-4">
                <button type="button" popovertarget="modal-laporan-create" popovertargetaction="hide"
                    class="inline-flex items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-4 py-2.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Batal</button>
                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">Simpan
                    Laporan</button>
            </div>
        </form>
    </div>

    @foreach ($laporan as $item)
        <div id="modal-laporan-edit-{{ $item->id }}" popover aria-labelledby="modal-edit-title-{{ $item->id }}"
            class="m-auto max-h-[90vh] w-[calc(100%-2rem)] max-w-lg overflow-y-auto rounded-2xl border border-[#e7ebf2] bg-white p-0 text-left backdrop:bg-ink-deep/60">
            <div class="sticky top-0 z-10 flex items-center justify-between border-b border-[#e7ebf2] bg-white px-6 py-4">
                <h2 id="modal-edit-title-{{ $item->id }}" class="text-base font-semibold text-ink">Edit Laporan
                    Kehilangan</h2>
                <button type="button" popovertarget="modal-laporan-edit-{{ $item->id }}" popovertargetaction="hide"
                    aria-label="Tutup"
                    class="rounded-lg p-1.5 text-ink-muted transition-colors hover:bg-[#f3f5f8] hover:text-ink focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('mahasiswa.laporan.update', $item) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4 p-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_nama_{{ $item->id }}" class="mb-1.5 block text-sm font-medium text-ink">Nama
                        Barang</label>
                    <input type="text" id="edit_nama_{{ $item->id }}" name="nama_barang"
                        value="{{ $item->nama_barang }}" required
                        class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="edit_kategori_{{ $item->id }}"
                            class="mb-1.5 block text-sm font-medium text-ink">Kategori</label>
                        <select id="edit_kategori_{{ $item->id }}" name="kategori_id" required
                            class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}" @selected($item->kategori_id == $kat->id)>
                                    {{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="edit_tanggal_{{ $item->id }}"
                            class="mb-1.5 block text-sm font-medium text-ink">Tanggal Hilang</label>
                        <input type="date" id="edit_tanggal_{{ $item->id }}" name="tanggal_hilang"
                            value="{{ $item->tanggal_hilang->format('Y-m-d') }}" required max="{{ date('Y-m-d') }}"
                            class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10 tabular-nums">
                    </div>
                </div>

                <div>
                    <label for="edit_lokasi_{{ $item->id }}"
                        class="mb-1.5 block text-sm font-medium text-ink">Perkiraan Lokasi
                        Hilang</label>
                    <input type="text" id="edit_lokasi_{{ $item->id }}" name="lokasi_hilang"
                        value="{{ $item->lokasi_hilang }}" required
                        class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">
                </div>

                <div>
                    <label for="edit_deskripsi_{{ $item->id }}"
                        class="mb-1.5 block text-sm font-medium text-ink">Deskripsi &amp;
                        Ciri-Ciri</label>
                    <textarea id="edit_deskripsi_{{ $item->id }}" name="deskripsi" rows="3" required
                        class="w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10">{{ $item->deskripsi }}</textarea>
                </div>

                <div>
                    <label for="edit_foto_{{ $item->id }}" class="mb-1.5 block text-sm font-medium text-ink">Foto
                        Barang
                        (Opsional)</label>
                    <input type="file" id="edit_foto_{{ $item->id }}" name="foto_barang"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="w-full rounded-xl border border-[#d7dde7] px-3 py-2 text-sm text-[#3d4b60] file:mr-3 file:rounded-lg file:border-0 file:bg-[#f3f5f8] file:px-3 file:py-1.5 file:text-xs file:font-medium file:text-ink hover:file:bg-[#e7ebf2]">
                    <p class="mt-1 text-xs text-ink-muted">Kosongkan jika tidak ingin mengganti foto lama. Maksimal 2MB.
                    </p>
                </div>

                <div class="flex justify-end gap-2 border-t border-[#e7ebf2] pt-4">
                    <button type="button" popovertarget="modal-laporan-edit-{{ $item->id }}"
                        popovertargetaction="hide"
                        class="inline-flex items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-4 py-2.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Batal</button>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">Perbarui
                        Laporan</button>
                </div>
            </form>
        </div>

        @if ($item->status === 'dicari')
            <div id="confirm-ditemukan-{{ $item->id }}" popover
                class="m-auto w-[calc(100%-2rem)] max-w-sm rounded-2xl border border-[#e7ebf2] bg-white p-6 text-left backdrop:bg-ink-deep/60">
                <h3 class="text-base font-semibold text-ink">Konfirmasi Status</h3>
                <p class="mt-2 text-sm text-ink-muted">Tandai barang <strong>{{ $item->nama_barang }}</strong> sudah
                    ditemukan?</p>
                <div class="mt-5 flex justify-end gap-2">
                    <button type="button" popovertarget="confirm-ditemukan-{{ $item->id }}"
                        popovertargetaction="hide"
                        class="inline-flex items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-4 py-2.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Batal</button>
                    <form action="{{ route('mahasiswa.laporan.ditemukan', $item) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-ink-navy px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-ink-deep">Ya,
                            Ditemukan</button>
                    </form>
                </div>
            </div>
        @endif

        <div id="confirm-hapus-{{ $item->id }}" popover
            class="m-auto w-[calc(100%-2rem)] max-w-sm rounded-2xl border border-[#e7ebf2] bg-white p-6 text-left backdrop:bg-ink-deep/60">
            <h3 class="text-base font-semibold text-ink">Hapus Laporan</h3>
            <p class="mt-2 text-sm text-ink-muted">Hapus laporan kehilangan <strong>{{ $item->nama_barang }}</strong>?</p>
            <div class="mt-5 flex justify-end gap-2">
                <button type="button" popovertarget="confirm-hapus-{{ $item->id }}" popovertargetaction="hide"
                    class="inline-flex items-center justify-center rounded-xl border border-[#d7dde7] bg-white px-4 py-2.5 text-sm font-medium text-ink transition-colors duration-150 hover:bg-[#f7f8fb] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">Batal</button>
                <form action="{{ route('mahasiswa.laporan.destroy', $item) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-4 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">Ya,
                        Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection
