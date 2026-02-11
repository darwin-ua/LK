@extends('admin.index')

@section('title', 'Мотивація')

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

        <div class="partner">
            @if ($theme === 'goodwin')
                <img src="{{ asset("themes/$theme/images/veka_280.png") }}" alt="Rehau Partner">
            @else
                <img src="{{ asset("themes/$theme/images/rehau.png") }}" alt="Veka Partner">
            @endif
        </div>

    </div>
{{--    <!-- Правая колонка -->--}}
{{--    <div class="right-column">--}}
{{--        <style>--}}
{{--            .WinDraw-card {--}}
{{--                width: 420px;--}}
{{--                background: #ffffff;--}}
{{--                border-radius: 20px;--}}
{{--                padding: 40px 32px;--}}
{{--                box-shadow: 0 10px 30px rgba(0,0,0,0.08);--}}

{{--                display: flex;--}}
{{--                flex-direction: column;--}}
{{--                align-items: center;--}}
{{--                text-align: center;--}}
{{--            }--}}

{{--        </style>--}}
{{--        <!-- Мотивація-->--}}

{{--            <div class="motivation-header">--}}
{{--                <h1 class="motivation-title">&nbsp;&nbsp;Мотивація</h1>--}}
{{--                <button--}}
{{--                    class="control-motivation-btn control-range"--}}
{{--                    type="button"--}}
{{--                >--}}
{{--                    <img--}}
{{--                        src="{{ asset("themes/$theme/images/calendar-dots.svg") }}"--}}
{{--                        alt=""--}}
{{--                        class="btn-icon"--}}
{{--                        aria-hidden="true"--}}
{{--                    />--}}
{{--                    За 30 днів--}}
{{--                    <img--}}
{{--                        src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}"--}}
{{--                        alt=""--}}
{{--                        class="btn-icon-right"--}}
{{--                        aria-hidden="true"--}}
{{--                    />--}}
{{--                </button>--}}

{{--                <!-- Выпадающий список для мотивации -->--}}
{{--                <div class="table-popup table-popup-motivation">--}}
{{--                    <span class="table-popup-sort-item">За сьогодні</span>--}}
{{--                    <span class="table-popup-sort-item">За 7 днів</span>--}}
{{--                    <span class="table-popup-sort-item">За 30 днів</span>--}}
{{--                    <span class="table-popup-sort-item">За 90 днів</span>--}}
{{--                    <span class="table-popup-sort-item">За 180 днів</span>--}}
{{--                    <span class="table-popup-sort-item">За рік</span>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="motivation-body">--}}
{{--                <div class="motivation-cards-top">--}}
{{--                    <div class="motivation-card">--}}
{{--                        <div class="motivation-card-texts">--}}
{{--                    <span class="motivation-card-label"--}}
{{--                    >Зароблено<br />бонусів</span--}}
{{--                    >--}}
{{--                            <h2 class="motivation-card-value">₴24 600</h2>--}}
{{--                            <span class="motivation-card-subtext">За період</span>--}}
{{--                        </div>--}}
{{--                        <img--}}
{{--                            src="{{ asset("themes/$theme/images/pocket.svg") }}"--}}
{{--                            alt="Іконка"--}}
{{--                            class="motivation-card-icon"--}}
{{--                        />--}}
{{--                    </div>--}}

{{--                    <div class="motivation-card">--}}
{{--                        <div class="motivation-card-texts">--}}
{{--                    <span class="motivation-card-label"--}}
{{--                    >Прогрес<br />до цілі</span--}}
{{--                    >--}}
{{--                            <h2 class="motivation-card-value">68%</h2>--}}
{{--                            <span class="motivation-card-subtext">--}}
{{--                      Залишилось <span>₴11 200</span>--}}
{{--                    </span>--}}
{{--                        </div>--}}
{{--                        <img--}}
{{--                            src="{{ asset("themes/$theme/images/BLue-info.svg") }}"--}}
{{--                            alt="Іконка"--}}
{{--                            class="motivation-card-icon"--}}
{{--                        />--}}
{{--                    </div>--}}

{{--                    <div class="motivation-card">--}}
{{--                        <div class="motivation-card-texts">--}}
{{--                    <span class="motivation-card-label"--}}
{{--                    >Час до<br />завершення</span--}}
{{--                    >--}}
{{--                            <h2 class="motivation-card-value">12</h2>--}}
{{--                            <span class="motivation-card-subtext"--}}
{{--                            >Поточна програма</span--}}
{{--                            >--}}
{{--                        </div>--}}
{{--                        <img--}}
{{--                            src="{{ asset("themes/$theme/images/Orange watches.svg") }}"--}}
{{--                            alt="Іконка"--}}
{{--                            class="motivation-card-icon"--}}
{{--                        />--}}
{{--                    </div>--}}

{{--                    <div class="motivation-card">--}}
{{--                        <div class="motivation-card-texts">--}}
{{--                    <span class="motivation-card-label"--}}
{{--                    >Активні<br />програми</span--}}
{{--                    >--}}
{{--                            <h2 class="motivation-card-value">7</h2>--}}
{{--                            <span class="motivation-card-subtext">Доступні наразі</span>--}}
{{--                        </div>--}}
{{--                        <img--}}
{{--                            src="{{ asset("themes/$theme/images/Active programs.svg") }}"--}}
{{--                            alt="Іконка"--}}
{{--                            class="motivation-card-icon"--}}
{{--                        />--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="motivation-content-bottom">--}}
{{--                    <div class="motivation-programs">--}}
{{--                        <h2>Програми мотивації</h2>--}}
{{--                        <div class="motivation-programs-table">--}}
{{--                            <div class="extra-row">--}}
{{--                                <div class="table-cell">Програми</div>--}}
{{--                                <div class="table-cell">Статус</div>--}}
{{--                                <div class="table-cell">План/Факт</div>--}}
{{--                                <div class="table-cell">Дедлайн</div>--}}
{{--                                <div class="table-cell">Виплата</div>--}}
{{--                                <div class="table-cell">Прогрес</div>--}}
{{--                                <div class="table-cell">Дії</div>--}}
{{--                            </div>--}}
{{--                            <div class="extra-row">--}}
{{--                                <div class="table-cell">--}}
{{--                                    <h3>Ретробонус — серпень 2025</h3>--}}
{{--                                    <p>01.08–31.08.2025</p>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Active">--}}
{{--                                        Активна--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">₴50 000 / ₴38 800</div>--}}
{{--                                <div class="table-cell">31.08.2025</div>--}}
{{--                                <div class="table-cell">₴7 500</div>--}}
{{--                                <div class="table-cell progress-wrapper">--}}
{{--                                    <div class="progress-bar">--}}
{{--                                        <div class="progress-bar-full"></div>--}}
{{--                                    </div>--}}
{{--                                    <span class="progress-value">78%</span>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Details">--}}
{{--                                        Деталі--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="extra-row">--}}
{{--                                <div class="table-cell">--}}
{{--                                    <h3>Ретробонус — серпень 2025</h3>--}}
{{--                                    <p>01.08–31.08.2025</p>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Active">--}}
{{--                                        Активна--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">₴50 000 / ₴38 800</div>--}}
{{--                                <div class="table-cell">31.08.2025</div>--}}
{{--                                <div class="table-cell">₴7 500</div>--}}
{{--                                <div class="table-cell progress-wrapper">--}}
{{--                                    <div class="progress-bar">--}}
{{--                                        <div class="progress-bar-full"></div>--}}
{{--                                    </div>--}}
{{--                                    <span class="progress-value">78%</span>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Details">--}}
{{--                                        Деталі--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="extra-row">--}}
{{--                                <div class="table-cell">--}}
{{--                                    <h3>Ретробонус — серпень 2025</h3>--}}
{{--                                    <p>01.08–31.08.2025</p>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Completed">--}}
{{--                                        Завершена--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">₴50 000 / ₴38 800</div>--}}
{{--                                <div class="table-cell">31.08.2025</div>--}}
{{--                                <div class="table-cell">₴7 500</div>--}}
{{--                                <div class="table-cell progress-wrapper">--}}
{{--                                    <div class="progress-bar active">--}}
{{--                                        <div class="progress-bar-full"></div>--}}
{{--                                    </div>--}}
{{--                                    <span class="progress-value">104%</span>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Details">--}}
{{--                                        Деталі--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="extra-row">--}}
{{--                                <div class="table-cell">--}}
{{--                                    <h3>Ретробонус — серпень 2025</h3>--}}
{{--                                    <p>01.08–31.08.2025</p>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Active">--}}
{{--                                        Активна--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">₴50 000 / ₴38 800</div>--}}
{{--                                <div class="table-cell">31.08.2025</div>--}}
{{--                                <div class="table-cell">₴7 500</div>--}}
{{--                                <div class="table-cell progress-wrapper">--}}
{{--                                    <div class="progress-bar">--}}
{{--                                        <div class="progress-bar-full"></div>--}}
{{--                                    </div>--}}
{{--                                    <span class="progress-value">78%</span>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Details">--}}
{{--                                        Деталі--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="extra-row">--}}
{{--                                <div class="table-cell">--}}
{{--                                    <h3>Ретробонус — серпень 2025</h3>--}}
{{--                                    <p>01.08–31.08.2025</p>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Ending">--}}
{{--                                        Завершується--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">₴50 000 / ₴38 800</div>--}}
{{--                                <div class="table-cell">31.08.2025</div>--}}
{{--                                <div class="table-cell">₴7 500</div>--}}
{{--                                <div class="table-cell progress-wrapper">--}}
{{--                                    <div class="progress-bar">--}}
{{--                                        <div class="progress-bar-full"></div>--}}
{{--                                    </div>--}}
{{--                                    <span class="progress-value">78%</span>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Details">--}}
{{--                                        Деталі--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="extra-row">--}}
{{--                                <div class="table-cell">--}}
{{--                                    <h3>Ретробонус — серпень 2025</h3>--}}
{{--                                    <p>01.08–31.08.2025</p>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Active">--}}
{{--                                        Активна--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">₴50 000 / ₴38 800</div>--}}
{{--                                <div class="table-cell">31.08.2025</div>--}}
{{--                                <div class="table-cell">₴7 500</div>--}}
{{--                                <div class="table-cell progress-wrapper">--}}
{{--                                    <div class="progress-bar">--}}
{{--                                        <div class="progress-bar-full"></div>--}}
{{--                                    </div>--}}
{{--                                    <span class="progress-value">78%</span>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Details">--}}
{{--                                        Деталі--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="extra-row">--}}
{{--                                <div class="table-cell">--}}
{{--                                    <h3>Ретробонус — серпень 2025</h3>--}}
{{--                                    <p>01.08–31.08.2025</p>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Active">--}}
{{--                                        Активна--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">₴50 000 / ₴38 800</div>--}}
{{--                                <div class="table-cell">31.08.2025</div>--}}
{{--                                <div class="table-cell">₴7 500</div>--}}
{{--                                <div class="table-cell progress-wrapper">--}}
{{--                                    <div class="progress-bar">--}}
{{--                                        <div class="progress-bar-full"></div>--}}
{{--                                    </div>--}}
{{--                                    <span class="progress-value">78%</span>--}}
{{--                                </div>--}}
{{--                                <div class="table-cell">--}}
{{--                                    <button class="table-finance-Status-btn Details">--}}
{{--                                        Деталі--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="differentiated-discounts">--}}
{{--                        <h2>Диференційовані знижки (щомісячна драбина)</h2>--}}
{{--                        <p>--}}
{{--                            Накопичувальна мотивація за місяць: кроки від обороту--}}
{{--                            визначають % знижки/бонусу. Додатково: +0,5% за прорахунок у--}}
{{--                            WinDraw; 5% — при оплаті готівкою за передплатою.--}}
{{--                        </p>--}}
{{--                        <div class="differentiated-discounts-table">--}}
{{--                            <div class="differentiated-discounts-table-header">--}}
{{--                                <button class="differentiated-discounts-active-btn">--}}
{{--                                    Активна--}}
{{--                                </button>--}}
{{--                            </div>--}}

{{--                            <div class="discount-row">--}}
{{--                                <label class="discount-option">--}}
{{--                                    <input type="radio" name="discount" />--}}
{{--                                    <span class="label-text">до ₴50 000</span>--}}
{{--                                    <span class="value">Ще трохи до 1% — активізуйся!</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}

{{--                            <div class="discount-row">--}}
{{--                                <label class="discount-option">--}}
{{--                                    <input type="radio" name="discount" />--}}
{{--                                    <span class="label-text">₴50 000 — ₴100 000</span>--}}
{{--                                    <span class="value">1%</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}

{{--                            <div class="discount-row">--}}
{{--                                <label class="discount-option">--}}
{{--                                    <input type="radio" name="discount" />--}}
{{--                                    <span class="label-text">₴100 000 — ₴150 000</span>--}}
{{--                                    <span class="value">1,5%</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="discount-row">--}}
{{--                                <label class="discount-option">--}}
{{--                                    <input type="radio" name="discount" />--}}
{{--                                    <span class="label-text">₴150 000 — ₴300 000</span>--}}
{{--                                    <span class="value">3%</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="discount-row">--}}
{{--                                <label class="discount-option">--}}
{{--                                    <input type="radio" name="discount" />--}}
{{--                                    <span class="label-text">₴300 000 — ₴500 000</span>--}}
{{--                                    <span class="value">4%</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="discount-row active">--}}
{{--                                <label class="discount-option">--}}
{{--                                    <input type="radio" name="discount" checked />--}}
{{--                                    <span class="label-text">₴500 000 — ₴1 000 000</span>--}}
{{--                                    <span class="value">4,5%</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="discount-row">--}}
{{--                                <label class="discount-option">--}}
{{--                                    <input type="radio" name="discount" />--}}
{{--                                    <span class="label-text">₴1 000 000 — ₴2 000 000</span>--}}
{{--                                    <span class="value">5,5%</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                            <div class="discount-row">--}}
{{--                                <label class="discount-option">--}}
{{--                                    <input type="radio" name="discount" />--}}
{{--                                    <span class="label-text">₴2 000 000 — ₴3 000 000</span>--}}
{{--                                    <span class="value">6</span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--        <div class="mp-popup-overlay"></div>--}}
{{--        <div class="mp-popup">--}}
{{--            <div class="mp-popup-header">--}}
{{--                <h2 class="mp-popup-title">Мої програми мотивації</h2>--}}
{{--                <img--}}
{{--                    src="{{ asset("themes/$theme/images/close.svg") }}"--}}
{{--                    alt="Закрити"--}}
{{--                    class="mp-popup-close"--}}
{{--                />--}}
{{--            </div>--}}

{{--            <div class="mp-popup-body">--}}
{{--                <div class="mp-popup-block">--}}
{{--                    <h2>Ретробонус — серпень 2025</h2>--}}
{{--                    <button class="mp-popup-status-btn">Активна</button>--}}
{{--                    <div class="mp-popup-divider"></div>--}}
{{--                </div>--}}

{{--                <div class="mp-popup-block">--}}
{{--                    <h2>Опис</h2>--}}
{{--                    <p class="mp-popup-text">--}}
{{--                        Щомісячна програма ретробонусу для активних дилерів Darwin.--}}
{{--                        Бонус нараховується від обороту за підсумками місяця.--}}
{{--                    </p>--}}
{{--                </div>--}}

{{--                <div class="mp-popup-block">--}}
{{--                    <h2>Умови</h2>--}}
{{--                    <ul class="mp-popup-list">--}}
{{--                        <li>--}}
{{--                            <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="" />--}}
{{--                            <p>Мінімальний оборот ₴50 000 за місяць</p>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="" />--}}
{{--                            <p>Бренди: REHAU, MACO, ALUPROF, SIEGENIA.</p>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="" />--}}
{{--                            <p>Додатково: +0,5% за прорахунок у WinDraw.</p>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="" />--}}
{{--                            <p>--}}
{{--                                Оплата готівкою за передплатою — знижка 5% одразу в ціні.--}}
{{--                            </p>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="" />--}}
{{--                            <p>Диференційована щомісячна драбина: 1% … 6%.</p>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}

{{--                <div class="mp-popup-block">--}}
{{--                    <h2>Мій прогрес</h2>--}}
{{--                    <div class="mp-popup-progress-block">--}}
{{--                        <div class="mp-popup-progress-row">--}}
{{--                            <p>Поточний оборот</p>--}}
{{--                            <span>₴838 800</span>--}}
{{--                        </div>--}}
{{--                        <div class="mp-popup-progress-row">--}}
{{--                            <p>Поточний, %</p>--}}
{{--                            <span>4,5%</span>--}}
{{--                        </div>--}}
{{--                        <div class="mp-popup-progress-row">--}}
{{--                            <p>Очікувана виплата</p>--}}
{{--                            <span>₴7 500</span>--}}
{{--                        </div>--}}
{{--                        <div class="mp-popup-progress-bar">--}}
{{--                            <div class="mp-popup-progress-fill"></div>--}}
{{--                        </div>--}}
{{--                        <div class="mp-popup-progress-row">--}}
{{--                            <p>До наступного кроку</p>--}}
{{--                            <span>₴11 200</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="mp-popup-block">--}}
{{--                    <h2>Внесок замовлень</h2>--}}
{{--                    <table class="mp-popup-table">--}}
{{--                        <tr>--}}
{{--                            <td>№</td>--}}
{{--                            <td>Дата</td>--}}
{{--                            <td>Сума</td>--}}
{{--                            <td>Коеф.</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>DWN-10452</td>--}}
{{--                            <td>04.08.2025</td>--}}
{{--                            <td>₴5 600</td>--}}
{{--                            <td>1,2</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>DWN-10452</td>--}}
{{--                            <td>04.08.2025</td>--}}
{{--                            <td>₴5 600</td>--}}
{{--                            <td>1</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>DWN-10452</td>--}}
{{--                            <td>04.08.2025</td>--}}
{{--                            <td>₴5 600</td>--}}
{{--                            <td>1</td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </div>--}}

{{--                <div class="mp-popup-block">--}}
{{--                    <h2>Історія виплат</h2>--}}
{{--                    <table class="mp-popup-table">--}}
{{--                        <tr>--}}
{{--                            <td>№</td>--}}
{{--                            <td>Дата</td>--}}
{{--                            <td>Сума</td>--}}
{{--                            <td>Статус</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>DWN-10452</td>--}}
{{--                            <td>04.08.2025</td>--}}
{{--                            <td>₴5 600</td>--}}
{{--                            <td>Виплачено</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>DWN-10452</td>--}}
{{--                            <td>04.08.2025</td>--}}
{{--                            <td>₴5 600</td>--}}
{{--                            <td>Виплачено</td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                </div>--}}

{{--                <div class="mp-popup-block">--}}
{{--                    <h2>Нарахування бонусів — спосіб оплати</h2>--}}
{{--                    <div class="mp-popup-bonus-block">--}}
{{--                        <div class="mp-popup-bonus-row">--}}
{{--                            <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="" />--}}
{{--                            <p>--}}
{{--                                <strong>Безготівково:</strong> бонус за період--}}
{{--                                зараховується на баланс дилера. За потреби — вивід--}}
{{--                                готівкою до 15% від суми.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        <div class="mp-popup-bonus-row">--}}
{{--                            <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="" />--}}
{{--                            <p>--}}
{{--                                <strong>Оплата готівкою:</strong> 5% знижки одразу в--}}
{{--                                прайсі; місячний бонус рахується з остаточної суми--}}
{{--                                періоду.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="mp-popup-divider"></div>--}}

{{--                <button class="mp-popup-complete-btn">Завершити участь</button>--}}
{{--            </div>--}}
{{--        </div>--}}


{{--        <div class="partner">--}}
{{--            @if ($theme === 'goodwin')--}}
{{--                <img src="{{ asset("themes/$theme/images/veka_280.png") }}" alt="Rehau Partner">--}}
{{--            @else--}}
{{--                <img src="{{ asset("themes/$theme/images/rehau.png") }}" alt="Veka Partner">--}}
{{--            @endif--}}
{{--        </div>--}}

{{--    </div>--}}
</div>


@endsection







