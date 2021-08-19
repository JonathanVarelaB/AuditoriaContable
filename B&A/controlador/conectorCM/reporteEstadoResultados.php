<?php
session_start();
include "../../modelo/conexionBD.php";
include "../../modelo/consultasBD.php";

$conexion = conectar();
    $dolarPeriodo = intval(funcionObtenerDolarPeriodo(array($_SESSION['idPeriodo'])));
    $res = '<table class="table table-condensed table-hover decAnt" style="font-size: 12px;color: black;">
            <tr><th colspan="3" class="fondoAzul">INGRESOS</th></tr>';
    
            $totalIngresos = funcionObtenerMontoCuentaPrincipalPeriodo($_SESSION['idPeriodo'], '4-01-', $dolarPeriodo);
    $res .= '<tr><td>Ingresos por Operaciones</td><td style="text-align:right;">'. filterMoney('0',$totalIngresos).'</td><td></td></tr>
            <tr id="totalTR" style="background-color:#E6E6E6;"><th>Total de Ingresos</th><td></td><th style="text-align:right;">'. filterMoney('0',$totalIngresos).'</th></tr>
            <tr><th colspan="3" class="fondoAzul">COSTOS, GASTOS Y DEDUCCIONES</th></tr>';
    
            $inventarioInicial = funcionObtenerMontoCuentaPrincipalPeriodo($_SESSION['idPeriodo'], '6-01-01', $dolarPeriodo);
    $res .= '<tr><td>Inventarios Inicial</td><td style="text-align:right;">'. filterMoney('0',$inventarioInicial).'</td><td></td></tr>';
    
            $compras = funcionObtenerMontoCuentaPrincipalPeriodo($_SESSION['idPeriodo'], '6-01-02', $dolarPeriodo);
    $res .= '<tr><td>Compras</td><td style="text-align:right;">'. filterMoney('0',$compras).'</td><td></td></tr>';
    
            $inventarioFinal = funcionObtenerMontoCuentaPrincipalPeriodo($_SESSION['idPeriodo'], '6-01-03', $dolarPeriodo);
    $res .= '<tr><td>Inventarios Final</td><td style="text-align:right;">'. filterMoney('0',$inventarioFinal).'</td><td></td></tr>';
    
            $costoDeVentas = $inventarioInicial+$compras-$inventarioFinal;
    $res .= '<tr><td>Costo de Ventas</td><td style="text-align:right;">'. filterMoney('0',$costoDeVentas).'</td><td></td></tr>';
    
            $gastosAdministrativos = funcionObtenerMontoCuentaPrincipalPeriodo($_SESSION['idPeriodo'], '5-01-', $dolarPeriodo);
    $res .= '<tr><td>Gastos Administrativos</td><td style="text-align:right;">'. filterMoney('0',$gastosAdministrativos).'</td><td></td></tr>';
    
            $gastosVentas = funcionObtenerMontoCuentaPrincipalPeriodo($_SESSION['idPeriodo'], '5-02-', $dolarPeriodo);
    $res .= '<tr><td>Gastos de Ventas</td><td style="text-align:right;">'. filterMoney('0',$gastosVentas).'</td><td></td></tr>';
    
            $totalGastos = $inventarioInicial+$compras+$inventarioFinal+$gastosAdministrativos+$gastosVentas;
    $res .= '<tr id="totalTR" style="background-color:#E6E6E6;"><th>Total de Gastos</th><td></td><th style="text-align:right;">'. filterMoney('0',$totalGastos).'</th></tr>';
    
            $utilidadOperaciones = $totalIngresos-$totalGastos;
    $res .= '<tr style="background-color:#E6E6E6;"><th>Utilidad por Operaciones</th><td></td><th style="text-align:right;">'. filterMoney('0',$utilidadOperaciones).'</th></tr>
            <tr><th colspan="3" class="fondoAzul">OTROS GASTOS DEDUCIBLES</th></tr>';
    
            $gastosFinancieros = funcionObtenerMontoCuentaPrincipalPeriodo($_SESSION['idPeriodo'], '5-03-', $dolarPeriodo);
    $res .= '<tr><td>Gastos Financieros</td><td style="text-align:right;">'. filterMoney('0',$gastosFinancieros).'</td><td></td></tr>';
    
            $gastosDepreciacion = funcionObtenerDepreciacionPeriodo($_SESSION['idPeriodo']);
    $res .= '<tr><td>Gastos por Depreciaci&oacute;n</td><td style="text-align:right;">'. filterMoney('0',$gastosDepreciacion).'</td><td></td></tr>';
    
            $gastosDeducibles = funcionObtenerMontoCuentaPrincipalPeriodo($_SESSION['idPeriodo'], '5-05-', $dolarPeriodo);
    $res .= '<tr><td>Otros Gastos Deducibles</td><td style="text-align:right;">'. filterMoney('0',$gastosDeducibles).'</td><td></td></tr>';
    
            $totalGastosDeducibles = $gastosFinancieros+$gastosDepreciacion+$gastosDeducibles;
    $res .= '<tr id="totalTR" style="background-color:#E6E6E6;"><th>Total de Otros Gastos Deducibles</th><td></td><th style="text-align:right;">'. filterMoney('0',$totalGastosDeducibles).'</th></tr>
            <tr><th colspan="3" class="fondoAzul">OTROS INGRESOS</th></tr>';
    
            $ingresosFinancieros = funcionObtenerMontoCuentaPrincipalPeriodo($_SESSION['idPeriodo'], '4-02-', $dolarPeriodo);
    $res .= '<tr><td>Ingresos Financieros</td><td style="text-align:right;">'. filterMoney('0',$ingresosFinancieros).'</td><td></td></tr>';
    
            $otrosIngresos = funcionObtenerMontoCuentaPrincipalPeriodo($_SESSION['idPeriodo'], '4-03-', $dolarPeriodo);
    $res .= '<tr><td>Otros Ingresos</td><td style="text-align:right;">'. filterMoney('0',$otrosIngresos).'</td><td></td></tr>';
    
            $totalOtrosIngresos = $ingresosFinancieros+$otrosIngresos;
    $res .= '<tr id="totalTR" style="background-color:#E6E6E6;"><th>Total de Otros Ingresos</th><td></td><th style="text-align:right;">'. filterMoney('0',$totalOtrosIngresos).'</th></tr>';
    
            $utilidadBruta = $utilidadOperaciones-$totalGastosDeducibles+$totalOtrosIngresos;
    $res .= '<tr style="background-color:#E6E6E6;"><th>UTILIDAD BRUTA</th><td></td><th style="text-align:right;">'. filterMoney('0',$utilidadBruta).'</th></tr>';
    
            if($_SESSION['tipoContribuyente'] === '1') //fisica
                $impuestoRenta = funcionCalcularImpuestoFisica($utilidadBruta);
            if($_SESSION['tipoContribuyente'] === '2') //juridica
                $impuestoRenta = funcionCalcularImpuestoJuridica($totalIngresos+$totalOtrosIngresos,$utilidadBruta);
            
                $_SESSION['impuestoRentaContribuyente'] = $impuestoRenta;
                        
    $res .= '<tr><td>Impuesto sobre la Renta</td><td></td><th style="text-align:right;">'. filterMoney('0',$impuestoRenta).'</th></tr>';
    
            $utilidadNeta = $utilidadBruta-$impuestoRenta;
    $res .= '<tr style="background-color:#E6E6E6;"><th>UTILIDAD NETA</th><td></td><th style="text-align:right;">'. filterMoney('0',$utilidadNeta).'</th></tr>
    </table>';
    
    echo utf8_decode($res);

function funcionCalcularImpuestoFisica($monto){
        $rangos = funcionObtenerRangosImpuesto($_SESSION['idAnnoPeriodo'],'1');
        $impuesto1 = intval($rangos[0]['rango'])*(intval($rangos[0]['tarifa'])/100);
        $impuesto2 = (intval($rangos[1]['rango'])-intval($rangos[0]['rango']))*(intval($rangos[1]['tarifa'])/100);
        $impuesto3 = (intval($rangos[2]['rango'])-intval($rangos[1]['rango']))*(intval($rangos[2]['tarifa'])/100);
        $impuesto4 = (intval($rangos[3]['rango'])-intval($rangos[2]['rango']))*(intval($rangos[3]['tarifa'])/100);
        $impuesto5 = (intval($monto)-intval($rangos[3]['rango']))*(intval($rangos[4]['tarifa'])/100);
        
        if($monto <= $rangos[0]['rango'])
            return $impuesto1;
        if($rangos[0]['rango'] < $monto && $monto <= $rangos[1]['rango'])
            return $impuesto2+$impuesto1;
        if($rangos[1]['rango'] < $monto && $monto <= $rangos[2]['rango'])
            return $impuesto3+$impuesto2+$impuesto1;
        if($rangos[2]['rango'] < $monto && $monto <= $rangos[3]['rango'])
            return $impuesto4+$impuesto3+$impuesto2+$impuesto1;
        if($rangos[3]['rango'] < $monto)
            return $impuesto5+$impuesto4+$impuesto3+$impuesto2+$impuesto1;
}    
function funcionCalcularImpuestoJuridica($monto,$utilidad){
        $rangos = funcionObtenerRangosImpuesto($_SESSION['idAnnoPeriodo'],'2');
        
        if($monto <= $rangos[0]['rango'])
            return intval($utilidad)*(intval($rangos[0]['tarifa'])/100);
        if($monto > $rangos[0]['rango'] && $monto <= $rangos[1]['rango'])
            return intval($utilidad)*(intval($rangos[1]['tarifa'])/100);
        if($monto > $rangos[1]['rango'])
            return intval($utilidad)*(intval($rangos[2]['tarifa'])/100);   
}    
    
function funcionObtenerMontoCuentaPrincipalPeriodo($idPeriodo,$codCuenta,$dolar){
    $conexion = conectar();
    $total = 0;
    foreach ($conexion->query(consultaObtenerMontoCuentaPrincipalPeriodo($idPeriodo,$codCuenta)) as $rows) {
        if($rows['moneda'] === '1')
            $monto = intval($rows['monto'])*intval($dolar);
        else
            $monto = $rows['monto'];
        $total += $monto;
    }
    desconectar($conexion);
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
function funcionObtenerDolarPeriodo($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerDolarPeriodo(), $conexion, $arreglo)['dolar'];
    desconectar($conexion);
    return $res;
}
function funcionObtenerRangosImpuesto($anno,$tipo){
    $conexion = conectar();
    $res = array();
    $i = 0;
    foreach ($conexion->query(consultaObtenerRangosImpuesto($anno,$tipo)) as $rows) {
        $res[$i] = array('tarifa' => $rows['tarifa'],'rango' => $rows['rango']);
        $i++;
    }
    desconectar($conexion);
    return $res;
}
desconectar($conexion);