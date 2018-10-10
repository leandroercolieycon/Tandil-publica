    <!-- MODAL SOLICITUD TARJETA -->
    <div class="modal inmodal" id="modal-tarjeta" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button><br>
                    <div class="navy-line" style="margin-top:0.5rem"></div>

                    <h1>Solicitud de tarjeta</h1>

                    <button type="button" id="btn_solicitar_personal" class="btn btn-primary">Personal</button>
                    <button type="button" id="btn_solicitar_empresa" class="btn btn-outline btn-primary">Empresa</button>
                </div>

                <div class="modal-body modal_spinner modal_body_solicitud">

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

                            <form id="form_tarjeta" {{-- method="POST" action="solicitar" --}}>

                                {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <input type="text" name="tipo_solicitud" class="tipo_solicitud" value="0" hidden>
                                </div>

                                <div class="form-group">
                                    <div class="alerta_validacion_solicitud alert alert-danger" style="display: none;"></div>
                                </div>

                                <div id="form_personal">

                                    <h2>Datos personales</h2>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Nombre</label>
                                            <input type="text" name="nombre" class="nombre form-control" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Apellido</label>
                                            <input type="text" name="apellido" class="apellido form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>DNI</label>
                                            <input type="text" name="dni" class="dni form-control" data-mask="00000000"
                                                required>
                                        </div>
                                    </div>

                                </div>
                                <div id="form_empresa" style="display: none">

                                    <h2>Datos de la empresa</h2>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Raz&oacute;n Social</label>
                                            <input type="text" name="razon_social" class="razon_social form-control"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>CUIT</label>
                                            <input type="text" name="cuit" class="cuit form-control" data-mask="0000000000000"
                                                required>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Email</label>
                                        <input type="email" name="email" class="email form-control" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Repetir Email</label>
                                        <input type="email" name="email_repeat" class="email_repeat form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Tel&eacute;fono</label>
                                        <div class="form-row">
                                            <input type="text" name="cod_area" class="cod_area form-control col-md-3"
                                                placeholder="C&oacute;d. &aacute;rea" data-mask="0000" required>
                                                <div class="input-group col-md-9">
                                                    <span class="input-group-addon">15</span>
                                                    <input type="text" name="telefono" class="telefono form-control" placeholder="N&uacute;mero" data-mask="0000000" required>
                                                </div>

                                        </div>
                                    </div>
                                </div>

                                <h2>Datos del veh&iacute;culo</h2>

                                <div class="form-group">
                                    <label>Tipo de Patente</label>
                                    <select id="tipo_patente" name="tipo_patente" class="form-control">
                                        <option value="0">Tradicional</option>
                                        <option value="1">Mercosur</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Número de patente</label>
                                    <input type="text" name="patente" style="text-transform: uppercase" class="patente form-control">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button id="btn_solicitud_tarjeta" class="btn btn-primary" type="submit">Enviar</button>
                </div>
                
            </div>
        </div>
    </div>