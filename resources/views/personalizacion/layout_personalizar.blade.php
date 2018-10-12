    <!-- MODAL PERSONALIZAR SUMO -->
    <div class="modal inmodal" id="modal-personalizar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button><br>
                    <div class="navy-line" style="margin-top:0.5rem"></div>
                    <h1>Personalizaci&oacute;n de su Tarjeta Sumo</h1>
                    <p>Ingrese sus datos</p>
                </div>

                <div class="modal-body modal_spinner modal_body_personalizar">

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

                    <div class="row justify-content-md-center">
                        <div class="col-lg-12 col-md-12 wow fadeInRight">

                            <form id="form_personalizar">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <div class="alerta_validacion_personalizar alert alert-danger" style="display: none;"></div>
                                </div>

                                <div class="form-group">
                                    <label>N&uacute;mero de Tarjeta</label>
                                    <input type="text" name="nro_tarjeta" class="nro_tarjeta form-control" data-mask="#" value="10188934">
                                </div>

                                <div class="form-group">
                                    <label>DNI</label>
                                    <input type="text" name="dni" class="dni form-control" data-mask="00000000" value="32450311">
                                </div>
                                
                                <div class="botones-consulta form-group" style="text-align: right">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="btn_personalizar">Consultar</button>
                                </div>

                            </form>

                            <form id="form_registrar" style="display: none">

                                {{ csrf_field() }}

                                <h2>Informaci&oacute;n B&aacute;sica</h2>

                                <div class="form-group">
                                    <div class="alerta_validacion_registrar alert alert-danger" style="display: none;"></div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="">Nombre</label>
                                        <input type="text" name="nombre" class="nombre form-control" value="Tomas">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="">Apellido</label>
                                        <input type="text" name="apellido" class="apellido form-control" value="Gimenez">
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="direccion">Direcci&oacute;n</label>
                                        <input type="text" name="direccion" class="direccion form-control" value="vieytes 3046">
                                    </div>

                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="fecha_nac">Fecha de Nacimiento</label>
                                        <input type="text" name="fecha_nac" class="fecha_nac form-control" id="fecha_registrar" value="06-08-1986">
                                    </div>
                                </div>

                                <h2>Informaci&oacute;n de Contacto</h2>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="cod_area">C&oacute;digo de &Aacute;rea</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">0</span>
                                            <input type="text" name="cod_area" class="cod_area form-control" data-mask="000" value="291">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <label for="telefono">Tel&eacute;fono Celular</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">15</span>
                                            <input type="text" name="telefono" class="telefono form-control" data-mask="0000000" value="4998341">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telefono_fijo">Tel&eacute;fono Fijo (opcional)</label>
                                    <input type="text" name="telefono_fijo" class="telefono_fijo form-control" data-mask="#">
                                </div>

                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="text" name="email" class="email form-control" value="tomasgimenez@eycon.com">
                                </div>

                                <div class="form-group" style="text-align: right">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="btn_registrar">Registrar</button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>

                    {{-- <div class="modal-footer"></div> --}}

            </div>
        </div>
    </div>