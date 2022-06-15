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

        <title>Día del Padre - Dr Smile</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ mix('css/landing/core.css') }}">
        <link rel="stylesheet" href="{{ mix('css/landing/landing.css') }}">

        <style>
            .banner-home {
                background-image: url('{{ asset("images/diapadre2022/IMG_LP.jpg") }}');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                height: 85vh;
            }

            .fs1 {
                font-size: 30px;
            }
            .fs2 {
                font-size: 28px;
            }

            @media (max-width: 650px) {
                .banner-home {
                    background-image: url('{{ asset("images/diapadre2022/IMG_LP.jpg") }}');
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                    height: 100vh;
                }

                .fs1 {
                    font-size: 20px;
                }
                .fs2 {
                    font-size: 18px;
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
                <div class="col-xxl-4 col-md-6 pt-2 pt-md-5 text-center px-md-5 px-2" style="height: 100%;">
                    <img src="{{ asset('images/diapadre2022/TEXTDDPdrsmile.svg') }}" class="img-fluid mt-2 mt-md-5 mb-5" style="max-width: 450px;">
                    <img src="{{ asset('images/diapadre2022/ICON_GIFTCARDdrsmile.svg') }}" class="img-fluid mb-3" style="max-width: 300px;">
                    <div class="px-2 fs1" style="background-color: #5F758D; color: #fff; font-weight: 900; min-width:200px; border-radius: 30px;">En tratamientos sobre $200.000</div>
                    <p class="fs2" style="color:#5F758D; font-weight: 900; margin-top:10px; margin-bottom:0px;">DESDE EL 19 HASTA EL 30 DE JUNIO</p>
                    <p style="color:#fff; font-size: 20px; font-weight: 700;">Valida entre el 19/06/2022 hasta 30/06/2022</p>

                    <form method="POST" action="{{ route('descargarGiftcardPadre') }}" class="d-block d-md-none mt-5">
                        @csrf
                        <button class="btn" type="submit" style="background-color:#5F758D; border-radius:20px; color:#fff; font-weight: 800; font-size: 20px;">DESCARGAR MI GIFTCARD</button>
                    </form>

                    <div class="card p-3 p-md-5 text-start d-none d-md-block" style="border:0px; border-radius: 15px;">
                        <div style="background-color:#A8C0DA; color:#fff; font-size: 11px; width:100px; text-align:center; border-radius:15px; padding-top:3px; font-weight: 800;">PROMOSMILE</div>
                        <h1 style="color:#A8C0DA; font-weight: 900; font-size:30px; margin-bottom:5px;">QUIERO MI GIFTCARD</h1>
                        <p style="color:#A8C0DA; font-size:18px; font-weight:800; line-height: 20px; margin-bottom:5px;">
                            VÁLIDA PARA SERVICIOS REALIZADOS<br>
                            CON VALOR SOBRE $200.000</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-5">
                                <h1  class="mb-0" style="font-weight: 800; font-size: 35px; color:#A8C0DA;"><span style="color:#A8C0DA; font-size:25px;">$</span>50.000</h1>
                                <p style="color:#B2B2B2; font-weight: 800; font-size: 19px;">sobre: $200.000</p>
                            </div>
                            <div class="col-md-7">
                                <form method="POST" action="{{ route('descargarGiftcardPadre') }}">
                                    @csrf
                                    <button class="btn" type="submit" style="background-color:#A8C0DA; border-radius:10px; color:#fff; font-weight: 800;">DESCARGAR MI GIFTCARD</button>
                                </form>
                            </div>
                        </div>
                        <div class="text-center py-2 mt-2" style="border-radius: 10px; border: 1px solid grey;">
                            <small>
                                Recuerda, tu primera evaluación es completamente grátis.<br>
                                <a href="https://drsmile.cl/promosmile/" target="_blank">Quiero mi primera evaluación</a>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="d-none d-xxl-block col-xxl-1"></div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center pt-5">
                <div class="col-md-6 mt-5">
                    <img src="{{ asset('images/diapadre2022/GIFTCARD_REGALOdrsmile.svg') }}" class="img-fluid">
                </div>
            </div>
            <div class="row justify-content-center pt-4">
                <div class="col-md-6 text-center">
                    <h1 style="color:#A8C0DA; font-size:30px; font-weight:800; line-height: 20px; margin-bottom:15px;">
                        PAPÁ, TU GIFT CARD
                    </h1>
                    <p style="color:#A8C0DA; font-size:20px; font-weight:700; line-height: 20px; margin-bottom:25px;">
                        VÁLIDA PARA SERVICIOS REALIZADOS<br>
                        CON VALOR SOBRE $200.000
                    </p>
                    <form method="POST" action="{{ route('descargarGiftcardPadre') }}">
                        @csrf
                        <button class="btn" type="submit" style="background-color:#A8C0DA; border-radius:10px; color:#fff; font-weight: 800;">DESCARGAR MI GIFTCARD</button>
                    </form>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 mt-5 text-center">
                    <h1 style="color:#A8C0DA; font-size:30px; font-weight:800; line-height: 27px; margin-bottom:15px;">
                        SUGERENCIA: AGENDAR HORA DENTRO DEL MES DE MAYO
                    </h1>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p style="color: #606060; font-size: 22px;"><b>¿Cómo Funciona?</b></p>
                    <p style="color:#A8C0DA; font-size:20px; font-weight:700; line-height: 20px; margin-bottom:25px;">
                        <img src="{{ asset('images/diapadre2022/ICON_COMOFUNCIONAdrsmile.svg') }}" style="width: 40px;"> Muéstrala desde tu celular.
                    </p>
                    <p style="color: #606060; font-size: 18px;">
                        Imprime esta Gift Card/Cupón o muéstrala
                        desde tu celular y preséntala en caja al momento
                        de realizar tu compra.
                    </p>
                    <p style="color: #606060; font-size: 18px;">
                        Esta Gift Card es al portador, sin embargo por
                        seguridad, al momento de realizar la compra,
                        le será solicitada su Cédula de Identidad en caja
                        y sus datos.
                    </p>
                </div>
                <div class="col-md-6">
                    <p style="color: #606060; font-size: 22px;"><b>¿Dónde Canjear?</b></p>
                    <p style="color:#A8C0DA; font-size:20px; font-weight:700; line-height: 20px; margin-bottom:25px;">
                        <img src="{{ asset('images/diapadre2022/ICON_DONDECANJEARdrsmile.svg') }}" style="width: 30px;"> Av. Ossa 235, La Reina.
                    </p>
                    <p style="color: #606060; font-size: 18px;">
                        Úsala en nuestra clínica odontológica y estética
                        facial, ubicado en Av. Ossa 235, La Reina. A
                        pasos del metro Plaza Egaña.
                    </p>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d927.4255610168193!2d-70.57110572056673!3d-33.45143914701169!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662ce4bac33e3c3%3A0xb2dce2ff006b4e46!2sAv.%20Ossa%20235%2C%20La%20Reina%2C%20Regi%C3%B3n%20Metropolitana!5e0!3m2!1ses-419!2scl!4v1651727178959!5m2!1ses-419!2scl" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <script src="{{ mix('js/landing/core.js') }}"></script>
    </body>
</html>
