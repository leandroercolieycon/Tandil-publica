    <!-- MODAL CARGAR SALDO -->
    <div class="modal inmodal" id="modal-cargarsaldo" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button><br>
                    <div class="navy-line" style="margin-top:0.5rem"></div>
                    <h1>Cargar saldo</h1>
                    <p>Cargue su tarjeta de forma online. </p>
                </div>

                <div class="modal-body modal_spinner modal_body_cargar">
                    <div class="row justify-content-md-center">
                        <div class="col-lg-12 col-md-12 wow fadeInRight">
                            <form id="formCargarSaldo" class="form-horizontal">
                                <div class="form-group">
                                    <div class="alerta_validacion_cargar alert alert-danger" style="display: none;"></div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Número de tarjeta</label>
                                        <input name="tarjeta" type="number" class="form-control" required="true"
                                            value="40000006" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>E-mail</label>
                                        <input name="email" type="email" class="form-control" required="true"
                                            value="leandroercoli@eycon.com" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Importe</label>
                                        <div class="input-group m-b"><span class="input-group-addon">$</span>
                                            <input name="importe" type="number" class="form-control" required="true"
                                                value=50>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>Medio de pago</label>
                                        <select class="form-control m-b" name="medioPago">
                                            <option value="mercadopago">Mercado Pago</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" type="submit" id="btn_cargarsaldo">Cargar</button>
                </div>

            </div>
        </div>
    </div>