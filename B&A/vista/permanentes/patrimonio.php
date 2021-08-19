<?php include('../emergentes/emergentesDatosPermanentes.php'); ?>
<div id='usuarioExistente'>
    <div class='botonesAdministrar'>
        <center> <div class="btn-group" id="botonesPatrimonios">
                   <button title='Editar' class='btn btn-sm botonColor menuCUExistente emergente' id='editarPat' href="#modificarPatrimonio">
                    <span id="opcMenuConfig">Editar&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-edit"></span>
                </button>
                <button class="btn btn-sm botonColor emergente menuCUExistente" id="hab-desPat" href="#hab-desPatrimonio">
                                <span id="opcMenuConfig" class="condicionBoton"></span>&nbsp;&nbsp
                                <span id="condiciongly"></span>
                            </button>
                <button title='Agregar Registro' class='btn btn-sm botonColor emergente' id='agregarPat' href="#agregarPatrimonio">
                    <span id="opcMenuConfig">Agregar Registro&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div></center>
    </div>
    <div id="contenidoPeriodoAmpliado" class='table-responsive'>
        <div id="divMostrarPatrimonios"></div>
        <button id="refrescarTablaPatrimonios" type="button" style="visibility: hidden;"></button>
    </div>
</div>