<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

<body id="page-top" class="landing-page no-skin-config spinner_registro_code">

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
        <div style="background: #b15590; margin-bottom: 15px;">
            <img src="{!! asset('images/logo_la_rioja.png') !!}" alt="La Rioja - Argentina" style="width: 78%; height: auto;">
        </div>
        <h3>Alta de Usuario</h3>
        <p>Bienvenido al Sistema de Estacionamiento Medido de <strong>La Rioja</strong>.</p>
        <p>Se han registrado los datos en forma correcta.</p>
        <p>Para completar el registro, debe ingresar el c&oacute;digo que recibi&oacute; en su celular en la siguiente casilla.</p>
        <form id="form_verificar_code">

            {{ csrf_field() }}

            <input id="hash" value="{{ $hash }}" type='hidden'>
            <div class="form-group row">
                <label for="" class="col-sm-4 col-form-label">C&oacute;digo:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="code" data-mask="00000">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" id="btn_verificar_code">Enviar</button>
            </div>
        </form>
        <h4>Muchas Gracias!</h4>
    </div>

    @include('layouts.footer')

</body>

</html>