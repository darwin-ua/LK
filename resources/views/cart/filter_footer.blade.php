

<script>
    $('#cat_nav').mobileMenu();
</script>
<script>
    $('input.date-pick').datepicker('setDate', 'today');
    $('input.time-pick').timepicker({
        minuteStep: 15,
        showInpunts: false
    })
</script>
<script src="/storage/Home_files/jquery.ddslick.js"></script>
<script>
    $("select.ddslick").each(function () {
        $(this).ddslick({
            showSelectedHTML: true
        });
    });
</script>
<script>
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-grey',
        radioClass: 'iradio_square-grey'
    });

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
    });
</script>
<script>
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
</script>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-2 m-auto">
                <a href="">
                    <img style="max-width: 100%" src="../storage/css/site_logo.png">
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
                        <option value="{{ url('/lang/pl') }}" {{ App::getLocale() == 'pl' ? 'selected' : '' }}>Polski</option>
                        <option value="{{ url('/lang/ua') }}" {{ App::getLocale() == 'ua' ? 'selected' : '' }}>Українська</option>
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
                    <p>© 2024 <a target="_blank" href="http://corals.io/" title="Corals.io"></a>.
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
                @if($cartCount > 0)
                    <button type="button" onclick="window.location.href='/cart/order'" class="btn btn-secondary">Оформить</button>
                @endif
                <button type="button" class="close" data-dismiss="modal">Close</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<button onclick="scrollToTop();" id="scrollToTopBtn" title="Наверх">
    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-up-circle"
         viewBox="0 0 16 16">
        <path fill-rule="evenodd"
              d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
    </svg>
</button>
<div class="search-overlay-menu">
    <span class="search-overlay-close"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
  <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
</svg></span>
    <form role="search" id="searchform" method="get" action="tours">
        <input value="" name="term" type="search" placeholder="search ...">
        <button type="submit" class=" ladda-button" data-style="expand-right"><span class="ladda-label">
<i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg></i>
</span><span class="ladda-spinner"></span></button>
    </form>
</div>

</script>
<script>
    $('#cat_nav').mobileMenu();
</script>
<script>
    $('input.date-pick').datepicker('setDate', 'today');
    $('input.time-pick').timepicker({
        minuteStep: 15,
        showInpunts: false
    })
</script>
<script src="../storage/Home_files/jquery.ddslick.js"></script>
<script>
    $("select.ddslick").each(function () {
        $(this).ddslick({
            showSelectedHTML: true
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#referralCheckbox').change(function(){
            if($(this).is(':checked')){
                $.ajax({
                    url: '/processReferral',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        code_part: 1
                    },
                    success: function(response){
                        console.log('Ответ от сервера:', response);
                        location.reload();
                    },
                    error: function(xhr, status, error){
                        console.error('Ошибка при запросе:', error);
                    }
                });
            }
        });
    });
</script>
<script>
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-grey',
        radioClass: 'iradio_square-grey'
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


</script>
<script>
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
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('.bi-question-circle').on('click', function () {
            $('#sliding-panel').toggleClass('open');
        });

        // Закрытие панели при клике вне ее
        $(document).mouseup(function (e) {
            var panel = $("#sliding-panel");
            if (!panel.is(e.target) && panel.has(e.target).length === 0) {
                panel.removeClass('open');
            }
        });
    });
</script>
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
                <center><p style="color: #001f3f;">Це програма розповсюдження посилань на товар/подію!</p>
                    <h3>
                        <p>
                            @auth
                                <?php $user = auth()->user(); ?>
                                @if($user->code_part != NULL)
                                    <label style="color: #001f3f;">
                                        Реферальне посилання - <a style="color: #001f3f;" href="{{ route('events.show', ['id' => $event->id, 'code' => $user->code_part]) }}">https://eventhes.com/{{$event->id}}/{{$user->code_part}}</a>
                                    </label>
                        <p>
                            <a style="color: #575151;" href="https://telegram.me/share/url?url=https://eventhes.com/{{$event->id}}/{{$user->code_part}}" data-share="https://telegram.me/share/url?url=https://www.facebook.com/sharer/sharer.php?u=https://eventhes.com/{{$event->id}}/{{$user->code_part}}" data-type="telegram" target="_blank" role="button">Поделиться в
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/>
                                </svg>
                            </a>
                        </p>
                        <p>
                            <a style="color: #575151;" href="https://www.facebook.com/sharer/sharer.php?u=https://eventhes.com/{{$event->id}}/{{$user->code_part}}" data-share="https://www.facebook.com/sharer/sharer.php?u=https://eventhes.com/{{$event->id}}/{{$user->code_part}}" target="_blank" role="button"> Поделиться в
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                                </svg>
                            </a>
                        </p>
                        @else
                            <label style="color: #001f3f;">
                                <input style="color: #001f3f;" type="checkbox" id="referralCheckbox" name="referralCheckbox">
                                Я згоден(-на) стати участником програми
                            </label>
                        @endif
                        @endauth
                        @guest
                            <label style="color: #001f3f;">
                                Автаризуйтесь спочатку!
                            </label>
                        @endguest
                        <p style="color: #575151; font-size: 13px;">Поширюйте посилання на подію/товар та отримуйте BONUS </p>
                        </p>
                    </h3></center>
            </div>
            <div class="modal-footer">
                <button type="button" class="close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>


        $(document).ready(function() {
        function updateTotalPrice(amount) {
            var totalPriceElement = $('#total-price');
            var totalPrice = parseFloat(totalPriceElement.text().replace(',', '.'));

            if (isNaN(totalPrice)) {
                totalPrice = 0;
            }

            totalPrice += amount;
            totalPriceElement.text(totalPrice.toFixed(2));
        }

        function handleQuantityChange(row, increase = true) {
        var quantityElement = row.find('.quantity');
        var quantity = parseInt(quantityElement.text());

        if (isNaN(quantity)) {
        quantity = 0;
    }

        var price = parseFloat(row.data('price'));

        if (isNaN(price)) {
        console.error("Price is NaN for item ID " + row.data('item-id'));
        return;
    }

        if (increase) {
        quantity += 1;
        updateTotalPrice(price);
    } else if (quantity > 1) {
        quantity -= 1;
        updateTotalPrice(-price);
    }

        quantityElement.text(quantity);

        var total = quantity * price;
        row.find('#summa').text(total.toFixed(2));
    }

        $('.increase-quantity').on('click', function() {
        var row = $(this).closest('tr');
        handleQuantityChange(row, true);
    });

        $('.decrease-quantity').on('click', function() {
        var row = $(this).closest('tr');
        handleQuantityChange(row, false);
    });
    });

        $(document).ready(function() {
        // Функция для обновления суммы
        function updateSum(itemId) {
            let price = parseFloat($(`#price-${itemId}`).text());
            let quantity = parseInt($(`#quantity-${itemId}`).text());
            let total = price * quantity;
            $(`#summa-${itemId}`).text(total.toFixed(2));
        }

        // Обработчик для увеличения количества
        $('.increase-quantity').click(function() {
        let itemId = $(this).attr('id').split('-')[2];
        let quantityElement = $(`#quantity-${itemId}`);
        let quantity = parseInt(quantityElement.text());
        quantityElement.text(quantity + 1);
        updateSum(itemId);
    });

        // Обработчик для уменьшения количества
        $('.decrease-quantity').click(function() {
        let itemId = $(this).attr('id').split('-')[2];
        let quantityElement = $(`#quantity-${itemId}`);
        let quantity = parseInt(quantityElement.text());
        if (quantity > 1) {
        quantityElement.text(quantity - 1);
        updateSum(itemId);
    }
    });
    });



</script>
