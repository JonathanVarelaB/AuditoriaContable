<div id='nuevoUsuario'>
    <form class='form-horizontal' role="form" id="formNuevoUsuario" ng-submit="agregarUsuario();">
        <div style='text-align: right;font-size: 14px;padding-top: 2%;'><span><span class='obligatorio'>*</span>&nbsp;Campo obligatorio</span></div>
        <span style='color:black'>Datos personales</span><hr>
        <div class="form-group">
            <label class="control-label col-sm-3" for="nombre">Nombre Completo&nbsp;<span class='obligatorio'>*</span></label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" maxlength="50" required ng-model="nomCompleto" name="nombreCompleto" placeholder="Nombre..." class="form-username form-control" id="nombreCompleto"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="usuario">Nombre de Usuario&nbsp;<span class='obligatorio'>*</span></label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" maxlength="50" required ng-model="nomUsuario" name="nombreUsuario" placeholder="Usuario..." class="form-username form-control" id="nombreUsuario"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="email">Correo Electrónico&nbsp;<span class='obligatorio'>*</span></label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="email" maxlength="50" required ng-model='email' name="emailUsuario" placeholder="Correo Electrónico..." class="form-password form-control" id="emailUsuario"></div>
        </div>
        <span style='color:black'>Permisos</span><hr>
        <div class="form-group">
            <label class="control-label col-sm-3" for="tipoUsuario">Tipo de Usuario&nbsp;<span class='obligatorio'>*</span></label>
            <div class="col-sm-8"  style='padding-top: 5px;'>
                <select class='form-control tipoSelect' id='tipoUsuario' ng-model="admin" ng-change="cambioTipoUsuario();">
                    <option value="0">Seleccione</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                    <option value="3">Digitador</option>
                </select>
            </div>
        </div>
        <!--<div class="checkbox">
            &nbsp;&nbsp;<label><input id="tipoUsuario" ng-model='admin' name='administrador' type="checkbox" value=""> Administrador</label>
            <span class='nota'>(puede acceder al control de usuarios y bitácora)</span>
        </div>-->
        <div id="permisosDiv" style="display:none;">
            <div class="checkbox">
                &nbsp;&nbsp;<label><input name='revisar' ng-model='revisar' id="permRevisar" type="checkbox" value=""> Revisar</label>
                <span class='nota'>(puede clasificar un período como revisado)</span>
            </div>
            <div class="checkbox">
                &nbsp;&nbsp;<label><input name='aprobar' ng-model='aprobar' type="checkbox" id="permAprobar" value=""> Aprobar</label>
                <span class='nota'>(puede clasificar un período como aprobado)</span>
            </div>
            <div class="checkbox">
                &nbsp;&nbsp;<label><input name='editar' ng-model='editar' id='permEditar' type="checkbox" value=""> Editar</label>
                <span class='nota'>(puede editar la información de un período ya finalizado)</span>
            </div>
        </div>
        <center>
            <div id="avisoRequired" style="display:none;"><span style="color:red;">* Debe de seleccionar el tipo de usuario.</span><br><br></div>
            <button style="margin-top: 1%;" type="submit" class="btn botonfondoAzul"><span>Guardar</span></button></center><br>
    </form>
</div>