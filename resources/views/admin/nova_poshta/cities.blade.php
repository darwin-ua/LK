<!DOCTYPE html>
<html>
<head>
    <title>Список городов</title>
</head>
<body>
<h1>Найденные города</h1>

@if(!empty($cities))
    <ul>
        @foreach($cities as $city)
            <li>{{ $city['Description'] }} ({{ $city['AreaDescription'] }})</li>
        @endforeach
    </ul>
@else
    <p>Города не найдены.</p>
@endif
</body>
</html>






