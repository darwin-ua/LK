<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Налаштування
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ __('translate.Tooltip') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                            </svg>
                        </span>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <div class="col-12">
                        <a href="/admin/events/create" type="submit" value="Create new Events" class="btn btn-success float-right">
                            + {{ __('translate.CreateEvents') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">

        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Cистемні налаштування</h3>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="emailCheckbox" value="option1">
                                        <label for="emailCheckbox" class="custom-control-label">Отримувати замовлення на Email</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input
                                            class="custom-control-input"
                                            type="checkbox"
                                            id="telegramCheckbox"
                                            value="option1"
                                            {{ Auth::user()->telegram_chat_id ? 'checked' : '' }}
                                        >
                                        <label for="telegramCheckbox" class="custom-control-label">
                                            Отримувати замовлення на Telegram
                                        </label>
                                    </div>
                                </div>


                            </div>
                        </div>
                </div>
                <!-- Bootstrap JS (если ещё не подключён) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

                <script>
                    $(document).ready(function () {
                        $('#telegramCheckbox').change(function () {
                            if ($(this).is(':checked')) {
                                $('#telegramModal').modal('show');
                            }
                        });
                    });
                </script>

                <div class="card-footer">
                    Будьте уважні при зміні налаштувань
                </div>
            </div>
        </div>




        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Платіжні налаштування</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.updateProfile') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">{{ __('translate.SelectCountry') }}</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="country">
                                        <option value="" {{ auth()->user()->country == null ? 'selected' : '' }}>—</option>
                                        <option value="UA" {{ auth()->user()->country == 'UA' ? 'selected' : '' }}>Україна</option>
                                        <option value="PL" {{ auth()->user()->country == 'PL' ? 'selected' : '' }}>Polska</option>
                                        <option value="US" {{ auth()->user()->country == 'US' ? 'selected' : '' }}>United States</option>
                                        <option value="DE" {{ auth()->user()->country == 'DE' ? 'selected' : '' }}>Deutschland</option>
                                        <option value="FR" {{ auth()->user()->country == 'FR' ? 'selected' : '' }}>France</option>
                                        <option value="IT" {{ auth()->user()->country == 'IT' ? 'selected' : '' }}>Italia</option>
                                        <option value="ES" {{ auth()->user()->country == 'ES' ? 'selected' : '' }}>España</option>
                                        <option value="PT" {{ auth()->user()->country == 'PT' ? 'selected' : '' }}>Portugal</option>
                                        <option value="NL" {{ auth()->user()->country == 'NL' ? 'selected' : '' }}>Nederland</option>
                                        <option value="GB" {{ auth()->user()->country == 'GB' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="CA" {{ auth()->user()->country == 'CA' ? 'selected' : '' }}>Canada</option>
                                        <option value="AU" {{ auth()->user()->country == 'AU' ? 'selected' : '' }}>Australia</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Резервна платіжна картка</label>
                                    <input type="text" class="form-control" name="num_pay_card" value="{{ auth()->user()->num_pay_card }}" placeholder="0000 0000 0000 0000" >
                                </div>
                                <div class="form-group">
                                    <label>{{ __('translate.US phone mask:') }} - <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Ваші ПІБ</label>
                                    <input type="text" class="form-control" name="name" placeholder="ПІБ" value="{{ auth()->user()->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="datePicker">Дата народження</label>
                                    <input type="date" class="form-control" name="record_datetime" value="{{ auth()->user()->record_datetime }}" >
                                </div>
                            </div>
                        </div>
                        <h6>{{ __('translate.CheckDataBeforeSubmit') }}</h6>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <button type="submit" class="btn btn-primary">{{ __('translate.Withdraw') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    Всі налаштування можно змінювати 1 раз на добу
                </div>
            </div>
        </div>
    </section>

    <!-- Модальное окно Telegram -->
    <div class="modal fade" id="telegramModal" tabindex="-1" role="dialog" aria-labelledby="telegramModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="padding: 20px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="telegramModalLabel">Підключення Telegram</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Закрити">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Щоб отримувати замовлення в Telegram:</p>


                    <p>Ваш ID для Telegram: <strong>{{ Auth::user()->id }}</strong></p>

                    <ol>
                        <li>Натисніть <a href="https://t.me/eventhes_bot" target="_blank">цей лінк</a> і напишіть нашому боту.</li>
                        <li>Напишіть йому повідомлення: <code>/link {{ Auth::user()->id }}</code></li>
                    </ol>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const storedChatId = localStorage.getItem('telegram_chat_id');
                            if (storedChatId) {
                                document.getElementById('chat_id').value = storedChatId;
                            }

                            const form = document.getElementById('telegram-confirm-form');
                            form.addEventListener('submit', function (e) {
                                e.preventDefault();

                                const formData = new FormData(form);

                                fetch("{{ route('admin.settings.telegram.confirm') }}", {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': formData.get('_token'),
                                    },
                                    body: formData,
                                })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.status === 'success') {
                                            // Скрыть модалку (если используешь Bootstrap modal)
                                            const modalEl = document.querySelector('.modal'); // укажи свой селектор
                                            if (modalEl) {
                                                const modal = bootstrap.Modal.getInstance(modalEl);
                                                if (modal) modal.hide();
                                            }

                                            // Обновить DOM
                                            document.getElementById('telegram-status').innerHTML = `
                        <div class="alert alert-success">✅ Telegram успішно підключено!</div>
                    `;
                                        } else {
                                            alert(data.message || 'Сталася помилка');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Помилка:', error);
                                        alert('Сталася помилка при з’єднанні з сервером');
                                    });
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- Подключаем jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Подключаем Inputmask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
<script>
    $(document).ready(function () {
        $("[data-mask]").inputmask();
    });
</script>

