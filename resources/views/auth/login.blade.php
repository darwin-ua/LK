@extends('auth.appauth')
@section('content')
    <body>
    <div class="layout">
        <!-- Левая колонка -->
        <div class="left-column">
            <div class="form-box Sign-in">
                <!-- Логотип -->
                <div class="logo">
                    <img src="{{ asset($logo) }}">
                </div>

                <h2 class="form-title">Вхід до кабінету дилера</h2>
                <p class="form-subtitle">Введіть дані для авторизації</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Логин -->
                    <div class="field">
                        <label for="id_lk">Логін (ID в 1С)</label>
                        <div class="input-wrapper has-left">
                            <img src="{{ asset("themes/$theme/images/letter.svg") }}" alt="letter" class="icon-left">

                            <input
                                type="text"
                                id="id_lk"
                                name="id_lk"
                                value="{{ old('id_lk') }}"
                                placeholder="7072274"
                                required
                            >
                        </div>

                        @error('id_lk')
                        <span class="invalid-feedback" style="color:red;font-size:13px;">
                <strong>{{ $message }}</strong>
            </span>
                        @enderror
                    </div>

                    <!-- Пароль -->
                    <div class="field">
                        <label for="password">Пароль</label>
                        <div class="input-wrapper has-left has-right">
                            <img src="{{ asset("themes/$theme/images/lock.svg") }}" alt="lock" class="icon-left">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                placeholder="********"
                            >

                            <div class="icon-right" id="togglePassword">
                                <img src="{{ asset("themes/$theme/images/eye.svg") }}" alt="eye">
                            </div>
                        </div>

                        @error('password')
                        <span class="invalid-feedback" style="color:red;font-size:13px;">
                <strong>{{ $message }}</strong>
            </span>
                        @enderror
                    </div>

                    <!-- Запомнить -->
                    <div class="remember">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Запам’ятати мене</label>
                    </div>

                    <button type="submit" class="btn">Увійти</button>
                </form>



                <!-- Партнер -->
                <div class="partner">
                    <img src="{{ asset($partnerLogo) }}">
                </div>
            </div>
            <div class="form-box Verify-Email">
                <!-- Логотип -->
                <div class="logo">
                    <img src="{{ asset("themes/$theme/images/logo.svg") }}">
                </div>

                <h2 class="form-title">Відновлення паролю</h2>
                <p class="form-subtitle">Вкажіть email — надішлемо інструкції для відновлення паролю.</p>

                <form>
                    <!-- Логин -->
                    <div class="field">
                        <label for="login">Логін</label>
                        <div class="input-wrapper has-left">
                            <img src="{{ asset("themes/$theme/images/letter.svg") }}" alt="letter" class="icon-left">
                            <input type="email" id="login" placeholder="mylogin@gmail.com">
                        </div>
                    </div>

                    <button type="submit " class="btn">Надіслати інструкції</button>
                </form>

                <!-- Партнер -->
                <div class="partner">
                    <img src="{{ asset($partnerLogo) }}">
                </div>
                <a href="#" class="forgot-link Verify-Email">Забули пароль?</a>
            </div>
            <div class="form-box New-Password">
                <!-- Логотип -->
                <div class="logo">
                    <img src="{{ asset("themes/$theme/images/logo.svg") }}">
                </div>

                <h2 class="form-title">Створіть новий пароль</h2>
                <p class="form-subtitle">Ввести мінімум 8 символів</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Логин -->
                    <div class="field">
                        <label for="id_lk">Логін (ID в 1С)</label>
                        <div class="input-wrapper has-left">
                            <img src="{{ asset("themes/$theme/images/letter.svg") }}" alt="letter" class="icon-left">

                            <input
                                type="text"
                                id="id_lk"
                                name="id_lk"
                                value="{{ old('id_lk') }}"
                                placeholder="7072274"
                                required
                            >
                        </div>
                        @error('id_lk')
                        <span class="invalid-feedback" style="color:red; font-size:13px;">
                <strong>{{ $message }}</strong>
            </span>
                        @enderror
                    </div>

                    <!-- Пароль -->
                    <div class="field">
                        <label for="password">Пароль</label>
                        <div class="input-wrapper has-left has-right">
                            <img src="{{ asset("themes/$theme/images/lock.svg") }}" alt="lock" class="icon-left">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="********"
                                required
                            >

                            <div class="icon-right" id="togglePassword">
                                <img src="{{ asset("themes/$theme/images/eye.svg") }}" alt="eye">
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" style="color:red; font-size:13px;">
                <strong>{{ $message }}</strong>
            </span>
                        @enderror
                    </div>

                    <!-- Запомнить -->
                    <div class="remember">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Запам’ятати мене</label>
                    </div>

                    <a href="{{ route('password.request') }}" class="forgot-link">Забули пароль?</a>

                    <button type="submit" class="btn">Увійти</button>
                </form>


                {{--                <form>--}}
{{--                    <!-- Пароль -->--}}
{{--                    <div class="field">--}}
{{--                        <label for="password">Новий пароль</label>--}}
{{--                        <div class="input-wrapper has-left has-right">--}}
{{--                            <img src="{{ asset("themes/$theme/images/lock.svg") }}" alt="lock" class="icon-left">--}}
{{--                            <input type="password" id="password" placeholder="********">--}}
{{--                            <div class="icon-right" id="togglePassword">--}}
{{--                                <img src="{{ asset('images/eye.svg') }}" alt="eye">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- Підтвердити пароль -->--}}
{{--                    <div class="field">--}}
{{--                        <label for="password">Підтвердити пароль</label>--}}
{{--                        <div class="input-wrapper has-left has-right">--}}
{{--                            <img src="{{ asset("themes/$theme/images/lock.svg") }}" alt="lock" class="icon-left">--}}
{{--                            <input type="password" id="password" placeholder="********">--}}
{{--                            <div class="icon-right" id="togglePassword">--}}
{{--                                <img src="{{ asset("themes/$theme/images/eye.svg") }}" alt="eye">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}



{{--                    <button type="submit" class="btn">Встановити новий пароль</button>--}}
{{--                </form>--}}

                <!-- Партнер -->
                <div class="partner">
                    <img src="{{ asset($partnerLogo) }}">
                </div>
                <p class="form-subtitle">Потрібна допомога? <a href="#" class="forgot-link New-Password">Зв’яжіться з нами</a></p>

            </div>
            <div class="form-box Successfully-changed">

                <div class="logo-check-circle">
                    <img src="{{ asset('images/Check circle.svg') }}" alt="Check circle">
                </div>

                <h2 class="form-title">Ваш пароль успішно змінено</h2>

                <button type="submit" class="btn"><img src="{{ asset('images/Left arrow.svg') }}" alt="Left arrow" class="img-arrow"> Повернутися до входу </button>
                <!-- Партнер -->
                <div class="partner">
                    <img src="{{ asset($partnerLogo) }}">
                </div>
            </div>
        </div>

        <!-- Правая колонка -->
        <div class="right-column">
            <div class="slider">
                <!-- Слайд 1 -->
                <div class="slide one">
                    <div class="slide-content">
                        <h2>{{ $slideTexts[0]['title'] }}</h2>
                        <p>{{ $slideTexts[0]['text'] }}</p>
                    </div>
                </div>

                <div class="slide two">
                    <div class="slide-content">
                        <h2>{{ $slideTexts[1]['title'] }}</h2>
                        <p>{{ $slideTexts[1]['text'] }}</p>
                    </div>
                </div>

                <div class="slide three">
                    <div class="slide-content">
                        <h2>{{ $slideTexts[2]['title'] }}</h2>
                        <p>{{ $slideTexts[2]['text'] }}</p>
                    </div>
                </div>


                <!-- Слайд Verify Email -->
                <div class="slide Verify-Email">
                    <div class="slide-content">
                        <h2>Працюй з кращими — працюй з нами</h2>
                        <p>Отримуй якісний продукт, технічну підтримку та прозору співпрацю.  Розширюй горизонти свого бізнесу вже сьогодні.</p>
                    </div>
                </div>
                <!-- Слайд New Password-->
                <div class="slide New-Password">
                    <div class="slide-content">
                        <h2>Працюй з кращими — працюй з нами</h2>
                        <p>Отримуй якісний продукт, технічну підтримку та прозору співпрацю.  Розширюй горизонти свого бізнесу вже сьогодні.</p>
                    </div>
                </div>

                <!-- Слайд Successfully changed-->
                <div class="slide Successfully-changed">
                    <div class="slide-content">
                        <h2>Працюй з кращими — працюй з нами</h2>
                        <p>Отримуй якісний продукт, технічну підтримку та прозору співпрацю.  Розширюй горизонти свого бізнесу вже сьогодні.</p>
                    </div>
                </div>

                <!-- Индикаторы -->
                <div class="slider-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>

            </div>
        </div>

    </div>
    </body>
@endsection
