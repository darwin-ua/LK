@include('admin.header_adm')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('translate.Events All') }} -  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="col-12">
                        <a href="/admin/events/create" type="submit" value="Create new Events" class="btn btn-success float-right">+ {{ __('translate.CreateEvents') }}</a>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('translate.Title') }}</th>
                                    <th>{{ __('translate.Date') }}</th>
                                    <th>{{ __('translate.Status') }}</th>
                                    <th>QR</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td><a style="text-decoration: underline;" href="/admin/events/{{$event->id }}/edit">{{ $event->id }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->created_at}}</td>
                                        <td class="{{ $event->status == 1 ? 'active' : 'deactive' }}">{{ $event->status == 1 ? 'Active' : 'Deactive' }}</td>
                                        <td><a href="#" data-toggle="modal" data-target="#qrModal{{ $event->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                                    <path d="M2 2h2v2H2z"/>
                                                    <path d="M6 0v6H0V0zM5 1H1v4h4zM4 12H2v2h2z"/>
                                                    <path d="M6 10v6H0v-6zm-5 1v4h4v-4zm11-9h2v2h-2z"/>
                                                    <path d="M10 0v6h6V0zm5 1v4h-4V1zM8 1V0h1v2H8v2H7V1zm0 5V4h1v2zM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8zm0 0v1H2V8H1v1H0V7h3v1zm10 1h-1V7h1zm-1 0h-1v2h2v-1h-1zm-4 0h2v1h-1v1h-1zm2 3v-1h-1v1h-1v1H9v1h3v-2zm0 0h3v1h-2v1h-1zm-4-1v1h1v-2H7v1z"/>
                                                    <path d="M7 12h1v3h4v1H7zm9 2v2h-3v-1h2v-1z"/>
                                                </svg></a></td>
                                        <td><a href="/{{$event->id}}" target="_blank"  class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                </svg></a></td>
                                        <td>
                                            @if ($event->status == 1)
                                                <button class="btn btn-success btn-sm" disabled>Активировано</button>
                                            @else
                                                <button class="btn btn-secondary btn-sm activate-btn" data-id="{{ $event->id }}">Активировать</button>
                                            @endif

                                        </td>
                                        <td>
                                            <a href="/admin/events/{{$event->id}}/edit"><svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                </svg></a>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm deactivate-btn" data-id="{{ $event->id }}">Вимкнути</button>
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

            <script>
                $(document).ready(function() {
                $(document).on('click', '.deactivate-btn', function(e) {
                    e.preventDefault();
                    const button = $(this);
                    const eventId = button.data('id');

                    if (confirm("Вы уверены, что хотите деактивировать это событие?")) {
                        $.ajax({
                            url: `/admin/events/${eventId}/deactivate`,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Можно обновить статус в таблице
                                    button.closest('tr').fadeOut(); // Удаляет строку визуально
                                }
                            },
                            error: function() {
                                alert("Произошла ошибка при деактивации.");
                            }
                        });
                    }
                });
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $(document).on('click', '.activate-btn', function(e) {
                    e.preventDefault();

                    const button = $(this); // Конкретная кнопка
                    const eventId = button.data('id');

                    $.ajax({
                        url: `/admin/events/${eventId}/activate`,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if(response.success) {
                                // Обновляем статус ячейки
                                button.closest('tr').find('td:nth-child(4)')
                                    .removeClass('deactive').addClass('active')
                                    .text('Active');

                                // Меняем кнопку
                                button.removeClass('btn-success')
                                    .addClass('btn-secondary')
                                    .prop('disabled', true)
                                    .text('Активировано');
                            }
                        },
                        error: function(xhr) {
                            alert('Ошибка при активации');
                        }
                    });
                });
            });
        </script>
        @foreach ($events as $event)
            <div class="modal fade" id="qrModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="qrModal{{ $event->id }}Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="qrModal{{ $event->id }}Label">QR Code for Event {{ $event->id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ $event->qrCodeData }}" style="width: 100%;" alt="QR Code">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </section>

</div>
@include('admin.footer_adm')






