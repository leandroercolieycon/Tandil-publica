<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

<body id="page-top" class="landing-page no-skin-config">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md" role="navigation">
            <div class="container">
                <a href="http://www.tandil.gov.ar/" target="_blank" class="navbar-brand">
                <img src="images/tandil-logo.png" id='logo-tandil' alt="Tandil - Argentina" style="margin-right:0.8rem;">
                <img src="images/logo-sumo-app.png" id='logo-sumo' alt="Sumo - Tandil">
                </a>
                <div class="navbar-header page-scroll">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end " id="navbar">
                    <ul class="nav navbar-nav navbar-right" >
                        <li class="shadow-sm"><a class="nav-link page-scroll" href="#" data-toggle="modal" data-target="#modal-tarjeta">Solicitud
                                Tarjeta</a></li>
                        <li class="shadow-sm"><a class="nav-link page-scroll" href="#" data-toggle="modal" data-target="#modal-registro">Registrarse</a></li>
                        <li class="shadow-sm"><a class="nav-link page-scroll" href="#" data-toggle="modal" data-target="#modal-movimientos">Movimientos</a></li>
                        <li class="shadow-sm"><a class="nav-link page-scroll" href="#" data-toggle="modal" data-target="#modal-cargarsaldo">Cargar
                                saldo</a></li>
                        <li class="shadow-sm"><a class="nav-link page-scroll" href="#" data-toggle="modal" data-target="#modal-contacto">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- SECCION MAPA ACTUAL LA RIOJA -->
    <section class="center" id='mapa' style="height:100%">
    </section>
    <button id="btn-geo" class="btn btn-primary btn-circle btn-lg shadow-lg" type="button"><i class="fa fa-map-marker"></i></button>
    <div id="btn-parking" class="form-group shadow ibox-content sk-loading">
        <div class="sk-spinner sk-spinner-circle">
            <div class="sk-circle1 sk-circle"></div>
            <div class="sk-circle2 sk-circle"></div>
            <div class="sk-circle3 sk-circle"></div>
            <div class="sk-circle4 sk-circle"></div>
            <div class="sk-circle5 sk-circle"></div>
            <div class="sk-circle6 sk-circle"></div>
            <div class="sk-circle7 sk-circle"></div>
            <div class="sk-circle8 sk-circle"></div>
            <div class="sk-circle9 sk-circle"></div>
            <div class="sk-circle10 sk-circle"></div>
            <div class="sk-circle11 sk-circle"></div>
            <div class="sk-circle12 sk-circle"></div>
        </div>
        <div class="checkbox checkbox-default">
            <input id="checkbox-parquimetros" type="checkbox" checked>
            <label for="checkbox-parquimetros"> Parquímetros </label>
        </div>
        <div class="checkbox checkbox-default">
            <input id="checkbox-pv" type="checkbox">
            <label for="checkbox-pv"> Puestos de recarga </label>
        </div>
    </div>

    @include('layout_solicitud')

    @include('layout_registro')

    @include('layout_movimientos')

    @include('layout_cargarsaldo')

    @include('layout_contacto')


    @include('layouts.footer')
    
</body>

</html>