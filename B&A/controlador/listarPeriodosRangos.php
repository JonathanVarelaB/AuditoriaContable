<?php
session_start();
include "../modelo/conexionBD.php";
include "../modelo/consultasBD.php";

if($_POST['accion'])
{
    if($_POST['accion'] == 'listarPeriodoRangos'){
        $conexion = conectar();
        $i = 0;
        $res = '';
        foreach ($conexion->query(consultaListarPeriodosRangos($_POST['tipo'])) as $rows) {
            $res .= '<option value="'.$rows['anno'].'">'.$rows['anno'].'</option>';
            $i ++;
        }
        if($i == 0)
            $resFinal = '<option value="0">Ninguno</option>';
        else
            $resFinal = '<option value="0">Seleccione</option>'.$res;
        echo utf8_decode($resFinal);
        desconectar($conexion);
        exit;
    }
    
    if($_POST['accion'] == 'consultarRangosPeriodos'){
        $conexion = conectar();
        $res = [];
        $i = 0;
        foreach ($conexion->query(consultaListarPeriodosRangos($_POST['tipo'])) as $rows) {
            $res[$i] = $rows['anno'];
            $i++;
        }
        echo json_encode($res);
        desconectar($conexion);
        exit;
    }
}