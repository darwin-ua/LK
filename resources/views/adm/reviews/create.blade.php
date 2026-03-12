@include('admin.header_adm')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Генерація відгуку через GPT</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home{{ __('translate.Inline Charts') }}</a></li>
                        <li class="breadcrumb-item active">Inline Charts{{ __('translate.Inline Charts') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Генерація декількох відгуків через GPT</h3>
            </div>
            <div id="loader" class="text-center mt-3" style="display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Завантаження...</span>
                </div>
                <p>Створення відгуків...</p>
            </div>

            <div class="card-body">
                <form id="multiReviewForm">
                    <div class="form-group">
                        <label for="prompt">Опис товару / події:</label>
                        <textarea class="form-control" id="prompt" name="prompt" rows="3" placeholder="Наприклад: дитячий майстер-клас з малювання"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="count">Кількість відгуків:</label>
                        <input type="number" class="form-control" id="count" name="count" min="1" max="60" value="5">
                    </div>
                    <div class="form-group">
                        <label for="product_id">ID події / продукту:</label>
                        <input type="number" class="form-control" id="product_id" name="product_id" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Згенерувати</button>
                </form>

                <div id="alertBox" class="alert alert-success mt-3" style="display: none;"></div>
            </div>
        </div>
        <script>
            document.getElementById('multiReviewForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const prompt = document.getElementById('prompt').value;
                const count = parseInt(document.getElementById('count').value, 10);
                const productId = document.getElementById('product_id').value;

                const alertBox = document.getElementById('alertBox');
                const loader = document.getElementById('loader');
                alertBox.style.display = 'none';
                loader.style.display = 'block';

                let created = 0;

                function sendNext(i) {
                    fetch('/admin/reviews/generate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            prompt: prompt,
                            product_id: productId
                        })
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'ok') {
                                created++;
                                if (created === count) {
                                    loader.style.display = 'none';
                                    alertBox.textContent = count + ' відгуків створено успішно!';
                                    alertBox.style.display = 'block';
                                } else {
                                    sendNext(i + 1);
                                }
                            } else {
                                console.error('GPT помилка: ', data.message);
                                loader.style.display = 'none';
                                alertBox.textContent = 'GPT помилка: ' + data.message;
                                alertBox.classList.replace('alert-success', 'alert-danger');
                                alertBox.style.display = 'block';
                            }
                        })
                        .catch(error => {
                            console.error('Помилка запиту:', error);
                            loader.style.display = 'none';
                            alertBox.textContent = 'Помилка з’єднання.';
                            alertBox.classList.replace('alert-success', 'alert-danger');
                            alertBox.style.display = 'block';
                        });
                }

                sendNext(0); // запускаем первый
            });
        </script>



    </section>
</div>
<script>
    function updateReservValue() {
        var startYear = document.getElementById('year').value;
        var startMonth = document.getElementById('month').value;
        var startDay = document.getElementById('day').value;
        var endYear = document.getElementById('endyear').value;
        var endMonth = document.getElementById('endmonth').value;
        var endDay = document.getElementById('endday').value;
        var startDate = startYear + '-' + startMonth + '-' + startDay;
        var endDate = endYear + '-' + endMonth + '-' + endDay;
        document.getElementById('reserv').value = 'Start date: ' + startDate + ' | End date: ' + endDate;
    }
    document.getElementById('saveChangesBtn').addEventListener('click', function() {
        updateReservValue();
        $('#myModal').modal('hide');
    });
    document.getElementById('reserv').addEventListener('click', function() {
        $('#myModal').modal('show');
    });
</script>
@include('admin.footer_adm')

