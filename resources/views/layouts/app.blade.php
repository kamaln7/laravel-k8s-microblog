<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - {{ env('APP_NAME') }}</title>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}"/>
    </head>
    <body>
        <div class="mw7 center pa3 sans-serif">
            @include('partials/nav')
            @yield('header')

            @if (session('alert'))
                <div class="dark-green bg-washed-green pv3 ph4 mb4">
                    {{ session('alert') }}
                </div>
            @endif

            @yield('content')
        </div>
    </body>
</html>