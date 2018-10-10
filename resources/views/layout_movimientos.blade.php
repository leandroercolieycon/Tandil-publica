<!-- MODAL MOVIMIENTOS -->
<div class="modal inmodal" id="modal-movimientos" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button><br>
                <div class="navy-line" style="margin-top:0.5rem"></div>

                <h1>Movimientos</h1>
                <p>Consulte los movimientos de su tarjeta. </p>

            </div>

            <div class="modal-body modal_spinner modal_body_movimientos">
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
                        <form id="formMovimientos" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="alerta_validacion_movimientos alert alert-danger" style="display: none;"></div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Número de tarjeta</label>
                                    <input name="tarjeta" type="number" class="form-control" required value="40000011">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="g-recaptcha" data-sitekey="6LeRPnQUAAAAAHoRSyxGwTAghziulNxX878giPP1"></div>
                                </div>                                
                            </div>

                        </form>
                    </div>                  
                    <div class="col-lg-4 col-sm-12 pull-right oculto" id="saldo">
                                    <div class="widget style1 navy-bg">
                                        <div class="vertical-align">
                                            <i class="fa fa-dollar fa-3x" style="margin-right:0.4rem;"></i>
                                            <h2 class="font-bold pull-right"><span></span></h2>
                                        </div>
                                    </div>
                        </div>  
                    <div class="col-lg-12 oculto" id="tabla-movimientos" style="text-align:center">                                             
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">                                
                                <div class="col-md-12">
                                    <input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Buscar movimientos">
                                    <table id="tabla-movimientoss" class="table footable" data-page-size="8" data-filter="#filter" >
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th data-hide="phone">Calle</th>
                                            <th data-hide="phone">Importe</th>
                                            <th data-hide="phone">Saldo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <ul class="pagination pull-right"></ul>
                                        </td>
                                    </tr>
                                    </tfoot>
                                    </table>
                                </div>
                                <div class="col-md-12" style="position: relative; height:40vh; width:80vw">
                                    <h2>Gastos por mes</h2>
                                    <canvas id="chartMovimientos"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" type="submit" id="btn_movimientos">Consultar</button>
            </div>

        </div>
    </div>
</div>