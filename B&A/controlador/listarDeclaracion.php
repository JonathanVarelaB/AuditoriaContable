<?php
session_start();
include "../controlador/conectorCM/conectorCM.php";

$conexion = conectar();
$res = '<table class="table table-condensed table-hover decAnt">'
        . '<tr><th colspan="2" class="fondoAzul">I. ACTIVOS Y PASIVOS</th></tr>';
foreach ($conexion->query(consultaDeclaracionAnterior($_SESSION['idContribuyente'],$_SESSION['idAnnoDeclaracion'])) as $rows) {
    if($rows['idAspecto'] == 27)
        $res .= '<tr><th colspan="2" class="fondoAzul">II. INGRESOS</th></tr>';
    if($rows['idAspecto'] == 36)
        $res .= '<tr><th colspan="2" class="fondoAzul">III. COSTOS, GASTOS Y DEDUCCIONES</th></tr>';
    if($rows['idAspecto'] == 46)
        $res .= '<tr><th colspan="2" class="fondoAzul">IV. BASE IMPONIBLE RENTA GRAVABLE</th></tr>';
    /*if($rows['idAspecto'] == 58)
        $res .= '<tr><th colspan="2" class="fondoAzul">V. CRÉDITOS</th></tr>';
    if($rows['idAspecto'] == 84)
        $res .= '<tr><th colspan="2" class="fondoAzul">VI. LIQUIDACIÓN DEUDA TRIBUTARIA</th></tr>';*/
    $res .= '<tr><td>'.utf8_decode(funcionObtenerNombreAspectoDeclaracion(array($rows['idAspecto']))).'</td><td><input class="aspectoDeclaracion" id="aspectoDJ'.$rows['idAspecto'].'" name="'.$rows['idAspecto'].'" style="min-width:200px;" type=number  step="any" disabled value="'.$rows['monto'].'"/></td></tr>';
}
desconectar($conexion);
echo $res.'</table>';