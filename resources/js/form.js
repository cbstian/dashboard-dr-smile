var moduloForm = function(){

    var valores = {

        token   : "meta[name='csrf-token']",
        urlAjax : $("body").data("url"),
        tableOrders : "#datatable",
        btnFilter : "#filter_btn",
        btnModalAddOrder : "#btn-modal-add-order",
        btnCloseModalOrder : ".close-modal-order",
        btnCloseModalEditOrder : ".close-modal-edit-order",
        btnManualEntry : "#btn-manual-entry",
        formLogsOrder : "#form-add-log-order",
        btnExportOrders : "#export_btn"

    };

    dom = {};

    var capturaDom = function(){

        dom.token = $(valores.token).attr('content');
        dom.url = valores.urlAjax;
        dom.tableOrders = $(valores.tableOrders);
        dom.btnFilter = $(valores.btnFilter);
        dom.btnModalAddOrder = $(valores.btnModalAddOrder);
        dom.btnCloseModalOrder = $(valores.btnCloseModalOrder);
        dom.btnCloseModalEditOrder = $(valores.btnCloseModalEditOrder);
        dom.btnManualEntry = $(valores.btnManualEntry);
        dom.formLogsOrder = $(valores.formLogsOrder);
        dom.btnExportOrders = $(valores.btnExportOrders);

    };

    var suscribirEventos = function(){

        $.ajaxSetup({
            headers : { 'X-CSRF-Token': dom.token }
        });

        eventos.loadDaterangepicker();
        eventos.loadSelect2();
        eventos.datatable();

        dom.btnModalAddOrder.click( eventos.modalAddOrder );
        dom.btnCloseModalOrder.click( eventos.closeModalOrder );
        dom.btnCloseModalEditOrder.click( eventos.closeModalEditOrder );
        dom.btnManualEntry.click( eventos.submitManualEntry );
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
                    { name: 'commune_string'},
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
                        //$('.edit-order').click(eventos.modelEditOrder);
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

        loadSelect2 : function() {

            $('select[name="filter_user"]').select2();

        },

        modalAddOrder : function() {

            $("#modal-add-order").modal("show");

            user_id = null;

            $.ajax({
                url     : dom.url + '/admin/orders/create',
                type    : 'POST',
                data: {
                    id : user_id
                },
                beforeSend : function(jqXHR, settings){

                    $("#modal-add-order #alert-danger").addClass("d-none");
                    $('#modal-add-order .overlay-modal').removeClass('d-none');

                },
                success : function(data){

                    $("#modal-add-order .modal-body .data").html(data);
                    $("select[name=region_id]").change(eventos.getCommunes);
                    $("#select_examns").select2();

                    var $select2 = $('#select_examns').select2({
                        placeholder: 'Seleccione los exámenes'
                    });

                    $select2.on("change", function (e) {
                        ids= $(this).val();
                        eventos.calculatePriceExams(ids);
                    });

                    eventos.uploadFile();

                },
                complete : function(jqXHR, textStatus){

                    setTimeout(
                        function()
                        {
                            $('#modal-add-order .overlay-modal').addClass('d-none');
                        }, 1000);

                },
                error   : function(jqXHR, textStatus, errorThrown){

                    if( confirm("Error en la petición, recargar la página para volver a cargar los módulos") )
                        location.reload();

                }
            });

        },

        modelEditOrder : function() {

            $("#modal-edit-order").modal("show");

            order_id = $(this).data('id');

            $.ajax({
                url     : dom.url + '/admin/orders/edit',
                type    : 'POST',
                data: {
                    id : order_id
                },
                beforeSend : function(jqXHR, settings){

                    $("#modal-edit-order #alert-danger").addClass("d-none");
                    $('#modal-edit-order .overlay-modal').removeClass('d-none');

                },
                success : function(data){

                    $("#modal-edit-order .modal-body .data").html(data);
                    $("select[name=region_id]").change(eventos.getCommunes);
                    $("#select_examns").select2();

                    var $select2 = $('#select_examns').select2({
                        placeholder: 'Seleccione los exámenes'
                    });

                    $select2.on("change", function (e) {
                        ids= $(this).val();
                        eventos.calculatePriceExams(ids);
                    });

                    $select2.trigger('change');

                    $('#modal-edit-order input[name="date"]').daterangepicker({
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
                        singleDatePicker: true,
                        minYear: parseInt(moment().format('YYYY'),10),
                        maxYear: parseInt(moment().format('YYYY'),10)
                    });

                    eventos.getDataLogs(order_id);

                    $(".btn-update-order").on('click', eventos.updateOrder );

                    eventos.uploadFile(order_id);
                    eventos.uploadResultExamFile(order_id);

                },
                complete : function(jqXHR, textStatus){

                    setTimeout(
                        function()
                        {
                            $('#modal-edit-order .overlay-modal').addClass('d-none');
                        }, 1000);

                },
                error   : function(jqXHR, textStatus, errorThrown){

                    if( confirm("Error en la petición, recargar la página para volver a cargar los módulos") )
                        location.reload();

                }
            });

        },

        closeModalOrder : function() {
            $("#modal-add-order .modal-body .data").html('');
            $("#modal-add-order").modal("hide");
        },

        closeModalEditOrder : function() {
            $("#modal-edit-order .modal-body .data").html('');
            $("#modal-edit-order").modal("hide");
        },

        submitManualEntry : function() {

            $.ajax({
                url     : window.location.origin+"/admin/orders/storeManual",
                data    : $("#form-manual-entry").serialize(),
                type    : 'POST',
                dataType: "json",
                beforeSend : function(jqXHR, settings){

                    $("#modal-add-order .alert-danger").addClass("d-none");
                    $('#modal-add-order .overlay-modal').removeClass('d-none');
                    $("#btn-manual-entry").attr('disabled',false);
                    $("#btn-manual-entry .spinner-border").removeClass("d-none");

                },
                success : function(data){

                    $("#modal-add-order").modal("hide");
                    dom.btnFilter.trigger('click');

                    location.reload();

                },
                complete : function(jqXHR, textStatus){

                    setTimeout(
                        function()
                        {
                            $("#btn-manual-entry").attr('disabled',false);
                            $("#btn-manual-entry .spinner-border").addClass("d-none");
                            $('#modal-add-order .overlay-modal').addClass('d-none');
                        }, 1000);

                },
                error   : function(jqXHR, textStatus, errorThrown){

                    if (jqXHR.status == 422){

                        $("#modal-add-order .alert-danger").removeClass("d-none");

                        response = jqXHR.responseJSON;

                        html = "<ul style='text-align:left;'>";
                        $.each(response.errors, function(key, value){
                            html += "<li>"+value+"</li>";
                        });
                        html += "</ul>";

                        $("#modal-add-order .alert-danger").html(html);

                    }else{

                        if( confirm("Error en la petición, recargar la página para volver a cargar los módulos") )
                            location.reload();

                    }

                }
            });

        },

        updateOrder : function (e) {

            e.preventDefault();

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
                        url     : window.location.origin+"/admin/orders/update",
                        data    : $("#"+form).serialize(),
                        type    : 'POST',
                        dataType: "json",
                        beforeSend : function(jqXHR, settings){

                            $("#modal-edit-order .alert-danger").addClass("d-none");
                            $('#modal-edit-order .overlay-modal').removeClass('d-none');
                            $("#btn-update-order").attr('disabled',false);
                            $("#btn-update-order .spinner-border").removeClass("d-none");

                        },
                        success : function(data){

                            if (data.id == false) {

                                dom.btnFilter.trigger('click');
                                eventos.getDataLogs(data.id);
                                Swal.fire('Error!', data.error, 'error');

                            } else {

                                dom.btnFilter.trigger('click');
                                eventos.getDataLogs(data.id);
                                Swal.fire('Correcto!', '', 'success');

                            }

                        },
                        complete : function(jqXHR, textStatus){

                            setTimeout(
                                function()
                                {
                                    $("#btn-update-order").attr('disabled',false);
                                    $("#btn-update-order .spinner-border").addClass("d-none");
                                    $('#modal-edit-order .overlay-modal').addClass('d-none');
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
