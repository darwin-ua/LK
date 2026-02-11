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
                    <a href="{{ route('cabinet.profile', ['theme' => $theme]) }}">
                        <img src="{{ asset("themes/$theme/images/user.svg") }}" class="icon-img" alt="User">
                        Профіль дилера
                    </a>
                </li>
                <li class="{{ ($defaultPage ?? '') === 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.dashboard', ['theme' => $theme]) }}">
                        <img src="{{ asset("themes/$theme/images/grid-view.svg") }}" class="icon-img" alt="Dashboard">
                        Дашборд
                    </a>
                </li>

                <li class="{{ ($defaultPage ?? '') === 'orders-tracking' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.orders-tracking', ['theme' => $theme]) }}">
                        <img src="{{ asset("themes/$theme/images/route.svg") }}" class="icon-img" alt="Tracking">
                        Трекінг замовлення
                    </a>
                </li>

                <li class="{{ ($defaultPage ?? '') === 'windraw' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.windraw', ['theme' => $theme]) }}">
                        <img src="{{ asset("themes/$theme/images/shapes-2.svg") }}" class="icon-img" alt="WinDraw">
                        WinDraw
                    </a>
                </li>

            </ul>

            <h3>Промо</h3>
            <ul class="menu">
                <li class="{{ ($defaultPage ?? '') === 'promotions' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.promotions', ['theme' => $theme]) }}">
                        <img src="{{ asset("themes/$theme/images/Speaker-megaphone-3.svg") }}"
                             class="icon-img"
                             alt="Акції">
                        Акції
                    </a>
                </li>

                <li class="{{ ($defaultPage ?? '') === 'motivation' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.motivation', ['theme' => $theme]) }}">
                        <img src="{{ asset("themes/$theme/images/Flash.svg") }}"
                             class="icon-img"
                             alt="Мотивація">
                        Мотивація
                    </a>
                </li>
            </ul>

            <h3>Фінанси</h3>
            <ul class="menu">
                <li class="{{ ($defaultPage ?? '') === 'finances' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.finances', ['theme' => $theme]) }}">
                        <img src="{{ asset("themes/$theme/images/cash1.svg") }}"
                             class="icon-img"
                             alt="Фінанси">
                        Фінанси
                    </a>
                </li>
            </ul>

            <h3>Підтримка</h3>
            <ul class="menu">
                <li class="{{ ($defaultPage ?? '') === 'complaints' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.complaints', ['theme' => $theme]) }}">
                        <img src="{{ asset("themes/$theme/images/alert-triangle.svg") }}"
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
                        src="{{ asset("themes/$theme/images/Right-enter.svg") }}"
                        class="icon-img"
                        alt="Exit Icon"
                    />
                    <span>Вихід</span>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                    <input type="hidden" name="theme" value="{{ $theme }}">
                </form>

            </div>
        </div>
    </div>

    <!-- Правая колонка -->
    <div class="right-column" >
        <!-- Рекламації -->
        <div  class="complaints-container active">
            <div class="complaints-header">
                &nbsp;&nbsp; &nbsp;&nbsp;<h1 class="complaints-title">Рекламації</h1>

                <div class="complaints-actions-right">
                    <button class="New-complaint-btn">
                        &nbsp;+&nbsp;
                    </button>

                    <button
                        class="update-btn"
                        id="updateUserActionBtn"
                        data-action-url="{{ route('user.action.set') }}"
                        data-csrf="{{ csrf_token() }}"
                    >
                        &nbsp;<img src="{{ asset("themes/$theme/images/Round-arrow.svg") }}"
                             alt="Оновити"
                             class="update-icon" />
                        <span class="update-text"></span>
                        <span class="update-spinner hidden"></span>
                    </button>

                </div>
            </div>

            <div class="complaints-bottom-content">
                <div class="complaints-panel">

                    {{-- ===== HEADER ===== --}}
                    <div class="complaints-panel-head Twisting">
                        <h2 class="complaints-subtitle">Акт звірки</h2>

                        <div class="controls-right">
                            <a
                                href="{{ route('cabinet.complaints.export', request()->query()) }}"
                                class="control-btn control-export"
                                style="display:inline-flex"
                            >
                                <img src="{{ asset("themes/$theme/images/Upload.svg") }}" class="btn-icon" />
                                Експорт (XLSX)
                            </a>

                            <button class="control-btn control-range" type="button" id="dateRangeBtn">
                                <img src="{{ asset("themes/$theme/images/calendar-dots.svg") }}" class="btn-icon" />

                                @php
                                    $rangeLabels = [
                                        'all' => 'За весь час',
                                        '1'   => 'За сьогодні',
                                        '7'   => 'За 7 днів',
                                        '30'  => 'За 30 днів',
                                        '90'  => 'За 90 днів',
                                        '180' => 'За 180 днів',
                                        '365' => 'За рік',
                                    ];
                                    $currentRange = request('date_range', 'all');
                                @endphp

                                {{ $rangeLabels[$currentRange] ?? 'За весь час' }}

                                <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" class="btn-icon-right" />
                            </button>
                        </div>
                    </div>

                    {{-- ===== POPUP RANGE (ВНЕ controls-right) ===== --}}
                    <form method="GET" id="dateRangeForm">
                        <input
                            type="hidden"
                            name="date_range"
                            id="dateRangeInput"
                            value="{{ request('date_range', 'all') }}"
                        >
                    </form>

                    <div class="table-popup table-popup-sort" id="dateRangePopup">
                        <span data-days="all">За весь час</span>
                        <span data-days="1">За сьогодні</span>
                        <span data-days="7">За 7 днів</span>
                        <span data-days="30">За 30 днів</span>
                        <span data-days="90">За 90 днів</span>
                        <span data-days="180">За 180 днів</span>
                        <span data-days="365">За рік</span>
                    </div>

                    {{-- ===== CARDS ===== --}}
                    <div class="finances-cards">
                        <div class="finances-card finances-card--green">
                            <p class="card-text">Початковий баланс</p>
                            <span class="card-value">₴0</span>
                            <img src="{{ asset("themes/$theme/images/Green checkmark box.svg") }}" class="card-icon" />
                        </div>

                        <div class="finances-card finances-card--blue">
                            <p class="card-text">Нараховано (рахунки)</p>
                            <span class="card-value">₴128 400</span>
                            <img src="{{ asset("themes/$theme/images/Blue checkmark box.svg") }}" class="card-icon" />
                        </div>

                        <div class="finances-card finances-card--orange">
                            <p class="card-text">Оплачено / списано</p>
                            <span class="card-value">₴96 200</span>
                            <img src="{{ asset("themes/$theme/images/Orange checkmark box.svg") }}" class="card-icon" />
                        </div>
                    </div>

                    {{-- ===== TABLE ===== --}}
                    <div class="complaints-table-wrapper complaints-table-wrapper-simple">
                        <div class="table-scroll-wrapper">
                            <table class="complaints-table">
                                <thead>
                                <tr>

                                    <th>
                                        <a href="{{ sortUrl('complaint_number') }}" class="th-sort">
                                            № Замовлення
                                            <img src="{{ asset("themes/$theme/images/" . (request('sort') === 'complaint_number' && request('direction') === 'asc'
                ? 'Arrow-Up.svg'
                : 'Arrow-Down.svg')) }}" class="th-icon">
                                        </a>
                                    </th>

                                    <th>
                                        <a href="{{ sortUrl('complaint_date') }}" class="th-sort">
                                            Дата
                                            <img src="{{ asset("themes/$theme/images/" . (request('sort') === 'complaint_date' && request('direction') === 'asc'
                ? 'Arrow-Up.svg'
                : 'Arrow-Down.svg')) }}" class="th-icon">
                                        </a>
                                    </th>

                                    <th>Клієнт</th>

                                    <th>Тип</th>

                                    <th>
                                        <a href="{{ sortUrl('status') }}" class="th-sort">
                                            Статус
                                            <img src="{{ asset("themes/$theme/images/" . (request('sort') === 'status' && request('direction') === 'asc'
                ? 'Arrow-Up.svg'
                : 'Arrow-Down.svg')) }}" class="th-icon">
                                        </a>
                                    </th>

                                    <th>
                                        <a href="{{ sortUrl('amount') }}" class="th-sort">
                                            Сума
                                            <img src="{{ asset("themes/$theme/images/" . (request('sort') === 'amount' && request('direction') === 'asc'
                ? 'Arrow-Up.svg'
                : 'Arrow-Down.svg')) }}" class="th-icon">
                                        </a>
                                    </th>

                                    <th>Дії</th>

                                </tr>
                                </thead>


                                <tbody>
                                @foreach ($complaints as $complaint)
                                    <tr>
                                        <td data-label="№ Замовлення">
                                            {{ $complaint->complaint_number }}
                                        </td>

                                        <td data-label="Дата">
                                            {{ optional($complaint->complaint_date)->format('d.m.Y') }}
                                        </td>

                                        <td data-label="Клієнт">
                                            {{ auth()->user()->name }}
                                        </td>

                                        <td data-label="Тип">
                                            Брак продукції
                                        </td>

                                        <td data-label="Статус">
                                            <button
                                                class="complaints-status"
                                                data-status="{{ $complaint->posted ? 'Resolved' : 'In-work' }}"
                                            >
                                                {{ $complaint->posted ? 'Вирішено' : 'В роботі' }}
                                            </button>
                                        </td>

                                        <td data-label="Сума" class="debt">
                                            ₴12 840
                                        </td>

                                        <td data-label="Дії">
                                            <button
                                                class="complaints-status"
                                                data-status="Details"
                                                data-number="{{ $complaint->complaint_number }}"
                                                data-defect="{{ $complaint->defect }}"
                                                data-comment="{{ $complaint->comment }}"
                                            >
                                                Деталі
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                {{-- Пустой tfoot — нужен для CSS --}}
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- ===== PAGINATION ===== --}}
                    @if ($complaints instanceof \Illuminate\Pagination\LengthAwarePaginator && $complaints->total() > $complaints->perPage())
                        <div class="finances-table-summary navigation">
                            <div class="footer-table-left">
                                <div class="footer-table-pagination-wrapper">
                                    <span class="footer-text">Показувати</span>

                                    <form method="GET">
                                        <select name="per_page" onchange="this.form.submit()">
                                            <option value="5" {{ $perPage==5 ? 'selected':'' }}>5</option>
                                            <option value="10" {{ $perPage==10 ? 'selected':'' }}>10</option>
                                        </select>

                                        <input type="hidden" name="date_range" value="{{ request('date_range','30') }}">
                                    </form>
                                </div>
                            </div>

                            <div class="footer-table-right">
                                <div class="footer-btn-group">
                                    @if ($complaints->onFirstPage())
                                        <button class="footer-btn prev" disabled>Попередня</button>
                                    @else
                                        <a href="{{ $complaints->previousPageUrl() }}" class="footer-btn prev">Попередня</a>
                                    @endif

                                    @foreach ($complaints->getUrlRange(1, $complaints->lastPage()) as $page => $url)
                                        @if ($page == $complaints->currentPage())
                                            <button class="footer-btn active-page">{{ $page }}</button>
                                        @else
                                            <a href="{{ $url }}" class="footer-btn">{{ $page }}</a>
                                        @endif
                                    @endforeach

                                    @if ($complaints->hasMorePages())
                                        <a href="{{ $complaints->nextPageUrl() }}" class="footer-btn next">Наступна</a>
                                    @else
                                        <button class="footer-btn next" disabled>Наступна</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>



            <div class="complaints-popup report-popup">
                <!-- Хедер -->
                <div class="complaints-popup-header">
                    <h2 class="complaints-popup-title">Рекламації</h2>
                    <img
                        src="{{ asset("themes/$theme/images/close.svg") }}"
                        alt="Закрити"
                        class="complaints-popup-close report-popup-close"
                    />
                </div>

                <!-- Контент -->
                <div class="complaints-popup-body">
                    <!-- № Замовлення -->
                    <div class="complaints-field">
                        <p class="complaints-label">DWN-10452*</p>
                        <button class="complaints-status" data-status="Overdue">
                            Прострочено
                        </button>

                        <div class="complaints-row">
                            <p class="complaints-label">Сума компенсації:</p>
                            <span>₴2 600</span>
                        </div>
                    </div>

                    <!-- Разделитель -->
                    <div class="complaints-divider"></div>

                    <!-- Опис -->
                    <div class="complaints-field">
                        <p class="complaints-label">Опис</p>

                        <div class="complaints-row">
                            <p class="complaints-label">Тип:</p>
                            <span class="complaints-label">Брак продукції</span>
                        </div>

                        <div class="complaints-row">
                            <p class="complaints-label">Причина:</p>
                            <span class="complaints-label"
                            >Виявлено тріщини на профілі</span
                            >
                        </div>
                    </div>

                    <!-- Файли -->
                    <div class="complaints-field">
                        <p class="complaints-label">Файли</p>

                        <div class="complaints-files">
                            <div class="complaints-file">
                                <img src="{{ asset("themes/$theme/images/file-text.svg") }}" alt="File" />
                            </div>
                            <div class="complaints-file">
                                <img src="{{ asset("themes/$theme/images/file-text.svg") }}" alt="File" />
                            </div>
                        </div>

                        <div class="complaints-add-file">
                            <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" alt="Прикріпити" />
                            <p>Додати файли</p>
                        </div>
                    </div>

                    <!-- Коментарі -->
                    <div class="complaints-field">
                        <p class="complaints-label">Коментарі</p>
                        <p class="complaints-comment-meta">
                            Іванов О.М. · 2 години тому
                        </p>
                        <p class="complaints-comment-text">
                            Зв'язався з клієнтом, чекаємо на додаткові фото
                        </p>
                    </div>

                    <!-- Історія змін -->
                    <div class="complaints-field">
                        <p class="complaints-label">Історія змін</p>

                        <div class="complaints-history-item">
                            <img src="{{ asset("themes/$theme/images/clock-hour-3.svg") }}" alt="Історія" />
                            <p>15.08.2025 14:30 — Статус змінено на "Прострочено"</p>
                        </div>

                        <div class="complaints-history-item">
                            <img src="{{ asset("themes/$theme/images/clock-hour-3.svg") }}" alt="Історія" />
                            <p>15.08.2025 09:15 — Рекламацію створено</p>
                        </div>
                    </div>

                    <!-- Разделитель -->
                    <div class="complaints-divider"></div>

                    <!-- Кнопки -->
                    <div class="complaints-actions">
                        <button class="complaints-btn create">Оновити статус</button>
                        <button class="complaints-btn cancel">
                            Закрити як вирішене
                        </button>
                    </div>
                </div>
            </div>

            <!-- Оверлей для попапа рекламаций -->
            <div class="complaints-popup-overlay"></div>

            <div class="complaints-popup new-complaint-popup">
                <!-- Хедер -->
                <div class="complaints-popup-header">
                    <h2 class="complaints-popup-title">&nbsp;+&nbsp;</h2>
                    <img
                        src="{{ asset("themes/$theme/images/close.svg") }}"
                        alt="Закрити"
                        class="complaints-popup-close new-complaint-popup-close"
                    />
                </div>

                <!-- Контент -->
                <div class="complaints-popup-body">
                    <!-- № Замовлення -->
                    <div class="complaints-field">
                        <p class="complaints-label">№ Замовлення*</p>
                        <input
                            type="text"
                            class="complaints-input"
                            placeholder="Пошук замовлення"
                        />
                    </div>

                    <!-- Тип проблеми -->
                    <div class="complaints-field">
                        <p class="complaints-label">Тип проблеми*</p>
                        <input
                            type="text"
                            class="complaints-input"
                            placeholder="Оберіть тип"
                        />
                    </div>

                    <!-- Опис проблеми -->
                    <div class="complaints-field">
                        <p class="complaints-label">Опис проблеми*</p>
                        <input
                            type="text"
                            class="complaints-input"
                            placeholder="Детальний опис проблеми"
                        />
                    </div>

                    <!-- Додати фото/файли -->
                    <div class="complaints-field complaints-upload">
                        <p class="complaints-label">Додати фото/файли</p>
                        <div class="complaints-upload-box">
                            <img
                                src="{{ asset("themes/$theme/images/upload-cloud.svg") }}"
                                alt="Upload"
                                class="complaints-upload-icon"
                            />
                            <p class="complaints-upload-text">
                                Drag & drop file here or <span>choose file</span>
                            </p>
                        </div>
                    </div>

                    <!-- Разделитель -->
                    <div class="complaints-divider"></div>

                    <!-- Кнопки -->
                    <div class="complaints-actions">
                        <button class="complaints-btn create">Створити</button>
                        <button class="complaints-btn cancel">Скасувати</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="partner">
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









