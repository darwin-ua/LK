<div class="mobile-header">
    <style>.mobile-menu {
            position: fixed;
            top: 84px; /* ниже хедера */
            left: 0;
            width: 100%;
            height: calc(100vh - 84px);
            background: #fff;

            transform: translateX(-100%);
            transition: transform 0.3s ease;

            z-index: 2000;
            overflow-y: auto;
        }

        .mobile-menu.open {
            transform: translateX(0);
        }
    </style>
    <!-- Левая часть: бургер + поиск -->
    <div class="mobile-left">

        <div class="icon-wrapper" id="burgerBtn">
            <img src="{{ asset("themes/$theme/images/Burger.svg") }}" alt="Menu" class="mobile-left-icon-img">
        </div>

        <div>
            <h3 class="page-title">Вибрати розділ</h3>
        </div>
    </div>

    <!-- Правая часть: уведомления + аватар -->
    <div class="mobile-right">
        <div class="notification-wrapper">
            <div class="notification-icon">
                <img src="{{ asset("themes/$theme/images/bell.svg") }}" alt="Notifications" class="bell-icon-img">
                <span class="notification-count">3</span>
            </div>
        </div>
        <div class="user-info">
            <img src="{{ asset("themes/$theme/images/avatar.png") }}" alt="Avatar" class="avatar">
        </div>
    </div>
</div>
<div class="mobile-menu">
    <div class="menu-content">
        <h3>Пошук</h3>
        <div class="search-group">
            <img src="{{ asset("themes/$theme/images/Search.svg") }}" alt="Search" class="icon-img">

            <input type="text" placeholder="Пошук..." />
        </div>

        <h3>Головне</h3>
        <ul class="menu">
            <li>
                <img
                    src="{{ asset("themes/$theme/images/user.svg") }}"
                    class="icon-img"
                    alt="Профіль дилера"
                />
                <span>Профіль дилера</span>
            </li>

            <li>
                <img
                    src="{{ asset("themes/$theme/images/grid-view.svg") }}"
                    class="icon-img"
                    alt="Dashboard"
                />
                <span>Дашборд</span>
            </li>

            <li>
                <img
                    src="{{ asset("themes/$theme/images/route.svg") }}"
                    class="icon-img"
                    alt="Tracking"
                />
                <span>Трекінг замовлення</span>
            </li>

            <li>
                <img
                    src="{{ asset("themes/$theme/images/shapes-2.svg") }}"
                    class="icon-img"
                    alt="WinDraw"
                />
                <span>WinDraw</span>
            </li>

        </ul>

        <h3>Промо</h3>
        <ul class="menu">
            <li>
                <img
                    src="{{ asset("themes/$theme/images/Speaker-megaphone-3.svg") }}"
                    class="icon-img"
                    alt="Акції"
                />
                <span>Акції</span>
            </li>

            <li>
                <img
                    src="{{ asset("themes/$theme/images/Flash.svg") }}"
                    class="icon-img"
                    alt="Мотивація"
                />
                <span>Мотивація</span>
            </li>

        </ul>

        <h3>Фінанси</h3>
        <ul class="menu">
            <li>
                <img
                    src="{{ asset("themes/$theme/images/cash1.svg") }}"
                    class="icon-img"
                    alt="Фінанси"
                />
                <span>Фінанси</span>
            </li>
        </ul>

        <h3>Підтримка</h3>
        <ul class="menu">
            <li>
                <img
                    src="{{ asset("themes/$theme/images/alert-triangle.svg") }}"
                    class="icon-img"
                    alt="Рекламації"
                />
                <span>Рекламації</span>
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
</div>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const burger = document.getElementById('burgerBtn');
        const mobileMenu = document.querySelector('.mobile-menu');

        if (!burger || !mobileMenu) return;

        burger.addEventListener('click', function () {
            mobileMenu.classList.toggle('open');
        });
    });
</script>






</body>
</html>
