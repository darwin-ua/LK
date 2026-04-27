@extends('admin.index')

@section('title', 'Рекламації')

@section('content')
    @php
        function sortUrl($column) {
            $currentSort = request('sort');
            $currentDir  = request('direction', 'asc');

            $dir = ($currentSort === $column && $currentDir === 'asc')
                ? 'desc'
                : 'asc';

            return request()->fullUrlWithQuery([
                'sort' => $column,
                'direction' => $dir,
            ]);
        }
    @endphp

<div class="container">
    <style>
        .th-sort {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: inherit;
            text-decoration: none;
        }

        .th-sort:hover {
            text-decoration: underline;
        }

        .th-disabled {
            opacity: 0.5;
            cursor: default;
            pointer-events: none;
        }

        .th-icon {
            width: 14px;
            opacity: 0.6;
        }


        .menu li a {
            display: flex;
            align-items: center;
            gap: 10px;

            color: inherit;        /* ← обычный цвет */
            text-decoration: none; /* ← убираем подчёркивание */
            font-weight: normal;   /* ← обычный шрифт */
        }
        .update-btn {
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .update-spinner {
            width: 18px;
            height: 18px;
            border: 2px solid #ccc;
            border-top-color: #9acd32;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .update-spinner.hidden {
            display: none;
        }

        .update-btn.loading .update-icon,
        .update-btn.loading .update-text {
            opacity: 0.5;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .complaints-header {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .complaints-actions-right {
            margin-left: auto;     /* ← прижимаем ВСЮ группу вправо */
            display: flex;
            align-items: center;
            gap: 12px;             /* расстояние между кнопками */
        }


        /* если раньше где-то было */
        .update-btn {
            margin-left: 0; /* ОБЯЗАТЕЛЬНО убрать auto */
        }

        /* === Dropdown "За весь час" — как в трекинге === */
        .table-popup-sort {
            padding: 8px 0;              /* общий воздух сверху/снизу */
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,.12);
        }

        .table-popup-sort span {
            display: block;
            padding: 6px 20px;          /* ← ВАЖНО: расстояние между пунктами */
            font-size: 15px;
            line-height: 1.4;
            cursor: pointer;
            white-space: nowrap;
        }

        /* hover — мягкий, как в трекинге */
        .table-popup-sort span:hover {
            background: #f5f5f5;
        }

        /* необязательно, но красиво */
        .table-popup-sort span:not(:last-child) {
            margin-bottom: 2px;          /* микро-воздух между пунктами */
        }

        /* === Export button (link styled as button) === */
        .control-btn.control-export,
        .control-btn.control-export:link,
        .control-btn.control-export:visited,
        .control-btn.control-export:hover,
        .control-btn.control-export:active {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 8px;

            background: #fff;
            color: #000;
            text-decoration: none;   /* 🔑 убирает подчёркивание */
            cursor: pointer;
        }

        /* hover как у кнопки */
        .control-btn.control-export:hover {
            background: #f5f5f5;
        }


    </style>
    <div class="left-column">
        <div class="left-bottom">
            <h3>Головне</h3>
            <ul class="menu">
                <li class="{{ ($defaultPage ?? '') === 'profile' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.profile') }}">
                        <img src="{{ asset('themes/' . session('theme', 'darwin') . '/images/user.svg') }}" class="icon-img" alt="User">
                        Профіль дилера
                    </a>
                </li>

                <li class="{{ ($defaultPage ?? '') === 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.dashboard') }}">
                        <img src="{{ asset('themes/' . session('theme', 'darwin') . '/images/grid-view.svg') }}" class="icon-img" alt="Dashboard">
                        Дашборд
                    </a>
                </li>

                <li class="{{ ($defaultPage ?? '') === 'orders-tracking' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.orders-tracking') }}">
                        <img src="{{ asset('themes/' . session('theme', 'darwin') . '/images/route.svg') }}" class="icon-img" alt="Tracking">
                        Трекінг замовлення
                    </a>
                </li>

                <li class="{{ ($defaultPage ?? '') === 'windraw' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.windraw') }}">
                        <img src="{{ asset('themes/' . session('theme', 'darwin') . '/images/shapes-2.svg') }}" class="icon-img" alt="WinDraw">
                        WinDraw
                    </a>
                </li>
            </ul>

            <h3>Промо</h3>
            <ul class="menu">
                <li class="{{ ($defaultPage ?? '') === 'promotions' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.promotions') }}">
                        <img src="{{ asset('themes/' . session('theme', 'darwin') . '/images/Speaker-megaphone-3.svg') }}"
                             class="icon-img"
                             alt="Акції">
                        Акції
                    </a>
                </li>

                <li class="{{ ($defaultPage ?? '') === 'motivation' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.motivation') }}">
                        <img src="{{ asset('themes/' . session('theme', 'darwin') . '/images/Flash.svg') }}"
                             class="icon-img"
                             alt="Мотивація">
                        Мотивація
                    </a>
                </li>
            </ul>

            <h3>Фінанси</h3>
            <ul class="menu">
                <li class="{{ ($defaultPage ?? '') === 'finances' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.finances') }}">
                        <img src="{{ asset('themes/' . session('theme', 'darwin') . '/images/cash1.svg') }}"
                             class="icon-img"
                             alt="Фінанси">
                        Фінанси
                    </a>
                </li>
            </ul>

            <h3>Підтримка</h3>
            <ul class="menu">
                <li class="{{ ($defaultPage ?? '') === 'complaints' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.complaints') }}">
                        <img src="{{ asset('themes/' . session('theme', 'darwin') . '/images/alert-triangle.svg') }}"
                             class="icon-img"
                             alt="Рекламації">
                        Рекламації
                    </a>
                </li>
            </ul>

            <div class="logout-container">
                <div class="menu-divider"></div>
                <div class="logout-block"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                     style="cursor: pointer;">
                    <img
                        src="{{ asset('themes/' . session('theme', 'darwin') . '/images/Right-enter.svg') }}"
                        class="icon-img"
                        alt="Exit Icon"
                    />
                    <span>Вихід</span>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </div>

    </div>
    <!-- Правая колонка -->
    <div class="right-column">
        <style>
            .WinDraw-card {
                width: 420px;
                background: #ffffff;
                border-radius: 20px;
                padding: 40px 32px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.08);

                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

        </style>

        <div class="promo-block-content">
            <img
                src="{{ asset("themes/$theme/images/Development, idea, keyboard.svg") }}"
                alt="Иконка"
                class="promo-info-icon"
            />
            <h1 class="promo-title">
                Вибачте, наразі ведеться розробка сторінки
            </h1>
            <p class="promo-text">
                Ми вже працюємо над цим розділом — поверніться трохи згодом.
            </p>
        </div>

        <div class="partner" style="margin-top: 0px;">
            @if ($theme === 'goodwin')
                <img src="{{ asset("themes/$theme/images/veka_280.png") }}" alt="Rehau Partner">
            @else
                <img src="{{ asset("themes/$theme/images/rehau.png") }}" alt="Veka Partner">
            @endif
        </div>

    </div>
</div>


@endsection
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('updateUserActionBtn');
        if (!btn) return;

        const spinner = btn.querySelector('.update-spinner');

        btn.addEventListener('click', async () => {

            // 1. UI: включаем загрузку
            btn.classList.add('loading');
            btn.disabled = true;
            spinner.classList.remove('hidden');

            try {
                // 2. Ставим actions = 1
                const res = await fetch("{{ route('user.action.set') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    }
                });

                const data = await res.json();
                if (!data.success) {
                    throw new Error('Не вдалося запустити оновлення');
                }

                // 3. Ждём, пока Node сбросит actions → 0
                await waitForActionsReset();

                // 4. Готово
                spinner.classList.add('hidden');
                btn.classList.remove('loading');

                const reload = confirm(
                    'Дані оновлено. Оновити сторінку?'
                );

                if (reload) {
                    window.location.reload();
                }

            } catch (e) {
                console.error(e);
                alert('Помилка при оновленні даних');
            } finally {
                btn.disabled = false;
            }
        });

        // ===== polling =====
        async function waitForActionsReset() {
            return new Promise((resolve) => {

                const interval = setInterval(async () => {
                    try {
                        const res = await fetch('/user/action/status');
                        const data = await res.json();

                        if (data.actions === 0) {
                            clearInterval(interval);
                            resolve();
                        }
                    } catch (e) {
                        console.error('Status check failed', e);
                    }
                }, 3000); // каждые 3 сек
            });
        }
    });


    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('updateUserActionBtn');
        if (!btn) return;

        const spinner = btn.querySelector('.update-spinner');

        btn.addEventListener('click', async () => {

            btn.classList.add('loading');
            btn.disabled = true;
            spinner?.classList.remove('hidden');

            try {
                const res = await fetch(btn.dataset.actionUrl, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": btn.dataset.csrf,
                        "Accept": "application/json"
                    }
                });

                const data = await res.json();
                if (!data.success) {
                    throw new Error('Не вдалося запустити оновлення');
                }

                await waitForActionsReset();

                spinner?.classList.add('hidden');
                btn.classList.remove('loading');

                if (confirm('Дані оновлено. Оновити сторінку?')) {
                    window.location.reload();
                }

            } catch (e) {
                console.error(e);
                alert('Помилка при оновленні даних');
            } finally {
                btn.disabled = false;
            }
        });

        async function waitForActionsReset() {
            return new Promise((resolve) => {
                const interval = setInterval(async () => {
                    try {
                        const res = await fetch('/user/action/status');
                        const data = await res.json();

                        if (data.actions === 0) {
                            clearInterval(interval);
                            resolve();
                        }
                    } catch (e) {
                        console.error('Status check failed', e);
                    }
                }, 3000);
            });
        }
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const openBtn   = document.querySelector('.New-complaint-btn');
        const popup     = document.querySelector('.new-complaint-popup');
        const overlay   = document.querySelector('.complaints-popup-overlay');
        const closeBtn  = document.querySelector('.new-complaint-popup-close');
        const cancelBtn = popup?.querySelector('.complaints-btn.cancel');

        if (!openBtn || !popup || !overlay) {
            console.warn('❌ Complaint popup elements not found');
            return;
        }

        const openPopup = () => {
            popup.classList.add('active');
            overlay.classList.add('active');
        };

        const closePopup = () => {
            popup.classList.remove('active');
            overlay.classList.remove('active');
        };

        // открыть
        openBtn.addEventListener('click', openPopup);

        // закрыть
        closeBtn?.addEventListener('click', closePopup);
        cancelBtn?.addEventListener('click', closePopup);
        overlay.addEventListener('click', closePopup);

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const detailsPopup = document.querySelector('.complaints-popup.report-popup');
        const overlay      = document.querySelector('.complaints-popup-overlay');
        const closeBtn     = detailsPopup?.querySelector('.report-popup-close');

        if (!detailsPopup || !overlay) {
            console.warn('❌ Report popup not found');
            return;
        }

        // ===== ОТКРЫТИЕ ПО КНОПКЕ "Деталі" =====
        document.querySelectorAll('.complaints-status[data-status="Details"]')
            .forEach(btn => {

                btn.addEventListener('click', () => {

                    const number  = btn.dataset.number  || '—';
                    const defect  = btn.dataset.defect  || '—';
                    const comment = btn.dataset.comment || '—';

                    // № рекламации
                    const numberEl = detailsPopup.querySelector('.complaints-label');
                    if (numberEl) numberEl.textContent = number;

                    // Описание
                    const spans = detailsPopup.querySelectorAll('.complaints-row span');
                    if (spans[0]) spans[0].textContent = defect;
                    if (spans[1]) spans[1].textContent = comment;

                    // открыть попап
                    detailsPopup.classList.add('active');
                    overlay.classList.add('active');
                });

            });

        // ===== ЗАКРЫТИЕ =====
        const closePopup = () => {
            detailsPopup.classList.remove('active');
            overlay.classList.remove('active');
        };

        closeBtn?.addEventListener('click', closePopup);
        overlay.addEventListener('click', closePopup);

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const rangeBtn   = document.getElementById('dateRangeBtn');
        const rangePopup = document.getElementById('dateRangePopup');
        const rangeInput = document.getElementById('dateRangeInput');
        const rangeForm  = document.getElementById('dateRangeForm');

        rangeBtn?.addEventListener('click', () => {
            rangePopup.classList.toggle('active');
        });

        rangePopup?.querySelectorAll('[data-days]').forEach(item => {
            item.addEventListener('click', () => {
                rangeInput.value = item.dataset.days;
                rangeForm.submit();
            });
        });

        document.addEventListener('click', (e) => {
            if (!rangeBtn.contains(e.target) && !rangePopup.contains(e.target)) {
                rangePopup.classList.remove('active');
            }
        });
    });
</script>









