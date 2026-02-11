<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Профіль</title>
    <link rel="stylesheet" href="{{ asset("themes/$theme/css/style.css") }}">
    <link rel="icon" type="image/png" sizes="32x32"
          href="{{ asset("themes/$theme/images/favicon.png?v=2025") }}">
    <link rel="shortcut icon"
          href="{{ asset("themes/$theme/images/favicon.png?v=2025") }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<style>
    .notification-count.visible {
        display: flex;
    }


    .header-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
    }

    .notification-count.visible {
        display: flex;
    }

    .darwin-logo {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px; /* расстояние между логотипом и текстом */
    }

    .cabinet-title {
        font-size: 12px;
        font-weight: 500;
        color: #5a5b5d;         /* чёрный текст */
        text-align: center;
    }


</style>
<div class="header">
    <!-- Логотип -->
    <div class="darwin-logo">
        @if ($theme === 'goodwin')
            <img src="{{ asset("themes/$theme/images/goodwin_210.png") }}" alt="Goodwin Logo">
        @else
            <img src="{{ asset("themes/$theme/images/Darwin-Logo.svg") }}" alt="Darwin Logo">
        @endif

        <div class="cabinet-title">
            Особистий кабiнет
        </div>
    </div>



    <!-- Основная часть хедера -->
    <div class="header-main">
        <!-- Левая группа: поиск -->
        <div class="header-left">
            <div class="search-group">
                <img src="{{ asset("themes/$theme/images/Search.svg") }}" alt="Search" class="icon-img">
                <input type="text" placeholder="Пошук..." />
            </div>
        </div>

        <!-- Правая группа: флаг, уведомления, профиль -->
        <div class="header-right">
            <!-- Меню выбора языка -->
            <div class="language-selector">
                <img src="{{ asset("themes/$theme/images/flag.svg") }}" alt="Флаг" class="flag-icon">
            </div>

            <!-- Уведомления -->

            <div class="notification-icon" id="notificationBtn">
                <img
                    src="{{ asset("themes/$theme/images/bell.svg") }}"
                    data-empty="{{ asset("themes/$theme/images/bell.svg") }}"
                    data-active="{{ asset("themes/$theme/images/bell-active.svg") }}"
                    alt="Notifications"
                    class="icon-img"
                    id="bellIcon"
                >

                <span class="notification-count" id="notifCount"></span>
            </div>


            <!-- Меню сообщений -->
            <div class="msg-selector" id="msgMenu">
                <div class="msg-menu">
                    <!-- Заголовок -->
                    <div class="msg-header">
                        <span>Повідомлення</span>
                        <button class="msg-close-btn" id="msgCloseBtn">
                            <img src="{{ asset("themes/$theme/images/close.svg") }}" alt="Закрити" class="msg-close-icon">
                        </button>
                    </div>
                    <!-- Контейнер для сообщений -->
                    <div class="msg-content" id="notifList"></div>
                    <div class="msg-footer">
                        <a href="/cabinet/orders-tracking?theme=darwin" class="msg-view-all">
                            Переглянути усі
                            <img src="{{ asset("themes/$theme/images/Green-arrow.svg") }}" alt="Green-arrow" class="msg-arrow-icon">
                        </a>
                    </div>
                </div>
            </div>
            <!-- Профиль -->
            <div class="user-info">
                @php
                    $user = Auth::user();
                    $hasCustomAvatar = $user && $user->avatar && $user->avatar !== 'users/default.png';
                @endphp

                @if($hasCustomAvatar)
                    <img
                        src="{{ asset($user->avatar) }}"
                        alt="Avatar"
                        class="header-avatar"
                    />
                @else
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 16 16"
                        class="header-avatar header-avatar-svg"
                        fill="currentColor"
                    >
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd"
                              d="M0 8a8 8 0 1 1 16 0
                 A8 8 0 0 1 0 8
                 m8-7a7 7 0 0 0-5.468 11.37
                 C3.242 11.226 4.805 10 8 10
                 s4.757 1.225 5.468 2.37
                 A7 7 0 0 0 8 1"/>
                    </svg>
                @endif


                <div class="user-name">
                    <span class="username">Ім’я</span>
                    <span class="user-id">
        ID{{ $user->id_lk }}
    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openBtn = document.getElementById('notificationBtn');
        const closeBtn = document.getElementById('msgCloseBtn');
        const msgMenu = document.getElementById('msgMenu');

        if (openBtn && msgMenu) {
            openBtn.addEventListener('click', () => {
                msgMenu.classList.add('active');
            });
        }

        if (closeBtn && msgMenu) {
            closeBtn.addEventListener('click', () => {
                msgMenu.classList.remove('active');
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const notifBtn  = document.getElementById('notificationBtn');
        const notifMenu = document.getElementById('msgMenu');
        const closeBtn  = document.getElementById('msgCloseBtn');
        const countEl   = document.getElementById('notifCount');
        const listEl    = document.getElementById('notifList');

        if (!notifBtn || !notifMenu || !countEl || !listEl) return;

        // ===== начальное состояние =====
        countEl.style.display = 'none';

        // ===============================
        // Загрузка уведомлений
        // ===============================
        async function loadOrderNotifications() {
            try {
                const response = await fetch('/cabinet/notifications/orders', {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                if (!response.ok) return;

                const data = await response.json();

                // ===== СЧЁТЧИК (ТОЛЬКО JS) =====
                if (data.count > 0) {
                    countEl.textContent = data.count;
                    countEl.style.display = 'flex';   // ← ПОКАЗЫВАЕМ
                } else {
                    countEl.textContent = '';
                    countEl.style.display = 'none';   // ← ПРЯЧЕМ
                }

                // ===== список =====
                listEl.innerHTML = '';

                if (!data.items || !data.items.length) {
                    listEl.innerHTML = '<div class="msg-empty">Немає повідомлень</div>';
                    return;
                }

                data.items.forEach(n => {
                    listEl.insertAdjacentHTML('beforeend', `
                    <div class="msg-item ${n.is_read ? '' : 'unread'}">
                        <div class="msg-time">
                            <img src="/themes/darwin/images/clock.svg" alt="">
                            <span class="msg-time-text">${formatTime(n.created_at)}</span>
                        </div>
                        <div class="msg-title">${escapeHtml(n.title)}</div>
                        <div class="msg-body">${escapeHtml(n.message)}</div>
                    </div>
                `);
                });

            } catch (e) {
                console.error('Notifications error:', e);
            }
        }

        // ===============================
        // Открытие меню → сразу прячем счётчик
        // ===============================
        notifBtn.addEventListener('click', async function (e) {
            e.stopPropagation();

            const wasClosed = !notifMenu.classList.contains('open');
            notifMenu.classList.toggle('open');

            if (wasClosed) {
                try {
                    await fetch('/cabinet/notifications/orders/read', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content')
                        }
                    });
                } catch (e) {
                    console.error('Mark read error:', e);
                }

                // 🔴 ПРЯЧЕМ СРАЗУ
                countEl.textContent = '';
                countEl.style.display = 'none';
            }
        });

        closeBtn?.addEventListener('click', () => {
            notifMenu.classList.remove('open');
        });

        // ===============================
        // helpers
        // ===============================
        function formatTime(dateStr) {
            const d = new Date(dateStr);
            return isNaN(d)
                ? ''
                : d.toLocaleString('uk-UA', { hour: '2-digit', minute: '2-digit' });
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.innerText = text ?? '';
            return div.innerHTML;
        }

        // ===============================
        // старт
        // ===============================
        loadOrderNotifications();
        setInterval(loadOrderNotifications, 30000);

    });
</script>



