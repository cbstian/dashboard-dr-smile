<!doctype html>
<html lang="es">
    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-TZL2622R');</script>
        <!-- End Google Tag Manager -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Dr Smile">
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


        @yield('css_personalizado')

    </head>
    <body data-url="{{ url('/') }}" id="@yield('class-landing')">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TZL2622R"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

        @include('frontend.layout.menu')

        @yield('content')

        @include('frontend.layout.footer')

        @yield('pre_js')

        <script src="{{ mix('js/landing/core.js') }}"></script>

        @yield('js_personalizado')
    </body>
</html>
