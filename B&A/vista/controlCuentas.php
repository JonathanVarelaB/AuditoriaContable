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
<html ng-app='moduleCuentas'>
    <?php include('../includes/head.php'); ?>
    <body id="bodyNormal">
        <div class="fix1">
            <?php include('../includes/encabezado.php'); ?>
            <div id='ubicacion'>
                <a href='inicio.php'><span style='color:#2098D1'><span id='opcMenuConfig' class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Inicio</span></a>
                <span style='color:white'> / </span>
                <span style='color:white'>Cuentas<span id="opcMenuConfig3"> Contables</span></span>
                <?php include('../includes/menuConfig.php'); ?>
            </div>
        </div>
        <div id='lugarAlerta' ></div>
        <div id='contenido' class='container'>
            <div class="container" id='controlUsuarios'>
                <br><span id='tituloPag'>Cuentas Contables</span><hr>
            </div>
            <div id='usuarioExistente'>
                <div class='botonesAdministrar'>
                    <center> <div class="btn-group" id='botonesCuentas'>
                            <button title='Editar Cuenta' class='btn btn-sm botonColor emergente menuCUExistente' id='editarC' href='#editarCuenta'>
                                <span id="opcMenuConfig">Editar&nbsp;&nbsp;</span>
                                <span class="glyphicon glyphicon-edit"></span>
                            </button>
                            <button class="btn btn-sm botonColor emergente menuCUExistente" id="hab-desC" href="#hab-desCuenta">
                                <span id="opcMenuConfig" class="condicionBoton"></span>&nbsp;&nbsp
                                <span id="condiciongly"></span>
                            </button>
                            <button title='Agregar Cuenta' class='btn btn-sm botonColor emergente' id='agregarC' href="#agregarCuenta">
                                <span id="opcMenuConfig">Agregar Cuenta&nbsp;&nbsp;</span>
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div></center><br><br>
                </div><center>
                    <div style="max-width: 700px !important;" class="table-responsive" ng-controller="controlCuentas">
                        <?php include('emergentes/emergentesCuentas.php'); ?>
                    <div id="divMostrarCuentas"></div>
                    <button id="refrescarTablaCuentas" type="button" style="visibility: hidden;"></button>
                </div></center>
            </div>
        </div>
        <?php include('../includes/infoSesion.php'); ?>
    </body>

</html>
<?php include('../includes/scripts.php'); ?>
