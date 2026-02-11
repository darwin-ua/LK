@extends('admin.index')

@section('title', 'Профiль')

@section('content')
<div class="container">
    <!-- Левая колонка -->
    <style>
        .menu li a {
            display: flex;
            align-items: center;
            gap: 10px;

            color: inherit;        /* ← обычный цвет */
            text-decoration: none; /* ← убираем подчёркивание */
            font-weight: normal;   /* ← обычный шрифт */
        }

        .department-contacts {
            display: none;
        }

        .profile-avatar-svg {
            background-color: #E6E6E6;
            color: #7A7A7A;
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
        <div class="profile-content">
            <h1>Налаштування профілю</h1>
            <div class="profile-bottom-content">
                <!-- Первый блок меню -->
                <div class="profile-menu">
                    <p class="profile-title">Акаунт</p>
                    <ul>
                        <li id="btn-profile" style="cursor:pointer">
                            <img src="{{ asset("themes/$theme/images/user.svg") }}" class="icon-img">
                            <span>Мій профіль</span>
                        </li>

                        <li id="btn-contacts" style="cursor:pointer">
                            <img src="{{ asset("themes/$theme/images/Bank-Card.svg") }}" class="icon-img">
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
                                <img src="{{ asset("themes/$theme/images/Bank-Card.svg") }}" alt="Контакты отделов" class="icon-img" />
                                <span>Контакти відділів</span>
                            </button>
                            <h2>Профіль</h2>
                            <p class="profile-text">
                                Налаштуйте та оновіть вашу особисту інформацію.
                            </p>

                            <div class="profile-photo-section">
                                <div class="photo-info-block"><div class="profile-photo">

                                        @php
                                            $user = Auth::user();
                                            $hasCustomAvatar = $user && $user->avatar && $user->avatar !== 'users/default.png';
                                        @endphp
                                        @if($hasCustomAvatar)
                                            <img
                                                src="{{ asset($user->avatar) }}"
                                                alt="Фото користувача"
                                                class="profile-avatar"
                                            />
                                        @else
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 16 16"
                                                class="profile-avatar profile-avatar-svg"
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

                                    </div>


                                    <div class="photo-info">
                                        <span>Фото профілю</span>
                                        <small>Min 400x400px, PNG or JPEG</small>
                                    </div>
                                </div>
                                <div class="photo-buttons">

                                    {{-- ЗАГРУЗКА --}}
                                    <form
                                        action="{{ route('cabinet.profile.avatar.upload') }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                        style="display:inline-block"
                                    >
                                        @csrf

                                        <input
                                            type="file"
                                            name="avatar"
                                            accept="image/png,image/jpeg"
                                            hidden
                                            onchange="this.form.submit()"
                                        >

                                        <button
                                            type="button"
                                            class="photo-btn upload-btn"
                                            onclick="this.previousElementSibling.click()"
                                        >
                                            Завантажити фото
                                        </button>
                                    </form>

                                    {{-- УДАЛЕНИЕ --}}
                                    @if ($user->avatar)
                                        <form
                                            action="{{ route('cabinet.profile.avatar.delete') }}"
                                            method="POST"
                                            style="display:inline-block"
                                            onsubmit="return confirm('Видалити фото профілю?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="photo-btn delete-btn">
                                                Видалити
                                            </button>
                                        </form>
                                    @endif

                                </div>

                            </div>

                            @php
                                $nameParts = explode(' ', $user->name ?? '', 2);
                                $firstName = $nameParts[0] ?? '';
                                $lastName  = $nameParts[1] ?? '';
                            @endphp

                            <div class="personal-info-block">

                                <form id="personalInfoForm">
                                    @csrf

                                    <div class="personal-header">
                                        <h3>Персональна інформація</h3>
                                    </div>

                                    <div class="header-divider"></div>

                                    <div class="personal-fields">

                                        <!-- Левая колонка -->
                                        <div class="personal-column">

                                            <label>
                                                Імʼя
                                                <input
                                                    type="text"
                                                    name="first_name"
                                                    value="{{ $firstName }}"
                                                    required
                                                />
                                            </label>

                                            <label>
                                                Email
                                                <input
                                                    type="email"
                                                    name="email"
                                                    value="{{ $user->email }}"
                                                    required
                                                />
                                            </label>

                                            <label>
                                                Форма власності
                                                <input
                                                    type="text"
                                                    name="type_company"
                                                    value="{{ $user->type_company }}"
                                                />
                                            </label>

                                        </div>

                                        <!-- Правая колонка -->
                                        <div class="personal-column">

                                            <label>
                                                Прізвище
                                                <input
                                                    type="text"
                                                    name="last_name"
                                                    value="{{ $lastName }}"
                                                    required
                                                />
                                            </label>

                                            <label>
                                                Телефон
                                                <input
                                                    type="tel"
                                                    name="phone"
                                                    id="phoneInput"
                                                    value="{{ $user->phone ?: '' }}"
                                                    placeholder="+38(0__)___-__-__"
                                                    required
                                                />

                                            </label>
                                            <label>
                                                Адреса
                                                <input
                                                    type="text"
                                                    name="adres"
                                                    value="{{ old('adres', $user->adres) }}"
                                                    placeholder="Місто, вулиця, будинок"
                                                />
                                            </label>


                                        </div>

                                    </div>

                                    <button type="submit" class="photo-btn change-password-btn">
                                        Зберегти дані
                                    </button>

                                </form>

                            </div>

                            <div class="change-password-block">

                                <form id="changePasswordForm">

                                    @csrf

                                    <div class="change-password-header">
                                        <h3>Змінити пароль</h3>
                                    </div>

                                    <div class="header-divider"></div>

                                    <div class="password-fields">

                                        <!-- ТЕКУЩИЙ ПАРОЛЬ -->
                                        <div class="password-column">
                                            <label>Поточний пароль</label>

                                            <div class="input-wrapper has-left has-right">
                                                <img
                                                    src="{{ asset("themes/$theme/images/lock.svg") }}"
                                                    class="icon-left"
                                                    alt="lock"
                                                />

                                                <input
                                                    type="password"
                                                    name="current_password"
                                                    required
                                                    placeholder="********"
                                                />

                                                <span class="icon-right toggle-password">
                    <img
                        src="{{ asset("themes/$theme/images/eye.svg") }}"
                        alt="Показати пароль"
                    />
                </span>
                                            </div>
                                        </div>

                                        <!-- НОВЫЙ ПАРОЛЬ -->
                                        <div class="password-column">
                                            <label>Новий пароль</label>

                                            <div class="input-wrapper has-left has-right">
                                                <img
                                                    src="{{ asset("themes/$theme/images/lock.svg") }}"
                                                    class="icon-left"
                                                    alt="lock"
                                                />

                                                <input
                                                    type="password"
                                                    name="new_password"
                                                    required
                                                    minlength="8"
                                                    placeholder="********"
                                                />

                                                <span class="icon-right toggle-password">
                    <img
                        src="{{ asset("themes/$theme/images/eye.svg") }}"
                        alt="Показати пароль"
                    />
                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <button type="submit" class="photo-btn change-password-btn">
                                        Змінити пароль
                                    </button>

                                </form>


                            </div>

                        </div>

                        <div class="department-contacts">
                            <!-- Кнопка перехода к профілю (только на мобильных) -->
                            <button class="mobile-section-switch-btn" data-target="profile">
                                <img src="{{ asset("themes/$theme/images/user.svg") }}" alt="Профіль" class="icon-img" />
                                <span>Профіль</span>
                            </button>

                            <div class="department-columns">
                                <!-- Левая колонка -->
                                <div class="department-column">
                                    <div class="department-card">
                                        <div class="department-card-header">
                                            <div class="department-avatar-wrapper">
                                                <img
                                                    src="{{ asset("themes/$theme/images/avatar.png") }}"
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
                                                    src="{{ asset("themes/$theme/images/viber.svg") }}"
                                                    alt="Іконка"
                                                    class="contact-icon"
                                                />
                                                <span class="contact-text"
                                                >Текст під іконкою</span
                                                >
                                            </div>
                                            <div class="contact-item">
                                                <img
                                                    src="{{ asset("themes/$theme/images/telegram.svg") }}"
                                                    alt="Іконка"
                                                    class="contact-icon"
                                                />
                                                <span class="contact-text"
                                                >Текст під іконкою</span
                                                >
                                            </div>
                                            <div class="contact-item">
                                                <img
                                                    src="{{ asset("themes/$theme/images/mail.svg") }}"
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
                                                    src="{{ asset("themes/$theme/images/avatar.png") }}"
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
                                                    src="{{ asset("themes/$theme/images/phone-call.svg") }}"
                                                    alt="Іконка"
                                                    class="contact-icon"
                                                />
                                                <span class="contact-text"
                                                >Текст під іконкою</span
                                                >
                                            </div>
                                            <div class="contact-item">
                                                <img
                                                    src="{{ asset("themes/$theme/images/mail.svg") }}"
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
                                                    src="{{ asset("themes/$theme/images/avatar.png") }}"
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
                                                    src="{{ asset("themes/$theme/images/phone-call.svg") }}"
                                                    alt="Іконка"
                                                    class="contact-icon"
                                                />
                                                <span class="contact-text"
                                                >Текст під іконкою</span
                                                >
                                            </div>
                                            <div class="contact-item">
                                                <img
                                                    src="{{ asset("themes/$theme/images/mail.svg") }}"
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
                                                    src="{{ asset("themes/$theme/images/avatar.png") }}"
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
                                                    src="{{ asset("themes/$theme/images/phone-call.svg") }}"
                                                    alt="Іконка"
                                                    class="contact-icon"
                                                />
                                                <span class="contact-text"
                                                >Текст під іконкою</span
                                                >
                                            </div>
                                            <div class="contact-item">
                                                <img
                                                    src="{{ asset("themes/$theme/images/mail.svg") }}"
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
                                                    src="{{ asset("themes/$theme/images/avatar.png") }}"
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
                                                    src="{{ asset("themes/$theme/images/phone-call.svg") }}"
                                                    alt="Іконка"
                                                    class="contact-icon"
                                                />
                                                <span class="contact-text"
                                                >Текст під іконкою</span
                                                >
                                            </div>
                                            <div class="contact-item">
                                                <img
                                                    src="{{ asset("themes/$theme/images/mail.svg") }}"
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
        <div class="partner">
            @if ($theme === 'goodwin')
                <img src="{{ asset("themes/$theme/images/veka_280.png") }}" alt="Rehau Partner">
            @else
                <img src="{{ asset("themes/$theme/images/rehau.png") }}" alt="Veka Partner">
            @endif
        </div>

    </div>
</div>
<script src="{{ asset("themes/$theme/js/profile.js") }}"></script>

<script>document.addEventListener('DOMContentLoaded', () => {

        const btnProfile  = document.getElementById('btn-profile');
        const btnContacts = document.getElementById('btn-contacts');

        const profileBlock   = document.querySelector('.profile-info-wrapper');
        const contactsBlock  = document.querySelector('.department-contacts');

        if (!btnProfile || !btnContacts || !profileBlock || !contactsBlock) {
            console.warn('Profile switch elements not found');
            return;
        }

        // --- Показать профиль ---
        btnProfile.addEventListener('click', () => {
            profileBlock.style.display  = 'block';
            contactsBlock.style.display = 'none';

            btnProfile.classList.add('active');
            btnContacts.classList.remove('active');
        });

        // --- Показать контакты ---
        btnContacts.addEventListener('click', () => {
            profileBlock.style.display  = 'none';
            contactsBlock.style.display = 'block';

            btnContacts.classList.add('active');
            btnProfile.classList.remove('active');
        });

    });
</script>
@endsection







