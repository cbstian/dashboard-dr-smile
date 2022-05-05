<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Dr Smile">
        <meta name="author" content="Sebastián Aguilera <sebastian@procodigo.cl>">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="https://drsmile.cl/wp-content/uploads/2021/12/cropped-favicon-32x32.png" sizes="32x32" />
        <link rel="icon" href="https://drsmile.cl/wp-content/uploads/2021/12/cropped-favicon-192x192.png" sizes="192x192" />
        <link rel="apple-touch-icon" href="https://drsmile.cl/wp-content/uploads/2021/12/cropped-favicon-180x180.png" />

        <title>Día de la madre - Dr Smile</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ mix('css/landing/core.css') }}">
        <link rel="stylesheet" href="{{ mix('css/landing/landing.css') }}">

        <style>
            .banner-home {
                background-image: url('{{ asset("images/diamadre2022/BG_PROMO_MAMA_1080_1920.jpg") }}');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                height: 85vh;
            }

            @media (max-width: 500px) {
                .banner-home {
                    background-image: url('{{ asset("images/diamadre2022/BG_PROMO_MAMA_SMARTPHONE.jpg") }}');
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                    height: 100vh;
                }
            }

            body {
                height: 50vh;
            }
        </style>

    </head>
    <body data-url="{{ url('/') }}" id="landingrosado">

        <div class="container-fluid bg-blue">
            <div class="py-1 py-md-3 row">
                <div class="col text-center">
                    <a href="https://drsmile.cl/" target="_blank">
                        <img src="{{ asset('images/limpiezaprofunda/logo-dr-smile.png') }}" class="img-fluid">
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid banner-home">
            <div class="row justify-content-end" style="height: 100%;">
                <div class="col-xxl-4 col-md-6 pt-5 text-center px-md-5 px-2" style="height: 100%;">
                    <img src="{{ asset('images/diamadre2022/TITULO_MAMADRSMILE_.svg') }}" class="img-fluid mt-5 mb-5" style="max-width: 450px;">
                    <img src="{{ asset('images/diamadre2022/ICON_GIFTCARDDRSMILE_.svg') }}" class="img-fluid mb-3" style="max-width: 300px;">
                    <div class="px-2" style="background-color: #EC9D9F; color: #fff; font-size: 30px; font-weight: 900; min-width:200px; border-radius: 30px;">En tratamientos sobre $200.000</div>
                    <p style="color:#EC9D9F; font-size: 28px; font-weight: 900; margin-top:10px; margin-bottom:0px;">DURANTE TODO EL MES DE MAYO</p>
                    <p style="color:#fff; font-size: 20px; font-weight: 700;">Valida entre el 04/05/2022 hasta 31/05/2022</p>
                    <div class="card p-3 p-md-5 text-start" style="border:0px; border-radius: 15px;">
                        <div style="background-color:#F4D7CF; color:#fff; font-size: 11px; width:100px; text-align:center; border-radius:15px; padding-top:3px; font-weight: 800;">PROMOSMILE</div>
                        <h1 style="color:#F4D7CF; font-weight: 900; font-size:30px; margin-bottom:5px;">QUIERO MI GIFTCARD</h1>
                        <p style="color:#D9A6E8; font-size:18px; font-weight:800; line-height: 20px; margin-bottom:5px;">
                            VÁLIDA PARA SERVICIOS REALIZADOS<br>
                            CON VALOR SOBRE $200.000</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-5">
                                <h1  class="mb-0" style="font-weight: 800; font-size: 35px; color:#D9A6E8;"><span style="color:#D9A6E8; font-size:25px;">$</span>50.000</h1>
                                <p style="color:#B2B2B2; font-weight: 800; font-size: 19px;">sobre: $200.000</p>
                            </div>
                            <div class="col-md-7">
                                <form method="POST" action="{{ route('descargarGiftcard') }}">
                                    @csrf
                                    <button class="btn" type="submit" style="background-color:#d9a6e8; border-radius:10px; color:#fff; font-weight: 800;">DESCARGAR MI GIFTCARD</button>
                                </form>
                            </div>
                        </div>
                        <div class="text-center py-2 mt-2" style="border-radius: 10px; border: 1px solid grey;">
                            <small>
                                Recuerda, tu primera evaluación es completamente grátis.<br>
                                Quiero mi primera evaluación
                            </small>
                        </div>
                    </div>
                </div>
                <div class="d-none d-xxl-block col-xxl-1"></div>
            </div>
        </div>



        @include('frontend.layout.footer')

        <script src="{{ mix('js/landing/core.js') }}"></script>
    </body>
</html>
