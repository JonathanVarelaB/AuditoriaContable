
var arregloDataGlobal = '';
var aspectosModificados = [];
//------------------------------------CONFIGURACION BÁSICA AL CARGAR
$(document).ready(function () {
    actualizarTipoCambio();
    $('.input').focus(function () {
        $(this).css('background-color', '#e5e5e5');
    });
    $('.input').focusout(function () {
        $(this).css('background-color', 'white');
    });
    $('.nav2 li').click(function () {
        $(this).addClass('opcSelecMenuConfig');
    });
    $('.emergente').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-slide-bottom'
    });
    $('[data-toggle="tooltip"]').tooltip();
});

//--------------------------------------------EFECTOS
$('.salir').click(function(e){
    if(aspectosModificados.length > 0){
        e.preventDefault();
        link = $(this).attr('href');
        confirm(function(){aspectosModificados = [];window.location = link;});
    }
});
function nobackbutton(){
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button" //chrome
   window.onhashchange=function(){window.location.hash="no-back-button";}
}
$('#navegacion li').click(function () {$('#cerrarMenu').click();});
$('#menuBoton').click(function () {$(this).hide();$('#navegacion').slideDown();});
$(document).on('click', '#contenidoDinamico', function () {$('#cerrarMenu').click();});
$('#cerrarMenu').click(function () {$('#navegacion').slideUp();setTimeout("$('#menuBoton').show();", 400);});

function alertaError(msj) {
    $('#lugarAlerta').append('<div id="alertaID" class="alert fondoAzul fade in"><center><strong>¡ERROR!</strong>  ' + msj + '</center></div>');
}

function alertaExito(msj) {
    $('#lugarAlerta').append('<div id="alertaID" class="alert alert-info fade in"><center><strong>¡ÉXITO!</strong>  ' + msj + '</center></div>');
}

function cerrarAlerta() {$('#lugarAlerta').html('');}

function cerrarAlertaTiempo() {
    /*setTimeout("$('#alertaID').css('opacity','0.65');", 2750);
    setTimeout("$('#alertaID').css('opacity','0.6');", 3000);
    setTimeout("$('#alertaID').css('opacity','0.55');", 3250);
    setTimeout("$('#alertaID').css('opacity','0.5');", 3500);
    setTimeout("$('#alertaID').css('opacity','0.45');", 3750);
    setTimeout("$('#alertaID').css('opacity','0.4');", 4000);
    setTimeout("$('#alertaID').css('opacity','0.35');", 4250);
    setTimeout("$('#alertaID').css('opacity','0.3');", 4500);
    setTimeout("$('#alertaID').css('opacity','0.25');", 4750);
    setTimeout("$('#alertaID').css('opacity','0.2');", 5000);
    setTimeout("$('#alertaID').css('opacity','0.15');", 5250);
    setTimeout("$('#alertaID').css('opacity','0.1');", 5500);
    setTimeout("$('#alertaID').css('opacity','0.05');", 5750);
    setTimeout("$('#lugarAlerta').html('');", 6000);*/
    //setTimeout("$('#alertaID').slideUp('slow');", 5750);
    setTimeout("$('#lugarAlerta div:first-child').slideUp('slow');$('#lugarAlerta div:first-child').remove();", 3000);
    //setTimeout("", 6000);
    
    //setTimeout("$('#lugarAlerta').html('');", 6000);
}

function cerrarEmergente() {$.magnificPopup.close();}

$(document).on('click', '#primeraOpcion', function () {
    $('#tipoCambio2').html('<input style="width:60%;" type="number" min="1" maxlength="20" required name="monto" placeholder="Monto &#162;..." class="form-password form-control" id="tipoDeCambio" value="' + Number($('#dolarMostrar').text()) + '">');
    $('#tipoCambio3').html('<span>&#162 ' + $('#dolarMostrar').text() + '</span>');
});
$(document).on('click', '#editC', function () {$('#tipoContribuyente').css('border', '1px solid #ccc');});
$(document).on('click', '#editU', function () {$('.tipoSelect').css('border', '1px solid #ccc');});
$(document).on('change', '.tipoSelect', function () {$(this).css('border', '1px solid #ccc');$('#avisoRequired').hide();});
$(document).on('change', '#tipoContribuyente', function () {$(this).css('border', '1px solid #ccc');$('#avisoRequired').hide();});
$(document).on('click', '#botonesActivos button', function () {$('.tipoActivo').css('border', '1px solid #ccc');$('#fechaActivo').css('border', '1px solid #ccc');$('#notaFechaMala').hide();});
$(document).on('click', '#botonesAnticipos button', function () {$('.tipoAnticipo').css('border', '1px solid #ccc');$('#fechaAnticipo').css('border', '1px solid #ccc');$('#notaFechaMala').hide();});
$(document).on('click', '#botonesPasivos button', function () {$('#notaFechaMala1').hide();$('#notaFechaMala2').hide();$('#notaFechaMala3').hide();});
$(document).on('change', '.tipoActivo', function () {$(this).css('border', '1px solid #ccc');});
$(document).on('change', '.tipoAnticipo', function () {$(this).css('border', '1px solid #ccc');});
$(document).on('click', '.campoFecha', function () {$(this).css('border', '1px solid #ccc');});
$(document).on('focus', '.campoFecha', function () {$(this).next().fadeIn();$(this).next().next().hide();$('#notaFechaMala3').hide();});
$(document).on('focusout', '.campoFecha', function () {$(this).next().fadeOut();});
//---------------------------REFRESCAR TABLAS 
$(document).on('click', '#refrescarTablaUsuarios', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.post('../controlador/conectorCM/mostrarElementos.php', {elemento: 'usuarios'})
            .success(function (resp)
            {
                $('#divMostrarUsuarios').html('');
                $('#divMostrarUsuarios').html(resp);
                $.isLoading('hide');
            });
});
$(document).on('click', '#actualizarActivos', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.post('../controlador/permanentes.php', {accion: 'actualizarActivos'})
            .success(function(){
                $('#refrescarTablaActivos').click();
                $.isLoading('hide');
            });
});
$(document).on('click', '#refrescarTablaCuentas', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.post('../controlador/conectorCM/mostrarElementos.php', {elemento: 'cuentas'})
            .success(function (resp)
            {
                $('#divMostrarCuentas').html('');
                $('#divMostrarCuentas').html(resp);
                $.isLoading('hide');
            });
});

$(document).on('click', '#refrescarTablaContribuyentes', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.post('../controlador/conectorCM/mostrarElementos.php', {elemento: 'contribuyentes'})
            .success(function (resp)
            {
                $('#divMostrarContribuyentes').html('');
                $('#divMostrarContribuyentes').html(resp);
                $.isLoading('hide');
            });
});

$(document).on('click', '#refrescarTablaBitacora', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.post('../controlador/conectorCM/mostrarElementos.php', {elemento: 'bitacora'})
            .success(function (resp)
            {
                $('#divMostrarBitacora').html('');
                $('#divMostrarBitacora').html(resp);
                $.isLoading('hide');
            });
});

$(document).on('click', '#refrescarTablaActivos', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.post('../controlador/conectorCM/mostrarElementos.php', {elemento: 'activos'})
            .success(function (resp)
            {
                $('#divMostrarActivos').html('');
                $('#divMostrarActivos').html(resp);
                $.isLoading('hide');
            });
});
$(document).on('click', '#refrescarTablaPasivos', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.post('../controlador/conectorCM/mostrarElementos.php', {elemento: 'pasivos'})
            .success(function (resp)
            {
                $('#divMostrarPasivos').html('');
                $('#divMostrarPasivos').html(resp);
                $.isLoading('hide');
            });
});
$(document).on('click', '#refrescarTablaPatrimonios', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.post('../controlador/conectorCM/mostrarElementos.php', {elemento: 'patrimonios'})
            .success(function (resp)
            {
                $('#divMostrarPatrimonios').html('');
                $('#divMostrarPatrimonios').html(resp);
                $.isLoading('hide');
            });
});
$(document).on('click', '#refrescarTablaInversion', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.post('../controlador/conectorCM/mostrarElementos.php', {elemento: 'inversiones'})
            .success(function (resp)
            {
                $('#divMostrarInversiones').html('');
                $('#divMostrarInversiones').html(resp);
                $.isLoading('hide');
            });
});
$(document).on('click', '#refrescarTablaAnticipos', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.post('../controlador/conectorCM/mostrarElementos.php', {elemento: 'anticipos'})
            .success(function (resp)
            {
                $('#divMostrarAnticipos').html('');
                $('#divMostrarAnticipos').html(resp);
                $.isLoading('hide');
            });
});
$(document).on('click', '#refrescarReporteMensual', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.get('../controlador/conectorCM/reporteMensual.php')
            .success(function (resp)
            {
                $('#divMostrarReporteMensual').html('');
                $('#divMostrarReporteMensual').html(resp);
                $.isLoading('hide');
            });
});
$(document).on('click', '#refrescarEstadoResultados', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.get('../controlador/conectorCM/reporteEstadoResultados.php')
            .success(function (resp)
            {
                $('#divMostrarEstadoResultados').html('');
                $('#divMostrarEstadoResultados').html(resp);
                $.isLoading('hide');
            });
});
$(document).on('click', '#refrescarBalanceGeneral', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.get('../controlador/conectorCM/reporteBalanceGeneral.php')
            .success(function (resp)
            {
                $('#divMostrarBalanceGeneral').html('');
                $('#divMostrarBalanceGeneral').html(resp);
                $.isLoading('hide');
            });
});
$(document).on('click', '#refrescarTablaMovimientos', function () {
    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
    $.post('../controlador/conectorCM/mostrarElementos.php', {elemento: 'movimientos'})
            .success(function (resp)
            {
                aspectosModificados = [];
                $('#divMostrarMovimientos').html('');
                
                $('#cambiosMOV').fadeOut();
                $('#agregarMOV').fadeOut();
                $('#celdasMOV').fadeOut();
                $('#divMostrarMovimientos').html(resp);
                $.isLoading('hide');
            });
});

//--------------------------------------FORMULARIOS
function periodo_Declaracion(anno) {
    $.post('../controlador/administrarPeriodo.php',{anno:  anno, accion: 'cargarP_DJ'})
            .success(function(resp){
                resp = resp.substring(resp.length - 1);
                if (resp === 'p'){
                    $.post('../controlador/administrarPeriodo.php',{accion: 'cargarInfoPeriodo'})
                    .success(function(){window.location = 'administrar.php';});
                }
                else{
                    if (resp === 'd')
                        window.location = 'administrarPA.php';
                }
            });
}

$(document).on('submit', '#formTipoDeCambio', function () {
    $.post('../controlador/dolar.php', {accion: 'editar', monto: $('#tipoCambio2').children().val()})
            .success(function (resp) {
                resp = resp.substring(resp.length - 1);
                if (resp === '1')
                    actualizarTipoCambio();
                else
                {
                    alertaError('');
                    cerrarAlertaTiempo();
                }
            })
            .error(function () {
                alertaError('');
                cerrarAlertaTiempo();
            });
    $.magnificPopup.close();
});
function actualizarTipoCambio() {
    $.post('../controlador/dolar.php', {accion: 'consultar'})
            .success(function (resp) {
                $('#dolarMostrar').text(resp);
            })
            .error(function () {
                $('#dolarMostrar').text('');
            });
}
$(document).on("click",".aspectoDeclaracion",function(){
    var name = $(this).attr("name");
    if(aspectosModificados.indexOf(name) === -1)
        aspectosModificados.push(name);
});
$(document).on("change","#actual td input",function(){
    var name = $(this).attr("id");
    $('#celdasMOV').fadeIn();
    if($('#idMovimiento').val() == '')
        $('#agregarMOV').fadeIn();
    if(aspectosModificados.indexOf(name) === -1)
        aspectosModificados.push(name);
});
//---------------------------------------CARGAR DATOS PARA EMERGENTES
function seleccionarElemento(tr, elemento, data) {
    arregloDataGlobal = data;
    $('.tablaCUExistentes tr').removeClass('info');
    $(tr).addClass('info');
    var condicionBoton;
    var condicion;
    var gly;
    if (elemento === 'u')
        condicion = arregloDataGlobal[6];
    if (elemento === 'c')
        condicion = arregloDataGlobal[3];
    if (elemento === 'act')
        condicion = arregloDataGlobal[14];
    if (elemento === 'pas')
        condicion = arregloDataGlobal[9];
    if (elemento === 'pat')
        condicion = arregloDataGlobal[7];
    if (elemento === 'inv')
        condicion = arregloDataGlobal[7];
    if (condicion === '1')
    {
        condicionBoton = 'Deshabilitar';
        gly = '<span class="glyphicon glyphicon-remove"></span>';
    } else
    {
        condicionBoton = 'Habilitar';
        gly = '<span class="glyphicon glyphicon-ok"></span>';
    }
    $('.condicionBoton').text(condicionBoton);
    $('#condiciongly').html(gly);
    $('.menuCUExistente').css('visibility', 'visible');
}
function desSeleccionarElemento(tr) {
    $(tr).removeClass('info');
    $('.menuCUExistente').css('visibility', 'hidden');
}

$(document).on('click', '#botonesUsuario button', function () {
    $('#idUsuario').val(arregloDataGlobal[0]);
    $('#idUsuario2').val(arregloDataGlobal[0]);
    $('#nuevoNombreCompleto').val(arregloDataGlobal[1]);
    $('#nomCompletoHD').val(arregloDataGlobal[1]);
    $('#nombreUs').text(arregloDataGlobal[1]);
    $('#nuevoNombreUsuario').val(arregloDataGlobal[2]);
    $('#nombreUsuarioActual').val(arregloDataGlobal[2]),
    $('#nuevoEmailUsuario').val(arregloDataGlobal[3]);
    if (arregloDataGlobal[6] === '1')
    {
        $('#condicionTitulo').text('Deshabilitar');
        $('#condicionPreg').text('deshabilitar');
        $('#formAccionDes-HabU').val('deshabilitarU');
    } else
    {
        $('#condicionTitulo').text('Habilitar');
        $('#condicionPreg').text('habilitar');
        $('#formAccionDes-HabU').val('habilitarU');
    }
    selectedAdmin = selectedUsuario = selectedDigitador = '';
    if(arregloDataGlobal[7] == '1')
        selectedAdmin = 'selected="selected"';
    if(arregloDataGlobal[7] == '2')
        selectedUsuario = 'selected="selected"';
    if(arregloDataGlobal[7] == '3')
        selectedDigitador = 'selected="selected"';
    $('#nuevoTipoUsuario').html('<option value="0">Seleccione</option><option '+selectedAdmin+' value="1">Administrador</option><option '+selectedUsuario+' value="2">Usuario</option><option '+selectedDigitador+' value="3">Digitador</option>');
    if(arregloDataGlobal[7] == '1' || arregloDataGlobal[7] == '2')
        $('#permisosDiv').slideDown();
    if(arregloDataGlobal[7] == '0' || arregloDataGlobal[7] == '3')
        $('#permisosDiv').slideUp();
    if (arregloDataGlobal[8] === '1') {
        $('#nuevoPermRevisar').prop('checked', true);
    } else {
        $('#nuevoPermRevisar').prop('checked', false);
    }
    if (arregloDataGlobal[9] === '1') {
        $('#nuevoPermAprobar').prop('checked', true);
    } else {
        $('#nuevoPermAprobar').prop('checked', false);
    }
    if (arregloDataGlobal[10] === '1') {
        $('#nuevoPermEditar').prop('checked', true);
    } else {
        $('#nuevoPermEditar').prop('checked', false);
    }
});

function N_A(dato) {
    if (dato == 'No indicado')
        return '';
    return dato;
}

$(document).on('click', '#botonesContribuyente button', function () {
    $('#fechaCierreDiv').slideUp();
    $('#notaNumerico').fadeOut();
    $('#annoPeriodo').val('');
    selectedFisico = selectedJuridico = '';
    if(arregloDataGlobal[7] == '1')
        selectedFisico = 'selected="selected"';
    if(arregloDataGlobal[7] == '2')
        selectedJuridico = 'selected="selected"';
    $('#tipoContribuyente').html('<option value="0">Seleccione</option><option '+selectedFisico+' value="1">Físico</option><option '+selectedJuridico+' value="2">Jurídico</option>');
    $('#tipoActualC').val(arregloDataGlobal[7]);
    $('#idContribuyente').val(arregloDataGlobal[1]);
    $('#idContribuyente2').val(arregloDataGlobal[1]);
    $('#idContribuyente3').val(arregloDataGlobal[1]);
    $('#nomContribuyente').text(arregloDataGlobal[2]);
    $('#nomContribuyente2').val(arregloDataGlobal[2]);
    $('#nomContribuyente3').text(arregloDataGlobal[2]);
    $('#nomContribuyente4').text(arregloDataGlobal[2]);
    $('#cedulaDGTContribuyente').val(N_A(arregloDataGlobal[3]));
    $('#telContribuyente2').val(N_A(arregloDataGlobal[4]));
    $('#telContribuyente').text(arregloDataGlobal[4]);
    $('#emailContribuyente2').val(N_A(arregloDataGlobal[5]));
    $('#emailContribuyente').text(arregloDataGlobal[5]);
    $('#direcContribuyente2').val(N_A(arregloDataGlobal[6]));
    $('#direcContribuyente').text(arregloDataGlobal[6]);
});

$(document).on('click', '#botonesActivos button', function () {
    $('.campoFecha').css('border', '1px solid #ccc');
    $('#nuevoTipoActivo > option[value="' + arregloDataGlobal[12] + '"]').attr('selected', 'selected');
    $('#idActivo').val(arregloDataGlobal[0]);
    $('#idActivo2').val(arregloDataGlobal[0]);
    $('#monto2').val(arregloDataGlobal[15]);
    $('#Dmensual2').val(arregloDataGlobal[7]);
    $('#nuevoProveedor').val(N_A(arregloDataGlobal[1]));
    $('#nuevaDescripcion').val(N_A(arregloDataGlobal[2]));
    $('#nuevaFechaActivo').val(desconvertDate(arregloDataGlobal[11]));
    $('#mesesDepreciacion').text(arregloDataGlobal[6]);
    $('#depreciacionMensual').text(arregloDataGlobal[7]);
    $('#mesesDepreciado').text(arregloDataGlobal[8]);
    $('#depreciacionAcumulada').text(arregloDataGlobal[9]);
    $('#depreciacionPeriodo').text(arregloDataGlobal[10]);
    $('#nuevoMonto').val(arregloDataGlobal[15]);
    if (arregloDataGlobal[14] === '1')
    {
        $('#condicionTitulo').text('Deshabilitar');
        $('#condicionPreg').text('deshabilitar');
        $('#formAccionDes-HabA').val('deshabilitarA');
    } else
    {
        $('#condicionTitulo').text('Habilitar');
        $('#condicionPreg').text('habilitar');
        $('#formAccionDes-HabA').val('habilitarA');
    }
});
$(document).on('click', '#botonesAnticipos button', function () {
    $('.campoFecha').css('border', '1px solid #ccc');
    $('#nuevoTipoAnticipo > option[value="' + arregloDataGlobal[7] + '"]').attr('selected', 'selected');
    $('#idAnticipo').val(arregloDataGlobal[0]);
    $('#idAnticipo2').val(arregloDataGlobal[0]);
    $('#nuevoFormulario').val(N_A(arregloDataGlobal[1]));
    $('#nuevoTipoPago').val(N_A(arregloDataGlobal[2]));
    $('#nuevaFechaAnticipo').val(desconvertDate(arregloDataGlobal[6]));
    $('#nuevoMonto').val(arregloDataGlobal[8]);
});
$(document).on('click', '#eliminarMovimiento', function () {
    $('#idMovimiento2').val(arregloDataGlobal[0]);
    $('#dolareActual2').val(arregloDataGlobal[11]);
    $('#montoActual2').val(arregloDataGlobal[12]);
    $('#pasivoActual2').val(arregloDataGlobal[13]);
});
$(document).on('click', '#editarMovimiento', function () {
    $('#idMovimiento').val(arregloDataGlobal[0]);
    $('#montoActual').val(arregloDataGlobal[12]);
    $('#pasivoActual').val(arregloDataGlobal[13]);
    
    $('#pasivoMOV option').removeAttr('selected');
    $('#pasivoMOV > option[value="' + arregloDataGlobal[13] + '"]').attr('selected', 'selected');
    $('#grupo').val(N_A(arregloDataGlobal[1]));
    $('#proveedor').val(N_A(arregloDataGlobal[2]));
    $('#proveedor').prop('disabled',false);
    $('#cedula').val(N_A(arregloDataGlobal[3]));
    $('#cedula').prop('disabled',false);
    $('#comprobante').val(N_A(arregloDataGlobal[4]));
    $('#comprobante').prop('disabled',false);
    $('#observacion').val(N_A(arregloDataGlobal[5]));
    $('#observacion').prop('disabled',false);
    $('#fecha').val(desconvertDate(arregloDataGlobal[10]));
    $('#fecha').prop('disabled',false);
    $('#cuenta').val(arregloDataGlobal[7]);
    if(arregloDataGlobal[7] === '7-01-01')
        $('#pasivoMOV').slideDown();
    else
        $('#pasivoMOV').slideUp();
    $('#cuenta').prop('disabled',false);
    $('#mont').val(arregloDataGlobal[12]);
    $('#mont').prop('disabled',false);
    $('#dolareActual').val(arregloDataGlobal[11]);
    if(arregloDataGlobal[11] === '1')
        $('#dolare').prop('checked',true);
    else
        $('#dolare').prop('checked',false);
    $('#dolare').prop('disabled',false);
    $('#cambiosMOV').fadeIn();
    $('#celdasMOV').fadeIn();
    $('#agregarMOV').fadeOut();
});

$(document).on('click', '#botonesPasivos button', function () {
    $('.campoFecha').css('border', '1px solid #ccc');
    $('#bancoActual').val(arregloDataGlobal[0]);
    $('#bancoActual2').val(arregloDataGlobal[0]);
    $('#bancoActual3').text(arregloDataGlobal[0]);
    //$('#nuevoBanco').val(N_A(arregloDataGlobal[0]));
    $('#nuevaFechaApertura').val(desconvertDate(arregloDataGlobal[10]));
    $('#nuevaFechaVencimiento').val(desconvertDate(arregloDataGlobal[11]));
    $('#nuevoInteres').val(N_A(arregloDataGlobal[3]));
    $('#nuevoPrincipal').val(N_A(arregloDataGlobal[12]));
    $('#principal3').val(N_A(arregloDataGlobal[12]));
    $('#saldo3').val(N_A(arregloDataGlobal[13]));
    $('#nuevasObservaciones').val(N_A(arregloDataGlobal[6]));
    $('#nuevoDocumento').val(N_A(arregloDataGlobal[7]));
    if (arregloDataGlobal[9] === '1')
    {
        $('#condicionTitulo').text('Deshabilitar');
        $('#condicionPreg').text('deshabilitar');
        $('#formAccionDes-HabPas').val('deshabilitarPas');
    } else
    {
        $('#condicionTitulo').text('Habilitar');
        $('#condicionPreg').text('habilitar');
        $('#formAccionDes-HabPas').val('habilitarPas');
    }
});

$(document).on('click', '#botonesPatrimonios button', function () {
    $('.campoFecha').css('border', '1px solid #ccc');
    $('#idPatrimonio').val(arregloDataGlobal[0]);
    $('#idPatrimonio2').val(arregloDataGlobal[0]);
    $('#nuevaFecha').val(desconvertDate(arregloDataGlobal[8]));
    $('#nuevoAccionista').val(N_A(arregloDataGlobal[2]));
    $('#nuevaActa').val(N_A(arregloDataGlobal[3]));
    $('#nuevoMonto').val(N_A(arregloDataGlobal[10]));
    $('#monto7').val(N_A(arregloDataGlobal[10]));
    $('#nuevaFechaDevolucion').val(desconvertDate(arregloDataGlobal[9]));
    if (arregloDataGlobal[7] === '1')
    {
        $('#condicionTitulo').text('Deshabilitar');
        $('#condicionPreg').text('deshabilitar');
        $('#formAccionDes-HabPat').val('deshabilitarPat');
    } else
    {
        $('#condicionTitulo').text('Habilitar');
        $('#condicionPreg').text('habilitar');
        $('#formAccionDes-HabPat').val('habilitarPat');
    }
});

$(document).on('click', '#botonesInversiones button', function () {
    $('.campoFecha').css('border', '1px solid #ccc');
    $('#idInversion').val(arregloDataGlobal[0]);
    $('#idInversion2').val(arregloDataGlobal[0]);
    $('#nuevaFecha').val(desconvertDate(arregloDataGlobal[8]));
    $('#nuevaSociedad').val(N_A(arregloDataGlobal[1]));
    $('#nuevaCedJuridica').val(N_A(arregloDataGlobal[2]));
    $('#nuevaObservacion').val(N_A(arregloDataGlobal[5]));
    $('#nuevoMonto').val(N_A(arregloDataGlobal[9]));
    $('#monto7').val(N_A(arregloDataGlobal[9]));
    if (arregloDataGlobal[7] === '1')
    {
        $('#condicionTitulo').text('Deshabilitar');
        $('#condicionPreg').text('deshabilitar');
        $('#formAccionDes-HabInv').val('deshabilitarInv');
    } else
    {
        $('#condicionTitulo').text('Habilitar');
        $('#condicionPreg').text('habilitar');
        $('#formAccionDes-HabInv').val('habilitarInv');
    }
});

$(document).on('click', '#botonesCuentas button', function () {
    $('#codigoNuevo').val(arregloDataGlobal[0]);
    $('#nombreNuevo').val(arregloDataGlobal[1]);
    $('#codCuenta2').val(arregloDataGlobal[0]);
    $('#codCuenta').text(arregloDataGlobal[0]);
    $('#codCuenta3').val(arregloDataGlobal[0]);
    $('#nomCuenta').text(arregloDataGlobal[1]);
    if (arregloDataGlobal[3] === '1')
    {
        $('#condicionTitulo').text('Deshabilitar');
        $('#condicionPreg').text('deshabilitar');
        $('#formAccionDes-HabC').val('deshabilitarC');
    } else
    {
        $('#condicionTitulo').text('Habilitar');
        $('#condicionPreg').text('habilitar');
        $('#formAccionDes-HabC').val('habilitarC');
    }
});
function obtenerDatosActualesUsuario() {
    return arregloDataGlobal;
}
//-----------------------------------VALIDACION
function validateDate(fecha) {
    if ((formatDate(fecha) && existDate(fecha)) || fecha == '')
        return true;
    return false;
}

function formatDate(fecha) {
    var expRegular = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
    if (fecha.match(expRegular)) {
        return true;
    } else {
        return false;
    }
}
function existDate(fecha) {
    var fechaf = fecha.split("/");
    var day = fechaf[0];
    var month = fechaf[1];
    var year = fechaf[2];
    var plantilla = new Date(year, month - 1, day);//mes empieza de cero Enero = 0
    if (!plantilla || plantilla.getFullYear() == year && plantilla.getMonth() == month - 1 && plantilla.getDate() == day) {
        return true;
    } else {
        return false;
    }
}
function convertDate(fecha) {
    if (fecha == '')
        return fecha;
    var fechaf = fecha.split("/");
    return fechaf[2] + '/' + fechaf[1] + '/' + fechaf[0];
}
function desconvertDate(fecha) {
    if (fecha == '')
        return fecha;
    var fechaf = fecha.split("-");
    return fechaf[2] + '/' + fechaf[1] + '/' + fechaf[0];
}
function compareDates(fechaMenor, fechaMayor) {
    var fMenor = fechaMenor.split("/");
    var fMayor = fechaMayor.split("/");
    if (fMayor[0] > fMenor[0])
        return true;
    else {
        if (fMayor[0] < fMenor[0])
            return false;
        else {
            if (fMayor[1] > fMenor[1])
                return true;
            else {
                if (fMayor[1] < fMenor[1])
                    return false;
                else {
                    if (fMayor[2] > fMenor[2])
                        return true;
                    else {
                        if (fMayor[2] <= fMenor[2])
                            return false;
                    }
                }
            }
        }
    }
}
/*function obtenerDolarPeriodo(){
    $.post('../controlador/administrarPeriodo.php', {accion: 'obtenerDolar'})
            .success(function(resp){
            localStorage.dolar = resp;
            });
}*/

function validarDatosMovimientos(){
        if($('#cuenta').val() === '7-01-01' && $('#pasivoMOV').val() === '0'){
            alertaError('Debe de seleccionar la cuenta de la amotización.');
            cerrarAlertaTiempo();
            return '0';
        }
        /*if($('#dolare').prop('checked')){
            obtenerDolarPeriodo();
            alert(parseInt($.parseJSON(localStorage.dolar)));
            if(((parseInt($.parseJSON(localStorage.dolar)))*(parseInt($('#mont').val()))) > parseInt($('#saldoPasivoMOV').val())){
                alertaError('El monto es mayor al saldo de la cuenta.');
                cerrarAlertaTiempo();
                return '0';
            }
        }
        else{
            if(parseInt($('#mont').val()) > parseInt($('#saldoPasivoMOV').val())){
                alertaError('El monto es mayor al saldo de la cuenta.');
                cerrarAlertaTiempo();
                return '0';
            }
        }*/
        if(!$('#dolare').prop('checked')){
            if(parseInt($('#mont').val()) > parseInt($('#saldoPasivoMOV').val())){
                alertaError('El monto es mayor al saldo de la cuenta.');
                cerrarAlertaTiempo();
                return '0';
            }
        }
        var elemento = '#fecha';
        if($(elemento).val() !== '' && validateDate($(elemento).val()) && compareDates(convertDate($(elemento).val()),$('#annoPeriodoMOV').val()+'/09/30')){
            elemento = '#cuenta';
            if($(elemento).val() !== '' && cuentas.indexOf($(elemento).val()) !== -1){
                elemento = '#mont';
                if($(elemento).val() !== ''){
                    return '1';
                }
                else
                    alertaError('Monto incorrecto.');
            }
            else
                alertaError('Cuenta incorrecta.');
        }
        else
            alertaError('Fecha incorrecta.');
        $(elemento).css('border','1px solid red');
        $(elemento).focus();
        cerrarAlertaTiempo();
        return '0';
    }