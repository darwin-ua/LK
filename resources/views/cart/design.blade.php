@include('cart.filter')

<section class="promo_full">
    <div class="promo_full_wp magnific">
        &nbsp;
    </div>
</section>
<div class="container margin_60">
    <section class="promo_full">
        <div class="promo_full_wp magnific">
            &nbsp;
        </div>
    </section>
    <div class="main_title" style="padding-top: 65px; padding-bottom: 6px;">
        <h2>Оформлення № {{ $lastOrder->id ?? 'не знайдено' }}</h2>
    </div>

    <form action="{{ route('cart.checkout.form') }}" method="POST">
        @csrf
        <h3>Данні для доставки</h3>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="deliveryMethod" id="novaPoshtaRadio">
            <label class="form-check-label" for="novaPoshtaRadio">
                Нова пошта
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="deliveryMethod" id="addressDeliveryRadio" checked>
            <label class="form-check-label" for="addressDeliveryRadio">
                Передзвоніть мені для уточнення
            </label>
        </div>

        <!-- Блок для персональных данных -->
        <div id="personal-info">
            <div class="form-group">
                <h3>Ваше Ім'я</h3>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <h3>Телефон</h3>
                <input type="tel" class="form-control" name="phoneReg" id="phoneReg"
                       placeholder="+38(099)999-99-99" pattern="\+38\(\d{3}\)\d{3}-\d{2}-\d{2}">
            </div>
            <hr>
            <button type="submit" style="background-color: #ffc107; border-color: #ffc107;" class="btn btn-warning" ><span style="color: #ffffff;">Відправити</span></button>
        </div>

        <div id="nova-poshta-info" style="display: none;">

            <div class="form-group">
                <h3>Ваше Ім'я</h3>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <h3>Телефон</h3>
                <input type="tel" class="form-control" name="phoneReg" id="phoneReg"
                       placeholder="+38(099)999-99-99" pattern="\+38\(\d{3}\)\d{3}-\d{2}-\d{2}">
            </div>

            <div class="form-group">
                <h3>Місто</h3>
                <input type="text" id="city-input" placeholder="Введите название города или н.п." class="form-control">
            </div>
            <hr>
            <ul id="city-results"></ul>

            <div class="form-group">
                <h3>Відділення</h3>
                <input type="text" name="np_department" id="np-department" class="form-control">
            </div>

            <div id="department-container" style="display: none;">
                <h3>Оберіть відділення</h3>
                <hr>
                <ul id="department-results"></ul>
            </div>
            <hr>
            <button type="submit" style="background-color: #ffc107; border-color: #ffc107;" class="btn btn-warning" ><span style="color: #ffffff;">Далі</span></button>
        </div>

    </form>
</div>

@include('cart.filter_footer')
<script>
    $(document).ready(function() {
        // Поиск города
        $('#city-input').on('input', function() {
            var city = $(this).val();

            if (city.length > 2) {
                $.ajax({
                    url: "{{ route('nova-poshta.search-city') }}",
                    method: 'GET',
                    data: { city: city },
                    success: function(response) {
                        $('#city-results').empty();
                        $('#department-container').hide(); // Скрываем список отделений, если выбираем другой город

                        if (response.length > 0) {
                            $.each(response, function(index, city) {
                                $('#city-results').append('<li class="city-item" data-city="' + city.Description + '">' + city.Description + ' (' + city.AreaDescription + ')</li>');
                            });
                        } else {
                            $('#city-results').append('<li>Города не найдены</li>');
                        }
                    },
                    error: function(xhr) {
                        $('#city-results').empty();

                        if (xhr.status === 404) {
                            try {
                                var decodedMessage = JSON.parse(xhr.responseText);
                                $('#city-results').append('<li>' + decodedMessage.message + '</li>');
                            } catch (e) {
                                $('#city-results').append('<li>Ошибка: не удалось декодировать сообщение</li>');
                            }
                        } else {
                            $('#city-results').append('<li>Ошибка при поиске городов</li>');
                        }
                    }
                });
            } else {
                $('#city-results').empty();
            }
        });

        // Обработка клика по выбранному городу
        $(document).on('click', '.city-item', function() {
            var selectedCity = $(this).data('city');
            $('#city-input').val(selectedCity); // Устанавливаем выбранный город в поле ввода
            $('#city-results').empty(); // Очищаем результаты поиска

            // Загружаем отделения Новой Почты для выбранного города
            $.ajax({
                url: "{{ route('nova-poshta.search-departments') }}", // Добавляем маршрут для поиска отделений
                method: 'GET',
                data: { city: selectedCity },
                success: function(response) {
                    $('#department-results').empty();

                    if (response.length > 0) {
                        $.each(response, function(index, department) {
                            $('#department-results').append('<li class="department-item" data-department="' + department.Description + '">' + department.Description + '</li>');
                        });
                        $('#department-container').show(); // Показываем контейнер с отделениями
                    } else {
                        $('#department-results').append('<li>Отделения не найдены</li>');
                    }
                },
                error: function(xhr) {
                    $('#department-results').empty();
                    $('#department-results').append('<li>Ошибка при поиске отделений</li>');
                }
            });
        });

        // Обработка клика по выбранному отделению
        $(document).on('click', '.department-item', function() {
            var selectedDepartment = $(this).data('department');
            $('#np-department').val(selectedDepartment); // Устанавливаем выбранное отделение в поле ввода
            $('#department-results').empty(); // Очищаем результаты поиска отделений
            $('#department-container').hide(); // Скрываем контейнер с отделениями
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const novaPoshtaRadio = document.getElementById('novaPoshtaRadio');
        const addressDeliveryRadio = document.getElementById('addressDeliveryRadio');
        const personalInfoSection = document.getElementById('personal-info');
        const novaPoshtaInfoSection = document.getElementById('nova-poshta-info');

        novaPoshtaRadio.addEventListener('change', function () {
            if (novaPoshtaRadio.checked) {
                personalInfoSection.style.display = 'none';
                novaPoshtaInfoSection.style.display = 'block';
            }
        });

        addressDeliveryRadio.addEventListener('change', function () {
            if (addressDeliveryRadio.checked) {
                personalInfoSection.style.display = 'block';
                novaPoshtaInfoSection.style.display = 'none';
            }
        });
    });
</script>




