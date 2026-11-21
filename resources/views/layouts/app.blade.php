<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FindIT - Lost & Found UNEJ')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen flex-col bg-slate-50 text-slate-800 antialiased">
    <x-navbar />

    <main class="flex-1">
        <div class="mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">
            <x-alert />
        </div>
        @yield('content')
    </main>

    <footer class="mt-16 border-t border-slate-200 bg-white print:hidden">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-4 py-6 text-center text-sm text-slate-500 sm:flex-row sm:px-6 lg:px-8">
            <p class="font-medium text-slate-700">FindIT — Layanan Lost & Found Universitas Jember</p>
            <p>Lokasi Penyimpanan & Pengambilan: Pos Keamanan Utama UNEJ</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>