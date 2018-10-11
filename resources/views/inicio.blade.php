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
                    <ul class="nav navbar-nav navbar-right">
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

    <!-- SECCION MAPA ACTUAL TANDIL -->
    <section class="center" id='mapa' style="height:100%">
    </section>
    <button id="btn-geo" class="btn btn-primary btn-circle btn-lg shadow-lg" type="button"><i class="fa fa-map-marker"></i></button>
   <!-- <div id="btn-parking" class="form-group shadow ibox-content sk-loading">
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
            <input id="checkbox-parquimetros-old" type="checkbox" checked>
            <label for="checkbox-parquimetros-old"> Parquímetros </label>
        </div>
        <div class="checkbox checkbox-default">
            <input id="checkbox-pv-old" type="checkbox">
            <label for="checkbox-pv-old"> Puestos de recarga </label>
        </div>
    </div> -->

    <div class="theme-config">
        <div class="theme-config-box show">
            <div class="spin-icon">
                <i class="fa fa-cogs fa-spin"></i>
            </div>
            <div class="skin-settings ibox-content sk-loading" id="configbox">
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
                <div class="title">Opciones</div>
                <div class="setings-item">
                    <i class="fa fa-car" style="padding-right:0.4rem;"></i>
                    <span>
                        Parquímetros
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="switch-parquimetros" class="onoffswitch-checkbox" id="switch-parquimetros" checked>
                            <label class="onoffswitch-label" for="switch-parquimetros">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                <i class="fa fa-dollar" style="padding-left:2px;padding-right:0.8rem;"></i>
                    <span>
                        Puestos de recarga
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="switch-pv" class="onoffswitch-checkbox" id="switch-pv">
                            <label class="onoffswitch-label" for="switch-pv">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                    <i class="fa fa-bus" style="padding-left:1px;padding-right:0.7rem;"></i>
                    <span>
                        Línea 500
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="linea500" class="onoffswitch-checkbox" id="linea500">
                            <label class="onoffswitch-label" for="linea500">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                    <i class="fa fa-bus" style="padding-left:1px;padding-right:0.7rem;"></i>
                    <span>
                        Línea 501
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="linea501" class="onoffswitch-checkbox" id="linea501">
                            <label class="onoffswitch-label" for="linea501">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                    <i class="fa fa-bus" style="padding-left:1px;padding-right:0.7rem;"></i>
                    <span>
                        Línea 502
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="linea502" class="onoffswitch-checkbox" id="linea502">
                            <label class="onoffswitch-label" for="linea502">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                    <i class="fa fa-bus" style="padding-left:1px;padding-right:0.7rem;"></i>
                    <span>
                        Línea 503
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="linea503" class="onoffswitch-checkbox" id="linea503">
                            <label class="onoffswitch-label" for="linea503">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                    <i class="fa fa-bus" style="padding-left:1px;padding-right:0.7rem;"></i>
                    <span>
                        Línea 504
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="linea504" class="onoffswitch-checkbox" id="linea504">
                            <label class="onoffswitch-label" for="linea504">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="setings-item">
                    <i class="fa fa-bus" style="padding-left:1px;padding-right:0.7rem;"></i>
                    <span>
                        Línea 505
                    </span>
                    <div class="switch">
                        <div class="onoffswitch">
                            <input type="checkbox" name="linea505" class="onoffswitch-checkbox" id="linea505">
                            <label class="onoffswitch-label" for="linea505">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout_solicitud')

    @include('layout_registro')

    @include('layout_movimientos')

    @include('layout_cargarsaldo')

    @include('layout_contacto')


    @include('layouts.footer')


    <script>
        
    </script>

</body>

</html>