$(function(){

    function submitManualEntry() {

        campaing = $("input[name=campaign]").val();

        $.ajax({
            url     : window.location.origin+"/landing/store",
            data    : $("#form-lp").serialize(),
            type    : 'POST',
            dataType: "json",
            beforeSend : function(jqXHR, settings){

                $("#form-lp .alert-danger").addClass("d-none");
                $('#form-lp .overlay-lp').removeClass('d-none');
                $("#btn-submit").attr('disabled',true);
                $("#btn-submit .spinner-border").removeClass("d-none");

            },
            success : function(data){

                $("#modalSubmitForm").modal("show");

                if (campaing == 'odontopediatria' || campaing == 'implantologia') {
                    gtag_report_conversion();
                }

            },
            complete : function(jqXHR, textStatus){

                setTimeout(
                    function()
                    {
                        $("#btn-submit").attr('disabled',false);
                        $("#btn-submit .spinner-border").addClass("d-none");
                        $('#form-lp .overlay-lp').addClass('d-none');
                    }, 1000);

            },
            error   : function(jqXHR, textStatus, errorThrown){

                if (jqXHR.status == 422){

                    $("#form-lp .alert-danger").removeClass("d-none");

                    response = jqXHR.responseJSON;

                    html = "<ul style='text-align:left;'>";
                    $.each(response.errors, function(key, value){
                        html += "<li>"+value+"</li>";
                    });
                    html += "</ul>";

                    $("#form-lp .alert-danger").html(html);

                }else{

                    if( confirm("Error en la petición, recargar la página para volver a cargar los módulos") )
                        location.reload();

                }

            }
        });

    };

    $("#btn-submit").on('click',submitManualEntry);

    var myModalEl = document.getElementById('modalSubmitForm')

    myModalEl.addEventListener('hidden.bs.modal', function (event) {
        location.reload();
    })
});
