<form id="form-update-entry">

    <input type="hidden" name="id" value="{{ $form->id }}">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Datos del cliente</h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-2">
                        <label for="inputNombre" class="mb-1">Nombre</label>
                        <input type="text" name="name" class="form-control form-control-sm" value="{{ $form->name }}">
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputApellido" class="mb-1">Apellido</label>
                        <input type="text" name="lastname" class="form-control form-control-sm" id="inputApellido" value="{{ $form->lastname }}">
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputNCelular" class="mb-1">Nro. Celular</label>
                        <input type="text" name="phone" class="form-control form-control-sm" id="inputNCelular" value="{{ $form->phone }}">
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputNCelular" class="mb-1">RUT</label>
                        <input type="text" name="rut" class="form-control form-control-sm" id="inputNCelular" value="{{ $form->rut }}">
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputEmail" class="mb-1">Email</label>
                        <input type="email" class="form-control form-control-sm" id="inputEmail" name="email" value="{{ $form->email }}">
                    </div>

                    <div class="form-group mb-2">
                        <label class="mb-1">Confirmar email</label>
                        <input type="email" class="form-control form-control-sm" name="email_confirmation" value="{{ $form->email }}">
                    </div>

                    <div class="form-group mb-2">
                        <label class="form-label mb-1">Región</label>
                        <select class="form-control form-control-sm" name="region_id">
                            <option value="0">Seleccione una región...</option>
                            @foreach($regions as $r)
                                <option value="{{ $r->id }}" @if($r->id == $region_id) selected @endif>{{ $r->region }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label class="form-label mb-1">Comuna

                            @if(!is_null($form->commune_string))
                                (usuario escribió: {{ $form->commune_string }})
                            @endif

                        </label>
                        <select class="form-control form-control-sm" name="commune_id">
                            <option value="0">Seleccione una comuna</option>
                            @foreach($communes as $com)
                                <option value="{{ $com->id }}" @if($com->id == $form->commune_id) selected @endif>{{ $com->commune }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputCampaign" class="form-label mb-1">Campaña</label>
                        <select class="form-control form-control-sm" name="campaign">
                            <option value="0">Seleccione...</option>
                            <option value="promoodonto" @if($form->campaign == 'promoodonto') selected @endif>Promoodonto</option>
                            <option value="promoestetica" @if($form->campaign == 'promoestetica') selected @endif>Promoestetica</option>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="inputNombre" class="form-label mb-1">Estado</label>
                        <select class="form-control form-control-sm" name="status_service">
                            @foreach($status as $idStatus => $stat)
                            <option value="{{ $idStatus }}" @if($form->status_service == $idStatus) selected @endif>{{ $stat['texto'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group mb-2">
                        <label for="inputDetalles" class="mb-1">Detalles</label>
                        <input type="text" name="details" class="form-control form-control-sm" id="inputDetalles" value="{{ $form->details }}">
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
