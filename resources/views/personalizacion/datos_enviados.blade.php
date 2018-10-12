<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

<body id="page-top" class="landing-page no-skin-config spinner_registro_code" style="background-color: #f3f3f4;">

    <div class="sk-spinner sk-spinner-fading-circle">
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

    <div class="middle-box text-center fadeInDown">
        <div style="background: #F5D907; margin-bottom: 15px;">
            <img src="{!! asset('images/logo-sumo-app.png') !!}" alt="La Rioja - Argentina" style="width: 78%; height: auto; margin: 10px 0;">
        </div>
        <h3>Personalizaci&oacute;n SUMO</h3>
        <p>Bienvenido a <strong>Sumo!</strong></p>
        <p>Le enviaremos un correo y un sms para completar la Personalizaci&oacute;n. Por favor, revise su casilla de e-mail y su celular.</p>
        <p>Tel&eacute;fono: {{ app('request')->input('telefono') }}<br>E-mail: {{ app('request')->input('email') }}</p>
        <p>En caso de no haber recibido el correo electr&oacute;nico o el sms con el c&oacute;digo en los pr&oacute;ximos minutos, haga click aqu&iacute; <button id="btn_reenviar_code" class="btn btn-primary">Reenviar</button></p>
        <h4>Muchas Gracias!</h4>
    </div>

    @include('layouts.footer')

</body>

</html>