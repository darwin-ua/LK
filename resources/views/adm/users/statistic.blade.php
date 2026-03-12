@include('admin.header_adm')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('translate.Message All') }} -  <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
                                        </svg></span></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content" style="margin-top: -55px;">
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
                            <div class="card-body table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Event ID</th>
                                        <th>{{ __('translate.Text') }}</th>
                                        <th>{{ __('translate.Created') }}</th>
                                        <th>{{ __('translate.Status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($alertCount as $data)
                                        <tr onclick="handleRowClick({{ $data->id }}, {{ (int)$data->type }})" style="cursor: pointer;">

                                        <td>{{ $data->id }}</td>
                                            <td>{{ $data->order_id }}</td>
                                            <td>{{ $data->text }}</td>
                                            <td>{{ $data->created_at }}</td>
                                            <td id="status-{{ $data->id }}">
                                                @if ($data->status == 1)
                                                    <button class="btn btn-warning btn-new-status">New !</button>
                                                @elseif ($data->status == 0)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                    </svg>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <script>
                                        function handleRowClick(id, type) {
                                            console.log('handleRowClick — id:', id, 'type:', type);

                                            updateStatus(id); // смена статуса

                                            if (type === 2) {
                                                window.open('/admin/reviews', '_blank');
                                            } else if (type === 1) {
                                                window.open('/admin/orders/all', '_blank');
                                            }
                                        }
                                    </script>

                                    <script>
                                        function updateStatus(id) {
                                            console.log('Клик по строке, id = ' + id); // ЛОГ 1

                                            fetch('{{ route('admin.alerts.updateStatus') }}', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                },
                                                body: JSON.stringify({ id: id })
                                            })
                                                .then(response => {
                                                    console.log('Ответ сервера получен:', response.status); // ЛОГ 2
                                                    return response.json();
                                                })
                                                .then(data => {
                                                    console.log('Данные от сервера:', data); // ЛОГ 3

                                                    if (data.success) {
                                                        document.getElementById('status-' + id).innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                </svg>
            `;
                                                    } else {
                                                        alert('Ошибка при обновлении статуса (ответ от сервера не success)');
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error('Ошибка запроса:', error); // ЛОГ 4
                                                    alert('Ошибка запроса');
                                                });
                                        }
                                    </script>


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


@include('admin.footer_adm')
