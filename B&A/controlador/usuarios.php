<?php
session_start();
include('conectorCM/conectorCM.php');

if(isset($_POST['accion']))
{
    if($_POST['accion'] == 'nuevoU')
    {
        $arreglo = array($_POST['nombreUsuario'],$_POST['nombreCompleto'],
            $_POST['emailUsuario'],generarContraseña(),$_POST['tipoUsuario'],
            $_POST['permRevisar'],$_POST['permAprobar'],$_POST['permEditar']);
        if(funcionAgregarUsuario($arreglo))
        {
            //enviarCorreo con contraseña y usuario
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Usuario','Agregado','Nombre: '.$_POST['nombreCompleto'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'editarU')
    {
        $arreglo = array($_POST['nombreUsuario'],$_POST['nombreCompleto'],
            $_POST['emailUsuario'],$_POST['tipoUsuario'],
            $_POST['permRevisar'],$_POST['permAprobar'],$_POST['permEditar'],
            $_POST['idUsuario']);
        if(funcionEditarUsuario($arreglo))
        {
            if($_POST['nombreUsuarioActual'] !== $_POST['nombreUsuario'])
            {
               //enviarCorreo con usuario nuevo
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Usuario','Modificado','Nombre: '.$_POST['nombreCompleto'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'deshabilitarU')
    {
        $arreglo = array($_POST['idUsuario']);
        if(funcionDeshabilitarUsuario($arreglo))
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Usuario','Deshabilitado','Nombre: '.$_POST['nombreCompleto'],$_SESSION['idUsuario'])
                );
            echo '2';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'habilitarU')
    {
        $arreglo = array($_POST['idUsuario']);
        if(funcionHabilitarUsuario($arreglo))
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Usuario','Habilitado','Nombre: '.$_POST['nombreCompleto'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'cambioContraseña')
    {
        $usuario = $_SESSION['idUsuario'];
        $arreglo = array($usuario);
        if(funcionObtenerContraseñaUsuario($arreglo) === $_POST['contActual'])
        {
            $arreglo = array($_POST['contNueva'],$usuario);
            if(funcionCambioContraseñaUsuario($arreglo))
            {
                //enviarCorreo con contraseña nueva y usuario
                echo '1'; //exitoso
            }
            else
                echo '0'; //ocurrio un error con la BD
        }
        else
            echo '2'; //la contraseña actual es incorrecta
        exit;
    }
    
    if ($_POST['accion'] == 'recuperar') 
    {
        $arreglo = array($_POST['usuario']);
        $email = funcionObtenerEmailUsuario($arreglo);
        if ($_POST['email'] === $email)  //los datos ingresados son correctos
        {
            $arreglo = array(generarContraseña(),$_POST['usuario'],$_POST['email']);
            if (funcionRecuperarClave($arreglo)) //cambiar clave
            {  
                //enviarCorreo con contraseña nueva
                echo '1'; //exitoso
            } 
            else 
                echo '0'; //ocurrio un error con la BD
        }
        else 
            echo '2';//datos incorrectos
        exit;
    }
}