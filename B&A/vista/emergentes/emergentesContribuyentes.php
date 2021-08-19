<!--------------------------------------------------CONTRIBUYENTE----------------------------->
<div id="infoContacto" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <center><h4>Información de Contacto</h4><hr></center>
    <div class="form-group">
        <label  for="nombre">Nombre</label>&nbsp;&nbsp;
        <span style="font-size: 13px;" id="nomContribuyente"></span>
    </div><hr>
    <div class="form-group">
        <label  for="teléfono">Teléfono</label>&nbsp;&nbsp;
        <span id="telContribuyente"></span>
    </div>
    <div class="form-group">
        <label  for="email">Correo Electrónico</label>&nbsp;&nbsp;
        <span id="emailContribuyente"></span>
    </div>
    <div class="form-group">
        <label  for="direccion">Dirección</label>&nbsp;&nbsp;
        <span id="direcContribuyente"></span>
    </div>
</div>

<div id="modificarContribuyente" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" ng-submit="editarContribuyente();" id="formEditarContribuyente">
        <center><h4>Editar Contribuyente</h4><hr></center>
        <input type="hidden" id="idContribuyente">
        <input type="hidden" id="tipoActualC">
        <div class="form-group">
            <label class="control-label col-sm-3" for="tipo">Contribuyente</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <select class='form-control' id='tipoContribuyente'></select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="identificacion">Identificación</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" maxlength="15" required name="identificacion" placeholder="Identificación..." class="form-username form-control" id="idContribuyente2"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="nombre">Nombre</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" maxlength="60" required name="nombre" placeholder="Nombre..." class="form-username form-control" id="nomContribuyente2"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="cedulaDGT">Cédula DGT</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" maxlength="15" name="cedulaDGT" placeholder="Cédula DGT..." class="form-password form-control" id="cedulaDGTContribuyente"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="telefono">Teléfono</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text"  maxlength="12" name="telefono" placeholder="Teléfono..." class="form-password form-control" id="telContribuyente2"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="email">Correo Electrónico</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" maxlength="50" name="email" placeholder="Correo Electrónico..." class="form-password form-control" id="emailContribuyente2"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="direccion">Dirección</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><textarea maxlength="100" name="direccion" placeholder="Dirección..." class="form-password form-control" id="direcContribuyente2"></textarea></div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar Cambios</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>

<div id="periodosContribuyente" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <center><h4 class='letraAzul'>Períodos</h4><hr>
    <div class="form-group">
        <label  for="nombre">Nombre</label>&nbsp;&nbsp;
        <span style="font-size: 13px;" id="nomContribuyente3"></span>
    </div><hr></center>
    <center>
        <div class='btn-group-vertical listaPeriodos'>
            <button style='padding: 11px;' type='button' class='btn botonfondoAzul emergente' href="#nuevoPeríodo">Crear Período</button>
        </div>
        <div class='btn-group-vertical listaPeriodos2'></div>
    </center>
</div>

<div id="nuevoPeríodo" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <form class="form-horizontal" role="form" id="formCrearPeriodo" ng-submit="crearPeriodo_Declaracion();">
        <center><h4>Crear Período</h4><hr></center>
        <input type="hidden" id="idContribuyente3">
        <div class="form-group">
            <label class="control-label col-sm-4"  for="nombre">Nombre</label>&nbsp;&nbsp;
            <div class="col-sm-7" style='padding-top: 5px;'><span style="font-size: 13px;" id="nomContribuyente4"></span></div>
        </div><hr>
        <div class="form-group">
            <label class="control-label col-sm-4"   for="año">Año</label>
            <div class="col-sm-7" style='padding-top: 5px;'>
                <input type="text" maxlength="4" required name="año" ng-model="anno" ng-change="comprobarAnno()" placeholder="Año..." class="form-password form-control" id="annoPeriodo">
                <span style="display:none;color:red;font-size:13px;" id="notaNumerico">Únicamente valores númericos</span>
            </div>
        </div>
        <div class="form-group" id="fechaCierreDiv" style="display:none;">
            <label class="control-label col-sm-4"   for="cierre">Fecha de cierre</label>
            <div class="col-sm-5" style='padding-top: 5px;width: 45%;margin-right: 0;padding-right: 0;'>
                <input type="text" maxlength="20" required name="cierre" ng-model="fechaCierre" placeholder="Fecha de cierre..." class="form-password form-control" id="cierrePeriodo">
            </div>
            <span class="col-sm-2" style="margin-left: 10px;padding-left: 0;padding-top: 5px;width: 10%;">{{anno}}</span>
        </div>
        <input name='accion' type='hidden' value='crearPeriodo'/>
        <center><br><button disabled="true" type="submit" id='submitCrearPeriodo' class="btn botonfondoAzul"><span>Crear</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>

<div id="nuevoRangoPeriodoTipo" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <form class="form-horizontal" role="form" id="formCrearRango" ng-submit="crearRango();">
        <center><h4>Crear Rango de Impuesto de Venta</h4><hr></center>
        <div class="form-group">
            <label class="control-label col-sm-3" for="tipo">Tipo</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <select class='form-control' id='tipoRango2' ng-model="tipoRangoNuevo" ng-change="tipoRangoCrear();">
                    <option value="0">Seleccione</option>
                    <option value="1">Físico</option>
                    <option value="2">Jurídico</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"   for="año">Año</label>
            <div class="col-sm-8" style='padding-top: 5px;'>
                <input type="text" ng-model="annoRangoNuevo" disabled ng-change="annoRangoCrear();" maxlength="4" required name="año" placeholder="Año..." class="form-password form-control" id="añoRango">
                <span style="display:none;color:red;font-size:13px;" id="notaNumerico">Únicamente valores númericos</span>
                <span style="display:none;color:red;font-size:13px;" id="notaExistente">Ya existe ese rango de impuestos</span>
            </div>
        </div>
        <br>
        <div id="rangoFisico" class="form-group" style='margin: 0 5px 0 5px;display: none;'>
            <hr>
            <table class="table ">
                <thead><tr><th><label>Tarifa</label></th><th><label>Rango</label></th></tr></thead>
                <tbody>
                    <tr>
                        <td><input class='form-control col-sm-3' required maxlength="2" style='max-width:60px;' type="text" ng-model="tarifaFisico1"><label class="col-sm-2" style='padding-top: 6px;color:black;'>%</label></td>
                        <td><input type=number step="any" class='form-control reqFisico' type="text" ng-model="rangoFisico1"></td>
                    </tr>
                    <tr>
                        <td><input class='form-control col-sm-3' required maxlength="2" style='max-width:60px;' type="text" ng-model="tarifaFisico2"><label class="col-sm-2" style='padding-top: 6px;color:black;'>%</label></td>
                        <td><input type=number step="any" class='form-control reqFisico' type="text" ng-model="rangoFisico2"></td>
                    </tr>
                    <tr>
                        <td><input class='form-control col-sm-3' required maxlength="2" style='max-width:60px;' type="text" ng-model="tarifaFisico3"><label class="col-sm-2" style='padding-top: 6px;color:black;'>%</label></td>
                        <td><input type=number step="any" class='form-control reqFisico' type="text" ng-model="rangoFisico3"></td>
                    </tr>
                    <tr>
                        <td><input class='form-control col-sm-3' required maxlength="2" style='max-width:60px;' type="text" ng-model="tarifaFisico4"><label class="col-sm-2" style='padding-top: 6px;color:black;'>%</label></td>
                        <td><input type=number step="any" class='form-control reqFisico' type="text" ng-model="rangoFisico4"></td>
                    </tr>
                    <tr>
                        <td><input class='form-control col-sm-3' required maxlength="2" style='max-width:60px;' type="text" ng-model="tarifaFisico5"><label class="col-sm-2" style='padding-top: 6px;color:black;'>%</label></td>
                        <td><input type=number step="any" class='form-control' type="text" ng-model="rangoFisico5"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="rangoJuridico" class="form-group" style='margin: 10px 5px 0 5px;display: none;'>
            <hr>
            <table class="table">
                <thead><tr><th><label>Tarifa</label></th><th><label>Rango</label></th></tr></thead>
                <tbody>
                    <tr>
                        <td><input class='form-control col-sm-3' required maxlength="2" style='max-width:60px;' type="text" ng-model="tarifaJuridico1"><label class="col-sm-2" style='padding-top: 6px;color:black;'>%</label></td>
                        <td><input type=number step="any" class='form-control reqJuridico' type="text" ng-model="rangoJuridico1"></td>
                    </tr>
                    <tr>
                        <td><input class='form-control col-sm-3' required maxlength="2" style='max-width:60px;' type="text" ng-model="tarifaJuridico2"><label class="col-sm-2" style='padding-top: 6px;color:black;'>%</label></td>
                        <td><input type=number step="any" class='form-control reqJuridico' type="text" ng-model="rangoJuridico2"></td>
                    </tr>
                    <tr>
                        <td><input class='form-control col-sm-3' required maxlength="2" style='max-width:60px;' type="text" ng-model="tarifaJuridico3"><label class="col-sm-2" style='padding-top: 6px;color:black;'>%</label></td>
                        <td><input type=number  step="any" class='form-control' type="text" ng-model="rangoJuridico3"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <center><button type="submit" class="btn botonfondoAzul" id='submitCrearRango' disabled><span>Crear</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>