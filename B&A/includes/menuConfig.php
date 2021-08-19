<ul class="nav2">
    <?php
    opcionesAdmiUs();
    ?>
</ul>

<?php

function opcionesAdmiUs() {
    echo '<li><a id="primeraOpcion" data-toggle="tooltip" title="Tipo de Cambio" class="emergente" href="#tipoDeCambio"><span id="opcMenuConfig4"><span id="opcMenuConfig4">Tipo </span>Cambio: </span>&#162; <span id="dolarMostrar"></span></a></li>';
    if (isset($_SESSION['tipoUsuario'])) {
        if ($_SESSION['tipoUsuario'] == 1) { //usuarioAdministrador
            echo '<li data-toggle="tooltip" title="Cuentas Contables"><a class="salir" href="controlCuentas.php#/"><span class="glyphicon glyphicon-list-alt"></span><span id="opcMenuConfig">   Cuentas<span id="opcMenuConfig4"> Contables</span></span></a></li>';
            echo '<li data-toggle="tooltip" title="Control de Usuarios"><a class="salir" href="controlUsuarios.php#/"><span class="glyphicon glyphicon-user"></span><span id="opcMenuConfig">   <span id="opcMenuConfig4">Control </span>Usuarios</span></a></li>';
            echo '<li><a class="salir" data-toggle="tooltip" title="Bitácora" href="bitacora.php"><span class="glyphicon glyphicon-book"></span><span id="opcMenuConfig">   Bitácora</span></a></li>';
        }
    }
    echo '<li><a class="salir" data-toggle="tooltip" title="Cambio de contraseña" href="configuracionCuenta.php"><span class="glyphicon glyphicon-cog"></span><span id="opcMenuConfig">   Contraseña</span></a></li>
          <li><a data-toggle="tooltip" title="Cerrar Sesión" class="emergente" href="#cerrarSesion"><span class="glyphicon glyphicon-log-in"></span><span id="opcMenuConfig">   Salir</span></a></li>';
}
