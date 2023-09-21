@extends('frontend.layout.master')

@section('title_1','Dr Smile')
@section('title_2','Ortodoncia')

@section('css_personalizado')
    <link rel="stylesheet" href="{{ mix('css/landing/landing.css') }}">

    <script>
        function gtag_report_conversion() {
            console.log("gtag_report_conversion");
            gtag('event', 'conversion', {'send_to': 'AW-366499281/ZPppCLiBkKMDENGr4a4B'});
            return false;
        }
    </script>
@endsection

@section('class-landing','landingazul')

@section('content')

    <div class="container-fluid pb-5 contenedor-superior">
        <div class="row py-5">
            <div class="col text-center pb-5">
                <img src="{{ asset('images/limpiezaprofunda/PROMOSMILE.svg') }}" class="img-fluid" style="max-width:400px;">
            </div>
        </div>
    </div>
    <div class="container-fluid pb-5 contenedor-inferior">
        <div class="row py-5">
            <div class="col">
                <div class="container-sm contenedor-form px-0 px-sm-3">
                    <div class="row gx-1">
                        <div class="col-md-12 col-lg-6 text-center px-0 px-sm-2 order-1 order-md-1">
                            <img src="{{ asset('images/odontopediatria/odontopediatria.png') }}" class="img-fluid">
                            @include('frontend.components.location-payment')
                        </div>
                        <div class="col-md-12 col-lg-6 text-center col-form order-2 order-md-2">
                            <div class="card shadow">
                                <div class="card-body py-3 py-md-4 px-3 px-md-4">
                                    <div class="text-start">
                                        <img src="{{ asset('images/limpiezaprofunda/PROMOSMILE_1.svg') }}" class="img-fluid" style="max-width: 100px;">
                                        <h1 style="font-weight: 900;">PREVENCIÓN EN NIÑOS</h1>
                                        <p class="fw-bold">Odontopediatría</p>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 text-start">
                                            <p class="fw-bold">Agenda Online</p>
                                        </div>

                                        <div class="col-md-8 text-start">
                                            <form id="form-lp">
                                                @csrf

                                                <input type="hidden" value="{{ $campaign }}" name="campaign">

                                                <div class="mb-2">
                                                    <label for="rut1" class="form-label">RUT</label>
                                                    <input type="text" class="form-control border-0" id="rut1" name="rut">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="name1" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control border-0" id="name1" name="name">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="lastname1" class="form-label">Apellido</label>
                                                    <input type="text" class="form-control border-0" id="lastname1" name="lastname">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="phone1" class="form-label">Teléfono</label>
                                                    <input type="text" class="form-control border-0" id="phone1" name="phone">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="email1" class="form-label">Correo</label>
                                                    <input type="email" class="form-control border-0" id="email1" name="email">
                                                </div>

                                                <div class="alert alert-danger d-none"></div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <hr class="my-3">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 text-start">
                                            <p class="fw-bold">INCLUYE</p>
                                        </div>

                                        <div class="col-md-8 text-start">
                                            <form>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control border-0 servicios" readonly value="Diagnóstico">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control border-0 servicios" readonly value="4 Sellantes permanentes o temporales">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control border-0 servicios" readonly value="Aplicación fluor barniz silano">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control border-0 servicios" readonly value="Destartraje y limpieza">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <hr class="my-3">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 text-start">
                                            <h1  class="mb-0" style="font-weight: 800; font-size: 35px;"><span style="color:#D9A6E8; font-size:25px;">$</span>74.900</h1>
                                            <p style="color:#B2B2B2; font-weight: 800; font-size: 19px;">ANTES: $142.500</p>
                                        </div>

                                        <div class="col-md-8 text-start">
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn mt-3" id="btn-submit">
                                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                    QUIERO MI PROMO
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="border texto-pie-form p-3 mt-3">
                                                Recuerda, tu primera evaluación es completamente grátis.<br>
                                                <a href="https://drsmile.cl/promoodonto/"><u><b>Quiero mi primera evaluación</b></u></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSubmitForm" tabindex="-1" aria-labelledby="modalSubmitFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-5">
                    <h1>Tu solicitud de promoción ha sido ingresada con exito; nuestros especialistas se pondrán en contacto contigo</h1>
                    <button type="button" class="btn btn-primary mt-5" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js_personalizado')
    <script src="{{ mix('js/landing/landing.js') }}"></script>
@endsection
