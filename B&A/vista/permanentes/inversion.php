<?php include('../emergentes/emergentesDatosPermanentes.php'); ?>
<div id='usuarioExistente'>
    <div class='botonesAdministrar'>
        <center> <div class="btn-group" id="botonesInversiones">
                   <button title='Editar' class='btn btn-sm botonColor menuCUExistente emergente' id='editarInv' href="#modificarInversion">
                    <span id="opcMenuConfig">Editar&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-edit"></span>
                </button>
                <button class="btn btn-sm botonColor emergente menuCUExistente" id="hab-desInv" href="#hab-desInversion">
                                <span id="opcMenuConfig" class="condicionBoton"></span>&nbsp;&nbsp
                                <span id="condiciongly"></span>
                            </button>
                <button title='Agregar Registro' class='btn btn-sm botonColor emergente' id='agregarInv' href="#agregarInversion">
                    <span id="opcMenuConfig">Agregar Registro&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div></center>
    </div>
    <div id="contenidoPeriodoAmpliado" class='table-responsive'>
        <div id="divMostrarInversiones"></div>
        <button id="refrescarTablaInversion" type="button" style="visibility: hidden;"></button>
    </div>
</div>