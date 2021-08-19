<!--------------------------------------------------ACTIVOS----------------------------->
<div id="agregarActivo" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" ng-submit="agregarActivo();" id="formAgregarActivo">
        <center><h4>Agregar Activo</h4><hr></center>
        <div class="form-group">
            <label class="control-label col-sm-3" for="proveedor">Proveedor</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" ng-model="proveedor" maxlength="50" name="proveedor" placeholder="Proveedor..." class="form-username form-control" id="proveedor"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="descripcion">Descripción</label>
            <div class="col-sm-8" style='padding-top: 5px;'><textarea maxlength="100" required name="descripcion" ng-model="descripcion" placeholder="Descripcion..." class="form-password form-control" id="descripcion"></textarea></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="tipoActivo">Tipo</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <select class='form-control tipoActivo' ng-model="tipoA"></select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fecha">Fecha</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text" ng-model="fecha" name="fecha" placeholder="Fecha..." class="form-username form-control campoFecha" id="fechaActivo">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala">Fecha no existe o posee formato incorrecto</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="monto">Monto</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' required ng-model="monto" name="monto" placeholder="Monto..." class="form-username form-control" id="monto"></div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>

<div id="modificarActivo" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" ng-submit="editarActivo();" id="formEditarActivo">
        <center><h4>Editar Activo</h4><hr></center>
        <input type="hidden" id="idActivo">
        <div class="form-group">
            <label class="control-label col-sm-3" for="proveedor">Proveedor</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" maxlength="50" name="proveedor" placeholder="Proveedor..." class="form-username form-control" id="nuevoProveedor"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="descripcion">Descripción</label>
            <div class="col-sm-8" style='padding-top: 5px;'><textarea maxlength="100" required name="descripcion" placeholder="Descripcion..." class="form-password form-control" id="nuevaDescripcion"></textarea></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="tipoActivo">Tipo</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <select class='form-control tipoActivo' id='nuevoTipoActivo' ></select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fecha">Fecha</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text" name="fecha" placeholder="Fecha..." class="form-username form-control campoFecha" id="nuevaFechaActivo">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala">Fecha no existe o posee formato incorrecto</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="monto">Monto</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' required name="monto" placeholder="Monto..." class="form-username form-control" id="nuevoMonto"></div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar Cambios</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>

<div id="depreciacionActivo" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <center><h4>Depreciación de Activo</h4><hr></center>
    <div class="form-group">
        <label  for="mesesDepreciacion">Meses de Depreciación</label>&nbsp;&nbsp;
        <span id="mesesDepreciacion"></span>
    </div>
    <div class="form-group">
        <label  for="depreciacionMensual">Depreciación Mensual</label>&nbsp;&nbsp;
        <span id="depreciacionMensual"></span>
    </div>
    <div class="form-group">
        <label  for="mesesDepreciado">Meses de Depreciado</label>&nbsp;&nbsp;
        <span id="mesesDepreciado"></span>
    </div>
    <div class="form-group">
        <label  for="depreciacionAcumulada">Depreciación Acumulada</label>&nbsp;&nbsp;
        <span id="depreciacionAcumulada"></span>
    </div>
    <div class="form-group">
        <label  for="depreciacionPeriodo">Depreciación Período</label>&nbsp;&nbsp;
        <span id="depreciacionPeriodo"></span>
    </div>
</div>

<div id="hab-desActivo" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <form role="form" id="formHab-DesActivo" ng-submit="hab_deshabActivo();">
        <center><h4><span id='condicionTitulo'></span> Activo</h4><hr></center>
        <input type="hidden" id="idActivo2">
        <input type="hidden" id="monto2">
        <input type="hidden" id="Dmensual2">
        <div class="form-group">
            <center><span style='color:black'>¿Desea <span id='condicionPreg'></span> el activo?</span><br><br>
                <button type="submit" class="btn botonfondoAzul"><span>Aceptar</span></button>
                <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
        </div>
        <input name='accion' type='hidden' id='formAccionDes-HabA'/>
    </form>
</div>

<!--------------------------------------------------PASIVOS----------------------------->
<div id="agregarPasivo" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" ng-submit="agregarPasivo();" id="formAgregarPasivo">
        <center><h4>Agregar Pasivo</h4><hr></center>
        <div class="form-group">
            <label class="control-label col-sm-3" for="banco">Entidad y número de operación</label>
            <div class="col-sm-8" style='padding-top: 20px;'><input type="text" required ng-model="banco" maxlength="50" name="banco" placeholder="Entidad y número de operación..." class="form-username form-control" id="banco"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fechaApertura">Fecha Apertura</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text" ng-model="fechaApertura" name="fechaApertura" placeholder="Fecha Apertura..." class="form-username form-control campoFecha" id="fechaApertura">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato1">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala1">Fecha no existe o posee formato incorrecto</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fechaVencimiento">Fecha Vencimiento</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text" ng-model="fechaVencimiento" name="fechaVencimiento" placeholder="Fecha Vencimiento..." class="form-username form-control campoFecha" id="fechaVencimiento">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato2">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala2">Fecha no existe o posee formato incorrecto</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala3">La fecha de vencimiento debe de ser mayor a la de apertura</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="interes">Interés</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' ng-model="interes" name="interes" placeholder="Interés..." class="form-username form-control" id="interes"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="principal">Principal</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' required ng-model="principal" name="principal" placeholder="Principal..." class="form-username form-control" id="principal"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="observaciones">Observaciones</label>
            <div class="col-sm-8" style='padding-top: 5px;'><textarea maxlength="100" name="observaciones" ng-model="observaciones" placeholder="Observaciones..." class="form-password form-control" id="observaciones"></textarea></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="documento">Documento</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" ng-model="documento" maxlength="20" name="documento" placeholder="Documento..." class="form-username form-control" id="documento"></div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>
<div id="modificarPasivo" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" ng-submit="editarPasivo();" id="formEditarPasivo">
        <center><h4>Editar Pasivo</h4><hr></center>
        <input type="hidden" id="bancoActual">
        <!--<div class="form-group">
            <label class="control-label col-sm-3" for="banco">Entidad y número de operación</label>
            <div class="col-sm-8" style='padding-top: 20px;'><input required type="text" maxlength="50" name="banco" placeholder="Entidad y número de operación..." class="form-username form-control" id="nuevoBanco"></div>
        </div>-->
        <div class="form-group">
            <label class="control-label col-sm-3" for="banco">Entidad y número de operación</label> &nbsp;&nbsp;
            <div class="col-sm-8" style='padding-top: 20px;'><span style="font-size: 13px;" id="bancoActual3"></span></div>
        </div><hr>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fechaApertura">Fecha Apertura</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text" name="fechaApertura" placeholder="Fecha Apertura..." class="form-username form-control campoFecha" id="nuevaFechaApertura">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato1">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala1">Fecha no existe o posee formato incorrecto</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fechaVencimiento">Fecha Vencimiento</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text"  name="fechaVencimiento" placeholder="Fecha Vencimiento..." class="form-username form-control campoFecha" id="nuevaFechaVencimiento">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato2">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala2">Fecha no existe o posee formato incorrecto</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala3">La fecha de vencimiento debe de ser mayor a la de apertura</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="interes">Interés</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' name="interes" placeholder="Interés..." class="form-username form-control" id="nuevoInteres"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="principal">Principal</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' required name="principal" placeholder="Principal..." class="form-username form-control" id="nuevoPrincipal"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="observaciones">Observaciones</label>
            <div class="col-sm-8" style='padding-top: 5px;'><textarea maxlength="100" name="observaciones" placeholder="Observaciones..." class="form-password form-control" id="nuevasObservaciones"></textarea></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="documento">Documento</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" maxlength="20" name="documento" placeholder="Documento..." class="form-username form-control" id="nuevoDocumento"></div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>
<div id="hab-desPasivo" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <form role="form" id="formHab-DesPasivo" ng-submit="hab_deshabPasivo();">
        <center><h4><span id='condicionTitulo'></span> Pasivo</h4><hr></center>
        <input type="hidden" id="bancoActual2">
        <input type="hidden" id="principal3">
        <input type="hidden" id="saldo3">
        <div class="form-group">
            <center><span style='color:black'>¿Desea <span id='condicionPreg'></span> el pasivo?</span><br><br>
                <button type="submit" class="btn botonfondoAzul"><span>Aceptar</span></button>
                <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
        </div>
        <input name='accion' type='hidden' id='formAccionDes-HabPas'/>
    </form>
</div>
<!--------------------------------------------------PATRIMONIOS----------------------------->
<div id="agregarPatrimonio" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" ng-submit="agregarPatrimonio();" id="formAgregarPatrimonio">
        <center><h4>Agregar Patrimonio</h4><hr></center>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fechaApertura">Fecha</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text" ng-model="fecha" name="fecha" placeholder="Fecha..." class="form-username form-control campoFecha" id="fecha">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato1">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala1">Fecha no existe o posee formato incorrecto</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="accionista">Accionista</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" ng-model="accionista" maxlength="45" name="accionista" placeholder="Accionista..." class="form-username form-control" id="accionista"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="acta">Acta</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" ng-model="acta" maxlength="45" name="acta" placeholder="Acta..." class="form-username form-control" id="acta"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="monto">Monto</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' required ng-model="monto" name="monto" placeholder="Monto..." class="form-username form-control" id="monto"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4"  for="fechaDevolucion">Fecha de Devolución</label>
            <div class="col-sm-7"  style='padding-top: 5px;'>
                <input type="text" ng-model="fechaDevolucion" name="fechaDevolucion" placeholder="Fecha Devolución..." class="form-username form-control campoFecha" id="fechaDevolucion">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato2">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala2">Fecha no existe o posee formato incorrecto</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala3">La fecha de devolución debe de ser mayor a la ...</span>
            </div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>

<div id="modificarPatrimonio" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" ng-submit="editarPatrimonio();" id="formEditarPatrimonio">
        <center><h4>Editar Patrimonio</h4><hr></center>
        <input type="hidden" id="idPatrimonio">
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fechaApertura">Fecha</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text" name="fecha" placeholder="Fecha..." class="form-username form-control campoFecha" id="nuevaFecha">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato1">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala1">Fecha no existe o posee formato incorrecto</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="accionista">Accionista</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" maxlength="45" name="accionista" placeholder="Accionista..." class="form-username form-control" id="nuevoAccionista"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="acta">Acta</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" maxlength="45" name="acta" placeholder="Acta..." class="form-username form-control" id="nuevaActa"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="monto">Monto</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' required name="monto" placeholder="Monto..." class="form-username form-control" id="nuevoMonto"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4"  for="fechaDevolucion">Fecha de Devolución</label>
            <div class="col-sm-7"  style='padding-top: 5px;'>
                <input type="text" name="fechaDevolucion" placeholder="Fecha Devolución..." class="form-username form-control campoFecha" id="nuevaFechaDevolucion">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato2">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala2">Fecha no existe o posee formato incorrecto</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala3">La fecha de devolución debe de ser mayor a la ...</span>
            </div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar Cambios</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>
<div id="hab-desPatrimonio" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <form role="form" id="formHab-DesPatrimonio" ng-submit="hab_deshabPatrimonio();">
        <center><h4><span id='condicionTitulo'></span> Patrimonio</h4><hr></center>
        <input type="hidden" id="idPatrimonio2">
        <input type="hidden" id="monto7">
        <div class="form-group">
            <center><span style='color:black'>¿Desea <span id='condicionPreg'></span> el patrimonio?</span><br><br>
                <button type="submit" class="btn botonfondoAzul"><span>Aceptar</span></button>
                <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
        </div>
        <input name='accion' type='hidden' id='formAccionDes-HabPat'/>
    </form>
</div>
<!--------------------------------------------------INVERSIONES----------------------------->
<div id="agregarInversion" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" ng-submit="agregarInversion();" id="formAgregarInversion">
        <center><h4>Agregar Inversión</h4><hr></center>
        <div class="form-group">
            <label class="control-label col-sm-3" for="sociedad">Sociedad</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" ng-model="sociedad" maxlength="70" name="sociedad" placeholder="Sociedad..." class="form-username form-control" id="sociedad"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="cedJuridica">Cédula Jurídica</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" ng-model="cedJuridica" required maxlength="45" name="cedJuridica" placeholder="Cédula Jurídica..." class="form-username form-control" id="cedJuridica"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fecha">Fecha</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text" ng-model="fecha" name="fecha" placeholder="Fecha..." class="form-username form-control campoFecha" id="fecha">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato1">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala1">Fecha no existe o posee formato incorrecto</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="monto">Monto</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' required ng-model="monto" name="monto" placeholder="Monto..." class="form-username form-control" id="monto"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="observacion">Observaciones</label>
            <div class="col-sm-8" style='padding-top: 5px;'><textarea maxlength="100" name="observacion" ng-model="observacion" placeholder="Observacion..." class="form-password form-control" id="observacion"></textarea></div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>

<div id="modificarInversion" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" ng-submit="editarInversion();" id="formEditarInversion">
        <center><h4>Editar Inversión</h4><hr></center>
        <input type="hidden" id="idInversion">
        <div class="form-group">
            <label class="control-label col-sm-3" for="sociedad">Sociedad</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" maxlength="70" name="sociedad" placeholder="Sociedad..." class="form-username form-control" id="nuevaSociedad"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="cedJuridica">Cédula Jurídica</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" required maxlength="45" name="cedJuridica" placeholder="Cédula Jurídica..." class="form-username form-control" id="nuevaCedJuridica"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="fecha">Fecha</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <input type="text" name="fecha" placeholder="Fecha..." class="form-username form-control campoFecha" id="nuevaFecha">
                <span style="display:none;color:red;font-size:13px;" id="notaFechaFormato1">DD/MM/AAAA</span>
                <span style="display:none;color:red;font-size:13px;" id="notaFechaMala1">Fecha no existe o posee formato incorrecto</span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="monto">Monto</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="number" step='any' required name="monto" placeholder="Monto..." class="form-username form-control" id="nuevoMonto"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="observacion">Observaciones</label>
            <div class="col-sm-8" style='padding-top: 5px;'><textarea maxlength="100" name="observacion" placeholder="Observacion..." class="form-password form-control" id="nuevaObservacion"></textarea></div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar Cambios</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>
<div id="hab-desInversion" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <form role="form" id="formHab-DesInversion" ng-submit="hab_deshabInversion();">
        <center><h4><span id='condicionTitulo'></span> Inversión</h4><hr></center>
        <input type="hidden" id="idInversion2">
        <input type="hidden" id="monto7">
        <div class="form-group">
            <center><span style='color:black'>¿Desea <span id='condicionPreg'></span> la inversión?</span><br><br>
                <button type="submit" class="btn botonfondoAzul"><span>Aceptar</span></button>
                <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
        </div>
        <input name='accion' type='hidden' id='formAccionDes-HabInv'/>
    </form>
</div>