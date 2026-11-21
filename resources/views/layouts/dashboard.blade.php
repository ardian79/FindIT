<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Petugas') - FindIT UNEJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    <x-sidebar />

    <div class="flex min-h-screen flex-col lg:pl-64 print:pl-0">
        <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200 bg-white px-4 sm:px-6 lg:px-8 print:hidden">
            <div class="flex items-center gap-3">
                <button type="button" onclick="toggleSidebar()" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100 lg:hidden">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <h1 class="text-lg font-semibold text-slate-900">@yield('header', 'Dashboard')</h1>
            </div>

            <div class="flex items-center gap-2.5">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-medium text-slate-900">{{ Auth::user()->nama }}</p>
                    <p class="text-xs text-slate-500">Petugas Keamanan</p>
                </div>
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-sm font-bold text-emerald-700">
                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                </div>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6 lg:p-8 print:p-0">
            <x-alert />
            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }
    </script>

    @stack('scripts')
</body>
</html>