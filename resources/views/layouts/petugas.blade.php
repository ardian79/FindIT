<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-findit.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400..800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen overflow-x-clip bg-[#f3f5f8] font-sans text-ink antialiased">
    {{-- ponytail: checkbox peer toggle replaces toggleSidebar() JS --}}
    <input type="checkbox" id="sidebar-toggle" class="peer hidden" aria-hidden="true">
    <x-sidebar />

    <div class="flex min-h-screen flex-col lg:pl-[248px] print:pl-0">
        <div class="sticky top-0 z-30 px-4 pt-4 sm:px-6 lg:px-8 print:hidden">
            <header
                class="mx-auto flex h-16 w-full items-center justify-between rounded-2xl border border-[#e7ebf2] bg-white/95 px-4 shadow-card sm:px-5 lg:px-6">
                <div class="flex min-w-0 items-center gap-3">
                    <label for="sidebar-toggle" role="button" tabindex="0" aria-label="Buka sidebar"
                        class="flex h-10 w-10 shrink-0 cursor-pointer items-center justify-center rounded-xl text-ink-muted transition-colors duration-150 hover:bg-[#f3f5f8] hover:text-ink focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ink-navy/30 lg:hidden">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.75" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </label>
                    <div class="min-w-0">
                        <p class="text-xs font-medium text-ink-muted">Panel Petugas</p>
                        <h1 class="truncate text-base font-semibold text-ink sm:text-lg">@yield('header', 'Dashboard')</h1>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden text-right sm:block">
                        <p class="max-w-[180px] truncate text-sm font-medium text-ink">{{ Auth::user()->nama }}</p>
                        <p class="text-xs text-ink-muted">Petugas Keamanan</p>
                    </div>
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-brand text-xs font-semibold text-white">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                    </div>
                </div>
            </header>
        </div>

        <main class="flex-1 p-4 sm:p-6 lg:p-8 print:p-0">
            <x-alert />
            @yield('content')
        </main>
    </div>
</body>

</html>