<?php 
    session_start();
    if(!isset($_SESSION['idUsuario']))
        header('Location: ../index.php');
?>
<!DOCTYPE html>
<html ng-app="RouteContribuyente">
    <?php include('../includes/head.php'); ?>
    <body id="bodyNormal">
        <div class="fix1">
            <?php include('../includes/encabezado.php'); ?>
            <div id='ubicacion' class='navbar-static-top'>
                <span style='color:white'><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inicio</span>
                <?php include('../includes/menuConfig.php'); ?>
            </div>
        </div>
        <div id='lugarAlerta'></div>
        <div id='contenido' class='container'>
            <div class="container">
                <br><span id='tituloPag'>Control de Contribuyentes</span>
                <ul class="nav nav-tabs tabs">
                    <li class='tabDos'><a href="#/existente"><span id='tituloTab'>Contribuyentes</span> Existentes</a></li>
                    <li class='tabUno'><a href="#/nuevo">Nuevo <span id='tituloTab'>Contribuyente</span></a></li>
                    <li class='tabTres'><a href="#/rangoImpuesto">Rango <span id='tituloTab'>del Impuesto de Venta</span></a></li>
                </ul>
            </div>
            <div ng-view>
            </div>
        </div>
        <?php include('../includes/infoSesion.php'); ?>
    </body>

</html>
<?php include('../includes/scripts.php'); ?>
