<form id="form-manual-entry">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Datos del cliente</h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-2">
                        <label for="inputNombre" class="mb-1">Nombre</label>
                        <input type="text" name="name" class="form-control form-control-sm" value="">
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputApellido" class="mb-1">Apellido</label>
                        <input type="text" name="lastname" class="form-control form-control-sm" id="inputApellido" value="">
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputNCelular" class="mb-1">Nro. Celular</label>
                        <input type="text" name="phone" class="form-control form-control-sm" id="inputNCelular" value="">
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputNCelular" class="mb-1">RUT</label>
                        <input type="text" name="rut" class="form-control form-control-sm" id="inputNCelular" value="">
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputEmail" class="mb-1">Email</label>
                        <input type="email" class="form-control form-control-sm" id="inputEmail" name="email" value="">
                    </div>

                    <div class="form-group mb-2">
                        <label class="mb-1">Confirmar email</label>
                        <input type="email" class="form-control form-control-sm" name="email_confirmation" value="">
                    </div>

                    <div class="form-group mb-2">
                        <label class="form-label mb-1">Región</label>
                        <select class="form-control form-control-sm" name="region_id">
                            <option value="0">Seleccione una región...</option>
                            @foreach($regions as $r)
                                <option value="{{ $r->id }}">{{ $r->region }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label class="form-label mb-1">Comuna</label>
                        <select class="form-control form-control-sm" name="commune_id">
                            <option value="0">Seleccione una región...</option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputCampaign" class="form-label mb-1">Campaña</label>
                        <select class="form-control form-control-sm" name="campaign">
                            <option value="0">Seleccione...</option>
                            <option value="promoodonto">Promoodonto</option>
                            <option value="promoestetica">Promoestetica</option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputNombre" class="form-label mb-1">Estado</label>
                        <select class="form-control form-control-sm" name="status_service">
                            @foreach($status as $idStatus => $stat)
                            <option value="{{ $idStatus }}">{{ $stat['texto'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-2">
                        <label for="inputDetalles" class="mb-1">Detalles</label>
                        <input type="text" name="details" class="form-control form-control-sm" id="inputDetalles" value="">
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
