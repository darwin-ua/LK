@extends('admin.index')

@section('title', 'WinDraw')

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
        <!-- WinDraw -->
            <div class="WinDraw-header">
                <h1>&nbsp;&nbsp;WinDraw</h1>
            </div>
            <div class="WinDraw-bottom-content">
                <div class="WinDraw-card" id="windraw-loading">
                    <img src="{{ asset("themes/$theme/images/Loading WinDraw.svg") }}"
                         class="WinDraw-card-icon"/>

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


                <div class="WinDraw-card" id="windraw-success" style="display:none;">
                    <img src="{{ asset("themes/$theme/images/WinDraw Successful.svg") }}"
                         class="WinDraw-card-icon"/>

                    <p class="WinDraw-title">Успішний вхід</p>
                    <p class="WinDraw-text">Перенаправляємо до WinDraw…</p>

                    @if($windrawUrl)
                        <button
                            class="WinDraw-footer-button"
                            id="openWinDrawBtn"
                            data-url="{{ $windrawUrl }}"
                        >
                            Відкрити зараз
                        </button>

                    @else
                        <button class="WinDraw-footer-button" disabled>
                            Немає доступу
                        </button>
                    @endif
                </div>


                <!-- WinDraw Error-->
                <div class="WinDraw-card" id="windraw-closed" style="display:none;">
                    <img
                        src="{{ asset("themes/$theme/images//WinDraw Error.svg") }}"
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
                <div class="WinDraw-card" id="windraw-error" style="display:none;">
                    <img
                        src="{{ asset("themes/$theme/images//WinDraw Closed.svg") }}"
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loading = document.getElementById('windraw-loading');
        const success = document.getElementById('windraw-success');
        const error   = document.getElementById('windraw-error');
        const closed  = document.getElementById('windraw-closed');

        // На старте — только loading
        loading.style.display = 'block';
        success.style.display = 'none';
        error.style.display   = 'none';
        closed.style.display  = 'none';

        // Через 3 секунды — success
        setTimeout(() => {
            loading.style.display = 'none';
            success.style.display = 'block';
        }, 3000);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('openWinDrawBtn');
        if (!btn) return;

        btn.addEventListener('click', () => {
            const url = btn.dataset.url;

            if (!url) {
                alert('Немає доступу до WinDraw');
                return;
            }

            window.open(url, '_blank');
        });
    });
</script>

@endsection







