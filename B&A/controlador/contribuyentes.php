<?php
session_start();
include('conectorCM/conectorCM.php');

if(isset($_POST['accion']))
{
    if($_POST['accion'] == 'administrarC')
    {
        if($_POST['id'])//comprobar que exista el contribuyente
        {
            $_SESSION['idContribuyente'] = $_POST['id']; //cargar datos de contribuyente
        }
        header('Location: ../vista/administrar.php');//redireccionar a la página de administración
    }
    if($_POST['accion'] == 'editarC')
    {
        $arreglo = array($_POST['tipo'],$_POST['identificacion'],
            $_POST['nombre'],$_POST['cedulaDGT'],
            $_POST['telefono'],$_POST['email'],$_POST['direccion'],
            $_POST['idActual'],$_POST['tipoActual']);
        if(funcionEditarContribuyente($arreglo))
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Contribuyente','Modificado','Nombre: '.$_POST['nombre'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'nuevoC')
    {
        $arreglo = array($_POST['identificacion'],$_POST['tipo'],
            $_POST['nombre'],$_POST['cedulaDGT'],$_POST['direccion'],
            $_POST['telefono'],$_POST['email']);
        if(funcionAgregarContribuyente($arreglo))
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Contribuyente','Agregado','Nombre: '.$_POST['nombre'],$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'cargarInfoDP')
    {
        $_SESSION['idContribuyente'] = $_POST['idActual'];
        $_SESSION['nomContribuyente'] = $_POST['nomActual'];
        $_SESSION['tipoContribuyente'] = $_POST['tipoActual'];
        echo '1';
        exit;
    }
    if($_POST['accion'] == 'crearPeriodo')
    {
        $anno = $_POST['anno'];
        
        if(funcionConsultarExisteRango(array($_SESSION['tipoContribuyente'],$anno)) > 0){
        
            $cierre = $_POST['cierre'];
            $arreglo = array($anno,1,$_SESSION['idContribuyente'],$_SESSION['idUsuario'],$cierre,  funcionObtenerDolar());
            if(funcionCrearPeriodo($arreglo))
            {
                $fecha = getdate();
                funcionAgregarBitacora(
                    array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                        " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                        'Período','Creado','Cliente: '.$_SESSION['nomContribuyente'].', Año:'.$anno,$_SESSION['idUsuario'])
                    );
                if(funcionEsDeclaracion(array(intval($anno)-1,$_SESSION['idContribuyente'])) == '0')
                {funcionCrearDeclaracion($_SESSION['idContribuyente'], intval($anno)-1);}
                if(funcionEsDeclaracion(array($anno,$_SESSION['idContribuyente'])) == '0')
                {funcionCrearDeclaracion($_SESSION['idContribuyente'], $anno);}
                $_SESSION['idPeriodo'] = funcionEsPeriodo(array($anno,$_SESSION['idContribuyente']));
                
                $activosHab = funcionObtenerActivosHabilitados($_SESSION['idContribuyente']);
                $cantActivos = count($activosHab);
                if($cantActivos > 0)
                {
                    for($j = 0;$j < $cantActivos;$j++){
                        $arreglo = array($_SESSION['idPeriodo'],$activosHab[$j]['identificador'],
                            $activosHab[$j]['monto'],$activosHab[$j]['depreciacionAcumulada'],$activosHab[$j]['depreciacionPeriodo']);
                        funcionAgregarPeriodo_Activo($arreglo);
                    }
                }
                
                $pasivosHab = funcionObtenerPasivosHabilitados($_SESSION['idContribuyente']);
                $cantPasivos = count($pasivosHab);
                if($cantPasivos > 0)
                {
                    for($j = 0;$j < $cantPasivos;$j++){
                        $arreglo = array($_SESSION['idPeriodo'],$pasivosHab[$j]['identificador'],
                            $pasivosHab[$j]['principal'],$pasivosHab[$j]['saldo']);
                        funcionAgregarPeriodo_Pasivo($arreglo);
                    }
                }
                
                $patrimoniosHab = funcionObtenerPatrimoniosHabilitados($_SESSION['idContribuyente']);
                $cantPatrimonios = count($patrimoniosHab);
                if($cantPatrimonios > 0)
                {
                    for($j = 0;$j < $cantPatrimonios;$j++){
                        $arreglo = array($_SESSION['idPeriodo'],$patrimoniosHab[$j]['identificador'],
                            $patrimoniosHab[$j]['monto']);
                        funcionAgregarPeriodo_Patrimonio($arreglo);
                    }
                }
                
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
                echo '1';
            }
            else
                echo '0';
        }
        else
            echo '7';
        exit;
    }
    
    if($_POST['accion'] == 'crearDeclaracion')
    {
        $anno = $_POST['anno'];
        $arreglo = array($anno,$_SESSION['idContribuyente']);
        if(funcionEsPeriodo($arreglo) == ''){
            if(funcionCrearDeclaracion($_SESSION['idContribuyente'],$anno))
            {
                $fecha = getdate();
                funcionAgregarBitacora(
                    array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                        " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                        'Declaración Jurada','Creada','Cliente: '.$_SESSION['nomContribuyente'].', Año:'.$anno,$_SESSION['idUsuario'])
                    );
                $_SESSION['idAnnoDeclaracion'] = $anno;
                echo '1';
            }
            else
                echo '0';
            exit;
        }
        else
            echo '0';
        exit;
    }
    if($_POST['accion'] == 'agregarRangoImpuesto')
    {
        $tipo = $_POST['tipo'];
        $tipoTitulo = 'Jurídico';
        $anno = $_POST['anno'];
        $band = true;
        $rango3 = $_POST['rango3'];
        $rango5 = $_POST['rango5'];
        
        if($rango3 === '')
            $rango3 = null;
        if($rango5 === '')
            $rango5 = null;
        
        $band *= funcionAgregarRango(array($tipo,$anno,$_POST['tarifa1'],$_POST['rango1']));
        $band *= funcionAgregarRango(array($tipo,$anno,$_POST['tarifa2'],$_POST['rango2']));
        $band *= funcionAgregarRango(array($tipo,$anno,$_POST['tarifa3'],$rango3));
        if($tipo == '1'){
            $tipoTitulo = 'Físico';
            $band *= funcionAgregarRango(array($tipo,$anno,$_POST['tarifa4'],$_POST['rango4']));
            $band *= funcionAgregarRango(array($tipo,$anno,$_POST['tarifa5'],$rango5));
        }
        if($band)
        {
            $fecha = getdate();
            funcionAgregarBitacora(
                array($fecha["year"]."-".$fecha["mon"]."-".$fecha["mday"].
                    " ".$fecha["hours"].":".$fecha["minutes"].":".$fecha["seconds"],
                    'Rango de Impuesto','Creado','Tipo: '.$tipoTitulo.', Año:'.$anno,$_SESSION['idUsuario'])
                );
            echo '1';
        }
        else
            echo '0';
        exit;
    }
}
else
{
    header('Location: ../index.php');
}