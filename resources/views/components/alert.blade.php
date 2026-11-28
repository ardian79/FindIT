@if (session('success'))
    <div>
        <input type="checkbox" id="alert-dismiss-success" class="peer hidden" aria-hidden="true">
        <div
            class="mb-4 flex items-start justify-between gap-3 rounded-2xl border border-[#cddae9] bg-white px-4 py-3 text-sm text-ink-navy peer-checked:hidden print:hidden">
            <div class="flex items-start gap-3">
                <svg class="mt-0.5 h-4 w-4 shrink-0 text-ink-navy" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <label for="alert-dismiss-success" role="button" tabindex="0" aria-label="Tutup pemberitahuan"
                class="cursor-pointer rounded-lg p-1 text-ink-muted transition-colors duration-150 hover:bg-[#f3f5f8] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </label>
        </div>
    </div>
@endif

@if (session('error'))
    <div>
        <input type="checkbox" id="alert-dismiss-error" class="peer hidden" aria-hidden="true">
        <div
            class="mb-4 flex items-start justify-between gap-3 rounded-2xl border border-[#f3c7c3] bg-[#fff6f5] px-4 py-3 text-sm text-[#7a271a] peer-checked:hidden print:hidden">
            <div class="flex items-start gap-3">
                <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#b42318]" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
            <label for="alert-dismiss-error" role="button" tabindex="0" aria-label="Tutup pemberitahuan"
                class="cursor-pointer rounded-lg p-1 text-[#b42318] transition-colors duration-150 hover:bg-[#fde8e6] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand/30">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75"
                    aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </label>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 rounded-2xl border border-[#f3c7c3] bg-[#fff6f5] px-4 py-3 text-sm text-[#7a271a] print:hidden">
        <div class="mb-1 flex items-center gap-2 font-semibold">
            <svg class="h-4 w-4 shrink-0 text-[#b42318]" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="1.75" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <span>Periksa kembali isian berikut</span>
        </div>
        <ul class="ml-6 list-disc space-y-0.5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
