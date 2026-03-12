@include('admin.header_adm')
<style>
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
    }
    .file-input-wrapper input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    .file-input-label {
        padding: 10px 15px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }
    .file-input-label:hover {
        background-color: #e0e0e0;
    }

    .d-inline-block {
        cursor: pointer;
    }

    .range-value {
        font-size: 36px; /* Увеличиваем размер текста */
        font-weight: bold; /* Делаем текст жирным */
        font-family: 'Comic Sans MS', 'Arial', sans-serif; /* Используем более "прикольный" шрифт */
        color: #28a745; /* Зеленый цвет текста */
        margin-top: 10px;
        display: block;
        text-align: center;
    }
     .fixed-create-button {
         position: fixed;
         bottom: 20px;
         left: 50%;
         transform: translateX(-50%);
         z-index: 1000;
         width: 250px;
         text-align: center;
     }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Устанавливаем CSRF-токен для всех AJAX-запросов
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('translate.Events Create') }} -
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip 19">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span></h1>
                </div>
            </div>
        </div>
    </section>
    <div class="card-body">
        <form id="eventForm" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-default" >
                        <div class="card-header">
                            <div class="form-group">
                                <label for="foto_title"><a href="#" id="toggleLink">Крок 1</a></label>
                            </div>
                        </div>
                        <div class="card-header" >
                            <div class="form-group d-none">
                                <label for="type_pay">{{ __('translate.Type') }} -
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.NoteType') }}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                @if(isset($event->category))
                                    <select name="category" id="category" class="form-control" disabled>
                                         <option {{ $event->category == "2" ? 'selected' : '' }}>{{ __('translate.Event') }}</option>
                                           @else
                                            <select name="category" id="category" class="form-control" >

{{--                                                <option value="4">{{ __('translate.Goods') }}</option>--}}
                                               <option value="2">{{ __('translate.Events') }}</option>
                                                  @endif
                                            </select>
                                    </select>
                            </div>
                            <div id="content"></div>
                            <div class="form-group">
                                <label for="title">Ім'я - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.NameEvent') }}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Прізвище - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.NameEvent') }}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <input type="text" name="middlename" id="middlename" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Побатькові - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.NameEvent') }}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <input type="text" name="surname" id="surname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="specialization">Спеціалізація</label>
                                <select name="specialization" id="specialization" class="form-control" required>
                                    <option value="">-- Оберіть спеціалізацію --</option>
                                    <option value="терапевт">Врач-терапевт</option>
                                    <option value="хирург">Хирург</option>
                                    <option value="кардиолог">Кардиолог</option>
                                    <option value="педиатр">Педиатр</option>
                                    <option value="офтальмолог">Офтальмолог</option>
                                    <option value="стоматолог">Стоматолог</option>
                                    <option value="невролог">Невролог</option>
                                    <option value="психиатр">Психиатр</option>
                                    <option value="психолог">Психолог</option>
                                    <option value="медсестра">Медсестра</option>
                                    <option value="ветеринар">Ветеринар</option>
                                    <option value="юрист">Юрист</option>
                                    <option value="адвокат">Адвокат</option>
                                    <option value="нотаріус">Нотаріус</option>
                                    <option value="прокурор">Прокурор</option>
                                    <option value="следователь">Следователь</option>
                                    <option value="арбитр">Арбитр</option>
                                    <option value="медиатор">Медиатор</option>
                                    <option value="учитель">Учитель</option>
                                    <option value="репетитор">Репетитор</option>
                                    <option value="программист">Программист</option>
                                    <option value="веб-разработчик">Веб-разработчик</option>
                                    <option value="системный-администратор">Системный администратор</option>
                                    <option value="ux-ui-дизайнер">UX/UI дизайнер</option>
                                    <option value="data-scientist">Data Scientist</option>
                                    <option value="тестировщик">Тестировщик (QA)</option>
                                    <option value="аналитик">Бизнес-аналитик</option>
                                    <option value="devops">DevOps инженер</option>
                                    <option value="экономист">Экономист</option>
                                    <option value="бухгалтер">Бухгалтер</option>
                                    <option value="аудитор">Аудитор</option>
                                    <option value="финансист">Финансист</option>
                                    <option value="менеджер">Менеджер</option>
                                    <option value="маркетолог">Маркетолог</option>
                                    <option value="логист">Логист</option>
                                    <option value="hr">HR-специалист</option>
                                    <option value="рекрутер">Рекрутер</option>
                                    <option value="дизайнер">Дизайнер</option>
                                    <option value="частный-детектив">Детектив</option>

                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="card card-default" >
                        <div class="card-header">
                            <div class="form-group border rounded p-3" id="videoLinksContainer">
                                <div class="mb-3 d-flex align-items-center justify-content-between">
                                    <label for="foto_title"><a href="#" id="toggleLink">Видео чат</a></label>
                                    <div class="form-check mb-0">
                                        <input type="checkbox" class="form-check-input big-checkbox" id="agreeCheck" name="agree" required>
                                        <label class="form-check-label ms-2" for="agreeCheck">Створити чат</label>
                                    </div>
                                    <style>
                                        .big-checkbox {
                                            width: 1.0em;
                                            height: 1.0em;
                                        }
                                        .big-checkbox:checked {
                                            background-size: 80% 80%; /* чтобы галочка не была мелкой */
                                        }
                                    </style>
                                </div>
                                <div class="video-input d-flex align-items-center flex-wrap mb-2">
                                    <div class="mb-3 me-3">
                                        <label class="form-label">Ваш нiкнейм</label>
                                        <input type="text" name="nickname" class="form-control" placeholder="Введите ник" required>
                                    </div>

                                    <div class="mb-3 me-3">
                                        <label class="form-label">Чат платный?</label>
                                        <select name="is_paid" class="form-control" required>
                                            <option value="">Выберите...</option>
                                            <option value="0">Нет</option>
                                            <option value="1">Да</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 me-3">
                                        <label class="form-label">Персональный / Общий</label>
                                        <select name="room_type" class="form-control" required>
                                            <option value="">Выберите...</option>
                                            <option value="personal">Персональный</option>
                                            <option value="public">Общий</option>
                                        </select>
                                    </div>

                                    <div class="text-center mt-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                                             class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path
                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16">
                                            </path>
                                            <path
                                                d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card card-default" >
                        <div class="card-header">
                                <div class="form-group">
                                    <label for="foto_title"><a href="#" id="toggleLink">Крок 2</a></label>
                                </div>
                            <div class="form-group">
                                <label>{{ __('translate.US phone mask:') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.PhoneEvent') }}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="phone" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text">
                                </div>
                            </div>
                            <div class="form-group" id="registeredEvent">
                                <label for="shedule_date_from">{{ __('translate.Shedule') }} -
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.RaspisanieEvent') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
            </svg>
        </span>
                                </label>
                                <div>
                                    <span>Від</span>
                                    <input type="date" name="shedule_date_from" id="shedule_date_from" class="form-control" placeholder="От">
                                    <span>До</span>
                                    <input type="date" name="shedule_date_to" id="shedule_date_to" class="form-control" placeholder="До">
                                </div>
                                @if($sheduleRes == 0)
                                    <span style="color: red;">{{ __('translate.Create a schedule first') }}! (<a href="{{ route('admin.shedules.create') }}">Создать</a>)</span>
                                @endif
                                <div class="form-group" style="margin-top:12px;">
                                <label>Подія з: -
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.YesNoregisterEvent') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
            </svg>
        </span>
                                </label>
                                <select name="registeredEvent" class="form-control">
{{--                                    <option value="0">Просто подія</option>--}}
                                    <option value="1">З реєстріцією</option>
                                </select>
                                <!-- Поле ввода и кнопка -->
                                <div class="mt-3">
                                    <input type="text" name="nameButton" id="buttonTextInput" class="form-control" placeholder="Текст головної кнопки на сторінці події">
                                    <button id="dynamicButton" style="background-color: #00a2e8; border-color: #008ec4; color: #fff;" class="btn btn-primary mt-2">...</button>
                                </div>
                            </div>
                            </div>
                            <script>
                                document.getElementById('buttonTextInput').addEventListener('input', function() {
                                    document.getElementById('dynamicButton').textContent = this.value || '...';
                                });
                            </script>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const dateInputs = document.querySelectorAll('input[type="date"]');
                                    dateInputs.forEach(input => {
                                        input.addEventListener('focus', function() {
                                            input.showPicker();
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                                <div class="form-group">
                                    <label for="foto_title"><a href="#" id="toggleLink">Крок 3</a></label>
                                </div>

                            <div class="form-group" style="display: none;">
                                <label for="foto_folder_id">{{ __('translate.Payment') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip 5">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <input type="text" name="foto_folder_id" id="foto_folder_id" value="0" class="form-control"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="type_pay">{{ __('translate.Event paymant') }} -
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.PaymentsEvent') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
            </svg>
        </span>
                                </label>
                                <select name="type_pay" id="type_pay" class="form-control" required onchange="showHidePanel()">
                                    <option value="" selected disabled></option>
                                    <option value="1">{{ __('translate.Payment in date') }}</option>
                                    <option value="0">{{ __('translate.Payment not date') }}</option>
                                    <option value="3">Без оплати, без календаря</option>
                                </select>
                            </div>
                            <div class="form-group" >
                                <label for="discount">{{ __('translate.Discount') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.DiscountEvent') }}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <input type="text" name="discount"  class="form-control" placeholder="0" >
                            </div>
{{--                            <div class="form-group" id="piple_panel" >--}}
{{--                                <label for="amount_id">{{ __('translate.Piple') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip 8">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">--}}
{{--                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>--}}
{{--                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>--}}
{{--                                        </svg></span>--}}
{{--                                </label>--}}
{{--                                <input type="text" name="piple" id="piple_id" class="form-control" placeholder="0">--}}
{{--                            </div>--}}
                            <div class="form-group" id="amount_panel" style="display: none;">
                                <label for="amount_id">{{ __('translate.Price') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.PriceEvent') }}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <input type="text" name="amount" id="amount_id" class="form-control" placeholder="0">
                            </div>
{{--                            <div class="form-group" id="currency_panel" style="display: none;">--}}
{{--                                <label for="amount_id">{{ __('translate.Currency') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.CurrencyEvent') }}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">--}}
{{--                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>--}}
{{--                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>--}}
{{--                                        </svg></span>--}}
{{--                                </label>--}}
{{--                                <select name="currency"  class="form-control"  onchange="showHidePanel()">--}}
{{--                                    <option value="0">$</option>--}}
{{--                                    <option value="1">&#8381;</option>--}}
{{--                                    <option value="2">&euro;</option>--}}
{{--                                    <option value="3">&#8372;</option>--}}
{{--                                    <option value="4">Z&#322;</option>--}}
{{--                                    <option value="5">{{ __('translate.No') }}</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default" id="eventMenu">
                        <div class="card-header">
                            <div class="form-group">
                                <label for="foto_title"><a href="#" id="toggleLink">Крок 4</a> - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.LineEvent') }}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                            </div>
                        </div>
                        <style>
                            /* Убираем границы таблицы */
                            table, th, td {
                                border: none !important;
                            }
                        </style>
                        <div class="card-header"  id="toggleContent"  >
                            <label for="textInputField">Дополнительные поля :</label>
                            <div class="container mt-4">
                                <div id="notification"></div> <!-- Контейнер для вывода уведомления -->
                                <div id="dynamicFieldsContainer">
                                    <!-- Сюда будут добавляться новые поля -->
                                </div>
                                <input type="hidden" id="additional_fields" name="additional_fields" value="">
{{--                                <button id="parseFieldsButton" class="btn btn-primary mt-3" type="button">Распарсить данные</button>--}}
                                <div id="inputFields">
                                    <!-- Поле для Текст (строка) -->
                                    <div class="form-group" id="textInput" style="display: none;">
                                        <label for="textInputField">Введите текст (строка):</label>
                                        <input type="text" class="form-control" id="textInputField" placeholder="Введите текст">
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle" style="background-color: #00a2e8; border-color: #008ec4; color: #fff;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                    </svg> Выбрать один из списка
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-top">
                                                    <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
                                                        </svg>        Текст (строка)</button>
                                                    <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-justify-left" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
                                                        </svg>        Текст (абзац)</button>
                                                    <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list-ol" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5"/>
                                                            <path d="M1.713 11.865v-.474H2c.217 0 .363-.137.363-.317 0-.185-.158-.31-.361-.31-.223 0-.367.152-.373.31h-.59c.016-.467.373-.787.986-.787.588-.002.954.291.957.703a.595.595 0 0 1-.492.594v.033a.615.615 0 0 1 .569.631c.003.533-.502.8-1.051.8-.656 0-1-.37-1.008-.794h.582c.008.178.186.306.422.309.254 0 .424-.145.422-.35-.002-.195-.155-.348-.414-.348h-.3zm-.004-4.699h-.604v-.035c0-.408.295-.844.958-.844.583 0 .96.326.96.756 0 .389-.257.617-.476.848l-.537.572v.03h1.054V9H1.143v-.395l.957-.99c.138-.142.293-.304.293-.508 0-.18-.147-.32-.342-.32a.33.33 0 0 0-.342.338zM2.564 5h-.635V2.924h-.031l-.598.42v-.567l.629-.443h.635z"/>
                                                        </svg>        Один из списка</button>
                                                    <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0m0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                                        </svg>        Несколько из списка</button>
                                                    <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                                        </svg>        Раскрывающийся список</button>
                                                    <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                                        </svg>        Дата</button>
                                                    <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                                        </svg>        Время</button>
                                                    <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrows" viewBox="0 0 16 16">
                                                            <path d="M1.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L2.707 7.5h10.586l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L13.293 8.5H2.707l1.147 1.146a.5.5 0 0 1-.708.708z"/>
                                                        </svg>        Шкала</button>
                                                    <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bounding-box-circles" viewBox="0 0 16 16">
                                                            <path d="M2 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2M0 2a2 2 0 0 1 3.937-.5h8.126A2 2 0 1 1 14.5 3.937v8.126a2 2 0 1 1-2.437 2.437H3.937A2 2 0 1 1 1.5 12.063V3.937A2 2 0 0 1 0 2m2.5 1.937v8.126c.703.18 1.256.734 1.437 1.437h8.126a2 2 0 0 1 1.437-1.437V3.937A2 2 0 0 1 12.063 2.5H3.937A2 2 0 0 1 2.5 3.937M14 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2M2 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m12 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                                                        </svg>        Сетка(множественный выбор)</button>
                                                    <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bounding-box" viewBox="0 0 16 16">
                                                            <path d="M5 2V0H0v5h2v6H0v5h5v-2h6v2h5v-5h-2V5h2V0h-5v2zm6 1v2h2v6h-2v2H5v-2H3V5h2V3zm1-2h3v3h-3zm3 11v3h-3v-3zM4 15H1v-3h3zM1 4V1h3v3z"/>
                                                        </svg>        Сетка флажков</button>
                                                    <button class="dropdown-item" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
                                                            <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383"/>
                                                            <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708z"/>
                                                        </svg>        Загрузка файлов</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="card-header" style="margin-top:-40px;">
                                    <div class="form-group">
                                    </div>
                                </div>
                                <br>
                                </p>
                            </div>
                         </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">
                            <div class="form-group">
                                <label for="foto_title"><a href="#" id="toggleLink">Крок 5</a></label>
                            </div>
                            <div class="form-group">
                                <label for="allfoto">{{ __('translate.All photos') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.FotoEvent') }}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <div class="file-input-wrapper">
                                    <input type="file" name="allfoto[]" id="allfoto" class="form-control" multiple>
                                    <div class="file-input-label" id="fileInputLabelAll">Натисніть тут, щоб вибрати файл</div>
                                </div>
                                <div id="preview" style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;">
                                    <!-- Здесь будут появляться превью фотографий -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('translate.Description') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.DescriptionEvent') }}">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                </label>
                                <div class="col-md-12">
                                    <div class="card card-outline card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Summernote
                                            </h3>
                                        </div>
                                        <div class="card-body">
              <textarea id="summernote" name="description">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<style>
    .spin {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
                        @if($sheduleRes != 0)
                            <button type="submit" class="btn btn-primary fixed-create-button" id="submitBtn">
                                <svg id="submitIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                </svg> {{ __('translate.Create') }}
                            </button>

                        @else
                            <button type="submit" class="btn btn-primary fixed-create-button" id="submitBtn">
                                <svg id="submitIcon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                </svg> {{ __('translate.Create') }}
                            </button>
                        @endif

                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                </div>
            </div>
            <br>
        </form>
        <div id="form-messages"></div>
    </div>
</div>

<script>
    function openCartModalTu() {
        // Открываем модальное окно
        $('#YouTubeCreate').modal('show');
    }

        $(document).ready(function () {
        let submitted = false;

        $('#eventForm').on('submit', function (e) {
        e.preventDefault();

        if (submitted) return;
        submitted = true;

        $('#submitIcon').addClass('spin');

        let formData = new FormData(this);

        $.ajax({
        url: '{{ route("admin.events.store") }}',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
        $('#submitIcon').removeClass('spin');
        submitted = false;

        if (response.status === 'ok') {
        alert('Событие успешно сохранено!');
        window.location.href = '/admin/events/all'; // ✅ редирект после сохранения
    }
    },
        error: function () {
        $('#submitIcon').removeClass('spin');
        submitted = false;
        alert('Ошибка при отправке формы.');
    }
    });
    });
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<footer class="main-footer">


    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 Eventhes.</strong> All rights reserved.
</footer>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script src="{{ asset('storage/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/dist/js/all.js') }}"></script>
<script src="{{ asset('storage/css/sidebar.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('storage/AdminLTE/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
<script>
    document.getElementById('allfoto').addEventListener('change', function (event) {
        const files = Array.from(event.target.files); // Получаем выбранные файлы
        const previewContainer = document.getElementById('preview');
        const fileInputLabel = document.getElementById('fileInputLabelAll');
        previewContainer.innerHTML = ''; // Очищаем контейнер превью

        if (files.length === 0) {
            fileInputLabel.textContent = 'Натисніть тут, щоб вибрати файл'; // Если файлов нет, вернуть стандартный текст
            return;
        }

        // Обновляем текст в "fileInputLabel" с названиями файлов
        const fileNames = files.map(file => file.name).join(', ');
        fileInputLabel.textContent = fileNames;

        files.forEach((file, index) => {
            // Проверяем, является ли файл изображением
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();

            reader.onload = function (e) {
                // Создаем контейнер для изображения и кнопки удаления
                const imgWrapper = document.createElement('div');
                imgWrapper.style.position = 'relative';
                imgWrapper.style.display = 'inline-block';
                imgWrapper.style.margin = '5px';

                // Создаем элемент изображения для предварительного просмотра
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = file.name;
                img.style.width = '100px'; // Ширина превью
                img.style.height = '100px'; // Высота превью
                img.style.objectFit = 'cover'; // Кадрирование изображения
                img.style.border = '1px solid #ddd';
                img.style.borderRadius = '5px';

                // Кнопка "Удалить" для превью
                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'X';
                deleteButton.style.position = 'absolute';
                deleteButton.style.top = '5px';
                deleteButton.style.right = '5px';
                deleteButton.style.backgroundColor = '#ff4d4d';
                deleteButton.style.color = '#fff';
                deleteButton.style.border = 'none';
                deleteButton.style.padding = '5px';
                deleteButton.style.borderRadius = '50%';
                deleteButton.style.cursor = 'pointer';
                deleteButton.style.fontSize = '12px';
                deleteButton.style.width = '29px';

                // Обработчик для удаления превью и имени файла из текста
                deleteButton.addEventListener('click', function () {
                    imgWrapper.remove(); // Удаляем превью
                    const remainingFiles = Array.from(previewContainer.children).map(child => child.querySelector('img').alt);
                    fileInputLabel.textContent = remainingFiles.join(', ') || 'Натисніть тут, щоб вибрати файл';
                });

                // Добавляем элементы в контейнер
                imgWrapper.appendChild(img);
                imgWrapper.appendChild(deleteButton);
                previewContainer.appendChild(imgWrapper);
            };

            reader.readAsDataURL(file); // Читаем файл как DataURL
        });
    });

    // Функция обновления строки названий файлов
    function updateFileNames(container, fileNames) {
        container.textContent = fileNames.join(', ');
    }

    function showHidePanel() {
        var selectElement = document.getElementById("type_pay");
        var fotoPanel = document.getElementById("amount_panel");
        var fotoPanelTu = document.getElementById("currency_panel");

        if (selectElement.value === "2") {  // Если выбрано "Календарь без оплати"
            fotoPanel.style.display = "none";
            fotoPanelTu.style.display = "none";
        } else {
            fotoPanel.style.display = "block";
            fotoPanelTu.style.display = "block";
        }
    }

    // Вызываем функцию при загрузке страницы
    window.onload = showHidePanel;

    $(document).ready(function () {
        var max_fields = 10; // Максимальное количество полей
        var wrapper = $(".card-body-duble"); // Контейнер для дополнительных полей
        var add_button = $("#add_field_button"); // Кнопка добавления поля
        var additional_fields = []; // Массив для отслеживания созданных полей

        // Добавление нового поля
        $(add_button).click(function (e) {
            e.preventDefault();
            if (additional_fields.length < max_fields) {
                // Генерация уникального имени поля и его ключа
                var new_field_name = "field_" + additional_fields.length;
                var new_field_key = additional_fields.length + 1; // Ключ начинается с 1, 2, ...
                additional_fields.push({ key: new_field_key, name: new_field_name });

                // Добавление нового текстового поля
                $(wrapper).append(`
                <div class="additional-field-container">
&nbsp;
                    <label style="display:none;">${new_field_name}</label>
                    <input type="text" name="${new_field_name}" class="form-control additional_field" required>
                    <button class="btn btn-danger btn-sm remove_field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button>

                </div>
            `);
                updateAdditionalFieldsValue(); // Обновление скрытого поля
            }
        });

        // Удаление поля
        $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            var removed_field_name = $(this).siblings('input[type=text]').attr('name');
            $(this).parent('div').remove();

            // Удаление поля из массива
            additional_fields = additional_fields.filter(field => field.name !== removed_field_name);

            updateAdditionalFieldsValue(); // Обновление скрытого поля
        });

        // Обработка изменений в текстовых полях
        $(wrapper).on("input", ".additional_field", function () {
            updateAdditionalFieldsValue(); // Обновление скрытого поля
        });

        // Обработка изменений в радио-кнопках
        $(wrapper).on("change", "input[type=radio][name=r3]", function () {
            updateAdditionalFieldsValue(); // Обновление скрытого поля
        });

        // Функция для обновления скрытого поля
        function updateAdditionalFieldsValue() {
            var additional_fields_values = [];

            // Перебираем все текстовые поля и сохраняем их значения
            $(".additional_field").each(function () {
                var field_name = $(this).attr('name');
                var field_value = $(this).val();
                var field_key = additional_fields.find(field => field.name === field_name)?.key;

                if (field_key !== undefined) {
                    additional_fields_values.push({ key: field_key, value: field_value });
                }
            });

            // Если есть выбранное радио-значение, добавляем его
            var radio_value = $('input[type=radio][name=r3]:checked').val();
            if (radio_value) {
                additional_fields_values.push({ key: 'radio_button', value: radio_value });
            }

            // Обновляем скрытое поле
            $('#additional_fields').val(JSON.stringify(additional_fields_values));
            console.log('Updated additional fields:', additional_fields_values);
        }
    });

    $(document).ready(function () {
        let uniqueIdCounter = 1; // Initialize counter for unique IDs
        let variantCounter = 1; // Уникальный счетчик variant для всех блоков

        function updateHiddenField() {
            let currentFields = $('#additional_fields').val();
            let fields = currentFields ? JSON.parse(currentFields) : [];

            $('#dynamicFieldsContainer .form-group').each(function () {
                const uniqueId = $(this).data('unique-id');
                const variant = $(this).data('variant'); // Получаем уже установленный variant
                const label = $(this).find('label').text().trim();
                let value = '';

                // Получаем значения из полей
                if ($(this).find('select').length > 0) {
                    value = $(this).find('select option:selected').map(function () {
                        return $(this).text().trim();
                    }).get().join(', ');
                } else if ($(this).find('input[type="checkbox"]:checked').length > 0) {
                    value = $(this).find('input[type="checkbox"]:checked').map(function () {
                        return $(this).parent().text().trim();
                    }).get().join(', ');
                } else if ($(this).find('input[type="radio"]:checked').length > 0) {
                    value = $(this).find('input[type="radio"]:checked').map(function () {
                        return $(this).parent().text().trim();
                    }).get().join(', ');
                } else {
                    value = $(this).find('input, textarea').val() || ''; // Текстовые поля
                }

                if (label && value) {
                    // Проверяем, существует ли уже запись с данным key и variant
                    let existingField = fields.find(field => field.key === uniqueId && field.variant === variant);

                    if (existingField) {
                        existingField.value = value; // Обновляем значение
                    } else {
                        fields.push({ key: uniqueId, value: value, variant: variant }); // Добавляем новую запись
                    }
                }
            });


            $('#additional_fields').val(JSON.stringify(fields));
            console.log('Updated hidden field:', fields);
        }

        $(document).on('click', '.add-new-block', function () {
            const newBlockId = uniqueIdCounter++; // Уникальный ID блока
            const blockVariant = variantCounter++; // Уникальный variant для блока

            $('#dynamicFieldsContainer').append(`
            <div class="form-group" id="pole_${newBlockId}" data-unique-id="${newBlockId}" data-variant="${blockVariant}">
                <label>Введите название блока:</label>
                <input type="text" class="form-control dynamic-input" name="name_block_${newBlockId}" placeholder="Введите название блока">
                <!-- Добавьте остальные элементы блока -->
            </div>
        `);

            console.log(`Добавлен блок с ID=${newBlockId} и variant=${blockVariant}`);
        });

        $(document).on('click', '.dropdown-item', function () {
            // Получаем родительский элемент dropdown
            const dropdownParent = $(this).closest('.btn-group');

            // Ищем ближайший form-group с ID, начинающимся на "pole_"
            const formGroup = dropdownParent.closest('.form-group[id^="pole_"]');

            if (formGroup.length > 0) {
                // Устанавливаем значение variant в 1
                formGroup.attr('data-variant', 1); // Устанавливаем атрибут
                formGroup.data('variant', 1); // Обновляем значение в jQuery

                // Логируем данные
                console.log(
                    `Variant для блока с ID=${formGroup.attr('id')} и uniqueId=${formGroup.data('unique-id')} установлен на 1`
                );
            } else {
                console.error('Не удалось найти form-group с ID, начинающимся на "pole_".');
            }

            // Обновляем скрытое поле
            updateHiddenField();
        });

        // События добавления и изменения полей
        $(document).on('input change', '#dynamicFieldsContainer input, #dynamicFieldsContainer textarea, #dynamicFieldsContainer select', function () {
            updateHiddenField();
        });

        // Обработчик добавления новых полей
        $(document).on('click', '.dropdown-item', function () {
            var selectedOption = $(this).text().trim();
            var newField = '';


            if (selectedOption === 'Текст (строка)') {
                newField = `
    <div class="form-group" id="pole_4" data-unique-id="4">
 <input type="text" id="word" class="form-control dynamic-input" name="name_block_4" placeholder="Введите название блока">
        <label>Введите текст (строка):</label>
        <input type="text" class="form-control dynamic-input" placeholder="Введите текст">
  <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button>
<div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
    </div>`;
            } else if (selectedOption === 'Текст (абзац)') {
                newField = `
    <div class="form-group" id="pole_5" data-unique-id="5">
 <input type="text" id="word" class="form-control dynamic-input" name="name_block_5" placeholder="Введите название блока">
        <label>Введите текст (абзац):</label>
        <textarea class="form-control dynamic-textarea" rows="3" placeholder="Введите абзац текста"></textarea>
    </div>`;
            } else if (selectedOption === 'Один из списка') {
                newField = `
                <div class="form-group" id="pole_6" data-unique-id="6">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_6" placeholder="Введите название блока">
                    <label>Выбор одного из списка:</label>
                    <select class="form-control dynamic-select">
                    </select>
                    <div class="mt-2">
                        <input type="text" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант">
                        <button type="button" class="btn btn-primary add-option-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg></button> <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
                    </div>
                </div>`;
            } else if (selectedOption === 'Несколько из списка') {
                newField = `
                <div class="form-group" id="pole_7" data-unique-id="7">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_7" placeholder="Введите название блока">
                    <label>Выбор из нескольких вариантов:</label>
                    <select class="form-control dynamic-select" multiple>

                    </select>
                    <div class="mt-2">
                        <input type="text" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант">
                        <button type="button" class="btn btn-primary add-option-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg></button> <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
                    </div>


                </div>`;
            } else if (selectedOption === 'Раскрывающийся список') {
                newField = `
                <div class="form-group" id="pole_8" data-unique-id="8">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_8" placeholder="Введите название блока">
                    <label>Раскрывающийся список:</label>
                    <select class="form-control dynamic-select">

                    </select>
                    <div class="mt-2">
                        <input type="text" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант">
                        <button type="button" class="btn btn-primary add-option-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg></button> <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
                    </div>


                </div>`;
            } else if (selectedOption === 'Сетка(множественный выбор)') {
                newField = `
                <div class="form-group" id="pole_9" data-unique-id="9">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_9" placeholder="Введите название блока">
                    <label>Сетка с множественным выбором:</label>
                    <div class="dynamic-checkboxes">

                    </div>
                    <div class="mt-2">
                        <input type="text" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант">
                        <button type="button" class="btn btn-primary add-option-checkbox-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg></button> <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
                    </div>


                </div>`;
            } else if (selectedOption === 'Сетка флажков') {
                newField = `
                <div class="form-group" id="pole_10" data-unique-id="10">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_10" placeholder="Введите название блока">
                    <label>Сетка флажков:</label>
                    <div class="dynamic-radios">

                    </div>
                    <div class="mt-2">
                        <input type="text" class="form-control add-option-input mb-2" placeholder="Добавить новый вариант">
                        <button type="button" class="btn btn-primary add-option-radio-button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
</svg></button>
 <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
                    </div>


                </div>`;
            } else if (selectedOption === 'Дата') {
                newField = `
    <div class="form-group" id="pole_11" data-unique-id="11">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_11" placeholder="Введите название блока">
        <label>Выберите дату:</label>
        <input type="date" class="form-control dynamic-date">
  <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>

    </div>`;
            } else if (selectedOption === 'Время') {
                newField = `
    <div class="form-group" id="pole_12" data-unique-id="12">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_12" placeholder="Введите название блока">
        <label>Выберите время:</label>
        <input type="time" class="form-control dynamic-time">
  <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>

    </div>`;
            } else if (selectedOption === 'Шкала') {
                newField = `
    <div class="form-group" id="pole_13" data-unique-id="13">
<label>Введите название блока:</label>
        <input type="text" id="word" class="form-control dynamic-input" name="name_block_13" placeholder="Введите название блока">
        <label>Укажите значение шкалы:</label>
        <input type="range" class="form-control dynamic-range range-input" min="0" max="100" value="50">
        <span class="range-value">50</span>
  <button type="button" class="btn btn-danger btn-sm remove-field" style="margin-top: 5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
</svg></button><div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><span style="color:red"> * </span>Обязательный вопрос</label>
                                </div>
    </div>`;
            }

            if (newField) {
                $('#dynamicFieldsContainer').append(newField);

                // Блокируем все элементы в новом блоке, кроме поля с id="word"
                var newFormGroup = $('#dynamicFieldsContainer .form-group').last();
                newFormGroup.find(':input').not('#word').attr('disabled', true);

                updateHiddenField(); // Обновляем скрытое поле после добавления нового
            }


// Отслеживание изменений в полях с id="word" для всех блоков
            $(document).on('input', '#dynamicFieldsContainer .form-group #word', function () {
                var parentFormGroup = $(this).closest('.form-group'); // Находим родительский блок формы
                var isFieldEmpty = $(this).val().trim() === ''; // Проверяем, пустое ли поле

                if (isFieldEmpty) {
                    // Если поле пустое, блокируем остальные элементы блока
                    parentFormGroup.find(':input').not(this).attr('disabled', true);
                } else {
                    // Если поле заполнено, разблокируем остальные элементы
                    parentFormGroup.find(':input').not(this).attr('disabled', false);
                }
            });

        });

        $(document).on('click', '.add-option-button', function () {
            const formGroup = $(this).closest('.form-group');
            const uniqueId = formGroup.data('unique-id');

            // Присваиваем variant числовое значение, если еще не установлено
            if (!formGroup.data('variant')) {
                formGroup.data('variant', variantCounter);
                formGroup.attr('data-variant', variantCounter); // Устанавливаем атрибут
                variantCounter++; // Увеличиваем счетчик
            }

            const variant = formGroup.data('variant'); // Используем variant блока
            const input = $(this).siblings('.add-option-input');
            const newOption = input.val().trim();

            if (newOption) {
                const select = formGroup.find('.dynamic-select');
                if (!select.find(`option:contains(${newOption})`).length) {
                    select.append(`<option>${newOption}</option>`); // Добавляем новый вариант
                }

                let currentFields = $('#additional_fields').val();
                let fields = currentFields ? JSON.parse(currentFields) : [];

                let exists = fields.some(field => field.key === uniqueId && field.value === newOption && field.variant === variant);

                if (!exists) {
                    fields.push({ key: uniqueId, value: newOption, variant: variant });
                }

                $('#additional_fields').val(JSON.stringify(fields));
                console.log('Обновлено скрытое поле:', fields);

                input.val(''); // Очищаем текстовое поле
            }
        });



        $(document).on('click', '.add-option-checkbox-button', function () {
            const input = $(this).siblings('.add-option-input');
            const newOption = input.val().trim();
            const container = $(this).closest('.form-group').find('.dynamic-checkboxes');
            const formGroup = $(this).closest('.form-group');
            const uniqueId = formGroup.data('unique-id');

            // Присваиваем variant числовое значение, если еще не установлено
            if (!formGroup.data('variant')) {
                formGroup.data('variant', variantCounter);
                formGroup.attr('data-variant', variantCounter); // Устанавливаем атрибут
                variantCounter++; // Увеличиваем счетчик
            }

            const variant = formGroup.data('variant'); // Получаем variant

            if (newOption) {
                if (!container.find(`label:contains(${newOption})`).length) {
                    container.append(`<label><input type="checkbox"> ${newOption}</label>`); // Добавляем новый вариант
                }

                let currentFields = $('#additional_fields').val();
                let fields = currentFields ? JSON.parse(currentFields) : [];

                let exists = fields.some(field => field.key === uniqueId && field.value === newOption && field.variant === variant);

                if (!exists) {
                    fields.push({ key: uniqueId, value: newOption, variant: variant });
                }

                $('#additional_fields').val(JSON.stringify(fields));
                console.log('Обновлено скрытое поле:', fields);

                input.val(''); // Очищаем текстовое поле
            }
        });




        $(document).on('click', '.add-option-radio-button', function () {
            const input = $(this).siblings('.add-option-input');
            const newOption = input.val().trim();
            const container = $(this).closest('.form-group').find('.dynamic-radios');
            const formGroup = $(this).closest('.form-group');
            const uniqueId = formGroup.data('unique-id');

            // Присваиваем variant числовое значение, если еще не установлено
            if (!formGroup.data('variant')) {
                formGroup.data('variant', variantCounter);
                formGroup.attr('data-variant', variantCounter); // Устанавливаем атрибут
                variantCounter++; // Увеличиваем счетчик
            }

            const variant = formGroup.data('variant'); // Получаем variant

            if (newOption) {
                if (!container.find(`label:contains(${newOption})`).length) {
                    container.append(`<label><input type="radio" name="${uniqueId}"> ${newOption}</label>`); // Добавляем новый вариант
                }

                let currentFields = $('#additional_fields').val();
                let fields = currentFields ? JSON.parse(currentFields) : [];

                let exists = fields.some(field => field.key === uniqueId && field.value === newOption && field.variant === variant);

                if (!exists) {
                    fields.push({ key: uniqueId, value: newOption, variant: variant });
                }

                $('#additional_fields').val(JSON.stringify(fields));
                console.log('Обновлено скрытое поле:', fields);

                input.val(''); // Очищаем текстовое поле
            }
        });



        $(document).on('input', '.dynamic-input, .dynamic-textarea', function () {
            var parentFormGroup = $(this).closest('.form-group');
            var uniqueId = parentFormGroup.data('unique-id'); // Уникальный ID блока
            var variant = parentFormGroup.data('variant'); // Уникальный variant блока
            var value = $(this).val().trim(); // Значение поля

            let currentFields = $('#additional_fields').val();
            let fields = currentFields ? JSON.parse(currentFields) : [];

            // Проверяем существование записи
            let existingField = fields.find(field => field.key === uniqueId && field.variant === variant);

            if (existingField) {
                existingField.value = value; // Обновляем значение
            } else {
                fields.push({ key: uniqueId, value: value, variant: variant }); // Добавляем новое значение
            }

            $('#additional_fields').val(JSON.stringify(fields));
            console.log('Обновлено скрытое поле:', fields);
        });



        // Обновление значения шкалы
        $(document).on('input', '.range-input', function () {
            $(this).siblings('.range-value').text($(this).val());
            updateHiddenField();
        });
    });

    // Обработчик для поля "Дата"
    $(document).on('change', '.dynamic-date', function () {
        var label = $(this).closest('.form-group').find('label').text().trim(); // Ключ
        var value = $(this).val(); // Значение (без trim, для даты это не нужно)

        updateAdditionalFields(label, value);
    });

    // Обработчик для поля "Время"
    $(document).on('change', '.dynamic-time', function () {
        var label = $(this).closest('.form-group').find('label').text().trim(); // Ключ
        var value = $(this).val(); // Значение (без trim)

        updateAdditionalFields(label, value);
    });

    // Обработчик для поля "Шкала"
    $(document).on('input', '.dynamic-range', function () {
        var label = $(this).closest('.form-group').find('label').text().trim(); // Ключ
        var value = $(this).val(); // Значение

        // Обновляем текстовое представление значения шкалы
        $(this).siblings('.range-value').text(value);

        updateAdditionalFields(label, value);
    });

    function updateAdditionalFields(key, value) {
        // Получаем текущее значение скрытого поля
        let currentFields = $('#additional_fields').val();
        let fields = currentFields ? JSON.parse(currentFields) : [];

        // Проверяем, существует ли уже запись с таким ключом
        let existingField = fields.find(field => field.key === key);

        if (existingField) {
            // Если ключ уже существует, обновляем значение
            existingField.value = value;
        } else {
            // Если ключ не существует, добавляем новую запись
            fields.push({ key: key, value: value });
        }

        // Сохраняем обновлённый массив в скрытое поле
        $('#additional_fields').val(JSON.stringify(fields));
        console.log('Обновлено скрытое поле:', fields);
    }

    // Функция для парсинга данных
    function parseDynamicFieldsContainer() {
        let result = [];
        $('#dynamicFieldsContainer .form-group').each(function () {
            const key = $(this).find('label').text().trim(); // Ключ (текст из label)
            let value = '';

            // Проверяем типы полей и извлекаем их значения
            if ($(this).find('input[type="text"]').length > 0) {
                value = $(this).find('input[type="text"]').val(); // Значение из текстового поля
            } else if ($(this).find('textarea').length > 0) {
                value = $(this).find('textarea').val(); // Значение из текстовой области
            } else if ($(this).find('select').length > 0) {
                value = $(this).find('select').val(); // Выбранное значение из select
            } else if ($(this).find('.dynamic-checkboxes').length > 0) {
                value = [];
                $(this).find('.dynamic-checkboxes label').each(function () {
                    const checkboxText = $(this).text().trim();
                    const checkboxChecked = $(this).find('input[type="checkbox"]').is(':checked');
                    value.push({ key: checkboxText, value: checkboxChecked });
                });
            } else if ($(this).find('.dynamic-radios').length > 0) {
                value = $(this).find('.dynamic-radios input[type="radio"]:checked').parent().text().trim();
            } else if ($(this).find('input[type="date"]').length > 0) {
                value = $(this).find('input[type="date"]').val();
            } else if ($(this).find('input[type="time"]').length > 0) {
                value = $(this).find('input[type="time"]').val();
            } else if ($(this).find('input[type="range"]').length > 0) {
                value = $(this).find('input[type="range"]').val();
            }

            if (key && value !== '') {
                result.push({ key: key, value: value });
            }
        });

        // Выводим результат в консоль
        console.log('Распарсенные данные:', result);
        return result;
    }

    // Привязка обработчика к кнопке
    $('#parseFieldsButton').on('click', function (event) {
        event.preventDefault(); // Предотвращаем стандартное поведение кнопки
        parseDynamicFieldsContainer(); // Вызов функции
    });



</script>

</body>
</html>



