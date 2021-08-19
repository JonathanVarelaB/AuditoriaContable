
<!--------------------------------------------------CUENTAS----------------------------->
<div ng-controller="controlCuentas" id="agregarCuenta" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" id="formAgregarCuenta" ng-submit="agregarCuenta();">
        <center><h4>Agregar Cuenta</h4><hr></center><br>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="codigo">Código</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" ng-model='codigo' maxlength="15"  required name="codigo" placeholder="Código..." class="form-username form-control" id="códigoCnueva"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="nombre">Nombre</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" ng-model='nombre' maxlength="50"  required name="nombre" placeholder="Nombre..." class="form-username form-control" id="nombreCnueva"></div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>

<div ng-controller="controlCuentas" id="editarCuenta" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" id="formEditarCuenta" ng-submit="editarCuenta();">
        <center><h4>Editar Cuenta</h4><hr></center><br>
        <input type="hidden" id="codCuenta3">
        <div class="form-group">
            <label class="control-label col-sm-3"  for="codigo">Código</label>
            <div class="col-sm-8" style='padding-top: 5px;'><input type="text" ng-model='codigo' maxlength="15"  required name="codigo" placeholder="Código..." class="form-username form-control" id="codigoNuevo"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="nombre">Nombre</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" ng-model='nombre' maxlength="50"  required name="nombre" placeholder="Nombre..." class="form-username form-control" id="nombreNuevo"></div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar Cambios</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>

<div ng-controller="controlCuentas" id="hab-desCuenta" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <form role="form" id="formHab-DesCuenta" ng-submit="hab_deshabCuenta();">
        <center><h4><span id='condicionTitulo'></span> Cuenta</h4><hr></center>
        <input type="hidden" id="codCuenta2">
        <div class="form-group">
            <center><span style='color:black'>¿Desea <span id='condicionPreg'></span> a <span id='codCuenta'></span> / <span id='nomCuenta'></span>?</span><br><br>
                <button type="submit" class="btn botonfondoAzul"><span>Aceptar</span></button>
                <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
        </div>
        <input name='accion' type='hidden' id='formAccionDes-HabC'/>
    </form>
</div>