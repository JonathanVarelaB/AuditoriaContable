<?php 
    session_start();
    if(!isset($_SESSION['idUsuario']))
        header('Location: ../index.php');
    if(!isset($_SESSION['idContribuyente']) || !isset($_SESSION['idPeriodo']))
        header('Location: inicio.php');
?>
<!DOCTYPE html>
<html ng-app="RouteAdministrar">
    <?php include('../includes/head.php'); ?>
    <body id="bodyExtendido">
        <div class="fix1">
            <?php include('../includes/encabezado.php'); ?>
            <div id='ubicacion'>
                <a class="salir" href='inicio.php'><span style='color:#2098D1'><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inicio</span></a>
                <span style='color:white'> / </span>
                <span style='color:white'><span id="opcMenuConfig2">Período </span><?php echo $_SESSION['idAnnoPeriodo']; ?></span>
                <?php include('../includes/menuConfig.php'); ?>
            </div>
            <div style="background-color: white; width: 100%;">
                <div class='contribuyenteBar'>
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
                <div id='menu'>
                    <div style='padding: 8px 0 0 10px'><button id='menuBoton' class='btn btn-sm'><span style='color:white;' class='glyphicon glyphicon-menu-hamburger'></span><span id='menuSpan'>&nbsp;&nbsp;Menú</span></button></div>
                    <div id='navegacion'>
                        <button id='cerrarMenu' class='btn'><span class='glyphicon glyphicon-remove'></span></button>
                        <ul>
                            <a class="salir" href="#/"><li style='text-align: center;font-size: 14px;color:#2098D1;font-style: italic;'>Período <?php echo $_SESSION['idAnnoPeriodo']; ?></li></a>
                            <li class="divisorMenu"></li>
                            <a class="salir" href="#/declaracionAnterior"><li class='elementoMenu'>Declaración Anterior</li></a>
                            <a class="salir" href="#/anticipos"><li class='elementoMenu'>Anticipos de Período</li></a>
                            <a class="salir" href="#/movimientos"><li class='elementoMenu'>Movimientos de Período</li></a>
                            <li class="divisorMenu"></li>
                            <li style='text-align: center;font-style:italic;' class="headerMenu">Reportes</li>
                            <a class="salir" href="#/mensual"><li class='elementoMenu'>Reporte Mensual</li></a>
                            <a class="salir" href="#/estadoResultados"><li class='elementoMenu'>Estado de Resultados</li></a>
                            <a class="salir" href="#/balance"><li class='elementoMenu'>Balance General</li></a>
                            <a class="salir" href="#/porcentuales"><li class='elementoMenu'>Datos Porcentuales</li></a>
                            <a class="salir" href="#/declaracionJurada"><li class='elementoMenu'>Declaración Jurada</li></a>
                            <li class="divisorMenu"></li>
                            <a onclick="alert('Descarga de informe');"><li class='elementoMenu'>Informe Completo</li></a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id='lugarAlerta'></div>
        <div id='contenido' style='min-height: 570px;' class='container'>
            <div id='contenidoDinamico' ng-view>
            </div>
        </div>
        <?php include('../includes/infoSesion.php'); ?>
    </body>
</html>
<?php include('../includes/scripts.php'); ?>