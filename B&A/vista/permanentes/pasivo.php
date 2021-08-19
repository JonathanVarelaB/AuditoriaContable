<?php include('../emergentes/emergentesDatosPermanentes.php'); ?>
<div id='usuarioExistente'>
    <div class='botonesAdministrar'>
        <center> <div class="btn-group" id="botonesPasivos">
                   <button title='Editar' class='btn btn-sm botonColor menuCUExistente emergente' id='editarPas' href="#modificarPasivo">
                    <span id="opcMenuConfig">Editar&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-edit"></span>
                </button>
                <button class="btn btn-sm botonColor emergente menuCUExistente" id="hab-desA" href="#hab-desPasivo">
                                <span id="opcMenuConfig" class="condicionBoton"></span>&nbsp;&nbsp
                                <span id="condiciongly"></span>
                            </button>
                <button title='Agregar Registro' class='btn btn-sm botonColor emergente' id='agregarPas' href="#agregarPasivo">
                    <span id="opcMenuConfig">Agregar Registro&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div></center>
    </div>
    <div id="contenidoPeriodoAmpliado" class='table-responsive'>
        <div id="divMostrarPasivos"></div>
        <button id="refrescarTablaPasivos" type="button" style="visibility: hidden;"></button>
    </div>
</div>