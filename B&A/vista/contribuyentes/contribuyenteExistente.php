<?php include('../emergentes/emergentesContribuyentes.php'); ?>
<div id='usuarioExistente'>
    <div class='menuCUExistente'>
        <center> <div class="btn-group" id="botonesContribuyente">
                <button title='Contactos' class='btn btn-sm botonColor emergente' id='contact' href='#infoContacto'><span id='opcMenuConfig'>Contactos&nbsp;&nbsp;</span><span class="glyphicon glyphicon-earphone"></span></button>
                <button title='Editar' class='btn btn-sm botonColor emergente' id='editC' href='#modificarContribuyente'><span id='opcMenuConfig'>Editar&nbsp;&nbsp;</span><span class="glyphicon glyphicon-edit"></span></button>
                <button title='Períodos' ng-click="cargarInfoC_Periodos();" class="btn btn-sm botonColor emergente" id="period" href='#periodosContribuyente'><span id='opcMenuConfig'>Períodos&nbsp;&nbsp;</span><span class="glyphicon glyphicon-duplicate"></span></button>
                <button title='Cuentas de Balance' ng-click="cargarInfoC_DatosPermanentes();" class='btn btn-sm botonColor'><span id='opcMenuConfig'>Cuentas de Balance&nbsp;&nbsp;</span><span class="glyphicon glyphicon-folder-open"></span></button>
            </div></center>
    </div>
    <div id="contenidoPeriodoAmpliado" class='table-responsive'>
        <div id="divMostrarContribuyentes"></div>
        <button id="refrescarTablaContribuyentes" type="button" style="visibility: hidden;"></button>
        <!--<button id="verificarUltimoMesActivos" type="button" style="visibility: hidden;"></button>-->
    </div>
</div>
