<?php
session_start();
include "../../modelo/conexionBD.php";
include "../../modelo/consultasBD.php";

$conexion = conectar();
if($_POST['elemento'] == 'usuarios')
{
    $res = '<table class="table compact table-striped table-hover dataTable tablaCUExistentes"  cellspacing="0" width="100%">
            <thead>
                <tr class="fondoAzul"><th class="columOculta">Identificador</th><th>Nombre Completo</th><th>Nombre de Usuario</th><th>Correo Electrónico</th><th>Permisos</th><th>Estado</th><th class="columOculta">EstadoID</th><th class="columOculta">AdmiID</th><th class="columOculta">RevisarID</th><th class="columOculta">AprobarID</th><th class="columOculta">EditarID</th></tr>
            </thead>
            <tbody>';
    foreach ($conexion->query(consultaMostrarUsuariosExistentes()) as $rows) {
        $permisos = '';
        $res.= '<tr>';
        $res.= '<td class="columOculta">'.$rows['identificador'].'</td>';
        $res.= '<td>'.$rows['nombreCompleto'].'</td>';
        $res.= '<td>'.$rows['nombreUsuario'].'</td>';
        $res.= '<td>'.$rows['email'].'</td>';
        if($rows['estado'] == 1)
            $estado = 'Habilitado';
        else
            $estado = 'Deshabilitado';
        if($rows['tipo'] == 1)
            $permisos = 'Administrador <br>'; 
        if($rows['tipo'] == 2)
            $permisos = 'Usuario <br>'; 
        if($rows['tipo'] == 3)
            $permisos = 'Digitador <br>'; 
        if($rows['revisar'] == 1)
            $permisos .= 'Revisar <br>'; 
        if($rows['aprobar'] == 1)
            $permisos .= 'Aprobar <br>'; 
        if($rows['editar'] == 1)
            $permisos .= 'Editar'; 
        if($permisos == '')
            $permisos = 'Ninguno';
        $res.= '<td>'.$permisos.'</td>';
        $res.= '<td>'.$estado.'</td>';
        $res.= '<td class="columOculta">'.$rows['estado'].'</td>';
        $res.= '<td class="columOculta">'.$rows['tipo'].'</td>';
        $res.= '<td class="columOculta">'.$rows['revisar'].'</td>';
        $res.= '<td class="columOculta">'.$rows['aprobar'].'</td>';
        $res.= '<td class="columOculta">'.$rows['editar'].'</td>';
        $res.= '</tr>';
    }
    echo $res.'</tbody></table><script>
    $(".dataTable").DataTable({"order": [[1, "asc"]]});
    $(document).ready(function () {
        var table = $(".dataTable").DataTable();
        $(".dataTable tbody").on("click", "tr", function () {
            var data = table.row(this).data();
            if ($(this).hasClass("info"))
                desSeleccionarElemento(this);
            else
                seleccionarElemento(this, "u", data);
        });
        $(".emergente").magnificPopup({
            type: "inline",
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: "auto",
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: "my-mfp-slide-bottom"
        });
    });
</script>';
}


if($_POST['elemento'] == 'cuentas')
{
    $res = '<table class="table compact table-striped table-hover dataTable tablaCUExistentes"  cellspacing="0" width="100%">
            <thead>
                <tr class="fondoAzul"><th>Código</th><th>Nombre</th><th>Estado</th><th class="columOculta">EstadoID</th></tr>
            </thead>
            <tbody>';
    foreach ($conexion->query(consultaMostrarCuentasExistentes()) as $rows) {
        $res.= '<tr>';
        $res.= '<td class="codi" name="'.$rows['codigo'].'">'.$rows['codigo'].'</td>';
        $res.= '<td>'.utf8_decode($rows['nombre']).'</td>';
        if($rows['estado'] == 1)
            $estado = 'Habilitado';
        else
            $estado = 'Deshabilitado';
        $res.= '<td>'.$estado.'</td>';
        $res.= '<td class="columOculta">'.$rows['estado'].'</td>';
        $res.= '</tr>';
    }
    echo $res.'</tbody></table><script>
    $(".dataTable").DataTable({"order": [[0, "asc"]]});
    $(document).ready(function () {
        var table = $(".dataTable").DataTable();
        $(".dataTable tbody").on("click", "tr", function () {
            var data = table.row(this).data();
            if($(this).children(".codi").attr("name") !== "7-01-01"){
                if ($(this).hasClass("info"))
                    desSeleccionarElemento(this);
                else
                    seleccionarElemento(this, "c", data);
            }
            else
                alert("La cuenta de amortizaciones no puede ser editada ni deshabilitada, es necesaria para los movimientos del período.");
        });
        $(".emergente").magnificPopup({
            type: "inline",
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: "auto",
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: "my-mfp-slide-bottom"
        });
    });
</script>';
}

if($_POST['elemento'] == 'contribuyentes')
{
    $res = '<table class="table compact table-striped table-hover dataTable tablaCUExistentes"  cellspacing="0" width="100%">
            <thead>
                <tr class="fondoAzul"><th>Tipo</th><th>Identificación</th><th>Nombre</th><th>Cédula DGT</th><th class="columOculta">Telefono</th><th class="columOculta">Email</th><th class="columOculta">Direccion</th><th class="columOculta">TipoID</th></tr>
            </thead>
            <tbody>';
    foreach ($conexion->query(consultaMostrarContribuyentesExistentes()) as $rows) {
        $res.= '<tr>';
        if($rows['tipo'] == 1)
            $tipo = 'Físico';
        else
            $tipo = 'Jurídico';
        $res.= '<td>'.$tipo.'</td>';
        $res.= '<td>'.$rows['identificacion'].'</td>';
        $res.= '<td>'.$rows['nombre'].'</td>';
        if($rows['cedulaDGT'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['cedulaDGT'].'</td>';
        if($rows['telefono'] == '')
            $res.= '<td class="columOculta">No indicado</td>';
        else
            $res.= '<td class="columOculta">'.$rows['telefono'].'</td>';
        if($rows['email'] == '')
            $res.= '<td class="columOculta">No indicado</td>';
        else
            $res.= '<td class="columOculta">'.$rows['email'].'</td>';
        if($rows['direccion'] == '')
            $res.= '<td class="columOculta">No indicado</td>';
        else
            $res.= '<td class="columOculta">'.$rows['direccion'].'</td>';
        $res.= '<td class="columOculta">'.$rows['tipo'].'</td>';
        $res.= '</tr>';
    }
    echo $res.'</tbody></table><script>
    $(".dataTable").DataTable({"order": [[2, "asc"]]});
    $(document).ready(function () {
        var table = $(".dataTable").DataTable();
        $(".dataTable tbody").on("click", "tr", function () {
            var data = table.row(this).data();
            if ($(this).hasClass("info"))
                desSeleccionarElemento(this);
            else
                seleccionarElemento(this, "c", data);
        });
        $(".emergente").magnificPopup({
            type: "inline",
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: "auto",
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: "my-mfp-slide-bottom"
        });
    });
</script>';
}

if($_POST['elemento'] == 'activos')
{
    $res = '<table class="table compact table-striped table-hover dataTable tablaCUExistentes"  cellspacing="0" width="100%">
            <thead>
                <tr class="fondoAzul"><th class="columOculta">Identificador</th><th>Proveedor</th><th>Descripción</th><th>Tipo de A.F</th><th>Fecha de Compra</th><th>Monto</th>
                <th class="columOculta">Meses de Depreciación</th><th class="columOculta">Depreciación Mensual</th><th class="columOculta">Meses de Depreciado</th><th class="columOculta">Depreciación Acumulada</th><th class="columOculta">Depreciación del Período</th>
                <th class="columOculta">Fecha</th><th class="columOculta">IdTipo</th><th>Estado</th><th class="columOculta">IdEstado</th><th class="columOculta">Monto</th></tr>
            </thead>
            <tbody>';
    foreach ($conexion->query(consultaMostrarActivosExistentes($_SESSION['idContribuyente'])) as $rows) {
        $res.= '<tr>';
        $res.= '<td class="columOculta">'.$rows['identificador'].'</td>';
        if($rows['proveedor'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['proveedor'].'</td>';
        if($rows['descripcion'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['descripcion'].'</td>';
        $infoTipo = consultarBase(consultaObtenerInfoTipoActivo(), $conexion, array($rows['tipo']));
        $res.= '<td>'.utf8_decode($infoTipo['nombre']).'</td>';
        if($rows['fecha'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterDate ($rows['fecha']).'</td>';
        $res.= '<td>'.filterMoney('0',$rows['monto']).'</td>';
        $res.= '<td class="columOculta">'.$infoTipo['mesesDepreciado'].'</td>';
        $res.= '<td class="columOculta">'.intval($rows['depreciacionMensual']).'</td>';
        $mesActual = getdate()["mon"];
        $res.= '<td class="columOculta">'.diferenciaMesesEntreFechas('now',$rows['fechaRegistro']).'</td>';//(intval($mesActual)-intval(substr($rows['fechaRegistro'],5,2))).'</td>';
        $res.= '<td class="columOculta">'.intval($rows['depreciacionAcumulada']).'</td>';
        $res.= '<td class="columOculta">'.intval($rows['depreciacionPeriodo']).'</td>';
        $res.= '<td class="columOculta">'.$rows['fecha'].'</td>';
        $res.= '<td class="columOculta">'.$rows['tipo'].'</td>';
        if($rows['estado'] == 1)
            $estado = 'Habilitado';
        else
            $estado = 'Deshabilitado';
        $res.= '<td>'.$estado.'</td>';
        $res.= '<td class="columOculta">'.$rows['estado'].'</td>';
        $res.= '<td class="columOculta">'.$rows['monto'].'</td>';
        $res.= '</tr>';
    }
    echo $res.'</tbody></table><script>
    $(".dataTable").DataTable({"order": [[14, "des"]]});
    $(document).ready(function () {
        var table = $(".dataTable").DataTable();
        $(".dataTable tbody").on("click", "tr", function () {
        var data = table.row(this).data();
            if ($(this).hasClass("info"))
            {
                desSeleccionarElemento(this);
            } else
            {
                seleccionarElemento(this,"act",data);
            }
        });
        $(".emergente").magnificPopup({
            type: "inline",
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: "auto",
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: "my-mfp-slide-bottom"
        });
    });
</script>';
}

if($_POST['elemento'] == 'pasivos')
{
    $res = '<table class="table compact table-striped table-hover dataTable tablaCUExistentes"  cellspacing="0" width="100%">
            <thead>
                <tr class="fondoAzul"><th>Entidad y Número de Operación</th><th>Fecha de Apertura</th><th>Fecha de Vencimiento</th><th>Tasa de Interés</th><th>Principal</th><th>Saldo</th><th>Observaciones</th><th>Documentación de Respaldo</th><th>Estado</th><th class="columOculta">IdEstado</th><th class="columOculta">FechaApertura</th><th class="columOculta">FechaVencimiento</th><th class="columOculta">Principal</th><th class="columOculta">Saldo</th></tr>
            </thead>
            <tbody>';
    foreach ($conexion->query(consultaMostrarPasivosExistentes($_SESSION['idContribuyente'])) as $rows) {
        $res.= '<tr>';
        if($rows['banco'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['banco'].'</td>';
        if($rows['fechaApertura'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterDate ($rows['fechaApertura']).'</td>';
        if($rows['fechaVencimiento'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterDate ($rows['fechaVencimiento']).'</td>';
        if($rows['interes'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['interes'].'</td>';
        if($rows['principal'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterMoney ('0',$rows['principal']).'</td>';
        if($rows['saldo'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterMoney ('0',$rows['saldo']).'</td>';
        if($rows['observacion'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['observacion'].'</td>';
        if($rows['documento'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['documento'].'</td>';
        if($rows['estado'] == 1)
            $estado = 'Habilitado';
        else
            $estado = 'Deshabilitado';
        $res.= '<td>'.$estado.'</td>';
        $res.= '<td class="columOculta">'.$rows['estado'].'</td>';
        $res.= '<td class="columOculta">'.$rows['fechaApertura'].'</td>';
        $res.= '<td class="columOculta">'.$rows['fechaVencimiento'].'</td>';
        $res.= '<td class="columOculta">'.$rows['principal'].'</td>';
        $res.= '<td class="columOculta">'.$rows['saldo'].'</td>';
        $res.= '</tr>';
    }
    echo $res.'</tbody></table><script>
    $(".dataTable").DataTable({"order": [[9, "des"]]});
    $(document).ready(function () {
        var table = $(".dataTable").DataTable();
        $(".dataTable tbody").on("click", "tr", function () {
        var data = table.row(this).data();
            if ($(this).hasClass("info"))
            {
                desSeleccionarElemento(this);
            } else
            {
                seleccionarElemento(this,"pas",data);
            }
        });
        $(".emergente").magnificPopup({
            type: "inline",
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: "auto",
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: "my-mfp-slide-bottom"
        });
    });
</script>';
}

if($_POST['elemento'] == 'patrimonios')
{
    $res = '<table class="table compact table-striped table-hover dataTable tablaCUExistentes"  cellspacing="0" width="100%">
            <thead>
                <tr class="fondoAzul"><th class="columOculta">Identificador</th><th>Fecha</th><th>Accionista</th><th>Acta</th><th>Monto del Aporte</th><th>Fecha de Devolución</th><th>Estado</th><th class="columOculta">IdEstado</th><th class="columOculta">Fecha</th><th class="columOculta">FechaDevolucion</th><th class="columOculta">Monto</th></tr>
            </thead>
            <tbody>';
    foreach ($conexion->query(consultaMostrarPatrimoniosExistentes($_SESSION['idContribuyente'])) as $rows) {
        $res.= '<tr>';
        $res.= '<td class="columOculta">'.$rows['identificador'].'</td>';
        if($rows['fecha'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterDate ($rows['fecha']).'</td>';
        if($rows['accionista'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['accionista'].'</td>';
        if($rows['acta'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['acta'].'</td>';
        if($rows['monto'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterMoney ('0',$rows['monto']).'</td>';
        if($rows['fechaDevolucion'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterDate ($rows['fechaDevolucion']).'</td>';
        if($rows['estado'] == 1)
            $estado = 'Habilitado';
        else
            $estado = 'Deshabilitado';
        $res.= '<td>'.$estado.'</td>';
        $res.= '<td class="columOculta">'.$rows['estado'].'</td>';
        $res.= '<td class="columOculta">'.$rows['fecha'].'</td>';
        $res.= '<td class="columOculta">'.$rows['fechaDevolucion'].'</td>';
        $res.= '<td class="columOculta">'.$rows['monto'].'</td>';
        $res.= '</tr>';
    }
    echo $res.'</tbody></table><script>
    $(".dataTable").DataTable({"order": [[7, "des"]]});
    $(document).ready(function () {
        var table = $(".dataTable").DataTable();
        $(".dataTable tbody").on("click", "tr", function () {
        var data = table.row(this).data();
            if ($(this).hasClass("info"))
            {
                desSeleccionarElemento(this);
            } else
            {
                seleccionarElemento(this,"pat",data);
            }
        });
        $(".emergente").magnificPopup({
            type: "inline",
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: "auto",
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: "my-mfp-slide-bottom"
        });
    });
</script>';
}

if($_POST['elemento'] == 'inversiones')
{
    $res = '<table class="table compact table-striped table-hover dataTable tablaCUExistentes"  cellspacing="0" width="100%">
            <thead>
                <tr class="fondoAzul"><th class="columOculta">Identificador</th><th>Sociedad</th><th>Cédula Jurídica</th><th>Fecha</th><th>Monto</th>
                <th>Observación</th><th>Estado</th><th class="columOculta">IdEstado</th><th class="columOculta">Fecha</th><th class="columOculta">Monto</th></tr>
            </thead>
            <tbody>';
    foreach ($conexion->query(consultaMostrarInversionesExistentes($_SESSION['idContribuyente'])) as $rows) {
        $res.= '<tr>';
        $res.= '<td class="columOculta">'.$rows['identificador'].'</td>';
        if($rows['sociedad'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['sociedad'].'</td>';
        $res.= '<td>'.$rows['cedulajuridica'].'</td>';
        if($rows['fecha'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterDate ($rows['fecha']).'</td>';
        if($rows['monto'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterMoney ('0',$rows['monto']).'</td>';
        if($rows['observacion'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['observacion'].'</td>';
        if($rows['estado'] == 1)
            $estado = 'Habilitado';
        else
            $estado = 'Deshabilitado';
        $res.= '<td>'.$estado.'</td>';
        $res.= '<td class="columOculta">'.$rows['estado'].'</td>';
        $res.= '<td class="columOculta">'.$rows['fecha'].'</td>';
        $res.= '<td class="columOculta">'.$rows['monto'].'</td>';
        $res.= '</tr>';
    }
    echo $res.'</tbody></table><script>
    $(".dataTable").DataTable({"order": [[7, "des"]]});
    $(document).ready(function () {
        var table = $(".dataTable").DataTable();
        $(".dataTable tbody").on("click", "tr", function () {
        var data = table.row(this).data();
            if ($(this).hasClass("info"))
            {
                desSeleccionarElemento(this);
            } else
            {
                seleccionarElemento(this,"inv",data);
            }
        });
        $(".emergente").magnificPopup({
            type: "inline",
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: "auto",
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: "my-mfp-slide-bottom"
        });
    });
</script>';
}

if($_POST['elemento'] == 'anticipos')
{
    $res = '<table class="table compact table-striped table-hover dataTable tablaCUExistentes"  cellspacing="0" width="100%">
            <thead>
                <tr class="fondoAzul"><th class="columOculta">Identificador</th><th>Formulario-Entidad</th><th>Tipo de Pago</th><th>Tipo de Anticipo</th>
                <th>Monto</th><th>Fecha</th><th class="columOculta">Fecha</th><th class="columOculta">TipoID</th><th class="columOculta">Monto</th></tr>
            </thead>
            <tbody>';
    foreach ($conexion->query(consultaMostrarAnticiposExistentes($_SESSION['idPeriodo'])) as $rows) {
        $res.= '<tr>';
        $res.= '<td class="columOculta">'.$rows['identificador'].'</td>';
        if($rows['formulario'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['formulario'].'</td>';
        if($rows['tipoPago'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['tipoPago'].'</td>';
        $tipoAnticipo = $rows['tipo'];
        if($tipoAnticipo == '1')
            $res.= '<td>Retención 2%</td>';
        else{
            if($tipoAnticipo == '2')
                $res.= '<td>Otras Retenciones</td>';
            else{
                if($tipoAnticipo == '3')
                    $res.= '<td>Pagos parciales</td>';
            }
        }
        if($rows['monto'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterMoney ('0',$rows['monto']).'</td>';
        if($rows['fecha'] == null)
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.filterDate ($rows['fecha']).'</td>';
        $res.= '<td class="columOculta">'.$rows['fecha'].'</td>';
        $res.= '<td class="columOculta">'.$rows['tipo'].'</td>';
        $res.= '<td class="columOculta">'.$rows['monto'].'</td>';
        $res.= '</tr>';
    }
    echo $res.'</tbody></table><script>
    $(".dataTable").DataTable({"order": [[6, "des"]]});
    $(document).ready(function () {
        var table = $(".dataTable").DataTable();
        $(".dataTable tbody").on("click", "tr", function () {
        var data = table.row(this).data();
            if ($(this).hasClass("info"))
            {
                desSeleccionarElemento(this);
            } else
            {
                seleccionarElemento(this,"",data);
            }
        });
        $(".emergente").magnificPopup({
            type: "inline",
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: "auto",
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: "my-mfp-slide-bottom"
        });
    });
</script>';
}

if($_POST['elemento'] == 'bitacora')
{
    $res = '<table style="text-align: center" class="table compact table-striped table-hover dataTable" >
        <thead><tr class="fondoAzul"><th><center>Fecha</center></th><th><center>Usuario</center></th><th><center>Elemento</center></th><th><center>Acción</center></th><th><center>Observación</center></th></tr>
        </thead><tbody>';
    foreach ($conexion->query(consultaMostrarBitacora()) as $rows) {
        $res.= '<tr>';
        $res.= '<td>'.filterDateTime($rows['fecha']).'</td>';
        $res.= '<td>'.consultarBase(consultaObtenerNombreUsuario(), $conexion, array($rows['idUsuario']))['nombreCompleto'].'</td>';
        $res.= '<td>'.$rows['elemento'].'</td>';
        $res.= '<td>'.$rows['accion'].'</td>';
        $res.= '<td>'.$rows['observacion'].'</td>';
        $res.= '</tr>';
    }
    echo $res.'</tbody></table><script>$(".dataTable").DataTable({"order": [[0, "des"]]});</script>';
}

if($_POST['elemento'] == 'rangoImpuesto')
{   
    $tipo = $_POST['tipo'];
    $anno = $_POST['anno'];
    if($tipo == '1')
        $tipoTitulo = 'Física';
    if($tipo == '2')
        $tipoTitulo = 'Jurídica';
    $res = "<table class='table table-bordered table-striped' style='max-width: 500px;'>
        <thead><tr class='fondoAzul'><th colspan='2'>Persona $tipoTitulo - Período $anno</th></tr>
                <tr><th>Tarifa</th><th>Rango</th></tr>
        </thead><tbody>";
    foreach ($conexion->query(consultaMostrarRangoImpuesto($tipo,$anno)) as $rows) {
        $res.= '<tr>';
        $res.= '<td>'.$rows['tarifa'].' %</td>';
        if($rows['rango'] == '')
            $res .= '<td> - </td>';
        else
            $res.= '<td>'.filterMoney ('0',$rows['rango']).'</td>';
        $res.= '</tr>';
    }
    echo $res.'</tbody></table>';
}
if($_POST['elemento'] == 'movimientos')
{   
    $res = '
        <table class="table compact tablaCUExistentes"  cellspacing="0" width="100%" style="margin-bottom:0;">
            <tr id="actual">
                    <td class="columOculta"><input type="text" class="form-control" id="idMovimiento" value=""/></td>
                    <td><input type="text" placeholder="# grupo" class="form-control" id="grupo" maxlength="20"/></td>
                    <td><input type="text" placeholder="Proveedor" class="form-control" id="proveedor" maxlength="50" disabled/></td>
                    <td><input type="text" placeholder="Cédula Jurídica" class="form-control" id="cedula" maxlength="15" disabled/></td>
                    <td><input type="text" placeholder="Comprobante" class="form-control" id="comprobante" maxlength="30" disabled/></td>
                    <td><textarea placeholder="Observación" class="form-control" type="text" id="observacion" maxlength="100" disabled></textarea></td>
                    <td><input type="text" placeholder="Fecha" class="form-control" id="fecha" disabled/><span style="display:none;color:red;font-size:13px;text-align:center;" id="notaFechaFormato">DD/MM/AAAA</span></td>
                    <td>
                        <input type="text" class="form-control" id="cuenta" placeholder="Cuenta" disabled/>
                        <span style="font-size:13px;text-align:center;"></span><br><br>
                        <select id="pasivoMOV" class="form-control" style="display:none;"></select>
                        <input type="hidden" class="form-control" id="saldoPasivoMOV"/><br>
                    </td>
                    <td><input type="number" step="any" class="form-control" id="mont" min="0" placeholder="Monto" disabled/></td>
                    <td><span style="font-size:13px;text-align:center;">Dólares</span><input type="checkbox" class="form-control" id="dolare" disabled/></td>
                    <td class="columOculta"><input type="text" id="dolareActual"/></td>
                    <td class="columOculta"><input type="text" id="montoActual"/></td>
                    <td class="columOculta"><input type="text" id="annoPeriodoMOV"/></td>
                    <td class="columOculta"><input type="text" id="pasivoActual"/></td>
                </tr>
</table><span style="color:#0f0f3d;font-style:italic;font-size:14px;">Utilice la tecla "Enter" para cambiar de celda</span><hr>
<div class="botonesAdministrar">
            <center><div class="" id="botonesMovimientos">
                <button title="Editar" class="btn btn-sm botonColor menuCUExistente" id="editarMovimiento">
                    <span id="opcMenuConfig">Editar&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-edit"></span>
                </button>
                <button title="Eliminar" class="btn btn-sm botonColor menuCUExistente emergente" href="#eliminarMovimiento" id="eliminarMovimiento">
                    <span id="opcMenuConfig">Eliminar&nbsp;&nbsp;</span>
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
            </div></center>
    </div>        
<table class="table compact table-striped table-hover dataTable tablaCUExistentes"  cellspacing="0" width="100%">
            <thead>
                <tr class="fondoAzul">
                    <th class="columOculta">Identificador</th>
                    <th># Grupo</th>
                    <th>Proveedor</th>
                    <th>Cédula Jurídica</th>
                    <th>Comprobante</th>
                    <th>Observación</th>
                    <th>Fecha</th>
                    <th>Código Contable</th>
                    <th>Monto</th>
                    <th>Dólares</th>
                    <th class="columOculta">Fecha</th>
                    <th class="columOculta">DolaresID</th>
                    <th class="columOculta">Monto</th>
                    <th class="columOculta">Pasivo</th>
                </tr>
            </thead>
            <tbody>';
    $dolar = consultarBase(consultaObtenerDolarPeriodo(), $conexion, array($_SESSION['idPeriodo']))['dolar'];
    foreach ($conexion->query(consultaMostrarMovimientos($_SESSION['idPeriodo'])) as $rows) {
        $permisos = '';
        $res.= '<tr>';
        $res.= '<td class="columOculta">'.$rows['identificador'].'</td>';
        if($rows['grupo'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['grupo'].'</td>';
        if($rows['proveedor'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['proveedor'].'</td>';
        if($rows['cedula'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['cedula'].'</td>';
        if($rows['comprobante'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['comprobante'].'</td>';
        if($rows['observacion'] == '')
            $res.= '<td>No indicado</td>';
        else
            $res.= '<td>'.$rows['observacion'].'</td>';
        $res.= '<td>'.  filterDate($rows['fecha']).'</td>';
        $pasivo = '';
        if($rows['codigoContable'] === '7-01-01')
            $pasivo = ' de '.$rows['idPasivo'];
        $res.= '<td title="'.  utf8_decode(consultarBase(consultaObtenerNombreCuenta(), $conexion, array($rows['codigoContable']))['nombre']).$pasivo.'">'.$rows['codigoContable'].'</td>';
        if($rows['moneda'] == '0')
            $res.= '<td>'.  filterMoney ('0',$rows['monto']).'</td>';
        else
            $res.= '<td title="'.  filterMoney('0',intval($rows['monto'])*intval($dolar)).'">'.filterMoney ('1',$rows['monto']).'</td>';
        if($rows['moneda'] == '0')
            $res.= '<td><span style="color:red;" class="glyphicon glyphicon-remove"></span></td>';
        else
            $res.= '<td><span style="color:green;" class="glyphicon glyphicon-ok"></span></td>';
        $res.= '<td class="columOculta">'.$rows['fecha'].'</td>';
        $res.= '<td class="columOculta">'.$rows['moneda'].'</td>';
        $res.= '<td class="columOculta">'.$rows['monto'].'</td>';
        $res.= '<td class="columOculta">'.$rows['idPasivo'].'</td>';
        $res.= '</tr>';
    }
    echo $res.'</tbody></table><script src="../js/movimientos.js"></script>';
}

desconectar($conexion);