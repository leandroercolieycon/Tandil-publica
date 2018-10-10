    <!-- MODAL CONTACTO -->
    <div class="modal inmodal" id="modal-contacto" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button><br>
                    <div class="navy-line" style="margin-top:0.5rem"></div>
                    <h1>Contacto</h1>
                    <p>Realice aqu&iacute; sus consultas, reclamos o sugerencias</p>
                </div>
                <div class="modal-body modal_spinner modal_body_contacto">
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
                            <form id="formContacto">
                                <div class="form-group">
                                    <div class="alerta_validacion_contacto alert alert-danger" style="display: none;"></div>
                                </div>
                                <h2>Sus datos</h2>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nombre</label>
                                        <input type="text" name="nombre" class="form-control"  value="leandro">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Apellido</label>
                                        <input type="text" name="apellido" class="form-control"  value="ercoli">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>E-mail</label>
                                        <input type="email" name="email" class="form-control" value="leandroercoli@gmail.com">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Tel&eacute;fono</label>
                                        <div class="form-row">
                                            <input type="text" name="cod_area" class="cod_area form-control col-md-3"
                                                placeholder="C&oacute;d. &aacute;rea" data-mask="0000" required value="3822">
                                                <div class="input-group col-md-9">
                                                    <span class="input-group-addon">15</span>
                                                    <input type="text" name="celular" class="telefono form-control" placeholder="N&uacute;mero" data-mask="0000000" value="4127420" required>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <h2>Su mensaje</h2>                                
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Tipo</label>
                                        <select name="mensaje_tipo" class="form-control">
                                            <option value="0">Consulta</option>
                                            <option value="1">Sugerencia</option>
                                            <option value="2">Reclamo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" rows="5" name="mensaje_cuerpo" maxlength="500" placeholder="Escriba su mensaje (500 caracteres máx)">textotextotextotextotextotextote xtotextotextotextotextotextot textotextotextotextotextotextote xtotextotextotextotextotextot textotextotextotextotextotextote xtotextotextotextotextotextot textotextotextotextotextotextote xtotextotextotextotextotextot textotextotextotextotextotextote xtotextotextotextotextotextot textotextotextotextotextotextote xtotextotextotextotextotextot textotextotextotextotextotextote xtotextotextotextotextotextot textotextotextotextotextotextote xtotextotextotextotextotextot textotextotextotextotextotextote xtotextotextotextotextotextot </textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" type="submit" id="btn_contacto">Enviar</button>
                </div>
            </div>
        </div>
    </div>