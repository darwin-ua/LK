<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Cabinet')</title>

    <link rel="stylesheet" href="{{ asset("themes/$theme/css/style.css") }}">
    <link rel="icon" href="{{ asset("themes/$theme/images/favicon.png") }}">
</head>
<body data-default-page="{{ $defaultPage ?? '' }}">

@include('admin.header_adm')

{{-- ВОТ ЭТОГО МЕСТА У ТЕБЯ СЕЙЧАС НЕТ --}}
<main class="page-content">
    @yield('content')
</main>

@include('admin.footer_adm')

</body>
</html>








