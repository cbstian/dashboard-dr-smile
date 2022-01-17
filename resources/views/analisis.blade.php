@extends('adminlte::page')

@section('title', 'Dr Smile - Análisis visitas')

@section('content_header')
    <h1 class="m-0 text-dark">Análisis visitas</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="embed-responsive embed-responsive-21by9" style="height: 100vh;">
                <iframe class="embed-responsive-item" style="height: 100vh;" src="https://analisis.procodigo.cl/share/tI7PG5Uc/DrSmile"></iframe>
            </div>

        </div>
    </div>
@stop

@section('js')

@endsection
