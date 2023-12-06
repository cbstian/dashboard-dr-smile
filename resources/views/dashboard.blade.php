@extends('adminlte::page')

@section('title', 'DrSmile - Inicio')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-address-card"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total formularios a la fecha</span>
                    <span class="info-box-number">
                        {{ $total }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-star"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Promo Odonto a la fecha</span>
                    <span class="info-box-number">
                        {{ $formPromoOdonto }}
                    </span>
                </div>
            </div>
        </div>
        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-star"></i></span>
                <div class="info-box-content">
                   <span class="info-box-text">Total Promo Estética a la fecha</span>
                    <span class="info-box-number">
                        {{ $formPromoEstetica }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-file-download"></i></span>
                <div class="info-box-content">
                   <span class="info-box-text">Total Giftcard Madre / Padre </span>
                    <span class="info-box-number">
                        {{ option('countGiftcardDiaMadre',0) }} /
                        {{ option('countGiftcardDiaPadre',0) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header p-2">
                    <div class="form-row">
                        <div class="col pt-1 pb-1">
                            <select class="form-control form-control-sm" name="fechaGrafico1">
                                @foreach($meses as $km => $m)
                                <option value="{{ $km }}">{{ $m }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col pt-1 pb-1">
                            <button class="btn btn-default btn-sm" id="btn-grafico-1"><i class="fas fa-chart-bar"></i> Generar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="grafico-1"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header p-2">
                    <div class="form-row">
                        <div class="col pt-1 pb-1">
                            <select class="form-control form-control-sm" name="fechaGrafico2">
                                @foreach($meses as $km => $m)
                                <option value="{{ $km }}">{{ $m }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col pt-1 pb-1">
                            <button class="btn btn-default btn-sm" id="btn-grafico-2"><i class="fas fa-chart-bar"></i> Generar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="grafico-2"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header p-2">
                    <div class="form-row">
                        <div class="col pt-1 pb-1">
                            <select class="form-control form-control-sm" name="cantmeses">
                                <option value="3">último 3 meses</option>
                                <option value="6" selected>último 6 meses</option>
                                <option value="9">último 9 meses</option>
                                <option value="12">último 12 meses</option>
                            </select>
                        </div>
                        <div class="col pt-1 pb-1">
                            <button class="btn btn-default btn-sm" id="btn-grafico-3"><i class="fas fa-chart-bar"></i> Generar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="grafico-3"></div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <div class="form-row">
                        <div class="col-xl-2 pt-1 pb-1">
                            <select class="form-control form-control-sm" name="fecha">
                                @foreach($meses as $km => $m)
                                <option value="{{ $km }}">{{ $m }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 pt-1 pb-1">
                            <button class="btn btn-default btn-sm" id="btn-grafico-4"><i class="fas fa-chart-bar"></i> Generar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="grafico-4"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

    <script src="https://code.highcharts.com/highcharts.js"></script>
    {{--<script src="https://code.highcharts.com/highcharts-3d.js"><script>--}}
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <script src="{{ mix('js/dashboard.js') }}"></script>

@endsection
