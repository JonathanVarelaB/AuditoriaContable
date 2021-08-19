<!--------------------------------------------------CONTENIDO DE LAS VENTANAS EMERGENTES----------------------------->

<!--------------------------------------------------USUARIO----------------------------->
<div id="modificarUsuario" class="zoom-anim-dialog white-popup-block mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" id="formEditarUsuario" ng-submit="editarUsuario();">
        <center><h4>Editar Usuario</h4><hr></center>
        <input type="hidden" id="idUsuario">
        <input type="hidden" id="nombreUsuarioActual">
        <div class="form-group">
            <label class="control-label col-sm-3"  for="nombre">Nombre Completo</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" maxlength="50"  required name="nombre" placeholder="Nombre..." class="form-username form-control" id="nuevoNombreCompleto"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="nombreU">Nombre de Usuario</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" maxlength="50"  required name="nombreU" placeholder="Usuario..." class="form-username form-control" id="nuevoNombreUsuario"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"   for="email">Correo Electrónico</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="email" maxlength="50"  required name="email" placeholder="Correo Electrónico..." class="form-password form-control" id="nuevoEmailUsuario"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="tipoUsuario">Tipo de Usuario</label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <select class='form-control tipoSelect' id='nuevoTipoUsuario' ng-click="cambioTUsuario();"></select>
            </div>
        </div>
        <div style="padding-left: 12%;">
            <div id="permisosDiv" style="display:none;">
                <div class="checkbox">
                    <label><input name='revisar' type="checkbox" id='nuevoPermRevisar'> &nbsp;&nbsp;Revisar</label>
                    <span class='nota'>(puede clasificar un período como revisado)</span>
                </div>
                <div class="checkbox">
                    <label><input name='aprobar' type="checkbox" id='nuevoPermAprobar'> &nbsp;&nbsp;Aprobar</label>
                    <span class='nota'>(puede clasificar un período como aprobado)</span>
                </div>
                <div class="checkbox">
                    <label><input name='editar' type="checkbox" id='nuevoPermEditar'> &nbsp;&nbsp;Editar</label>
                    <span class='nota'>(puede editar la información de un período ya finalizado)</span>
                </div>
            </div>
        </div>
        <center><br><button type="submit" class="btn botonfondoAzul"><span>Guardar Cambios</span></button>
            <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
    </form>
</div>

<div id="hab-desUsuario" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <form role="form" id="formHab-DesUsuario" ng-submit="hab_deshabUsuario();">
        <center><h4><span id='condicionTitulo'></span> Usuario</h4><hr></center>
        <input type="hidden" id="idUsuario2">
        <input type="hidden" id="nomCompletoHD">
        <div class="form-group">
            <center><span style='color:black'>¿Desea <span id='condicionPreg'></span> a <span id='nombreUs'></span>?</span><br><br>
                <button type="submit" class="btn botonfondoAzul"><span>Aceptar</span></button>
                <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
        </div>
        <input name='accion' type='hidden' id='formAccionDes-HabU'/>
    </form>
</div>
