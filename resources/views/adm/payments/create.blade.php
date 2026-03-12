@include('admin.header_adm')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('translate.CreatePayment') }}
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
            <h2>{{ __('translate.AccountBalance') }}:   {{ Auth::check() ? Auth::user()->video_balance : 0 }}</h2>
        </div>
        {{-- ===== ТЕСТОВА ОПЛАТА MONOBANK ===== --}}
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Тестова оплата Monobank</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('pay.create') }}" method="POST" id="monoTestForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    {{-- Сума в грн (на бекенді конвертується в копійки) --}}
                                    <div class="form-group">
                                        <label for="mono_amount">Сума (грн)</label>
                                        <input type="number"
                                               class="form-control"
                                               id="mono_amount"
                                               name="amount"
                                               value="42.00"
                                               step="0.01"
                                               min="1"
                                               required>
                                    </div>

                                    {{-- Якщо захочеш опис платежу — розкоментуй і підтримай на бекенді --}}
                                    {{--
                                    <div class="form-group">
                                      <label for="mono_desc">Опис</label>
                                      <input type="text" class="form-control" id="mono_desc" name="description" placeholder="Оплата тестової консультації">
                                    </div>
                                    --}}
                                </div>

                                <div class="col-md-6">
                                    <div class="alert alert-info mb-3">
                                        <strong>Поповнення рахунку</strong><br>
                                        Це тестова оплата через Monobank (sandbox). Після надсилання вас перенаправить на платіжну сторінку.
                                    </div>

                                    <button type="submit" class="btn btn-success btn-block" id="monoPayBtn">
                                        Поповнити
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer text-muted">
                      Швидко та легко
                    </div>
                </div>
            </div>
        </section>
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.getElementById('monoTestForm');
                    const btn  = document.getElementById('monoPayBtn');

                    form.addEventListener('submit', function () {
                        btn.disabled = true;
                        btn.innerHTML = '{{ __('translate.Redirecting') ?? 'Перенаправлення…' }}';
                    });
                });
            </script>
        @endpush

    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{ __('translate.WithdrawMoney') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payments.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">{{ __('translate.SelectCountry') }}</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="country">
                                        <option></option>
                                        <option value="Україна">{{ __('translate.Ukraine') }}</option>
                                        <option value="Polska">{{ __('translate.Poland') }}</option>
                                        <option value="USA">{{ __('translate.USA') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('translate.NumberPayCard') }}</label>
                                    <input type="text" class="form-control" name="num_pay_card" placeholder="0000 0000 0000 0000" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">{{ __('translate.EnterAmount') }}</label>
                                    <input type="text" class="form-control" name="summ" placeholder="0.00" required>
                                </div>
                                <div class="form-group">
                                    <label for="datePicker">{{ __('translate.SelectDate') }}</label>
                                    <input type="date" class="form-control" name="record_datetime" required>
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
                    {{ __('translate.ReadWithdrawalRules') }} <a href="https://select2.github.io/">{{ __('translate.WithdrawalRules') }}</a>
                </div>
            </div>
        </div>
    </section>
</div>

@include('admin.footer_adm')

