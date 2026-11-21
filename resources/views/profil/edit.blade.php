@extends(Auth::user()->role === 'petugas' ? 'layouts.dashboard' : 'layouts.app')

@section('title', 'Profil Saya - FindIT UNEJ')

@section('header', 'Profil Saya')

@section('content')
    <div class="{{ Auth::user()->role === 'mahasiswa' ? 'mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8 py-8' : 'mx-auto max-w-3xl' }}">
        <div class="rounded-[24px] border border-[#e7ebf2]/95 bg-white shadow-[0_10px_30px_rgba(16,42,76,.05)] overflow-hidden">
            <div class="flex flex-col gap-4 border-b border-[#e7ebf2] bg-[#f7f8fb] p-6 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-brand text-xl font-extrabold text-white">
                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-lg font-extrabold text-ink">{{ $user->nama }}</h2>
                        <p class="text-sm text-ink-muted">{{ $user->role === 'mahasiswa' ? 'NIM: ' . $user->nim : $user->email }}</p>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1.5 whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-bold leading-[1.3] {{ $user->role === 'petugas' ? 'bg-[#fdecee] text-[#9b1028]' : 'bg-[#e8eef6] text-[#102a4c]' }}">
                    {{ $user->role === 'petugas' ? 'Petugas Keamanan' : 'Mahasiswa' }}
                </span>
            </div>

            <form action="{{ route('profil.update') }}" method="POST" class="space-y-5 p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="mb-1.5 block text-[13px] font-semibold text-[#243044]">{{ $user->role === 'mahasiswa' ? 'NIM' : 'Email' }}</label>
                        <input type="text" value="{{ $user->role === 'mahasiswa' ? $user->nim : $user->email }}" disabled class="w-full rounded-[14px] border border-[#d7dde7] bg-white px-3.5 py-3 text-sm leading-[1.4] text-[#172033] outline-none transition-[border-color,box-shadow] duration-160 focus:border-[#102a4c] focus:ring-4 focus:ring-[#102a4c]/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585]">
                    </div>
                    <div>
                        <label for="no_hp" class="mb-1.5 block text-[13px] font-semibold text-[#243044]">Nomor WhatsApp / HP</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required class="w-full rounded-[14px] border border-[#d7dde7] bg-white px-3.5 py-3 text-sm leading-[1.4] text-[#172033] outline-none transition-[border-color,box-shadow] duration-160 focus:border-[#102a4c] focus:ring-4 focus:ring-[#102a4c]/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585]">
                    </div>
                </div>

                <div>
                    <label for="nama" class="mb-1.5 block text-[13px] font-semibold text-[#243044]">Nama lengkap</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required class="w-full rounded-[14px] border border-[#d7dde7] bg-white px-3.5 py-3 text-sm leading-[1.4] text-[#172033] outline-none transition-[border-color,box-shadow] duration-160 focus:border-[#102a4c] focus:ring-4 focus:ring-[#102a4c]/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585]">
                </div>

                <div class="border-t border-[#e7ebf2] pt-5">
                    <h3 class="text-sm font-extrabold text-ink">Ubah password</h3>
                    <p class="mt-0.5 text-xs text-ink-muted">Kosongkan kolom di bawah ini jika tidak ingin mengganti password.</p>
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label for="password" class="mb-1.5 block text-[13px] font-semibold text-[#243044]">Password baru</label>
                            <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" class="w-full rounded-[14px] border border-[#d7dde7] bg-white px-3.5 py-3 text-sm leading-[1.4] text-[#172033] outline-none transition-[border-color,box-shadow] duration-160 focus:border-[#102a4c] focus:ring-4 focus:ring-[#102a4c]/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585]">
                        </div>
                        <div>
                            <label for="password_confirmation" class="mb-1.5 block text-[13px] font-semibold text-[#243044]">Konfirmasi password baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru" class="w-full rounded-[14px] border border-[#d7dde7] bg-white px-3.5 py-3 text-sm leading-[1.4] text-[#172033] outline-none transition-[border-color,box-shadow] duration-160 focus:border-[#102a4c] focus:ring-4 focus:ring-[#102a4c]/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585]">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-full border border-transparent bg-[#c41230] px-5 py-3 text-sm font-bold leading-[1.2] text-white shadow-[0_6px_14px_rgba(196,18,48,.14)] transition-all duration-200 ease-out hover:-translate-y-px hover:bg-[#9b1028] active:translate-y-0 active:scale-[.98]">Simpan perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
