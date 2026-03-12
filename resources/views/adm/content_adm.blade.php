
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('translate.Order details')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="orderDetails"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #00a2e8; border-color: #008ec4; color: #fff;">
                    Close
                </button>
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
                    <h1 class="m-0"><?php echo e(__('translate.Statistic')); ?> -  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="col-12">
                           <a href="/admin/events/create" type="submit" value="Create new Events" class="btn btn-success float-right">+ <?php echo e(__('translate.CreateEvents')); ?></a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3></h3>
                            <p><?php echo e(__('translate.New orders (3 days)')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/admin/orders/all" class="small-box-footer"><?php echo e(__('translate.More info')); ?> <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><sup style="font-size: 20px"></sup></h3>
                            <p><?php echo e(__('translate.Total orders')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="/admin/orders/all" class="small-box-footer"><?php echo e(__('translate.More info')); ?> <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3></h3>
                            <p><?php echo e(__('translate.Oll Visitors')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer"><?php echo e(__('translate.More info')); ?> <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3></h3>
                            <p><?php echo e(__('translate.Total amount')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer"><?php echo e(__('translate.More info')); ?> <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive" style="height: auto;">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('translate.Event name')); ?></th>
                                    <th><?php echo e(__('translate.Number of orders')); ?></th>
                                    <th><?php echo e(__('translate.Details')); ?></th>
                                    <th><?php echo e(__('translate.Actions')); ?></th>
                                    <th><?php echo e(__('translate.Last order')); ?></th>
                                    <th><?php echo e(__('translate.Amount')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($eventsWithOrders as $event)
                                    <tr style="cursor: pointer;">
                                        <td style="color: #0e0f10;">{{ $event->title }}</td>
                                        <td>{{ $event->order_count }}</td>
                                        <td><a href="/admin/orders/all" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                </svg></a></td>
                                        <td><a href="/admin/events/all" class="btn btn-default"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                </svg></a></td>
                                        <td>{{ $event->last_order_date ? $event->last_order_date->format('Y-m-d H:i') : 'N/A' }}</td>
                                        <td>{{ $event->total_amount }}</td>
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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function fillOrderDetails(orderId) {

        // Выполняем AJAX-запрос для получения данных о заказе
        $.ajax({
            url: '/admin/get-order-details/' + orderId,
            type: 'GET',
            success: function(response) {

                console.log(response); // Выводим данные о заказе в консоль для отладки

                // Формируем HTML для таблицы с данными заказа
                var html = '<table class="table">';
                html += '<tr><td>ID:</td><td>' + response.id + '</td></tr>';
                html += '<tr><td>Name:</td><td>' + response.name + '</td></tr>';
                html += '<tr><td>First:</td><td>' + response.first + '</td></tr>';
                html += '<tr><td>Email:</td><td>' + response.email + '</td></tr>';
                html += '<tr><td>Amount:</td><td>' + response.amount + '</td></tr>';
                html += '<tr><td>Phone:</td><td>' + response.phone + '</td></tr>';
                html += '<tr><td>Order Date:</td><td>' + response.order_date + '</td></tr>';
                html += '<tr><td>Order ID:</td><td>' + response.order_id + '</td></tr>';

                // Парсим поле data_create_order (если оно есть)
                if (response.data_create_order) {
                    try {
                        var dataCreateOrder = JSON.parse(response.data_create_order); // Парсим JSON строку

                        // Проходим по каждому элементу и добавляем его как строку таблицы
                        dataCreateOrder.forEach(function(field) {
                            // Исключаем ненужные поля
                            if (!['nameReg', 'firstReg', 'emailReg', 'phoneReg'].includes(field.name)) {
                                html += '<tr><td>' + field.name + ':</td><td>' + field.value + '</td></tr>';
                            }
                        });
                    } catch (e) {
                        console.error('Ошибка парсинга JSON data_create_order: ', e);
                    }
                }

                html += '</table>';

                // Выводим HTML в модальное окно
                $('#orderDetails').html(html);
                updateOrderStatus(response.id);

            },
            error: function(xhr, status, error) {
                console.error(error); // Выводим ошибку в консоль, если запрос завершился с ошибкой
            }
        });
    }




    function updateOrderStatus(orderId) {
        $.ajax({
            url: '/admin/update-order-status/' + orderId,
            type: 'GET', // Предполагается, что это должен быть метод POST
            data: {
                status: 0
            }, // Отправляем новый статус заказа
            success: function(response) {
                console.log(response); // Выводим ответ сервера в консоль
                // Здесь вы можете добавить дополнительную обработку после успешного обновления статуса заказа
            },
            error: function(xhr, status, error) {
                console.error(error); // Выводим ошибку в консоль, если запрос завершился с ошибкой
            }
        });
    }

    $(document).ready(function() {
        $.ajax({
            url: '/admin/get-orders-with-status',
            type: 'GET',
            success: function(response) {
                response.forEach(function(order) {
                    $('tr[data-order-id="' + order.id + '"]').css('background-color', '#17a2b8').css('color', '#000000');
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

</script>


