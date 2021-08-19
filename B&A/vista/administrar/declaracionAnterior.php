<?php
session_start();
$_SESSION['idAnnoDeclaracion'] = intval($_SESSION['idAnnoPeriodo']) - 1;
?>
<div class="container" id='controlUsuarios'>
    <br><span id='tituloPag'>Declaración de Período Fiscal Anterior (<?php echo $_SESSION['idAnnoDeclaracion']; ?>)</span><hr>
</div>
<div id='contenidoPeriodo' ng-controller="controlDeclaracion" >
    <div class='botonesAdministrar'>
        <center>
            <div class="btn-group" id="mantenimientoDeclaracion" style="display: none;">
                <button title='Editar' class='btn btn-sm botonColor' ng-click="editarDeclaracion()" id='editarDA'><span id='opcMenuConfig'>Editar&nbsp;&nbsp;</span><span class="glyphicon glyphicon-edit"></span></button>
                <button title='Guardar' class='btn btn-sm botonColor' ng-click="guardarDeclaracion()" id='guardarDA'><span id='opcMenuConfig'>Guardar&nbsp;&nbsp;</span><span class="glyphicon glyphicon-floppy-saved"></span></button>
            </div>
            <div class="btn-group">
                <button title='Exportar Excel' class='btn btn-sm botonColor' id='exportarDA'><span id='opcMenuConfig'>Exportar Excel&nbsp;&nbsp;</span><span class="glyphicon glyphicon-save-file"></span></button>
            </div></center><br>
    </div>
    <div class='table-responsive' id="mostrarDeclaracion">
    </div>
</div>