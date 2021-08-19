<?php 
session_start();
include "../controlador/conectorCM/conectorCM.php";

if(isset($_POST['accion']))
{
    if($_POST['accion'] == 'guardarAspectos')
    {
        $arreglo = $_POST['aspectos'];
        $band = true;
        foreach ($arreglo as $item => $value){
            if($value != '')
                $band *= funcionEditarDeclaracion(array($value,$_SESSION['idContribuyente'],$item,$_SESSION['idAnnoDeclaracion']));
        }
        if($band)
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Declaración Jurada','Modificada','Cliente: '.$_SESSION['nomContribuyente'].', Año:'.$_SESSION['idAnnoDeclaracion'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'consultarPeriodo')
    {
        $arreglo = array($_SESSION['idAnnoDeclaracion'],$_SESSION['idContribuyente']);
        if(funcionEsPeriodo($arreglo) != '')
            echo '1';
        else
            echo '0';
        exit;
    }
}