@php
    $flashes = [
        'success' => [
            'box' => 'border-[#cddae9] bg-white text-ink-navy',
            'icon' => 'text-ink-navy',
            'close' => 'text-ink-muted hover:bg-[#f3f5f8] focus-visible:ring-ink-navy/30',
            'path' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        ],
        'error' => [
            'box' => 'border-[#f3c7c3] bg-[#fff6f5] text-[#7a271a]',
            'icon' => 'text-[#b42318]',
            'close' => 'text-[#b42318] hover:bg-[#fde8e6] focus-visible:ring-brand/30',
            'path' => 'M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z',
        ],
    ];
@endphp

@foreach ($flashes as $key => $cfg)
    @if (session($key))
        <div x-data="{ show: true }" x-show="show" x-cloak x-transition.opacity.duration.150ms
            class="mb-4 flex items-start justify-between gap-3 rounded-2xl border px-4 py-3 text-sm print:hidden {{ $cfg['box'] }}">
            <div class="flex items-start gap-3">
                <svg class="mt-0.5 h-4 w-4 shrink-0 {{ $cfg['icon'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $cfg['path'] }}" />
                </svg>
                <span>{{ session($key) }}</span>
            </div>
            <button type="button" @click="show = false" aria-label="Tutup pemberitahuan"
                class="rounded-lg p-1 transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 {{ $cfg['close'] }}">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif
@endforeach

@if ($errors->any())
    <div class="mb-4 rounded-2xl border border-[#f3c7c3] bg-[#fff6f5] px-4 py-3 text-sm text-[#7a271a] print:hidden">
        <div class="mb-1 flex items-center gap-2 font-semibold">
            <svg class="h-4 w-4 shrink-0 text-[#b42318]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
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
