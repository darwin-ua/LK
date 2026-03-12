
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
                    <h1 class="m-0">{{ __('translate.Orders All') }}  -  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" style="margin-top: -60px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <a href="/admin/events/create" type="submit" value="Create new Project" class="btn btn-success float-right">+ {{ __('translate.CreateEvents') }}</a>
                </div>
            </div>
        </div>
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive" >
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>ID</th>
                                        <th><?php echo e(__('translate.Events')); ?> ID</th>
                                        <th><?php echo e(__('translate.Order date')); ?></th>
                                        <th><?php echo e(__('translate.Amount')); ?></th>
                                        <th><?php echo e(__('translate.Created')); ?></th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr style="cursor: pointer;" data-toggle="modal" data-order-id="<?php echo e($order->id); ?>" data-target="#exampleModal"
                                        onclick="fillOrderDetails('<?php echo e($order->id); ?>')">
                                        <td style="color: #0e0f10;"><?php echo e($order->code); ?></td>
                                        <td><?php echo e($order->id); ?></td>
                                        <td><?php echo e($order->order_id); ?></td>
                                        <td><?php echo e($order->order_date); ?></td>
                                        <td><?php echo e($order->amount); ?></td>
                                        <td><?php echo e($order->created_at); ?></td>
                                        <td data-status-id="{{ $order->id }}">
                                            {!! $order->status == 1
                                                ? '<button class="btn btn-warning btn-new-status">New !</button>'
                                                : '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                </svg>'
                                            !!}
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<script>
    function fillOrderDetails(orderId) {
alert(orderId);
        // Выполняем AJAX-запрос для получения данных о заказе
        $.ajax({
            url: '/admin/get-order-details/' + orderId,
            type: 'GET',
            success: function(response) {
                console.log(response);

                var html = '<table class="table">';
                html += '<tr><td>ID:</td><td>' + response.id + '</td></tr>';
                html += '<tr><td>Name:</td><td>' + response.name + '</td></tr>';

                if (response.data_create_order) {
                    var dataCreateOrder = response.data_create_order ? JSON.parse(response.data_create_order) : [];
                    dataCreateOrder.forEach(function(field) {
                        html += '<tr><td>' + field.name + ':</td><td>' + field.value + '</td></tr>';
                    });
                }

                html += '</table>';
                $('#orderDetails').html(html);
            },
            error: function(xhr, status, error) {
                console.error(error); // Выводим ошибку в консоль, если запрос завершился с ошибкой
            }
        });
    }

    function updateOrderStatus(orderId) {
        $.ajax({
            url: '/admin/update-order-status/' + orderId,
            type: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF-токен для защиты
            },
            success: function(response) {
                // Находим колонку статуса по data-status-id и обновляем её
                $('td[data-status-id="' + orderId + '"]').html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">' +
                    '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>' +
                    '<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>' +
                    '</svg>');
            },

            error: function(xhr, status, error) {
                console.error('Ошибка:', error);
            }
        });
    }



    $(document).ready(function() {
        $.ajax({
            url: '/admin/get-orders-with-status', // URL для получения заказов
            type: 'GET',
            success: function(response) {
                response.forEach(function(order) {
                    if (order.status === 1) {
                        // Выделяем заказы с статусом NEW
                        $('tr[data-order-id="' + order.id + '"]').css('background-color', '#17a2b8').css('color', '#000000');
                        $('tr[data-order-id="' + order.id + '"] .status-label').text('NEW');
                    } else {
                        // Убедимся, что для остальных статусов статус корректно указан
                        $('tr[data-order-id="' + order.id + '"] .status-label').text('NO');
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Ошибка получения заказов:', error);
            }
        });
    });


</script>
@include('admin.footer_adm')




