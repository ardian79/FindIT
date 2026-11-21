@extends('layouts.dashboard')

@section('title', 'Rekap Laporan Operasional')

@section('header', 'Rekap & Cetak Laporan')

@section('content')
    @php
        $judulLaporan = match ($jenis) {
            'laporan_kehilangan' => 'Laporan Data Kehilangan Barang',
            'klaim' => 'Laporan Data Verifikasi & Serah Terima Klaim',
            default => 'Laporan Data Barang Temuan',
        };
    @endphp

    <div class="space-y-6">
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-5 print:hidden">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-medium text-slate-500">Total Temuan</p>
                <p class="mt-1 text-2xl font-bold text-slate-900">{{ $ringkasan['total_temuan'] }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-medium text-slate-500">Temuan Tersedia</p>
                <p class="mt-1 text-2xl font-bold text-emerald-600">{{ $ringkasan['total_tersedia'] }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-medium text-slate-500">Dikembalikan</p>
                <p class="mt-1 text-2xl font-bold text-teal-600">{{ $ringkasan['total_dikembalikan'] }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-medium text-slate-500">Total Kehilangan</p>
                <p class="mt-1 text-2xl font-bold text-amber-600">{{ $ringkasan['total_hilang'] }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-medium text-slate-500">Klaim Selesai</p>
                <p class="mt-1 text-2xl font-bold text-blue-600">{{ $ringkasan['total_klaim_selesai'] }}</p>
            </div>
        </div>

        <form action="{{ route('petugas.laporan.index') }}" method="GET" class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm print:hidden">
            <div class="grid grid-cols-1 gap-3 md:grid-cols-12">
                <div class="md:col-span-3">
                    <label for="jenis" class="mb-1 block text-xs font-medium text-slate-600">Jenis Laporan</label>
                    <select id="jenis" name="jenis" onchange="updateStatusOptions()" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-800 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                        <option value="barang_temuan" {{ $jenis === 'barang_temuan' ? 'selected' : '' }}>Barang Temuan</option>
                        <option value="laporan_kehilangan" {{ $jenis === 'laporan_kehilangan' ? 'selected' : '' }}>Laporan Kehilangan</option>
                        <option value="klaim" {{ $jenis === 'klaim' ? 'selected' : '' }}>Verifikasi Klaim</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="tanggal_mulai" class="mb-1 block text-xs font-medium text-slate-600">Dari Tanggal</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ $tanggalMulai }}" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm text-slate-800 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <div class="md:col-span-2">
                    <label for="tanggal_selesai" class="mb-1 block text-xs font-medium text-slate-600">Sampai Tanggal</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ $tanggalSelesai }}" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm text-slate-800 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <div class="md:col-span-2">
                    <label for="status" class="mb-1 block text-xs font-medium text-slate-600">Status</label>
                    <select id="status" name="status" class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm text-slate-800 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                        <option value="">Semua Status</option>
                    </select>
                </div>

                <div class="flex items-end gap-2 md:col-span-3">
                    <button type="submit" class="flex-1 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-700">
                        Tampilkan
                    </button>
                    <button type="button" onclick="window.print()" class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                        </svg>
                        Cetak
                    </button>
                </div>
            </div>
        </form>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm print:rounded-none print:border-0 print:shadow-none">
            <div class="border-b border-slate-200 px-6 py-5 print:border-b-2 print:border-slate-900 print:px-0">
                <div class="flex flex-col justify-between gap-2 sm:flex-row sm:items-end">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-emerald-700 print:text-slate-700">FindIT · Pos Keamanan Utama Universitas Jember</p>
                        <h2 class="mt-1 text-lg font-bold text-slate-900">{{ $judulLaporan }}</h2>
                        <p class="mt-0.5 text-xs text-slate-500">
                            Periode: {{ $tanggalMulai ? \Carbon\Carbon::parse($tanggalMulai)->format('d M Y') : 'Awal' }} s/d {{ $tanggalSelesai ? \Carbon\Carbon::parse($tanggalSelesai)->format('d M Y') : 'Sekarang' }}
                            @if ($status)
                                · Status: {{ ucfirst($status) }}
                            @endif
                        </p>
                    </div>
                    <p class="text-xs text-slate-500">Dicetak: {{ now()->format('d M Y, H:i') }} WIB · Total: {{ $data->count() }} data</p>
                </div>
            </div>

            @if ($data->isEmpty())
                <div class="px-6 py-14 text-center text-sm text-slate-500">
                    Tidak ada data pada filter yang dipilih.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                        <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500 print:bg-slate-100">
                            @if ($jenis === 'barang_temuan')
                                <tr>
                                    <th class="w-12 px-4 py-3">No</th>
                                    <th class="px-4 py-3">Nama Barang</th>
                                    <th class="px-4 py-3">Kategori</th>
                                    <th class="px-4 py-3">Lokasi Ditemukan</th>
                                    <th class="px-4 py-3">Tanggal</th>
                                    <th class="px-4 py-3">Status</th>
                                </tr>
                            @elseif ($jenis === 'laporan_kehilangan')
                                <tr>
                                    <th class="w-12 px-4 py-3">No</th>
                                    <th class="px-4 py-3">Nama Barang</th>
                                    <th class="px-4 py-3">Kategori</th>
                                    <th class="px-4 py-3">Pelapor</th>
                                    <th class="px-4 py-3">Lokasi & Tanggal Hilang</th>
                                    <th class="px-4 py-3">Status</th>
                                </tr>
                            @else
                                <tr>
                                    <th class="w-12 px-4 py-3">No</th>
                                    <th class="px-4 py-3">Barang Temuan</th>
                                    <th class="px-4 py-3">Pengklaim</th>
                                    <th class="px-4 py-3">Tanggal Klaim</th>
                                    <th class="px-4 py-3">Tanggal Diambil</th>
                                    <th class="px-4 py-3">Status</th>
                                </tr>
                            @endif
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach ($data as $index => $item)
                                <tr>
                                    <td class="px-4 py-3 text-slate-500">{{ $index + 1 }}</td>

                                    @if ($jenis === 'barang_temuan')
                                        <td class="px-4 py-3 font-medium text-slate-900">{{ $item->nama_barang }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $item->kategori->nama_kategori }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $item->lokasi_ditemukan }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $item->tanggal_ditemukan->format('d M Y') }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-800">{{ ucfirst($item->status) }}</td>
                                    @elseif ($jenis === 'laporan_kehilangan')
                                        <td class="px-4 py-3 font-medium text-slate-900">{{ $item->nama_barang }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $item->kategori->nama_kategori }}</td>
                                        <td class="px-4 py-3 text-slate-600">
                                            <p class="font-medium text-slate-800">{{ $item->pengguna->nama }}</p>
                                            <p class="text-xs text-slate-500">{{ $item->pengguna->nim }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-slate-600">
                                            <p>{{ $item->lokasi_hilang }}</p>
                                            <p class="text-xs text-slate-500">{{ $item->tanggal_hilang->format('d M Y') }}</p>
                                        </td>
                                        <td class="px-4 py-3 font-semibold text-slate-800">{{ ucfirst($item->status) }}</td>
                                    @else
                                        <td class="px-4 py-3">
                                            <p class="font-medium text-slate-900">{{ $item->barangTemuan->nama_barang }}</p>
                                            <p class="text-xs text-slate-500">{{ $item->barangTemuan->kategori->nama_kategori }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-slate-600">
                                            <p class="font-medium text-slate-800">{{ $item->pengguna->nama }}</p>
                                            <p class="text-xs text-slate-500">{{ $item->pengguna->nim }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-slate-600">{{ $item->created_at->format('d M Y') }}</td>
                                        <td class="px-4 py-3 text-slate-600">{{ $item->tanggal_diambil ? $item->tanggal_diambil->format('d M Y, H:i') : '-' }}</td>
                                        <td class="px-4 py-3 font-semibold text-slate-800">{{ ucfirst($item->status) }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="hidden justify-end pt-10 print:flex">
                <div class="text-center text-xs text-slate-700">
                    <p>Jember, {{ now()->format('d M Y') }}</p>
                    <p class="mt-1">Petugas Pos Keamanan Utama UNEJ</p>
                    <div class="h-16"></div>
                    <p class="font-bold underline">{{ Auth::user()->nama }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const statusMap = {
            barang_temuan: [
                { value: 'tersedia', label: 'Tersedia' },
                { value: 'diklaim', label: 'Diklaim' },
                { value: 'dikembalikan', label: 'Dikembalikan' }
            ],
            laporan_kehilangan: [
                { value: 'dicari', label: 'Dicari' },
                { value: 'ditemukan', label: 'Ditemukan' }
            ],
            klaim: [
                { value: 'pending', label: 'Pending' },
                { value: 'disetujui', label: 'Disetujui' },
                { value: 'selesai', label: 'Selesai' },
                { value: 'ditolak', label: 'Ditolak' }
            ]
        };

        const currentStatus = "{{ $status ?? '' }}";

        function updateStatusOptions(preserveSelected = false) {
            const jenis = document.getElementById('jenis').value;
            const statusSelect = document.getElementById('status');
            const options = statusMap[jenis] || [];

            statusSelect.innerHTML = '<option value="">Semua Status</option>';

            options.forEach(opt => {
                const optionEl = document.createElement('option');
                optionEl.value = opt.value;
                optionEl.textContent = opt.label;
                if (preserveSelected && opt.value === currentStatus) {
                    optionEl.selected = true;
                }
                statusSelect.appendChild(optionEl);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateStatusOptions(true);
        });
    </script>
@endpush