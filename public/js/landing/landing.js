$((function(){$("#btn-submit").on("click",(function(){campaing=$("input[name=campaign]").val(),$.ajax({url:window.location.origin+"/landing/store",data:$("#form-lp").serialize(),type:"POST",dataType:"json",beforeSend:function(n,o){$("#form-lp .alert-danger").addClass("d-none"),$("#form-lp .overlay-lp").removeClass("d-none"),$("#btn-submit").attr("disabled",!0),$("#btn-submit .spinner-border").removeClass("d-none")},success:function(n){$("#modalSubmitForm").modal("show"),"odontopediatria"!=campaing&&"implantologia"!=campaing&&"botox2"!=campaing||gtag_report_conversion()},complete:function(n,o){setTimeout((function(){$("#btn-submit").attr("disabled",!1),$("#btn-submit .spinner-border").addClass("d-none"),$("#form-lp .overlay-lp").addClass("d-none")}),1e3)},error:function(n,o,e){422==n.status?($("#form-lp .alert-danger").removeClass("d-none"),response=n.responseJSON,html="<ul style='text-align:left;'>",$.each(response.errors,(function(n,o){html+="<li>"+o+"</li>"})),html+="</ul>",$("#form-lp .alert-danger").html(html)):confirm("Error en la petición, recargar la página para volver a cargar los módulos")&&location.reload()}})})),document.getElementById("modalSubmitForm").addEventListener("hidden.bs.modal",(function(n){location.reload()}))}));
