@extends('admin.index')

@section('title', 'Фінанси')

@section('content')
    @php
        function sortUrl($column) {
            $currentSort = request('sort');
            $currentDir  = request('direction', 'asc');

            $dir = ($currentSort === $column && $currentDir === 'asc') ? 'desc' : 'asc';

            return request()->fullUrlWithQuery([
                'sort' => $column,
                'direction' => $dir,
            ]);
        }
    @endphp

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

        /* ===== DATE RANGE POPUP ===== */

        .finances-date-wrapper {
            position: relative;
        }

        .table-popup-sort.date-range-popup {
            position: absolute;
            top: calc(100% + 6px);   /* ровно под кнопкой */
            right: 0;               /* выравнивание по правому краю */
            min-width: 180px;

            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 8px;

            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            padding: 6px 0;

            z-index: 2000;
        }

        /* пункты */
        .table-popup-sort.date-range-popup span {
            display: block;
            padding: 8px 14px;

            font-size: 14px;
            color: #333;
            cursor: pointer;
            white-space: nowrap;
        }

        /* hover */
        .table-popup-sort.date-range-popup span:hover {
            background: #f5f7fa;
        }

        /* активное состояние (по желанию) */
        .table-popup-sort.date-range-popup span.active {
            background: #eef4ff;
            font-weight: 500;
        }


        .table-popup-sort {
            display: none;
            position: absolute;
            background: #fff;
            border: 1px solid #ddd;
            z-index: 1000;
        }

        .table-popup-sort.active {
            display: block;
        }


        .finances-table {
            width: 100%;
            table-layout: fixed;
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

        /* === Pagination buttons: чёрные, без подчёркивания === */
        .footer-btn-group a.footer-btn,
        .footer-btn-group a.footer-btn:link,
        .footer-btn-group a.footer-btn:visited,
        .footer-btn-group a.footer-btn:hover,
        .footer-btn-group a.footer-btn:active {
            color: #000 !important;        /* чёрный текст */
            text-decoration: none !important; /* убрать подчёркивание */
        }

        /* Активная страница (зелёная) */
        .footer-btn-group .active-page {
            color: #000 !important;
            text-decoration: none !important;
        }

        /* Disabled */
        .footer-btn-group .footer-btn[disabled],
        .footer-btn-group .footer-btn.disabled {
            color: #aaa !important;
            text-decoration: none !important;
            cursor: not-allowed;
        }


    </style>
<div class="container">
    <div class="left-column">
        <div class="left-bottom">
            <h3>Головне</h3>
            <ul class="menu">
                <li class="{{ ($defaultPage ?? '') === 'profile' ? 'active' : '' }}">
                    <a href="{{ route('cabinet.profile', ['theme' => $theme]) }}">
                        <img src="{{ asset("themes/$theme/images/user.svg") }}" class="icon-img" alt="User">
                        Профіль дилера апрапрап
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
        <!-- Фінанси -->
        <div class="finances-container active">

        <!-- Заголовок -->
            <div class="finances-header">
                <div class="tracking-order-header">
                    <h1>&nbsp;&nbsp;Фiнанси</h1>
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

            </div>
            <!-- Нижний блок -->
            <div class="finances-panel">
                <!-- Внутренний контент сюда -->
                <div class="finances-panel-head">
                    <h2 class="finances-subtitle">Акт звірки</h2>

                    <div class="finances-actions">
                        <form method="GET" action="{{ route('cabinet.finances.export') }}">
                            {{-- сохраняем текущий диапазон дат --}}
                            <input type="hidden" name="date_range" value="{{ $currentRange ?? 'all' }}">

                            {{-- сохраняем остальные GET-параметры --}}
                            @foreach(request()->except('page') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach

                            <button type="submit" class="finances-btn">
                                <img
                                    src="{{ asset("themes/$theme/images/Upload.svg") }}"
                                    alt=""
                                    class="btn-icon"
                                    aria-hidden="true"
                                />
                                <p class="btn-text">Експорт (XLSX)</p>
                            </button>
                        </form>

                        <div class="finances-date-wrapper" style="position: relative;">

                            <form method="GET" class="date-range-form">
                                <input
                                    type="hidden"
                                    name="date_range"
                                    class="date-range-input"
                                    value="{{ $currentRange ?? 'all' }}"
                                >

                                @foreach(request()->except('date_range','page') as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach

                                <button type="button" class="finances-btn finances-date-btn date-range-btn">
                                    <img src="{{ asset("themes/$theme/images/calendar-dots.svg") }}" class="btn-icon">
                                    <p class="btn-text">
                                        {{ $rangeLabels[$currentRange] ?? 'За весь час' }}
                                    </p>
                                    <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" class="btn-icon-right">
                                </button>
                            </form>

                            <div class="table-popup table-popup-sort date-range-popup">
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
                </div>

                <div class="finances-cards">

                    <div class="finances-card finances-card--green">
                        <p class="card-text">Початковий баланс</p>
                        <span class="card-value">₴{{ number_format($startBalance, 0, ',', ' ') }}</span>
                        <img src="{{ asset("themes/$theme/images/Green checkmark box.svg") }}" class="card-icon">
                    </div>

                    <div class="finances-card finances-card--blue">
                        <p class="card-text">Нараховано (рахунки)</p>
                        <span class="card-value">₴{{ number_format($accrued, 0, ',', ' ') }}</span>
                        <img src="{{ asset("themes/$theme/images/Blue checkmark box.svg") }}" class="card-icon">
                    </div>

                    <div class="finances-card finances-card--orange">
                        <p class="card-text">Оплачено / списано</p>
                        <span class="card-value">₴{{ number_format($paid, 0, ',', ' ') }}</span>
                        <img src="{{ asset("themes/$theme/images/Orange checkmark box.svg") }}" class="card-icon">
                    </div>

                    <div class="finances-card finances-card--purple">
                        @if($debt > 0)
                            <p class="card-text">Борг</p>
                            <span class="card-value text-danger">
        ₴{{ number_format($debt, 0, ',', ' ') }}
    </span>
                        @else
                            <p class="card-text">Аванс залишок</p>
                            <span class="card-value text-success">
        ₴{{ number_format($overpayment, 0, ',', ' ') }}
    </span>
                        @endif

                        <img src="{{ asset("themes/$theme/images/Purple checkmark box.svg") }}" class="card-icon">
                    </div>
                </div>
                <div class="finances-table-wrapper">
                    <div class="finances-table-scroll">
                        <table class="finances-table">
                            <thead>
                            <tr>
                                <th>
                                    <a href="{{ sortUrl('created_at') }}" class="th-sort">
                                        Дата
                                        <img
                                            src="{{ asset("themes/$theme/images/" . (request('sort') === 'created_at' && request('direction') === 'asc'
                    ? 'Arrow-Up.svg'
                    : 'Arrow-Down.svg')) }}"
                                            class="th-icon"
                                        />
                                    </a>
                                </th>

                                <th>
                                    <a href="{{ sortUrl('order_name') }}" class="th-sort">
                                        № Замовлення
                                        <img
                                            src="{{ asset("themes/$theme/images/" . (request('sort') === 'order_name' && request('direction') === 'asc'
                    ? 'Arrow-Up.svg'
                    : 'Arrow-Down.svg')) }}"
                                            class="th-icon"
                                        />
                                    </a>
                                </th>

                                <th>
{{--        <span class="th-sort th-disabled">--}}
{{--            Етап--}}
{{--        </span>--}}
                                </th>
                                <th>
                                    <a href="{{ sortUrl('last_payment_at') }}" class="th-sort">
                                        Дата оплати
                                        <img
                                            src="{{ asset("themes/$theme/images/" . (request('sort') === 'last_payment_at' && request('direction') === 'asc'
                    ? 'Arrow-Up.svg'
                    : 'Arrow-Down.svg')) }}"
                                            class="th-icon"
                                        />
                                    </a>
                                </th>

                                <th>
                                    <a href="{{ sortUrl('credit') }}" class="th-sort">
                                        Оплата
                                        <img
                                            src="{{ asset("themes/$theme/images/" . (request('sort') === 'credit' && request('direction') === 'asc'
                    ? 'Arrow-Up.svg'
                    : 'Arrow-Down.svg')) }}"
                                            class="th-icon"
                                        />
                                    </a>
                                </th>

                                <th>
                                    <a href="{{ sortUrl('order_amount') }}" class="th-sort">
                                        Сума замовл.
                                        <img
                                            src="{{ asset("themes/$theme/images/" . (request('sort') === 'order_amount' && request('direction') === 'asc'
                    ? 'Arrow-Up.svg'
                    : 'Arrow-Down.svg')) }}"
                                            class="th-icon"
                                        />
                                    </a>
                                </th>

{{--                                <th>--}}
{{--                                    <a href="{{ sortUrl('margin') }}" class="th-sort">--}}
{{--                                        Маржа--}}
{{--                                        <img--}}
{{--                                            src="{{ asset("themes/$theme/images/" . (request('sort') === 'margin' && request('direction') === 'asc'--}}
{{--                    ? 'Arrow-Up.svg'--}}
{{--                    : 'Arrow-Down.svg')) }}"--}}
{{--                                            class="th-icon"--}}
{{--                                        />--}}
{{--                                    </a>--}}
{{--                                </th>--}}

                            </tr>
                            </thead>

                        @forelse($rows as $row)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d.m.Y') }}</td>

                                    <td>{{ $row->order_name }}</td>
                                    <td>
                                        <button data-type="{{ $row->credit > 0 ? 'Payment' : 'Score' }}">
                                            {{ $row->credit > 0 ? 'Оплата' : 'Рахунок' }}
                                        </button>
                                    </td>
                                    <td>
                                        {{ $row->last_payment_at
                                            ? \Carbon\Carbon::parse($row->last_payment_at)->format('d.m.Y')
                                            : '—' }}
                                    </td>
                                    <td>
                                        {{ $row->credit > 0
                                            ? number_format($row->credit, 0, '', ' ')
                                            : '—' }}
                                    </td>
                                    <td>{{ number_format($row->order_amount, 0, '', ' ') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align:center;">Дані відсутні</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                    @if ($rows->hasPages())
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
                                                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                                            </select>
                                        </div>

                                        {{-- сохраняем остальные GET-параметры --}}
                                        @foreach(request()->except('per_page', 'page') as $key => $value)
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endforeach
                                    </form>
                                </div>
                            </div>

                            <!-- Правая часть -->
                            <div class="footer-table-right">
                                <div class="footer-pagination-wrapper">
                                    <div class="footer-btn-group">

                                        {{-- Назад --}}
                                        @if ($rows->onFirstPage())
                                            <button class="footer-btn prev" disabled>
                                                <img src="{{ asset("themes/$theme/images/Left-arrow.svg") }}" class="nav-icon" />
                                                <span class="disabled-text">Попередня</span>
                                            </button>
                                        @else
                                            <a href="{{ $rows->previousPageUrl() }}" class="footer-btn prev">
                                                <img src="{{ asset("themes/$theme/images/Left-arrow.svg") }}" class="nav-icon" />
                                                <span>Попередня</span>
                                            </a>
                                        @endif

                                        {{-- Номера страниц --}}
                                        @foreach ($rows->getUrlRange(1, $rows->lastPage()) as $page => $url)
                                            @if ($page == $rows->currentPage())
                                                <button class="footer-btn active-page">{{ $page }}</button>
                                            @else
                                                <a href="{{ $url }}" class="footer-btn">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        {{-- Вперёд --}}
                                        @if ($rows->hasMorePages())
                                            <a href="{{ $rows->nextPageUrl() }}" class="footer-btn next">
                                                <span>Наступна</span>
                                                <img src="{{ asset("themes/$theme/images/Arrow.svg") }}" class="nav-icon" />
                                            </a>
                                        @else
                                            <button class="footer-btn next" disabled>
                                                <span>Наступна</span>
                                                <img src="{{ asset("themes/$theme/images/Arrow.svg") }}" class="nav-icon" />
                                            </button>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif


                </div>
            </div>
{{--            <div class="finances-panel">--}}
{{--                <div class="finances-panel-head">--}}
{{--                    <h2 class="finances-subtitle">Стан оплат по замовленнях</h2>--}}
{{--                    @php--}}
{{--                        $rangeLabels = [--}}
{{--                            'all' => 'За весь час',--}}
{{--                            '1'   => 'За сьогодні',--}}
{{--                            '7'   => 'За 7 днів',--}}
{{--                            '30'  => 'За 30 днів',--}}
{{--                            '90'  => 'За 90 днів',--}}
{{--                            '180' => 'За 180 днів',--}}
{{--                            '365' => 'За рік',--}}
{{--                        ];--}}
{{--                    @endphp--}}


{{--                    <div class="finances-date-wrapper" style="position: relative;">--}}

{{--                        <form method="GET" class="date-range-form">--}}
{{--                            <input--}}
{{--                                type="hidden"--}}
{{--                                name="date_range"--}}
{{--                                class="date-range-input"--}}
{{--                                value="{{ $currentRange }}"--}}
{{--                            >--}}

{{--                            @foreach(request()->except('date_range','page') as $key => $value)--}}
{{--                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">--}}
{{--                            @endforeach--}}

{{--                            <button type="button" class="finances-btn finances-date-btn date-range-btn">--}}
{{--                                <img src="{{ asset("themes/$theme/images/calendar-dots.svg") }}" class="btn-icon">--}}
{{--                                <p class="btn-text">{{ $rangeLabels[$currentRange] ?? 'За весь час' }}</p>--}}
{{--                                <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" class="btn-icon-right">--}}
{{--                            </button>--}}
{{--                        </form>--}}

{{--                        <div class="table-popup table-popup-sort date-range-popup">--}}
{{--                            <span data-days="all">За весь час</span>--}}
{{--                            <span data-days="1">За сьогодні</span>--}}
{{--                            <span data-days="7">За 7 днів</span>--}}
{{--                            <span data-days="30">За 30 днів</span>--}}
{{--                            <span data-days="90">За 90 днів</span>--}}
{{--                            <span data-days="180">За 180 днів</span>--}}
{{--                            <span data-days="365">За рік</span>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--                <div class="finances-cards finances-cards--three">--}}
{{--                    <div class="finances-card finances-card--green">--}}
{{--                        <p class="card-text">Передплата (аванс)</p>--}}
{{--                        <span class="card-value">₴500 000</span>--}}
{{--                        <img--}}
{{--                            src="{{ asset("themes/$theme/images/Green checkmark box.svg") }}"--}}
{{--                            alt=""--}}
{{--                            class="card-icon"--}}
{{--                        />--}}
{{--                    </div>--}}

{{--                    <div class="finances-card finances-card--blue">--}}
{{--                        <p class="card-text">--}}
{{--                            Загальний борг по замовленнях (в роботі та відвантажених)--}}
{{--                        </p>--}}
{{--                        <span class="card-value">₴1 200 000</span>--}}
{{--                        <img--}}
{{--                            src="{{ asset("themes/$theme/images/Blue checkmark box.svg") }}"--}}
{{--                            alt=""--}}
{{--                            class="card-icon"--}}
{{--                        />--}}
{{--                    </div>--}}

{{--                    <div class="finances-card finances-card--orange">--}}
{{--                        <p class="card-text">Борг по відвантаженим замовленням</p>--}}
{{--                        <span class="card-value">₴300 000</span>--}}
{{--                        <img--}}
{{--                            src="{{ asset("themes/$theme/images/Orange checkmark box.svg") }}"--}}
{{--                            alt=""--}}
{{--                            class="card-icon"--}}
{{--                        />--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="finances-table-wrapper finances-table-wrapper-simple">--}}
{{--                    <table class="finances-table">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                        <span class="th-sort">--}}
{{--                          Дата створення--}}
{{--                          <img--}}
{{--                              src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}"--}}
{{--                              alt=""--}}
{{--                              class="th-icon"--}}
{{--                          />--}}
{{--                        </span>--}}
{{--                            </th>--}}
{{--                            <th>№ Замовлення</th>--}}
{{--                            <th>Сума передплати (аванс)</th>--}}
{{--                            <th>Борг загальний</th>--}}
{{--                            <th>Борг по відвантаженим</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @forelse($ordersSummary as $row)--}}
{{--                            <tr>--}}
{{--                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d.m.Y') }}</td>--}}

{{--                                <td>{{ $row->order_name }}</td>--}}

{{--                                --}}{{-- Оплачено всего (деньги + взаимозачёт) --}}
{{--                                <td>{{ number_format($row->paid_total, 0, '', ' ') }}</td>--}}

{{--                                --}}{{-- Реальный долг по заказу --}}
{{--                                <td class="debt">{{ number_format($row->total_debt, 0, '', ' ') }}</td>--}}

{{--                                --}}{{-- Пока без отдельной логики отгрузки --}}
{{--                                <td class="debt">{{ number_format($row->shipped_debt, 0, '', ' ') }}</td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                            <tr>--}}
{{--                                <td colspan="5" style="text-align:center;">Немає даних</td>--}}
{{--                            </tr>--}}
{{--                        @endforelse--}}

{{--                        </tbody>--}}

{{--                        <tfoot>--}}
{{--                        <tr>--}}

{{--                        </tr>--}}
{{--                        </tfoot>--}}
{{--                    </table>--}}
{{--                    @if ($ordersSummary->hasPages())--}}
{{--                        <div class="finances-table-summary navigation">--}}

{{--                            <!-- Левая часть -->--}}
{{--                            <div class="footer-table-left">--}}
{{--                                <div class="footer-table-pagination-wrapper">--}}
{{--                                    <span class="footer-text">Показувати</span>--}}

{{--                                    <form method="GET">--}}
{{--                                        <div class="footer-select">--}}
{{--                                            <select--}}
{{--                                                name="per_page"--}}
{{--                                                onchange="this.form.submit()"--}}
{{--                                                style="border:none; background:transparent; cursor:pointer;"--}}
{{--                                            >--}}
{{--                                                <option value="5"  {{ $perPage == 5 ? 'selected' : '' }}>5</option>--}}
{{--                                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>--}}
{{--                                                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}

{{--                                        --}}{{-- сохраняем остальные GET-параметры --}}
{{--                                        @foreach(request()->except('per_page','orders_page','page') as $key => $value)--}}
{{--                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">--}}
{{--                                        @endforeach--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Правая часть -->--}}
{{--                            <div class="footer-table-right">--}}
{{--                                <div class="footer-pagination-wrapper">--}}
{{--                                    <div class="footer-btn-group">--}}

{{--                                        --}}{{-- Назад --}}
{{--                                        @if ($ordersSummary->onFirstPage())--}}
{{--                                            <button class="footer-btn prev" disabled>--}}
{{--                                                <img src="{{ asset("themes/$theme/images/Left-arrow.svg") }}" class="nav-icon" />--}}
{{--                                                <span class="disabled-text">Попередня</span>--}}
{{--                                            </button>--}}
{{--                                        @else--}}
{{--                                            <a href="{{ $ordersSummary->previousPageUrl() }}" class="footer-btn prev">--}}
{{--                                                <img src="{{ asset("themes/$theme/images/Left-arrow.svg") }}" class="nav-icon" />--}}
{{--                                                <span>Попередня</span>--}}
{{--                                            </a>--}}
{{--                                        @endif--}}

{{--                                        --}}{{-- Номера страниц --}}
{{--                                        @foreach ($ordersSummary->getUrlRange(1, $ordersSummary->lastPage()) as $page => $url)--}}
{{--                                            @if ($page == $ordersSummary->currentPage())--}}
{{--                                                <button class="footer-btn active-page">{{ $page }}</button>--}}
{{--                                            @else--}}
{{--                                                <a href="{{ $url }}" class="footer-btn">{{ $page }}</a>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}

{{--                                        --}}{{-- Вперёд --}}
{{--                                        @if ($ordersSummary->hasMorePages())--}}
{{--                                            <a href="{{ $ordersSummary->nextPageUrl() }}" class="footer-btn next">--}}
{{--                                                <span>Наступна</span>--}}
{{--                                                <img src="{{ asset("themes/$theme/images/Arrow.svg") }}" class="nav-icon" />--}}
{{--                                            </a>--}}
{{--                                        @else--}}
{{--                                            <button class="footer-btn next" disabled>--}}
{{--                                                <span>Наступна</span>--}}
{{--                                                <img src="{{ asset("themes/$theme/images/Arrow.svg") }}" class="nav-icon" />--}}
{{--                                            </button>--}}
{{--                                        @endif--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    @endif--}}

{{--                </div>--}}
{{--            </div>--}}
            <div class="finances-panel">
                <div class="finances-panel-head">
                    <h2 class="finances-subtitle">Накопичені знижки</h2>
                    <button class="finances-btn-primary discount-writeoff-btn">Списати знижку</button>
                </div>

                <!-- Оверлей для попапа списания знижки -->
                <div class="discount-writeoff-overlay"></div>

                <!-- Попап списания знижки -->
                <div class="discount-writeoff-popup">
                    <!-- Заголовок -->
                    <div class="discount-writeoff-header">
                        <h2 class="discount-writeoff-title">Списати знижку</h2>
                        <img
                            src="{{ asset("themes/$theme/images/close.svg") }}"
                            alt="Закрити"
                            class="discount-writeoff-close"
                        />
                    </div>

                    <!-- Контент -->
                    <div class="discount-writeoff-body">
                        <!-- Поля ввода -->
                        <div class="discount-writeoff-form">
                            <div class="form-row">
                                <label class="form-label">Клієнт*</label>
                                <input
                                    type="text"
                                    class="form-input"
                                    placeholder="Введіть дані клієнта"
                                />
                            </div>

                            <div class="form-row">
                                <label class="form-label">Програма*</label>
                                <div class="form-select-wrapper">
                                    <select class="form-select">
                                        <option value="">Оберіть програму</option>
                                        <option value="program1">Програма 1</option>
                                        <option value="program2">Програма 2</option>
                                    </select>
                                    <img
                                        src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}"
                                        alt=""
                                        class="select-arrow"
                                    />
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">Сума*</label>
                                <div class="form-select-wrapper">
                                    <select class="form-select">
                                        <option value="">Оберіть суму</option>
                                        <option value="1000">₴ 1 000</option>
                                        <option value="2000">₴ 2 000</option>
                                        <option value="5000">₴ 5 000</option>
                                    </select>
                                    <img
                                        src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}"
                                        alt=""
                                        class="select-arrow"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- История выплат -->
                        <div class="discount-writeoff-history">
                            <h3 class="history-title">Історія виплат</h3>
                            <div class="history-table">
                                <div class="history-table-header">
                                    <div class="history-cell">№</div>
                                    <div class="history-cell">Дата</div>
                                    <div class="history-cell">Сума</div>
                                    <div class="history-cell">Статус</div>
                                </div>
                                <div class="history-table-row">
                                    <div class="history-cell">DWN-10452</div>
                                    <div class="history-cell">04.08.2025</div>
                                    <div class="history-cell">₴ 5 600</div>
                                    <div class="history-cell">Виплачено</div>
                                </div>
                                <div class="history-table-row">
                                    <div class="history-cell">DWN-10452</div>
                                    <div class="history-cell">04.08.2025</div>
                                    <div class="history-cell">₴ 5 600</div>
                                    <div class="history-cell">Виплачено</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Кнопки -->
                    <div class="discount-writeoff-footer">
                        <button class="discount-writeoff-btn discount-writeoff-btn-primary">
                            Провести
                        </button>
                        <button class="discount-writeoff-btn discount-writeoff-btn-cancel">
                            Скасувати
                        </button>
                    </div>
                </div>

                <div class="finances-cards finances-cards--four">
                    <div class="finances-card finances-card--green">
                        <p class="card-text">Початковий залишок</p>
                        <span class="card-value">₴12 400</span>
                        <img
                            src="{{ asset("themes/$theme/images/Green checkmark box.svg") }}"
                            alt=""
                            class="card-icon"
                        />
                    </div>

                    <div class="finances-card finances-card--blue">
                        <p class="card-text">Нараховано за період</p>
                        <span class="card-value">₴8 200</span>
                        <img
                            src="{{ asset("themes/$theme/images/Blue checkmark box.svg") }}"
                            alt=""
                            class="card-icon"
                        />
                    </div>

                    <div class="finances-card finances-card--orange">
                        <p class="card-text">Списано за період</p>
                        <span class="card-value">–₴5 600</span>
                        <img
                            src="{{ asset("themes/$theme/images/Orange checkmark box.svg") }}"
                            alt=""
                            class="card-icon"
                        />
                    </div>

                    <div class="finances-card finances-card--purple">
                        <p class="card-text">Кінцевий баланс</p>
                        <span class="card-value">₴15 000</span>
                        <img
                            src="{{ asset("themes/$theme/images/Purple checkmark box.svg") }}"
                            alt=""
                            class="card-icon"
                        />
                    </div>
                </div>

                <div class="finances-menu-actions">
                    <!-- Меню -->
                    <div class="finances-menu">
                        <div class="finances-menu-item active">Рухи</div>
                        <div class="finances-menu-item">Зведення</div>
                    </div>

                    <!-- Кнопки справа -->
                    <div class="finances-actions">
                        <button class="finances-btn">
                            <img
                                src="{{ asset("themes/$theme/images/Upload.svg") }}"
                                alt=""
                                class="btn-icon"
                                aria-hidden="true"
                            />
                            <p class="btn-text">Експорт (XLSX)</p>
                        </button>

                        <button class="finances-btn finances-date-btn">
                            <img
                                src="{{ asset("themes/$theme/images/calendar-dots.svg") }}"
                                alt=""
                                class="btn-icon"
                                aria-hidden="true"
                            />
                            <p class="btn-text">За 30 днів</p>
                            <img
                                src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}"
                                alt=""
                                class="btn-icon-right"
                                aria-hidden="true"
                            />
                        </button>

                        <!-- Выпадающий список для выбора дат -->
                        <div class="table-popup table-popup-finances-date">
                            <span class="table-popup-sort-item">За сьогодні</span>
                            <span class="table-popup-sort-item">За 7 днів</span>
                            <span class="table-popup-sort-item">За 30 днів</span>
                            <span class="table-popup-sort-item">За 90 днів</span>
                            <span class="table-popup-sort-item">За 180 днів</span>
                            <span class="table-popup-sort-item">За рік</span>
                        </div>
                    </div>
                </div>

                <div class="finances-table-wrapper finances-table-wrapper-simple">
                    <table class="finances-table">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>№ Замовлення</th>
                            <th>Статус</th>
                            <th>Тип</th>
                            <th>Клієнт</th>
                            <th>Сума, ₴</th>
                            <th>Поточний залишок, ₴</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>02.08.2025</td>
                            <td>DWN-10452</td>
                            <td>
                                <button class="status-btn" data-status="Agreed">
                                    Погоджено
                                </button>
                            </td>
                            <td>Проведено</td>
                            <td>ЖК «Парковий»</td>
                            <td class="sum minus">-₴2 400</td>
                            <td>₴12 840</td>
                        </tr>
                        <tr>
                            <td>02.08.2025</td>
                            <td>DWN-10452</td>
                            <td>
                                <button class="status-btn" data-status="Carried">
                                    Проведено
                                </button>
                            </td>
                            <td>Проведено</td>
                            <td>ЖК «Парковий»</td>
                            <td class="sum plus">+₴3 200</td>
                            <td>₴12 840</td>
                        </tr>
                        <tr>
                            <td>02.08.2025</td>
                            <td>DWN-10452</td>
                            <td>
                                <button class="status-btn" data-status="Carried">
                                    Проведено
                                </button>
                            </td>
                            <td>Проведено</td>
                            <td>ЖК «Парковий»</td>
                            <td class="sum plus">+₴3 200</td>
                            <td>₴12 840</td>
                        </tr>
                        <tr>
                            <td>02.08.2025</td>
                            <td>DWN-10452</td>
                            <td>
                                <button class="status-btn" data-status="Carried">
                                    Проведено
                                </button>
                            </td>
                            <td>Проведено</td>
                            <td>ЖК «Парковий»</td>
                            <td class="sum plus">+₴3 200</td>
                            <td>₴12 840</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>Підсумок за період</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="summary-item">
                                    <span class="label">Нараховано:</span>
                                    <span class="value accrual">₴128 400</span>
                                </div>
                                <div class="summary-item">
                                    <span class="label">Списано:</span>
                                    <span class="value written-off">₴96 200</span>
                                </div>
                            </td>
                            <td>₴35 440</td>
                        </tr>
                        </tfoot>
                    </table>
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


</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        document.querySelectorAll('.finances-date-wrapper').forEach(wrapper => {

            const btn   = wrapper.querySelector('.date-range-btn');
            const popup = wrapper.querySelector('.date-range-popup');
            const input = wrapper.querySelector('input[name="date_range"]');
            const form  = wrapper.querySelector('form');

            if (!btn || !popup || !input || !form) return;

            btn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                document.querySelectorAll('.date-range-popup.active')
                    .forEach(p => p !== popup && p.classList.remove('active'));

                popup.classList.toggle('active');
            });

            popup.querySelectorAll('[data-days]').forEach(item => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    input.value = item.dataset.days;
                    form.submit();
                });
            });
        });

        document.addEventListener('click', () => {
            document.querySelectorAll('.date-range-popup.active')
                .forEach(p => p.classList.remove('active'));
        });

    });
</script>














