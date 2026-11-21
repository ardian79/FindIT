<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Petugas') - FindIT UNEJ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Plus Jakarta Sans', 'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    heading: ['Plus Jakarta Sans', 'Inter', 'sans-serif']
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


</head>
<body class="min-h-screen overflow-x-hidden bg-[#f3f5f8] font-[Plus_Jakarta_Sans,Inter,ui-sans-serif,system-ui,sans-serif] text-[#172033] antialiased">
    <x-sidebar />

    <div class="flex min-h-screen flex-col lg:pl-[248px] print:pl-0">
        <div x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 8, { passive: true })" class="sticky top-0 z-30 px-3 pt-3 sm:px-4 sm:pt-4 print:hidden">
            <header
                :class="scrolled
                    ? 'translate-y-0 border-[#dfe5ec] bg-white/95 shadow-[0_10px_28px_rgba(16,42,76,.10)]'
                    : 'translate-y-0 border-[#e7ebf2] bg-white/90 shadow-[0_4px_14px_rgba(16,42,76,.05)]'"
                class="mx-auto flex h-16 w-full items-center justify-between rounded-full border px-4 backdrop-blur-md transition-[background-color,border-color,box-shadow,transform] duration-300 ease-out sm:px-5 lg:px-6"
            >
                <div class="flex min-w-0 items-center gap-3">
                    <button type="button" onclick="toggleSidebar()" aria-label="Buka sidebar" class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full text-[#5e6a7d] transition-colors duration-200 hover:bg-[#f3f5f8] hover:text-[#172033] active:scale-[0.96] lg:hidden">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <div class="min-w-0">
                        <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-[#5e6a7d]">Panel Petugas</p>
                        <h1 class="truncate text-base font-extrabold text-[#172033] sm:text-lg">@yield('header', 'Dashboard')</h1>
                    </div>
                </div>

                <div class="group/profile flex cursor-default items-center gap-2 rounded-full px-1 py-1 transition-colors duration-200 hover:bg-[#f7f8fb] sm:gap-3 sm:px-2">
                    <div class="hidden text-right sm:block">
                        <p class="max-w-[180px] truncate text-sm font-bold text-[#172033]">{{ Auth::user()->nama }}</p>
                        <p class="text-xs text-[#5e6a7d]">Petugas Keamanan</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#c41230] text-sm font-extrabold text-white shadow-[0_6px_14px_rgba(196,18,48,.18)] transition-[transform,box-shadow] duration-200 ease-out group-hover/profile:scale-[1.08] group-hover/profile:shadow-[0_8px_18px_rgba(196,18,48,.24)]">
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

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }
    </script>

    @stack('scripts')

    <script>
        window.finditHydrateSelects = function () {
            document.querySelectorAll('select:not([multiple]):not([data-fi-select-ready])').forEach(function (select) {
                select.dataset.fiSelectReady = 'true';
                const wrapper = document.createElement('div');
                wrapper.setAttribute('data-fi-select', '');
                const sizeClasses = Array.from(select.classList)
                    .filter(function (name) { return /^(w-|sm:w-|md:w-|lg:w-|xl:w-|max-w-|sm:max-w-|md:max-w-|lg:max-w-|xl:max-w-)/.test(name); })
                    .join(' ');
                wrapper.className = `relative w-full min-w-0 ${sizeClasses}`;

                select.parentNode.insertBefore(wrapper, select);
                wrapper.appendChild(select);
                select.className = 'absolute h-px w-px opacity-0 pointer-events-none';

                const trigger = document.createElement('button');
                trigger.type = 'button';
                trigger.className = 'relative flex min-h-[42px] w-full items-center justify-between gap-3 rounded-[14px] border border-[#d7dde7] bg-white px-3.5 py-2.5 pr-10 text-left text-sm text-[#172033] outline-none transition-[border-color,box-shadow,background-color] duration-160 hover:border-[#b7c1d0] focus:border-[#c41230] focus:ring-4 focus:ring-[#c41230]/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585] disabled:opacity-80';
                trigger.setAttribute('aria-haspopup', 'listbox');
                trigger.setAttribute('aria-expanded', 'false');
                trigger.disabled = select.disabled;

                const label = document.createElement('span');
                const arrow = document.createElement('span');
                arrow.className = 'absolute right-3.5 top-1/2 h-4 w-4 -translate-y-1/2 transition-transform duration-180';
                arrow.innerHTML = '<svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="#102a4c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>';

                const menu = document.createElement('div');
                menu.setAttribute('data-fi-select-menu', '');
                menu.setAttribute('role', 'listbox');
                menu.className = 'invisible pointer-events-none absolute left-0 top-[calc(100%+8px)] z-[60] max-h-60 w-full scale-[.985] overflow-y-auto rounded-[14px] border border-[#dfe4ec] bg-white p-1.5 opacity-0 shadow-[0_14px_34px_rgba(16,42,76,.14)] transition-[opacity,transform,visibility] duration-160 ease-out';

                function refreshOptions() {
                    menu.innerHTML = '';
                    Array.from(select.options).forEach(function (option) {
                        if (option.disabled) return;
                        const item = document.createElement('button');
                        item.type = 'button';
                        item.setAttribute('role', 'option');
                        item.setAttribute('aria-selected', option.selected ? 'true' : 'false');
                        item.dataset.value = option.value;
                        item.className = 'flex min-h-10 w-full items-center rounded-[10px] border-0 bg-white px-3 py-2 text-left text-sm text-[#172033] transition-colors duration-140 hover:bg-[#f3f5f8] hover:text-[#102a4c]';
                        item.textContent = option.text;
                        if (option.selected) {
                            item.className += ' bg-[#fdecee] font-bold text-[#9b1028]';
                        }
                        item.addEventListener('click', function () {
                            select.value = option.value;
                            select.dispatchEvent(new Event('input', { bubbles: true }));
                            select.dispatchEvent(new Event('change', { bubbles: true }));
                            refreshOptions();
                            closeMenu();
                            trigger.focus();
                        });
                        menu.appendChild(item);
                    });
                    label.textContent = select.options[select.selectedIndex]?.text || 'Pilih opsi';
                }

                function openMenu() {
                    if (select.disabled) return;
                    document.querySelectorAll('[data-fi-select][data-open="true"]').forEach(function (open) {
                        if (open !== wrapper) {
                            open.removeAttribute('data-open');
                            const openMenuElement = open.querySelector('[data-fi-select-menu]');
                            openMenuElement?.classList.add('invisible', 'pointer-events-none', 'opacity-0', 'scale-[.985]');
                            openMenuElement?.classList.remove('visible', 'pointer-events-auto', 'opacity-100', 'scale-100');
                        }
                    });
                    wrapper.dataset.open = 'true';
                    menu.classList.remove('invisible', 'pointer-events-none', 'opacity-0', 'scale-[.985]');
                    menu.classList.add('visible', 'pointer-events-auto', 'opacity-100', 'scale-100');
                    trigger.setAttribute('aria-expanded', 'true');
                    arrow.classList.add('rotate-180');
                }

                function closeMenu() {
                    wrapper.removeAttribute('data-open');
                    menu.classList.add('invisible', 'pointer-events-none', 'opacity-0', 'scale-[.985]');
                    menu.classList.remove('visible', 'pointer-events-auto', 'opacity-100', 'scale-100');
                    trigger.setAttribute('aria-expanded', 'false');
                    arrow.classList.remove('rotate-180');
                }

                trigger.addEventListener('click', function () {
                    wrapper.dataset.open === 'true' ? closeMenu() : openMenu();
                });
                trigger.addEventListener('keydown', function (event) {
                    if (event.key === 'ArrowDown' || event.key === 'ArrowUp') {
                        event.preventDefault();
                        openMenu();
                        menu.querySelector('[role="option"]')?.focus();
                    }
                });

                trigger.appendChild(label);
                trigger.appendChild(arrow);
                wrapper.appendChild(trigger);
                wrapper.appendChild(menu);
                refreshOptions();

                select.addEventListener('change', refreshOptions);
                new MutationObserver(refreshOptions).observe(select, { childList: true, attributes: true, subtree: true });
            });
        };

        document.addEventListener('click', function (event) {
            if (!event.target.closest('[data-fi-select]')) {
                document.querySelectorAll('[data-fi-select][data-open="true"]').forEach(function (open) {
                    const menu = open.querySelector('[data-fi-select-menu]');
                    menu?.classList.add('invisible', 'pointer-events-none', 'opacity-0', 'scale-[.985]');
                    menu?.classList.remove('visible', 'pointer-events-auto', 'opacity-100', 'scale-100');
                    open.removeAttribute('data-open');
                    open.querySelector('button[aria-haspopup="listbox"]')?.setAttribute('aria-expanded', 'false');
                });
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('[data-fi-select][data-open="true"]').forEach(function (open) {
                    const menu = open.querySelector('[data-fi-select-menu]');
                    menu?.classList.add('invisible', 'pointer-events-none', 'opacity-0', 'scale-[.985]');
                    menu?.classList.remove('visible', 'pointer-events-auto', 'opacity-100', 'scale-100');
                    open.removeAttribute('data-open');
                    open.querySelector('button[aria-haspopup="listbox"]')?.setAttribute('aria-expanded', 'false');
                    open.querySelector('button[aria-haspopup="listbox"]')?.focus();
                });
            }
        });

        document.addEventListener('DOMContentLoaded', window.finditHydrateSelects);
        new MutationObserver(function () { window.finditHydrateSelects(); }).observe(document.documentElement, { childList: true, subtree: true });
    </script>
</body>
</html>
