<?php
session_start();
include "../../modelo/conexionBD.php";
include "../../modelo/consultasBD.php";

$conexion = conectar();
    $ingresos = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
    $gastos = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
    $annoPeriodo = substr($_SESSION['idAnnoPeriodo'],2); 
    $dolarPeriodo = intval(funcionObtenerDolarPeriodo(array($_SESSION['idPeriodo'])));
    $res = '<table class="table table-condensed table-bordered table-hover mensual" style="font-size: 12px;color: black;">
            <thead>
                <tr class="fondoAzul">
                    <th colspan="2"></th>
                    <th><center>Octubre '.(intval($annoPeriodo)-1).'</center></th>
                    <th><center>Noviembre '.(intval($annoPeriodo)-1).'</center></th>
                    <th><center>Diciembre '.(intval($annoPeriodo)-1).'</center></th>
                    <th><center>Enero '.$annoPeriodo.'</center></th>
                    <th><center>Febrero '.$annoPeriodo.'</center></th>
                    <th><center>Marzo '.$annoPeriodo.'</center></th>
                    <th><center>Abril '.$annoPeriodo.'</center></th>
                    <th><center>Mayo '.$annoPeriodo.'</center></th>
                    <th><center>Junio '.$annoPeriodo.'</center></th>
                    <th><center>Julio '.$annoPeriodo.'</center></th>
                    <th><center>Agosto '.$annoPeriodo.'</center></th>
                    <th><center>Setiembre '.$annoPeriodo.'</center></th>
                    <th id="totalTD"><center>TOTAL</center></th>
                </tr>
            </thead>
            <tbody>
                <tr style="background-color:#ccc;">
                    <th colspan="2" ><center>INGRESOS</center></th>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style="border-right:1px solid black;"></td><td id="totalTD"></td>
                </tr>';
    foreach ($conexion->query(consultaObtenerCuentasContables('4-')) as $rows) {
        $movimientos = funcionObtenerMovimientosCuentaPeriodo($_SESSION['idPeriodo'],$rows['codigo']);
        $cantMov = count($movimientos);
        if($cantMov > 0){
            for($i = 0;$i < $cantMov; $i++){
                if($movimientos[$i]['moneda'] === '1')
                    $movimientos[$i]['monto'] = intval($movimientos[$i]['monto']) * $dolarPeriodo;
            }
            
            $res.= '<tr>';
            $res.= '<td>'.$rows['codigo'].'</td>';
            $res.= '<td>'.$rows['nombre'].'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,(intval($annoPeriodo)-1).'-10');$ingresos[0] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,(intval($annoPeriodo)-1).'-11');$ingresos[1] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,(intval($annoPeriodo)-1).'-12');$ingresos[2] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-01');$ingresos[3] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-02');$ingresos[4] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-03');$ingresos[5] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-04');$ingresos[6] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-05');$ingresos[7] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-06');$ingresos[8] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-07');$ingresos[9] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-08');$ingresos[10] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-09');$ingresos[11] += $monto;
            $res.= '<td style="text-align:right;border-right:1px solid black;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionTotalCuenta($movimientos, $cantMov);$ingresos[12] += $monto;
            $res.= '<td id="totalTD" style="text-align:right;background-color:#E6E6E6;">'. filterMoney('0', $monto) .'</td>';
            $res.= '</tr>';
        }
    }
    $res .= '<tr id="totalTR">
                <th colspan="2">Total de Ingresos</th>';
                for($i = 0;$i < 11; $i++){
                   $res .= '<td style="text-align:right;">'.filterMoney('0', $ingresos[$i]).'</td>';
                }
        $res .= '<td style="text-align:right;border-right:1px solid black;">'.filterMoney('0', $ingresos[11]).'</td>
                <td id="totalTD" style="text-align:right;background-color:#E6E6E6;">'.filterMoney('0', $ingresos[12]).'</td>
            </tr>
            <tr style="background-color:#ccc;">
                <th colspan="2"><center>GASTOS</center></th>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style="border-right:1px solid black;"></td><td id="totalTD"></td>
            </tr>';
        
    foreach ($conexion->query(consultaObtenerCuentasContables('5-')) as $rows) {
        $movimientos = funcionObtenerMovimientosCuentaPeriodo($_SESSION['idPeriodo'],$rows['codigo']);
        $cantMov = count($movimientos);
        if($cantMov > 0){
            for($i = 0;$i < $cantMov; $i++){
                if($movimientos[$i]['moneda'] === '1')
                    $movimientos[$i]['monto'] = intval($movimientos[$i]['monto']) * $dolarPeriodo;
            }
            
            $res.= '<tr>';
            $res.= '<td>'.$rows['codigo'].'</td>';
            $res.= '<td>'.$rows['nombre'].'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,(intval($annoPeriodo)-1).'-10');$gastos[0] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,(intval($annoPeriodo)-1).'-11');$gastos[1] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,(intval($annoPeriodo)-1).'-12');$gastos[2] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-01');$gastos[3] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-02');$gastos[4] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-03');$gastos[5] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-04');$gastos[6] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-05');$gastos[7] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-06');$gastos[8] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-07');$gastos[9] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-08');$gastos[10] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-09');$gastos[11] += $monto;
            $res.= '<td style="text-align:right;border-right:1px solid black;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionTotalCuenta($movimientos, $cantMov);$gastos[12] += $monto;
            $res.= '<td id="totalTD" style="text-align:right;background-color:#E6E6E6;">'. filterMoney('0', $monto) .'</td>';
            $res.= '</tr>';
        }
    }/*
    foreach ($conexion->query(consultaObtenerCuentasContables('6-')) as $rows) {
        $movimientos = funcionObtenerMovimientosCuentaPeriodo($_SESSION['idPeriodo'],$rows['codigo']);
        $cantMov = count($movimientos);
        if($cantMov > 0){
            for($i = 0;$i < $cantMov; $i++){
                if($movimientos[$i]['moneda'] === '1')
                    $movimientos[$i]['monto'] = intval($movimientos[$i]['monto']) * $dolarPeriodo;
            }
            
            $res.= '<tr>';
            $res.= '<td>'.$rows['codigo'].'</td>';
            $res.= '<td>'.$rows['nombre'].'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,(intval($annoPeriodo)-1).'-10');$gastos[0] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,(intval($annoPeriodo)-1).'-11');$gastos[1] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,(intval($annoPeriodo)-1).'-12');$gastos[2] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-01');$gastos[3] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-02');$gastos[4] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-03');$gastos[5] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-04');$gastos[6] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-05');$gastos[7] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-06');$gastos[8] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-07');$gastos[9] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-08');$gastos[10] += $monto;
            $res.= '<td style="text-align:right;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionMontoMensual($movimientos, $cantMov,$annoPeriodo.'-09');$gastos[11] += $monto;
            $res.= '<td style="text-align:right;border-right:1px solid black;">'. filterMoney('0', $monto) .'</td>';
            $monto = funcionTotalCuenta($movimientos, $cantMov);$gastos[12] += $monto;
            $res.= '<td id="totalTD" style="text-align:right;background-color:#E6E6E6;">'. filterMoney('0', $monto) .'</td>';
            $res.= '</tr>';
        }
    }
    $depreciacion = funcionObtenerDepreciacionPeriodo($_SESSION['idPeriodo']);*/
    
    $res .= '<tr id="totalTR">
                <th colspan="2">Total de Gastos</th>';
                for($i = 0;$i < 11; $i++){
                   $res .= '<td style="text-align:right;">'.filterMoney('0', $gastos[$i]).'</td>';
                }
    $res .= '<td style="text-align:right;border-right:1px solid black;">'.filterMoney('0', $gastos[11]).'</td>
                <td id="totalTD" style="text-align:right;background-color:#E6E6E6;">'.filterMoney('0', $gastos[12]).'</td></tr>';//+$depreciacion).'</td></tr>';
    $res .= '<tr style="background-color:#ccc;">
                <th colspan="2"><center>UTILIDAD</center></th>';
                for($i = 0;$i < 11; $i++){
                   $res .= '<td style="text-align:right;">'.filterMoney('0', $ingresos[$i]-$gastos[$i]).'</td>';
                }
         $res .='<td style="border-right:1px solid black;text-align:right;">'.filterMoney('0', $ingresos[11]-$gastos[11]).'</td>
                <td id="totalTD" style="text-align:right;">'.filterMoney('0', $ingresos[12]-($gastos[12])).'</td></tr></tbody></table>';//+$depreciacion)).'</td></tr></tbody></table>';
    
    echo utf8_decode($res);

//------------------------------------------REPORTE MENSUAL
function funcionObtenerMovimientosCuentaPeriodo($idPeriodo,$codCuenta){
    $conexion = conectar();
    $res = array();
    $i = 0;
    foreach ($conexion->query(consultaObtenerMovimientosCuentaPeriodo($idPeriodo,$codCuenta)) as $rows) {
        $res[$i] = array('monto' => $rows['monto'],'moneda' => $rows['moneda'],'fecha' => substr($rows['fecha'],2,5));
        $i++;
    }
    desconectar($conexion);
    return $res;
}
function funcionObtenerDolarPeriodo($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerDolarPeriodo(), $conexion, $arreglo)['dolar'];
    desconectar($conexion);
    return $res;
}
function funcionMontoMensual($arreglo,$cantArreglo,$mes){
    $total = 0;
    for($i = 0;$i < $cantArreglo; $i++){
        if($arreglo[$i]['fecha'] === $mes){
            $total += $arreglo[$i]['monto'];
        }
    }
    return $total;
}
function funcionTotalCuenta($arreglo,$cantArreglo){
    $total = 0;
    for($i = 0;$i < $cantArreglo; $i++){
        $total += $arreglo[$i]['monto'];
    }
    return $total;
}
function funcionObtenerDepreciacionPeriodo($idPeriodo){
    $conexion = conectar();
    $total = 0;
    foreach ($conexion->query(consultaObtenerDepreciacionPeriodo($idPeriodo)) as $rows) {
        $total += $rows['depreciacionPeriodo'];
    }
    desconectar($conexion);
    return $total;
}

desconectar($conexion);