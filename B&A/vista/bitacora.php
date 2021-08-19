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
<html ng-app="moduleBitacora">
    <?php include('../includes/head.php'); ?>
    <body id="bodyNormal">
        <div class="fix1">
            <?php include('../includes/encabezado.php'); ?>
            <div id='ubicacion'>
                <a href='inicio.php'><span style='color:#2098D1'><span id='opcMenuConfig3' class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inicio</span></a>
                <span style='color:white'> / </span>
                <span style='color:white'>Bitácora</span>
                <?php include('../includes/menuConfig.php'); ?>
            </div>
        </div>
        <div id='contenido' class='container'>
            <div class="container" id='controlUsuarios'>
                <br><span id='tituloPag'>Bitácora</span><hr>
            </div>
            <div id='bitacora' ng-controller="controlBitacora">
                <div id="contenidoPeriodoAmpliado" class='table-responsive'>
                    <div id="divMostrarBitacora"></div>
                    <button id="refrescarTablaBitacora" type="button" style="visibility: hidden;"></button>
                </div>
            </div>
        </div>
        <?php include('../includes/infoSesion.php'); ?>
    </body>
</html>
<?php include('../includes/scripts.php'); ?>