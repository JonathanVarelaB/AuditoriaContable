<!--------------------------------------------------ANTICIPOS----------------------------->
<div id="agregarAnticipo" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" ng-submit="agregarAnticipo();" id="formAgregarAnticipo">
        <center><h4>Agregar Anticipo</h4><hr></center>
        <div class="form-group">
            <label class="control-label col-sm-4" for="formulario">Formulario - entidad</label>
            <div class="col-sm-7" style='padding-top: 5px;'><input type="text" ng-model="formulario" maxlength="45" name="formulario" placeholder="Formulario-entidad..." class="form-username form-control" id="formulario"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="tipoPago">Tipo de pago</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" ng-model="tipoPago" maxlength="30" name="tipoPago" placeholder="Tipo de pago..." class="form-username form-control" id="tipoPago"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="tipoAnticipo">Tipo</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <select class='form-control tipoAnticipo' ng-model="tipoAnt">
                    <option value="0">Seleccione</option>
                    <option value="1">Retención 2%</option>
                    <option value="2">Otras retenciones</option>
                    <option value="3">Pagos parciales</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="monto">Monto</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' required ng-model="monto" name="monto" placeholder="Monto..." class="form-username form-control" id="monto"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fecha">Fecha</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text" ng-model="fecha" name="fecha" placeholder="Fecha..." class="form-username form-control campoFecha" id="fechaAnticipo">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala">Fecha no existe o posee formato incorrecto</span>
            </div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>

<div id="modificarAnticipo" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" ng-submit="editarAnticipo();" id="formEditarAnticipo">
        <center><h4>Editar Anticipo</h4><hr></center>
        <input type="hidden" id="idAnticipo">
        <div class="form-group">
            <label class="control-label col-sm-4" for="formulario">Formulario - entidad</label>
            <div class="col-sm-7" style='padding-top: 5px;'><input type="text" maxlength="45" name="formulario" placeholder="Formulario-entidad..." class="form-username form-control" id="nuevoFormulario"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="tipoPago">Tipo de pago</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" maxlength="30" name="tipoPago" placeholder="Tipo de pago..." class="form-username form-control" id="nuevoTipoPago"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="tipoAnticipo">Tipo</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <select class='form-control tipoAnticipo' id="nuevoTipoAnticipo">
                    <option value="0">Seleccione</option>
                    <option value="1">Retención 2%</option>
                    <option value="2">Otras retenciones</option>
                    <option value="3">Pagos parciales</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="monto">Monto</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' required name="monto" placeholder="Monto..." class="form-username form-control" id="nuevoMonto"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fecha">Fecha</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text" name="fecha" placeholder="Fecha..." class="form-username form-control campoFecha" id="nuevaFechaAnticipo">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala">Fecha no existe o posee formato incorrecto</span>
            </div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar Cambios</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>

<div id="eliminarAnticipo" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <form role="form" id="eliminarAnticipo" ng-submit="eliminarAnticipo();">
        <center><h4>Eliminar Anticipo</h4><hr></center>
        <input type="hidden" id="idAnticipo2">
        <div class="form-group">
            <center><span style='color:black'>¿Desea eliminar el anticipo?</span><br><br>
                <button type="submit" class="btn botonfondoAzul"><span>Aceptar</span></button>
                <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
        </div>
    </form>
</div>
<!--------------------------------------------------MOVIMIENTOS-->
<div id="seleccionarMoneda2" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
        <center><h4>Seleccionar Moneda</h4><hr></center>
        <div class="form-group">
            <center><span style='color:black'>¿En que moneda es el monto?</span><br><br>
                <button onclick='tipoMoneda("0");' class="btn botonfondoAzul"><span>&#162;&nbsp; Colón</span></button>
                <button onclick='tipoMoneda("1");' class="btn btn-success"><span>&#36;&nbsp; Dólar</span></button>
            </center>
        </div>
    </form>
</div>
<div id="eliminarMovimiento" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <form role="form" id="eliminarMovimiento" ng-submit="eliminarMovimiento();">
        <center><h4>Eliminar Movimiento</h4><hr></center>
        <input type="hidden" id="idMovimiento2">
        <input type="hidden" id="montoActual2">
        <input type="hidden" id="pasivoActual2">
        <input type="hidden" id="dolareActual2">
        <div class="form-group">
            <center><span style='color:black'>¿Desea eliminar el movimiento?</span><br><br>
                <button type="submit" class="btn botonfondoAzul"><span>Aceptar</span></button>
                <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
        </div>
    </form>
</div>