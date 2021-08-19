<?php
session_start();
include('conectorCM/conectorCM.php');

if(isset($_POST['accion']))
{
    if($_POST['accion'] == 'cargarP_DJ')
    {
        $anno = $_POST['anno'];
        $arreglo = array($anno,$_SESSION['idContribuyente']);
        $idPeriodo = funcionEsPeriodo($arreglo);
        if($idPeriodo != ''){
            $_SESSION['idPeriodo'] = $idPeriodo;
            echo 'p';
            exit;
        }
        else{
            $decJur = funcionEsDeclaracion($arreglo);
            if($decJur != ''){
                $_SESSION['idAnnoDeclaracion'] = $anno;
                echo 'd';
                exit;
            }
        }
    }
    if($_POST['accion'] == 'cargarInfoPeriodo')
    {
        $rows = [];
        $rows = funcionObtenerInformacionPeriodo(array($_SESSION['idContribuyente'],$_SESSION['idPeriodo']));
        $_SESSION['idAnnoPeriodo'] = $rows['anno'];
        if($rows['estado'] == '1')
            $_SESSION['estadoPeriodo'] = 'Creado';
        else{
            if($rows['estado'] == '2')
                $_SESSION['estadoPeriodo'] = 'Revisado';
            else{
                if($rows['estado'] == '3')
                    $_SESSION['estadoPeriodo'] = 'Aprobado';
            }
        }
        $_SESSION['creadorPeriodo'] = funcionObtenerNombreUsuario(array($rows['creador']));
        if($rows['reviso'] == null)
            $_SESSION['revisarPeriodo'] = '';
        else
            $_SESSION['revisarPeriodo'] = $rows['reviso'];
        if($rows['aprobo'] == null)
            $_SESSION['aprobarPeriodo'] = '';
        else
            $_SESSION['aprobarPeriodo'] = $rows['aprobo'];
        $_SESSION['cierrePeriodo'] = $rows['fechaCierre'];
    }
   
    if($_POST['accion'] == 'nuevoAnticipo')
    {
        $arreglo = array($_SESSION['idPeriodo'],$_POST['tipoPago'],$_POST['tipoAnt'],
            $_POST['formulario'],$_POST['fecha'],$_POST['monto']);
        if(funcionAgregarAnticipo($arreglo))
        {
            $fechaObjeto = getdate();
            funcionAgregarBitacora(
                array($fechaObjeto["year"]."-".$fechaObjeto["mon"]."-".$fechaObjeto["mday"].
                    " ".$fechaObjeto["hours"].":".$fechaObjeto["minutes"].":".$fechaObjeto["seconds"],
                    'Anticipo','Agregado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'editarAnticipo')
    {
        $arreglo = array($_POST['tipoPago'],$_POST['tipoAnt'],
            $_POST['formulario'],$_POST['fecha'],$_POST['monto'],$_POST['idAnticipo']);
        if(funcionEditarAnticipo($arreglo))
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Anticipo','Modificado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'eliminarAnticipo')
    {
        $arreglo = array($_POST['idAnticipo']);
        if(funcionEliminarAnticipo($arreglo))
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Anticipo','Eliminado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'obtenerCuentas')
    {
        echo json_encode(funcionObtenerCuentas());
    }
    if($_POST['accion'] == 'obtenerNombreCuenta')
    {
        echo utf8_decode(funcionObtenerNombreCuenta(array($_POST['codigo'])));
    }
    if($_POST['accion'] == 'nuevoMovimiento')
    {
        $pasivo = null;
        if($_POST['idPasivo'] !== '')
            $pasivo = $_POST['idPasivo'];
        $arreglo = array($_SESSION['idPeriodo'],$_POST['grupo'],$_POST['fecha'],$_POST['proveedor'],
            $_POST['cedula'],$_POST['comprobante'],$_POST['monto'],$_POST['dolares'],$_POST['cuenta'],
            $_POST['observacion'],$pasivo);
        if(funcionAgregarMovimiento($arreglo)){
            if($pasivo != null){
                if($_POST['dolares'] === '1')
                    $monto = (intval($_POST['monto']) *  intval(funcionObtenerDolarPeriodo(array($_SESSION['idPeriodo']))));
                else 
                    $monto = $_POST['monto'];
                funcionReducirPasivo(array($monto,$pasivo));
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Movimiento','Agregado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'editarMovimiento')
    {
        $pasivo = null;
        if($_POST['idPasivo'] !== '')
            $pasivo = $_POST['idPasivo'];
        $arreglo = array($_POST['grupo'],$_POST['fecha'],$_POST['proveedor'],
            $_POST['cedula'],$_POST['comprobante'],$_POST['monto'],$_POST['dolares'],$_POST['cuenta'],
            $_POST['observacion'],$pasivo,$_POST['idMovimiento']);
        if(funcionEditarMovimiento($arreglo)){
            if($_POST['pasivoActual'] !== ''){
                if($_POST['dolaresActual'] === '1')
                    $monto = (intval($_POST['montoActual']) *  intval(funcionObtenerDolarPeriodo(array($_SESSION['idPeriodo']))));
                else 
                    $monto = $_POST['montoActual'];
                funcionAumentarPasivo(array($monto,$_POST['pasivoActual']));
            }
            if($pasivo != null){
                if($_POST['dolares'] === '1')
                    $monto = (intval($_POST['monto']) *  intval(funcionObtenerDolarPeriodo(array($_SESSION['idPeriodo']))));
                else 
                    $monto = $_POST['monto'];
                funcionReducirPasivo(array($monto,$pasivo));
            }
           $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Movimiento','Editado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'eliminarMovimiento')
    {
        if(funcionEliminarMovimiento(array($_POST['idMovimiento']))){
            if($_POST['pasivo'] !== ''){
                if($_POST['dolares'] === '1')
                    $monto = (intval($_POST['monto']) *  intval(funcionObtenerDolarPeriodo(array($_SESSION['idPeriodo']))));
                else 
                    $monto = $_POST['monto'];
                funcionAumentarPasivo(array($monto,$_POST['pasivo']));
            }
           $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Movimiento','Eliminado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'obtenerAnnoPeriodo')
    {
        echo $_SESSION['idAnnoPeriodo'];
        exit;
    }
    if($_POST['accion'] == 'obtenerPasivos')
    {
        echo funcionObtenerPasivosSelect($_SESSION['idContribuyente']);
        exit;
    }
    if($_POST['accion'] == 'obtenerSaldoPasivo')
    {
        echo funcionObtenerSaldoPasivo(array($_POST['codigo']));
        exit;
    }
    if($_POST['accion'] == 'obtenerDolar')
    {
        echo json_encode(funcionObtenerDolarPeriodo(array($_SESSION['idPeriodo'])));
        exit;
    }
}
else
{
    header('Location: ../index.php');
}