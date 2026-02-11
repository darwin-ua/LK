<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск города</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1>Поиск города</h1>

<input type="text" id="city-input" placeholder="Введите название города">
<ul id="city-results"></ul>

<script>
    $(document).ready(function() {
        $('#city-input').on('input', function() {
            var city = $(this).val();

            if (city.length > 2) {
                $.ajax({
                    url: "{{ route('nova-poshta.search-city') }}",
                    method: 'GET',
                    data: { city: city },
                    success: function(response) {
                        $('#city-results').empty();

                        if (response.length > 0) {
                            $.each(response, function(index, city) {
                                $('#city-results').append('<li>' + city.Description + ' (' + city.AreaDescription + ')</li>');
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
    });

</script>
</body>
</html>







