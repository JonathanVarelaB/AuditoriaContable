<?php
session_start();
include('conectorCM/conectorCM.php');


if(isset($_POST['accion']))
{
    if($_POST['accion'] == 'consultar')
    {
        echo funcionObtenerDolar();
        exit;
    }
    if($_POST['accion'] == 'editar')
    {
        /*$arreglo = array($_POST['monto']);
        if(funcionEditarDolar($arreglo))
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Dolár','Modificado','Nuevo monto: '.$_POST['monto'].' colones',$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';*/
        $band = funcionEditarDolar($_POST['monto']);
        if($band === '1'){
            
            $periodos = funcionPeriodosAbiertosTODOS();
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    funcionActualizarDolarPeriodo(array($_POST['monto'],$periodos[$i]));
                }
            }
            
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Dólar','Modificado','Nuevo monto: '.filterMoney('0',$_POST['monto']),$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
}