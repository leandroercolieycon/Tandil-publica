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
        <p>Para completar la personalizaci&oacute;n de su SUMO, debe ingresar el c&oacute;digo que recibi&oacute; en su celular en la siguiente casilla</p>
        <form id="form_verificar_code">

            {{ csrf_field() }}

            <input id="hash" value="" type='hidden'>
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