@extends(Auth::user()->role === 'petugas' ? 'layouts.dashboard' : 'layouts.app')

@section('title', 'Profil Saya - FindIT UNEJ')
@section('header', 'Profil Saya')

@section('content')
    @php
        $isPetugas = $user->role === 'petugas';
        $label = 'mb-1.5 block text-sm font-medium text-ink';
        $input = 'w-full rounded-xl border border-[#d7dde7] bg-white px-3.5 py-2.5 text-sm text-ink outline-none transition-colors duration-150 focus:border-ink-navy focus:ring-4 focus:ring-ink-navy/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585]';
    @endphp

    <div class="{{ $isPetugas ? 'mx-auto max-w-3xl' : 'mx-auto w-full max-w-[1160px] px-4 py-8 sm:px-6 lg:px-8' }}">
        <div class="overflow-hidden rounded-2xl border border-[#e7ebf2] bg-white">
            <div class="flex flex-col gap-4 border-b border-[#e7ebf2] bg-[#f7f8fb] p-6 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-brand text-lg font-semibold text-white">
                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-ink">{{ $user->nama }}</h2>
                        <p class="text-sm tabular-nums text-ink-muted">{{ $isPetugas ? $user->email : 'NIM: ' . $user->nim }}</p>
                    </div>
                </div>
                <span class="inline-flex w-fit items-center rounded-lg px-2.5 py-1 text-xs font-medium {{ $isPetugas ? 'bg-brand-soft text-brand-dark' : 'bg-[#e8eef6] text-ink-navy' }}">
                    {{ $isPetugas ? 'Petugas Keamanan' : 'Mahasiswa' }}
                </span>
            </div>

            <form action="{{ route('profil.update') }}" method="POST" class="space-y-5 p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="{{ $label }}">{{ $isPetugas ? 'Email' : 'NIM' }}</label>
                        <input type="text" value="{{ $isPetugas ? $user->email : $user->nim }}" disabled class="{{ $input }} tabular-nums">
                    </div>
                    <div>
                        <label for="no_hp" class="{{ $label }}">Nomor WhatsApp / HP</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required class="{{ $input }} tabular-nums">
                    </div>
                </div>

                <div>
                    <label for="nama" class="{{ $label }}">Nama lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required class="{{ $input }}">
                </div>

                <div class="border-t border-[#e7ebf2] pt-5">
                    <h3 class="text-sm font-semibold text-ink">Ubah password</h3>
                    <p class="mt-0.5 text-xs text-ink-muted">Kosongkan kolom di bawah ini jika tidak ingin mengganti password.</p>
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="password" class="{{ $label }}">Password baru</label>
                            <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" class="{{ $input }}">
                        </div>
                        <div>
                            <label for="password_confirmation" class="{{ $label }}">Konfirmasi password baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru" class="{{ $input }}">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-brand px-5 py-2.5 text-sm font-medium text-white transition-colors duration-150 hover:bg-brand-dark focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand focus-visible:ring-offset-2 active:scale-[0.98]">
                        Simpan perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
