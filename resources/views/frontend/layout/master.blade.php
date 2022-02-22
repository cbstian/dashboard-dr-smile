<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Mainque">
        <meta name="author" content="Sebastián Aguilera <sebastian@procodigo.cl>">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="https://drsmile.cl/wp-content/uploads/2021/12/cropped-favicon-32x32.png" sizes="32x32" />
        <link rel="icon" href="https://drsmile.cl/wp-content/uploads/2021/12/cropped-favicon-192x192.png" sizes="192x192" />
        <link rel="apple-touch-icon" href="https://drsmile.cl/wp-content/uploads/2021/12/cropped-favicon-180x180.png" />

        <title>@yield('title_1', config('app.name')) - @yield('title_2', '')</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ mix('css/landing/core.css') }}">

        <!-- Global site tag (gtag.js) - Google Ads: 366499281 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-366499281"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);} gtag('js', new Date());
            gtag('config', 'AW-366499281');
        </script>

        @yield('css_personalizado')

    </head>
    <body data-url="{{ url('/') }}" id="@yield('class-landing')">

        @include('frontend.layout.menu')

        @yield('content')

        @include('frontend.layout.footer')

        @yield('pre_js')

        <script src="{{ mix('js/landing/core.js') }}"></script>

        @yield('js_personalizado')
    </body>
</html>
