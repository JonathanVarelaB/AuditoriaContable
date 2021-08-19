<?php

function consultaAccesoUsuario(){
    return 'Select * from usuario where nombreUsuario = ? and contrasena = ?';
}
function consultaMostrarUsuariosExistentes(){
    return 'Select identificador,nombreUsuario,nombreCompleto,email,tipo,revisar,aprobar,editar,estado from usuario';
}
function consultaAgregarUsuario(){
    return 'Insert into usuario values (null,?,?,?,?,?,?,?,?,1)';
}
function consultaEditarUsuario(){
    return 'Update usuario set nombreUsuario = ?,nombreCompleto = ?, email = ?, tipo = ?,
    revisar = ?, aprobar = ?, editar = ? where identificador = ?';
}
function consultaHabilitarUsuario(){
    return 'Update usuario set estado = 1 where identificador = ?';
}
function consultaDeshabilitarUsuario(){
    return 'Update usuario set estado = 0 where identificador = ?';
}
function consultaCambioContraseñaUsuario(){
    return 'Update usuario set contrasena = ? where identificador = ?';
}
function consultaObtenerContraseñaUsuario(){
    return 'Select contrasena from usuario where identificador = ?';
}
function consultaObtenerEmailUsuario(){
    return 'Select email from usuario where nombreUsuario = ?';
}
function consultaMostrarCuentasExistentes(){
    return 'Select codigo,nombre,estado from cuentacontable';
}
function consultaAgregarCuenta(){
    return 'Insert into cuentacontable values (?,?,1)';
}
function consultaEditarCuenta(){
    return 'Update cuentacontable set codigo = ?, nombre = ? where codigo = ?';
}
function consultaHabilitarCuenta(){
    return 'Update cuentacontable set estado = 1 where codigo = ?';
}
function consultaDeshabilitarCuenta(){
    return 'Update cuentacontable set estado = 0 where codigo = ?';
}
function consultaObtenerDolar(){
    return 'Select monto from dolar';
}
function consultaEditarDolar(){
    return 'Update dolar set monto = ?';
}
function consultaMostrarContribuyentesExistentes(){
    return 'Select * from cliente';
}
function consultaEditarContribuyente(){
    return 'Update cliente set tipo=?,identificacion=?,nombre=?,cedulaDGT=?,telefono=?,email=?,direccion=? where identificacion=? and tipo=?';
}
function consultaAgregarContribuyente(){
    return 'Insert into cliente values(?,?,?,?,?,?,?)';
}
function consultaMostrarBitacora(){
    return 'Select * from bitacora';
}
function consultaAgregarBitacora(){
    return 'Insert into bitacora values (null,?,?,?,?,?)';
}
function consultaObtenerNombreUsuario(){
    return 'Select nombreCompleto from usuario where identificador = ?';
}
function consultaRecuperarClave(){
    return 'Update usuario set contrasena = ? where nombreUsuario = ? and email = ?';
}
function consultaMostrarActivosExistentes($id){
    return "Select * from activo where idCliente = '$id'";
}
function consultaMostrarPasivosExistentes($id){
    return "Select * from pasivo where idCliente = '$id'";
}
function consultaMostrarPatrimoniosExistentes($id){
    return "Select * from patrimonio where idCliente = '$id'";
}
function consultaListarTipoActivo(){
    return "Select identificador, nombre from tipoactivo";
}
function consultaAgregarActivo(){
    return 'Insert into activo values (null,?,?,?,?,?,?,?,?,?,?,1)';
}
function consultaObtenerInfoTipoActivo(){
    return 'Select nombre,mesesDepreciado from tipoactivo where identificador = ?';
}
function consultaEditarActivo(){
    return 'Update activo set proveedor=?,descripcion=?,tipo=?,fecha=?,monto=? where identificador = ?';
}
function consultaDeshabilitarActivo(){
    return 'Update activo set estado = 0 where identificador = ?';
}
function consultaHabilitarActivo(){
    return 'Update activo set estado = 1 where identificador = ?';
}
function consultaAgregarPasivo(){
    return 'Insert into pasivo values (?,?,?,?,?,?,?,?,?,1)';
}
function consultaEditarPasivo(){
    return 'Update pasivo set fechaApertura=?,fechaVencimiento=?,interes=?,principal=?,observacion=?,documento=? where banco = ? and idCliente = ?';
}
function consultaDeshabilitarPasivo(){
    return 'Update pasivo set estado = 0 where banco = ? and idCliente = ?';
}
function consultaHabilitarPasivo(){
    return 'Update pasivo set estado = 1 where banco = ? and idCliente = ?';
}
function consultaAgregarPatrimonio(){
    return 'Insert into patrimonio values (null,?,?,?,?,?,?,1)';
}
function consultaEditarPatrimonio(){
    return 'Update patrimonio set fecha=?,accionista=?,acta=?,monto=?,fechaDevolucion=? where identificador = ?';
}
function consultaDeshabilitarPatrimonio(){
    return 'Update patrimonio set estado = 0 where identificador = ?';
}
function consultaHabilitarPatrimonio(){
    return 'Update patrimonio set estado = 1 where identificador = ?';
}
function consultaObtenerPeriodosCliente($id){
    return "Select anno from periodo where idCliente = '$id' union select anno from declaracionjurada where idCliente = '$id' order by anno desc";
}
function consultaEsPeriodo(){
    return 'Select identificador from periodo where anno = ? and idCliente = ?';
}
function consultaEsDeclaracion(){
    return 'Select count(*) as contador from declaracionjurada where anno = ? and idCliente = ?';
}
function consultaCrearPeriodo(){
    return 'Insert into periodo values(null,?,?,?,?,null,null,?,?)';
}
function consultaObtenerInformacionPeriodo(){
    return 'Select anno,estado,creador,reviso,aprobo,fechaCierre from periodo where idCliente = ? and identificador = ?';
}
function consultaObtenerAspectosDeclaracion(){
    return 'Select identificador from aspectodeclaracion';
}
function consultaCrearDeclaracion(){
    return 'Insert into declaracionjurada values(?,?,?,0)';
}
function consultaDeclaracionAnterior($idCliente,$anno){
    return "Select idAspecto, monto from declaracionjurada where idCliente = '$idCliente' and anno = '$anno' and idAspecto < 48";
}
function consultaObtenerNombreAspectoDeclaracion(){
    return 'Select nombre from aspectodeclaracion where identificador = ?';
}
function consultaEditarDeclaracion(){
    return 'Update declaracionjurada set monto = ? where idCliente = ? and idAspecto = ? and anno = ?';
}
function consultaListarPeriodosRangos($tipo){
    return "Select anno from rangoImpuesto where tipo = '$tipo' group by anno";
}
function consultaMostrarRangoImpuesto($tipo,$anno){
    return "Select tarifa, rango from rangoImpuesto where tipo = '$tipo' and anno = '$anno'";
}
function consultaAgregarRango(){
    return 'Insert into rangoimpuesto values (?,?,?,?)';
}
function consultaConsultarExisteRango(){
    return 'Select count(*) cantidad from rangoimpuesto where tipo = ? and anno = ?';
}
function consultaPeriodosAbiertos($id){
    return "Select identificador from periodo where idCliente = '$id' and (estado = 1 or estado = 2)";
}
function consultaPeriodosAbiertosTODOS(){
    return "Select identificador from periodo where (estado = 1 or estado = 2)";
}
function consultaObtenerIdentificadorActivo(){
    return 'Select identificador from activo where proveedor=? and descripcion=? and tipo=? and fecha=? and monto=?';
}
function consultaAgregarPeriodo_Activo(){
    return 'Insert into periodo_activo values(?,?,?,?,?)';
}
function consultaEditarDepreciacionActivo(){
    return 'Update activo set depreciacionMensual=?,depreciacionAcumulada=?,depreciacionPeriodo=? where identificador = ?';
}
function consultaObtenerFechaRegistroActivo(){
    return 'Select fechaRegistro from activo where identificador = ?';
}
function consultaEditarPeriodo_Activo(){
    return 'Update periodo_activo set monto=?,depreciacionAcumulada=?,depreciacionPeriodo=? where idPeriodo = ? and idActivo = ?';
}
function consultaEliminarPeriodo_Activo(){
    return 'Delete from periodo_activo where idPeriodo = ? and idActivo = ?';
}
function consultaObtenerActivosHabilitados($id){
    return "Select identificador,fechaRegistro,depreciacionMensual,monto,depreciacionAcumulada,depreciacionPeriodo from activo where idCliente = '$id' and estado = 1";
}
function consultaObtenerPasivosHabilitados($id){
    return "Select banco,principal,saldo from pasivo where idCliente = '$id' and estado = 1";
}
function consultaObtenerPasivosSelect($id){
    return "Select banco,saldo from pasivo where idCliente = '$id' and estado = 1 and saldo >= 0";
}
function consultaAgregarPeriodo_Pasivo(){
    return 'Insert into periodo_pasivo values(?,?,?,?)';
}
function consultaEditarPeriodo_Pasivo(){
    return 'Update periodo_pasivo set principal = ? where idPeriodo = ? and idPasivo = ?';
}
function consultaEliminarPeriodo_Pasivo(){
    return 'Delete from periodo_pasivo where idPeriodo = ? and idPasivo = ?';
}
function consultaObtenerPatrimoniosHabilitados($id){
    return "Select identificador,monto from patrimonio where idCliente = '$id' and estado = 1";
}
function consultaAgregarPeriodo_Patrimonio(){
    return 'Insert into periodo_patrimonio values(?,?,?)';
}
function consultaEditarPeriodo_Patrimonio(){
    return 'Update periodo_patrimonio set monto = ? where idPeriodo = ? and idPatrimonio = ?';
}
function consultaEliminarPeriodo_Patrimonio(){
    return 'Delete from periodo_patrimonio where idPeriodo = ? and idPatrimonio = ?';
}
function consultaObtenerIdentificadorPatrimonio(){
    return 'Select identificador from patrimonio where fecha=? and monto=? and idCliente=?'; 
}
function consultaMostrarInversionesExistentes($id){
    return "Select * from inversion where idCliente = '$id'";
}
function consultaAgregarInversion(){
    return 'Insert into inversion values (null,?,?,?,?,?,?,1)';
}
function consultaEditarInversion(){
    return 'Update inversion set sociedad=?,cedulajuridica=?,fecha=?,monto=?,observacion=? where identificador = ?';
}
function consultaDeshabilitarInversion(){
    return 'Update inversion set estado = 0 where identificador = ?';
}
function consultaHabilitarInversion(){
    return 'Update inversion set estado = 1 where identificador = ?';
}
function consultaObtenerIdentificadorInversion(){
    return 'Select identificador from inversion where cedulajuridica=? and fecha=? and monto=? and idCliente = ?';
}
function consultaAgregarPeriodo_Inversion(){
    return 'Insert into periodo_inversion values(?,?,?)';
}
function consultaEditarPeriodo_Inversion(){
    return 'Update periodo_inversion set monto=? where idPeriodo = ? and idInversion = ?';
}
function consultaEliminarPeriodo_Inversion(){
    return 'Delete from periodo_inversion where idPeriodo = ? and idInversion = ?';
}
function consultaObtenerInversionesHabilitados($id){
    return "Select identificador,monto from inversion where idCliente = '$id' and estado = 1";
}
function consultaMostrarAnticiposExistentes($id){
    return "Select * from anticipo where idPeriodo = '$id'";
}
function consultaAgregarAnticipo(){
    return 'Insert into anticipo values(null,?,?,?,?,?,?)';
}
function consultaEditarAnticipo(){
    return 'Update anticipo set tipoPago=?,tipo=?,formulario=?,fecha=?,monto=? where identificador = ?';
}
function consultaEliminarAnticipo(){
    return 'Delete from anticipo where identificador =?';
}
function consultaMostrarMovimientos($id){
    return "Select * from movimiento where idPeriodo = '$id'";
}
function consultaObtenerCuentas(){
    return "Select codigo from cuentacontable where estado = 1";
}
function consultaObtenerNombreCuenta(){
    return 'Select nombre from cuentacontable where codigo = ?';
}
function consultaAgregarMovimiento(){
    return 'Insert into movimiento values (null,?,?,?,?,?,?,?,?,?,?,?)';
}
function consultaEliminarMovimiento(){
    return 'Delete from movimiento where identificador = ?';
}
function consultaEditarMovimiento(){
    return 'Update movimiento set grupo=?,fecha=?,proveedor=?,cedula=?,comprobante=?,monto=?,moneda=?,codigoContable=?,observacion=?,idPasivo=? where identificador=?';
}
function consultaReducirPasivo(){
    return 'Update pasivo set saldo = saldo - ? where banco = ?';
}
function consultaAumentarPasivo(){
    return 'Update pasivo set saldo = saldo + ? where banco = ?';
}
function consultaObtenerSaldoPasivo(){
    return 'Select saldo from pasivo where banco = ?';
}
function consultaActualizarDolarPeriodo(){
    return 'Update periodo set dolar = ? where identificador = ?';
}
function consultaObtenerDolarPeriodo(){
    return 'Select dolar from periodo where identificador = ?';
}
function consultaObtenerCuentasContables($tipo){
    return "Select codigo,nombre from cuentacontable where codigo like '$tipo%' and estado = 1";
}
function consultaObtenerMovimientosCuentaPeriodo($idPeriodo,$codCuenta){
    return "Select monto,moneda,fecha from movimiento where idPeriodo = '$idPeriodo' and codigoContable = '$codCuenta'";
}
function consultaObtenerMontoCuentaPrincipalPeriodo($idPeriodo,$codCuenta){
    return "Select monto,moneda from movimiento where idPeriodo = '$idPeriodo' and codigoContable like '$codCuenta%'";
}
function consultaObtenerDepreciacionPeriodo($idPeriodo){
    return "Select depreciacionPeriodo from periodo_activo where idPeriodo = '$idPeriodo'";
}
function consultaObtenerDepreciacionAcumulada($idPeriodo){
    return "Select depreciacionAcumulada from periodo_activo where idPeriodo = '$idPeriodo'";
}
function consultaObtenerMontoInversiones($idPeriodo){
    return "Select monto from periodo_inversion where idPeriodo = '$idPeriodo'";
}
function consultaObtenerMontoActivos($idPeriodo){
    return "Select monto from periodo_activo where idPeriodo = '$idPeriodo'";
}
function consultaObtenerMontoAnticipos($idPeriodo){
    return "Select monto from anticipo where idPeriodo = '$idPeriodo'";
}
function consultaObtenerSaldoPasivos($idPeriodo){
    return "Select saldo from periodo_pasivo where idPeriodo = '$idPeriodo'";
}
function consultaObtenerMontoPatrimonios($idPeriodo){
    return "Select monto from periodo_patrimonio where idPeriodo = '$idPeriodo'";
}
function consultaObtenerRangosImpuesto($anno,$tipo){
    return "Select tarifa,rango from rangoimpuesto where anno = '$anno' and tipo = '$tipo'";
}