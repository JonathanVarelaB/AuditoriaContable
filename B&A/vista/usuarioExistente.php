<?php include('emergentes/emergentesUsuarios.php'); ?>
<div id='usuarioExistente'>
    <div class='menuCUExistente'>
        <center><div class="btn-group" id='botonesUsuario'>
                <button title="Editar" class="btn btn-sm botonColor emergente" id="editU" href="#modificarUsuario">
                    <span id="opcMenuConfig">Editar&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-edit"></span>
                </button>
                <button class="btn btn-sm botonColor emergente" id="hab-desU" href="#hab-desUsuario">
                    <span id="opcMenuConfig"class="condicionBoton"></span>&nbsp;&nbsp
                    <span id="condiciongly"></span>
                </button>
            </div>
        </center>
    </div>
    <div id="contenidoPeriodoAmpliado" class='table-responsive'>
        <div id="divMostrarUsuarios"></div>
        <button id="refrescarTablaUsuarios" type="button" style="visibility: hidden;"></button>
    </div>
</div>
