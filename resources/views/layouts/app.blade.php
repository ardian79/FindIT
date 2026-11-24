<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-findit.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400..800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['DM Sans', 'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        heading: ['DM Sans', 'Inter', 'sans-serif']
                    },
                    colors: {
                        brand: { DEFAULT: '#c41230', dark: '#9b1028', soft: '#fdecee' },
                        ink: { DEFAULT: '#172033', navy: '#102a4c', deep: '#0a1c33', muted: '#5e6a7d' }
                    },
                    boxShadow: {
                        card: '0 10px 30px rgba(16, 42, 76, 0.06)',
                        lift: '0 18px 40px rgba(16, 42, 76, 0.12)'
                    }
                }
            }
        }
    </script>
    <style>
        [popover]::backdrop { overscroll-behavior: contain; }
        select:not([multiple]) {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%235e6a7d' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem 1rem;
            padding-right: 2.25rem;
            cursor: pointer;
        }
    </style>
</head>
<body id="top" class="flex min-h-screen flex-col overflow-x-hidden bg-[#f5f6f8] font-sans text-ink antialiased">
    <x-navbar />

    <main class="flex-1 pt-[68px]">
        <div class="mx-auto w-full max-w-[1160px] px-4 sm:px-6 lg:px-8">
            <x-alert />
        </div>
        @yield('content')
    </main>

    <x-footer />
</body>
</html>
