@extends('admin.index')

@section('title', 'Трекiнг замовлення')

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

        /* === Pagination buttons === */
        .footer-btn-group a.footer-btn,
        .footer-btn-group button.footer-btn:not(.active-page) {
            color: #000;
            text-decoration: none;
            background: transparent;
            border: 1px solid #ddd;
        }


        /* Hover */
        .footer-btn-group a.footer-btn:hover {
            background-color: #f5f5f5;
            color: #000;
        }

        /* Активная страница (у тебя уже зелёная — не трогаем) */
        .footer-btn-group .active-page {
            background-color: #9acd32; /* или твой зелёный */
            color: #000;
            border-color: #9acd32;
        }

        /* Disabled */
        .footer-btn-group .footer-btn[disabled],
        .footer-btn-group .footer-btn.disabled {
            color: #aaa;
            cursor: not-allowed;
        }

        /* === Export button (link styled as button) === */
        .control-btn.control-export,
        .control-btn.control-export:link,
        .control-btn.control-export:visited,
        .control-btn.control-export:hover,
        .control-btn.control-export:active {
            color: #000 !important;        /* чёрный текст */
            text-decoration: none;         /* убрать подчёркивание */
        }

        .table-popup-sort {
            display: none;
            position: absolute;
            background: #fff;
            border: 1px solid #ddd;
            z-index: 10;
        }

        .table-popup-sort.active {
            display: block;
        }

        .table-popup-sort span {
            display: block;
            padding: 8px 12px;
            cursor: pointer;
        }

        .table-popup-sort span:hover {
            background: #f5f5f5;
        }

        .search-clear-btn {
            background: none;
            border: none;
            color: #000;          /* чёрный */
            font-size: 18px;
            cursor: pointer;
            padding: 0 6px;
            line-height: 1;
        }

        .search-clear-btn:hover {
            color: #000;
            opacity: 0.6;
        }

        /* ===== ORDER DETAILS TABS ===== */

        /* меню */
        .order-footer-menu {
            display: flex;
            gap: 24px;
            border-bottom: 1px solid #e5e5e5;
            margin-bottom: 19px;
        }

        .order-menu-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 0 16px; /* ⬅️ добавили нижний отступ */
            cursor: pointer;
            color: #666;
            position: relative;
        }

        .order-menu-item img {
            width: 18px;
            height: 18px;
            opacity: 0.6;
        }

        .order-menu-item.active {
            color: #000;
            font-weight: 500;
        }

        .order-menu-item.active img {
            opacity: 1;
        }

        /* нижняя линия активного таба */
        .order-menu-item.active::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;           /* линия ниже текста */
            width: 100%;
            height: 2px;
            background: #9acd32;
        }

        /* контент табов */
        .order-extra-rows {
            display: none;
            animation: fadeIn 0.25s ease-in-out;
        }

        .order-extra-rows.active {
            display: block;
        }

        /* плавное появление */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(4px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        /* Убрать подчёркивание у ВСЕХ ссылок в меню трекинга */
        .tracking-order-menu a,
        .tracking-order-menu a:link,
        .tracking-order-menu a:visited,
        .tracking-order-menu a:hover,
        .tracking-order-menu a:active,
        .tracking-order-menu a:focus {
            text-decoration: none;
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
    <div class="right-column">
        <!-- Трекінг замовлення -->
        <div class="tracking-order-content active">
            <div class="tracking-order-header">
                <h1>&nbsp;&nbsp;Трекінг замовлення</h1>
{{--                <button class="tracking-btn" id="invoiceOpenBtn">--}}
{{--                    <img src="{{ asset("themes/$theme/images/Plus.svg") }}" alt="Plus" class="btn-icon" />--}}
{{--                    Запит на рахунок--}}
{{--                </button>--}}
                <!-- Правый столбец -->
                <button class="update-btn" id="updateUserActionBtn">
                    &nbsp; <img src="{{ asset("themes/$theme/images/Round-arrow.svg") }}"
                         alt="Оновити"
                         class="update-icon" />

                    <span class="update-text"></span>

                    <span class="update-spinner hidden"></span>
                </button>
            </div>
            <div class="tracking-order-bottom-content">
                <div class="tracking-order-menu">

                    <button class="tracking-menu-all-btn" data-filter="all">
                        <a  href="{{ route('cabinet.orders-tracking', request()->except('page','stage')) }}"
                            class="tracking-menu-all-btn {{ !request('stage') ? 'active' : '' }}">
                            Усі
                            <span class="dot">•</span>
                            <span class="count">{{ $totalCount }}</span>
                        </a>
                    </button>



                    <button class="tracking-menu-btn-pogodzenya" data-filter="pogodzenya">
                        <a href="{{ route('cabinet.orders-tracking', array_merge(request()->except('page'), ['stage'=>'pogodzenya'])) }}"
                           class="tracking-menu-btn-pogodzenya {{ request('stage')==='pogodzenya' ? 'active' : '' }}">
                            Фін. контроль
                            <span class="dot">•</span>
                            <span class="count">{{ $statusCounts['Фин. контроль'] ?? 0 }}</span>
                        </a>
                    </button>

                    <button class="tracking-menu-vyrobnytctvo-btn" data-filter="vyrobnytctvo">
                        <a href="{{ route('cabinet.orders-tracking', array_merge(request()->except('page'), ['stage'=>'vyrobnytctvo'])) }}"
                           class="tracking-menu-vyrobnytctvo-btn {{ request('stage')==='vyrobnytctvo' ? 'active' : '' }}">
                            Виробництво
                            <span class="dot">•</span>
                            <span class="count">{{ $statusCounts['Выполняется'] ?? 0 }}</span>
                        </a>
                    </button>

                    <button class="tracking-menu-reklama-btn" data-filter="reklamaciya">
                        <a href="{{ route('cabinet.orders-tracking', array_merge(request()->except('page'), ['stage'=>'reklamaciya'])) }}"
                           class="tracking-menu-reklama-btn {{ request('stage')==='reklamaciya' ? 'active' : '' }}">
                            Вiдмiна
                            <span class="dot">•</span>
                            <span class="count">{{ $statusCounts['Отменен'] ?? 0 }}</span>
                        </a>
                    </button>
                    <button class="tracking-menu-vykonano-btn" data-filter="vykonano">
                        <a href="{{ route('cabinet.orders-tracking', array_merge(request()->except('page'), ['stage'=>'vykonano'])) }}"
                           class="tracking-menu-vykonano-btn {{ request('stage')==='vykonano' ? 'active' : '' }}">
                            Виконано
                            <span class="dot">•</span>
                            <span class="count">{{ $statusCounts['Виконано'] ?? 0 }}</span>
                        </a>
                    </button>
                    <button
                        type="button"
                        class="tracking-menu-reserved-btn {{ request('stage')==='reserved' ? 'active' : '' }}"
                        onclick="window.location.href='{{ route('cabinet.orders-tracking', array_merge(request()->except('page'), ['stage'=>'reserved'])) }}'">
                        Забронирован
                        <span class="dot">•</span>
                        <span class="count">{{ $statusCounts['Забронирован'] ?? 0 }}</span>
                    </button>
                </div>
                <div class="tracking-order-table">
                    <!-- 1) Панель управления файлами -->
                    <div class="tracking-order-controls">
                        <!-- Левая часть (поиск) -->
                        <div class="controls-left">
                            <form method="GET" style="margin:0">
                                {{-- сохраняем текущие фильтры --}}
                                <input type="hidden" name="date_range" value="{{ request('date_range', 'all') }}">
                                <input type="hidden" name="per_page" value="{{ request('per_page', $perPage) }}">

                                <label class="search-box" aria-label="Пошук за номером замовлення або клієнтом">
                                    <img
                                        src="{{ asset("themes/$theme/images/Search.svg") }}"
                                        class="search-icon"
                                        aria-hidden="true"
                                    />

                                    <input
                                        type="search"
                                        name="q"
                                        value="{{ request('q') }}"
                                        placeholder="№ замовлення / клієнт"
                                        class="search-input"
                                    />
                                    @if(request('q'))
                                        <button
                                            type="button"
                                            class="search-clear-btn"
                                            onclick="window.location.href='{{ route('cabinet.orders-tracking', request()->except('q','page')) }}'"
                                            aria-label="Очистити пошук"
                                        >
                                            ✕
                                        </button>
                                    @endif

                                </label>
                            </form>
                        </div>


                        <!-- Правая часть (кнопки) -->
                        <div class="controls-right">
                            <a
                                href="{{ route('cabinet.orders-tracking.export', request()->query()) }}"
                                class="control-btn control-export"
                            >
                                <img src="{{ asset("themes/$theme/images/Upload.svg") }}" class="btn-icon" />
                                Експорт (XLSX)
                            </a>



                            <form method="GET" id="dateRangeForm">
                                <input
                                    type="hidden"
                                    name="date_range"
                                    id="dateRangeInput"
                                    value="{{ request('date_range', 'all') }}"
                                >

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


                        </div>
                    </div>

                    <!-- 2) Контейнер таблицы -->
                    <div class="finances-table-wrapper">
                        @php
                            $statusMap = [
                                'Фин. контроль' => 'pogodzenya',
                                'Выполняется'  => 'vyrobnytctvo',
                                'Виконано'     => 'vykonano',
                                'Отменен'      => 'reklamaciya',
                            ];
                        @endphp


                        <div class="finances-table-scroll">
                            <table class="finances-table">
                                <thead>
                                <tr>

                                    <th>
                                        <a href="{{ sortUrl('order_number') }}" class="th-sort">
                                            №
                                            <img src="{{ asset("themes/$theme/images/" . (request('sort') === 'order_number' && request('direction') === 'asc' ? 'Arrow-Up.svg' : 'Arrow-Down.svg')) }}" class="th-icon">
                                        </a>
                                    </th>

                                    <th>
                                        <a href="{{ sortUrl('created_at') }}" class="th-sort">
                                            Дата створення
                                            <img src="{{ asset("themes/$theme/images/" . (request('sort') === 'created_at' && request('direction') === 'asc' ? 'Arrow-Up.svg' : 'Arrow-Down.svg')) }}" class="th-icon">
                                        </a>
                                    </th>

                                    <th>
                                        <a href="{{ sortUrl('created_at') }}" class="th-sort">
                                            Виробництво
                                            <img src="{{ asset("themes/$theme/images/" . (request('sort') === 'created_at' && request('direction') === 'asc' ? 'Arrow-Up.svg' : 'Arrow-Down.svg')) }}" class="th-icon">
                                        </a>
                                    </th>

                                    <th>
                                        <a href="{{ sortUrl('created_at') }}" class="th-sort">
                                            Вiдвантаження
                                            <img src="{{ asset("themes/$theme/images/" . (request('sort') === 'created_at' && request('direction') === 'asc' ? 'Arrow-Up.svg' : 'Arrow-Down.svg')) }}" class="th-icon">
                                        </a>
                                    </th>

                                    <th>
                                        <a href="{{ sortUrl('status_1c') }}" class="th-sort">
                                            Етап
                                            <img src="{{ asset("themes/$theme/images/" . (request('sort') === 'status_1c' && request('direction') === 'asc' ? 'Arrow-Up.svg' : 'Arrow-Down.svg')) }}" class="th-icon">
                                        </a>
                                    </th>

                                    <th>
                                        <a href="{{ sortUrl('amount') }}" class="th-sort">
                                            Сума
                                            <img src="{{ asset("themes/$theme/images/" . (request('sort') === 'amount' && request('direction') === 'asc' ? 'Arrow-Up.svg' : 'Arrow-Down.svg')) }}" class="th-icon">
                                        </a>
                                    </th>

                                    <th>Дії</th>

                                </tr>
                                </thead>


                                <tbody>
                                @forelse ($orders as $order)

                                    @php
                                        $uiStatus = $statusMap[$order->status_1c] ?? '';
                                    @endphp

                                    <tr data-status="{{ $uiStatus }}">

                                    <td>{{ $order->order_number }}</td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y') }}
                                        </td>

                                        <td>
                                            {{ $order->planned_production_date
                                                ? \Carbon\Carbon::parse($order->planned_production_date)->format('d.m.Y')
                                                : '—'
                                            }}
                                        </td>


                                        <td>
                                            {{ $order->planned_shipping_date
                                                ? \Carbon\Carbon::parse($order->planned_shipping_date)->format('d.m.Y')
                                                : '—'
                                            }}
                                        </td>

                                        <td>
                                            @if(!empty($order->status_1c))
                                                <button
                                                    class="status-btn"
                                                    data-type="score"
                                                    data-status="{{ $uiStatus }}"
                                                >
                                                    {{ $order->status_1c }}
                                                </button>
                                            @else
                                                —
                                            @endif
                                        </td>


                                        <td>
                                            ₴{{ number_format($order->amount, 0, ',', ' ') }}
                                        </td>

                                        <td>
                                            <img
                                                src="{{ asset("themes/$theme/images/burger-dots.svg") }}"
                                                class="action-icon"
                                                alt=""
                                                data-order-id="{{ $order->id }}"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align:center; padding:20px;">
                                            Замовлення відсутні
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>


                        <!-- Итоговая строка -->
                        @if ($orders->hasPages())
                            <div class="finances-table-summary navigation">

                                <!-- Левая часть -->
                                <div class="footer-table-left">
                                    <div class="footer-table-pagination-wrapper">
                                        <span class="footer-text">Показувати</span>

                                        <form method="GET">
                                            <div class="footer-select">
                                                <select
                                                    name="per_page"
                                                    onchange="this.form.submit()"
                                                    style="border:none; background:transparent; cursor:pointer;"
                                                >
                                                    <option value="5"  {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                                    <option value="10" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                                                </select>
                                            </div>

                                            {{-- сохраняем страницу --}}
                                            <input type="hidden" name="page" value="{{ request('page', 1) }}">
                                        </form>

                                    </div>
                                </div>

                                <!-- Правая часть -->
                                <div class="footer-table-right">
                                    <div class="footer-pagination-wrapper">
                                        <div class="footer-btn-group">

                                            <!-- Назад -->
                                            @if ($orders->onFirstPage())
                                                <button class="footer-btn prev" disabled>
                                                    <img
                                                        src="{{ asset("themes/$theme/images/Left-arrow.svg") }}"
                                                        alt="Назад"
                                                        class="nav-icon"
                                                    />
                                                    <span class="disabled-text">Попередня</span>
                                                </button>
                                            @else
                                                <a href="{{ $orders->previousPageUrl() }}" class="footer-btn prev">
                                                    <img
                                                        src="{{ asset("themes/$theme/images/Left-arrow.svg") }}"
                                                        alt="Назад"
                                                        class="nav-icon"
                                                    />
                                                    <span>Попередня</span>
                                                </a>
                                            @endif

                                            <!-- Номера страниц -->
                                            @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                                @if ($page == $orders->currentPage())
                                                    <button class="footer-btn active-page">{{ $page }}</button>
                                                @else
                                                    <a href="{{ $url }}" class="footer-btn">{{ $page }}</a>
                                                @endif
                                            @endforeach

                                            <!-- Вперёд -->
                                            @if ($orders->hasMorePages())
                                                <a href="{{ $orders->nextPageUrl() }}" class="footer-btn next">
                                                    <span>Наступна</span>
                                                    <img
                                                        src="{{ asset("themes/$theme/images/Arrow.svg") }}"
                                                        alt="Вперед"
                                                        class="nav-icon"
                                                    />
                                                </a>
                                            @else
                                                <button class="footer-btn next" disabled>
                                                    <span>Наступна</span>
                                                    <img
                                                        src="{{ asset("themes/$theme/images/Arrow.svg") }}"
                                                        alt="Вперед"
                                                        class="nav-icon"
                                                    />
                                                </button>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <!-- Вспливающие окошки -->
                <div class="table-popup table-popup-order">
                    <div class="table-popup-item">
                        <img
                            src="{{ asset("themes/$theme/images/file-search-2.svg") }}"
                            class="table-popup-icon"
                            alt="Деталі"
                        />
                        <span>Деталі замовлення</span>
                    </div>
                    <div class="table-popup-item">
                        <img
                            src="{{ asset("themes/$theme/images/credit-card1.svg") }}"
                            class="table-popup-icon"
                            alt="Рахунок"
                        />
                        <span>Створити/Відкрити рахунок</span>
                    </div>
                </div>

                <div class="table-popup table-popup-file">
                    <div class="table-popup-item">
                        <img
                            src="{{ asset("themes/$theme/images/share-2.svg") }}"
                            class="table-popup-icon"
                            alt="Поділитися"
                        />
                        <span>Поділитися</span>
                    </div>
                    <div class="table-popup-item">
                        <img
                            src="{{ asset("themes/$theme/images/pencil-3.svg") }}"
                            class="table-popup-icon"
                            alt="Редагувати"
                        />
                        <span>Редагувати</span>
                    </div>
                </div>

                <div class="table-popup table-popup-status">
                    <div class="table-popup-status-header">Етапи замовлення</div>
                    <div class="table-popup-status-body">
                        <button class="status-btn status-btn-rahunok">
                            Прорахунок
                            <img
                                src="{{ asset("themes/$theme/images/big-arrow-right.svg") }}"
                                alt=""
                                class="status-icon"
                            />
                        </button>
                        <button class="status-btn status-btn-pogodzenya">
                            Погодження
                            <img
                                src="{{ asset("themes/$theme/images/big-arrow-right.svg") }}"
                                alt=""
                                class="status-icon"
                            />
                        </button>
                        <button class="status-btn status-btn-oplata">
                            Оплата
                            <img
                                src="{{ asset("themes/$theme/images/big-green-arrow-right.svg") }}"
                                alt=""
                                class="status-icon"
                            />
                        </button>
                        <button class="status-btn status-btn-vyrobnytctvo">
                            Виробництво
                            <img
                                src="{{ asset("themes/$theme/images/big-arrow-right.svg") }}"
                                alt=""
                                class="status-icon"
                            />
                        </button>
                        <button class="status-btn status-btn-logistica">
                            Логістика
                            <img
                                src="{{ asset("themes/$theme/images/big-arrow-right.svg") }}"
                                alt=""
                                class="status-icon"
                            />
                        </button>
                        <button class="status-btn status-btn-reklamaciya">
                            Рекламація
                            <img
                                src="{{ asset("themes/$theme/images/big-arrow-right.svg") }}"
                                alt=""
                                class="status-icon"
                            />
                        </button>
                        <button class="status-btn status-btn-vykonano">
                            Виконано
                        </button>
                    </div>

                    <!-- "Хвостик" снизу -->
                    <div class="table-popup-tip">
                        <img src="{{ asset("themes/$theme/images/tip.svg") }}" alt="tip" />
                    </div>
                </div>

                <div class="table-popup table-popup-extension">
                    <div class="table-popup-extension-item">5</div>
                    <div class="table-popup-extension-item">10</div>
                </div>

                <div class="table-popup table-popup-sort">
                    <span class="table-popup-sort-item">За сьогодні</span>
                    <span class="table-popup-sort-item">За 7 днів</span>
                    <span class="table-popup-sort-item">За 30 днів</span>
                    <span class="table-popup-sort-item">За 90 днів</span>
                    <span class="table-popup-sort-item">За 180 днів</span>
                    <span class="table-popup-sort-item">За рік</span>
                </div>

                <!-- Оверлей для попапа -->
                <div class="invoice-request-overlay" id="invoiceOverlay"></div>

                <div class="invoice-request" id="invoicePopup">
                    <!-- Заголовок -->
                    <div class="invoice-request-header">
                        <h2 class="invoice-request-title">
                            Запит на виставлення рахунку
                        </h2>
                        <img
                            src="{{ asset("themes/$theme/images/close.svg") }}"
                            alt="Закрити"
                            class="invoice-request-close"
                            id="invoiceCloseBtn"
                        />
                    </div>

                    <div class="invoice-request-body">

                        <!-- Назва платника / ЄДРПОУ -->
                        <div class="form-row invoice-request-row">
                            <div class="invoice-request-col">
                                <label class="invoice-request-label">Назва платника</label>
                                <input
                                    type="text"
                                    class="invoice-request-input"
                                    data-field="company_name"
                                />
                            </div>

                            <div class="invoice-request-col">
                                <label class="invoice-request-label">Код ЄДРПОУ/ІПН</label>
                                <input
                                    type="text"
                                    class="invoice-request-input"
                                    data-field="edrpou"
                                />
                            </div>
                        </div>

                        <!-- ПДВ / Бюджет -->
                        <div class="form-row invoice-request-row">
                            <div class="invoice-request-col">
                                <label class="invoice-request-label">
                                    Платник є платником ПДВ?
                                </label>

                                <label class="invoice-request-checkbox">
                                    <input type="checkbox" data-field="is_vat_yes" />
                                    <span>Так</span>
                                </label>

                                <label class="invoice-request-checkbox">
                                    <input type="checkbox" data-field="is_vat_no" />
                                    <span>Ні</span>
                                </label>
                            </div>

                            <div class="invoice-request-col">
                                <label class="invoice-request-label">
                                    Бюджетна організація
                                </label>

                                <label class="invoice-request-checkbox">
                                    <input type="checkbox" data-field="is_budget_yes" />
                                    <span>Так</span>
                                </label>

                                <label class="invoice-request-checkbox">
                                    <input type="checkbox" data-field="is_budget_no" />
                                    <span>Ні</span>
                                </label>
                            </div>
                        </div>

                        <!-- Контактна особа -->
                        <div class="form-row invoice-request-row">
                            <label class="invoice-request-label">
                                ПІБ контактної особи
                            </label>
                            <input
                                type="text"
                                class="invoice-request-input"
                                data-field="contact_name"
                            />
                        </div>

                        <!-- Телефон / Email -->
                        <div class="form-row invoice-request-row">
                            <div class="invoice-request-col">
                                <label class="invoice-request-label">Телефон</label>
                                <input
                                    type="text"
                                    class="invoice-request-input"
                                    data-field="phone"
                                />
                            </div>

                            <div class="invoice-request-col">
                                <label class="invoice-request-label">Email</label>
                                <input
                                    type="text"
                                    class="invoice-request-input"
                                    data-field="email"
                                />
                            </div>
                        </div>

                        <!-- Сума з замовлення -->
                        <div class="form-row invoice-request-row">
                            <label class="invoice-request-label">Сума</label>
                            <input
                                type="text"
                                class="invoice-request-input"
                                data-field="amount"
                            />
                        </div>

                        <!-- Монтаж / Договір -->
                        <div class="form-row invoice-request-row">
                            <div class="invoice-request-col">
                                <label class="invoice-request-label">
                                    Монтаж окремо?
                                </label>

                                <label class="invoice-request-checkbox">
                                    <input type="checkbox" data-field="install_yes" />
                                    <span>Так</span>
                                </label>

                                <label class="invoice-request-checkbox">
                                    <input type="checkbox" data-field="install_no" />
                                    <span>Ні</span>
                                </label>
                            </div>

                            <div class="invoice-request-col">
                                <label class="invoice-request-label">
                                    Потрібен договір?
                                </label>

                                <label class="invoice-request-checkbox">
                                    <input type="checkbox" data-field="contract_yes" />
                                    <span>Так</span>
                                </label>

                                <label class="invoice-request-checkbox">
                                    <input type="checkbox" data-field="contract_no" />
                                    <span>Ні</span>
                                </label>
                            </div>
                        </div>

                        <!-- Маржа -->
                        <div class="form-row invoice-request-row">
                            <label class="invoice-request-label">Маржа</label>
                            <div class="invoice-request-field">
                                Маржа: <span data-field="margin">—</span>
                            </div>
                        </div>

                        <!-- Загальна сума -->
                        <div class="form-row invoice-request-row">
                            <label class="invoice-request-label">Сума</label>
                            <div class="invoice-request-field">
                                Загальна сума:
                                <span data-field="total_amount">—</span>
                            </div>
                        </div>

                        <!-- Скрытые поля -->
                        <input type="hidden" data-field="order_id" />

                    </div>


                    <div class="invoice-request-divider"></div>

                    <div class="invoice-request-footer">
                        <button class="invoice-request-btn-cancel">Закрити</button>
                        <button class="invoice-request-btn-submit">Відправити</button>
                    </div>
                </div>

                <!-- Оверлей для попапа деталей заказа -->
                <div class="order-details-overlay"></div>


                <div class="order-details">

                    <!-- Заголовок -->
                    <div class="order-header">
                        <h2 class="order-title">Деталі замовлення</h2>
                        <img
                            src="{{ asset("themes/$theme/images/close.svg") }}"
                            alt="Закрити"
                            class="order-close"
                        />
                    </div>

                    <!-- Контент -->
                    <div class="order-body">
                        <!-- Левый столбец -->
                        <div class="order-col left-col">
                            <div class="order-row">
                                <span class="row-label">№ Замовлення:</span>
                                <span class="row-content" data-field="order_number"></span>
                            </div>
                            <div class="order-row">
                                <span class="row-label">Дата створення:</span>
                                <span class="row-content" data-field="created_at"></span>
                            </div>
                            <div class="order-row">
                                <span class="row-label">Клієнт:</span>
                                <span class="row-content" data-field="client"></span>
                            </div>
                            <div class="order-row">
                                <span class="row-label">Адреса:</span>
                                <span class="row-content" data-field="address"></span>
                            </div>
                            <div class="order-row">
                                <span class="row-label">Етап:</span>
                                <div class="status-tracking" data-field="status_1c"></div>
                            </div>
                            <div class="order-row">
                                <span class="row-label">Сума:</span>
                                <span class="row-content" data-field="amount"></span>
                            </div>
                        </div>

                        <!-- Правый столбец -->
                        <button class="update-btn" id="updateUserActionBtn">
                            &nbsp;<img src="{{ asset("themes/$theme/images/Round-arrow.svg") }}"
                                 alt="Оновити"
                                 class="update-icon" />

                            <span class="update-text"></span>

                            <span class="update-spinner hidden"></span>
                        </button>
                    </div>
                    <div class="order-divider"></div>
                    <!-- ===== МЕНЮ ТАБОВ ===== -->
                    <div class="order-footer-menu">
                        <div class="order-menu-item active" data-tab="table-1">
                           &nbsp; <img src="{{ asset("themes/$theme/images/Burger.svg") }}" />
                            <span>Склад замовлення</span>&nbsp;
                        </div>
                        <div class="order-menu-item" data-tab="table-2">
                            &nbsp; <img src="{{ asset("themes/$theme/images/credit-card1.svg") }}" />
                            <span>Технічні хар-ки</span>&nbsp;
                        </div>
                        <div class="order-menu-item" data-tab="table-3">
                            &nbsp;  <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" />
                            <span>Файли</span>&nbsp;
                        </div>
                        <div class="order-menu-item" data-tab="table-4">
                            &nbsp;  <img src="{{ asset("themes/$theme/images/clock.svg") }}" />
                            <span>Історія</span>&nbsp;
                        </div>
                    </div>

                    <!-- ===== TAB 1: СКЛАД ===== -->
                    <div class="order-extra-rows table-1 active">
                        <div class="extra-row">
                            <div class="table-cell">Позиція</div>
                            <div class="table-cell">К-сть</div>
                            <div class="table-cell">Ціна</div>
                            <div class="table-cell">Сума</div>
                        </div>

                        <div class="extra-row">
                            <div class="table-cell">Вікно Euro-Design 70 (Siegenia Titan AF)</div>
                            <div class="table-cell">2</div>
                            <div class="table-cell">₴51 200</div>
                            <div class="table-cell">
                                ₴14 400
                                <div class="table-cell-content active">
                                    <p>Знижка:</p>
                                    <span>₴1 000 000</span>
                                </div>
                            </div>
                        </div>

                        <div class="extra-row">
                            <div class="table-cell">Розширювач 40/70</div>
                            <div class="table-cell">1</div>
                            <div class="table-cell">₴400</div>
                            <div class="table-cell">
                                ₴14 400
                                <div class="table-cell-content">
                                    <p>Знижка:</p>
                                    <span>—</span>
                                </div>
                            </div>
                        </div>

                        <div class="extra-row">
                            <div class="table-cell">Розширювач 40/70</div>
                            <div class="table-cell">1</div>
                            <div class="table-cell">₴400</div>
                            <div class="table-cell">
                                ₴14 400
                                <div class="table-cell-content">
                                    <p>Знижка:</p>
                                    <span>—</span>
                                </div>
                            </div>
                        </div>

                        <div class="extra-row">
                            <div class="table-cell">Балконні двері Euro-Design 70 (Siegenia Titan AF)</div>
                            <div class="table-cell">1</div>
                            <div class="table-cell">₴14 400</div>
                            <div class="table-cell">
                                ₴14 400
                                <div class="table-cell-content active">
                                    <p>Знижка:</p>
                                    <span>₴500</span>
                                </div>
                            </div>
                        </div>

                        <div class="extra-row">
                            <div class="table-cell">Проміжний підсумок</div>
                            <div class="table-cell"></div>
                            <div class="table-cell"></div>
                            <div class="table-cell">₴74 400</div>
                        </div>

                        <div class="extra-row">
                            <div class="table-cell">Знижки</div>
                            <div class="table-cell"></div>
                            <div class="table-cell"></div>
                            <div class="table-cell active">
                                <span class="total-discount">— ₴1 500</span>
                            </div>
                        </div>

                        <div class="extra-row">
                            <div class="table-cell"></div>
                            <div class="table-cell"></div>
                            <div class="table-cell"></div>
                            <div class="table-cell">
                                <span class="total-amount">₴72 900</span>
                            </div>
                        </div>
                    </div>

                    <!-- ===== TAB 2: ТЕХ ХАР-КИ ===== -->
                    <div class="order-extra-rows table-2">
                        <div class="extra-row">
                            <div class="table-cell">Позиція</div>
                            <div class="table-cell">W, mm</div>
                            <div class="table-cell">H, mm</div>
                            <div class="table-cell">S, cm2</div>
                            <div class="table-cell">Вага, кг</div>
                        </div>

                        <div class="extra-row">
                            <div class="table-cell">Вікно Euro-Design 70 (Siegenia Titan AF)</div>
                            <div class="table-cell">1300</div>
                            <div class="table-cell">1300</div>
                            <div class="table-cell">—</div>
                            <div class="table-cell">83,46</div>
                        </div>

                        <div class="extra-row">
                            <div class="table-cell">Розширювач 40/70</div>
                            <div class="table-cell">—</div>
                            <div class="table-cell">—</div>
                            <div class="table-cell">—</div>
                            <div class="table-cell">3,149</div>
                        </div>

                        <div class="extra-row">
                            <div class="table-cell">Розширювач 40/70</div>
                            <div class="table-cell">—</div>
                            <div class="table-cell">—</div>
                            <div class="table-cell">—</div>
                            <div class="table-cell">3,149</div>
                        </div>

                        <div class="extra-row">
                            <div class="table-cell">Балконні двері Euro-Design 70 (Siegenia Titan AF)</div>
                            <div class="table-cell">578</div>
                            <div class="table-cell">2680</div>
                            <div class="table-cell">—</div>
                            <div class="table-cell">70,767</div>
                        </div>
                    </div>

                    <!-- ===== TAB 3: ФАЙЛЫ ===== -->
                    <div class="order-extra-rows table-3">
                        <div class="extra-row">
                            <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" />
                            <div class="table-cell">
                                <span>Специфікація.pdf</span>
                                <p>245 KB</p>
                            </div>
                        </div>

                        <div class="extra-row">
                            <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" />
                            <div class="table-cell">
                                <span>Замірні листи.xlsx</span>
                                <p>89 KB</p>
                            </div>
                        </div>

                        <div class="extra-row">
                            <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" />
                            <div class="table-cell">
                                <span>Фото проекту.jpg</span>
                                <p>1.2 MB</p>
                            </div>
                        </div>

                        <div class="extra-row">
                            <img src="{{ asset("themes/$theme/images/upload-cloud.svg") }}" />
                            <p>Drag & drop file here or <a href="#">choose file</a></p>
                        </div>
                    </div>

                    <!-- ===== TAB 4: ИСТОРИЯ ===== -->
                    <div class="order-extra-rows table-4">
                        <div class="extra-row">
                            <img src="{{ asset("themes/$theme/images/info.svg") }}" />
                            <div class="table-cell">
                                <span>Статус змінено на "Виробництво"</span>
                                <p>Іванов О.М. · 15.08.2025 14:30</p>
                            </div>
                        </div>

                        <div class="extra-row">
                            <img src="{{ asset("themes/$theme/images/info.svg") }}" />
                            <div class="table-cell">
                                <span>Платіж підтверджено — ₴56 000</span>
                                <p>Петров С.В. · 10.08.2025 11:20</p>
                            </div>
                        </div>

                        <div class="extra-row">
                            <img src="{{ asset("themes/$theme/images/info.svg") }}" />
                            <div class="table-cell">
                                <span>Замовлення створено</span>
                                <p>Система · 08.08.2025 16:45</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- WinDraw -->
        <div class="WinDraw-content">
            <div class="WinDraw-header">
                <h1>WinDraw</h1>
            </div>
            <div class="WinDraw-bottom-content">
                <div class="WinDraw-card">
                    <img
                        src="images/Loading WinDraw.svg"
                        alt="Icon"
                        class="WinDraw-card-icon"
                    />

                    <p class="WinDraw-title">З'єднуємо з WinDraw…</p>
                    <p class="WinDraw-text">
                        Виконуємо захищений вхід. Це займе кілька секунд.
                    </p>

                    <div class="WinDraw-progress-bar">
                        <div class="WinDraw-progress"></div>
                        <div class="WinDraw-bar"></div>
                    </div>
                    <p class="WinDraw-footer-text">Не закривайте сторінку</p>
                </div>

                <!-- WinDraw Successful-->
                <div class="WinDraw-card">
                    <img
                        src="images/WinDraw Successful.svg"
                        alt="Icon"
                        class="WinDraw-card-icon"
                    />

                    <p class="WinDraw-title">Успішний вхід</p>
                    <p class="WinDraw-text">Перенаправляємо до WinDraw…</p>

                    <button class="WinDraw-footer-button">Відкрити зараз</button>
                </div>

                <!-- WinDraw Error-->
                <div class="WinDraw-card">
                    <img
                        src="images/WinDraw Error.svg"
                        alt="Icon"
                        class="WinDraw-card-icon"
                    />

                    <p class="WinDraw-title">Не вдалося увійти</p>
                    <p class="WinDraw-text">
                        Щось пішло не так. Спробуйте ще раз або перевірте статус сервісу.
                    </p>

                    <button class="WinDraw-footer-button">Повторити</button>
                    <p class="WinDraw-footer-text">Повернутися на дашборд</p>
                </div>

                <!-- WinDraw Closed-->
                <div class="WinDraw-card">
                    <img
                        src="images/WinDraw Closed.svg"
                        alt="Icon"
                        class="WinDraw-card-icon"
                    />

                    <p class="WinDraw-title">Немає доступу до WinDraw</p>
                    <p class="WinDraw-text">
                        Ваш акаунт не підключено до WinDraw. Зверніться до менеджера
                        Darwin.
                    </p>

                    <button class="WinDraw-footer-button">Запросити доступ</button>
                    <p class="WinDraw-footer-text">Повернутися на дашборд</p>
                </div>
            </div>
        </div>
        <!-- Акції -->
        <div class="promo-block">
            <div class="promo-block-content">
                <img
                    src="images/Development, idea, keyboard.svg"
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
<script src="{{ asset("themes/$theme/js/order-tracking.js") }}"></script>
<script>
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

    document.addEventListener('DOMContentLoaded', () => {
        const openBtn  = document.getElementById('invoiceOpenBtn');
        const popup    = document.getElementById('invoicePopup');
        const overlay  = document.getElementById('invoiceOverlay');
        const closeBtn = document.getElementById('invoiceCloseBtn');
        const cancelBtn = document.querySelector('.invoice-request-btn-cancel');

        if (!openBtn || !popup || !overlay) {
            console.warn('Invoice popup elements not found');
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

        openBtn.addEventListener('click', openPopup);
        overlay.addEventListener('click', closePopup);

        closeBtn?.addEventListener('click', closePopup);
        cancelBtn?.addEventListener('click', closePopup);
    });

    document.addEventListener('DOMContentLoaded', () => {

        // 1. Само всплывающее окно с действиями
        const popup = document.querySelector('.table-popup-order');

        if (!popup) {
            console.error('❌ .table-popup-order не найден');
            return;
        }

        // 2. Все кнопки с тремя точками
        document.querySelectorAll('.action-icon').forEach(icon => {

            icon.addEventListener('click', (e) => {
                e.stopPropagation();

                const rect = icon.getBoundingClientRect();

                popup.style.position = 'fixed';
                popup.style.zIndex = '9999';
                popup.style.top  = (rect.bottom + 6) + 'px';
                popup.style.left = (rect.right - 180) + 'px';

                popup.classList.add('active');
            });

        });

        // 3. Закрытие по клику вне
        document.addEventListener('click', () => {
            popup.classList.remove('active');
        });

    });
    document.addEventListener('DOMContentLoaded', () => {

        let currentOrderId = null;

        const actionsPopup   = document.querySelector('.table-popup-order');
        const detailsModal   = document.querySelector('.order-details');
        const detailsOverlay = document.querySelector('.order-details-overlay');

        // 1. Клик по ⋮ — запоминаем ID
        document.querySelectorAll('.action-icon').forEach(icon => {
            icon.addEventListener('click', () => {
                currentOrderId = icon.dataset.orderId;
            });
        });

        // 2. Клик по "Деталі замовлення"
        const detailsBtn = actionsPopup.querySelector('.table-popup-item');

        // 2.2 Кнопка "Створити/Відкрити рахунок" (ВТОРОЙ пункт)
        const invoiceBtn = actionsPopup.querySelectorAll('.table-popup-item')[1];

        const invoicePopup  = document.getElementById('invoicePopup');
        const invoiceOverlay = document.getElementById('invoiceOverlay');

        invoiceBtn.addEventListener('click', async () => {
            if (!currentOrderId) return;

            try {
                // получаем данные заказа
                const response = await fetch(`/cabinet/orders/${currentOrderId}/details`);
                const order = await response.json();

                // 👉 подставляем сумму в форму счета (минимум)
                const amountInput = invoicePopup.querySelector('.invoice-request-input');
                if (amountInput) {
                    amountInput.value = order.amount;
                }

                // закрываем popup ⋮
                actionsPopup.classList.remove('active');

                // открываем модалку счета
                invoicePopup.classList.add('active');
                invoiceOverlay.classList.add('active');

            } catch (e) {
                console.error('Ошибка загрузки заказа для счета', e);
            }
        });


        detailsBtn.addEventListener('click', async () => {
            if (!currentOrderId) return;

            try {
                // 🔴 ВОТ ТУТ БЫЛА ОШИБКА
                const response = await fetch(`/cabinet/orders/${currentOrderId}/details`);
                const data = await response.json();

                fillOrderDetails(data.order);
                renderOrderComposition(data.items);
                renderOrderTech(data.items);


                actionsPopup.classList.remove('active');
                detailsModal.classList.add('active');
                detailsOverlay.classList.add('active');

            } catch (e) {
                console.error('Ошибка загрузки заказа', e);
            }
        });

        // 3. Закрытие
        detailsOverlay.addEventListener('click', closeDetails);
        document.querySelector('.order-close')?.addEventListener('click', closeDetails);

        function closeDetails() {
            detailsModal.classList.remove('active');
            detailsOverlay.classList.remove('active');
        }

        // 4. Заполнение данных
        function fillOrderDetails(order) {
            setField('order_number', order.order_number);
            setField('created_at', formatDate(order.created_at));
            setField('client', order.client);
            setField('address', order.address);
            setField('status_1c', order.status_1c);
            setField('amount', '₴ ' + Number(order.amount).toLocaleString('uk-UA'));
        }

        function setField(name, value) {
            const el = detailsModal.querySelector(`[data-field="${name}"]`);
            if (el) el.textContent = value ?? '—';
        }

        function formatDate(dateStr) {
            return new Date(dateStr).toLocaleDateString('uk-UA');
        }

    });
</script>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', () => {

        let currentOrderId = null;

        const actionsPopup   = document.querySelector('.table-popup-order');
        const invoicePopup   = document.getElementById('invoicePopup');
        const invoiceOverlay = document.getElementById('invoiceOverlay');

        // ================================
        // 1. Запоминаем ID заказа при клике на ⋮
        // ================================
        document.querySelectorAll('.action-icon').forEach(icon => {
            icon.addEventListener('click', () => {
                currentOrderId = icon.dataset.orderId;
            });
        });

        // ================================
        // 2. Кнопка "Створити / Відкрити рахунок"
        // ================================
        const invoiceBtn = actionsPopup
            ?.querySelectorAll('.table-popup-item')[1];

        if (!invoiceBtn) {
            console.warn('Кнопка счета не найдена');
            return;
        }

        invoiceBtn.addEventListener('click', async () => {
            if (!currentOrderId) return;

            try {
                const response = await fetch(
                    `/cabinet/orders/${currentOrderId}/invoice-data`
                );

                if (!response.ok) {
                    throw new Error('Ошибка загрузки данных');
                }

                const data = await response.json();

                fillInvoiceForm(data);

                // закрываем popup ⋮
                actionsPopup.classList.remove('active');

                // открываем модалку счета
                invoicePopup.classList.add('active');
                invoiceOverlay.classList.add('active');

            } catch (e) {
                console.error('Ошибка загрузки счета:', e);
            }
        });

        // ================================
        // 3. Закрытие модалки счета
        // ================================
        invoiceOverlay?.addEventListener('click', closeInvoice);
        document
            .querySelector('.invoice-request-btn-cancel')
            ?.addEventListener('click', closeInvoice);

        document
            .querySelector('.invoice-request-close')
            ?.addEventListener('click', closeInvoice);

        function closeInvoice() {
            invoicePopup.classList.remove('active');
            invoiceOverlay.classList.remove('active');
        }

        // ================================
        // 4. Заполнение формы
        // ================================
        function fillInvoiceForm(data) {
            const { user, order } = data;

            const amount = Number(order.amount) || 0;

            // ===== ПРОСТАЯ ЛОГИКА =====
            const marginPercent = 15; // 15%
            const margin = amount * marginPercent / 100;
            const totalAmount = amount;

            // ===== ЗАПОЛНЕНИЕ ПОЛЕЙ =====
            setValue('company_name', user.company_name);
            setValue('edrpou', user.edrpou);
            setValue('contact_name', user.contact_name);
            setValue('phone', user.phone);
            setValue('email', user.email);
            setValue('amount', amount.toFixed(2));
            setValue('order_id', order.id);

            setCheckboxPair('is_vat', user.is_vat);
            setCheckboxPair('is_budget', user.is_budget);

            // ===== МАРЖА И СУММЫ =====
            setText('margin', formatMoney(margin));
            setText('total_amount', formatMoney(totalAmount));
        }


        // ================================
        // 5. Хелперы
        // ================================
        function setValue(field, value) {
            const el = document.querySelector(`[data-field="${field}"]`);
            if (!el) return;

            if (
                value === undefined ||
                value === null ||
                value === 'undefined'
            ) {
                el.value = '';
            } else {
                el.value = value;
            }
        }


        function setText(field, value) {
            const el = document.querySelector(`[data-field="${field}"]`);
            if (el) el.textContent = value ?? '—';
        }

        function setCheckboxPair(base, value) {
            const yes = document.querySelector(`[data-field="${base}_yes"]`);
            const no  = document.querySelector(`[data-field="${base}_no"]`);

            if (!yes || !no) return;

            yes.checked = value == 1;
            no.checked  = value == 0;
        }

        function formatMoney(value) {
            return Number(value).toLocaleString('uk-UA', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + ' грн.';
        }
    });

    document.addEventListener('DOMContentLoaded', () => {

        const detailsModal = document.querySelector('.order-details');
        if (!detailsModal) return;

        const menuItems = detailsModal.querySelectorAll('.order-menu-item');
        const tabs      = detailsModal.querySelectorAll('.order-extra-rows');

        menuItems.forEach(item => {
            item.addEventListener('click', () => {

                const target = item.dataset.tab;

                // активный пункт меню
                menuItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');

                // активный таб
                tabs.forEach(tab => {
                    tab.classList.toggle('active', tab.classList.contains(target));
                });

            });
        });

    });

    function renderOrderComposition(items) {
        const container = document.querySelector('.order-extra-rows.table-1');

        if (!container) return;

        container.innerHTML = `
        <div class="extra-row">
            <div class="table-cell">Позиція</div>
            <div class="table-cell">К-сть</div>
            <div class="table-cell">Ціна</div>
            <div class="table-cell">Сума</div>
        </div>
    `;

        let total = 0;

        items.forEach(item => {
            const qty   = Number(item.qty) || 1;
            const price = Number(item.price) || 0;
            const sum   = qty * price;

            total += sum;

            container.innerHTML += `
            <div class="extra-row">
                <div class="table-cell">${item.name}</div>
                <div class="table-cell">${qty}</div>
                <div class="table-cell">₴${price.toLocaleString('uk-UA')}</div>
                <div class="table-cell">₴${sum.toLocaleString('uk-UA')}</div>
            </div>
        `;
        });

        container.innerHTML += `
        <div class="extra-row">
            <div class="table-cell"><b>Разом</b></div>
            <div class="table-cell"></div>
            <div class="table-cell"></div>
            <div class="table-cell"><b>₴${total.toLocaleString('uk-UA')}</b></div>
        </div>
    `;
    }
    function renderOrderTech(items) {
        const container = document.querySelector('.order-extra-rows.table-2');

        if (!container) return;

        container.innerHTML = `
        <div class="extra-row">
            <div class="table-cell">Позиція</div>
            <div class="table-cell">W</div>
            <div class="table-cell">H</div>
            <div class="table-cell">S</div>
            <div class="table-cell">Вага</div>
        </div>
    `;

        items.forEach(item => {
            container.innerHTML += `
            <div class="extra-row">
                <div class="table-cell">${item.name}</div>
                <div class="table-cell">${item.width ?? '—'}</div>
                <div class="table-cell">${item.height ?? '—'}</div>
                <div class="table-cell">${item.area ?? '—'}</div>
                <div class="table-cell">${item.weight ?? '—'}</div>
            </div>
        `;
        });
    }

</script>
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
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const submitBtn = document.querySelector('.invoice-request-btn-submit');
        if (!submitBtn) return;

        submitBtn.addEventListener('click', async () => {

            const payload = {
                order_id: getValue('order_id'),
                company_name: getValue('company_name'),
                edrpou: getValue('edrpou'),
                contact_name: getValue('contact_name'),
                phone: getValue('phone'),
                email: getValue('email'),
                amount: getValue('amount'),

                // существующие
                install:  getCheckbox('install_yes'),
                contract: getCheckbox('contract_yes'),

                // 🔑 ВАЖНО — новые поля
                ПлатникПДВ: getCheckbox('is_vat_yes'),
                Бюджет:    getCheckbox('is_budget_yes'),
            };
            if (
                !payload.company_name ||
                payload.company_name === 'undefined'
            ) {
                payload.company_name = payload.contact_name || '';
            }


            console.group('📤 Invoice → Laravel → 1C');
            console.log('📦 Payload:', payload);
            console.log('🌐 URL:', "{{ route('cabinet.invoice.create') }}");

            try {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Відправка…';

                const response = await fetch(
                    "{{ route('cabinet.invoice.create') }}",
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    }
                );

                console.log('📡 HTTP status:', response.status);

                const rawText = await response.text();
                console.log('📄 Raw response:', rawText);

                let data;
                try {
                    data = JSON.parse(rawText);
                } catch (e) {
                    console.error('❌ JSON parse error', e);
                    throw new Error('Ответ не JSON');
                }

                console.log('📥 Parsed JSON:', data);

                if (!response.ok || data.status !== 200) {
                    console.error('❌ Ошибка от сервера', data);
                    throw new Error(data.message || 'Помилка створення рахунку');
                }

                console.log('✅ Счёт создан в 1С:', data);

                alert(`Рахунок створено в 1С\nНомер: ${data.номер}`);

                document.getElementById('invoicePopup')?.classList.remove('active');
                document.getElementById('invoiceOverlay')?.classList.remove('active');

            } catch (e) {
                console.error('🔥 Exception:', e);
                alert('Помилка при створенні рахунку (див. консоль)');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Відправити';
                console.groupEnd();
            }
        });

        // ===== helpers =====
        function getValue(field) {
            return document.querySelector(`[data-field="${field}"]`)?.value ?? '';
        }

        function getCheckbox(field) {
            return document.querySelector(`[data-field="${field}"]`)?.checked ?? false;
        }

    });

    function bindYesNoPair(base) {
        const yes = document.querySelector(`[data-field="${base}_yes"]`);
        const no  = document.querySelector(`[data-field="${base}_no"]`);

        if (!yes || !no) return;

        yes.addEventListener('change', () => {
            if (yes.checked) no.checked = false;
        });

        no.addEventListener('change', () => {
            if (no.checked) yes.checked = false;
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        bindYesNoPair('is_vat');
        bindYesNoPair('is_budget');
        bindYesNoPair('install');
        bindYesNoPair('contract');
    });

</script>












