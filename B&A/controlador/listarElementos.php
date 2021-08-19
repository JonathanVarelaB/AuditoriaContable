<?php

include "../modelo/conexionBD.php";
include "../modelo/consultasBD.php";

$conexion = conectar();
$res = '<option value="0">Seleccione</option>';
foreach ($conexion->query(consultaListarTipoActivo()) as $rows) {
    $res .= '<option value="'.$rows['identificador'].'">'.$rows['nombre'].'</option>';
}
desconectar($conexion);
echo utf8_decode($res);