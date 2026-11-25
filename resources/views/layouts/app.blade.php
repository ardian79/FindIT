<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindIT</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-findit.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400..800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.4/dist/htmx.min.js"></script>
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
        /* ponytail: native base-select + scroll-driven animations + scroll-spy replaces JS */
        html, body { overflow-anchor: none; }
        @media (prefers-reduced-motion: no-preference) {
            html:has(a[href^="#"]:hover, a[href^="#"]:focus, a[href^="#"]:active) {
                scroll-behavior: smooth;
            }
            .fi-hero-in {
                animation: fi-fade-up 650ms cubic-bezier(.22, 1, .36, 1) both;
            }
            .fi-hero-in-1 { animation-delay: 60ms; }
            .fi-hero-in-2 { animation-delay: 160ms; }
            .fi-hero-in-3 { animation-delay: 260ms; }
        }
        @keyframes fi-fade-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (prefers-reduced-motion: no-preference) {
            @supports (animation-timeline: scroll()) {
                .fi-hero-bg {
                    will-change: transform;
                    animation: fi-hero-parallax linear both;
                    animation-timeline: scroll(root);
                    animation-range: 0px 100vh;
                }
            }
            @supports (animation-timeline: view()) {
                .fi-reveal {
                    animation: fi-reveal-up linear both;
                    animation-timeline: view();
                    animation-range: entry 0% cover 24%;
                }
                .fi-reveal-left {
                    animation: fi-reveal-from-left linear both;
                    animation-timeline: view();
                    animation-range: entry 0% cover 28%;
                }
                .fi-reveal-right {
                    animation: fi-reveal-from-right linear both;
                    animation-timeline: view();
                    animation-range: entry 0% cover 28%;
                }
                .fi-reveal-scale {
                    animation: fi-reveal-pop linear both;
                    animation-timeline: view();
                    animation-range: entry 0% cover 26%;
                }
                .fi-r1 { animation-range: entry 0% cover 22%; }
                .fi-r2 { animation-range: entry 6% cover 28%; }
                .fi-r3 { animation-range: entry 12% cover 34%; }
            }
        }
        @keyframes fi-hero-parallax {
            from { transform: translateY(0) scale(1); }
            to { transform: translateY(14%) scale(1.08); }
        }
        @keyframes fi-reveal-up {
            from { opacity: 0; transform: translateY(28px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fi-reveal-from-left {
            from { opacity: 0; transform: translateX(-32px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fi-reveal-from-right {
            from { opacity: 0; transform: translateX(32px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fi-reveal-pop {
            from { opacity: 0; transform: translateY(22px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        [popover]::backdrop { overscroll-behavior: contain; }
        @media (prefers-reduced-motion: no-preference) {
            .fi-detail-modal[popover] {
                opacity: 0;
                transform: translateY(100%);
                transition:
                    transform 280ms cubic-bezier(.22, 1, .36, 1),
                    opacity 220ms ease,
                    overlay 280ms allow-discrete,
                    display 280ms allow-discrete;
            }
            .fi-detail-modal[popover]:popover-open {
                opacity: 1;
                transform: translateY(0);
            }
            @starting-style {
                .fi-detail-modal[popover]:popover-open {
                    opacity: 0;
                    transform: translateY(100%);
                }
            }
            @media (min-width: 640px) {
                .fi-detail-modal[popover] {
                    transform: translateY(36px);
                }
                @starting-style {
                    .fi-detail-modal[popover]:popover-open {
                        transform: translateY(36px);
                    }
                }
            }
            .fi-detail-modal[popover]::backdrop {
                background-color: rgb(10 28 51 / 0);
                transition:
                    background-color 260ms ease,
                    overlay 280ms allow-discrete,
                    display 280ms allow-discrete;
            }
            .fi-detail-modal[popover]:popover-open::backdrop {
                background-color: rgb(10 28 51 / 0.6);
            }
            @starting-style {
                .fi-detail-modal[popover]:popover-open::backdrop {
                    background-color: rgb(10 28 51 / 0);
                }
            }
        }
        select:not([multiple]) {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%235e6a7d' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem 1rem;
            padding-right: 2.25rem;
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        @supports (appearance: base-select) {
            select:not([multiple]),
            select:not([multiple])::picker(select) {
                appearance: base-select;
            }
            select:not([multiple]) {
                display: inline-flex;
                align-items: center;
                justify-content: space-between;
                gap: 0.5rem;
                background-image: none;
                padding-right: 0.875rem;
            }
            select:not([multiple])::picker-icon {
                content: "";
                width: 1rem;
                height: 1rem;
                flex-shrink: 0;
                background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%235e6a7d' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") center / 1rem 1rem no-repeat;
                transition: transform 150ms ease;
            }
            select:not([multiple]):open::picker-icon {
                transform: rotate(180deg);
            }
            select:not([multiple])::picker(select) {
                margin-top: 0.5rem;
                padding: 0.375rem;
                border: 1px solid #e7ebf2;
                border-radius: 0.75rem;
                background-color: #ffffff;
                box-shadow: 0 18px 40px rgba(16, 42, 76, 0.12);
                max-height: 15rem;
                min-width: anchor-size(width);
            }
            select:not([multiple]) option {
                display: flex;
                align-items: center;
                min-height: 2.25rem;
                padding: 0.5rem 0.75rem;
                border-radius: 0.5rem;
                font-size: 0.875rem;
                color: #172033;
                background-color: #ffffff;
                cursor: pointer;
                transition: background-color 150ms ease, color 150ms ease;
            }
            select:not([multiple]) option:hover,
            select:not([multiple]) option:focus {
                background-color: #f3f5f8;
                color: #102a4c;
            }
            select:not([multiple]) option:checked {
                background-color: #fdecee;
                color: #9b1028;
                font-weight: 500;
            }
            select:not([multiple]) option::checkmark {
                display: none;
            }
        }
        .fi-nav-wrap {
            contain: layout style;
        }
        #nav-mobile-toggle:checked ~ .fi-nav-bar #mobile-menu {
            visibility: visible;
            opacity: 1;
            pointer-events: auto;
        }
        @supports (animation-timeline: scroll()) {
            .fi-nav-bar {
                will-change: transform;
                animation: fi-nav-bar-scroll linear both;
                animation-timeline: scroll(root);
                animation-range: 0px 80px;
            }
        }
        @keyframes fi-nav-bar-scroll {
            from {
                max-width: 100%;
                transform: translateY(0);
                border-radius: 0px;
                background-color: #ffffff;
                box-shadow: 0 0 0 rgba(16, 42, 76, 0);
            }
            to {
                max-width: min(1160px, calc(100% - 2rem));
                transform: translateY(0.75rem);
                border-radius: 36px;
                background-color: rgba(255, 255, 255, 0.95);
                box-shadow: 0 10px 30px rgba(16, 42, 76, 0.06);
            }
        }
        @supports (scroll-target-group: auto) {
            .fi-nav-links {
                scroll-target-group: auto;
            }
            .fi-nav-links a:target-current {
                background-color: #fdecee;
                color: #c41230;
                font-weight: 600;
            }
        }
        @supports not (scroll-target-group: auto) {
            body:has(#cara-kerja:target) .fi-nav-links a[href="#cara-kerja"],
            body:has(#lokasi:target) .fi-nav-links a[href="#lokasi"],
            body:has(#katalog:target) .fi-nav-links a[href="#katalog"],
            body:not(:has(#cara-kerja:target, #lokasi:target, #katalog:target)) .fi-nav-links a[href="#beranda"] {
                background-color: #fdecee;
                color: #c41230;
                font-weight: 600;
            }
        }
    </style>
</head>
<body id="top" class="flex min-h-screen flex-col overflow-x-clip bg-[#f5f6f8] font-sans text-ink antialiased">
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
