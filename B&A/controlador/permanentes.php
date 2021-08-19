<?php
session_start();
include('conectorCM/conectorCM.php');

if(isset($_POST['accion']))
{
    if($_POST['accion'] == 'nuevoActivo')
    {
        if($_POST['fecha'] == '')
            $fecha = null;
        else
            $fecha = $_POST['fecha'];
        $fechaObjeto = getdate();
        $depreciacionMensual = depreciacionMensual($_POST['tipo'], $_POST['monto']);
        $depreciacionPeriodo = depreciacionPeriodo($depreciacionMensual);
        $arreglo = array($_POST['proveedor'],$_POST['descripcion'],
            $_POST['tipo'],$fecha,$fechaObjeto["year"]."-".$fechaObjeto["mon"]."-".$fechaObjeto["mday"],
            $_POST['monto'],
            $depreciacionMensual,//depreciacionMensual
            0,//depreciacionAcumulada
            $depreciacionPeriodo,//depreciacionPeriodo
            $_SESSION['idContribuyente']);
        if(funcionAgregarActivo($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                $idActivo = funcionObtenerIdentificadorActivo(array($_POST['proveedor'],$_POST['descripcion'],$_POST['tipo'],$fecha,$_POST['monto']));
                for ($i = 0; $i < count($periodos); $i++) {
                    $arreglo = array($periodos[$i],$idActivo,$_POST['monto'],0,$depreciacionPeriodo);
                    funcionAgregarPeriodo_Activo($arreglo);
                }
            }
            funcionAgregarBitacora(
                array($fechaObjeto["year"]."-".$fechaObjeto["mon"]."-".$fechaObjeto["mday"].
                    " ".$fechaObjeto["hours"].":".$fechaObjeto["minutes"].":".$fechaObjeto["seconds"],
                    'Activo','Agregado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'editarActivo')
    {
        if($_POST['fecha'] == '')
            $fecha = null;
        else
            $fecha = $_POST['fecha'];
        $arreglo = array($_POST['proveedor'],$_POST['descripcion'],
            $_POST['tipo'],$fecha,$_POST['monto'],$_POST['idActivo']);
        if(funcionEditarActivo($arreglo))
        {
            $depreciacionMensual = depreciacionMensual($_POST['tipo'], $_POST['monto']);
            $depreciacionPeriodo = depreciacionPeriodo($depreciacionMensual);
            $depreciacionAcumulada = depreciacionAcumulada($depreciacionMensual,funcionObtenerFechaRegistroActivo(array($_POST['idActivo'])));
            $arreglo = array($depreciacionMensual,$depreciacionAcumulada,$depreciacionPeriodo,$_POST['idActivo']);
            funcionEditarDepreciacionActivo($arreglo);
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    funcionEditarPeriodo_Activo(array($_POST['monto'],$depreciacionAcumulada,$depreciacionPeriodo,$periodos[$i],$_POST['idActivo']));
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Activo','Modificado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'deshabilitarA')
    {
        $arreglo = array($_POST['idActivo']);
        if(funcionDeshabilitarActivo($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    funcionEliminarPeriodo_Activo(array($periodos[$i],$_POST['idActivo']));
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Activo','Deshabilitado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '2';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'habilitarA')
    {
        $arreglo = array($_POST['idActivo']);
        if(funcionHabilitarActivo($arreglo))
        {
            $depreciacionPeriodo = depreciacionPeriodo($_POST['Dmensual']);
            $depreciacionAcumulada = depreciacionAcumulada($_POST['Dmensual'],funcionObtenerFechaRegistroActivo(array($_POST['idActivo'])));
            $arreglo = array($_POST['Dmensual'],$depreciacionAcumulada,$depreciacionPeriodo,$_POST['idActivo']);
            funcionEditarDepreciacionActivo($arreglo);
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    $arreglo = array($periodos[$i],$_POST['idActivo'],$_POST['monto'],$depreciacionAcumulada,$depreciacionPeriodo);
                    funcionAgregarPeriodo_Activo($arreglo);
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Activo','Habilitado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'nuevoPasivo')
    {
        if($_POST['fechaApertura'] == '')
            $fechaApertura = null;
        else
            $fechaApertura = $_POST['fechaApertura'];
        if($_POST['fechaVencimiento'] == '')
            $fechaVencimiento = null;
        else
            $fechaVencimiento = $_POST['fechaVencimiento'];
        if($_POST['interes'] == '')
            $interes = null;
        else
            $interes = $_POST['interes'];
        $arreglo = array($_POST['banco'],$fechaApertura,$fechaVencimiento, $interes,
            $_POST['principal'],$_POST['principal'],$_POST['observaciones'],$_POST['documento'],$_SESSION['idContribuyente']);
        if(funcionAgregarPasivo($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    $arreglo = array($periodos[$i],$_POST['banco'],$_POST['principal'],$_POST['principal']);
                    funcionAgregarPeriodo_Pasivo($arreglo);
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Pasivo','Agregado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'editarPasivo')
    {
        if($_POST['fechaApertura'] == '')
            $fechaApertura = null;
        else
            $fechaApertura = $_POST['fechaApertura'];
        if($_POST['fechaVencimiento'] == '')
            $fechaVencimiento = null;
        else
            $fechaVencimiento = $_POST['fechaVencimiento'];
        if($_POST['interes'] == '')
            $interes = null;
        else
            $interes = $_POST['interes'];
        $arreglo = array($fechaApertura,$fechaVencimiento, $interes,
            $_POST['principal'],$_POST['observaciones'],$_POST['documento'],$_POST['bancoActual'],$_SESSION['idContribuyente']);
        if(funcionEditarPasivo($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    funcionEditarPeriodo_Pasivo(array($_POST['principal'],$periodos[$i],$_POST['bancoActual']));
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Pasivo','Modificado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'deshabilitarPas')
    {
        $arreglo = array($_POST['bancoActual'],$_SESSION['idContribuyente']);
        if(funcionDeshabilitarPasivo($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    funcionEliminarPeriodo_Pasivo(array($periodos[$i],$_POST['bancoActual']));
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Pasivo','Deshabilitado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '2';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'habilitarPas')
    {
        $arreglo = array($_POST['bancoActual'],$_SESSION['idContribuyente']);
        if(funcionHabilitarPasivo($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    $arreglo = array($periodos[$i],$_POST['bancoActual'],$_POST['principal'],$_POST['saldo']);
                    funcionAgregarPeriodo_Pasivo($arreglo);
                }
            }
            
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Pasivo','Habilitado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'nuevoPatrimonio')
    {
        if($_POST['fecha'] == '')
            $fecha = null;
        else
            $fecha = $_POST['fecha'];
        if($_POST['fechaDevolucion'] == '')
            $fechaDevolucion = null;
        else
            $fechaDevolucion = $_POST['fechaDevolucion'];
        $arreglo = array($fecha,$_POST['accionista'],$_POST['acta'],$_POST['monto'],$fechaDevolucion,$_SESSION['idContribuyente']);
        if(funcionAgregarPatrimonio($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                $idPatrimonio = funcionObtenerIdentificadorPatrimonio(array($fecha,$_POST['monto'],$_SESSION['idContribuyente']));
                for ($i = 0; $i < count($periodos); $i++) {
                    funcionAgregarPeriodo_Patrimonio(array($periodos[$i],$idPatrimonio,$_POST['monto']));
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Patrimonio','Agregado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'editarPatrimonio')
    {
        if($_POST['fecha'] == '')
            $fecha = null;
        else
            $fecha = $_POST['fecha'];
        if($_POST['fechaDevolucion'] == '')
            $fechaDevolucion = null;
        else
            $fechaDevolucion = $_POST['fechaDevolucion'];
        $arreglo = array($fecha,$_POST['accionista'],$_POST['acta'],$_POST['monto'],$fechaDevolucion,$_POST['idPatrimonio']);
        if(funcionEditarPatrimonio($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    funcionEditarPeriodo_Patrimonio(array($_POST['monto'],$periodos[$i],$_POST['idPatrimonio']));
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Patrimonio','Modificado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'deshabilitarPat')
    {
        $arreglo = array($_POST['idPatrimonio']);
        if(funcionDeshabilitarPatrimonio($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    funcionEliminarPeriodo_Patrimonio(array($periodos[$i],$_POST['idPatrimonio']));
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Patrimonio','Deshabilitado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '2';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'habilitarPat')
    {
        $arreglo = array($_POST['idPatrimonio']);
        if(funcionHabilitarPatrimonio($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    $arreglo = array($periodos[$i],$_POST['idPatrimonio'],$_POST['monto']);
                    funcionAgregarPeriodo_Patrimonio($arreglo);
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Patrimonio','Habilitado','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'actualizarActivos')
    {
        $activosHab = funcionObtenerActivosHabilitados($_SESSION['idContribuyente']);
        $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
        $cantPeriodos = count($periodos);
        $cantActivos = count($activosHab);
        if($cantActivos > 0){
            for($i = 0; $i < $cantActivos; $i++){
                $depreciacionPeriodo = depreciacionPeriodo($activosHab[$i]['depreciacionMensual']);
                $depreciacionAcumulada = depreciacionAcumulada($activosHab[$i]['depreciacionMensual'],$activosHab[$i]['fechaRegistro']);
                funcionEditarDepreciacionActivo(array($activosHab[$i]['depreciacionMensual'],$depreciacionAcumulada,
                    $depreciacionPeriodo,$activosHab[$i]['identificador']));
                if($cantPeriodos > 0){
                    for ($j = 0; $j < $cantPeriodos; $j++) {
                        funcionEditarPeriodo_Activo(array($activosHab[$i]['monto'],$depreciacionAcumulada,$depreciacionPeriodo,
                            $periodos[$j],$activosHab[$i]['identificador']));
                    }
                }
            }
        }
    }
    
    if($_POST['accion'] == 'nuevaInversion')
    {
        $arreglo = array($_POST['sociedad'],$_POST['cedJuridica'],$_POST['fecha'],$_POST['monto'],$_POST['observacion'],$_SESSION['idContribuyente']);
        if(funcionAgregarInversion($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                $idInversion = funcionObtenerIdentificadorInversion(array($_POST['cedJuridica'],$_POST['fecha'],$_POST['monto'],$_SESSION['idContribuyente']));
                for ($i = 0; $i < count($periodos); $i++) {
                    funcionAgregarPeriodo_Inversion(array($periodos[$i],$idInversion,$_POST['monto']));
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Inversión','Agregada','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'editarInversion')
    {
        $arreglo = array($_POST['sociedad'],$_POST['cedJuridica'],$_POST['fecha'],$_POST['monto'],$_POST['observacion'],$_POST['idInversion']);
        if(funcionEditarInversion($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    funcionEditarPeriodo_Inversion(array($_POST['monto'],$periodos[$i],$_POST['idInversion']));
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Inversión','Modificada','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'deshabilitarInv')
    {
        $arreglo = array($_POST['idInversion']);
        if(funcionDeshabilitarInversion($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    funcionEliminarPeriodo_Inversion(array($periodos[$i],$_POST['idInversion']));
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Inversión','Deshabilitada','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '2';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'habilitarInv')
    {
        $arreglo = array($_POST['idInversion']);
        if(funcionHabilitarInversion($arreglo))
        {
            $periodos = funcionPeriodosAbiertos($_SESSION['idContribuyente']);
            if(count($periodos) > 0)
            {
                for ($i = 0; $i < count($periodos); $i++) {
                    $arreglo = array($periodos[$i],$_POST['idInversion'],$_POST['monto']);
                    funcionAgregarPeriodo_Inversion($arreglo);
                }
            }
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Inversión','Habilitada','Cliente: '.$_SESSION['nomContribuyente'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    
}

function depreciacionMensual($tipo,$monto){
    return  (floatval($monto) / intval(funcionObtenerInformacionTipoActivo($tipo)['mesesDepreciado']));
}
function depreciacionAcumulada($depreciacionMensual,$fechaRegistro){
    return floatval($depreciacionMensual) * diferenciaMesesEntreFechas('now',$fechaRegistro);
}
function depreciacionPeriodo($depreciacionMensual){
    if(intval(date('n')) > 9)
        $inicioPeriodo = date('Y').'/10/01';
    else
        $inicioPeriodo = (intval(date('Y'))-1).'/10/01';
    return floatval($depreciacionMensual) * diferenciaMesesEntreFechas('now',$inicioPeriodo);
}