
@include('admin.header_adm')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Детали заказа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Здесь будут детали заказа -->
                <p id="orderDetails"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color: #00a2e8; border-color: #008ec4; color: #fff;" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Транзакції  -  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" style="margin-top: -40px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                </div>
            </div>
        </div>
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Дата сплати</th>
                                        <th><?php echo e(__('translate.Amount')); ?></th>
                                        <th><?php echo e(__('translate.Created')); ?></th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payments as $payment)
                                        <tr style="cursor: pointer;" data-toggle="modal" data-order-id="{{ $payment->id }}" data-target="#exampleModal">
                                            <td style="color: #0e0f10;">{{ $payment->code }}</td>
                                            <td>{{ $payment->record_datetime }}</td>
                                            <td>{{ number_format($payment->summ, 2, '.', ' ') }}</td>
                                            <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                @switch($payment->status)
                                                    @case(1)
                                                        Отправлен в обработку
                                                        @break
                                                    @case(2)
                                                        На оплате
                                                        @break
                                                    @case(3)
                                                        Оплачен
                                                        @break
                                                    @case(4)
                                                        Отменён
                                                        @break
                                                    @default
                                                        Неизвестный статус
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@include('admin.footer_adm')





