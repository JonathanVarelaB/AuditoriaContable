<div id='nuevoContribuyente'>
    <form class='form-horizontal' role="form" id="formNuevoContribuyente" ng-submit="agregarContribuyente();">
        <div style='text-align: right;font-size: 14px;'><span><span class='obligatorio'>*</span>&nbsp;Campo obligatorio</span></div>
        <span style='color:black'>Datos personales</span><hr>
        <div class="form-group">
            <label class="control-label col-sm-3" for="tipo">Tipo de contribuyente&nbsp;<span class='obligatorio'>*</span></label>
            <div class="col-sm-8"  style='padding-top: 5px;'><select class='form-control' ng-model="tipoC" id="tipoContribuyente">
                <option value="0">Seleccione</option>
                <option value="1">Físico</option>
                <option value="2">Jurídico</option>
            </select></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="identificacion">Identificación&nbsp;<span class='obligatorio'>*</span></label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" maxlength="15" ng-model="identificacion" required name="identificacion" placeholder="Identificación..." class="form-username form-control" id="identificacion"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="nombre">Nombre&nbsp;<span class='obligatorio'>*</span></label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" maxlength="60" required name="nombre" ng-model="nombre" placeholder="Nombre..." class="form-username form-control" id="nombre"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="cedulaDGT">Cédula DGT</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" maxlength="15" name="cedulaDGT" ng-model="cedulaDGT" placeholder="Cédula DGT..." class="form-password form-control" id="cedulaDGT"></div>
        </div>
        <span style='color:black'>Contacto</span><hr>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="telefono">Teléfono</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="text" maxlength="12" name="telefono" ng-model="telefono" placeholder="Teléfono..." class="form-password form-control" id="telefono"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="email">Correo Electrónico</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><input type="email" maxlength="50" name="email" ng-model="email" placeholder="Correo Electrónico..." class="form-password form-control" id="email"></div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3"  for="direccion">Dirección</label>
            <div class="col-sm-8"  style='padding-top: 5px;'><textarea maxlength="100" name="direccion" ng-model="direccion" placeholder="Dirección..." class="form-password form-control" id="direccion"></textarea></div>
        </div>
        <center>
            <div id="avisoRequired" style="display:none;"><span style="color:red;">* Debe de seleccionar el tipo de contribuyente.</span><br><br></div>
            <button type="submit" class="btn botonfondoAzul"><span>Guardar</span></button>
        </center><br>
    </form>
</div>