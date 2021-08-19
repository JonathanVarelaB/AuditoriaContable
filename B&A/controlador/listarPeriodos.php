<?php
session_start();
include "../modelo/conexionBD.php";
include "../modelo/consultasBD.php";


$_SESSION['idContribuyente'] = $_POST['idActual'];
$_SESSION['nomContribuyente'] = $_POST['nomActual'];
$_SESSION['tipoContribuyente'] = $_POST['tipoActual'];

$conexion = conectar();
$res = '';
foreach ($conexion->query(consultaObtenerPeriodosCliente($_SESSION['idContribuyente'])) as $rows) {
    $anno = $rows['anno'];
    $res .= "<a type='button' class='btn botonColor' onclick='periodo_Declaracion($anno)'>$anno</a>";
}
desconectar($conexion);
echo $res;