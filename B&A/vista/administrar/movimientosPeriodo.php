<?php include('../emergentes/emergentesDatosAdministrativos.php'); ?>
<div  style='position: absolute;right: 7%;'>
                <div class="btn-group">
                    <button style="" title='Exportar Excel' class='btn btn-sm botonColor reporte' id='exportarMOV'><span id='opcMenuConfig'>Exportar&nbsp;&nbsp;</span><span class="glyphicon glyphicon-save-file"></span></button>
                </div>
                <div class="btn-group">
                    <button style="" title='Importar Excel' class='btn btn-sm botonColor reporte' id='importarMOV'><span id='opcMenuConfig'>Importar&nbsp;&nbsp;</span><span class="glyphicon glyphicon-open-file"></span></button>
                </div>
                <div class="btn-group">
                    <button style="" title='Plantilla' class='btn btn-sm botonColor reporte' id='plantillaMOV'><span id='opcMenuConfig44'>Plantilla&nbsp;&nbsp;</span><span class="glyphicon glyphicon-save-file"></span></button>
                </div>
    </div>
<div style="padding-top:5px;">
    <span id='tituloPag'>Movimientos<span id="opcMenuConfig2"> del Período Fiscal</span></span><hr>
</div>
<div id='usuarioExistente' style="padding-top: 0;">
    <div id="contenidoPeriodoAmpliado" class='table-responsive movPerContenido'>
        <div class="btn-group" style="position:absolute;right:2.5%;">
            <button title="Limpiar Celdas" style="border-radius:20px;margin-right:15px;display:none;" class="btn btn botonfondoAzul" id="celdasMOV" ng-click="limpiarCeldas();">
                <span id="opcMenuConfig2">Limpiar Celdas&nbsp;&nbsp;</span>
                <span class="glyphicon glyphicon-erase"></span>
            </button>
            <button title="Guardar Cambios" style="border-radius:20px;margin-right:15px;display:none;" class="btn btn botonfondoAzul" id="cambiosMOV" ng-click="editarMovimiento();">
                <span id="opcMenuConfig2">Guardar Cambios&nbsp;&nbsp;</span>
                <span class="glyphicon glyphicon-floppy-disk"></span>
            </button>
            <button title="Agregar Registro" style="border-radius:20px;display:none;" class="btn btn botonfondoAzul" id="agregarMOV" ng-click="agregarMovimiento();">
                <span id="opcMenuConfig2">Agregar Registro&nbsp;&nbsp;</span>
                <span class="glyphicon glyphicon-plus"></span>
            </button>
        </div>
        <div id="divMostrarMovimientos" style="margin-top:40px;"></div>
        <button id="refrescarTablaMovimientos" type="button" style="visibility: hidden;"></button>
        <button id="seleccionarMoneda" type="button" class="emergente" href="#seleccionarMoneda2" style="visibility: hidden;"></button>
    </div>
</div>

