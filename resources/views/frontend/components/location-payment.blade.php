@if(request()->is('landing/implantologia'))
<div class="row landing-aside landing-aside--blue px-lg-5">
    <div class="card shadow">
        <div class="card-body text-start">
            <p class="small">Somos especialistas en ofrecer soluciones avanzadas para la rehabilitación dental , destacando nuestro servicio de implantes SmileArch. Con un sistema de implantes de última generación que utiliza la tecnología de Neodent® para proporcionar una solución optimizada a los pacientes con necesidades de rehabilitación dental . Gracias a su diseño avanzado, los implantes SmileArch permiten realizar tratamientos fijos inmediatos, brindando resultados rápidos y efectivos.</p>
        </div>
    </div>
</div>
@endif

@if(request()->is('landing/limpiezaprofunda'))
<div class="row landing-aside landing-aside--blue px-lg-5">
    <div class="card shadow">
        <div class="card-body text-start">
            <p class="small">Cuidamos cada detalle para ofrecerte un servicio de limpieza dental excepcional.</p>
            <p class="small">Nuestro paquete incluye:</p>
            <ul class="small">
                <li>Diagnóstico completo</li>
                <li>Radiografías (rx) para una evaluación precisa</li>
                <li>Limpieza dental</li>
            </ul>
            <p class="small">¡Agenda tu cita ahora y experimenta el cuidado dental personalizado que te mereces!</p>
        </div>
    </div>
</div>
@endif

@if(request()->is('landing/ortodoncia'))
<div class="row landing-aside landing-aside--blue px-lg-5">
    <div class="card shadow">
        <div class="card-body text-start">
            <p class="small">¿Por qué conformarse con menos cuando puedes elegir lo mejor para tu sonrisa?</p>
            <p class="small">Incluye <br>-Diagnóstico <br>-Estudio de ortodoncia digital <br>-Limpieza <br>-Blanqueamiento <br>-Y cuenta con 20% para los demás tratamientos</p>
            <p class="small">Agenda tu cita y descubre cómo podemos transformar tu sonrisa de manera efectiva y estilizada.</p>
        </div>
    </div>
</div>
@endif

<div class="row pe-4 mt-2 mt-sm-4">
    <div class="col-md-6 px-0 px-sm-3 text-center mb-4">
        <img src="{{ asset('images/icon_location_b.svg') }}" class="img-fluid">
    </div>
    <div class="col-md-6 px-0 px-sm-3 text-center mb-4">
        <img src="{{ asset('images/ICON_PAY_2.png') }}" class="img-fluid">
    </div>
    <div class="col-md-6 px-0 px-sm-3 text-center mb-4">
        <img src="{{ asset('images/icon_location_encon.png') }}" class="img-fluid">
    </div>
</div>
