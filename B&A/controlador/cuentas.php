<?php
session_start();
include('conectorCM/conectorCM.php');


if(isset($_POST['accion']))
{
    if($_POST['accion'] == 'nuevaC')
    {
        $arreglo = array($_POST['codigo'],$_POST['nombre']);
        if(funcionAgregarCuenta($arreglo))
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Cuenta','Agregada','Código: '.$_POST['codigo'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'editarC')
    {
        $arreglo = array($_POST['codigo'],$_POST['nombre'],$_POST['codigoActual']);
        if(funcionEditarCuenta($arreglo))
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Cuenta','Modificada','Código: '.$_POST['codigo'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'habilitarC')
    {
        $arreglo = array($_POST['codigo']);
        if(funcionHabilitarCuenta($arreglo))
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Cuenta','Habilitada','Código: '.$_POST['codigo'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'deshabilitarC')
    {
        $arreglo = array($_POST['codigo']);
        if(funcionDeshabilitarCuenta($arreglo))
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Cuenta','Deshabilitada','Código: '.$_POST['codigo'],$_SESSION['idUsuario'])
                );
            echo '2';
        }
        else
            echo '0';
        exit;
    }
}