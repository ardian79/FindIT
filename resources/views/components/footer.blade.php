<footer class="mt-16 bg-white border-t border-[#e7ebf2] print:hidden">
    <div class="mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8 py-10 flex flex-col items-center justify-center text-center">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
            @if (is_file(public_path('images/logo-findit.svg')))
                <img src="{{ asset('images/logo-findit.svg') }}" alt="Logo FindIT" class="h-9 w-auto object-contain">
            @endif
            <span class="text-xl font-extrabold tracking-tight text-ink">Find<span class="text-brand">IT</span></span>
        </a>
        
        <p class="mt-4 max-w-md text-sm leading-6 text-ink-muted">
            Sistem Informasi Barang Hilang dan Temuan Universitas Jember.
        </p>
    </div>
</footer>