<?php
include "../modelo/conexionBD.php";
include "../modelo/consultasBD.php";

function funcionAccesoUsuario($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaAccesoUsuario(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
//--------------------------------------------USUARIOS
function funcionAgregarUsuario($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarUsuario(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarUsuario($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarUsuario(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionDeshabilitarUsuario($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaDeshabilitarUsuario(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionHabilitarUsuario($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaHabilitarUsuario(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionCambioContraseñaUsuario($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaCambioContraseñaUsuario(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionObtenerContraseñaUsuario($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerContraseñaUsuario(), $conexion, $arreglo)['contrasena'];
    desconectar($conexion);
    return $res;
}
function funcionObtenerEmailUsuario($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerEmailUsuario(), $conexion, $arreglo)['email'];
    desconectar($conexion);
    return $res;
}
function funcionObtenerNombreUsuario($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerNombreUsuario(), $conexion, $arreglo)['nombreCompleto'];
    desconectar($conexion);
    return $res;
}
function funcionRecuperarClave($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaRecuperarClave(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
//-------------------------------------CUENTAS
function funcionAgregarCuenta($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarCuenta(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarCuenta($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarCuenta(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionHabilitarCuenta($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaHabilitarCuenta(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionDeshabilitarCuenta($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaDeshabilitarCuenta(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionObtenerNombreCuenta($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerNombreCuenta(), $conexion, $arreglo)['nombre'];
    desconectar($conexion);
    return $res;
}
//---------------------------------DOLAR
function funcionObtenerDolar(){
    /*$conexion = conectar();
    $res = consultarBase(consultaObtenerDolar(), $conexion, array(''))['monto'];
    desconectar($conexion);
    return $res;*/
    return consultarXML('dolar','monto','../modelo/datos.xml');
}
function funcionEditarDolar($monto){
    /*$conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarDolar(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;*/
    return editarXML('dolar','monto','../modelo/datos.xml',$monto);
}
//-------------------------------CONTRIBUYENTE
function funcionEditarContribuyente($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarContribuyente(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionAgregarContribuyente($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarContribuyente(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
//-------------------------------BITACORA
function funcionAgregarBitacora($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarBitacora(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
//-------------------------------ACTIVO
function funcionAgregarActivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarActivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarActivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarActivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionDeshabilitarActivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaDeshabilitarActivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionHabilitarActivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaHabilitarActivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionObtenerInformacionTipoActivo($tipo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerInfoTipoActivo(), $conexion, array($tipo));
    desconectar($conexion);
    return $res;
}
function funcionObtenerIdentificadorActivo($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerIdentificadorActivo(), $conexion, $arreglo)['identificador'];
    desconectar($conexion);
    return $res;
}
function funcionObtenerFechaRegistroActivo($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerFechaRegistroActivo(), $conexion, $arreglo)['fechaRegistro'];
    desconectar($conexion);
    return $res;
}
function funcionEditarDepreciacionActivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarDepreciacionActivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionObtenerActivosHabilitados($id){
    $conexion = conectar();
    $res = array();
    $i = 0;
    foreach ($conexion->query(consultaObtenerActivosHabilitados($id)) as $rows) {
        $res[$i] = array('identificador' => $rows['identificador'],'depreciacionMensual' => $rows['depreciacionMensual'],
            'fechaRegistro' => $rows['fechaRegistro'],'monto' => $rows['monto'],
            'depreciacionAcumulada' => $rows['depreciacionAcumulada'],'depreciacionPeriodo' => $rows['depreciacionPeriodo']);
        $i++;
    }
    desconectar($conexion);
    return $res;
}
//----------------------------PERIODO_ACTIVO
function funcionAgregarPeriodo_Activo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarPeriodo_Activo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarPeriodo_Activo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarPeriodo_Activo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEliminarPeriodo_Activo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEliminarPeriodo_Activo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
//---------------------------PASIVO
function funcionObtenerSaldoPasivo($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerSaldoPasivo(), $conexion, $arreglo)['saldo'];
    desconectar($conexion);
    return $res;
}
function funcionAgregarPasivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarPasivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarPasivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarPasivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionHabilitarPasivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaHabilitarPasivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionDeshabilitarPasivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaDeshabilitarPasivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionObtenerPasivosHabilitados($id){
    $conexion = conectar();
    $res = array();
    $i = 0;
    foreach ($conexion->query(consultaObtenerPasivosHabilitados($id)) as $rows) {
        $res[$i] = array('identificador' => $rows['banco'],'principal' => $rows['principal'],
            'saldo' => $rows['saldo']);
        $i++;
    }
    desconectar($conexion);
    return $res;
}
function funcionObtenerPasivosSelect($id){
    $conexion = conectar();
    $res = array();
    foreach ($conexion->query(consultaObtenerPasivosSelect($id)) as $rows) {
        $res .= '<option value="'.$rows['banco'].'">'.$rows['banco'].' (&#162; '.$rows['saldo'].')</option>';
    }
    desconectar($conexion);
    return $res;
}
//----------------------------PERIODO_PASIVO
function funcionAgregarPeriodo_Pasivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarPeriodo_Pasivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarPeriodo_Pasivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarPeriodo_Pasivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEliminarPeriodo_Pasivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEliminarPeriodo_Pasivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
//---------------------------PATRIMONIO
function funcionAgregarPatrimonio($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarPatrimonio(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarPatrimonio($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarPatrimonio(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionHabilitarPatrimonio($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaHabilitarPatrimonio(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionDeshabilitarPatrimonio($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaDeshabilitarPatrimonio(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionObtenerIdentificadorPatrimonio($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerIdentificadorPatrimonio(), $conexion, $arreglo)['identificador'];
    desconectar($conexion);
    return $res;
}
function funcionObtenerPatrimoniosHabilitados($id){
    $conexion = conectar();
    $res = array();
    $i = 0;
    foreach ($conexion->query(consultaObtenerPatrimoniosHabilitados($id)) as $rows) {
        $res[$i] = array('identificador' => $rows['identificador'],'monto' => $rows['monto']);
        $i++;
    }
    desconectar($conexion);
    return $res;
}
//----------------------------PERIODO_PATRIMONIO
function funcionAgregarPeriodo_Patrimonio($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarPeriodo_Patrimonio(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarPeriodo_Patrimonio($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarPeriodo_Patrimonio(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEliminarPeriodo_Patrimonio($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEliminarPeriodo_Patrimonio(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
//-------------------------------INVERSION
function funcionAgregarInversion($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarInversion(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarInversion($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarInversion(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionDeshabilitarInversion($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaDeshabilitarInversion(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionHabilitarInversion($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaHabilitarInversion(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionObtenerIdentificadorInversion($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerIdentificadorInversion(), $conexion, $arreglo)['identificador'];
    desconectar($conexion);
    return $res;
}
function funcionObtenerInversionesHabilitados($id){
    $conexion = conectar();
    $res = array();
    $i = 0;
    foreach ($conexion->query(consultaObtenerInversionesHabilitados($id)) as $rows) {
        $res[$i] = array('identificador' => $rows['identificador'],'monto' => $rows['monto']);
        $i++;
    }
    desconectar($conexion);
    return $res;
}
//----------------------------PERIODO_INVERSION
function funcionAgregarPeriodo_Inversion($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarPeriodo_Inversion(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarPeriodo_Inversion($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarPeriodo_Inversion(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEliminarPeriodo_Inversion($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEliminarPeriodo_Inversion(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
//----------------------------------------------------PERIODO
function funcionEsPeriodo($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaEsPeriodo(), $conexion, $arreglo)['identificador'];
    desconectar($conexion);
    return $res;
}
function funcionEsDeclaracion($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaEsDeclaracion(), $conexion, $arreglo)['contador'];
    desconectar($conexion);
    return $res;
}
function funcionCrearPeriodo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaCrearPeriodo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionActualizarDolarPeriodo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaActualizarDolarPeriodo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionObtenerInformacionPeriodo($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerInformacionPeriodo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionObtenerDolarPeriodo($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerDolarPeriodo(), $conexion, $arreglo)['dolar'];
    desconectar($conexion);
    return $res;
}
function funcionPeriodosAbiertos($id){
    $conexion = conectar();
    $res = array();
    $i = 0;
    foreach ($conexion->query(consultaPeriodosAbiertos($id)) as $rows) {
        $res[$i] = $rows['identificador'];
        $i++;
    }
    desconectar($conexion);
    return $res;
}
function funcionPeriodosAbiertosTODOS(){
    $conexion = conectar();
    $res = array();
    $i = 0;
    foreach ($conexion->query(consultaPeriodosAbiertosTODOS()) as $rows) {
        $res[$i] = $rows['identificador'];
        $i++;
    }
    desconectar($conexion);
    return $res;
}
//----------------------------------------DECLARACIONJURADA
function funcionCrearDeclaracion($idCliente,$anno){
    $conexion = conectar();
    $res = true;
    foreach ($conexion->query(consultaObtenerAspectosDeclaracion()) as $rows) {
       $res *= consultarBaseSinRetornar(consultaCrearDeclaracion(), $conexion, array($idCliente,$rows['identificador'],$anno));
    }
    desconectar($conexion);
    return $res;
}
function funcionObtenerNombreAspectoDeclaracion($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaObtenerNombreAspectoDeclaracion(), $conexion, $arreglo)['nombre'];
    desconectar($conexion);
    return $res;
}
function funcionEditarDeclaracion($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarDeclaracion(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
//----------------------------------------RANGO IMPUESTO
function funcionAgregarRango($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarRango(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionConsultarExisteRango($arreglo){
    $conexion = conectar();
    $res = consultarBase(consultaConsultarExisteRango(), $conexion, $arreglo)['cantidad'];
    desconectar($conexion);
    return $res;
}
//---------------------------------------ANTICIPO
function funcionAgregarAnticipo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarAnticipo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarAnticipo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarAnticipo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEliminarAnticipo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEliminarAnticipo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
//---------------------------------------MOVIMIENTOS
function funcionObtenerCuentas(){
    $conexion = conectar();
    $res = array();
    $i = 0;
    foreach ($conexion->query(consultaObtenerCuentas()) as $rows) {
        $res[$i] = $rows['codigo'];
        $i++;
    }
    desconectar($conexion);
    return $res;
}
function funcionAgregarMovimiento($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAgregarMovimiento(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEditarMovimiento($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEditarMovimiento(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionEliminarMovimiento($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaEliminarMovimiento(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionReducirPasivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaReducirPasivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
function funcionAumentarPasivo($arreglo){
    $conexion = conectar();
    $res = consultarBaseSinRetornar(consultaAumentarPasivo(), $conexion, $arreglo);
    desconectar($conexion);
    return $res;
}
