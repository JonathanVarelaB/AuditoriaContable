<?php include('../emergentes/emergentesDatosAdministrativos.php'); ?>
<div class="container" id='controlUsuarios'>
    <br><span id='tituloPag'>Anticipos del Período Fiscal</span><hr>
</div>
<div id='usuarioExistente'>
    <div class='botonesAdministrar'>
        <center>
            <div class="btn-group" id="botonesAnticipos">
                <button title='Editar' class='btn btn-sm botonColor menuCUExistente emergente' id='editarAnt' href="#modificarAnticipo">
                    <span id="opcMenuConfig">Editar&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-edit"></span>
                </button>
                <button  title='Eliminar' class="btn btn-sm botonColor emergente menuCUExistente" id="eliminarAnt" href="#eliminarAnticipo">
                    <span id="opcMenuConfig">Eliminar&nbsp;&nbsp</span>
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
                <button title='Agregar Registro' class='btn btn-sm botonColor emergente' id='agregarAnt' href="#agregarAnticipo">
                    <span id="opcMenuConfig">Agregar Registro&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </div>
        </center>
    </div>
    <div id="contenidoPeriodoAmpliado" class='table-responsive'>
        <div id="divMostrarAnticipos"></div>
        <button id="refrescarTablaAnticipos" type="button" style="visibility: hidden;"></button>
    </div>
</div>