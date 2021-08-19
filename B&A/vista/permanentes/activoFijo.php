<?php include('../emergentes/emergentesDatosPermanentes.php'); ?>
<div id='usuarioExistente'>
    <div class='botonesAdministrar'>
        <center> <div class="btn-group" id="botonesActivos">
                   <button title='Depreciación' class='btn btn-sm botonColor menuCUExistente emergente'  href="#depreciacionActivo">
                    <span id="opcMenuConfig">Depreciación&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-sort-by-attributes-alt"></span>
                </button>
                   <button title='Editar' class='btn btn-sm botonColor menuCUExistente emergente'  href="#modificarActivo">
                    <span id="opcMenuConfig">Editar&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-edit"></span>
                </button>
                <button class="btn btn-sm botonColor emergente menuCUExistente" id="hab-desA" href="#hab-desActivo">
                                <span id="opcMenuConfig" class="condicionBoton"></span>&nbsp;&nbsp
                                <span id="condiciongly"></span>
                            </button>
                <button title='Agregar Registro' class='btn btn-sm botonColor emergente' href="#agregarActivo" id="agregarAct">
                    <span id="opcMenuConfig">Agregar Registro&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div></center>
    </div>
    <div id="contenidoPeriodoAmpliado" class='table-responsive'>
        <div id="divMostrarActivos"></div>
        <button id="actualizarActivos" type="button" style="visibility: hidden;"></button>
        <button id="refrescarTablaActivos" type="button" style="visibility: hidden;"></button>
    </div>
</div>