var moduloForm = function(){

    var valores = {

        token   : "meta[name='csrf-token']",
        urlAjax : $("body").data("url"),
        tableOrders : "#datatable",
        btnFilter : "#filter_btn",
        btnModalAddForm : "#btn-modal-add-form",
        btnCloseModalForm : ".close-modal-form",
        btnCloseModalEditForm : ".close-modal-edit-form",
        btnManualEntry : "#btn-manual-entry",
        btnUpdateForm : "#btn-update-form",
        formLogsOrder : "#form-add-log-order",
        btnExportOrders : "#export_btn"

    };

    dom = {};

    var capturaDom = function(){

        dom.token = $(valores.token).attr('content');
        dom.url = valores.urlAjax;
        dom.tableOrders = $(valores.tableOrders);
        dom.btnFilter = $(valores.btnFilter);
        dom.btnModalAddForm = $(valores.btnModalAddForm);
        dom.btnCloseModalForm = $(valores.btnCloseModalForm);
        dom.btnCloseModalEditForm = $(valores.btnCloseModalEditForm);
        dom.btnManualEntry = $(valores.btnManualEntry);
        dom.btnUpdateForm = $(valores.btnUpdateForm);
        dom.formLogsOrder = $(valores.formLogsOrder);
        dom.btnExportOrders = $(valores.btnExportOrders);

    };

    var suscribirEventos = function(){

        $.ajaxSetup({
            headers : { 'X-CSRF-Token': dom.token }
        });

        eventos.loadDaterangepicker();
        eventos.datatable();
        dom.btnModalAddForm.click( eventos.modalAddForm );
        dom.btnCloseModalForm.click( eventos.closeModalForm );
        dom.btnCloseModalEditForm.click( eventos.closeModalEditForm );
        dom.btnManualEntry.click( eventos.submitManualEntry );
        dom.btnUpdateForm.click( eventos.updateForm );
        dom.btnExportOrders.click( eventos.exportDataOrders );

    };

    var eventos = {

        datatable : function() {

            datatable = dom.tableOrders.DataTable({
                processing : true,
                language: {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        colvis: 'Columnas',
                        pageLength: 'Mostrar'
                    }
                },
                autoWidth: false,
                columns: [
                    { name: 'id' },
                    { name: 'name'},
                    { name: 'lastname'},
                    { name: 'phone' },
                    { name: 'rut' },
                    { name: 'email' },
                    { name: 'region' },
                    { name: 'commune_id'},
                    { name: 'details'},
                    { name: 'campaign'},
                    { name: 'created_at'},
                    { name: 'estado', orderable: false, searchable: false}
                ],
                order : [
                    [10, "desc" ]
                ],
                serverSide: true,
                responsive: true,
                stateSave: false,
                ajax: {
                    url  : dom.url + '/forms/datatable',
                    type : 'POST',
                    data : function(d)
                    {
                        d.filter_commune = $("#filter_commune").val();
                        d.filter_date = $("#filter_date").val();
                        d.filter_status = $("#filter_status").val();
                        d.filter_campaign = $("#filter_campaign").val();
                    },
                    complete: function(){
                        $('.edit-form').click(eventos.modelEditOrder);
                    }
                }
            });

            dom.btnFilter.click(function(){
                datatable.ajax.reload();
            });
        },

        loadDaterangepicker : function() {

            $('input[name="filter_date"]').daterangepicker({
                "locale": {
                    "format": "YYYY-MM-DD",
                    "separator": " hasta ",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "Hasta",
                    "customRangeLabel": "Personalizado",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre",
                    ],
                    "firstDay": 1
                },
                "startDate": moment().subtract(10, 'days').format("YYYY-MM-DD"),
                "endDate": moment().add(10, 'days').format("YYYY-MM-DD")
            });

        },

        modalAddForm : function() {

            $("#modal-add-form").modal("show");

            $.ajax({
                url     : dom.url + '/forms/create',
                type    : 'POST',
                beforeSend : function(jqXHR, settings){

                    $("#modal-add-form .alert-danger").addClass("d-none");
                    $('#modal-add-form .overlay-modal').removeClass('d-none');

                },
                success : function(data){

                    $("#modal-add-form .modal-body .data").html(data);
                    $("select[name=region_id]").change(eventos.getCommunes);

                },
                complete : function(jqXHR, textStatus){

                    setTimeout(
                        function()
                        {
                            $('#modal-add-form .overlay-modal').addClass('d-none');
                        }, 1000);

                },
                error   : function(jqXHR, textStatus, errorThrown){

                    if( confirm("Error en la petición, recargar la página para volver a cargar los módulos") )
                        location.reload();

                }
            });

        },

        getCommunes : function() {

            $.ajax({
                url : dom.url + "/location/communes",
                data : {
                    id : $("select[name=region_id]").val()
                },
                type : 'POST',
                beforeSend : function(jqXHR, settings){},
                success : function(data){

                    $("select[name=commune_id]").html(data);

                },
                complete : function(jqXHR, textStatus){},
                error : function(xhr, status){}
            });

        },

        modelEditOrder : function() {

            $("#modal-edit-form").modal("show");

            form_id = $(this).data('id');

            $.ajax({
                url     : dom.url + '/forms/edit',
                type    : 'POST',
                data: {
                    id : form_id
                },
                beforeSend : function(jqXHR, settings){

                    $("#modal-edit-form .alert-danger").addClass("d-none");
                    $('#modal-edit-form .overlay-modal').removeClass('d-none');

                },
                success : function(data){

                    $("#modal-edit-form .modal-body .data").html(data);
                    $("select[name=region_id]").change(eventos.getCommunes);

                    $("#btn-form-destroy").on('click',function(){

                        Swal.fire({
                            title: 'Eliminar',
                            text: "¿Deseas eliminar el formulario?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {

                            if (result.isConfirmed) {
                                $("#form-destroy").submit();
                            } else {
                                return false;
                            }

                        });

                    });

                },
                complete : function(jqXHR, textStatus){

                    setTimeout(
                        function()
                        {
                            $('#modal-edit-form .overlay-modal').addClass('d-none');
                        }, 1000);

                },
                error   : function(jqXHR, textStatus, errorThrown){

                    if( confirm("Error en la petición, recargar la página para volver a cargar los módulos") )
                        location.reload();

                }
            });

        },

        closeModalForm : function() {
            $("#modal-add-form .modal-body .data").html('');
            $("#modal-add-form").modal("hide");
        },

        closeModalEditForm : function() {
            $("#modal-edit-form .modal-body .data").html('');
            $("#modal-edit-form").modal("hide");
        },

        submitManualEntry : function() {

            $.ajax({
                url     : window.location.origin+"/forms/store",
                data    : $("#form-manual-entry").serialize(),
                type    : 'POST',
                dataType: "json",
                beforeSend : function(jqXHR, settings){

                    $("#modal-add-form .alert-danger").addClass("d-none");
                    $('#modal-add-form .overlay-modal').removeClass('d-none');
                    $("#btn-manual-entry").attr('disabled',false);
                    $("#btn-manual-entry .spinner-border").removeClass("d-none");

                },
                success : function(data){

                    $("#modal-add-form").modal("hide");
                    dom.btnFilter.trigger('click');

                    location.reload();

                },
                complete : function(jqXHR, textStatus){

                    setTimeout(
                        function()
                        {
                            $("#btn-manual-entry").attr('disabled',false);
                            $("#btn-manual-entry .spinner-border").addClass("d-none");
                            $('#modal-add-form .overlay-modal').addClass('d-none');
                        }, 1000);

                },
                error   : function(jqXHR, textStatus, errorThrown){

                    if (jqXHR.status == 422){

                        $("#modal-add-form .alert-danger").removeClass("d-none");

                        response = jqXHR.responseJSON;

                        html = "<ul style='text-align:left;'>";
                        $.each(response.errors, function(key, value){
                            html += "<li>"+value+"</li>";
                        });
                        html += "</ul>";

                        $("#modal-add-form .alert-danger").html(html);

                    }else{

                        if( confirm("Error en la petición, recargar la página para volver a cargar los módulos") )
                            location.reload();

                    }

                }
            });

        },

        updateForm : function (e) {

            e.preventDefault()();

            Swal.fire({
                title: 'Actualizar',
                text: "¿Deseas actualizar los datos?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {

                    form = $(this).data('form');

                    $.ajax({
                        url     : window.location.origin+"/forms/update",
                        data    : $("#form-update-entry").serialize(),
                        type    : 'POST',
                        dataType: "json",
                        beforeSend : function(jqXHR, settings){

                            $("#modal-edit-form .alert-danger").addClass("d-none");
                            $('#modal-edit-form .overlay-modal').removeClass('d-none');
                            $("#btn-update-form").attr('disabled',false);
                            $("#btn-update-form .spinner-border").removeClass("d-none");

                        },
                        success : function(data){

                            //$("#modal-edit-form").modal("hide");
                            dom.btnFilter.trigger('click');
                            Swal.fire('Correcto!', '', 'success');

                        },
                        complete : function(jqXHR, textStatus){

                            setTimeout(
                                function()
                                {
                                    $("#btn-update-form").attr('disabled',false);
                                    $("#btn-update-form .spinner-border").addClass("d-none");
                                    $('#modal-edit-form .overlay-modal').addClass('d-none');
                                }, 1000);

                        },
                        error   : function(jqXHR, textStatus, errorThrown){

                            if (jqXHR.status == 422){

                                response = jqXHR.responseJSON;

                                html = "<ul style='text-align:left;'>";
                                $.each(response.errors, function(key, value){
                                    html += "<li>"+value+"</li>";
                                });
                                html += "</ul>";

                                Swal.fire(html, '', 'error');

                            }else{

                                Swal.fire('Error al actualizar los datos', '', 'error');
                            }

                        }
                    });

                }
            });

        },

        exportDataOrders : function() {

            $.ajax({
                url     : window.location.origin+"/forms/export",
                data    : {
                    filter_commune : $("#filter_commune").val(),
                    filter_date : $("#filter_date").val(),
                    filter_status : $("#filter_status").val(),
                    filter_campaign : $("#filter_campaign").val(),
                },
                type    : 'POST',
                dataType: "json",
                beforeSend : function(jqXHR, settings){

                },
                success : function(data){

                    window.location.replace(data.url);
                },
                complete : function(jqXHR, textStatus){

                },
                error   : function(jqXHR, textStatus, errorThrown){

                    if( confirm("Error en la petición, recargar la página para volver a cargar los módulos") )
                        location.reload();

                }
            });

        },

    };

    var initialize = function() {

        capturaDom();
        suscribirEventos();

    };

    return {

        init : initialize

    }

}();

moduloForm.init();
