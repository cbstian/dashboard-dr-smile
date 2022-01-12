@extends('adminlte::page')

@section('title', 'Dr Smile')

@section('content_header')
    <h1 class="m-0 text-dark">Formularios</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ mix('css/daterangepicker.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-filter mr-1"></i>
                        <h3 class="card-title">Filtros</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </h3>
                </div>
                <div class="card-body pt-2 pb-1">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="mb-1">Fecha</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Ingrese un rago de fecha" name="filter_date" id="filter_date">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="mb-1">Comuna</label>
                                <select class="form-control form-control-sm" name="filter_commune" id="filter_commune">
                                    <option value="0">Todas</option>
                                    @foreach($communes as $com)
                                    <option value="{{ $com }}">{{ $com }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="mb-1">Campaña</label>
                                <select class="form-control form-control-sm" name="filter_campaign" id="filter_campaign">
                                    <option value="0">Todas</option>
                                    @foreach($campaign as $cam)
                                    <option value="{{ $cam }}">{{ $cam }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="mb-1">Estado</label>
                                <select class="form-control form-control-sm" name="filter_status" id="filter_status">
                                    <option value="null">Todos</option>
                                    @foreach($status as $id => $stat)
                                    <option value="{{ $id }}">{{ $stat['texto'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button id="filter_btn" class="btn btn-secondary btn-xs pl-3 pr-3">
                        <i class="fas fa-search"></i> Filtrar</button>
                    <button id="export_btn" class="btn btn-secondary btn-xs pl-3 pr-3 ml-0 ml-sm-3 mt-2 mt-sm-0">
                        <i class="fas fa-download"></i> Exportar datos
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-database mr-1"></i>
                        <h3 class="card-title">Registros</h3>
                        <div class="card-tools">
                            <button type="button" class="d-none mt-sm-0 mt-2 mt-md-0 btn btn-info btn-sm" title="Ingresar solicitud" id="btn-modal-add-order">
                                <i class="fas fa-plus-circle"></i> Ingresar solicitud
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                          </div>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm" style="width:100%" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Comuna</th>
                                    <th>Comentario</th>
                                    <th>Campaña</th>
                                    <th>Recibido</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-add-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content" style="background-color: #F4F6F9;">
                <div class="overlay d-none">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingreso manual solicitud</h5>
                    <button type="button" class="close close-modal-order">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="data"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary close-modal-order">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-manual-entry">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content" style="background-color: #F4F6F9;">
                <div class="overlay d-none overlay-modal">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Actualizar solicitud</h4>
                    <button type="button" class="close close-modal-edit-order">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8 data">
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Registro de actividad</h3>
                                </div>
                                <div class="card-body" id="card-data-log" style="max-height: 70vh; overflow-y: auto;">
                                    <div class="overlay d-none overlay-logs">
                                        <i class="fas fa-2x fa-sync fa-spin"></i>
                                    </div>
                                    <div class="data-logs"></div>
                                </div>
                                <div class="card-footer">
                                    <b>Añadir nota:</b>
                                    <form id="form-add-log-order">
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" name="id" value="">
                                            <input type="text" name="details" placeholder="Añadir nota privada" class="form-control form-control-sm">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-secondary btn-sm" style="height: 31px;">Guardar</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ mix('js/daterangepicker.js') }}"></script>
    <script src="{{ mix('js/form.js') }}"></script>
@endsection
