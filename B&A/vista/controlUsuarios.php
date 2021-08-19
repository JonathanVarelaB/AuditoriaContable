<?php 
    session_start();
    if(isset($_SESSION['tipoUsuario']))
    {
        if($_SESSION['tipoUsuario'] != 1)
        {
            header('Location: ../vista/inicio.php');
            exit;
        }
    }
    else
        header('Location: ../index.php');
?>
<!DOCTYPE html>
<html ng-app="moduleUsuarios">
    <?php include('../includes/head.php'); ?>
    <body id="bodyNormal">
        <div class="fix1">
            <?php include('../includes/encabezado.php'); ?>
            <div id='ubicacion'>
                <a href='inicio.php'><span style='color:#2098D1'><span id='opcMenuConfig3' class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inicio</span></a>
                <span style='color:white'> / </span>
                <span style='color:white'><span id="opcMenuConfig4">Control de </span>Usuarios</span>
                <?php include('../includes/menuConfig.php'); ?>
            </div>
        </div>
        <div id='lugarAlerta'></div>
        <div id='contenido' class='container'>
            <div class="container">
                <br><span id='tituloPag'>Control de Usuarios</span>
                <ul class="nav nav-tabs tabs">
                    <li class='tabDos'><a id='US-EX' href="#/existente"><span id='tituloTab'>Usuarios</span> Existentes</a></li>
                    <li class='tabUno'><a id='NEW-EX' href="#/nuevo">Nuevo <span id='tituloTab'>Usuario</span></a></li>
                </ul>
            </div>
            <div ng-view>

            </div>
        </div>
        <?php include('../includes/infoSesion.php'); ?>
    </body>

</html>
<?php include('../includes/scripts.php'); ?>