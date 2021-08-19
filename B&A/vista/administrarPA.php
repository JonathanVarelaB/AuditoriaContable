<?php 
    session_start();
    if(!isset($_SESSION['idUsuario']))
        header('Location: ../index.php');
    if(!isset($_SESSION['idContribuyente']) || !isset($_SESSION['idAnnoDeclaracion']))
        header('Location: inicio.php');
?>
<!DOCTYPE html>
<html ng-app='RouteAdministrar'>
    <?php include('../includes/head.php'); ?>
    <body id="bodyExtendido" onload="nobackbutton();">
        <div class="fix1">
            <?php include('../includes/encabezado.php'); ?>
            <div id='ubicacion'>
                <a class="salir" href='inicio.php'><span style='color:#2098D1'><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inicio</span></a>
                <span style='color:white'> / </span>
                <span style='color:white'><span id="opcMenuConfig4">Declaración </span><?php echo $_SESSION['idAnnoDeclaracion']?></span>
                <?php include('../includes/menuConfig.php'); ?>
            </div>
            <div style="background-color: white; width: 100%;">
                <div class='contribuyenteBar' style='width: 100% !important'>
                    <table class='table'>
                        <tr>
                            <td style='padding-top: 15px;'><span id='opcMenuConfig'>Tipo: 
                                <?php 
                                        if($_SESSION['tipoContribuyente'] == '1')
                                            echo 'Físico';
                                        else
                                            echo 'Jurídico';
                                    ?>
                                </span></td>
                            <td style='padding-top: 15px;'><span id='opcMenuConfig'>Identificación: <?php echo $_SESSION['idContribuyente']?></span></td>
                            <td style='padding-top: 15px;'>Nombre: <?php echo $_SESSION['nomContribuyente']?></td>
                            <td><a href="datosPermanentes.php" style='border: 1px solid white;' title='Cuentas de Balance' class='salir btn btn-sm fondoAzul'><span style ='color:white' id='opcMenuConfig'>Cuentas de Balance&nbsp;&nbsp;</span><span style ='color:white' class="glyphicon glyphicon-folder-open"></span></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id='lugarAlerta'></div>
        <div id='contenido' style='min-height: 550px;' class='container'>
            <div class="container" id='controlUsuarios'>
                <br><span id='tituloPag'>Declaración de Período Fiscal <?php echo $_SESSION['idAnnoDeclaracion']?></span><hr>
            </div>
            <div id='contenidoPeriodo' ng-controller="controlDeclaracion">
                <div class='botonesAdministrar'>
                    <center>
                        <div class="btn-group" id="mantenimientoDeclaracion" style="display: none;">
                            <button title='Editar' class='btn btn-sm botonColor' ng-click="editarDeclaracion()" id='editarDA'><span id='opcMenuConfig'>Editar&nbsp;&nbsp;</span><span class="glyphicon glyphicon-edit"></span></button>
                            <button title='Guardar' class='btn btn-sm botonColor' ng-click="guardarDeclaracion()" id='guardarDA'><span id='opcMenuConfig'>Guardar&nbsp;&nbsp;</span><span class="glyphicon glyphicon-floppy-saved"></span></button>
                        </div>
                        <div class="btn-group">
                            <button title='Exportar Excel' class='btn btn-sm botonColor' id='exportarDA'><span id='opcMenuConfig'>Exportar Excel&nbsp;&nbsp;</span><span class="glyphicon glyphicon-save-file"></span></button>
                        </div></center><br>
                </div>
                <div class='table-responsive' id="mostrarDeclaracion">
                </div>
            </div>
        </div>
        <?php include('../includes/infoSesion.php'); ?>
    </body>
</html>
<?php include('../includes/scripts.php'); ?>