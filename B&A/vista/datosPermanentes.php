<?php 
    session_start();
    if(!isset($_SESSION['idUsuario']))
        header('Location: ../index.php');
    if(!isset($_SESSION['idContribuyente']) || !isset($_SESSION['nomContribuyente']) || !isset($_SESSION['tipoContribuyente']))
        header('Location: inicio.php');
?>
<!DOCTYPE html>
<html ng-app="RoutePermanentes">
    <?php include('../includes/head.php'); ?>
    <body id="bodyExtendido">
        <div class="fix1">
            <?php include('../includes/encabezado.php'); ?>
            <div id='ubicacion'>
                <a href='inicio.php'><span style='color:#2098D1'><span id="opcMenuConfig" class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inicio</span></a>
                <span style='color:white'> / </span>
                <span style='color:white'><span id="opcMenuConfig3">Cuentas de </span>Balance</span>
                <?php include('../includes/menuConfig.php'); ?>
            </div>
            <div style="background-color: white; width: 100%;">
                <div class='contribuyenteBar' style='width: 100% !important'>
                    <table class='table'>
                        <tr>
                            <td style='padding-top: 15px;'>
                                <span id='opcMenuConfig'>Tipo: 
                                    <?php 
                                        if($_SESSION['tipoContribuyente'] == '1')
                                            echo 'Físico';
                                        else
                                            echo 'Jurídico';
                                    ?>
                                </span></td>
                            <td style='padding-top: 15px;'>Identificación: <?php echo $_SESSION['idContribuyente']?></td>
                            <td style='padding-top: 15px;'>Nombre: <?php echo $_SESSION['nomContribuyente']?></td>
                            <!--<td><button style='border: 1px solid white;' title='Períodos' class='btn btn-sm fondoAzul emergente' href="#periodosContribuyente"><span style ='color:white' id='opcMenuConfig'>Períodos&nbsp;&nbsp;</span><span style ='color:white' class="glyphicon glyphicon-duplicate"></span></button></td>-->
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id='lugarAlerta'></div>
        <div id='contenido' style='min-height: 590px;' class='container'>
            <div class="container">
                <br><span id='tituloPag'>Cuentas de Balance</span>
                <ul class="nav nav-tabs tabs">
                    <li class='tabUno'><a href="#/">Propiedad, planta y equipo</a></li>
                    <li class='tabDos'><a href="#/pasivo">Documentos y cuentas por pagar</a></li>
                    <li class='tabTres'><a href="#/patrimonio">Patrimonio</span></a></li>
                    <li class='tabCuatro'><a href="#/inversion">Inversiones en acciones</span></a></li>
                </ul>
            </div>
            <div ng-view></div>
        </div>
        <?php include('../includes/infoSesion.php'); ?>
    </body>
</html>
<?php include('../includes/scripts.php'); ?>

<script>
    $(document).ready(function () {
        $('.fixBar').scrollToFixed();
    });
</script>