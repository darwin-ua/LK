@include('admin.header_adm')
<!-- Контент страницы -->
<div class="container">
    <!-- Левая колонка -->
    <div class="left-column">
        <div class="left-bottom">
            <h3>Головне</h3>
            <ul class="menu">
                <li>
                    <img src="{{ asset("themes/$theme/images/user.svg") }}" class="icon-img" alt="User">Профіль дилера
                </li>
                <li>
                    <img src="{{ asset("themes/$theme/images/grid-view.svg") }}" class="icon-img" alt="Dashboard">
                    Дашборд
                </li>
                <li>
                    <img src="{{ asset("themes/$theme/images/route.svg") }}" class="icon-img" alt="Tracking">
                    Трекінг замовлення
                </li>
                <li>
                    <img src="{{ asset("themes/$theme/images/shapes-2.svg") }}" class="icon-img" alt="WinDraw">
                    WinDraw
                </li>
            </ul>

            <h3>Промо</h3>
            <ul class="menu">
                <li>
                    <img src="{{ asset("themes/$theme/images/Speaker-megaphone-3.svg") }}" class="icon-img" alt="Акції">
                    Акції
                </li>
                <li>
                    <img src="{{ asset("themes/$theme/images/Flash.svg") }}" class="icon-img" alt="Мотивація">
                    Мотивація
                </li>
            </ul>

            <h3>Фінанси</h3>
            <ul class="menu">
                <li>
                    <img src="{{ asset("themes/$theme/images/cash1.svg") }}" class="icon-img" alt="Фінанси">
                    <span>Фінанси</span>
                </li>
            </ul>

            <h3>Підтримка</h3>
            <ul class="menu">
                <li>
                    <img src="{{ asset("themes/$theme/images/alert-triangle.svg") }}" class="icon-img" alt="Рекламації">
                    Рекламації
                </li>
            </ul>

            <div class="logout-container">
                <div class="menu-divider"></div>
                <div class="logout-block">
                    <img src="{{ asset("themes/$theme/images/Right-enter.svg") }}" class="icon-img" alt="Exit Icon">
                    <span>Вихід</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Правая колонка -->
    <div class="right-column">
        <div class="content-box">
            <!-- Профиль -->
            <div class="profile-content">
                <h1>Налаштування профілю ааа</h1>
                <div class="profile-bottom-content">
                    <!-- Первый блок меню -->
                    <div class="profile-menu">
                        <p class="profile-title">Акаунт</p>
                        <ul>
                            <li>
                                <img src="{{ asset("themes/$theme/images/user.svg") }}" class="icon-img" alt="Мій профіль">
                                <span>Мій профіль</span>
                            </li>
                            <li>
                                <img src="{{ asset("themes/$theme/images/Bank-Card.svg") }}" class="icon-img" alt="Контакти відділів">
                                <span>Контакти відділів</span>
                            </li>
                        </ul>
                    </div>
                    <div class="content-wrapper">
                        <!-- Второй блок профиля -->
                        <div class="profile-block">
                            <!-- Контейнер для особистої інформації -->
                            <div class="profile-info-wrapper">
                                <!-- Кнопка перехода к контактам отдела (только на мобильных) -->
                                <button class="mobile-section-switch-btn" data-target="contacts">
                                    <img src="{{ asset("themes/$theme/images/Bank-Card.svg") }}" class="icon-img" alt="Контакты отделов">
                                    <span>Контакти відділів</span>
                                </button>
                                <h2>Профіль</h2>
                                <p class="profile-text">
                                    Налаштуйте та оновіть вашу особисту інформацію.
                                </p>

                                <div class="profile-photo-section">
                                    <div class="photo-info-block">
                                        <div class="profile-photo">
                                            <img src="{{ asset("themes/$theme/images/user-placeholder.png") }}" alt="Фото користувача">
                                        </div>
                                        <div class="photo-info">
                                            <span>Фото профілю</span>
                                            <small>Min 400x400px, PNG or JPEG</small>
                                        </div>
                                    </div>
                                    <div class="photo-buttons">
                                        <button class="photo-btn upload-btn">
                                            Завантажити фото
                                        </button>
                                        <button class="photo-btn delete-btn">Видалити</button>
                                    </div>
                                </div>

                                <div class="personal-info-block">
                                    <div class="personal-header">
                                        <h3>Персональна інформація</h3>
                                    </div>
                                    <div class="header-divider"></div>

                                    <div class="personal-fields">
                                        <!-- Первая колонка -->
                                        <div class="personal-column">
                                            <label
                                            >Прізвище
                                                <input type="text" placeholder="Введіть прізвище" />
                                            </label>
                                            <label
                                            >Email
                                                <input type="email" placeholder="Введіть Email" />
                                            </label>
                                            <label
                                            >Форма власності
                                                <input
                                                    type="text"
                                                    placeholder="Введіть форму власності"
                                                />
                                            </label>
                                        </div>

                                        <!-- Вторая колонка -->
                                        <div class="personal-column">
                                            <label
                                            >Ім’я
                                                <input type="text" placeholder="Введіть ім’я" />
                                            </label>
                                            <label
                                            >Телефон
                                                <input type="tel" placeholder="Введіть телефон" />
                                            </label>
                                            <label
                                            >Адреса
                                                <input type="text" placeholder="Введіть адресу" />
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="change-password-block">
                                    <div class="change-password-header">
                                        <h3>Змінити пароль</h3>
                                    </div>
                                    <div class="header-divider"></div>

                                    <div class="password-fields">
                                        <div class="password-column">
                                            <label for="current-password">Поточний пароль</label>
                                            <div class="input-wrapper has-left has-right">
                                                <img src="{{ asset("themes/$theme/images/lock.svg") }}" alt="lock" class="icon-left">
                                                <input
                                                    type="password"
                                                    id="current-password"
                                                    placeholder="********"
                                                />
                                                <span class="icon-right toggle-password">
                           <img src="{{ asset("themes/$theme/images/eye.svg") }}" alt="eye">
                          </span>
                                            </div>
                                        </div>

                                        <div class="password-column">
                                            <label for="new-password">Новий пароль</label>
                                            <div class="input-wrapper has-left has-right">
                                                <img src="{{ asset("themes/$theme/images/lock.svg") }}" alt="lock" class="icon-left">
                                                <input
                                                    type="password"
                                                    id="new-password"
                                                    placeholder="********"
                                                />
                                                <span class="icon-right toggle-password">
                          <img src="{{ asset("themes/$theme/images/eye.svg") }}" alt="eye">
                          </span>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="photo-btn change-password-btn">
                                        Змінити пароль
                                    </button>
                                </div>
                            </div>
                            <!-- Кінець контейнера особистої інформації -->

                            <div class="department-contacts">
                                <!-- Кнопка перехода к профілю (только на мобильных) -->
                                <button class="mobile-section-switch-btn" data-target="profile">
                                    <img src="{{ asset("themes/$theme/images/user.svg") }}" class="icon-img" alt="Профіль">
                                    <span>Профіль</span>
                                </button>

                                <div class="department-columns">
                                    <!-- Левая колонка -->
                                    <div class="department-column">
                                        <div class="department-card">
                                            <div class="department-card-header">
                                                <div class="department-avatar-wrapper">
                                                    <img
                                                        src="images/avatar.png"
                                                        alt="Фото"
                                                        class="department-avatar"
                                                    />
                                                </div>
                                                <div class="department-card-info">
                                                    <h3 class="department-card-title">
                                                        Відділ Прорахунків
                                                    </h3>
                                                    <p class="department-card-subtitle">
                                                        Мукосій Сергій Іванович
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="department-contact-list">
                                                <div class="contact-item">
                                                    <img
                                                        src="images/viber.svg"
                                                        alt="Іконка"
                                                        class="contact-icon"
                                                    />
                                                    <span class="contact-text"
                                                    >Текст під іконкою</span
                                                    >
                                                </div>
                                                <div class="contact-item">
                                                    <img
                                                        src="images/telegram.svg"
                                                        alt="Іконка"
                                                        class="contact-icon"
                                                    />
                                                    <span class="contact-text"
                                                    >Текст під іконкою</span
                                                    >
                                                </div>
                                                <div class="contact-item">
                                                    <img
                                                        src="images/mail.svg"
                                                        alt="Іконка"
                                                        class="contact-icon"
                                                    />
                                                    <span class="contact-text"
                                                    >Текст під іконкою</span
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="department-card">
                                            <div class="department-card-header">
                                                <div class="department-avatar-wrapper">
                                                    <img
                                                        src="images/avatar.png"
                                                        alt="Фото"
                                                        class="department-avatar"
                                                    />
                                                </div>
                                                <div class="department-card-info">
                                                    <h3 class="department-card-title">
                                                        Відділ Прорахунків
                                                    </h3>
                                                    <p class="department-card-subtitle">
                                                        Мукосій Сергій Іванович
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="department-contact-list">
                                                <div class="contact-item">
                                                    <img
                                                        src="images/phone-call.svg"
                                                        alt="Іконка"
                                                        class="contact-icon"
                                                    />
                                                    <span class="contact-text"
                                                    >Текст під іконкою</span
                                                    >
                                                </div>
                                                <div class="contact-item">
                                                    <img
                                                        src="images/mail.svg"
                                                        alt="Іконка"
                                                        class="contact-icon"
                                                    />
                                                    <span class="contact-text"
                                                    >Текст під іконкою</span
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="department-card">
                                            <div class="department-card-header">
                                                <div class="department-avatar-wrapper">
                                                    <img
                                                        src="images/avatar.png"
                                                        alt="Фото"
                                                        class="department-avatar"
                                                    />
                                                </div>
                                                <div class="department-card-info">
                                                    <h3 class="department-card-title">
                                                        Відділ Прорахунків
                                                    </h3>
                                                    <p class="department-card-subtitle">
                                                        Мукосій Сергій Іванович
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="department-contact-list">
                                                <div class="contact-item">
                                                    <img
                                                        src="images/phone-call.svg"
                                                        alt="Іконка"
                                                        class="contact-icon"
                                                    />
                                                    <span class="contact-text"
                                                    >Текст під іконкою</span
                                                    >
                                                </div>
                                                <div class="contact-item">
                                                    <img
                                                        src="images/mail.svg"
                                                        alt="Іконка"
                                                        class="contact-icon"
                                                    />
                                                    <span class="contact-text"
                                                    >Текст під іконкою</span
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Правая колонка -->
                                    <div class="department-column">
                                        <div class="department-card">
                                            <div class="department-card-header">
                                                <div class="department-avatar-wrapper">
                                                    <img
                                                        src="images/avatar.png"
                                                        alt="Фото"
                                                        class="department-avatar"
                                                    />
                                                </div>
                                                <div class="department-card-info">
                                                    <h3 class="department-card-title">
                                                        Відділ Прорахунків
                                                    </h3>
                                                    <p class="department-card-subtitle">
                                                        Мукосій Сергій Іванович
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="department-contact-list">
                                                <div class="contact-item">
                                                    <img
                                                        src="images/phone-call.svg"
                                                        alt="Іконка"
                                                        class="contact-icon"
                                                    />
                                                    <span class="contact-text"
                                                    >Текст під іконкою</span
                                                    >
                                                </div>
                                                <div class="contact-item">
                                                    <img
                                                        src="images/mail.svg"
                                                        alt="Іконка"
                                                        class="contact-icon"
                                                    />
                                                    <span class="contact-text"
                                                    >Текст під іконкою</span
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="department-card">
                                            <div class="department-card-header">
                                                <div class="department-avatar-wrapper">
                                                    <img
                                                        src="images/avatar.png"
                                                        alt="Фото"
                                                        class="department-avatar"
                                                    />
                                                </div>
                                                <div class="department-card-info">
                                                    <h3 class="department-card-title">
                                                        Відділ Прорахунків
                                                    </h3>
                                                    <p class="department-card-subtitle">
                                                        Мукосій Сергій Іванович
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="department-contact-list">
                                                <div class="contact-item">
                                                    <img
                                                        src="images/phone-call.svg"
                                                        alt="Іконка"
                                                        class="contact-icon"
                                                    />
                                                    <span class="contact-text"
                                                    >Текст під іконкою</span
                                                    >
                                                </div>
                                                <div class="contact-item">
                                                    <img
                                                        src="images/mail.svg"
                                                        alt="Іконка"
                                                        class="contact-icon"
                                                    />
                                                    <span class="contact-text"
                                                    >Текст під іконкою</span
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Трекінг замовлення -->
            <div class="tracking-order-content">
                <div class="tracking-order-header">
                    <h1>Трекінг замовлення</h1>
                    <button class="tracking-btn">
                        <img src="{{ asset("themes/$theme/images/Plus.svg") }}" class="btn-icon" alt="Plus">
                        Запит на рахунок
                    </button>
                </div>

                <div class="tracking-order-bottom-content">
                    <div class="tracking-order-menu">
                        <button class="tracking-menu-all-btn">
                            Усі
                            <span class="dot">•</span>
                            <span class="count">5</span>
                        </button>
                        <button class="tracking-menu-rahunok-btn">
                            Прорахунок
                            <span class="dot">•</span>
                            <span class="count">5</span>
                        </button>
                        <button class="tracking-menu-btn-pogodzenya">
                            Погодження
                            <span class="dot">•</span>
                            <span class="count">5</span>
                        </button>
                        <button class="tracking-menu-oplata-btn">
                            Оплата
                            <span class="dot">•</span>
                            <span class="count">5</span>
                        </button>
                        <button class="tracking-menu-vyrobnytctvo-btn">
                            Виробництво
                            <span class="dot">•</span>
                            <span class="count">5</span>
                        </button>
                        <button class="tracking-menu-logistica-btn">
                            Логістика
                            <span class="dot">•</span>
                            <span class="count">5</span>
                        </button>
                        <button class="tracking-menu-reklama-btn">
                            Рекламація
                            <span class="dot">•</span>
                            <span class="count">5</span>
                        </button>
                        <button class="tracking-menu-vykonano-btn">
                            Виконано
                            <span class="dot">•</span>
                            <span class="count">5</span>
                        </button>
                    </div>

                    <div class="tracking-order-table">
                        <!-- 1) Панель управления файлами -->
                        <div class="tracking-order-controls">
                            <!-- Левая часть (поиск) -->
                            <div class="controls-left">
                                <label
                                    class="search-box"
                                    aria-label="Пошук за номером замовлення або клієнтом"
                                >
                                    <img
                                        src="{{ asset("themes/$theme/images/Search.svg") }}"
                                        alt=""
                                        class="search-icon"
                                        aria-hidden="true"
                                    >
                                    <input
                                        type="search"
                                        placeholder="№ замовлення/клієнт"
                                        class="search-input"
                                    >
                                </label>

                            </div>

                            <!-- Правая часть (кнопки) -->
                            <div class="controls-right">
                                <button class="control-btn control-export" type="button">
                                    <img src="{{ asset("themes/$theme/images/Upload.svg") }}" alt="" class="btn-icon" aria-hidden="true">

                                    Експорт (XLSX)
                                </button>

                                <button class="control-btn control-range" type="button">
                                    <img src="{{ asset("themes/$theme/images/calendar-dots.svg") }}" alt="" class="btn-icon" aria-hidden="true">
                                    За 30 днів
                                    <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="btn-icon-right" aria-hidden="true">

                                </button>
                            </div>
                        </div>

                        <!-- 2) Контейнер таблицы -->
                        <div class="finances-table-wrapper">
                            <div class="finances-table-scroll">
                                <table class="finances-table">
                                    <thead>
                                    <tr>
                                        <th>№ Замовлення</th>
                                        <th>
                                            Дата створення
                                            <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="th-icon">
                                        </th>
                                        <th>Клієнт</th>
                                        <th>Етап</th>

                                        <th>Сума</th>
                                        <th>Дії</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>DWN-10452</td>
                                        <td>02.08.2025</td>
                                        <td>ЖК «Парковий»</td>
                                        <td>
                                            <button class="status-btn" data-type="score" data-status="rahunok">
                                                Прорахунок
                                            </button>
                                        </td>
                                        <td>₴34 800</td>
                                        <td>
                                            <img src="{{ asset("themes/$theme/images/burger-dots.svg") }}" class="action-icon" alt="">

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>DWN-10452</td>
                                        <td>02.08.2025</td>
                                        <td>ЖК «Парковий»</td>
                                        <td>
                                            <button class="status-btn" data-type="score" data-status="vyrobnytctvo">
                                                Виробництво
                                            </button>
                                        </td>
                                        <td>₴34 800</td>
                                        <td>
                                            <img src="{{ asset("themes/$theme/images/burger-dots.svg") }}" class="action-icon" alt="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>DWN-10452</td>
                                        <td>02.08.2025</td>
                                        <td>ЖК «Парковий»</td>
                                        <td>
                                            <button class="status-btn" data-type="score" data-status="vykonano">
                                                Виконано
                                            </button>
                                        </td>
                                        <td>₴34 800</td>
                                        <td>
                                            <img src="{{ asset("themes/$theme/images/burger-dots.svg") }}" class="action-icon" alt="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>DWN-10452</td>
                                        <td>02.08.2025</td>
                                        <td>ЖК «Парковий»</td>
                                        <td>
                                            <button class="status-btn" data-type="score" data-status="oplata">
                                                Оплата
                                            </button>
                                        </td>
                                        <td>₴34 800</td>
                                        <td>
                                            <img src="{{ asset("themes/$theme/images/burger-dots.svg") }}" class="action-icon" alt="">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Итоговая строка -->
                            <div class="finances-table-summary navigation">
                                <!-- Левый блок: выбор количества записей -->
                                <div class="footer-table-left">
                                    <div class="footer-table-pagination-wrapper">
                                        <span class="footer-text">Показувати</span>
                                        <div class="footer-select">
                                            <span>5</span>
                                            <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="Вниз" class="arrow-icon">
                                        </div>
                                    </div>
                                </div>

                                <div class="footer-table-right">
                                    <div class="footer-pagination-wrapper">
                                        <div class="footer-btn-group">
                                            <!-- Кнопка Назад -->
                                            <button class="footer-btn prev">
                                                <img src="{{ asset("themes/$theme/images/Left-arrow.svg") }}" alt="Назад" class="nav-icon">
                                                <span class="disabled-text">Попередня</span>
                                            </button>

                                            <!-- Номера страниц -->
                                            <button class="footer-btn active-page">1</button>
                                            <button class="footer-btn">2</button>
                                            <button class="footer-btn">3</button>

                                            <!-- Поле ввода номера страницы -->
                                            <input
                                                type="number"
                                                class="footer-page-input"
                                                min="1"
                                                placeholder="..."
                                            />

                                            <button class="footer-btn">5</button>
                                            <button class="footer-btn">6</button>

                                            <!-- Кнопка Вперед -->
                                            <button class="footer-btn next">
                                                <span>Наступна</span>
                                                <img src="{{ asset("themes/$theme/images/Arrow.svg") }}" alt="Вперед" class="nav-icon">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Вспливающие окошки -->
                    <div class="table-popup table-popup-order">
                        <div class="table-popup-item">
                            <img src="{{ asset("themes/$theme/images/file-search-2.svg") }}" class="table-popup-icon" alt="Деталі">
                            <span>Деталі замовлення</span>
                        </div>

                        <div class="table-popup-item">
                            <img src="{{ asset("themes/$theme/images/credit-card1.svg") }}" class="table-popup-icon" alt="Рахунок">
                            <span>Створити/Відкрити рахунок</span>
                        </div>
                    </div>

                    <div class="table-popup table-popup-file">
                        <div class="table-popup-item">
                            <img src="{{ asset("themes/$theme/images/share-2.svg") }}" class="table-popup-icon" alt="Поділитися">
                            <span>Поділитися</span>
                        </div>

                        <div class="table-popup-item">
                            <img src="{{ asset("themes/$theme/images/pencil-3.svg") }}" class="table-popup-icon" alt="Редагувати">
                            <span>Редагувати</span>
                        </div>
                    </div>

                    <div class="table-popup table-popup-status">
                        <div class="table-popup-status-header">Етапи замовлення</div>
                        <div class="table-popup-status-body">
                            <button class="status-btn status-btn-rahunok">
                                Прорахунок
                                <img src="{{ asset("themes/$theme/images/big-arrow-right.svg") }}" alt="" class="status-icon">
                            </button>

                            <button class="status-btn status-btn-pogodzenya">
                                Погодження
                                <img src="{{ asset("themes/$theme/images/big-arrow-right.svg") }}" alt="" class="status-icon">
                            </button>

                            <button class="status-btn status-btn-oplata">
                                Оплата
                                <img src="{{ asset("themes/$theme/images/big-green-arrow-right.svg") }}" alt="" class="status-icon">
                            </button>

                            <button class="status-btn status-btn-vyrobnytctvo">
                                Виробництво
                                <img src="{{ asset("themes/$theme/images/big-arrow-right.svg") }}" alt="" class="status-icon">
                            </button>

                            <button class="status-btn status-btn-logistica">
                                Логістика
                                <img src="{{ asset("themes/$theme/images/big-arrow-right.svg") }}" alt="" class="status-icon">
                            </button>

                            <button class="status-btn status-btn-reklamaciya">
                                Рекламація
                                <img src="{{ asset("themes/$theme/images/big-arrow-right.svg") }}" alt="" class="status-icon">
                            </button>

                            <button class="status-btn status-btn-vykonano">
                                Виконано
                            </button>
                        </div>


                        <!-- "Хвостик" снизу -->
                        <div class="table-popup-tip">
                            <img src="{{ asset("themes/$theme/images/tip.svg") }}" alt="tip">
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
                    <div class="invoice-request-overlay"></div>

                    <div class="invoice-request">
                        <!-- Заголовок -->
                        <div class="invoice-request-header">
                            <h2 class="invoice-request-title">
                                Запит на виставлення рахунку
                            </h2>
                            <img src="{{ asset("themes/$theme/images/close.svg") }}" alt="Закрити" class="invoice-request-close">

                        </div>

                        <div class="invoice-request-body">
                            <div class="form-row invoice-request-row">
                                <div class="invoice-request-col">
                                    <label class="invoice-request-label"
                                    >Назва платника</label
                                    >
                                    <input type="text" class="invoice-request-input" />
                                </div>
                                <div class="invoice-request-col">
                                    <label class="invoice-request-label"
                                    >Код ЄДРПОУ/ІПН</label
                                    >
                                    <input type="text" class="invoice-request-input" />
                                </div>
                            </div>

                            <div class="form-row invoice-request-row">
                                <div class="invoice-request-col">
                                    <label class="invoice-request-label"
                                    >Платник є платником ПДВ?</label
                                    >
                                    <label class="invoice-request-checkbox">
                                        <input type="checkbox" />
                                        <span>Так</span>
                                    </label>
                                    <label class="invoice-request-checkbox">
                                        <input type="checkbox" />
                                        <span>Ні</span>
                                    </label>
                                </div>
                                <div class="invoice-request-col">
                                    <label class="invoice-request-label"
                                    >Бюджетна організація</label
                                    >
                                    <label class="invoice-request-checkbox">
                                        <input type="checkbox" />
                                        <span>Так</span>
                                    </label>
                                    <label class="invoice-request-checkbox">
                                        <input type="checkbox" />
                                        <span>Ні</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-row invoice-request-row">
                                <label class="invoice-request-label"
                                >ПІБ контактної особи</label
                                >
                                <input type="text" class="invoice-request-input" />
                            </div>

                            <div class="form-row invoice-request-row">
                                <div class="invoice-request-col">
                                    <label class="invoice-request-label">Телефон</label>
                                    <input type="text" class="invoice-request-input" />
                                </div>
                                <div class="invoice-request-col">
                                    <label class="invoice-request-label">Email</label>
                                    <input type="text" class="invoice-request-input" />
                                </div>
                            </div>

                            <div class="form-row invoice-request-row">
                                <label class="invoice-request-label">Сума</label>
                                <input type="text" class="invoice-request-input" />
                            </div>

                            <div class="form-row invoice-request-row">
                                <div class="invoice-request-col">
                                    <label class="invoice-request-label"
                                    >Монтаж окремо?</label
                                    >
                                    <label class="invoice-request-checkbox">
                                        <input type="checkbox" />
                                        <span>Так</span>
                                    </label>
                                    <label class="invoice-request-checkbox">
                                        <input type="checkbox" />
                                        <span>Ні</span>
                                    </label>
                                </div>
                                <div class="invoice-request-col">
                                    <label class="invoice-request-label"
                                    >Потрібен договір?</label
                                    >
                                    <label class="invoice-request-checkbox">
                                        <input type="checkbox" />
                                        <span>Так</span>
                                    </label>
                                    <label class="invoice-request-checkbox">
                                        <input type="checkbox" />
                                        <span>Ні</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-row invoice-request-row">
                                <label class="invoice-request-label">Маржа</label>
                                <div class="invoice-request-field">
                                    Маржа:<span>-181.00 грн.</span>
                                </div>
                            </div>

                            <div class="form-row invoice-request-row">
                                <label class="invoice-request-label">Сума</label>
                                <div class="invoice-request-field">
                                    Загальна сума:<span> 181.00 грн.</span>
                                </div>
                            </div>
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
                            <img src="{{ asset("themes/$theme/images/close.svg") }}" alt="Закрити" class="order-close">

                        </div>

                        <!-- Контент -->
                        <div class="order-body">
                            <!-- Левый столбец -->
                            <div class="order-col left-col">
                                <div class="order-row">
                                    <span class="row-label">№ Замовлення:</span>
                                    <span class="row-content">DWN-10452</span>
                                </div>
                                <div class="order-row">
                                    <span class="row-label">Дата створення:</span>
                                    <span class="row-content">05.08.2025</span>
                                </div>
                                <div class="order-row">
                                    <span class="row-label">Клієнт:</span>
                                    <span class="row-content">ТОВ «Вектор»</span>
                                </div>
                                <div class="order-row">
                                    <span class="row-label">Адреса:</span>
                                    <span class="row-content"
                                    >м. Київ, проспект Голосіївський, 77</span
                                    >
                                </div>
                                <div class="order-row">
                                    <span class="row-label">Етап:</span>
                                    <div class="status-tracking">Виробництво</div>
                                </div>
                                <div class="order-row">
                                    <span class="row-label">Сума: </span>
                                    <span class="row-content">₴72 900</span>
                                </div>
                            </div>

                            <!-- Правый столбец -->
                            <div class="order-col right-col">
                                <button class="update-btn">
                                    <img src="{{ asset("themes/$theme/images/round-arrow.svg") }}" alt="Оновити">
                                    Оновити дані
                                </button>
                            </div>
                        </div>

                        <div class="order-divider"></div>

                        <!-- Футер меню -->
                        <div class="order-footer-table">
                            <div class="order-footer-menu">
                                <div class="order-menu-item active">
                                    <img src="{{ asset("themes/$theme/images/burger.svg") }}" alt="Склад">
                                    <span>Склад замовлення</span>
                                </div>

                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/credit-card1.svg") }}" alt="Технічні">
                                    <span>Технічні хар-ки</span>
                                </div>

                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" alt="Файли">
                                    <span>Файли</span>
                                </div>

                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/clock.svg") }}" alt="Історія">
                                    <span>Історія</span>
                                </div>

                            </div>

                            <!-- Контент после меню -->
                            <div class="order-extra-rows table-1">
                                <div class="extra-row">
                                    <div class="table-cell">Позиція</div>
                                    <div class="table-cell">К-сть</div>
                                    <div class="table-cell">Ціна</div>
                                    <div class="table-cell">Сума</div>
                                </div>
                                <div class="extra-row">
                                    <div class="table-cell">
                                        Вікно Euro-Design 70 (Siegenia Titan AF)
                                    </div>
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
                                    <div class="table-cell">
                                        Балконні двері Euro-Design 70 (Siegenia Titan AF)
                                    </div>
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
                        </div>

                        <div class="order-footer-table">
                            <div class="order-footer-menu">
                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/burger.svg") }}" alt="Склад">
                                    <span>Склад замовлення</span>
                                </div>

                                <div class="order-menu-item active">
                                    <img src="{{ asset("themes/$theme/images/credit-card1.svg") }}" alt="Технічні">
                                    <span>Технічні хар-ки</span>
                                </div>

                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" alt="Файли">
                                    <span>Файли</span>
                                </div>

                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/clock.svg") }}" alt="Історія">
                                    <span>Історія</span>
                                </div>
                            </div>


                            <div class="order-extra-rows table-2">
                                <div class="extra-row">
                                    <div class="table-cell">Позиція</div>
                                    <div class="table-cell">W, mm</div>
                                    <div class="table-cell">H, mm</div>
                                    <div class="table-cell">S, cm2</div>
                                    <div class="table-cell">Вага, кг</div>
                                </div>
                                <div class="extra-row">
                                    <div class="table-cell">
                                        Вікно Euro-Design 70 (Siegenia Titan AF)
                                    </div>
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
                                    <div class="table-cell">
                                        Балконні двері Euro-Design 70 (Siegenia Titan AF)
                                    </div>
                                    <div class="table-cell">578</div>
                                    <div class="table-cell">2680</div>
                                    <div class="table-cell">—</div>
                                    <div class="table-cell">70,767</div>
                                </div>
                            </div>
                        </div>

                        <div class="order-footer-table">
                            <div class="order-footer-menu">
                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/burger.svg") }}" alt="Склад">
                                    <span>Склад замовлення</span>
                                </div>

                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/credit-card1.svg") }}" alt="Технічні">
                                    <span>Технічні хар-ки</span>
                                </div>

                                <div class="order-menu-item active">
                                    <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" alt="Файли">
                                    <span>Файли</span>
                                </div>

                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/clock.svg") }}" alt="Історія">
                                    <span>Історія</span>
                                </div>
                            </div>


                            <div class="order-extra-rows table-3">
                                <div class="extra-row">
                                    <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" alt="Файли">
                                    <div class="table-cell">
                                        <span>Специфікація.pdf</span>
                                        <p>245 KB</p>
                                    </div>
                                </div>

                                <div class="extra-row">
                                    <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" alt="Файли">
                                    <div class="table-cell">
                                        <span>Замірні листи.xlsx</span>
                                        <p>89 KB</p>
                                    </div>
                                </div>

                                <div class="extra-row">
                                    <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" alt="Файли">
                                    <div class="table-cell">
                                        <span>Фото проекту.jpg</span>
                                        <p>1.2 MB</p>
                                    </div>
                                </div>

                                <div class="extra-row">
                                    <img src="{{ asset("themes/$theme/images/upload-cloud.svg") }}" alt="Файли">
                                    <p>
                                        Drag & drop file here or <a href="#">choose file</a>
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="order-footer-table">
                            <div class="order-footer-menu">
                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/burger.svg") }}" alt="Склад">
                                    <span>Склад замовлення</span>
                                </div>

                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/credit-card1.svg") }}" alt="Технічні">
                                    <span>Технічні хар-ки</span>
                                </div>

                                <div class="order-menu-item">
                                    <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" alt="Файли">
                                    <span>Файли</span>
                                </div>

                                <div class="order-menu-item active">
                                    <img src="{{ asset("themes/$theme/images/clock.svg") }}" alt="Історія">
                                    <span>Історія</span>
                                </div>
                            </div>


                            <div class="order-extra-rows table-4">
                                <div class="extra-row">
                                    <img src="{{ asset("themes/$theme/images/info.svg") }}" alt="Файли">
                                    <div class="table-cell">
                                        <span>Статус змінено на 'Виробництво'</span>
                                        <p>Іванов О.М. · 15.08.2025 14:30</p>
                                    </div>
                                </div>

                                <div class="extra-row">
                                    <img src="{{ asset("themes/$theme/images/info.svg") }}" alt="Файли">
                                    <div class="table-cell">
                                        <span>Платіж підтверджено - ₴56 000</span>
                                        <p>Петров С.В. · 10.08.2025 11:20</p>
                                    </div>
                                </div>

                                <div class="extra-row">
                                    <img src="{{ asset("themes/$theme/images/info.svg") }}" alt="Файли">
                                    <div class="table-cell">
                                        <span>Замовлення створено</span>
                                        <p>Система · 08.08.2025 16:45</p>
                                    </div>
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
                        <img src="{{ asset("themes/$theme/images/Loading WinDraw.svg") }}" alt="Icon" class="WinDraw-card-icon">


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
                        <img src="{{ asset("themes/$theme/images/WinDraw Successful.svg") }}" alt="Icon" class="WinDraw-card-icon">


                        <p class="WinDraw-title">Успішний вхід</p>
                        <p class="WinDraw-text">Перенаправляємо до WinDraw…</p>

                        <button class="WinDraw-footer-button">Відкрити зараз</button>
                    </div>

                    <!-- WinDraw Error-->
                    <div class="WinDraw-card">
                        <img src="{{ asset("themes/$theme/images/WinDraw Error.svg") }}" alt="Icon" class="WinDraw-card-icon">


                        <p class="WinDraw-title">Не вдалося увійти</p>
                        <p class="WinDraw-text">
                            Щось пішло не так. Спробуйте ще раз або перевірте статус сервісу.
                        </p>

                        <button class="WinDraw-footer-button">Повторити</button>
                        <p class="WinDraw-footer-text">Повернутися на дашборд</p>
                    </div>

                    <!-- WinDraw Closed-->
                    <div class="WinDraw-card">
                        <img src="{{ asset("themes/$theme/images/WinDraw Closed.svg") }}" alt="Icon" class="WinDraw-card-icon">

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
                    <img src="{{ asset("themes/$theme/images/Development, idea, keyboard.svg") }}" alt="Иконка" class="promo-info-icon">

                    <h1 class="promo-title">
                        Вибачте, наразі ведеться розробка сторінки
                    </h1>
                    <p class="promo-text">
                        Ми вже працюємо над цим розділом — поверніться трохи згодом.
                    </p>
                </div>
            </div>

            <!-- Дашборд-->
            <div class="Dashboard-content">
                <div class="Dashboard-header">
                    <h1>Дашборд</h1>
                    <p>Вітаємо, Андрію!</p>
                </div>

                <div class="Dashboard-bottom-content">
                    <div class="dashboard-section-cards-top">
                        <div class="dashboard-card-top">
                            <div class="dashboard-card-top-texts">
                                <span class="dashboard-card-label">Усього</span>
                                <h2 class="dashboard-card-value">28</h2>
                                <span class="dashboard-card-subtext"
                                >Замовлень за весь період</span
                                >
                            </div>
                            <img src="{{ asset("themes/$theme/images/package.svg") }}" alt="Іконка" class="dashboard-card-top-icon">

                        </div>
                        <div class="dashboard-card-top">
                            <div class="dashboard-card-top-texts">
                                <span class="dashboard-card-label">В роботі</span>
                                <h2 class="dashboard-card-value">7</h2>
                                <span class="dashboard-card-subtext"
                                >Оплата, виробництво, логістика, рекламація</span
                                >
                            </div>
                            <img src="{{ asset("themes/$theme/images/flow.svg") }}" alt="Іконка" class="dashboard-card-top-icon">
                        </div>
                        <div class="dashboard-card-top">
                            <div class="dashboard-card-top-texts">
                                <span class="dashboard-card-label">Виконано</span>
                                <h2 class="dashboard-card-value">5</h2>
                                <span class="dashboard-card-subtext"
                                >Дохід за період — <span>₴392 000</span>
                    </span>
                            </div>
                            <img src="{{ asset("themes/$theme/images/pocket.svg") }}" alt="Іконка" class="dashboard-card-top-icon">
                        </div>
                        <div class="dashboard-card-top">
                            <div class="dashboard-card-top-texts">
                                <span class="dashboard-card-label">Очікує оплати</span>
                                <h2 class="dashboard-card-value">6</h2>
                                <span class="dashboard-card-subtext"
                                >Борг складає — <span>₴ 124 750</span></span
                                >
                            </div>
                            <img src="{{ asset("themes/$theme/images/info-box.svg") }}" alt="Іконка" class="dashboard-card-top-icon">
                        </div>
                    </div>

                    <div class="dashboard-section-charts">
                        <div class="dashboard-chart-plane-cart">
                            <div class="dashboard-chart-plane-header">
                                <h2>Динаміка замовлень</h2>
                                <button
                                    class="control-dashboard-btn control-range"
                                    type="button"
                                >
                                    <img src="{{ asset("themes/$theme/images/calendar-dots.svg") }}" alt="" class="btn-icon">
                                    За 30 днів
                                    <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="btn-icon-right">

                                </button>
                            </div>
                            <div class="dashboard-chart-plane">
                                <!-- Здесь будет график -->
                            </div>
                            <div class="dashboard-chart-plane-footer">
                                <div class="chart-item">
                                    <span class="legend-color Order"></span>
                                    <span class="legend-text">Замовлення</span>
                                </div>
                                <div class="chart-item">
                                    <span class="legend-color Income"></span>
                                    <span class="legend-text">Дохід</span>
                                </div>
                            </div>
                        </div>

                        <div class="dashboard-chart-circle-cart">
                            <!-- Заголовок -->
                            <div class="dashboard-chart-circle-header">
                                Розподіл за етапами
                            </div>

                            <div class="dashboard-chart-circle-body">
                                <!-- Круговой график -->
                                <div class="dashboard-chart-circle"></div>

                                <!-- Квадратики с цветом и текстом -->
                                <div class="dashboard-chart-legend">
                                    <div class="chart-legend-item">
                                        <span class="legend-color Miscalculation"></span>
                                        <span class="legend-text">Прорахунок</span>
                                    </div>
                                    <div class="chart-legend-item">
                                        <span class="legend-color Coordination"></span>
                                        <span class="legend-text">Погодження</span>
                                    </div>
                                    <div class="chart-legend-item">
                                        <span class="legend-color Payment"></span>
                                        <span class="legend-text">Оплата</span>
                                    </div>
                                    <div class="chart-legend-item">
                                        <span class="legend-color Production"></span>
                                        <span class="legend-text">Виробництво</span>
                                    </div>
                                    <div class="chart-legend-item">
                                        <span class="legend-color Logistics"></span>
                                        <span class="legend-text">Логістика</span>
                                    </div>
                                    <div class="chart-legend-item">
                                        <span class="legend-color Complaint"></span>
                                        <span class="legend-text">Рекламація</span>
                                    </div>
                                    <div class="chart-legend-item">
                                        <span class="legend-color Done"></span>
                                        <span class="legend-text">Виконано</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Надпись под графиком -->
                            <div class="dashboard-chart-circle-footer">
                                <span>За весь період</span>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-section-table-payments">
                        <h2>Платежі</h2>
                        <div class="table-payments">
                            <div class="table-payments-rows">
                                <div class="table-payments-row">
                                    <div class="table-cell">№ Замовлення</div>
                                    <div class="table-cell">Клієнт</div>
                                    <div class="table-cell">Сума</div>
                                    <div class="table-cell">Статус</div>
                                    <div class="table-cell">Дата</div>
                                </div>

                                <div class="table-payments-row">
                                    <div class="table-cell">DWN-10452</div>
                                    <div class="table-cell">ЖК «Парковий»</div>
                                    <div class="table-cell">₴128 400</div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Partially">
                                            Частково
                                        </button>
                                    </div>
                                    <div class="table-cell">02.08.2025</div>
                                </div>

                                <div class="table-payments-row">
                                    <div class="table-cell">DWN-10452</div>
                                    <div class="table-cell">ТОВ «Вектор»</div>
                                    <div class="table-cell">₴128 400</div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Paid">
                                            Сплачено
                                        </button>
                                    </div>
                                    <div class="table-cell">05.08.2025</div>
                                </div>
                                <div class="table-payments-row">
                                    <div class="table-cell">DWN-10452</div>
                                    <div class="table-cell">ОСББ «Гольфстрім»</div>
                                    <div class="table-cell">₴128 400</div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Paid">
                                            Сплачено
                                        </button>
                                    </div>
                                    <div class="table-cell">07.08.2025</div>
                                </div>

                                <div class="table-payments-row">
                                    <div class="table-cell">DWN-10452</div>
                                    <div class="table-cell">Приватний клієнт</div>
                                    <div class="table-cell">₴128 400</div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Not-Paid">
                                            Не сплачено
                                        </button>
                                    </div>
                                    <div class="table-cell">08.08.2025</div>
                                </div>
                                <div class="table-payments-row">
                                    <div class="table-cell">DWN-10452</div>
                                    <div class="table-cell">Приватний клієнт</div>
                                    <div class="table-cell">₴128 400</div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Partially">
                                            Частково
                                        </button>
                                    </div>
                                    <div class="table-cell">11.08.2025</div>
                                </div>
                                <div class="table-payments-row">
                                    <a href="#" class="payment-link">
                                        Усі платежі
                                        <img src="{{ asset("themes/$theme/images/Green-arrow.svg") }}" alt="Green-arrow" class="msg-arrow-icon">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-section-table-shipment">
                        <h2>Відвантаження</h2>
                        <div class="table-shipment">
                            <div class="table-shipment-rows">
                                <div class="table-shipment-row">
                                    <div class="table-cell">№ Замовлення</div>
                                    <div class="table-cell">Клієнт</div>
                                    <div class="table-cell">ЕТА</div>
                                    <div class="table-cell">Статус</div>
                                </div>

                                <div class="table-shipment-row">
                                    <div class="table-cell">DWN-10452</div>
                                    <div class="table-cell">ЖК «Парковий»</div>
                                    <div class="table-cell">02.08</div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn En-route">
                                            В дорозі
                                        </button>
                                    </div>
                                </div>

                                <div class="table-shipment-row">
                                    <div class="table-cell">DWN-10452</div>
                                    <div class="table-cell">ТОВ «Вектор»</div>
                                    <div class="table-cell">05.08</div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Delivered">
                                            Готово до відвантаження
                                        </button>
                                    </div>
                                </div>
                                <div class="table-shipment-row">
                                    <div class="table-cell">DWN-10452</div>
                                    <div class="table-cell">ОСББ «Гольфстрім»</div>
                                    <div class="table-cell">07.08</div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Ready">
                                            Доставлено
                                        </button>
                                    </div>
                                </div>

                                <div class="table-shipment-row">
                                    <div class="table-cell">DWN-10452</div>
                                    <div class="table-cell">ОСББ «Гольфстрім»</div>
                                    <div class="table-cell">08.08</div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Delivered">
                                            Готово до відвантаження
                                        </button>
                                    </div>
                                </div>
                                <div class="table-shipment-row">
                                    <div class="table-cell">DWN-10452</div>
                                    <div class="table-cell">Приватний клієнт</div>
                                    <div class="table-cell">11.08</div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn En-route">
                                            В дорозі
                                        </button>
                                    </div>
                                </div>
                                <div class="table-shipment-row">
                                    <a href="#" class="payment-link">
                                        Уся логістика
                                        <img src="{{ asset("themes/$theme/images/Green-arrow.svg") }}" alt="Green-arrow" class="msg-arrow-icon">
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
            </div>

            <!-- Мотивація-->
            <div class="motivation-content">
                <div class="motivation-header">
                    <h1 class="motivation-title">Мотивація</h1>
                    <button
                        class="control-motivation-btn control-range"
                        type="button"
                    >
                        <img src="{{ asset("themes/$theme/images/calendar-dots.svg") }}" alt="" class="btn-icon" aria-hidden="true">
                        За 30 днів
                        <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="btn-icon-right" aria-hidden="true">

                    </button>

                    <!-- Выпадающий список для мотивации -->
                    <div class="table-popup table-popup-motivation">
                        <span class="table-popup-sort-item">За сьогодні</span>
                        <span class="table-popup-sort-item">За 7 днів</span>
                        <span class="table-popup-sort-item">За 30 днів</span>
                        <span class="table-popup-sort-item">За 90 днів</span>
                        <span class="table-popup-sort-item">За 180 днів</span>
                        <span class="table-popup-sort-item">За рік</span>
                    </div>
                </div>

                <div class="motivation-body">
                    <div class="motivation-cards-top">
                        <div class="motivation-card">
                            <div class="motivation-card-texts">
                    <span class="motivation-card-label"
                    >Зароблено<br />бонусів</span
                    >
                                <h2 class="motivation-card-value">₴24 600</h2>
                                <span class="motivation-card-subtext">За період</span>
                            </div>
                            <img src="{{ asset("themes/$theme/images/pocket.svg") }}" alt="Іконка" class="motivation-card-icon">

                        </div>

                        <div class="motivation-card">
                            <div class="motivation-card-texts">
                    <span class="motivation-card-label"
                    >Прогрес<br />до цілі</span
                    >
                                <h2 class="motivation-card-value">68%</h2>
                                <span class="motivation-card-subtext">
                      Залишилось <span>₴11 200</span>
                    </span>
                            </div>
                            <img src="{{ asset("themes/$theme/images/BLue-info.svg") }}" alt="Іконка" class="motivation-card-icon">

                        </div>

                        <div class="motivation-card">
                            <div class="motivation-card-texts">
                    <span class="motivation-card-label"
                    >Час до<br />завершення</span
                    >
                                <h2 class="motivation-card-value">12</h2>
                                <span class="motivation-card-subtext"
                                >Поточна програма</span
                                >
                            </div>
                            <img src="{{ asset("themes/$theme/images/Orange watches.svg") }}" alt="Іконка" class="motivation-card-icon">

                        </div>

                        <div class="motivation-card">
                            <div class="motivation-card-texts">
                    <span class="motivation-card-label"
                    >Активні<br />програми</span
                    >
                                <h2 class="motivation-card-value">7</h2>
                                <span class="motivation-card-subtext">Доступні наразі</span>
                            </div>
                            <img src="{{ asset("themes/$theme/images/Active programs.svg") }}" alt="Іконка" class="motivation-card-icon">

                        </div>
                    </div>

                    <div class="motivation-content-bottom">
                        <div class="motivation-programs">
                            <h2>Програми мотивації</h2>
                            <div class="motivation-programs-table">
                                <div class="extra-row">
                                    <div class="table-cell">Програми</div>
                                    <div class="table-cell">Статус</div>
                                    <div class="table-cell">План/Факт</div>
                                    <div class="table-cell">Дедлайн</div>
                                    <div class="table-cell">Виплата</div>
                                    <div class="table-cell">Прогрес</div>
                                    <div class="table-cell">Дії</div>
                                </div>
                                <div class="extra-row">
                                    <div class="table-cell">
                                        <h3>Ретробонус — серпень 2025</h3>
                                        <p>01.08–31.08.2025</p>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Active">
                                            Активна
                                        </button>
                                    </div>
                                    <div class="table-cell">₴50 000 / ₴38 800</div>
                                    <div class="table-cell">31.08.2025</div>
                                    <div class="table-cell">₴7 500</div>
                                    <div class="table-cell progress-wrapper">
                                        <div class="progress-bar">
                                            <div class="progress-bar-full"></div>
                                        </div>
                                        <span class="progress-value">78%</span>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Details">
                                            Деталі
                                        </button>
                                    </div>
                                </div>
                                <div class="extra-row">
                                    <div class="table-cell">
                                        <h3>Ретробонус — серпень 2025</h3>
                                        <p>01.08–31.08.2025</p>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Active">
                                            Активна
                                        </button>
                                    </div>
                                    <div class="table-cell">₴50 000 / ₴38 800</div>
                                    <div class="table-cell">31.08.2025</div>
                                    <div class="table-cell">₴7 500</div>
                                    <div class="table-cell progress-wrapper">
                                        <div class="progress-bar">
                                            <div class="progress-bar-full"></div>
                                        </div>
                                        <span class="progress-value">78%</span>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Details">
                                            Деталі
                                        </button>
                                    </div>
                                </div>
                                <div class="extra-row">
                                    <div class="table-cell">
                                        <h3>Ретробонус — серпень 2025</h3>
                                        <p>01.08–31.08.2025</p>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Completed">
                                            Завершена
                                        </button>
                                    </div>
                                    <div class="table-cell">₴50 000 / ₴38 800</div>
                                    <div class="table-cell">31.08.2025</div>
                                    <div class="table-cell">₴7 500</div>
                                    <div class="table-cell progress-wrapper">
                                        <div class="progress-bar active">
                                            <div class="progress-bar-full"></div>
                                        </div>
                                        <span class="progress-value">104%</span>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Details">
                                            Деталі
                                        </button>
                                    </div>
                                </div>
                                <div class="extra-row">
                                    <div class="table-cell">
                                        <h3>Ретробонус — серпень 2025</h3>
                                        <p>01.08–31.08.2025</p>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Active">
                                            Активна
                                        </button>
                                    </div>
                                    <div class="table-cell">₴50 000 / ₴38 800</div>
                                    <div class="table-cell">31.08.2025</div>
                                    <div class="table-cell">₴7 500</div>
                                    <div class="table-cell progress-wrapper">
                                        <div class="progress-bar">
                                            <div class="progress-bar-full"></div>
                                        </div>
                                        <span class="progress-value">78%</span>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Details">
                                            Деталі
                                        </button>
                                    </div>
                                </div>
                                <div class="extra-row">
                                    <div class="table-cell">
                                        <h3>Ретробонус — серпень 2025</h3>
                                        <p>01.08–31.08.2025</p>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Ending">
                                            Завершується
                                        </button>
                                    </div>
                                    <div class="table-cell">₴50 000 / ₴38 800</div>
                                    <div class="table-cell">31.08.2025</div>
                                    <div class="table-cell">₴7 500</div>
                                    <div class="table-cell progress-wrapper">
                                        <div class="progress-bar">
                                            <div class="progress-bar-full"></div>
                                        </div>
                                        <span class="progress-value">78%</span>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Details">
                                            Деталі
                                        </button>
                                    </div>
                                </div>
                                <div class="extra-row">
                                    <div class="table-cell">
                                        <h3>Ретробонус — серпень 2025</h3>
                                        <p>01.08–31.08.2025</p>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Active">
                                            Активна
                                        </button>
                                    </div>
                                    <div class="table-cell">₴50 000 / ₴38 800</div>
                                    <div class="table-cell">31.08.2025</div>
                                    <div class="table-cell">₴7 500</div>
                                    <div class="table-cell progress-wrapper">
                                        <div class="progress-bar">
                                            <div class="progress-bar-full"></div>
                                        </div>
                                        <span class="progress-value">78%</span>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Details">
                                            Деталі
                                        </button>
                                    </div>
                                </div>
                                <div class="extra-row">
                                    <div class="table-cell">
                                        <h3>Ретробонус — серпень 2025</h3>
                                        <p>01.08–31.08.2025</p>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Active">
                                            Активна
                                        </button>
                                    </div>
                                    <div class="table-cell">₴50 000 / ₴38 800</div>
                                    <div class="table-cell">31.08.2025</div>
                                    <div class="table-cell">₴7 500</div>
                                    <div class="table-cell progress-wrapper">
                                        <div class="progress-bar">
                                            <div class="progress-bar-full"></div>
                                        </div>
                                        <span class="progress-value">78%</span>
                                    </div>
                                    <div class="table-cell">
                                        <button class="table-finance-Status-btn Details">
                                            Деталі
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="differentiated-discounts">
                            <h2>Диференційовані знижки (щомісячна драбина)</h2>
                            <p>
                                Накопичувальна мотивація за місяць: кроки від обороту
                                визначають % знижки/бонусу. Додатково: +0,5% за прорахунок у
                                WinDraw; 5% — при оплаті готівкою за передплатою.
                            </p>
                            <div class="differentiated-discounts-table">
                                <div class="differentiated-discounts-table-header">
                                    <button class="differentiated-discounts-active-btn">
                                        Активна
                                    </button>
                                </div>

                                <div class="discount-row">
                                    <label class="discount-option">
                                        <input type="radio" name="discount" />
                                        <span class="label-text">до ₴50 000</span>
                                        <span class="value">Ще трохи до 1% — активізуйся!</span>
                                    </label>
                                </div>

                                <div class="discount-row">
                                    <label class="discount-option">
                                        <input type="radio" name="discount" />
                                        <span class="label-text">₴50 000 — ₴100 000</span>
                                        <span class="value">1%</span>
                                    </label>
                                </div>

                                <div class="discount-row">
                                    <label class="discount-option">
                                        <input type="radio" name="discount" />
                                        <span class="label-text">₴100 000 — ₴150 000</span>
                                        <span class="value">1,5%</span>
                                    </label>
                                </div>
                                <div class="discount-row">
                                    <label class="discount-option">
                                        <input type="radio" name="discount" />
                                        <span class="label-text">₴150 000 — ₴300 000</span>
                                        <span class="value">3%</span>
                                    </label>
                                </div>
                                <div class="discount-row">
                                    <label class="discount-option">
                                        <input type="radio" name="discount" />
                                        <span class="label-text">₴300 000 — ₴500 000</span>
                                        <span class="value">4%</span>
                                    </label>
                                </div>
                                <div class="discount-row active">
                                    <label class="discount-option">
                                        <input type="radio" name="discount" checked />
                                        <span class="label-text">₴500 000 — ₴1 000 000</span>
                                        <span class="value">4,5%</span>
                                    </label>
                                </div>
                                <div class="discount-row">
                                    <label class="discount-option">
                                        <input type="radio" name="discount" />
                                        <span class="label-text">₴1 000 000 — ₴2 000 000</span>
                                        <span class="value">5,5%</span>
                                    </label>
                                </div>
                                <div class="discount-row">
                                    <label class="discount-option">
                                        <input type="radio" name="discount" />
                                        <span class="label-text">₴2 000 000 — ₴3 000 000</span>
                                        <span class="value">6</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mp-popup-overlay"></div>
            <div class="mp-popup">
                <div class="mp-popup-header">
                    <h2 class="mp-popup-title">Мої програми мотивації</h2>
                    <img src="{{ asset("themes/$theme/images/close.svg") }}" alt="Закрити" class="mp-popup-close">

                </div>

                <div class="mp-popup-body">
                    <div class="mp-popup-block">
                        <h2>Ретробонус — серпень 2025</h2>
                        <button class="mp-popup-status-btn">Активна</button>
                        <div class="mp-popup-divider"></div>
                    </div>

                    <div class="mp-popup-block">
                        <h2>Опис</h2>
                        <p class="mp-popup-text">
                            Щомісячна програма ретробонусу для активних дилерів Darwin.
                            Бонус нараховується від обороту за підсумками місяця.
                        </p>
                    </div>

                    <div class="mp-popup-block">
                        <h2>Умови</h2>
                        <ul class="mp-popup-list">
                            <li>
                                <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="">
                                <p>Мінімальний оборот ₴50 000 за місяць</p>
                            </li>
                            <li>
                                <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="">
                                <p>Бренди: REHAU, MACO, ALUPROF, SIEGENIA.</p>
                            </li>
                            <li>
                                <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="">
                                <p>Додатково: +0,5% за прорахунок у WinDraw.</p>
                            </li>
                            <li>
                                <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="">
                                <p>Оплата готівкою за передплатою — знижка 5% одразу в ціні.</p>
                            </li>
                            <li>
                                <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="">
                                <p>Диференційована щомісячна драбина: 1% … 6%.</p>
                            </li>
                        </ul>
                    </div>

                    <div class="mp-popup-block">
                        <h2>Мій прогрес</h2>
                        <div class="mp-popup-progress-block">
                            <div class="mp-popup-progress-row">
                                <p>Поточний оборот</p>
                                <span>₴838 800</span>
                            </div>
                            <div class="mp-popup-progress-row">
                                <p>Поточний, %</p>
                                <span>4,5%</span>
                            </div>
                            <div class="mp-popup-progress-row">
                                <p>Очікувана виплата</p>
                                <span>₴7 500</span>
                            </div>
                            <div class="mp-popup-progress-bar">
                                <div class="mp-popup-progress-fill"></div>
                            </div>
                            <div class="mp-popup-progress-row">
                                <p>До наступного кроку</p>
                                <span>₴11 200</span>
                            </div>
                        </div>
                    </div>

                    <div class="mp-popup-block">
                        <h2>Внесок замовлень</h2>
                        <table class="mp-popup-table">
                            <tr>
                                <td>№</td>
                                <td>Дата</td>
                                <td>Сума</td>
                                <td>Коеф.</td>
                            </tr>
                            <tr>
                                <td>DWN-10452</td>
                                <td>04.08.2025</td>
                                <td>₴5 600</td>
                                <td>1,2</td>
                            </tr>
                            <tr>
                                <td>DWN-10452</td>
                                <td>04.08.2025</td>
                                <td>₴5 600</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>DWN-10452</td>
                                <td>04.08.2025</td>
                                <td>₴5 600</td>
                                <td>1</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mp-popup-block">
                        <h2>Історія виплат</h2>
                        <table class="mp-popup-table">
                            <tr>
                                <td>№</td>
                                <td>Дата</td>
                                <td>Сума</td>
                                <td>Статус</td>
                            </tr>
                            <tr>
                                <td>DWN-10452</td>
                                <td>04.08.2025</td>
                                <td>₴5 600</td>
                                <td>Виплачено</td>
                            </tr>
                            <tr>
                                <td>DWN-10452</td>
                                <td>04.08.2025</td>
                                <td>₴5 600</td>
                                <td>Виплачено</td>
                            </tr>
                        </table>
                    </div>

                    <div class="mp-popup-block">
                        <h2>Нарахування бонусів — спосіб оплати</h2>
                        <div class="mp-popup-bonus-block">
                            <div class="mp-popup-bonus-row">
                                <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="">
                                <p>
                                    <strong>Безготівково:</strong> бонус за період
                                    зараховується на баланс дилера. За потреби — вивід
                                    готівкою до 15% від суми.
                                </p>
                            </div>

                            <div class="mp-popup-bonus-row">
                                <img src="{{ asset("themes/$theme/images/check-circle.svg") }}" alt="">
                                <p>
                                    <strong>Оплата готівкою:</strong> 5% знижки одразу в
                                    прайсі; місячний бонус рахується з остаточної суми
                                    періоду.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mp-popup-divider"></div>

                    <button class="mp-popup-complete-btn">Завершити участь</button>
                </div>
            </div>

            <!-- Фінанси -->
            <div class="finances-container">
                <!-- Заголовок -->
                <div class="finances-header">
                    <h1 class="finances-title">Фінанси</h1>
                </div>

                <!-- Нижний блок -->
                <div class="finances-panel">
                    <!-- Внутренний контент сюда -->
                    <div class="finances-panel-head">
                        <h2 class="finances-subtitle">Акт звірки</h2>

                        <div class="finances-actions">
                            <button class="finances-btn">
                                <img
                                    src="images/Upload.svg"
                                    alt=""
                                    class="btn-icon"
                                    aria-hidden="true"
                                />
                                <p class="btn-text">Експорт (XLSX)</p>
                            </button>

                            <button class="finances-btn finances-date-btn">
                                <img
                                    src="images/calendar-dots.svg"
                                    alt=""
                                    class="btn-icon"
                                    aria-hidden="true"
                                />
                                <p class="btn-text">За 30 днів</p>
                                <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="btn-icon-right" aria-hidden="true">

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

                    <div class="finances-cards">
                        <div class="finances-card finances-card--green">
                            <p class="card-text">Початковий баланс</p>
                            <span class="card-value">₴0</span>
                            <img
                                src="{{ asset("themes/$theme/images/Green checkmark box.svg") }}"
                                alt=""
                                class="card-icon"
                            />
                        </div>

                        <div class="finances-card finances-card--blue">
                            <p class="card-text">Нараховано (рахунки)</p>
                            <span class="card-value">₴128 400</span>
                            <img
                                src="{{ asset("themes/$theme/images/Blue checkmark box.svg") }}"
                                alt=""
                                class="card-icon"
                            />
                        </div>

                        <div class="finances-card finances-card--orange">
                            <p class="card-text">Оплачено / списано</p>
                            <span class="card-value">₴96 200</span>
                            <img
                                src="{{ asset("themes/$theme/images/Orange checkmark box.svg") }}"
                                alt=""
                                class="card-icon"
                            />
                        </div>

                        <div class="finances-card finances-card--purple">
                            <p class="card-text">Кінцевий баланс</p>
                            <span class="card-value">₴32 200</span>
                            <img
                                src="{{ asset("themes/$theme/images/Purple checkmark box.svg") }}"
                                alt=""
                                class="card-icon"
                            />
                        </div>

                    </div>

                    <div class="finances-table-wrapper">
                        <div class="finances-table-scroll">
                            <table class="finances-table">
                                <thead>
                                <tr>
                                    <th>
                                        Дата створення
                                        <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="th-icon">
                                    </th>
                                    <th>№ Замовлення</th>
                                    <th>Етап</th>
                                    <th>Клієнт</th>
                                    <th>Дебет, ₴</th>
                                    <th>Кредит, ₴</th>
                                    <th>Баланс, ₴</th>
                                    <th>Дата оплати</th>
                                    <th>Сума оплати, ₴</th>
                                    <th>Сума клієнта, ₴</th>
                                    <th>Собівартість, ₴</th>
                                    <th>Маржа дилера, ₴</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>02.08.2025</td>
                                    <td>DWN-10452</td>
                                    <td><button data-type="Score">Рахунок</button></td>
                                    <td>ЖК «Парковий»</td>
                                    <td class="debet">₴12 840</td>
                                    <td class="credit">—</td>
                                    <td>₴34 800</td>
                                    <td>—</td>
                                    <td>—</td>
                                    <td>₴34 800</td>
                                    <td>₴34 800</td>
                                    <td class="profit">₴7 800</td>
                                </tr>
                                <tr>
                                    <td>02.08.2025</td>
                                    <td>DWN-10453</td>
                                    <td><button data-type="Payment">Рахунок</button></td>
                                    <td>ЖК «Парковий»</td>
                                    <td class="debet">₴12 840</td>
                                    <td class="credit">—</td>
                                    <td>₴34 800</td>
                                    <td>—</td>
                                    <td>—</td>
                                    <td>₴34 800</td>
                                    <td>₴34 800</td>
                                    <td class="profit">₴7 800</td>
                                </tr>
                                <tr>
                                    <td>02.08.2025</td>
                                    <td>DWN-10454</td>
                                    <td>
                                        <button data-type="Subscription">Рахунок</button>
                                    </td>
                                    <td>ЖК «Парковий»</td>
                                    <td class="debet">₴12 840</td>
                                    <td class="credit">—</td>
                                    <td>₴34 800</td>
                                    <td>—</td>
                                    <td>—</td>
                                    <td>₴34 800</td>
                                    <td>₴34 800</td>
                                    <td class="profit">₴7 800</td>
                                </tr>
                                <tr>
                                    <td>02.08.2025</td>
                                    <td>DWN-10455</td>
                                    <td><button data-type="Payment">Рахунок</button></td>
                                    <td>ЖК «Парковий»</td>
                                    <td class="debet">₴12 840</td>
                                    <td class="credit">—</td>
                                    <td>₴34 800</td>
                                    <td>—</td>
                                    <td>—</td>
                                    <td>₴34 800</td>
                                    <td>₴34 800</td>
                                    <td class="profit">₴7 800</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Итоговая строка -->
                        <div class="finances-table-summary">
                            <div class="summary-cell">Підсумок за період</div>
                            <div class="summary-cell"></div>
                            <div class="summary-cell"></div>
                            <div class="summary-cell">
                                Дебет<br /><span class="debet">₴128 400</span>
                            </div>
                            <div class="summary-cell">
                                Кредит<br /><span class="credit">₴24 600</span>
                            </div>
                            <div class="summary-cell">
                                Баланс<br /><span>₴32 400</span>
                            </div>
                            <div class="summary-cell">
                                Сума оплат<br /><span>₴96 400</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="finances-panel">
                    <div class="finances-panel-head">
                        <h2 class="finances-subtitle">Стан оплат по замовленнях</h2>

                        <div class="finances-actions">
                            <button class="finances-btn">
                                <img
                                    src="images/Upload.svg"
                                    alt=""
                                    class="btn-icon"
                                    aria-hidden="true"
                                />
                                <p class="btn-text">Експорт (XLSX)</p>
                            </button>

                            <button class="finances-btn finances-date-btn">
                                <img
                                    src="images/calendar-dots.svg"
                                    alt=""
                                    class="btn-icon"
                                    aria-hidden="true"
                                />
                                <p class="btn-text">За 30 днів</p>
                                <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="btn-icon-right" aria-hidden="true">

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

                    <div class="finances-cards finances-cards--three">
                        <div class="finances-card finances-card--green">
                            <p class="card-text">Передплата (аванс)</p>
                            <span class="card-value">₴500 000</span>
                            <img
                                src="{{ asset("themes/$theme/images/Green checkmark box.svg") }}"
                                alt=""
                                class="card-icon"
                            />
                        </div>

                        <div class="finances-card finances-card--blue">
                            <p class="card-text">
                                Загальний борг по замовленнях (в роботі та відвантажених)
                            </p>
                            <span class="card-value">₴1 200 000</span>
                            <img
                                src="{{ asset("themes/$theme/images/Blue checkmark box.svg") }}"
                                alt=""
                                class="card-icon"
                            />
                        </div>

                        <div class="finances-card finances-card--orange">
                            <p class="card-text">Борг по відвантаженим замовленням</p>
                            <span class="card-value">₴300 000</span>
                            <img
                                src="{{ asset("themes/$theme/images/Orange checkmark box.svg") }}"
                                alt=""
                                class="card-icon"
                            />
                        </div>

                    </div>

                    <div class="finances-table-wrapper finances-table-wrapper-simple">
                        <table class="finances-table">
                            <thead>
                            <tr>
                                <th>
                        <span class="th-sort">
                          Дата створення
                         <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="th-icon">

                        </span>
                                </th>
                                <th>№ Замовлення</th>
                                <th>Клієнт</th>
                                <th>Сума передплати (аванс), ₴</th>
                                <th>Борг загальний, ₴</th>
                                <th>Борг по відвантаженим замовленням, ₴</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>02.08.2025</td>
                                <td>DWN-10452</td>
                                <td>ЖК «Парковий»</td>
                                <td>₴12 840</td>
                                <td class="debt">₴12 840</td>
                                <td class="debt">₴12 840</td>
                            </tr>
                            <tr>
                                <td>02.08.2025</td>
                                <td>DWN-10452</td>
                                <td>ЖК «Парковий»</td>
                                <td>₴12 840</td>
                                <td class="debt">₴12 840</td>
                                <td class="debt">₴12 840</td>
                            </tr>
                            <tr>
                                <td>02.08.2025</td>
                                <td>DWN-10452</td>
                                <td>ЖК «Парковий»</td>
                                <td>₴12 840</td>
                                <td class="debt">₴12 840</td>
                                <td class="debt">₴12 840</td>
                            </tr>
                            <tr>
                                <td>02.08.2025</td>
                                <td>DWN-10452</td>
                                <td>ЖК «Парковий»</td>
                                <td>₴12 840</td>
                                <td class="debt">₴12 840</td>
                                <td class="debt">₴12 840</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Підсумок за період</td>
                                <td></td>
                                <td></td>
                                <td>₴128 400</td>
                                <td class="debt">₴24 600</td>
                                <td>₴32 400</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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
                                        <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="select-arrow">
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
                                        <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="select-arrow">

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
                                    src="images/Upload.svg"
                                    alt=""
                                    class="btn-icon"
                                    aria-hidden="true"
                                />
                                <p class="btn-text">Експорт (XLSX)</p>
                            </button>

                            <button class="finances-btn finances-date-btn">
                                <img
                                    src="images/calendar-dots.svg"
                                    alt=""
                                    class="btn-icon"
                                    aria-hidden="true"
                                />
                                <p class="btn-text">За 30 днів</p>
                                <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="btn-icon-right" aria-hidden="true">

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
        </div>
        <!-- Рекламації -->
        <div class="complaints-container">
            <div class="complaints-header">
                <h1 class="complaints-title">Рекламації</h1>
                <button class="New-complaint-btn">Нова рекламація</button>
            </div>

            <div class="complaints-bottom-content">
                <div class="complaints-panel">
                    <!-- Внутренний контент сюда -->
                    <div class="complaints-panel-head Twisting">
                        <h2 class="complaints-subtitle">Акт звірки</h2>

                        <div class="controls-right">
                            <button class="control-btn control-export" type="button">
                                <img
                                    src="images/Upload.svg"
                                    alt=""
                                    class="btn-icon"
                                    aria-hidden="true"
                                />
                                Експорт (XLSX)
                            </button>

                            <button class="control-btn control-range" type="button">
                                <img
                                    src="images/calendar-dots.svg"
                                    alt=""
                                    class="btn-icon"
                                    aria-hidden="true"
                                />
                                За 30 днів
                                <img src="{{ asset("themes/$theme/images/Arrow-Down.svg") }}" alt="" class="btn-icon-right" aria-hidden="true">

                            </button>
                        </div>
                    </div>

                    <div class="finances-cards">
                        <div class="finances-card finances-card--green">
                            <p class="card-text">Початковий баланс</p>
                            <span class="card-value">₴0</span>
                            <img
                                src="{{ asset("themes/$theme/images/Green checkmark box.svg") }}"
                                alt=""
                                class="card-icon"
                            />
                        </div>

                        <div class="finances-card finances-card--blue">
                            <p class="card-text">Нараховано (рахунки)</p>
                            <span class="card-value">₴128 400</span>
                            <img
                                src="{{ asset("themes/$theme/images/Blue checkmark box.svg") }}"
                                alt=""
                                class="card-icon"
                            />
                        </div>

                        <div class="finances-card finances-card--orange">
                            <p class="card-text">Оплачено / списано</p>
                            <span class="card-value">₴96 200</span>
                            <img
                                src="{{ asset("themes/$theme/images/Orange checkmark box.svg") }}"
                                alt=""
                                class="card-icon"
                            />
                        </div>

                    </div>

                    <div
                        class="complaints-table-wrapper complaints-table-wrapper-simple"
                    >
                        <div class="table-scroll-wrapper">
                            <table class="complaints-table">
                                <thead>
                                <tr>
                                    <th>№ Замовлення</th>
                                    <th>Дата</th>
                                    <th>Клієнт</th>
                                    <th>Тип</th>
                                    <th>Статус</th>
                                    <th>Сума</th>
                                    <th>Дії</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>DWN-10452</td>
                                    <td>02.08.2025</td>
                                    <td>ЖК «Парковий»</td>
                                    <td>Брак продукції</td>
                                    <td>
                                        <button
                                            class="complaints-status"
                                            data-status="Overdue"
                                        >
                                            Прострочено
                                        </button>
                                    </td>
                                    <td class="debt">₴12 840</td>
                                    <td>
                                        <button
                                            class="complaints-status"
                                            data-status="Details"
                                        >
                                            Деталі
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>DWN-10452</td>
                                    <td>02.08.2025</td>
                                    <td>ЖК «Парковий»</td>
                                    <td>Брак продукції</td>
                                    <td>
                                        <button
                                            class="complaints-status"
                                            data-status="Resolved"
                                        >
                                            Вирішено
                                        </button>
                                    </td>
                                    <td class="debt">₴12 840</td>
                                    <td>
                                        <button
                                            class="complaints-status"
                                            data-status="Details"
                                        >
                                            Деталі
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>DWN-10452</td>
                                    <td>02.08.2025</td>
                                    <td>ЖК «Парковий»</td>
                                    <td>Брак продукції</td>
                                    <td>
                                        <button
                                            class="complaints-status"
                                            data-status="Overdue"
                                        >
                                            Прострочено
                                        </button>
                                    </td>
                                    <td class="debt">₴12 840</td>
                                    <td>
                                        <button
                                            class="complaints-status"
                                            data-status="Details"
                                        >
                                            Деталі
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>DWN-10452</td>
                                    <td>02.08.2025</td>
                                    <td>ЖК «Парковий»</td>
                                    <td>Брак продукції</td>
                                    <td>
                                        <button
                                            class="complaints-status"
                                            data-status="Overdue"
                                        >
                                            Прострочено
                                        </button>
                                    </td>
                                    <td class="debt">₴12 840</td>
                                    <td>
                                        <button
                                            class="complaints-status"
                                            data-status="Details"
                                        >
                                            Деталі
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td>DWN-10452</td>
                                    <td>02.08.2025</td>
                                    <td>ЖК «Парковий»</td>
                                    <td>Брак продукції</td>
                                    <td>
                                        <button
                                            class="complaints-status"
                                            data-status="In-work"
                                        >
                                            В роботі
                                        </button>
                                    </td>
                                    <td class="debt">₴12 840</td>
                                    <td>
                                        <button
                                            class="complaints-status"
                                            data-status="Details"
                                        >
                                            Деталі
                                        </button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
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
                                <img src="{{ asset("themes/$theme/images/file-text.svg") }}" alt="File">
                            </div>
                            <div class="complaints-file">
                                <img src="{{ asset("themes/$theme/images/file-text.svg") }}" alt="File">
                            </div>
                        </div>

                        <div class="complaints-add-file">
                            <img src="{{ asset("themes/$theme/images/paperclip.svg") }}" alt="Прикріпити">
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
                            <img src="{{ asset("themes/$theme/images/clock-hour-3.svg") }}" alt="Історія">
                            <p>15.08.2025 14:30 — Статус змінено на "Прострочено"</p>
                        </div>

                        <div class="complaints-history-item">
                            <img src="{{ asset("themes/$theme/images/clock-hour-3.svg") }}" alt="Історія">
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
                    <h2 class="complaints-popup-title">Нова рекламація</h2>
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
        <!-- Партнерский логотип -->
        <div class="partner">
            @if ($theme === 'goodwin')
                <img src="{{ asset("themes/$theme/images/veka_280.png") }}" alt="Rehau Partner">
            @else
                <img src="{{ asset("themes/$theme/images/rehau.png") }}" alt="Veka Partner">
            @endif
        </div>

    </div>
</div>
</div>
@include('admin.footer_adm')

