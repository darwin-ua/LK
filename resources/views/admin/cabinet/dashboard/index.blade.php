@extends('admin.index')

@section('title', 'Дашбордс')

@section('content')
<div class="container">
    <style>
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

        .tracking-order-header {
            display: flex;
            align-items: center;
            width: 100%;
            gap: 16px;
        }

        .update-btn {
            margin-left: auto;
        }

        .finances-table-summary.navigation {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            background: #f5f5f5;
            border-top: 1px solid #ffffff;
            padding: 12px;
            font-size: 16px;
            font-weight: 400;
            position: sticky;
            left: 0;
            z-index: 5;
        }

        /* ===== ПАГИНАЦИЯ В ПЛАТЕЖАХ ===== */
        .table-payments .footer-btn-group a {
            color: #000 !important;           /* чёрный текст */
            text-decoration: none !important; /* без подчёркивания */
        }

        /* все состояния */
        .table-payments .footer-btn-group a:hover,
        .table-payments .footer-btn-group a:focus,
        .table-payments .footer-btn-group a:active,
        .table-payments .footer-btn-group a:visited {
            color: #000 !important;
            text-decoration: none !important;
        }

        /* активная страница (кнопка, не ссылка) */
        .table-payments .footer-btn.active-page {
            text-decoration: none !important;
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
            <!-- Дашборд-->

        <div class="tracking-order-header">
            &nbsp;<h1>&nbsp;Дашборд</h1>
            <button class="update-btn" id="updateUserActionBtn">
                &nbsp;<img src="{{ asset("themes/$theme/images/Round-arrow.svg") }}"
                     alt="Оновити"
                     class="update-icon" />

                <span class="update-text"></span>
                <span class="update-spinner hidden"></span>
            </button>
        </div>
        <div class="Dashboard-bottom-content">
            <div class="dashboard-section-cards-top">

                <div class="dashboard-card-top">
                    <div class="dashboard-card-top-texts">
                        <span class="dashboard-card-label">Усього</span>
                        <h2 class="dashboard-card-value">{{ $totalOrders }}</h2>
                        <span class="dashboard-card-subtext">Замовлень за весь період</span>
                        <span class="dashboard-card-subtext"></span>
                    </div>
                    <img src="{{ asset("themes/$theme/images/package.svg") }}"
                         alt="Іконка"
                         class="dashboard-card-top-icon">
                </div>

                <div class="dashboard-card-top">
                    <div class="dashboard-card-top-texts">
                        <span class="dashboard-card-label">В роботі</span>
                        <h2 class="dashboard-card-value">{{ $inProgressCount }}</h2>
                        <span class="dashboard-card-subtext">
                Оплата, виробництво, логістика, рекламація
            </span>
                    </div>
                    <img src="{{ asset("themes/$theme/images/flow.svg") }}"
                         alt="Іконка"
                         class="dashboard-card-top-icon">
                </div>

                <div class="dashboard-card-top">
                    <div class="dashboard-card-top-texts">
                        <span class="dashboard-card-label">Виконано</span>
                        <h2 class="dashboard-card-value">{{ $completedCount }}</h2>
                        <span class="dashboard-card-subtext">
                На суму— <span>₴{{ number_format($completedSum, 0, ',', ' ') }}</span>
            </span>
                    </div>
                    <img src="{{ asset("themes/$theme/images/pocket.svg") }}"
                         alt="Іконка"
                         class="dashboard-card-top-icon">
                </div>

                <div class="dashboard-card-top">
                    <div class="dashboard-card-top-texts">
                        <span class="dashboard-card-label">Очікує оплати</span>
                        <h2 class="dashboard-card-value">{{ $awaitingCount }}</h2>
                        <span class="dashboard-card-subtext">
                На суму — <span>₴{{ number_format($awaitingDebt, 0, ',', ' ') }}</span>
            </span>
                    </div>
                    <img src="{{ asset("themes/$theme/images/info-box.svg") }}"
                         alt="Іконка"
                         class="dashboard-card-top-icon">
                </div>

            </div>

            <div class="dashboard-section-table-payments">
                <h2>Платежі</h2>

                <div class="table-payments">

                    <div class="table-payments-rows">

                        {{-- HEADER --}}
                        <div class="table-payments-row">
                            <div class="table-cell">№ Замовлення</div>
                            <div class="table-cell">Сума замовлення</div>
                            <div class="table-cell">Оплачено</div>
                            <div class="table-cell">Статус</div>
                            <div class="table-cell">Дата</div>
                        </div>
                        @forelse($payments as $payment)
                            <div class="table-payments-row">

                                <div class="table-cell">
                                    {{ $payment->order_name ?: '—' }}
                                </div>

                                {{-- СУММА ЗАКАЗА --}}
                                <div class="table-cell">
                                    ₴{{ number_format($payment->order_amount ?? 0, 0, ',', ' ') }}
                                </div>

                                {{-- ОПЛАЧЕНО --}}
                                <div class="table-cell">
                                    {{ ($payment->paid_total ?? 0) > 0
    ? number_format($payment->paid_total, 0, ',', ' ')
    : '—'
}}

                                </div>

                                {{-- СТАТУС --}}
                                <div class="table-cell">
                                    <button class="table-finance-Status-btn
                @if($payment->status === 'paid') Paid
                @elseif($payment->status === 'partial') Partially
                @else Not-Paid
                @endif
            ">
                                        @if($payment->status === 'paid')
                                            Сплачено
                                        @elseif($payment->status === 'partial')
                                            Частково
                                        @else
                                            Не сплачено
                                        @endif
                                    </button>
                                </div>

                                {{-- ДАТА --}}
                                <div class="table-cell">
                                    {{ \Carbon\Carbon::parse($payment->date)->format('d.m.Y') }}
                                </div>

                            </div>
                        @empty
                            <div class="table-payments-row">
                                <div class="table-cell" style="grid-column: 1 / -1;">
                                    Платежів немає
                                </div>
                            </div>
                        @endforelse


                        {{-- FOOTER LINK --}}
                        <div class="table-payments-row">
                            <a  href="/cabinet/finances?theme=darwin" class="payment-link">
                                Усі платежі
                                <img src="{{ asset("themes/$theme/images/Green-arrow.svg") }}" alt="">
                            </a>
                        </div>
                        @if ($payments->hasPages())
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
                                            @if ($payments->onFirstPage())
                                                <button class="footer-btn prev" disabled>
                                                    <img src="{{ asset("themes/$theme/images/Left-arrow.svg") }}" class="nav-icon" />
                                                    <span class="disabled-text">Попередня</span>
                                                </button>
                                            @else
                                                <a href="{{ $payments->previousPageUrl() }}" class="footer-btn prev">
                                                    <img src="{{ asset("themes/$theme/images/Left-arrow.svg") }}" class="nav-icon" />
                                                    <span>Попередня</span>
                                                </a>
                                            @endif

                                            {{-- Номера страниц --}}
                                            @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                                                @if ($page == $payments->currentPage())
                                                    <button class="footer-btn active-page">{{ $page }}</button>
                                                @else
                                                    <a href="{{ $url }}" class="footer-btn">{{ $page }}</a>
                                                @endif
                                            @endforeach

                                            {{-- Вперёд --}}
                                            @if ($payments->hasMorePages())
                                                <a href="{{ $payments->nextPageUrl() }}" class="footer-btn next">
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

            </div>
            <div class="dashboard-section-table-shipment">
                <h2>Відвантаження</h2>

                <div class="table-shipment">
                    <div class="table-shipment-rows">

                        <div class="table-shipment-row">
                            <div class="table-cell">№ Замовлення</div>
                            <div class="table-cell">ЕТА</div>
                            <div class="table-cell">Статус</div>
                        </div>

                        @forelse($shipments as $shipment)

                            @php
                                $statusClass = match($shipment->status) {
                                    'Формируется' => 'Ready',
                                    'К погрузке'  => 'Delivered',
                                    'Отправлено'  => 'En-route',
                                    'Закрыто'     => 'Closed',
                                    default       => 'Ready',
                                };
                            @endphp

                            <div class="table-shipment-row">
                                <div class="table-cell">
                                    {{ $shipment->order_number }}
                                </div>

                                <div class="table-cell">
                                    {{ $shipment->eta ? \Carbon\Carbon::parse($shipment->eta)->format('d.m') : '-' }}
                                </div>

                                <div class="table-cell">
                                    <button class="table-finance-Status-btn {{ $statusClass }}">
                                        {{ $shipment->status }}
                                    </button>
                                </div>
                            </div>

                        @empty
                            <div class="table-shipment-row">
                                <div class="table-cell">Немає відвантажень</div>
                                <div class="table-cell"></div>
                                <div class="table-cell"></div>
                            </div>
                        @endforelse

                        <div class="table-shipment-row">
                            <a href=""
                               class="payment-link">
                                Уся логістика
                                <img src="{{ asset("themes/$theme/images/Green-arrow.svg") }}"
                                     alt="Green-arrow"
                                     class="msg-arrow-icon">
                            </a>
                        </div>

                    </div>
                </div>
            </div>

                    <div class="dashboard-card-motivation">
                        <!-- Верхняя часть: заголовок, подзаголовок, иконка -->
                        <div class="dashboard-card-motivation-header">
                            <div class="dashboard-card-motivation-texts">
                                <h2>Мотивація</h2>
                                <p>План/Факт ретробонусу</p>
                            </div>
                            <img src="{{ asset("themes/$theme/images/Green lightning.svg") }}" alt="Green lightning" class="dashboard-card-motivation-icon">
                        </div>

                        <!-- Прогресс бары -->
                        <div class="dashboard-card-motivation-progress">
                            <div class="progress-bar-full"></div>
                            <div class="progress-bar-empty"></div>
                        </div>

                        <!-- Нижние тексты -->
                        <div class="dashboard-card-motivation-footer">
                            <div class="progress-text-left">
                                <span>68%</span>
                                <p>виконано</p>
                            </div>
                            <div class="progress-text-right">
                                <p>до кінця місяця <span>12</span> днів</p>
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
</script>







