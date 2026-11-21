@extends('layouts.app')

@section('title', 'Laporan Kehilangan Saya - FindIT UNEJ')

@section('content')
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Laporan Kehilangan Saya</h1>
                <p class="mt-1 text-sm text-slate-500">Kelola daftar barang hilang yang Anda laporkan agar dapat dipantau petugas dan sivitas kampus.</p>
            </div>
            <button type="button" onclick="openCreateModal()" class="inline-flex items-center justify-center gap-2 rounded-full bg-[#c41230] focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 px-4 py-2.5 text-sm font-semibold text-white transition-all duration-150 hover:bg-[#9b1028] active:scale-[0.98]">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Buat Laporan Baru
            </button>
        </div>

        @if ($laporan->isEmpty())
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <h3 class="mt-3 text-base font-semibold text-slate-900">Belum ada laporan kehilangan</h3>
                <p class="mt-1 text-sm text-slate-500">Kehilangan barang di area kampus? Buat laporan agar lebih mudah ditemukan.</p>
                <button type="button" onclick="openCreateModal()" class="mt-5 inline-flex items-center gap-2 rounded-full bg-[#c41230] focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#9b1028]">
                    Buat Laporan Pertama
                </button>
            </div>
        @else
            <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-5 py-3.5">Barang</th>
                                <th class="px-5 py-3.5">Lokasi & Tanggal Hilang</th>
                                <th class="px-5 py-3.5">Status</th>
                                <th class="px-5 py-3.5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach ($laporan as $item)
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
                                                <p class="text-xs text-slate-500">{{ $item->kategori->nama_kategori }}</p>
                                                <p class="mt-0.5 line-clamp-1 max-w-xs text-xs text-slate-500">{{ $item->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 text-slate-600">
                                        <p class="font-medium text-slate-800">{{ $item->lokasi_hilang }}</p>
                                        <p class="text-xs text-slate-500">{{ $item->tanggal_hilang->format('d M Y') }}</p>
                                    </td>
                                    <td class="px-5 py-4">
                                        @if ($item->status === 'dicari')
                                            <span class="inline-flex items-center rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold text-amber-800">
                                                Dicari
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-[#17365d]">
                                                Ditemukan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            @if ($item->status === 'dicari')
                                                <form action="{{ route('mahasiswa.laporan.ditemukan', $item) }}" method="POST" onsubmit="return confirm('Tandai barang ini sudah ditemukan?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="rounded-lg bg-red-50 px-2.5 py-1.5 text-xs font-semibold text-[#94191d] transition hover:bg-red-50">
                                                        Sudah Ditemukan
                                                    </button>
                                                </form>
                                            @endif

                                            <button type="button"
                                                onclick="openEditModal(this)"
                                                data-id="{{ $item->id }}"
                                                data-kategori="{{ $item->kategori_id }}"
                                                data-nama="{{ $item->nama_barang }}"
                                                data-lokasi="{{ $item->lokasi_hilang }}"
                                                data-tanggal="{{ $item->tanggal_hilang->format('Y-m-d') }}"
                                                data-deskripsi="{{ $item->deskripsi }}"
                                                class="rounded-lg border border-slate-300 px-2.5 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-100">
                                                Edit
                                            </button>

                                            <form action="{{ route('mahasiswa.laporan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus laporan kehilangan ini?')">
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
            </div>

            <div class="mt-6">
                {{ $laporan->links() }}
            </div>
        @endif
    </div>

    <div id="modal-laporan" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 p-4 backdrop-blur-sm">
        <div class="relative max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl border border-slate-200/80 bg-white">
            <div class="sticky top-0 z-10 flex items-center justify-between border-b border-slate-200 bg-white px-6 py-4">
                <h2 id="modal-laporan-title" class="text-lg font-bold text-slate-900">Buat Laporan Kehilangan</h2>
                <button type="button" onclick="closeLaporanModal()" class="rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="form-laporan" action="{{ route('mahasiswa.laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 p-6">
                @csrf
                <input type="hidden" id="form-method" name="_method" value="PUT" disabled>

                <div>
                    <label for="nama_barang" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" required placeholder="Contoh: Dompet Kulit Hitam" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="kategori_id" class="mb-1.5 block text-sm font-medium text-slate-700">Kategori</label>
                        <select id="kategori_id" name="kategori_id" required class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tanggal_hilang" class="mb-1.5 block text-sm font-medium text-slate-700">Tanggal Hilang</label>
                        <input type="date" id="tanggal_hilang" name="tanggal_hilang" required max="{{ date('Y-m-d') }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
                    </div>
                </div>

                <div>
                    <label for="lokasi_hilang" class="mb-1.5 block text-sm font-medium text-slate-700">Perkiraan Lokasi Hilang</label>
                    <input type="text" id="lokasi_hilang" name="lokasi_hilang" required placeholder="Contoh: Parkiran Gedung Fakultas Ilmu Komputer" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20">
                </div>

                <div>
                    <label for="deskripsi" class="mb-1.5 block text-sm font-medium text-slate-700">Deskripsi & Ciri-Ciri</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" required placeholder="Jelaskan warna, merek, atau ciri khusus barang..." class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-[#b12025] focus:ring-2 focus:ring-[#b12025]/20"></textarea>
                </div>

                <div>
                    <label for="foto_barang" class="mb-1.5 block text-sm font-medium text-slate-700">Foto Barang (Opsional)</label>
                    <input type="file" id="foto_barang" name="foto_barang" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm text-slate-600 file:mr-3 file:rounded-lg file:border-0 file:bg-red-50 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-[#94191d] hover:file:bg-red-50">
                    <p id="foto-hint" class="mt-1 text-xs text-slate-500">Format JPG, PNG, atau WEBP maksimal 2MB.</p>
                </div>

                <div class="flex justify-end gap-2 border-t border-slate-200 pt-4">
                    <button type="button" onclick="closeLaporanModal()" class="rounded-xl border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" id="btn-submit-laporan" class="rounded-full bg-[#c41230] focus-visible:ring-2 focus-visible:ring-[#c41230] focus-visible:ring-offset-2 px-5 py-2 text-sm font-semibold text-white transition hover:bg-[#9b1028]">
                        Simpan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const storeUrl = "{{ route('mahasiswa.laporan.store') }}";
        const updateUrlTemplate = "{{ route('mahasiswa.laporan.update', ['laporanKehilangan' => '__ID__']) }}";

        function openCreateModal() {
            const form = document.getElementById('form-laporan');
            form.reset();
            form.action = storeUrl;

            const methodInput = document.getElementById('form-method');
            methodInput.disabled = true;

            document.getElementById('modal-laporan-title').textContent = 'Buat Laporan Kehilangan';
            document.getElementById('btn-submit-laporan').textContent = 'Simpan Laporan';
            document.getElementById('foto-hint').textContent = 'Format JPG, PNG, atau WEBP maksimal 2MB.';

            const modal = document.getElementById('modal-laporan');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function openEditModal(btn) {
            const form = document.getElementById('form-laporan');
            form.action = updateUrlTemplate.replace('__ID__', btn.dataset.id);

            const methodInput = document.getElementById('form-method');
            methodInput.disabled = false;

            document.getElementById('modal-laporan-title').textContent = 'Edit Laporan Kehilangan';
            document.getElementById('btn-submit-laporan').textContent = 'Perbarui Laporan';
            document.getElementById('foto-hint').textContent = 'Kosongkan jika tidak ingin mengganti foto lama. Maksimal 2MB.';

            document.getElementById('nama_barang').value = btn.dataset.nama;
            document.getElementById('kategori_id').value = btn.dataset.kategori;
            document.getElementById('lokasi_hilang').value = btn.dataset.lokasi;
            document.getElementById('tanggal_hilang').value = btn.dataset.tanggal;
            document.getElementById('deskripsi').value = btn.dataset.deskripsi;
            document.getElementById('foto_barang').value = '';

            const modal = document.getElementById('modal-laporan');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeLaporanModal() {
            const modal = document.getElementById('modal-laporan');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeLaporanModal();
            }
        });
    </script>
@endpush