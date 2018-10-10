    <!-- MODAL REGISTRO -->
    <div class="modal inmodal" id="modal-registro" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button><br>
                    <div class="navy-line" style="margin-top:0.5rem"></div>
                    <h1>Registrarse</h1>
                    <p>Ingrese sus datos para registrarse en la app.</p>
                </div>

                <div class="modal-body modal_spinner modal_body_registro">

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

                            <form id="form_registrar">

                                {{ csrf_field() }}


                                <div class="form-group">
                                    <div class="alerta_validacion_registro alert alert-danger" style="display: none;"></div>
                                </div>

                                <h2>Sus Datos</h2>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre_registro" class="nombre_registro form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Apellido</label>
                                        <input type="text" name="apellido_registro" class="apellido_registro form-control">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>DNI</label>
                                        <input type="text" name="dni_registro" class="dni_registro form-control" data-mask="00000000">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Empresa de telefo&iacute;a</label>
                                        <select class="compania form-control" name="compania">
                                            <option value="1">Movistar</option>
                                            <option value="2">Claro</option>
                                            <option value="3">Personal</option>
                                            <option value="4">Nextel</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label>C&oacute;digo de area</label>
                                        <input type="text" name="cod_area_registro" class="cod_area_registro form-control" data-mask="0000">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>N&uacute;mero de M&oacute;vil</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">15</span>
                                            <input type="text" name="telefono_registro" class="telefono_registro form-control" data-mask="0000000">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Email</label>
                                        <input type="email" name="email_registro" class="email_registro form-control">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Contraseña</label>
                                        <input type="password" name="password" class="password form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Repetir constraseña</label>
                                        <input type="password" name="password_repeat" class="password_repeat form-control">
                                    </div>
                                </div>

                                <h2>Sus veh&iacute;culos</h2>

                                <div class="control_vehiculos">
                                    <div class="wrapper_vehiculos">

                                        <div class="form-row">

                                            <div class="form-group col-md-4">
                                                <label>Tipo</label>
                                                <select name="tipo_patente_1" class="tipo_patente_1 form-control">
                                                    <option value="0">Tradicional</option>
                                                    <option value="1">Mercosur</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-8">
                                                <label>Patente</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" name="patente_1" class="patente_1 form-control"
                                                        placeholder="Patente Vehiculo 1" style="text-transform: uppercase">
                                                    <div class="input-group-append">
                                                        <button class="agregar_vehiculos btn btn-primary"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </form>

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btn_registrar">Registrar</button>
                    </div>

            </div>
        </div>
    </div>