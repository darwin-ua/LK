<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{$event->title}}</title>

    <meta name="description" content="home">
    <meta name="keywords" content="home">
    <meta property="og:title" content="{{$event->title}}">
    <meta property="og:image" content="https://eventhes.com/storage/css/site_logo.png">
    <meta property="og:description" content="">
    <meta property="og:url" content="https://eventhes.com/{{$event->id}}">
    <meta property="og:site_name" content="{{$event->title}}">
    <meta property="og:type" content="website">
    <link rel="apple-touch-icon" sizes="180x180" href="https://eventhes.com/storage/AdminLTE/fav.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://eventhes.com/storage/AdminLTE/fav.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://eventhes.com/storage/AdminLTE/fav.png">
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
</head>
<body class="" style="margin-bottom: 31px; overflow: visible;">
<div style="height: 100%; width: 100%;">
    <img src="@if(!empty($event->foto_title))files/{{$user->id}}/{{$event->foto_title}} @else storage/fonts/8150248.jpg @endif"
         style="position: absolute; height: 100%; width: 100%; max-width: none;">
</div>
</body>
<style>#my-link {
        text-decoration: none;
    }</style>
<div id="preloader" >
    <div class="sk-spinner sk-spinner-wave">
        <div class="sk-rect1"></div>
        <div class="sk-rect2"></div>
        <div class="sk-rect3"></div>
        <div class="sk-rect4"></div>
        <div class="sk-rect5"></div>
    </div>
</div>
<div class="layer"></div>
<section class="parallax-window" data-parallax="scroll"
         data-image-src="http://eventhes.com/media/user_v1oz1Yz27j/11/Maiden_Tower_Turkey.jpg" data-natural-width="1400"
         data-natural-height="470">
    <div class="parallax-content-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8" style="background-color: #565a5c; border-radius: 5px;  width:35%;">
                    <h1>{{ $event->title }}</h1>
                    <hr style="border: 0; border-top: 1px solid #000;">
                    @php
                        $parts = explode('|', $reserv);
                        $startDateString = trim(str_replace('Start date:', '', $parts[0]));
                        $startDate = date('Y-m-d', strtotime($startDateString));
                        $endDateString = trim(str_replace('End date:', '', $parts[1]));
                        $endDate = date('Y-m-d', strtotime($endDateString));
                    @endphp
                    <span style="font-size: 17px;"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                               class="bi bi-calendar-week" viewBox="0 0 16 16">
  <path
      d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
  <path
      d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
</svg> - {{ $startDate}}- {{$endDate}}</span>

                    @if($time == '00:00:00')
                    <br>
                        <span style="font-size: 17px;  margin-top:-20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-clock"
             viewBox="0 0 16 16">
            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
        </svg>
        - {{ __('translate.Any time') }}
    </span>
                        <br>
                    @else
                        <span style="font-size: 17px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-clock"
             viewBox="0 0 16 16">
            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
        </svg>
        - {{ $time }}
    </span>
                    @endif
                    <br>
                </div>
                <div class="col-md-4" style="left: 30%;">
                    <div id="price_single_main">
                        @if($event->type_pay == 1)
                        {{ __('translate.from/per person') }} <span>{{$event->amount}} $</span>
                        @else
                            {{ __('translate.from/per person') }} <span>{{ __('translate.FREE') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<main>
    <div id="position" style="background-color: #e04f67;">
        <center>
                   <span style="color: #FFFFFF; font-size: 25px;"><svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                                       height="25" fill="currentColor"
                                                                       class="bi bi-geo-alt" viewBox="0 0 16 16">
  <path
      d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
  <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg>{{ __('translate.MAP') }}</span>
        </center>
    </div>
    <div class="container margin_60" id="container_booking">
        <div class="row">
            <div class="col-lg-8" id="single_tour_desc">

                <div id="single_tour_feat">
                    <ul>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                 class="bi bi-facebook" viewBox="0 0 16 16">
                                <path
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                 class="bi bi-instagram" viewBox="0 0 16 16">
                                <path
                                    d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                            </svg>
                        </li>

                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                 class="bi bi-camera-video" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1z"/>
                            </svg>
                        </li>

                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                 class="bi bi-link-45deg" viewBox="0 0 16 16">
                                <path
                                    d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z"/>
                                <path
                                    d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z"/>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                 class="bi bi-youtube" viewBox="0 0 16 16">
                                <path
                                    d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                 class="bi bi-telegram" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                 class="bi bi-twitter-x" viewBox="0 0 16 16">
                                <path
                                    d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                            </svg>
                        </li>
                    </ul>
                </div>
                <p class="d-none d-md-block d-block d-lg-none">
{{--                    <a class="btn_map collapsed" data-toggle="collapse"--}}
{{--                                                                  href="http://eventhes.com/tours/kiz-kulesi#collapseMap"--}}
{{--                                                                  aria-expanded="false" aria-controls="collapseMap"--}}
{{--                                                                  data-text-swap="Hide map"--}}
{{--                                                                  data-text-original="View on map">{{ __('translate.View on map') }}</a>--}}
                </p>
                <!-- Map button for tablets/mobiles -->
                <div class="row">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Description') }}</h3>
                    </div>
                    <div class="col-lg-9">
                        {!! $event->description !!}
                    </div>
                </div>
                <hr>
                <div class="row">
    <span>
        <h3>{{ __('translate.Portfolio') }}</h3>
    </span>
                    @foreach($imageData as $image)
                        <div class="col-lg-4">
                            <div class="gallery-item">
                                <a href="{{ $image->path }}" data-fancybox="gallery">
                                    <img src="{{ $image->path }}" class="img-fluid" alt="{{ $image->description }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
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
                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Organizator') }}</h3>
                    </div>
                    <div class="col-lg-9">
                        <h4>{{ $user->name }}</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Reviews') }} </h3>
                        <a href="http://eventhes.com/tours/kiz-kulesi#" class="btn_1 add_bottom_30" id="my-link" data-toggle="modal"
                           data-target="#myReview">
                           {{ __('translate.Leave a review') }} </a>
                    </div>
                    <div class="col-lg-9">
                        <div id="general_rating">
                             {{ __('translate.Reviews') }}
                            <div class="rating">
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                    </svg></i>
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                    </svg></i>
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                    </svg></i>
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                    </svg></i>
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5m4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5"/>
                                    </svg></i>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <aside class="col-lg-4">
                <div class="box_style_1 expose">
                    <div id="booking-vue">
                        <form name="bookingForm" action="{{ route('orders.store') }}" method="post"
                              class="booking-form">
                            <h3 class="inner">- {{ __('translate.Booking') }} -</h3>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> {{ __('translate.Select a date') }}</label>
                                        <div class="vdp-datepicker">
                                            <div class="">
                                                <input type="text" placeholder="YYY-MM-DD" readonly="readonly"
                                                       autocomplete="off" class="form-control vuejs-datepicker"
                                                       id="datepicker">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label> {{ __('translate.Quantity') }} </label>
                                        <div class="numbers-row">
                                            <button style="border-radius: 4px;  width: 30%;" type="button" class="rt2">
                                                +
                                            </button>
                                            <button style="border-radius: 4px; width: 30%;" type="button" class="rt3">
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
                                    <td class="text-right" id="totalAmount">
                                        {{$event->currency}} {{$event->amount}}
                                    </td>
                                </tr>
                                <tr class="total">
                                    <td>
                                        {{ __('translate.Total Cost') }}
                                    </td>
                                    <td class="text-right" id="totalCost">
                                        {{$event->currency}} {{$event->amount}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            @guest
                                <button type="submit"  class="btn_full">{{ __('translate.Send') }}</button>
                                <input type="text" style="display: none;" value="0"  id="reg1">
                            @else
                                <input type="text" style="display: none;" value="1"  id="reg2">
                                <button type="submit"  class="btn_full">{{ __('translate.Send') }}</button>
                            @endguest
                        </form>
                    </div>
                    <a id="my-link"  onclick="likeButtonClicked({{ $event->id }});" class="btn_full_outline ladda-button"
                        data-page_action="toggleSingleTourWishlistButton"
                       data-add_text="Add to wishlist" data-remove_text="Remove from wishlist"
                       data-wishlist_tour_hashed_id="6" data-style="zoom-in">
                        <span class="ladda-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
</svg> {{ __('translate.Ad to wishlist') }}
                        </span>
                        <span class="ladda-spinner"></span></a>
                </div>
                <!--/box_style_1 -->
                <div class="box_style_4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                         class="bi bi-telephone-outbound" viewBox="0 0 16 16">
                        <path
                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5"/>
                    </svg>
                    <h4><span>{{ __('translate.Book') }}</span> {{ __('translate.by phone') }}</h4>    <a href="tel://+38{{$event->phone}}"
                                                              class="phone">+38{{$event->phone}}</a>
                    <small>Monday to Friday 9.00am - 7.30pm</small>
                </div>
            </aside>
        </div>
    </div>
    @guest
        <div class="container margin_60" id="container_data_peaple">
            <form id="orderForm1" action="{{ route('orders.store_no_reg') }}" method="POST">
                @csrf <!-- Добавьте эту строку -->
                <div class="row">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Order Form') }}!</h3>
                        <h6>{{ __('translate.Enter your details for checkout') }} </h6>
                    </div>
                    <div class="col-lg-9">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <input type="text" class="form-control" id="nameReg" placeholder="Name">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <input type="text" class="form-control" id="firstReg" placeholder="Surname">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <input type="text" class="form-control" id="emailReg" placeholder="e-Mail">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <input type="text" class="form-control" id="phoneReg" placeholder="Phone">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn_full" style="width: 15%">{{ __('translate.Submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
            </form>
            <div id="container_data_peaple_reg">
                <div class="row">
                    <div class="col-lg-3">
                        <h3>{{ __('translate.Order Confirmed') }}!</h3>
                        <h6>{{ __('translate.Your order has been sent to your e-mail') }}</h6>
                    </div>
                    <div class="col-lg-9">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                        </svg>
                                        {{ __('translate.Date') }} - 2027-05-10
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                        </svg>
                                        {{ __('translate.Time') }} - 15:00 - 21:00
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                            <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z"/>
                                            <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/>
                                        </svg>
                                        {{ __('translate.Ticket') }} - <a href="fghfg">{{ __('translate.Here') }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                            <path d="M2 2h2v2H2z"/>
                                            <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"/>
                                            <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"/>
                                            <path d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
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
                    <h6>{{ __('translate.Your order has been sent to your e-mail') }} </h6>
                </div>
                <div class="col-lg-9">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                    </svg>
                                    {{ __('translate.Date') }} - 2027-05-10
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                    </svg>
                                    {{ __('translate.Time') }} - 15:00 - 21:00
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                        <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2z"/>
                                        <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/>
                                    </svg>
                                    {{ __('translate.Ticket') }} - <a href="fghfg">{{ __('translate.Here') }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                        <path d="M2 2h2v2H2z"/>
                                        <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"/>
                                        <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"/>
                                        <path d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
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
                        <option value="{{ url('/lang/en') }}" {{ App::getLocale() == 'en' ? 'selected' : '' }}>English</option>
                        <option value="{{ url('/lang/ru') }}" {{ App::getLocale() == 'ru' ? 'selected' : '' }}>Русский</option>
                        <option value="{{ url('/lang/es') }}" {{ App::getLocale() == 'es' ? 'selected' : '' }}>Español</option>
                        <option value="{{ url('/lang/fr') }}" {{ App::getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
                        <option value="{{ url('/lang/pl') }}" {{ App::getLocale() == 'pl' ? 'selected' : '' }}>Polski</option>
                        <option value="{{ url('/lang/ua') }}" {{ App::getLocale() == 'ua' ? 'selected' : '' }}>Українська</option>
                        <option value="{{ url('/lang/de') }}" {{ App::getLocale() == 'de' ? 'selected' : '' }}>Deutsch</option>
                    </select>
                </div>
                <script>
                    document.getElementById('lang').addEventListener('change', function() {
                        var selectedOption = this.options[this.selectedIndex];
                        if (selectedOption.value !== "") {
                            window.location.href = selectedOption.value;
                        }
                    });
                </script>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        <li><a href="https://www.facebook.com/eventhes"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                </svg></a></li>
                        <li><a href="https://twitter.com/corals_laraship"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-expressionless" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m5 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                                </svg></a></li>
                        <li><a href="https://www.linkedin.com/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                    <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                                </svg></a></li>
                        <li><a href="https://www.instagram.com/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                                </svg></a></li>
                        <li><a href="https://www.pinterest.com/"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pinterest" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0"/>
                                </svg></a></li>
                    </ul>
                    <p>© 2024 <a target="_blank" href="http://corals.io/" title="Corals.io">eventhes.com</a>.
                        All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
</html>
<link rel="stylesheet" href="{{ asset('storage/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('storage/AdminLTE/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var busyDates = {!! json_encode($formattedBusyDates) !!};
        $('#datepicker').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            timePickerIncrement: 15,
            timePicker24Hour: true,
            isInvalidDate: function (date) {
                var currentDate = date.format('YYYY-MM-DD');
                return busyDates.includes(currentDate);
            },
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
        $('#datepicker').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY'));
        });
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
            var date = moment($('#datepicker').val(), 'DD/MM/YYYY').format('DD/MM/YYYY');
            var quantity = $('.qty2').val();
            var event_id = '{{ $event->id }}';
            var reg1 = $('#reg1').val();
            var reg2 = $('#reg2').val();
            var nameReg = $('#nameReg').val();
            var firstReg = $('#firstReg').val();
            var emailReg = $('#emailReg').val();
            var phoneReg = $('#phoneReg').val();
            var formData = {
                date: date,
                quantity: quantity,
                event_id: event_id,
                reg1: reg1,
                reg2: reg2,
                nameReg: nameReg,
                firstReg: firstReg,
                emailReg: emailReg,
                phoneReg: phoneReg,
                _token: csrfToken
            };
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function (response) {
                    alert(formData.date);
                    console.log('Данные успешно отправлены');
                    console.log(response);
                    $('#container_data_peaple_reg').show();
                    $('#orderForm1').hide();
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
        $('.booking-form').submit(function (event) {
            event.preventDefault();
            var date = moment($('#datepicker').val(), 'DD/MM/YYYY').format('DD/MM/YYYY');
            var formData = {
                date: date,
                quantity: $('.qty2').val(),
                event_id: '{{ $event->id }}',
                reg1: $('#reg1').val(),
                reg2: $('#reg2').val()
            };
            formData._token = csrfToken;
            $.ajax({
                type: 'POST',
                url: '{{ route('orders.store') }}',
                data: formData,
                success: function (response) {
                    alert(formData.date);
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
    $(document).ready(function () {
        $('[data-fancybox="gallery"]').fancybox({
        });
    });
    window.addEventListener('load', function () {
        var preloader = document.getElementById('preloader');
        preloader.style.display = 'none';
    });
    $(document).ready(function() {
        $('.rt2').click(function() {
            var currentValue = parseInt($('#adults').val());
            $('#adults').val(currentValue + 1);
            updateTotalCost();
        });
        $('.rt3').click(function() {
            var currentValue = parseInt($('#adults').val());
            if (currentValue > 0) {
                $('#adults').val(currentValue - 1);
                updateTotalCost();
            }
        });
        $('#adults').change(function() {
            updateTotalCost();
        });
        function updateTotalCost() {
            var quantity = parseInt($('#adults').val());
            var totalAmount = parseFloat($('#totalAmount').text().replace('$', ''));
            var totalCost = quantity * totalAmount;
            $('#totalCost').text("$" + totalCost.toFixed(2));
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
</script>







