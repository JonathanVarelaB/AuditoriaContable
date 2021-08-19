<?php
session_start();
include "../../modelo/conexionBD.php";
include "../../modelo/consultasBD.php";

$conexion = conectar();
    $periodo = $_SESSION['idPeriodo']; 
    $res = '<table class="table table-condensed table-hover decAnt" style="font-size: 12px;color: black;">
             <tr><th colspan="3" class="fondoAzul">ACTIVOS</th></tr><tr style="background-color:#E6E6E6;"><th>Activos Circulantes</th><td></td><td></td></tr>';
    
			$cuentasDocumentosPorPagar= funcionObtenerSaldoPasivos($periodo);
			$capitalSocial= funcionObtenerMontoPatrimonios($periodo);  
			$propiedadPlantaEquipo= funcionObtenerMontoActivos($periodo);
			$depreciacionAcumulada= funcionObtenerDepreciacionAcumulada($periodo);
			$totalActivosNoCirculantes= $propiedadPlantaEquipo+$depreciacionAcumulada;
			$inversionesAcciones= funcionObtenerMontoInversiones($periodo);
			$anticiposImpuesto= funcionObtenerMontoAnticipos($periodo);
            $cajaBancosCuentas= $cuentasDocumentosPorPagar+$capitalSocial-$totalActivosNoCirculantes-$inversionesAcciones-$anticiposImpuesto;
			
    $res .= '<tr><td>Caja-Bancos-Cuentas por Cobrar</td><td style="text-align:right;">'. filterMoney('0',$cajaBancosCuentas).'</td><td></td></tr>';
            
    $res .= '<tr><td><a style="text-decoration:none;color: black;" href="datosPermanentes.php#/inversion">Inversiones en Acciones</a></td><td style="text-align:right;">'. filterMoney('0',$inversionesAcciones).'</td><td></td></tr>';
            
    $res .= '<tr><td><a style="text-decoration:none;color: black;" href="administrar.php#/anticipos">Anticipos del Impuesto sobre la Renta</a></td><td style="text-align:right;">'. filterMoney('0',$anticiposImpuesto).'</td><td></td></tr>';
            
            $totalActivosCirculantes= $cajaBancosCuentas+$inversionesAcciones+$anticiposImpuesto;
    $res .= '<tr id="totalTR"><th>Total de Activos Circulantes</th><td></td><th style="text-align:right;">'. filterMoney('0',$totalActivosCirculantes).'</th></tr>
            <tr style="background-color:#E6E6E6;"><th>Activos No Circulantes</th><td></td><td></td></tr>';
    
    $res .= '<tr><td><a style="text-decoration:none;color: black;" href="datosPermanentes.php">Propiedad, Planta y Equipo</a></td><td style="text-align:right;">'. filterMoney('0',$propiedadPlantaEquipo).'</td><td></td></tr>';
            
    $res .= '<tr><td><a style="text-decoration:none;color: black;" href="datosPermanentes.php">Depreciaci&oacute;n Acumulada</a></td><td style="text-align:right;">'. filterMoney('0',$depreciacionAcumulada).'</td><td></td></tr>';
            
    $res .= '<tr id="totalTR"><th>Total de Activos No Circulantes</th><td></td><th style="text-align:right;">'. filterMoney('0',$totalActivosNoCirculantes).'</th></tr>';
            
            $totalActivos= $totalActivosCirculantes+$totalActivosNoCirculantes;
    $res .= '<tr style="background-color:#ccc;"><th>TOTAL DE ACTIVOS</th><td></td><th style="text-align:right;">'. filterMoney('0',$totalActivos).'</th></tr>
            <tr><th colspan="3" class="fondoAzul">PASIVOS Y PATRIMONIO</th></tr><tr style="background-color:#E6E6E6;"><th>Pasivos</th><td></td><td></td></tr>';
    
    $res .= '<tr><td><a style="text-decoration:none;color: black;" href="datosPermanentes.php#/pasivo">Cuentas y Documentos por Pagar</a></td><td style="text-align:right;">'. filterMoney('0',$cuentasDocumentosPorPagar).'</td><td></td></tr>';
    
            $impuestoRenta= $_SESSION['impuestoRentaContribuyente'];
    $res .= '<tr><td>Impuesto sobre la Renta</td><td style="text-align:right;">'. filterMoney('0',$impuestoRenta).'</td><td></td></tr>';
    
            $totalPasivos= $cuentasDocumentosPorPagar+$impuestoRenta;
    $res .= '<tr id="totalTR"><th>Total de Pasivos</th><td></td><th style="text-align:right;">'. filterMoney('0',$totalPasivos).'</th></tr>
            <tr style="background-color:#E6E6E6;"><th>Patrimonio</th><td></td><td></td></tr>';
    
    $res .= '<tr><td><a style="text-decoration:none;color: black;" href="datosPermanentes.php#/patrimonio">Capital Social</a></td><td style="text-align:right;">'. filterMoney('0',$capitalSocial).'</td><td></td></tr>';
    
            $utilidadesRetenidas= 0;  
    $res .= '<tr><td>Utilidades Retenidas</td><td style="text-align:right;">'. filterMoney('0',$utilidadesRetenidas).'</td><td></td></tr>';
    
            $utilidadesNetasPeriodo= 0;  
    $res .= '<tr><td>Utilidades Netas del Per&iacute;odo</td><td style="text-align:right;">'. filterMoney('0',$utilidadesNetasPeriodo).'</td><td></td></tr>';
    
            $totalPatrimonio= $capitalSocial+$utilidadesRetenidas+$utilidadesNetasPeriodo;
    $res .= '<tr id="totalTR"><th>Total de Patrimonio</th><td></td><th style="text-align:right;">'. filterMoney('0',$totalPatrimonio).'</th></tr>';
    
            $pasivoPatrimonio= $totalPasivos+$totalPatrimonio;
    $res .= '<tr id="totalTR" style="background-color:#ccc;"><th>PASIVOS + PATRIMONIO</th><td></td><th style="text-align:right;">'. filterMoney('0',$pasivoPatrimonio).'</th></tr>
    </table>';
    
    echo utf8_decode($res);  
    
function funcionObtenerMontoInversiones($idPeriodo){
    $conexion = conectar();
    $total = 0;
    foreach ($conexion->query(consultaObtenerMontoInversiones($idPeriodo)) as $rows) {
        $total += $rows['monto'];
    }
    desconectar($conexion);
    return $total;
}
function funcionObtenerMontoPatrimonios($idPeriodo){
    $conexion = conectar();
    $total = 0;
    foreach ($conexion->query(consultaObtenerMontoPatrimonios($idPeriodo)) as $rows) {
        $total += $rows['monto'];
    }
    desconectar($conexion);
    return $total;
}
function funcionObtenerMontoAnticipos($idPeriodo){
    $conexion = conectar();
    $total = 0;
    foreach ($conexion->query(consultaObtenerMontoAnticipos($idPeriodo)) as $rows) {
        $total += $rows['monto'];
    }
    desconectar($conexion);
    return $total;
}
function funcionObtenerMontoActivos($idPeriodo){
    $conexion = conectar();
    $total = 0;
    foreach ($conexion->query(consultaObtenerMontoActivos($idPeriodo)) as $rows) {
        $total += $rows['monto'];
    }
    desconectar($conexion);
    return $total;
}
function funcionObtenerSaldoPasivos($idPeriodo){
    $conexion = conectar();
    $total = 0;
    foreach ($conexion->query(consultaObtenerSaldoPasivos($idPeriodo)) as $rows) {
        $total += $rows['saldo'];
    }
    desconectar($conexion);
    return $total;
}
function funcionObtenerDepreciacionAcumulada($idPeriodo){
    $conexion = conectar();
    $total = 0;
    foreach ($conexion->query(consultaObtenerDepreciacionAcumulada($idPeriodo)) as $rows) {
        $total += $rows['depreciacionAcumulada'];
    }
    desconectar($conexion);
    return $total;
}
desconectar($conexion);