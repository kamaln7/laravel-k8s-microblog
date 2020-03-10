<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - {{ env('APP_NAME') }}</title>
        <link rel="stylesheet" href="{{ asset('css/tachyons.min.css') }}"/>
    </head>
    <body>
        <div class="mw7 center pa3 sans-serif">
            @include('partials/nav')
            @yield('content')
        </div>
    </body>
</html>