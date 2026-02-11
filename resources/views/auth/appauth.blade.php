<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }}</title>
    <link rel="stylesheet" href="{{ asset("themes/$theme/css/style_registration.css") }}">
    <link rel="icon" href="{{ asset("themes/$theme/images/favicon.png") }}">

</head>

<section>
    @yield('content')
</section>

<script src="{{ asset('js/script_registration.js') }}"></script>
</html>

