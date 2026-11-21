@extends(Auth::user()->role === 'petugas' ? 'layouts.dashboard' : 'layouts.app')

@section('title', 'Profil Saya - FindIT UNEJ')

@section('header', 'Profil Saya')

@section('content')
    <div class="{{ Auth::user()->role === 'mahasiswa' ? 'mx-auto max-w-3xl px-4 py-8 sm:px-6 lg:px-8' : 'mx-auto max-w-3xl' }}">
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-4 border-b border-slate-200 bg-slate-50/70 p-6 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-xl font-bold text-white">
                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">{{ $user->nama }}</h2>
                        <p class="text-sm text-slate-500">
                            {{ $user->role === 'mahasiswa' ? 'NIM: ' . $user->nim : $user->email }}
                        </p>
                    </div>
                </div>
                <span class="inline-flex w-fit items-center rounded-full px-3 py-1 text-xs font-semibold {{ $user->role === 'petugas' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ $user->role === 'petugas' ? 'Petugas Keamanan' : 'Mahasiswa' }}
                </span>
            </div>

            <form action="{{ route('profil.update') }}" method="POST" class="space-y-5 p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-slate-700">
                            {{ $user->role === 'mahasiswa' ? 'NIM' : 'Email' }}
                        </label>
                        <input type="text" value="{{ $user->role === 'mahasiswa' ? $user->nim : $user->email }}" disabled class="w-full cursor-not-allowed rounded-xl border border-slate-200 bg-slate-100 px-3.5 py-2.5 text-sm text-slate-500">
                    </div>

                    <div>
                        <label for="no_hp" class="mb-1.5 block text-sm font-medium text-slate-700">Nomor WhatsApp / HP</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                    </div>
                </div>

                <div>
                    <label for="nama" class="mb-1.5 block text-sm font-medium text-slate-700">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                </div>

                <div class="border-t border-slate-200 pt-5">
                    <h3 class="text-sm font-semibold text-slate-900">Ubah Password</h3>
                    <p class="mt-0.5 text-xs text-slate-500">Kosongkan kolom di bawah ini jika tidak ingin mengganti password.</p>

                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">Password Baru</label>
                            <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-slate-700">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru" class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-900 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection