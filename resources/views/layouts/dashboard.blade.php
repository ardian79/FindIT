<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Petugas') - FindIT UNEJ</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-findit.svg') }}">
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
<body class="min-h-screen overflow-x-hidden bg-[#f3f5f8] font-sans text-ink antialiased">
    <x-sidebar />

    <div class="flex min-h-screen flex-col lg:pl-[248px] print:pl-0">
        <div x-data="{ scrolled: false }" x-init="addEventListener('scroll', () => scrolled = scrollY > 8, { passive: true })"
            class="sticky top-0 z-30 px-3 pt-3 sm:px-4 sm:pt-4 print:hidden">
            <header
                :class="scrolled ? 'border-[#dfe5ec] bg-white/95 shadow-[0_10px_28px_rgba(16,42,76,.10)]' : 'border-[#e7ebf2] bg-white/90 shadow-[0_4px_14px_rgba(16,42,76,.05)]'"
                class="mx-auto flex h-16 w-full items-center justify-between rounded-full border px-4 backdrop-blur-md transition duration-300 ease-out sm:px-5 lg:px-6">
                <div class="flex min-w-0 items-center gap-3">
                    <button type="button" onclick="toggleSidebar()" aria-label="Buka sidebar"
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full text-ink-muted transition hover:bg-[#f3f5f8] hover:text-ink active:scale-95 lg:hidden">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <div class="min-w-0">
                        <p class="text-[11px] font-bold uppercase tracking-[0.14em] text-ink-muted">Panel Petugas</p>
                        <h1 class="truncate text-base font-extrabold text-ink sm:text-lg">@yield('header', 'Dashboard')</h1>
                    </div>
                </div>

                <div class="group/profile flex cursor-default items-center gap-2 rounded-full px-1 py-1 transition hover:bg-[#f7f8fb] sm:gap-3 sm:px-2">
                    <div class="hidden text-right sm:block">
                        <p class="max-w-[180px] truncate text-sm font-bold text-ink">{{ Auth::user()->nama }}</p>
                        <p class="text-xs text-ink-muted">Petugas Keamanan</p>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-brand text-sm font-extrabold text-white shadow-[0_6px_14px_rgba(196,18,48,.18)] transition group-hover/profile:scale-[1.08] group-hover/profile:shadow-[0_8px_18px_rgba(196,18,48,.24)]">
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
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebar-backdrop').classList.toggle('hidden');
        }
    </script>

    @stack('scripts')

    <script>
        (() => {
            const closedCls = ['invisible', 'pointer-events-none', 'opacity-0', 'scale-[.985]'];
            const openCls = ['visible', 'pointer-events-auto', 'opacity-100', 'scale-100'];

            const setOpen = (wrap, open) => {
                const menu = wrap.querySelector('[data-fi-select-menu]');
                wrap.toggleAttribute('data-open', open);
                closedCls.forEach((c) => menu?.classList.toggle(c, !open));
                openCls.forEach((c) => menu?.classList.toggle(c, open));
                wrap.querySelector('button[aria-haspopup="listbox"]')?.setAttribute('aria-expanded', String(open));
                wrap.querySelector('[data-fi-arrow]')?.classList.toggle('rotate-180', open);
            };

            const closeAll = (except = null, refocus = false) => {
                document.querySelectorAll('[data-fi-select][data-open]').forEach((wrap) => {
                    if (wrap === except) return;
                    setOpen(wrap, false);
                    if (refocus) wrap.querySelector('button[aria-haspopup="listbox"]')?.focus();
                });
            };

            window.finditHydrateSelects = () => {
                document.querySelectorAll('select:not([multiple]):not([data-fi-select-ready])').forEach((select) => {
                    select.dataset.fiSelectReady = 'true';
                    const sizes = [...select.classList].filter((c) => /^(?:(?:sm|md|lg|xl):)?(?:max-)?w-/.test(c)).join(' ');
                    const wrap = document.createElement('div');
                    wrap.setAttribute('data-fi-select', '');
                    wrap.className = `relative w-full min-w-0 ${sizes}`;

                    select.parentNode.insertBefore(wrap, select);
                    wrap.appendChild(select);
                    select.className = 'pointer-events-none absolute h-px w-px opacity-0';

                    const trigger = document.createElement('button');
                    trigger.type = 'button';
                    trigger.disabled = select.disabled;
                    trigger.setAttribute('aria-haspopup', 'listbox');
                    trigger.setAttribute('aria-expanded', 'false');
                    trigger.className = 'relative flex min-h-[42px] w-full items-center justify-between gap-3 rounded-[14px] border border-[#d7dde7] bg-white px-3.5 py-2.5 pr-10 text-left text-sm text-ink outline-none transition hover:border-[#b7c1d0] focus:border-brand focus:ring-4 focus:ring-brand/10 disabled:cursor-not-allowed disabled:bg-[#f3f5f8] disabled:text-[#6b7585] disabled:opacity-80';
                    trigger.innerHTML = '<span></span><span data-fi-arrow class="absolute right-3.5 top-1/2 h-4 w-4 -translate-y-1/2 transition-transform duration-200"><svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="#102a4c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg></span>';

                    const label = trigger.firstElementChild;
                    const menu = document.createElement('div');
                    menu.setAttribute('data-fi-select-menu', '');
                    menu.setAttribute('role', 'listbox');
                    menu.className = 'invisible pointer-events-none absolute left-0 top-[calc(100%+8px)] z-[60] max-h-60 w-full scale-[.985] overflow-y-auto rounded-[14px] border border-[#dfe4ec] bg-white p-1.5 opacity-0 shadow-[0_14px_34px_rgba(16,42,76,.14)] transition duration-150 ease-out';

                    const refresh = () => {
                        menu.innerHTML = '';
                        [...select.options].forEach((opt) => {
                            if (opt.disabled) return;
                            const item = document.createElement('button');
                            item.type = 'button';
                            item.setAttribute('role', 'option');
                            item.setAttribute('aria-selected', String(opt.selected));
                            item.textContent = opt.text;
                            item.className = `flex min-h-10 w-full items-center rounded-[10px] px-3 py-2 text-left text-sm transition hover:bg-[#f3f5f8] hover:text-ink-navy ${opt.selected ? 'bg-brand-soft font-bold text-brand-dark' : 'bg-white text-ink'}`;
                            item.addEventListener('click', () => {
                                select.value = opt.value;
                                select.dispatchEvent(new Event('input', { bubbles: true }));
                                select.dispatchEvent(new Event('change', { bubbles: true }));
                                refresh();
                                setOpen(wrap, false);
                                trigger.focus();
                            });
                            menu.appendChild(item);
                        });
                        label.textContent = select.options[select.selectedIndex]?.text || 'Pilih opsi';
                    };

                    trigger.addEventListener('click', () => {
                        if (select.disabled) return;
                        const next = !wrap.hasAttribute('data-open');
                        if (next) closeAll(wrap);
                        setOpen(wrap, next);
                    });

                    trigger.addEventListener('keydown', (e) => {
                        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                            e.preventDefault();
                            closeAll(wrap);
                            setOpen(wrap, true);
                            menu.querySelector('[role="option"]')?.focus();
                        }
                    });

                    wrap.append(trigger, menu);
                    refresh();
                    select.addEventListener('change', refresh);
                    new MutationObserver(refresh).observe(select, { childList: true, attributes: true, subtree: true });
                });
            };

            document.addEventListener('click', (e) => { if (!e.target.closest('[data-fi-select]')) closeAll(); });
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeAll(null, true); });
            document.addEventListener('DOMContentLoaded', window.finditHydrateSelects);
            new MutationObserver(() => window.finditHydrateSelects()).observe(document.documentElement, { childList: true, subtree: true });
        })();
    </script>
</body>
</html>
