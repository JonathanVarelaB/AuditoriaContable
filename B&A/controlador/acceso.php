<?php

session_start();
include('conectorCM/conectorCM.php');

if (isset($_POST['accion'])) {
    if ($_POST['accion'] == 'acceso') {
        $arreglo = array($_POST['usuario'], $_POST['contrasena']);
        $datos = funcionAccesoUsuario($arreglo);
        if ($datos) {//existe el Usuario
            extract($datos);
            if ($estado == 1) { //usuario habilitado
                iniciarSesion($identificador, $nombreUsuario, $nombreCompleto, $email,$contrasena, $tipo, $revisar, $aprobar, $editar);
                $fecha = getdate();
                funcionAgregarBitacora(
                        array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                            " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                            'Usuario','Inicio Sesión','No indicado',$_SESSION['idUsuario'])
                        );
                echo '1';
                exit;
            } else {//usuario deshabilitado
                echo '0';
                exit;
            }
        } else {//no existe el Usuario u olvido contraseña
            echo '2';
            exit;
        }
    }
    if ($_POST['accion'] == 'salir') {
        cerrarSesion();
        header('Location: ../index.php');
        exit;
    }
} else {
    header('Location: ../index.php');
}

function iniciarSesion($identificador, $nombreUsuario, $nombreCompleto, $email,$contraseña, $tipo, $revisar, $aprobar, $editar) {
    $_SESSION['idUsuario'] = $identificador;
    $_SESSION['nombreUsuario'] = $nombreUsuario;
    $_SESSION['nombreCompleto'] = $nombreCompleto;
    $_SESSION['emailUsuario'] = $email;
    $_SESSION['contraseña'] = $contraseña;
    $_SESSION['tipoUsuario'] = $tipo;
    $_SESSION['revisarUsuario'] = $revisar;
    $_SESSION['aprobarUsuario'] = $aprobar;
    $_SESSION['editarUsuario'] = $editar;
    $fecha = getdate();
    $_SESSION['fechaUsuario'] = $fecha["mday"]." / ".$fecha["mon"]." / ".$fecha["year"];
}

function cerrarSesion() {
    unset($_SESSION['idUsuario']);
    unset($_SESSION['nombreUsuario']);
    unset($_SESSION['nombreCompleto']);
    unset($_SESSION['emailUsuario']);
    unset($_SESSION['contraseña']);
    unset($_SESSION['tipoUsuario']);
    unset($_SESSION['revisarUsuario']);
    unset($_SESSION['aprobarUsuario']);
    unset($_SESSION['editarUsuario']);
    unset($_SESSION['fechaUsuario']);
    
    unset($_SESSION['idContribuyente']);
    unset($_SESSION['nomContribuyente']);
    unset($_SESSION['tipoContribuyente']);
    unset($_SESSION['impuestoRentaContribuyente']);
    
    unset($_SESSION['idPeriodo']);
    unset($_SESSION['idAnnoPeriodo']);
    unset($_SESSION['idAnnoDeclaracion']);
    unset($_SESSION['cierrePeriodo']);
    unset($_SESSION['estadoPeriodo']);
    unset($_SESSION['creadorPeriodo']);
    unset($_SESSION['revisarPeriodo']);
    unset($_SESSION['aprobarPeriodo']);
    session_destroy();
}
