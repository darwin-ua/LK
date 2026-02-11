<!DOCTYPE html>
<!-- saved from url=(0034) -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T0HSNB1YY5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-T0HSNB1YY5');
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="storage/Home_files/livechatinit2.js"></script>
    <script src="storage/Home_files/resources2.aspx"></script>
    <link id="mlc_chatinlie_styletag" rel="stylesheet" href="storage/Home_files/chatinline.css">
    <link rel="stylesheet" href="storage/Home_files/css">
    <title>{{ $eve_title}}</title>
    <meta name="keywords" content="home">
    <meta property="og:url" content="https://eventhes.com/{{ $eve_id}}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{$event->firstFoto()}}">
    <meta name="twitter:title" content="{{ $eve_title }}">

    <meta name="twitter:description" content="{{ $event->title }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="180x180" href="https://eventhes.com/storage/AdminLTE/fav.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://eventhes.com/storage/AdminLTE/fav.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://eventhes.com/storage/AdminLTE/fav.png">
    <link media="all" type="text/css" rel="stylesheet" href="storage/Home_files/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="storage/Home_files/style.css">
    <link media="all" type="text/css" rel="stylesheet" href="storage/Home_files/vendors.css">
    <link media="all" type="text/css" rel="stylesheet" href="storage/Home_files/custom.css">
    <link href="storage/Home_files/css2" rel="stylesheet">
    <link media="all" type="text/css" rel="stylesheet" href="storage/Home_files/select2.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="storage/Home_files/ladda-themeless.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="storage/Home_files/sweetalert2.css">
    <link media="all" type="text/css" rel="stylesheet" href="storage/Home_files/toastr.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="storage/Home_files/font-awesome.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('storage/css/bootstrap.min.css') }}">
    <link href="{{ asset('storage/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('storage/css/another-style.css') }}" rel="stylesheet">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('storage/css/vendors.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('storage/css/custom.css') }}">
    <link href="{{ asset('storage/css/css2.css') }}" rel="stylesheet">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('storage/css/select2.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('storage/css/adda-themeless.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('storage/css/sweetalert2.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('storage/css/toastr.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('storage/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Подключение CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>
    <!-- Подключение JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" type="text/css" property="stylesheet" href="{{ asset('storage/css/stylesheets') }}"
          data-turbolinks-eval="false" data-turbo-eval="false">
    <style>
        header #logo_home h1 a {
            background-image: url("{{ asset('storage/css/site_logo.png') }}");

            background-repeat: no-repeat;
            margin-top: -11px;
        }

        header.sticky #logo_home h1 a {
            background-image: url("{{ asset('storage/css/site_logo.png') }}");

            background-repeat: no-repeat;
            margin-top: -11px;
        }
    </style>
</head>
<div id="preloader">
    <div class="sk-spinner sk-spinner-wave">
        <div class="sk-rect1"></div>
        <div class="sk-rect2"></div>
        <div class="sk-rect3"></div>
        <div class="sk-rect4"></div>
        <div class="sk-rect5"></div>
    </div>
</div>
<body class=" " style="overflow: visible;">

<div class="mobile-hide" style="max-height: 100%; max-width: 100%;">
    <img src="{{ $event->firstFoto() }}"
         style="position: absolute; height: 100%; width: 100%; max-width: none; filter: blur(20px);">
</div>
<div class="parallax-mirror"
     style="visibility: visible; position: absolute; top: 0px; left: 0px; overflow: hidden; transform: translate3d(0px, 0px, 0px); height: 470px; width: 100%; display: flex; justify-content: center; align-items: center;">
    <img style="max-height: 100%; max-width: 100%;"
         src="{{ $event->firstFoto() }}">
</div>

<div class="layer"></div>
<style>/* Стили для свернутого меню */
    #sidebar {
        position: fixed;
        top: 0;
        left: -250px;
        width: 250px;
        height: 100%;
        background-color: #333;
        transition: left 0.3s ease;
        z-index: 9999; /* Устанавливаем высокий z-index для того, чтобы панель была поверх всего содержимого */
    }

    #sidebar.opened {
        left: 0;
        color: #ffffff;
    }

    #sidebar a.nav-link {
        color: white; /* Устанавливаем белый цвет текста для ссылок */
        text-decoration: none; /* Удаляем подчеркивание */
    }

    #sidebar a.nav-link:hover {
        text-decoration: underline; /* Добавляем подчеркивание при наведении */
    }

    header.nav-up {
        transform: translateY(-100%);
        transition: transform 0.3s ease;
    }

    /* Стили для развернутого меню */
    header.nav-down {
        transform: translateY(0%);
        transition: transform 0.3s ease;
    }

    /* Обычные стили */
    #top_tools {
        transition: margin-left 0.3s ease; /* анимация для изменения положения */
    }

    .menu-open #top_tools {
        margin-left: 0; /* положение списка на экране */
    }

    /* Скрытие списка на мобильных устройствах */
    @media (max-width: 767px) {
        #top_tools {
            display: none;
        }
    }

    .announcement-text {
        font-family: 'Lobster', cursive;
        font-size: 24px;
        color: #ffffff;
        background-color: rgba(73, 69, 79, 0.94);
        border-radius:5px;
    }

</style>
<div id="sidebar" class="closed">
    <div style="margin: 50px; margin-left: -5px;">
        <a href="/" class="nav-link" href="" target="_self">
            <i class="fa fa fa-home fa-fw"></i> Home
        </a>
        <a class="nav-link" href="/all" target="_self">
            Events
        </a>
        <a class="nav-link" href="contact-us" target="_self">
            Contact Us
        </a></div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0/dist/js/bootstrap.bundle.min.js"></script>
<header style="opacity: 1; height:auto;">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div id="logo_home">
                    <h1><a href="/" title=""></a></h1>
                </div>
            </div>
            <nav class="col-9" id="your_menu_id">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span></span></a>
                <div class="main-menu" style="margin-top:-10px;">
                    <div id="header_menu">
                        <img src="./show_files/site_logo.png" width="160" height="34" alt="EVENTHES">
                    </div>
                    <a href="" class="open_close" id="close_in"><i
                            class="icon_set_1_icon-77"></i></a>
                </div>
                <ul id="top_tools" style="margin-top:-5px;">
                    <ul>

                        <span style="margin-left:38px; position:absolute;" class="badge badge-danger"
                              id="orders-alerts"></span>
                        <li>
                            @guest
                                <a class="nav-link" href="/login" target="_self">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                         class="bi bi-door-closed" viewBox="0 0 16 16">
                                        <path
                                            d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3zm1 13h8V2H4z"/>
                                        <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0"/>
                                    </svg>
                                </a>
                            @else
                                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3 || Auth::user()->role_id == 2)
                                    <a class="nav-link" href="/admin" target="_self">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                                            <path fill-rule="evenodd"
                                                  d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
                                        </svg>
                                    </a>
                                @else
                                    <a class="nav-link" href="/partner" target="_self">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                                            <path fill-rule="evenodd"
                                                  d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
                                        </svg>
                                    </a>
                                @endif
                            @endguest
                        </li>
                        <li id="cart-count">
                            <a href="#" type="button" data-bs-toggle="modal" data-target="#trTR">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-basket" viewBox="0 0 16 16">
                                    <path
                                        d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </a>
                            <span style="color:#ffffff;"
                                  id="cart-item-count">{{ $cartCount > 0 ? $cartCount : '' }}</span>
                        </li>
                        <li id="cart-countDoing">
                            <a href="#" type="button" data-bs-toggle="modal" data-target="#trDoing" style="text-decoration: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                </svg>
                                <span id="cart-doing-item-count">{{ $cartDoingCount > 0 ? $cartDoingCount: '' }}</span>
                            </a>
                        </li>
                        <li class="dropdown" id="hover-dropdown">
                            <a href="" style="text-decoration: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                </svg>
                                <span id="like-count">{{ $likeCount > 0 ? $likeCount : '' }}</span>
                            </a>
                        </li>
                        </li>
                        <style>
                            @media (max-width: 767px) {
                                .flag-image {
                                    width: 15%;
                                    height: auto;
                                }
                            }</style>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <span>  <img width="29" height="29"
                                             src="{{asset('storage/files/'.session('locale',config('app.locale')).'.png')}}"
                                             alt="Flag"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ url('/lang/en') }}">English</a></li>
                                <li><a class="dropdown-item" href="{{ url('/lang/ru') }}">Русский</a></li>
                                <li><a class="dropdown-item" href="{{ url('/lang/pl') }}">Polski</a></li>
                                <li><a class="dropdown-item" href="{{ url('/lang/ua') }}">Українська</a></li>
                            </ul>
                        </li>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <li>
                            <button type="button" class="btn btn-success" onclick="location.href='/admin'">+ Створити
                            </button>
                        </li>
                    </ul>
                </ul>
            </nav>
        </div>
    </div>
</header>

<section class="parallax-window" data-parallax="scroll"
         data-image-src=""
         data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-2" style="position: relative;">
        <div style="position: absolute; top: 205%; left: 5%; transform: translateY(-50%); width: 25%; border-radius: 5px; background-color: #ffffff; border: 2px solid #605e63; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <center>
                <h4><span class="title-background"><span style="color:#605e63;">{{ $eve_title }}</span></span></h4>
            </center>

        @if($event->category == 2)
                <center>
                    <h7><span class="text-right" style="color:#605e63;">Date: {{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') }} Time: {{ \Carbon\Carbon::parse($event->end_date)->format('H:i') }}</span></h7>
                </center>
        @endif

            <center>
                <h4><span class="title-background"><span style="color:#605e63;">
                             <h3 class="inner" style="font-size:medium; ">
                                <td class="text-right" id="currency_sel" style="background-color:rgba(232,83,26,0.85); color:#ffffff;font-size: smaller;  font-weight: bold;">
                                    @php
                                        $categoryIcons = [
                                            4 => 'Ціна : ',
                                            2 => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/></svg>'
                                        ];
                                    @endphp
                                    <span style="color:#605e63;">
                                      @if(isset($categoryIcons[$event->category]))
                                            {!! $categoryIcons[$event->category] !!}
                                        @endif
                                    </span>
                                    @php
                                        $discountedAmount = $event->amount - ($event->amount * $event->discounte / 100);
                                        $currencySymbols = [
                                            '0' => '$',
                                            '1' => '₽',
                                            '2' => '€',
                                            '3' => '₴',
                                            '4' => 'Zł',
                                        ];
                                        $currencySymbol = $currencySymbols[$event->currency] ?? $event->currency; // Если символ не найден, показываем код валюты
                                    @endphp
                                </td>
                                <td id="totalAmount" style="color:#605e63;font-size: smaller;  font-weight: bold;">
                                    @if ($event_amount == 0 and $event_discount === null)
                                        <span style='color:#605e63;font-size: smaller;  font-weight: bold;'>FREE</span>
                                    @else
                                        @php
                                            echo "<span style='color:#605e63;font-size: smaller;  font-weight: bold;'>" . ($event_amount - ($event_amount * $event_discount / 100)) ."&nbsp;".$currencySymbol ."</span>";
//                                        @endphp
                                    @endif
                                </td>
                        </h3>
                   </span>
                </h4>
            </center>

        @if($event->category == 4)

            <center>
                <h4><span class="title-background"><span style="color:#605e63;">
                             <h3 class="inner" style="font-size:medium; ">
                                @if($event->category == 4 && $event->piple !== null)
                                 <span style="color:#605e63;font-size: smaller;">Знижка: {{ number_format($discountedAmount, 2) }} {{ $currencySymbol }}</span>
                                @endif
                        </h3>
                        </span>
                </h4>
            </center>
        </div>
        @endif
    </div>
    <br>
    </div>
    </div>

    <style>
        .discount-box {
            width: 10cm;
            height: 1.1cm;
            border-radius: 5px;
            margin-left: 11px;
            background-color: #af2424;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .title-background {

            border-radius: 5px;
            padding: 5px;
            display: inline-block;
        }

        .title-background span {
            opacity: 1;
        }

        .title-divider {
            border: 0;
            border-top: 1px solid #000;
            margin-top: 10px;
        }

        .flag-icon {
            vertical-align: middle;
            margin-top: -5px;
            width: 2%;
        }

        .event-location {
            color: white;
        }

        .schedule {
            width: 33%;
            white-space: nowrap;
            overflow: hidden;
            font-weight: bold;
            border-radius: 5px;
            background-color: #eeeeee;
            margin-top: 20px;
        }

        /* Media Query for Mobile Devices */
        @media (max-width: 768px) {
            .discount-box {
                width: 5cm;
                height: 0.55cm;
                font-size: 10px;
            }

            .title-background {
                font-size: 0.5em;
            }

            .title-divider {
                margin-top: 5px;
            }

            .flag-icon {
                width: 1%;
            }

            .schedule {
                width: 16.5%;
                margin-top: 10px;
                font-size: 0.5em;
            }
        }
    </style>
</section>
<main>
    <div style="background-color: #201c23; opacity: 0.7">
        <center>
            <td class="text-right" id="currency_sel">
                @if ($subCategoryData->isNotEmpty())
                    @foreach ($subCategoryData as $subCategoryTitle => $count)
                        <a href=""
                           style="color:#ffffff; font-size: smaller; font-weight: bold; text-decoration: underline;">
                            {{ $subCategoryTitle }} ({{ $count }})&nbsp;
                        </a>
                    @endforeach
                @endif
            </td>
        </center>
    </div>
    @php
    if($event_quest != 'guest'){
    @endphp
    <div class="container margin_60" id="container_booking" style="margin-top:-25px;">
        <div class="row" style="margin-top:-45px;">
            <div class="col-lg-8" id="single_tour_desc">
                @php
                    $socialLinks = [
                        $event->social_show_facebook,
                        $event->social_show_instagram,
                        $event->is_live,
                        $event->is_links,
                        $event->social_show_youtube,
                        $event->social_show_telegram,
                        $event->social_show_x
                    ];
                @endphp
                @if (!empty(array_filter($socialLinks)))
                    <p class="d-none d-md-block d-block d-lg-none">
                        {{--                    <a class="btn_map collapsed" data-toggle="collapse"--}}
                        {{--                                                                  href=""--}}
                        {{--                                                                  aria-expanded="false" aria-controls="collapseMap"--}}
                        {{--                                                                  data-text-swap="Hide map"--}}
                        {{--                                                                  data-text-original="View on map">{{ __('translate.View on map') }}</a>--}}
                    </p>
                @endif
                <div class="row">
                    <div style="background-color: rgb(0,141,201); opacity: 0.8"></div>
                </div>
                <br>
                <div id="single_tour_feat">
                    <ul>
                        <dt class="c-bar__label u-pr--0">Поділитись:</dt>
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ftsn.ua%2Fato%2Fsituaciya-napruzhena-trivayut-zapekli-boyi-genshtab-povidomiv-ostanni-novini-z-peredovoyi-2606490.html"
                               target="_blank" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#49454f"
                                     class="bi bi-facebook" viewBox="0 0 16 16" style="opacity: 0.7;">
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/share?url=https%3A%2F%2Ftsn.ua%2Fato%2Fsituaciya-napruzhena-trivayut-zapekli-boyi-genshtab-povidomiv-ostanni-novini-z-peredovoyi-2606490.html"
                               data-share="https://tsn.ua/ato/situaciya-napruzhena-trivayut-zapekli-boyi-genshtab-povidomiv-ostanni-novini-z-peredovoyi-2606490.html"
                               data-type="twitter" data-key="article|2606490|tw" target="_blank" role="button"><span
                                    class="sr-only">Twitter</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#49454f"
                                     class="bi bi-twitter-x" viewBox="0 0 16 16" style="opacity: 0.7;">
                                    <path
                                        d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="whatsapp://send?text=https%3A%2F%2Ftsn.ua%2Fato%2Fsituaciya-napruzhena-trivayut-zapekli-boyi-genshtab-povidomiv-ostanni-novini-z-peredovoyi-2606490.html"><span
                                    class="sr-only">WhatsApp</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#49454f"
                                     class="bi bi-whatsapp" viewBox="0 0 16 16" style="opacity: 0.7;">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://telegram.me/share/url?url=https%3A%2F%2Ftsn.ua%2Fato%2Fsituaciya-napruzhena-trivayut-zapekli-boyi-genshtab-povidomiv-ostanni-novini-z-peredovoyi-2606490.html"
                               data-share="https://tsn.ua/ato/situaciya-napruzhena-trivayut-zapekli-boyi-genshtab-povidomiv-ostanni-novini-z-peredovoyi-2606490.html"
                               data-type="telegram" data-key="article|2606490|tg" target="_blank" role="button"><span
                                    class="sr-only">Telegram</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#49454f"
                                     class="bi bi-telegram" viewBox="0 0 16 16" style="opacity: 0.7;">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               id="openModalButton"
                               role="button">
                                <span class="sr-only"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#49454f" class="bi bi-qr-code" viewBox="0 0 16 16">
                                    <path d="M2 2h2v2H2z" style="opacity: 0.7;"></path>
                                    <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"></path>
                                    <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"></path>
                                    <path d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"></path>
                                    <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z"></path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                @if($event->category == 4)
                    @if(!empty($imageData))
                        <div class="row">
            <span>
                <h3>{{ __('translate.Portfolio') }}</h3>
            </span>
                            @foreach($imageData as $image)
                                <div class="col-lg-4">
                                    <div class="gallery-item" id="portfol">
                                        @if(!empty($image->path))
                                            <a href="{{ $image->path }}" data-fancybox="gallery">
                                                <img src="{{ $image->path }}" class="img-fluid" alt="{{ $image->description }}">
                                            </a>
                                        @else
                                            <div class="no-image">
                                                <p>{{ __('translate.NoImage') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                    @else
                    @endif
                    <div class="row">
                        <div class="col-lg-3">
                            <h3>{{ __('translate.Description') }}</h3>
                        </div>
                        <div class="col-lg-9" id="descript">
                            {!! $event->description !!}
                        </div>
                    </div>
                    <hr>
                @endif

                <div class="row" id="goods" data-target="goods">
                    <h3><a href="{{ url('search?what=&rng=&rng2=&cat=&salesman=' . $event->user_id) }}" target="_blank"
                           class="text-dark">Товари продавця</a></h3>
                    </span>
                    @foreach($events as $eventTu)
                        @if ($eventTu->amount > 0)
                            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                                <div class="tour_container">
                                    <div class="ribbon_3 popular">
                                        <span>{{ $eventTu->discounte ? '- ' . $eventTu->discounte . '%' : 'FREE' }}</span>
                                    </div>
                                    <div class="img_container">
                                        <a href="/{{$eventTu->id}}">
                                            {{--                                            <img src="{{ isset($firstImages[$event->id]) ? $firstImages[$event->id]->path : 'Путь к изображению по умолчанию' }}"--}}
                                            {{--                                                 width="90%" height="90" class="img-fluid" alt="Image">--}}
                                            {{--                                            <div class="short_info">--}}

                                            <img
                                                src="{{ isset($firstImages[$eventTu->id]) ? $firstImages[$eventTu->id]->path : 'Путь к изображению по умолчанию' }}"
                                                width="90%" height="90" class="img-fluid" alt="Image">
                                            <div class="short_info">
                                                <i></i>{{$eventTu->reserv}}<span
                                                    class="price">@if ($eventTu->amount == 0 || $eventTu->discounte === null)
                                                        FREE
                                                    @else
                                                        @php
                                                            $discountedAmount = $eventTu->amount - ($eventTu->amount * $eventTu->discounte / 100);
                                                            $currencySymbols = [
                                                                '0' => '$',
                                                                '1' => '₽',
                                                                '2' => '€',
                                                                '3' => '₴',
                                                                '4' => 'Zł',
                                                            ];
                                                            $currencySymbol = $currencySymbols[$eventTu->currency] ?? '';
                                                        @endphp
                                                        <span
                                                            style="color:#989fa6;font-size: smaller; text-decoration: line-through;">{{ number_format($eventTu->amount, 2) }} {{ $currencySymbol }}</span>
                                                        {{ number_format($discountedAmount, 2) }} {{ $currencySymbol }}
                                                    @endif
                            </span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="tour_title">
                                        <h3><img src="https://eventhes.com/storage/files/ua.png" alt="Flag"
                                                 style="vertical-align: middle;  width: 5%;"><strong
                                                style="font-size: 13px;">{{$eventTu->title}}</strong></h3>
                                        <a href="/{{$eventTu->id}}" style="text-decoration: none; background-color: #ffffff; padding: 10px 20px; border-radius: 5px; display: inline-block; border: 2px solid grey; color: grey;" class="btn_1" target="_blank"> {{ __('translate.Details') }}</a>
                                    </div>
                                </div>
                                &nbsp;
                            </div>
                        @endif
                    @endforeach
                    <div class="row">
                        <center>
                            <div class="tour_title">
                                <button type="button" class="btn btn-secondary"
                                        onclick="window.location.href='{{ url('search?what=&rng=&rng2=&cat=&salesman=' . $event->user_id) }}'">
                                    Всі товари
                                </button>
                            </div>
                        </center>
                    </div>
                </div>
                @if(($event->category == 4 && $event->amount == null) || ($event->category == 2))
                    <hr>
                    <div class="row">
                        <div class="col-lg-3">
                            <h3>{{ __('translate.Schedule') }}</h3>
                        </div>
                        <div class="col-lg-9">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                    @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                                        <tr>
                                            <td>{{ $day }}</td>
                                            <td>
                                                @php
                                                    $dayLower = strtolower($day);
                                                    $startTime = $timeworks->pluck("time_work_start_$dayLower")->first();
                                                    $endTime = $timeworks->pluck("time_work_end_$dayLower")->first();
                                                @endphp
                                                @if($startTime != 'Start' && $endTime != 'End')
                                                    {{ $startTime }} - {{ $endTime }}
                                                @else
                                                    {{ __('translate.Closed') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
                <hr style="height:0.5px;">
                <div class="row">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Organizator') }}</h3>
                    </div>
                    <div class="col-lg-9" style="margin-top:8px;">
                        <h4>{{ $user->name }}</h4>
                    </div>
                </div>
                <hr style="height:0.5px;">
                <div class="row">
                    <div class="col-lg-9">
                        <div id="general_rating">
                            {{ __('translate.Reviews') }}
                            <div class="rating">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path
                                            d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                    </svg>
                                </i>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path
                                            d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                    </svg>
                                </i>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path
                                            d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                    </svg>
                                </i>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path
                                            d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                    </svg>
                                </i>
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path
                                            d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                    </svg>
                                </i>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('reviews.store', $event->id) }}" method="POST">
                        @csrf
                        <textarea name="content" required></textarea>
                        <p><button style="background-color:#ffc107;" class="btn_1" type="submit">Оставить отзыв</button></p>
                    </form>
                </div>
            </div>
            <aside class="col-lg-4" style="margin-top:15px;">
                <div class="box_style_1 expose">
                    <div id="booking-vue">
                        <form name="bookingForm" action="{{ route('orders.store') }}" method="post"
                              class="booking-form">
                            <h3 class="inner" style="font-size:medium;">
                                <td class="text-right" id="currency_sel" style="background-color:#ff8f40; color:#ffffff;font-size: smaller;  font-weight: bold;">

                                    @php
                                        $categoryIcons = [
                                            4 => '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16"><path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"/></svg>',
                                            3 => '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/></svg>'
                                        ];
                                    @endphp
                                    <span style="color:#ffffff;">
                                      @if(isset($categoryIcons[$eve_categ]))
                                            {!! $categoryIcons[$eve_categ] !!}
                                        @endif
                                    </span>

                            </h3>
                            @if ($event_type_pay != 3)
                                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Выбираем все элементы input с типом "text" и атрибутом id
                                        const datepickerElements = document.querySelectorAll('input[type="text"][id^="event_"]');

                                        // Инициализация Flatpickr для каждого найденного элемента
                                        datepickerElements.forEach(datepickerElement => {
                                            const flatpickrInstance = flatpickr(datepickerElement, {
                                                dateFormat: "Y-m-d",
                                                defaultDate: new Date(), // Устанавливаем текущую дату
                                                disable: [], // Пока не отключаем даты, инициализация произойдет при фокусе
                                                onChange: function(selectedDates, dateStr, instance) {
                                                    datepickerElement.value = dateStr;

                                                }
                                            });

                                            // Добавляем обработчик фокуса на элементе datepicker
                                            datepickerElement.addEventListener('focus', function() {
                                                const itemId = this.id; // Получаем ID элемента

                                                // Отправляем AJAX-запрос для получения занятых дат
                                                fetch(`/get-busy-dates/${itemId.replace('event_', '')}`)
                                                    .then(response => {
                                                        if (!response.ok) {
                                                            throw new Error("Ошибка сети при запросе занятых дат.");
                                                        }
                                                        return response.json();
                                                    })
                                                    .then(busyDates => {
                                                        console.log("Занятые даты:", busyDates); // Логируем полученные данные

                                                        if (busyDates && busyDates.length > 0) {
                                                            // Обновление отключенных дат в Flatpickr
                                                            flatpickrInstance.set('disable', busyDates.map(date => new Date(date)));
                                                        } else {
                                                            console.log("Занятые даты отсутствуют.");
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error("Произошла ошибка при получении занятых дат:", error);
                                                    });
                                            });
                                        });
                                    });
                                </script>
                    <style>
                        /* Стили для неактивных дат в Flatpickr */
                        .flatpickr-day.flatpickr-disabled {
                            color: #d3d3d3; /* Цвет текста для неактивных дат */
                            background-color: #f0f0f0; /* Цвет фона для неактивных дат (можно изменить) */
                            cursor: not-allowed; /* Указывает, что дата не доступна для выбора */
                        }
                    </style>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label> {{ __('translate.Quantity') }} </label>
                                            <div class="numbers-row">
                                                <button style="border-radius: 4px;  width: 30%;" type="button"
                                                        class="rt2">
                                                    +
                                                </button>
                                                <button style="border-radius: 4px; width: 30%;" type="button"
                                                        class="rt3">
                                                    -
                                                </button>
                                                <input style="border-radius: 5px; margin-left: -31px;" type="text"
                                                       id="adults" name="quantity" class="qty2 ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <table class="table table_summary" style="margin-top: -20px;">
                                    <tbody>
                                    <tr>
                                        <td>
                                            {{ __('translate.Total Amount') }}
                                        </td>
                                        <td class="text-right" id="currency_sel">
                                            @php
                                                $currencySymbols = [
                                                    '0' => '$',
                                                    '1' => '₽',
                                                    '2' => '€',
                                                    '3' => '₴',
                                                    '4' => 'Zł',
                                                ];
                                                $currencySymbol = $currencySymbols[$event->currency] ?? $event->currency; // Если символ не найден, показываем код валюты
                                            @endphp
                                            {{ $currencySymbol }}
                                        </td>
                                        <td class="text-right" id="totalAmount">
                                            @if ($event_amount == 0 and $event_discount === null)
                                                FREE
                                            @else
                                                @php
                                                    echo  $event_amount - ($event_amount * $event_discount / 100);
                                                @endphp
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="total">
                                        <td>
                                            {{ __('translate.Total Cost') }}
                                        </td>
                                        <td class="text-right" id="currency_sel">
                                            @php
                                                $currencySymbolsTu = [
                                                    '0' => '$',
                                                    '1' => '₽',
                                                    '2' => '€',
                                                    '3' => '₴',
                                                    '4' => 'Zł',
                                                ];
                                                $currencySymbolTu = $currencySymbolsTu[$event->currency] ?? $event->currency; // Если символ не найден, показываем код валюты
                                            @endphp
                                            {{ $currencySymbolTu }}
                                        </td>
                                        <td class="text-right" id="totalCost">
                                            @if ($event_amount == 0 and $event_discount === null)
                                                FREE
                                            @else
                                                @php
                                                    echo  $event_amount - ($event_amount * $event_discount / 100);
                                                @endphp
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                @if ($eve_categ != 4)
                                        <input type="text" style="display: none;" value="1" id="reg1">
                                    <span class="ladda-label"><i  class="btn_full" onclick="AddDoing('{{ $eve_id }}');"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/></svg>&nbsp;&nbsp;Записатись</i></span>
                                @else
                                    <input type="text" style="display: none;" value="1" id="reg2">
                                    <span class="ladda-label"><i  class="btn_full" onclick="AddBasket({{ $eve_id }});"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16"><path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"/></svg>  Купити</i></span>

                                @endif
                            @endif
                        </form>
                    </div>
                    <script>document.addEventListener('DOMContentLoaded', function() {
                            // Выбираем форму и добавляем обработчик отправки
                            const form = document.querySelector('form[name="bookingForm"]');

                            form.addEventListener('submit', function(e) {
                                // Получаем значение поля даты
                                const dateValue = document.getElementById('event_{{ $eve_id }}').value;

                                // Логируем дату в консоль
                                console.log('Дата, отправляемая на сервер:', dateValue);
                            });
                        });</script>
                    <a id="my-link" onclick="likeButtonClicked({{ $eve_id }});"
                       class="btn_full_outline ladda-button"
                       data-page_action="toggleSingleTourWishlistButton"
                       data-add_text="Add to wishlist" data-remove_text="Remove from wishlist"
                       data-wishlist_tour_hashed_id="6" data-style="zoom-in">
                        <span class="ladda-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-heart-fill" viewBox="0 0 16 16">
                               <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                            </svg> {{ __('translate.Ad to wishlist') }}
                        </span>
                        <span class="ladda-spinner"></span></a>

                    <button type="button" data-toggle="modal" data-target="#bonusProgramModal"
                            style="background-color: #e8aa1b; margin-top: 10px; border-color: #e27513;"
                            class="btn_full">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-bag-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                            <path
                                d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                        </svg>
                        BONUS +
                    </button>
                    @if($event->category == 4 && $event->piple !== null)
                        <span type="button" data-toggle="modal" data-target="#bonusProgramModal"
                              style="background-color: #008dc9; font-size: 22px;  border-color: #165a9d;"
                              class="btn_full"> {{$event->piple }} <svg style=" margin-top: -3px; "
                                                                        xmlns="http://www.w3.org/2000/svg" width="22"
                                                                        height="22" fill="currentColor"
                                                                        class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path
                                d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            <path fill-rule="evenodd"
                                  d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                        </svg> - {{$event->discounte }} %
                    </span>
                    @endif
                </div>
                <div class="box_style_4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                         class="bi bi-telephone-outbound" viewBox="0 0 16 16">
                        <path
                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5"/>
                    </svg>
                    <h4><span>  @if ($event->category != 4)
                                {{ __('translate.Book') }}
                            @else
                                {{ __('translate.Buy') }}
                            @endif</span> {{ __('translate.by phone') }}</h4>    <a
                        href="tel://+38{{$event->phone}}" class="phone">+38{{$event->phone}}</a>
                    <small>Monday to Friday 9.00am - 7.30pm</small>
                </div>
            </aside>
        </div>
    </div>
    @php
        }
    @endphp

    @php
    if ($event_quest == 'guest') {
    @endphp
    @guest
        @php
            $url = $_SERVER['REQUEST_URI'];
            $path = parse_url($url, PHP_URL_PATH);
            $segments = explode('/', trim($path, '/'));
            $valueAfterSlash = isset($segments[0]) ? htmlspecialchars($segments[0]) : 'No value found';
        @endphp
        <div class="container margin_60" style="margin-top:-25px;" id="quest_tu">
            <form id="orderForm1" action="{{ route('orders.store_no_reg', ['event_id' => $valueAfterSlash]) }}"
                  method="POST">
                @csrf <!-- Добавьте эту строку -->
                <div class="row">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Order Form') }}!</h3>
                        <h6>{{ __('translate.Enter your details for checkout') }} </h6>
                        <center>
                            <svg xmlns="http://www.w3.org/2000/svg" width="106" height="106" class="bi bi-info-circle" viewBox="0 0 16 16" fill="#605e63">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                            </svg>
                        </center>
                    </div>
                    <div class="col-lg-9">
                        <tr class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <h6>Дата</h6>
                                <div class="row" id="datepicker-wrapper" style="cursor: pointer;" {{ ($event_type_pay == 1 || $event_type_pay == 2) ? '' : 'hidden' }}>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="vdp-datepicker">
                                                <input type="text" id="event_{{ $eve_id }}" name="dateOn" class="form-control" placeholder="YYYY-MM-DD" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Выбираем все элементы input с типом "text" и атрибутом id
                                        const datepickerElements = document.querySelectorAll('input[type="text"][id^="event_"]');

                                        // Инициализация Flatpickr для каждого найденного элемента
                                        datepickerElements.forEach(datepickerElement => {
                                            const flatpickrInstance = flatpickr(datepickerElement, {
                                                dateFormat: "Y-m-d",
                                                defaultDate: new Date(), // Устанавливаем текущую дату
                                                disable: [], // Пока не отключаем даты, инициализация произойдет при фокусе
                                                onChange: function(selectedDates, dateStr, instance) {
                                                    datepickerElement.value = dateStr;

                                                }
                                            });

                                            // Добавляем обработчик фокуса на элементе datepicker
                                            datepickerElement.addEventListener('focus', function() {
                                                const itemId = this.id; // Получаем ID элемента

                                                // Отправляем AJAX-запрос для получения занятых дат
                                                fetch(`/get-busy-dates/${itemId.replace('event_', '')}`)
                                                    .then(response => {
                                                        if (!response.ok) {
                                                            throw new Error("Ошибка сети при запросе занятых дат.");
                                                        }
                                                        return response.json();
                                                    })
                                                    .then(busyDates => {
                                                        console.log("Занятые даты:", busyDates); // Логируем полученные данные

                                                        if (busyDates && busyDates.length > 0) {
                                                            // Обновление отключенных дат в Flatpickr
                                                            flatpickrInstance.set('disable', busyDates.map(date => new Date(date)));
                                                        } else {
                                                            console.log("Занятые даты отсутствуют.");
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error("Произошла ошибка при получении занятых дат:", error);
                                                    });
                                            });
                                        });
                                    });
                                </script>
                                <style>
                                    /* Стили для неактивных дат в Flatpickr */
                                    .flatpickr-day.flatpickr-disabled {
                                        color: #d3d3d3; /* Цвет текста для неактивных дат */
                                        background-color: #f0f0f0; /* Цвет фона для неактивных дат (можно изменить) */
                                        cursor: not-allowed; /* Указывает, что дата не доступна для выбора */
                                    }
                                </style>

                                <tr>
                                    <td colspan="2" style="text-align: left;">
                                        <label for="nameReg" style="width: 100px;"><h6>Iм`я</h6></label>
                                        <input type="text" class="form-control" name="nameReg" id="nameReg" placeholder="...">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: left;">
                                        <label for="nameReg" style="width: 100px;"><h6>Прiзвище</h6></label>
                                        <input type="text" class="form-control" name="firstReg" id="firstReg"
                                               placeholder="...">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: left;">
                                        <label for="nameReg" style="width: 100px;"><h6>e-Mail</h6></label>
                                        <input type="text" class="form-control" name="emailReg" id="emailReg"
                                               placeholder="...">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: left;">
                                        <label for="nameReg" style="width: 100px;"><h6>Телефон</h6></label>
                                        <input type="tel" class="form-control" name="phoneReg" id="phoneReg"
                                               placeholder="+38(099)999-99-99" pattern="\+38\(\d{3}\)\d{3}-\d{2}-\d{2}">
                                    </td>
                                </tr>
                                @if (isset($event->add_fields))
                                        <?php
                                        $add_fields = json_decode($event->add_fields, true) ?? [];
                                        ?>
                                    @if (!empty($add_fields))
                                        @foreach ($add_fields as $field)
                                            @if ($field['name'] === 'radio_button')
                                                <tr>
                                                    <td colspan="2" style="text-align: left;">

                                                        <label for="nameReg" style="width: 100px;"><h6>{{$field['name']}}</h6></label>
                                                        <input class="form-control" type="file" id="formFile">
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="2" style="text-align: left;">
                                                        <label for="nameReg" style="width: 100px;"><h6>{{ isset($field['value']) ? htmlspecialchars($field['value']) : '' }}</h6></label>
                                                        <input class="form-control"  name="{{ isset($field['value']) ? htmlspecialchars($field['value']) : '' }}"
                                                               type="text"
                                                               placeholder="{{ isset($field['value']) ? htmlspecialchars($field['value']) : '' }}">
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                                </tbody>
                            </table>
                            <button type="submit" style="background-color: #ffc107; border-color:#ffffff; color:#ffffff;" class="btn btn-warning"
                                    style="width: 15%">{{ __('translate.Submit') }}</button>
                    </div>
                </div>
            </form>
            <div id="container_data_peaple_reg">
                <div class="row" style="">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Order Confirmed') }}!</h3>
                        <h6>{{ __('translate.Your order has been sent to your e-mail') }} </h6>
                        <center style=" color: #1c7430;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" fill="currentColor"
                                 class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path
                                    d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg>
                        </center>
                    </div>
                    <div class="col-lg-9">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                             fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                            <path
                                                d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                            <path
                                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                        </svg>
                                        {{ __('translate.Date') }} - 2027-05-10
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                             fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                            <path
                                                d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                        </svg>
                                        {{ __('translate.Time') }} - 15:00 - 21:00
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                            <path
                                                d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z"/>
                                            <path
                                                d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/>
                                        </svg>
                                        {{ __('translate.Ticket') }} - <a href="fghfg">{{ __('translate.Here') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                            <path d="M2 2h2v2H2z"/>
                                            <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"/>
                                            <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"/>
                                            <path
                                                d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
                                            <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z"/>
                                        </svg>
                                        QR - <a href="fghfg">{{ __('translate.Here') }}</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container margin_60" id="container_data_peaple">
            <div class="row">
                <div class="col-lg-3">
                    <h3>{{ __('translate.Order Confirmed') }}!</h3>
                    <h6>{{ __('translate.Your order has been sent to your e-mail') }}</h6>
                    <center style=" color: #1c7430;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor"
                             class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path
                                d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                        </svg>
                    </center>
                </div>
                <div class="col-lg-9">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                         class="bi bi-calendar-week" viewBox="0 0 16 16">
                                        <path
                                            d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                        <path
                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                    </svg>
                                    {{ __('translate.Date') }} - 2027-05-10
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                         class="bi bi-clock" viewBox="0 0 16 16">
                                        <path
                                            d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                    </svg>
                                    {{ __('translate.Time') }} - 15:00 - 21:00
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                         class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                        <path
                                            d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z"/>
                                        <path
                                            d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/>
                                    </svg>
                                    {{ __('translate.Ticket') }} - <a href="fghfg">{{ __('translate.Here') }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                         class="bi bi-qr-code" viewBox="0 0 16 16">
                                        <path d="M2 2h2v2H2z"/>
                                        <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"/>
                                        <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"/>
                                        <path
                                            d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
                                        <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z"/>
                                    </svg>
                                    QR - <a href="fghfg">{{ __('translate.Here') }}</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endguest
    <div id="overlay"></div>
    @php
    }
    @endphp
    @guest
        @php
            $url = $_SERVER['REQUEST_URI'];
               $path = parse_url($url, PHP_URL_PATH);
               $segments = explode('/', trim($path, '/'));
               $valueAfterSlash = isset($segments[0]) ? htmlspecialchars($segments[0]) : 'No value found';
        @endphp
        <div class="container margin_60" id="container_data_peaple">
            <form id="orderForm1" action="{{ route('orders.store_no_reg', ['event_id' => $valueAfterSlash]) }}"
                  method="POST">
                @csrf <!-- Добавьте эту строку -->
                <div class="row">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Order Form') }}!</h3>
                        <h6>{{ __('translate.Enter your details for checkout') }}</h6>
                    </div>
                    <div class="col-lg-9">
                        <tr class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <input type="text" class="form-control" name="nameReg" id="nameReg"
                                               placeholder="Name">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <input type="text" class="form-control" name="firstReg" id="firstReg"
                                               placeholder="Surname">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <input type="text" class="form-control" name="emailReg" id="emailReg"
                                               placeholder="e-Mail">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: left;">
                                        <label for="nameReg" style="width: 100px;"><h6>Телефон</h6></label>
                                        <input type="text" class="form-control" name="phoneReg" id="phoneReg"
                                               placeholder="...">
                                    </td>
                                </tr>
                                @if (isset($event->add_fields))
                                        <?php
                                        $add_fields = json_decode($event->add_fields, true) ?? [];
                                        ?>
                                    @if (!empty($add_fields))
                                        @foreach ($add_fields as $field)
                                            @if ($field['name'] === 'radio_button')
                                                <tr>
                                                    <td colspan="2" style="text-align: center;">
                                                        <input class="form-control" type="file" id="formFile">
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="2" style="text-align: center;">
                                                        <input class="form-control" name="{{ $field['name'] }}"
                                                               type="text"
                                                               placeholder="{{ isset($field['value']) ? htmlspecialchars($field['value']) : '' }}">
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                                </tbody>
                            </table>
                            <button type="submit" class="btn_full"
                                    style="width: 15%">{{ __('translate.Submit') }}</button>
                    </div>
                </div>
            </form>
            <div id="container_data_peaple_reg">
                <div class="row" style="">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Order Confirmed') }}!</h3>
                        <h6>{{ __('translate.Your order has been sent to your e-mail') }} </h6>
                        <center style=" color: #1c7430;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor"
                                 class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path
                                    d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg>
                        </center>
                    </div>
                    <div class="col-lg-9">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                             fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                            <path
                                                d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                            <path
                                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                        </svg>
                                        {{ __('translate.Date') }} - 2027-05-10
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                             fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                            <path
                                                d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                        </svg>
                                        {{ __('translate.Time') }} - 15:00 - 21:00
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                            <path
                                                d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z"/>
                                            <path
                                                d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/>
                                        </svg>
                                        {{ __('translate.Ticket') }} - <a href="fghfg">{{ __('translate.Here') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                            <path d="M2 2h2v2H2z"/>
                                            <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"/>
                                            <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"/>
                                            <path
                                                d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
                                            <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z"/>
                                        </svg>
                                        QR - <a href="fghfg">{{ __('translate.Here') }}</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @php
            $url = $_SERVER['REQUEST_URI'];
               $path = parse_url($url, PHP_URL_PATH);
               $segments = explode('/', trim($path, '/'));
               $valueAfterSlash = isset($segments[0]) ? htmlspecialchars($segments[0]) : 'No value found';
        @endphp
        <div class="container margin_60" id="container_data_peaple">
            <form id="orderForm1" action="{{ route('orders.store_no_reg', ['event_id' => $valueAfterSlash]) }}"
                  method="POST">
                @csrf <!-- Добавьте эту строку -->
                <div class="row">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Order Form') }}!</h3>
                        <h6>{{ __('translate.Enter your details for checkout') }}</h6>
                    </div>
                    <div class="col-lg-9">
                        <tr class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                @if (isset($event->add_fields))
                                        <?php
                                        $add_fields = json_decode($event->add_fields, true) ?? [];
                                        ?>
                                    @if (!empty($add_fields))
                                        @foreach ($add_fields as $field)
                                            @if ($field['name'] === 'radio_button')
                                                <tr>
                                                    <td colspan="2" style="text-align: left;">

                                                        <label for="nameReg" style="width: 100px;"><h6>{{$field['name']}}</h6></label>
                                                        <input class="form-control" type="file" id="formFile">
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="2" style="text-align: left;">
                                                        <label for="nameReg" style="width: 100px;"><h6>{{ isset($field['value']) ? htmlspecialchars($field['value']) : '' }}</h6></label>
                                                        <input class="form-control" name="{{ $field['name'] }}"
                                                               type="text"
                                                               placeholder="...">
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                                </tbody>
                            </table>
                            <button type="submit" style="background-color: #ffc107; border-color:#ffffff; color:#ffffff;" class="btn btn-warning"
                                    style="width: 15%">{{ __('translate.Submit') }}</button>
                    </div>
                </div>
            </form>
            <div id="container_data_peaple_reg">
                <div class="row" style="">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Order Confirmed') }}!</h3>
                        <h6>{{ __('translate.Your order has been sent to your e-mail') }} </h6>
                        <center style=" color: #1c7430;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor"
                                 class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path
                                    d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg>
                        </center>
                    </div>
                    <div class="col-lg-9">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                             fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                            <path
                                                d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                            <path
                                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                        </svg>
                                        {{ __('translate.Date') }} - 2027-05-10
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                             fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                            <path
                                                d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                            <path
                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                        </svg>
                                        {{ __('translate.Time') }} - 15:00 - 21:00
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                            <path
                                                d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z"/>
                                            <path
                                                d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/>
                                        </svg>
                                        {{ __('translate.Ticket') }} - <a href="fghfg">{{ __('translate.Here') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                            <path d="M2 2h2v2H2z"/>
                                            <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"/>
                                            <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"/>
                                            <path
                                                d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
                                            <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z"/>
                                        </svg>
                                        QR - <a href="fghfg">{{ __('translate.Here') }}</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endguest
</main>
<div class="modal fade" id="myReview" tabindex="-1" role="dialog" aria-labelledby="myReviewLabel" aria-hidden="true"
     data-page_action="closeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myReviewLabel">{{ __('translate.Write your review') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div id="message-review">
                </div>
                <h6>
                    {{ __('translate.You need to login to be able to leave a review') }}. </h6>
            </div>
        </div>
    </div>
</div>
<style>
    #scrollToTopBtn {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 99;
        border: none;
        outline: none;
        background-color: #565a5c;
        color: white;
        cursor: pointer;
        padding: 15px;
        border-radius: 10px;
    }
</style>
<button onclick="scrollToTop()" id="scrollToTopBtn" title="Наверх">
    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-up-circle"
         viewBox="0 0 16 16">
        <path fill-rule="evenodd"
              d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
    </svg>
</button>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-2 m-auto">
                <a href="http://eventhes.com/">
                    <img style="max-width: 100%" src="{{ asset('storage/css/site_logo.png') }}">
                </a>
            </div>
            <div class="col-md-4">
                <h3>{{ __('translate.Need help') }}?</h3>
                <span><a href="tel://+970599593301"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                         fill="currentColor" class="bi bi-telephone"
                                                         viewBox="0 0 16 16">
                    <path
                        d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                </svg></a>+38(099)217-5697</span><br>
                <span><a href="mailto:help@Istanbul%20Tours.com"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                      height="16" fill="currentColor"
                                                                      class="bi bi-envelope-at" viewBox="0 0 16 16">
                    <path
                        d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
                    <path
                        d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                </svg></a> support@eventhes.com</span>
            </div>
            <div class="col-md-3">
                <ul>
                    <li><a href="http://eventhes.com/">{{ __('translate.Home') }}</a></li>
                    <li><a href="http://eventhes.com/contact-us">{{ __('translate.Contact Us') }}</a></li>
                    <li><a href="http://eventhes.com/about-us">About us</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h3>Settings</h3>
                <div class="styled-select">
                    <select name="lang" id="lang">
                        <option value="{{ url('/lang/en') }}" {{ App::getLocale() == 'en' ? 'selected' : '' }}>English
                        </option>
                        <option value="{{ url('/lang/ru') }}" {{ App::getLocale() == 'ru' ? 'selected' : '' }}>Русский
                        </option>
                        <option value="{{ url('/lang/pl') }}" {{ App::getLocale() == 'pl' ? 'selected' : '' }}>Polski
                        </option>
                        <option value="{{ url('/lang/ua') }}" {{ App::getLocale() == 'ua' ? 'selected' : '' }}>
                            Українська
                        </option>
                    </select>
                </div>
                <script>
                    document.getElementById('lang').addEventListener('change', function () {
                        var selectedOption = this.options[this.selectedIndex];
                        if (selectedOption.value !== "") {
                            window.location.href = selectedOption.value;
                        }
                    });
                </script>
            </div>
        </div>
        <div class="modal fade modal-transparent" style="margin-top: 50px;" id="bonusProgramModal" tabindex="-1"
             aria-labelledby="bonusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bonusModalLabel" style="color: #001f3f;">Програма BONUS+</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center><p style="color: #001f3f;">Це програма розповсюдження реферальних посилань на
                                послугу!</p>
                            <h3>
                                <p>
                                    @auth
                                        <?php $user = auth()->user(); ?>
                                        @if($user->code_part != NULL)
                                            <label style="color: #001f3f;">
                                                Реферальне посилання - <a style="color: #001f3f;"
                                                                          href="{{ route('events.show', ['id' => $eve_id, 'code' => $user->code_part]) }}">https://eventhes.com/{{$eve_id}}
                                                    /{{$user->code_part}}</a>
                                            </label>
                                <p>
                                    <a style="color: #575151;"
                                       href="https://telegram.me/share/url?url=https://eventhes.com/{{$eve_id}}/{{$user->code_part}}"
                                       data-share="https://telegram.me/share/url?url=https://www.facebook.com/sharer/sharer.php?u=https://eventhes.com/{{$eve_id}}/{{$user->code_part}}"
                                       data-type="telegram" target="_blank" role="button">Поделиться в
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                                        </svg>
                                    </a>
                                </p>
                                <p>
                                    <a style="color: #575151;"
                                       href="https://www.facebook.com/sharer/sharer.php?u=https://eventhes.com/{{$eve_id}}/{{$user->code_part}}"
                                       data-share="https://www.facebook.com/sharer/sharer.php?u=https://eventhes.com/{{$eve_id}}/{{$user->code_part}}"
                                       target="_blank" role="button"> Поделиться в
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                        </svg>
                                    </a>
                                </p>
                                @else
                                    <label style="color: #001f3f;">
                                        <input style="color: #001f3f;" type="checkbox" id="referralCheckbox"
                                               name="referralCheckbox">
                                        Я згоден(-на) стати участником програми
                                    </label>
                                @endif
                                @endauth
                                @guest
                                    <label style="color: #001f3f;">
                                        Автаризуйтесь спочатку!
                                    </label>
                                @endguest
                                <p style="color: #575151; font-size: 13px;">Поширюйте посилання на нас та отримуйте
                                    BONUS </p>
                                </p>
                            </h3>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="close" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        <li><a href="https://www.facebook.com/eventhes">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                </svg>
                            </a></li>
                        <li><a href="https://twitter.com/corals_laraship">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-emoji-expressionless" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path
                                        d="M4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m5 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                                </svg>
                            </a></li>
                        <li><a href="https://www.linkedin.com/">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path
                                        d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                                </svg>
                            </a></li>
                        <li><a href="https://www.instagram.com/">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                                </svg>
                            </a></li>
                        <li><a href="https://www.pinterest.com/">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-pinterest" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0"/>
                                </svg>
                            </a></li>
                    </ul>
                    <p>© 2024 <a target="_blank" href="http://corals.io/" title="Corals.io">eventhes.com</a>.
                        All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="modal fade modal-transparent" style="margin-top: 50px;" id="trTR" tabindex="-1"
     aria-labelledby="bonusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trTR" style="color: #001f3f;">Кошик</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <p style="color: #001f3f;">Ваші товари у кошику:</p>
                    <h3>
                        <p>
                            Кількість товарів: {{ $cartCount > 0 ? $cartCount : '0' }}
                        </p>
                    </h3>
                </center>
            </div>
            <style>
                .btn-warning {
                    color: grey; /* Цвет текста */
                    background-color: #ffffff; /* Цвет фона (по умолчанию) */
                    border: 2px solid grey; /* Серая рамка */
                }

                .btn-warning:hover {
                    background-color: #f0f0f0; /* Цвет фона при наведении */
                    color: grey; /* Цвет текста при наведении */
                }
            </style>
            <div class="modal-footer">
                <button type="button" id="doing-checkout-button" onclick="window.location.href='/cart/order'" class="btn btn-secondary" >
                    Оформить
                </button>
                <button type="button" class="close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-transparent" style="margin-top: 50px;" id="trDoing" tabindex="-1" aria-labelledby="doingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="doingModalLabel" style="color: #001f3f;">Події</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <p style="color: #001f3f;">Ваші події у кошику:</p>
                    <h3>
                        <p id="doing-cart-count">
                            Кількість подій: {{ $cartDoingCount > 0 ? $cartDoingCount : '0' }}
                        </p>
                    </h3>
                </center>
            </div>
            <style>
                .btn-warning {
                    color: grey;
                    background-color: #ffffff;
                    border: 2px solid grey;
                }
                .btn-warning:hover {
                    background-color: #f0f0f0;
                    color: grey;
                }
            </style>
            <div class="modal-footer">
                <button type="button" id="doing-checkout-button" onclick="window.location.href='/cart/order'" class="btn btn-secondary" >
                    Оформить
                </button>
                <button type="button" class="close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-transparent" style="margin-top: 50px;" id="trQR" tabindex="-1"
     aria-labelledby="bonusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trTR" style="color: #001f3f;"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <div class="form-group">
                        <label for="foto_title">QR-code</label>
                        <center><img src="{{$qrCodeData}}" style="width: 50%;" ></center>
                    </div>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#bonusProgramModal .close').click(function () {
            $('#bonusProgramModal').modal('hide');
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        var modalButton = document.querySelector('[data-target="#bonusProgramModal"]');

        if (modalButton) {
            modalButton.addEventListener("click", function () {
                var modal = document.querySelector('#bonusProgramModal');
                if (modal) {
                    var modal = new bootstrap.Modal(modal);
                    modal.show();
                }
            });
        }
    });

    function copyToClipboard() {
        var copyText = document.getElementById("copyLink");
        var tempInput = document.createElement("input");
        tempInput.value = copyText.textContent;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("Ссылка скопирована: " + copyText.textContent);
    }
</script>
</html>
<link rel="stylesheet" href="{{ asset('storage/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('storage/AdminLTE/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var currentDate = moment().format('DD/MM/YYYY');
        $('#datepicker').val(currentDate);
    });

    $(document).ready(function () {
        $('.qty2').val(1);
        $('#container_booking').show();
        $('#container_data_peaple').hide();
        $('.qty2').on('click', '.rt2, .rt3', function () {
            var input = $(this).siblings('input[type="text"]');
            var value = parseInt(input.val());
            if (isNaN(value)) {
                value = 0;
            }
            if ($(this).hasClass('rt2')) {
                value += 1;
            } else if ($(this).hasClass('rt3')) {
                value -= 1;
            }
            value = Math.max(value, 0);
            input.val(value);
        });
    });
    $(document).ready(function () {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#container_data_peaple_reg').hide();
        $('#orderForm1').submit(function (event) {
            event.preventDefault();

            var formDataArray = $(this).serializeArray();

            var formDataObject = {};
            $.each(formDataArray, function (_, kv) {
                formDataObject[kv.name] = kv.value;
            });

            formDataObject['_token'] = csrfToken;

            formDataObject['date'] = moment($('#datepicker').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
            formDataObject['quantity'] = $('.qty2').val();
            formDataObject['event_id'] = '{{ $eve_id }}';
            var self = this;
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formDataObject,
                success: function (response) {
                    console.log('Данные успешно отправлены');
                    console.log(response);

                    $('#container_data_peaple_reg').show();
                    $(self).hide();
                },
                error: function (xhr, status, error) {
                    console.error('Произошла ошибка при отправке данных:', error);
                    var response = xhr.responseJSON;
                    if (response && response.errors) {
                        var errorMessage = '';
                        for (var field in response.errors) {
                            errorMessage += field + ': ' + response.errors[field].join(', ') + '\n';
                        }
                        alert(errorMessage);
                    } else {
                        alert('Произошла ошибка при отправке данных. Пожалуйста, попробуйте еще раз.');
                    }
                }
            });
        });
        $(document).ready(function () {
            $('.booking-form').submit(function (event) {
                event.preventDefault();

                // Получаем значение даты из поля #datepicker
                var dateInput = $('#datepicker').val();

                // Устанавливаем значение даты в формате 'YYYY-MM-DD' или 9999-01-01, если дата отсутствует
                var date;
                if (dateInput) {
                    var parsedDate = moment(dateInput, 'DD/MM/YYYY', true);
                    date = parsedDate.isValid() ? parsedDate.format('YYYY-MM-DD') : '9999-01-01';
                } else {
                    date = '9999-01-01';
                }

                // Получаем event_id из Blade-шаблона
                var eventId = '{{ $id }}';

                // Формируем данные формы
                var formData = {
                    date: date,
                    quantity: $('.qty2').val(),
                    event_id: eventId,
                    reg1: $('#reg1').val(),
                    reg2: $('#reg2').val(),
                    _token: '{{ csrf_token() }}'
                };

                // Выводим event_id в алерте
                alert('Event ID: ' + formData.event_id);

                // Отправка данных на сервер через AJAX
                $.ajax({
                    type: 'POST',
                    url: '{{ route('orders.store') }}',
                    data: formData,
                    success: function (response) {
                        console.log('Данные успешно отправлены');
                        console.log(response);

                        if (response.data === 1) {
                            $('#container_booking').hide();
                            $('#container_data_peaple').show();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Произошла ошибка при отправке данных:', error);
                    }
                });
            });
        });


    });
    $(document).ready(function () {
        $('[data-fancybox="gallery"]').fancybox({});
    });
    window.addEventListener('load', function () {
        var preloader = document.getElementById('preloader');
        preloader.style.display = 'none';
    });

    $(document).ready(function () {
        $('.rt2').click(function () {
            var currentValue = parseInt($('#adults').val());
            $('#adults').val(currentValue + 1);
            updateTotalCost();
        });
        $('.rt3').click(function () {
            var currentValue = parseInt($('#adults').val());
            if (currentValue > 0) {
                $('#adults').val(currentValue - 1);
                updateTotalCost();
            }
        });
        $('#adults').change(function () {
            updateTotalCost();
        });

        function updateTotalCost() {
            var quantity = parseInt($('#adults').val());
            var totalAmountText = $('#totalAmount').text().match(/[\d\.]+/);
            var totalAmount = totalAmountText ? parseFloat(totalAmountText[0]) : 0;
            var totalCost = quantity * totalAmount;
            $('#totalCost').text(totalCost.toFixed(2));
        }

    });
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("scrollToTopBtn").style.display = "block";

        } else {
            document.getElementById("scrollToTopBtn").style.display = "none";
        }
    }

    function scrollToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function likeButtonClicked(eventId) {
        fetch('/like', {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({event_id: eventId})
        })
            .then(response => response.json())
            .then(data => {
                alert(eventId);
                if (data.success) {
                    sessionStorage.setItem('likedEventId', eventId);
                    alert('Added like!');
                } else {
                    alert('Error!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('header').outerHeight();

    $(window).scroll(function (event) {
        didScroll = true;
    });

    setInterval(function () {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        var st = $(this).scrollTop();

        if (Math.abs(lastScrollTop - st) <= delta)
            return;
        if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            $('header').removeClass('nav-down').addClass('nav-up');
        } else {
            // Scroll Up
            if (st + $(window).height() < $(document).height()) {
                $('header').removeClass('nav-up').addClass('nav-down');
            }
        }

        lastScrollTop = st;
    }

    $(document).ready(function () {
        $('.cmn-toggle-switch').on('click', function () {
            $('header').toggleClass('open');
        });
    });

    document.querySelector('.open_close').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('opened');
    });

    var lastScrollTop = 0;
    window.addEventListener("scroll", function () {
        var currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        if (currentScroll > lastScrollTop) {
            // Прокрутка вниз
            document.querySelector('header').classList.add('nav-up');
            document.querySelector('header').classList.remove('nav-down');
        } else {
            // Прокрутка вверх
            document.querySelector('header').classList.add('nav-down');
            document.querySelector('header').classList.remove('nav-up');
        }
        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    }, false);

    $('nav a[data-target="descript"]').click(function (e) {
        e.preventDefault();
        var headerHeight = 100;
        var $descriptElement = $('#descript');

        $('html, body').animate({
            scrollTop: $descriptElement.offset().top - headerHeight
        }, 1000);
    });
    $('nav a[data-target="portfol"]').click(function (e) {
        e.preventDefault();
        var headerHeight = 100;
        var $portfolioElement = $('#portfol');

        $('html, body').animate({
            scrollTop: $portfolioElement.offset().top - headerHeight
        }, 1000);
    });
    $('nav a[data-target="goods"]').click(function (e) {
        e.preventDefault();
        var headerHeight = 100;
        var $goodsElement = $('#goods');

        $('html, body').animate({
            scrollTop: $goodsElement.offset().top - headerHeight
        }, 1000);
    });

    var currentUrl = window.location.pathname;
    if (currentUrl === "/admin" || currentUrl === "/admin/") {
        document.querySelector('.nav-item a[href="/admin"]').classList.add('active');
    }

    setInterval(function () {
        $.ajax({
            url: "{{ route('alerts.count') }}",
            method: 'GET',
            success: function (response) {
                var count = response.count;
                $('#alerts').text(count);
                $('#orders-alerts').text(count);

                if (count === 0) {
                    $('#alerts').hide();
                    $('#orders-alerts').hide();
                } else {
                    $('#alerts').show();
                    $('#orders-alerts').show();
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }, 2000);

    function scrollToMain() {
        var mainElement = document.getElementById('main');
        mainElement.scrollIntoView({behavior: 'smooth'});
    }


    // Ждем загрузки DOM, чтобы гарантировать, что все элементы уже доступны
    document.addEventListener("DOMContentLoaded", function () {
        // Находим кнопку, которая открывает модальное окно
        var modalButton = document.querySelector('[data-target="#trTR"]');

        // Если кнопка найдена
        if (modalButton) {
            // Добавляем обработчик события клика
            modalButton.addEventListener("click", function () {
                // Находим модальное окно по его идентификатору
                var modal = document.querySelector('#trTR');
                // Показываем модальное окно
                if (modal) {
                    var modal = new bootstrap.Modal(modal);
                    modal.show();
                }
            });
        }
        // Обработчик для второго модального окна
        var modalButtonDoing = document.querySelector('[data-target="#trDoing"]');
        if (modalButtonDoing) {
            modalButtonDoing.addEventListener("click", function () {
                var modal = document.querySelector('#trDoing');

                if (modal) {
                    var modal = new bootstrap.Modal(modal);
                    modal.show();
                }
            });
        }
    });

    function AddDoing(id) {
        fetch('/doings/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Событие добавлено в корзину!'+id);
                    console.log('Cart Doing count:', data.cartCount);
                    let cartDoingItemCount = document.getElementById('cart-doing-item-count');
                    cartDoingItemCount.innerText = data.cartCount;
                } else {
                    alert('Произошла ошибка при добавлении события в корзину.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function AddBasket(id) {
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Товар добавлен в корзину!');
                    console.log(data); // Выводим данные в консоль для проверки

                    // Проверка содержимого data
                    console.log('Cart count:', data.cartCount);

                    // Обновляем счетчик корзины
                    let cartItemCount = document.getElementById('cart-item-count');
                    cartItemCount.innerText = data.cartCount;
                } else {
                    // Обработка ошибки
                    alert('Произошла ошибка при добавлении товара в корзину.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    document.getElementById('openModalButton').addEventListener('click', function(event) {
        event.preventDefault(); // предотвращает переход по ссылке
        $('#trQR').modal('show'); // показывает модальное окно
    });


</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var element = document.getElementById("quest_tu");
        if (element) {
            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
</script>









