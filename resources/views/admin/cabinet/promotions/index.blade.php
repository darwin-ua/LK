@extends('admin.index')

@section('title', 'Акції')

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
</div>


@endsection







