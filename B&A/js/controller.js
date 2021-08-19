
//-----------------------------------------SESION
angular.module('moduleSesion')
        .controller('controlSesion', ['$scope', function (s) {
                s.usuario = s.contrasena = '';
                s.acceder = function () {
                    $.post('controlador/acceso.php', {
                        usuario: s.usuario,
                        contrasena: s.contrasena,
                        accion: 'acceso'
                    })
                            .success(function (resp) {
                                resp = resp.substring(resp.length - 1);
                                if (resp === '1') //existe y esta todo bien
                                    window.location = 'vista/inicio.php';
                                else
                                {
                                    if (resp === '0') //usuario deshabilitado
                                        alertaError('Su cuenta esta deshabilitada, contacte un administrador del sistema.');
                                    else
                                    {
                                        if (resp === '2') //no existe
                                            alertaError('Datos incorrectos, por favor verifique.');
                                    }
                                    cerrarAlertaTiempo();
                                }
                            })
                            .error(function () {
                                alertaError('');
                            });
                    s.usuario = s.contrasena = '';
                };
            }]);

//-----------------------------------------CUENTAS
angular.module('moduleCuentas')
        .controller('controlCuentas', ['$scope', function (s) {
                $('#refrescarTablaCuentas').click();
                s.codigo = s.nombre = '';
                s.agregarCuenta = function () {
                    $.post('../controlador/cuentas.php',
                            {
                                codigo: s.codigo,
                                nombre: s.nombre,
                                accion: 'nuevaC'
                            })
                            .success(function (resp) {
                                resp = resp.substring(resp.length - 1);
                                if (resp === '1')
                                {
                                    alertaExito('Cuenta agregada exitosamente.');
                                    $('#refrescarTablaCuentas').click();
                                } else
                                    alertaError('');
                                cerrarAlertaTiempo();
                            });
                    s.codigo = s.nombre = '';
                    $.magnificPopup.close();
                };
                s.editarCuenta = function () {
                    $.post('../controlador/cuentas.php',
                            {
                                codigoActual: $('#codCuenta3').val(),
                                codigo: $('#codigoNuevo').val(),
                                nombre: $('#nombreNuevo').val(),
                                accion: 'editarC'
                            })
                            .success(function (resp) {
                                resp = resp.substring(resp.length - 1);
                                if (resp === '1')
                                {
                                    alertaExito('Cuenta editada exitosamente.');
                                    $('#refrescarTablaCuentas').click();
                                } else
                                    alertaError('');
                                cerrarAlertaTiempo();
                            });
                    $('#codCuenta3').val('');
                    $('#codigoNuevo').val('');
                    $('#nombreNuevo').val('');
                    $.magnificPopup.close();
                    $('.menuCUExistente').css('visibility', 'hidden');
                };
                s.hab_deshabCuenta = function () {
                    $.post('../controlador/cuentas.php',
                            {
                                codigo: $('#codCuenta2').val(),
                                accion: $('#formAccionDes-HabC').val()
                            })
                            .success(function (resp) {
                                resp = resp.substring(resp.length - 1);
                                if (resp === '1') {
                                    alertaExito('Cuenta habilitada exitosamente.');
                                    $('#refrescarTablaCuentas').click();
                                } else
                                {
                                    if (resp === '2') {
                                        alertaExito('Cuenta deshabilitada exitosamente.');
                                        $('#refrescarTablaCuentas').click();
                                    } else
                                        alertaError('');
                                }
                                cerrarAlertaTiempo();
                            });
                    $('#codCuenta2').val('');
                    $('#formAccionDes-HabC').val('');
                    $.magnificPopup.close();
                    $('.menuCUExistente').css('visibility', 'hidden');
                };
            }]);

//-----------------------------------------USUARIOS
angular.module('moduleUsuarios')
        .controller('controlNuevoUsuario', ['$scope', function (s) {
                $('.tabUno').addClass('active');
                $('.tabDos').removeClass('active');
                s.admin = '0';
                s.nomCompleto = s.nomUsuario = s.email = '';
                s.revisar = s.aprobar = s.editar = false;
                s.cambioTipoUsuario = function () {
                    if (s.admin == '1' || s.admin == '2' || $('#nuevoTipoUsuario').val() == '1' || $('#nuevoTipoUsuario').val() == '2')
                        $('#permisosDiv').slideDown();
                    else
                        $('#permisosDiv').slideUp();
                };
                s.agregarUsuario = function () {
                    if (s.admin !== '0') {
                        if (s.admin == '3') {
                            s.revisar = s.aprobar = s.editar = false;
                        }
                        $.post('../controlador/usuarios.php',
                                {
                                    nombreCompleto: s.nomCompleto,
                                    nombreUsuario: s.nomUsuario,
                                    emailUsuario: s.email,
                                    tipoUsuario: Number(s.admin),
                                    permRevisar: Number(s.revisar),
                                    permAprobar: Number(s.aprobar),
                                    permEditar: Number(s.editar),
                                    accion: 'nuevoU'
                                })
                                .success(function (resp) {
                                    resp = resp.substring(resp.length - 1);
                                    if (resp === '1')
                                        alertaExito('Usuario agregado exitosamente.');
                                    else
                                        alertaError('');
                                    cerrarAlertaTiempo();
                                });
                        s.nomCompleto = s.nomUsuario = s.email = '';
                        s.admin = '0';
                        s.revisar = s.aprobar = s.editar = false;
                    } else {
                        $('#avisoRequired').show();
                        $('.tipoSelect').css('border', '2px solid red');
                    }
                };
            }])
        .controller('controlUsuarioExistente', ['$scope', function (s) {
                $('.tabUno').removeClass('active');
                $('.tabDos').addClass('active');
                $('#refrescarTablaUsuarios').click();
                s.cambioTUsuario = function () {
                    if ($('#nuevoTipoUsuario').val() == '1' || $('#nuevoTipoUsuario').val() == '2')
                        $('#permisosDiv').slideDown();
                    else
                        $('#permisosDiv').slideUp();
                };
                s.editarUsuario = function () {
                    if ($('#nuevoTipoUsuario').val() !== '0') {
                        if ($('#nuevoTipoUsuario').val() == '3')
                        {
                            $('#nuevoPermRevisar').prop('checked', false);
                            $('#nuevoPermAprobar').prop('checked', false);
                            $('#nuevoPermEditar').prop('checked', false);
                        }
                        $.post('../controlador/usuarios.php',
                                {
                                    idUsuario: $('#idUsuario').val(),
                                    nombreCompleto: $('#nuevoNombreCompleto').val(),
                                    nombreUsuario: $('#nuevoNombreUsuario').val(),
                                    nombreUsuarioActual: $('#nombreUsuarioActual').val(),
                                    emailUsuario: $('#nuevoEmailUsuario').val(),
                                    tipoUsuario: $('#nuevoTipoUsuario').val(),
                                    permRevisar: Number($('#nuevoPermRevisar').prop('checked')),
                                    permAprobar: Number($('#nuevoPermAprobar').prop('checked')),
                                    permEditar: Number($('#nuevoPermEditar').prop('checked')),
                                    accion: 'editarU'
                                })
                                .success(function (resp) {
                                    resp = resp.substring(resp.length - 1);
                                    if (resp === '1') {
                                        alertaExito('Usuario editado exitosamente.');
                                        $('#refrescarTablaUsuarios').click();
                                    } else
                                        alertaError('');
                                    cerrarAlertaTiempo();
                                });
                        $('#nuevoNombreCompleto').val('');
                        $('#nuevoNombreUsuario').val('');
                        $('#nuevoEmailUsuario').val('');
                        $('#nuevoTipoUsuario > option[value="0"]').attr('selected', 'selected');
                        $('#nuevoPermRevisar').prop('checked', false);
                        $('#nuevoPermAprobar').prop('checked', false);
                        $('#nuevoPermEditar').prop('checked', false);
                        $.magnificPopup.close();
                        $('.menuCUExistente').css('visibility', 'hidden');
                    } else {
                        $('.tipoSelect').css('border', '2px solid red');
                    }
                };
                s.hab_deshabUsuario = function () {
                    $.post('../controlador/usuarios.php',
                            {
                                idUsuario: $('#idUsuario2').val(),
                                nombreCompleto: $('#nomCompletoHD').val(),
                                accion: $('#formAccionDes-HabU').val()
                            })
                            .success(function (resp) {
                                resp = resp.substring(resp.length - 1);
                                if (resp === '1') {
                                    alertaExito('Usuario habilitado exitosamente.');
                                    $('#refrescarTablaUsuarios').click();
                                } else
                                {
                                    if (resp === '2') {
                                        alertaExito('Usuario deshabilitado exitosamente.');
                                        $('#refrescarTablaUsuarios').click();
                                    } else
                                        alertaError('');
                                }
                                cerrarAlertaTiempo();
                            });
                    $('#idUsuario2').val('');
                    $('#formAccionDes-HabU').val('');
                    $.magnificPopup.close();
                    $('.menuCUExistente').css('visibility', 'hidden');
                };
            }])
        .controller('cambioContrasena', ['$scope', function (s) {
                s.cActual = s.cNueva = s.cNueva2 = '';
                s.cambiarContrasena = function () {
                    if (s.cNueva === s.cNueva2) {
                        if (s.cNueva.length > 4) {
                            $.post('../controlador/usuarios.php', {accion: 'cambioContraseña', contActual: s.cActual, contNueva: s.cNueva})
                                    .success(function (resp) {
                                        resp = resp.substring(resp.length - 1);
                                        if (resp === '1')
                                            alertaExito('Contraseña modificada exitosamente.');
                                        else {
                                            if (resp === '2')
                                                alertaError('Contraseña actual incorrecta.');
                                            else
                                                alertaError('');
                                        }
                                    });
                        } else
                            alertaError('La contraseña debe ser de longitud mayor a 4.');
                    } else
                        alertaError('Las contraseñas nuevas son diferentes.');
                    s.cActual = s.cNueva = s.cNueva2 = '';
                    cerrarAlertaTiempo();
                };
            }])
        .controller('controlRecuperarClave', ['$scope', function (s) {
                s.usuario = s.email = '';
                s.recuperarClave = function () {
                    $.post('../controlador/usuarios.php', {
                        usuario: s.usuario,
                        email: s.email,
                        accion: 'recuperar'
                    })
                            .success(function (resp) {
                                resp = resp.substring(resp.length - 1);
                                if (resp === '1')
                                    alertaExito('Revise su correo electrónico.');
                                else
                                {
                                    if (resp === '2')
                                        alertaError('Datos incorrectos, por favor verifique.');
                                    else
                                        alertaError('');
                                }
                                cerrarAlertaTiempo();
                            })
                            .error(function () {
                                alertaError('');
                            });
                    s.usuario = s.email = '';
                };
            }]);
//-----------------------------------------CONTRIBUYENTES
angular.module('RouteContribuyente')
        .controller('controlNuevoContribuyente', ['$scope', function (s) {
                $('.tabUno').addClass('active');
                $('.tabDos').removeClass('active');
                $('.tabTres').removeClass('active');
                s.tipoC = '0';
                s.identificacion = s.nombre = s.cedulaDGT = s.telefono = s.email = s.direccion = '';
                s.agregarContribuyente = function () {
                    if (s.tipoC !== '0') {
                        $.post('../controlador/contribuyentes.php',
                                {
                                    tipo: s.tipoC,
                                    identificacion: s.identificacion,
                                    nombre: s.nombre,
                                    cedulaDGT: s.cedulaDGT,
                                    telefono: s.telefono,
                                    email: s.email,
                                    direccion: s.direccion,
                                    accion: 'nuevoC'
                                })
                                .success(function (resp) {
                                    resp = resp.substring(resp.length - 1);
                                    if (resp === '1') {
                                        alertaExito('Contribuyente agregado exitosamente.');
                                    } else
                                        alertaError('');
                                    cerrarAlertaTiempo();
                                });
                        s.tipoC = '0';
                        s.identificacion = s.nombre = s.cedulaDGT = s.telefono = s.email = s.direccion = '';
                    } else {
                        $('#avisoRequired').show();
                        $('#tipoContribuyente').css('border', '2px solid red');
                    }
                };
            }])
        .controller('controlContribuyenteExistente', ['$scope', function (s) {
                $('.tabUno').removeClass('active');
                $('.tabDos').addClass('active');
                $('.tabTres').removeClass('active');
                $('#refrescarTablaContribuyentes').click();
                
                s.anno = '';
                s.fechaCierre = '30 de setiembre del';
                var fecha = new Date();
                s.comprobarAnno = function () {
                    $('#fechaCierreDiv').slideUp('slow');
                    if (isNaN(Number(s.anno))) {
                        $('#notaNumerico').fadeIn();
                    } else {
                        $('#notaNumerico').fadeOut();
                        if ((s.anno.length === 4) && (Number(s.anno) < 2101) && (Number(s.anno) > 1999)) {
                            $('#submitCrearPeriodo').prop('disabled', false);
                            if (Number(s.anno) >= fecha.getFullYear())
                                $('#fechaCierreDiv').slideDown('slow');
                        } else
                            $('#submitCrearPeriodo').prop('disabled', true);
                    }
                };
                s.crearPeriodo_Declaracion = function () {
                    if (Number(s.anno) >= fecha.getFullYear()) { //periodo
                        $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
                        $.post('../controlador/contribuyentes.php', {anno: s.anno, cierre: s.fechaCierre, accion: 'crearPeriodo'})
                                .success(function (resp) {
                                    resp = resp.substring(resp.length - 1);
                                    if (resp === '1') {
                                        $.isLoading('hide');
                                        window.location = 'administrar.php';
                                    } else{
                                        if (resp === '7') 
                                            alertaError('No existe rango de impuesto para el período indicado.');
                                        else
                                            alertaError('');
                                    }
                                })
                                .error(function () {
                                    alertaError('');
                                });
                        cerrarAlertaTiempo();
                        $.magnificPopup.close();
                    } else { //declaracionAnterior
                        $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
                        $.post('../controlador/contribuyentes.php', {anno: s.anno, accion: 'crearDeclaracion'})
                                .success(function (resp) {
                                    resp = resp.substring(resp.length - 1);
                                    if (resp === '1') {
                                        $.isLoading('hide');
                                        window.location = 'administrarPA.php';
                                    } else
                                        alertaError('');
                                })
                                .error(function () {
                                    alertaError('');
                                });
                        cerrarAlertaTiempo();
                        $.magnificPopup.close();
                    }
                };
                s.editarContribuyente = function () {
                    if ($('#tipoContribuyente').val() !== '0')
                    {
                        $.post('../controlador/contribuyentes.php',
                                {
                                    idActual: $('#idContribuyente').val(),
                                    tipoActual: $('#tipoActualC').val(),
                                    tipo: $('#tipoContribuyente').val(),
                                    identificacion: $('#idContribuyente2').val(),
                                    nombre: $('#nomContribuyente2').val(),
                                    cedulaDGT: $('#cedulaDGTContribuyente').val(),
                                    telefono: $('#telContribuyente2').val(),
                                    email: $('#emailContribuyente2').val(),
                                    direccion: $('#direcContribuyente2').val(),
                                    accion: 'editarC'
                                })
                                .success(function (resp) {
                                    resp = resp.substring(resp.length - 1);
                                    if (resp === '1') {
                                        alertaExito('Contribuyente editado exitosamente.');
                                        $('#refrescarTablaContribuyentes').click();
                                    } else
                                        alertaError('');
                                    cerrarAlertaTiempo();
                                });
                        $('#tipoContribuyente > option[value="0"]').attr('selected', 'selected');
                        $('#idContribuyente2').val('');
                        $('#nomContribuyente2').val('');
                        $('#cedulaDGTContribuyente').val('');
                        $('#telContribuyente2').val('');
                        $('#emailContribuyente2').val('');
                        $('#direcContribuyente2').val('');
                        $.magnificPopup.close();
                        $('.menuCUExistente').css('visibility', 'hidden');
                    } else {
                        $('#avisoRequired').show();
                        $('#tipoContribuyente').css('border', '2px solid red');
                    }
                };
                s.cargarInfoC_DatosPermanentes = function () {
                    $.post('../controlador/contribuyentes.php',
                            {
                                idActual: arregloDataGlobal[1],
                                nomActual: arregloDataGlobal[2],
                                tipoActual: arregloDataGlobal[7],
                                accion: 'cargarInfoDP'
                            })
                            .success(function (resp) {
                                resp = resp.substring(resp.length - 1);
                                if (resp === '1')
                                    window.location = 'datosPermanentes.php';
                            });
                };
                s.cargarInfoC_Periodos = function () {
                    $.post('../controlador/listarPeriodos.php',
                            {
                                idActual: arregloDataGlobal[1],
                                nomActual: arregloDataGlobal[2],
                                tipoActual: arregloDataGlobal[7],
                            })
                            .success(function (data) {
                                $('.listaPeriodos2').html(data);
                            });
                };
            }])
        .controller('controlContribuyenteRango', ['$scope', function (s) {
                $('.tabUno').removeClass('active');$('.tabDos').removeClass('active');$('.tabTres').addClass('active');
                s.tipoRango = s.tipoRangoNuevo = s.periodoRango = s.tarifaFisico1 = '0';
                s.rangoFisico1 = s.rangoFisico2 = s.rangoFisico3 = s.rangoFisico4 = s.rangoFisico5 = s.annoRangoNuevo = '';
                s.rangoJuridico1 = s.rangoJuridico2 = s.rangoJuridico3  = '';s.tarifaFisico2 = s.tarifaJuridico1 = '10';
                s.tarifaFisico3 = '15';s.tarifaFisico4 = s.tarifaJuridico2 = '20';s.tarifaFisico5 = '25';s.tarifaJuridico3 = '30';
                s.cargarPeriodosRangos = function(){
                    if(s.tipoRango != '0'){
                        $.post('../controlador/listarPeriodosRangos.php',{accion:'listarPeriodoRangos',tipo: s.tipoRango})
                                .success(function(resp){
                                    $('#periodoRango').html(resp);
                                });
                    }
                    else
                        $('#periodoRango').html('<option value="0">Ninguno</option>');
                    $('#rangoDiv').html('');
                };8
                s.mostrarRangos = function(){
                    if(s.periodoRango != '0'){
                        $.post('../controlador/conectorCM/mostrarElementos.php',{elemento: 'rangoImpuesto',tipo: s.tipoRango,anno: s.periodoRango})
                                .success(function(resp){
                                    $('#rangoDiv').html(resp);
                                });
                    }
                    else
                        $('#rangoDiv').html('');
                };
                arregloAnnosRangos = [];
                s.tipoRangoCrear = function(){
                    $('#submitCrearRango').prop('disabled',true);
                    $('.reqFisico').prop('required',false);
                    $('.reqJuridico').prop('required',false);
                    $('#añoRango').prop('disabled',true);
                    $('#rangoFisico').slideUp();
                    $('#rangoJuridico').slideUp();
                    $('#notaExistente').fadeOut();
                    s.annoRangoNuevo = '';
                    arregloAnnosRangos = [];
                    if(s.tipoRangoNuevo != '0'){
                        $('#añoRango').prop('disabled',false);
                        $.post('../controlador/listarPeriodosRangos.php',{accion:'consultarRangosPeriodos',tipo:s.tipoRangoNuevo})
                                .success(function(data){
                                   arregloAnnosRangos = $.parseJSON(data); 
                                });
                    }
                };
                s.annoRangoCrear = function(){
                    $('#submitCrearRango').prop('disabled',true);
                    $('#notaExistente').fadeOut();
                    $('#rangoFisico').slideUp();
                    $('#rangoJuridico').slideUp();
                    $('#notaNumerico').fadeOut();
                    if (isNaN(Number(s.annoRangoNuevo)))
                        $('#notaNumerico').fadeIn();
                    else{
                        if(s.annoRangoNuevo.length == 4){
                            if(arregloAnnosRangos.indexOf(s.annoRangoNuevo) == -1){
                                if(s.tipoRangoNuevo == '1'){
                                    $('#rangoFisico').slideDown('slow');
                                    $('.reqFisico').prop('required',true);
                                }
                                if(s.tipoRangoNuevo == '2'){
                                    $('#rangoJuridico').slideDown('slow');    
                                    $('.reqJuridico').prop('required',true);
                                }
                                $('#submitCrearRango').prop('disabled',false);
                            }
                            else
                                $('#notaExistente').fadeIn();
                        }
                    }
                };
                s.crearRango = function(){
                    if(s.tipoRangoNuevo == '1'){//fisico
                        $.post('../controlador/contribuyentes.php',{
                            accion: 'agregarRangoImpuesto',
                            tipo: s.tipoRangoNuevo,
                            anno: s.annoRangoNuevo,
                            tarifa1: s.tarifaFisico1,
                            tarifa2: s.tarifaFisico2,
                            tarifa3: s.tarifaFisico3,
                            tarifa4: s.tarifaFisico4,
                            tarifa5: s.tarifaFisico5,
                            rango1: s.rangoFisico1,
                            rango2: s.rangoFisico2,
                            rango3: s.rangoFisico3,
                            rango4: s.rangoFisico4,
                            rango5: s.rangoFisico5
                        })
                        .success(function (resp) {
                            resp = resp.substring(resp.length - 1);
                            if (resp === '1')
                                alertaExito('Rango de Impuesto agregado exitosamente.');
                            else
                                alertaError('');
                            cerrarAlertaTiempo();
                        });
                    }
                    else{ //juridico
                        $.post('../controlador/contribuyentes.php',{
                            accion: 'agregarRangoImpuesto',
                            tipo: s.tipoRangoNuevo,
                            anno: s.annoRangoNuevo,
                            tarifa1: s.tarifaJuridico1,
                            tarifa2: s.tarifaJuridico2,
                            tarifa3: s.tarifaJuridico3,
                            rango1: s.rangoJuridico1,
                            rango2: s.rangoJuridico2,
                            rango3: s.rangoJuridico3
                        })
                        .success(function (resp) {
                            resp = resp.substring(resp.length - 1);
                            if (resp === '1')
                                alertaExito('Rango de Impuesto agregado exitosamente.');
                            else
                                alertaError('');
                            cerrarAlertaTiempo();
                        });
                    }
                    s.tipoRango = s.tipoRangoNuevo = s.periodoRango = s.tarifaFisico1 = '0';
                    s.rangoFisico1 = s.rangoFisico2 = s.rangoFisico3 = s.rangoFisico4 = s.rangoFisico5 = s.annoRangoNuevo = '';
                    s.rangoJuridico1 = s.rangoJuridico2 = s.rangoJuridico3  = '';s.tarifaFisico2 = s.tarifaJuridico1 = '10';
                    s.tarifaFisico3 = '15';s.tarifaFisico4 = s.tarifaJuridico2 = '20';s.tarifaFisico5 = '25';s.tarifaJuridico3 = '30';
                    $('#rangoFisico').slideUp();
                    $('#rangoJuridico').slideUp();
                    $.magnificPopup.close();
                };
            }]);
//-----------------------------------------DATOS PERMANENTES
angular.module('RoutePermanentes')
        .controller('controlActivoFijo', ['$scope', function (s) {
                $('.tabUno').addClass('active');
                $('.tabDos').removeClass('active');
                $('.tabTres').removeClass('active');
                $('.tabCuatro').removeClass('active');
                $('#actualizarActivos').click();
//                $('#refrescarTablaActivos').click();
                s.activos = '';
                $.get('../controlador/listarElementos.php')
                        .success(function (data) {
                            $('.tipoActivo').html(data);
                        });
                s.tipoA = '0';
                s.proveedor = s.descripcion = s.fecha = s.monto = '';
                s.agregarActivo = function () {
                    if (s.tipoA !== '0') {
                        if (s.fecha != '') {
                            if (validateDate(s.fecha)) {
                                $.post('../controlador/permanentes.php',
                                        {
                                            tipo: s.tipoA,
                                            proveedor: s.proveedor,
                                            descripcion: s.descripcion,
                                            fecha: convertDate(s.fecha),
                                            monto: s.monto,
                                            accion: 'nuevoActivo'
                                        })
                                        .success(function (resp) {
                                            resp = resp.substring(resp.length - 1);
                                            if (resp === '1') {
                                                alertaExito('Activo agregado exitosamente.');
                                                $('#refrescarTablaActivos').click();
                                            } else
                                                alertaError('');
                                            cerrarAlertaTiempo();
                                        });
                                s.tipoA = '0';
                                s.proveedor = s.descripcion = s.fecha = s.monto = '';
                                $.magnificPopup.close();
                                $('.menuCUExistente').css('visibility', 'hidden');
                            } else {
                                $('#fechaActivo').css('border', '2px solid red');
                                $('#notaFechaMala').fadeIn();
                            }
                        } else
                            $('#fechaActivo').css('border', '2px solid red');
                    } else
                        $('.tipoActivo').css('border', '2px solid red');
                };
                s.editarActivo = function () {
                    if ($('#nuevoTipoActivo').val() !== '0') {
                        if ($('#nuevaFechaActivo').val() != '') {
                            if (validateDate($('#nuevaFechaActivo').val())) {
                                $.post('../controlador/permanentes.php',
                                        {
                                            idActivo: $('#idActivo').val(),
                                            tipo: $('#nuevoTipoActivo').val(),
                                            proveedor: $('#nuevoProveedor').val(),
                                            descripcion: $('#nuevaDescripcion').val(),
                                            fecha: convertDate($('#nuevaFechaActivo').val()),
                                            monto: $('#nuevoMonto').val(),
                                            accion: 'editarActivo'
                                        })
                                        .success(function (resp) {
                                            resp = resp.substring(resp.length - 1);
                                            if (resp === '1') {
                                                alertaExito('Activo editado exitosamente.');
                                                $('#refrescarTablaActivos').click();
                                            } else
                                                alertaError('');
                                            cerrarAlertaTiempo();
                                        });
                                $('#nuevoTipoActivo > option[value="0"]').attr('selected', 'selected');
                                $('#idActivo').val('');
                                $('#nuevoProveedor').val('');
                                $('#nuevaDescripcion').val('');
                                $('#nuevaFechaActivo').val('');
                                $('#nuevoMonto').val('');
                                $.magnificPopup.close();
                                $('.menuCUExistente').css('visibility', 'hidden');
                            } else {
                                $('#nuevaFechaActivo').css('border', '2px solid red');
                                $('#notaFechaMala').fadeIn();
                            }
                        } else
                            $('#nuevaFechaActivo').css('border', '2px solid red');
                    } else
                        $('.tipoActivo').css('border', '2px solid red');
                };
                s.hab_deshabActivo = function () {
                    $.post('../controlador/permanentes.php',
                            {
                                idActivo: $('#idActivo2').val(),
                                monto: $('#monto2').val(),
                                Dmensual: $('#Dmensual2').val(),
                                accion: $('#formAccionDes-HabA').val()
                            })
                            .success(function (resp) {
                                resp = resp.substring(resp.length - 1);
                                if (resp === '1') {
                                    alertaExito('Activo habilitado exitosamente.');
                                    $('#refrescarTablaActivos').click();
                                } else
                                {
                                    if (resp === '2') {
                                        alertaExito('Activo deshabilitado exitosamente.');
                                        $('#refrescarTablaActivos').click();
                                    } else
                                        alertaError('');
                                }
                                cerrarAlertaTiempo();
                            });
                    $('#idActivo2').val('');
                    $('#monto2').val('');
                    $('#Dmensual2').val('');
                    $('#formAccionDes-HabA').val('');
                    $.magnificPopup.close();
                    $('.menuCUExistente').css('visibility', 'hidden');
                };
            }])
        .controller('controlPasivo', ['$scope', function (s) {
                $('.tabUno').removeClass('active');
                $('.tabDos').addClass('active');
                $('.tabTres').removeClass('active');
                $('.tabCuatro').removeClass('active');
                $('#refrescarTablaPasivos').click();
                s.banco = s.fechaApertura = s.fechaVencimiento = s.interes = s.principal = s.observaciones = s.documento = '';
                s.agregarPasivo = function () {
                    if (s.fechaApertura != '') {
                        if (s.fechaVencimiento != '') {
                            if (validateDate(s.fechaApertura)) {
                                if (validateDate(s.fechaVencimiento)) {
                                    if (compareDates(convertDate(s.fechaApertura), convertDate(s.fechaVencimiento))) {
                                        $.post('../controlador/permanentes.php',
                                                {
                                                    banco: s.banco,
                                                    fechaApertura: convertDate(s.fechaApertura),
                                                    fechaVencimiento: convertDate(s.fechaVencimiento),
                                                    interes: s.interes,
                                                    principal: s.principal,
                                                    observaciones: s.observaciones,
                                                    documento: s.documento,
                                                    accion: 'nuevoPasivo'
                                                })
                                                .success(function (resp) {
                                                    resp = resp.substring(resp.length - 1);
                                                    if (resp === '1') {
                                                        alertaExito('Pasivo agregado exitosamente.');
                                                        $('#refrescarTablaPasivos').click();
                                                    } else
                                                        alertaError('');
                                                    cerrarAlertaTiempo();
                                                });
                                        s.banco = s.fechaApertura = s.fechaVencimiento = s.interes = s.principal = s.observaciones = s.documento = '';
                                        $.magnificPopup.close();
                                        $('.menuCUExistente').css('visibility', 'hidden');
                                    } else {
                                        $('#fechaVencimiento').css('border', '2px solid red');
                                        $('#notaFechaMala3').fadeIn();
                                    }
                                } else {
                                    $('#fechaVencimiento').css('border', '2px solid red');
                                    $('#notaFechaMala2').fadeIn();
                                }
                            } else {
                                $('#fechaApertura').css('border', '2px solid red');
                                $('#notaFechaMala1').fadeIn();
                            }
                        } else
                            $('#fechaVencimiento').css('border', '2px solid red');
                    } else
                        $('#fechaApertura').css('border', '2px solid red');
                };
                s.editarPasivo = function () {
                    if ($('#nuevaFechaApertura').val() != '') {
                        if ($('#nuevaFechaVencimiento').val() != '') {
                            if (validateDate($('#nuevaFechaApertura').val())) {
                                if (validateDate($('#nuevaFechaVencimiento').val())) {
                                    if (compareDates(convertDate($('#nuevaFechaApertura').val()), convertDate($('#nuevaFechaVencimiento').val()))) {
                                        $.post('../controlador/permanentes.php',
                                                {
                                                    bancoActual: $('#bancoActual').val(),
                                                    fechaApertura: convertDate($('#nuevaFechaApertura').val()),
                                                    fechaVencimiento: convertDate($('#nuevaFechaVencimiento').val()),
                                                    interes: $('#nuevoInteres').val(),
                                                    principal: $('#nuevoPrincipal').val(),
                                                    observaciones: $('#nuevasObservaciones').val(),
                                                    documento: $('#nuevoDocumento').val(),
                                                    accion: 'editarPasivo'
                                                })
                                                .success(function (resp) {
                                                    resp = resp.substring(resp.length - 1);
                                                    if (resp === '1') {
                                                        alertaExito('Pasivo editado exitosamente.');
                                                        $('#refrescarTablaPasivos').click();
                                                    } else
                                                        alertaError('');
                                                    cerrarAlertaTiempo();
                                                });
                                        $('#bancoActual').val('');
                                                $('#nuevaFechaApertura').val('');
                                                $('#nuevaFechaVencimiento').val('');
                                        $('#nuevoInteres').val('');
                                        $('#nuevoPrincipal').val('');
                                        $('#nuevasObservaciones').val('');
                                        $('#nuevoDocumento').val('');
                                        $.magnificPopup.close();
                                        $('.menuCUExistente').css('visibility', 'hidden');
                                    } else {
                                        $('#nuevaFechaVencimiento').css('border', '2px solid red');
                                        $('#notaFechaMala3').fadeIn();
                                    }
                                } else {
                                    $('#nuevaFechaVencimiento').css('border', '2px solid red');
                                    $('#notaFechaMala2').fadeIn();
                                }
                            } else {
                                $('#nuevaFechaApertura').css('border', '2px solid red');
                                $('#notaFechaMala1').fadeIn();
                            }
                        } else
                            $('#nuevaFechaVencimiento').css('border', '2px solid red');
                    } else
                        $('#nuevaFechaApertura').css('border', '2px solid red');
                };
                s.hab_deshabPasivo = function () {
                    $.post('../controlador/permanentes.php',
                            {
                                bancoActual: $('#bancoActual2').val(),
                                principal: $('#principal3').val(),
                                saldo: $('#saldo3').val(),
                                accion: $('#formAccionDes-HabPas').val()
                            })
                            .success(function (resp) {
                                resp = resp.substring(resp.length - 1);
                                if (resp === '1') {
                                    alertaExito('Pasivo habilitado exitosamente.');
                                    $('#refrescarTablaPasivos').click();
                                } else
                                {
                                    if (resp === '2') {
                                        alertaExito('Pasivo deshabilitado exitosamente.');
                                        $('#refrescarTablaPasivos').click();
                                    } else
                                        alertaError('');
                                }
                                cerrarAlertaTiempo();
                            });
                    $('#bancoActual2').val('');
                    $('#formAccionDes-HabPas').val('');
                    $.magnificPopup.close();
                    $('.menuCUExistente').css('visibility', 'hidden');
                };
            }])
        .controller('controlPatrimonio', ['$scope', function (s) {
                $('.tabUno').removeClass('active');
                $('.tabDos').removeClass('active');
                $('.tabTres').addClass('active');
                $('.tabCuatro').removeClass('active');
                $('#refrescarTablaPatrimonios').click();
                s.fecha = s.accionista = s.acta = s.monto = s.fechaDevolucion = '';
                s.agregarPatrimonio = function () {
                    if (s.fecha != '') {
                        if (validateDate(s.fecha)) {
                            if (validateDate(s.fechaDevolucion)) {
                                if (compareDates(convertDate(s.fecha), convertDate(s.fechaDevolucion)) || s.fechaDevolucion == '') {
                                    $.post('../controlador/permanentes.php',
                                            {
                                                fecha: convertDate(s.fecha),
                                                accionista: s.accionista,
                                                acta: s.acta,
                                                monto: s.monto,
                                                fechaDevolucion: convertDate(s.fechaDevolucion),
                                                accion: 'nuevoPatrimonio'
                                            })
                                            .success(function (resp) {
                                                resp = resp.substring(resp.length - 1);
                                                if (resp === '1') {
                                                    alertaExito('Patrimonio agregado exitosamente.');
                                                    $('#refrescarTablaPatrimonios').click();
                                                } else
                                                    alertaError('');
                                                cerrarAlertaTiempo();
                                            });
                                    s.fecha = s.accionista = s.acta = s.monto = s.fechaDevolucion = '';
                                    $.magnificPopup.close();
                                    $('.menuCUExistente').css('visibility', 'hidden');
                                } else {
                                    $('#fechaDevolucion').css('border', '2px solid red');
                                    $('#notaFechaMala3').slideDown();
                                }
                            } else {
                                $('#fechaDevolucion').css('border', '2px solid red');
                                $('#notaFechaMala2').fadeIn();
                            }
                        } else {
                            $('#fecha').css('border', '2px solid red');
                            $('#notaFechaMala1').fadeIn();
                        }
                    } else
                        $('#fecha').css('border', '2px solid red');
                };
                s.editarPatrimonio = function () {
                    if ($('#nuevaFecha').val() != '') {
                        if (validateDate($('#nuevaFecha').val())) {
                            if (validateDate($('#nuevaFechaDevolucion').val())) {
                                if (compareDates(convertDate($('#nuevaFecha').val()), convertDate($('#nuevaFechaDevolucion').val())) || $('#nuevaFechaDevolucion').val() == '') {
                                    $.post('../controlador/permanentes.php',
                                            {
                                                idPatrimonio: $('#idPatrimonio').val(),
                                                fecha: convertDate($('#nuevaFecha').val()),
                                                accionista: $('#nuevoAccionista').val(),
                                                acta: $('#nuevaActa').val(),
                                                monto: $('#nuevoMonto').val(),
                                                fechaDevolucion: convertDate($('#nuevaFechaDevolucion').val()),
                                                accion: 'editarPatrimonio'
                                            })
                                            .success(function (resp) {
                                                resp = resp.substring(resp.length - 1);
                                                if (resp === '1') {
                                                    alertaExito('Patrimonio editado exitosamente.');
                                                    $('#refrescarTablaPatrimonios').click();
                                                } else
                                                    alertaError('');
                                                cerrarAlertaTiempo();
                                            });
                                    $('#idPatrimonio').val('');
                                    $('#nuevaFecha').val('');
                                    $('#nuevoAccionista').val('');
                                    $('#nuevaActa').val('');
                                    $('#nuevoMonto').val('');
                                    $('#nuevaFechaDevolucion').val('');
                                    $.magnificPopup.close();
                                    $('.menuCUExistente').css('visibility', 'hidden');
                                } else {
                                    $('#nuevaFechaDevolucion').css('border', '2px solid red');
                                    $('#notaFechaMala3').slideDown();
                                }
                            } else {
                                $('#nuevaFechaDevolucion').css('border', '2px solid red');
                                $('#notaFechaMala2').fadeIn();
                            }
                        } else {
                            $('#nuevaFecha').css('border', '2px solid red');
                            $('#notaFechaMala1').fadeIn();
                        }
                    } else
                        $('#nuevaFecha').css('border', '2px solid red');
                };
                s.hab_deshabPatrimonio = function () {
                    $.post('../controlador/permanentes.php',
                            {
                                idPatrimonio: $('#idPatrimonio2').val(),
                                monto: $('#monto7').val(),
                                accion: $('#formAccionDes-HabPat').val()
                            })
                            .success(function (resp) {
                                resp = resp.substring(resp.length - 1);
                                if (resp === '1') {
                                    alertaExito('Patrimonio habilitado exitosamente.');
                                    $('#refrescarTablaPatrimonios').click();
                                } else
                                {
                                    if (resp === '2') {
                                        alertaExito('Patrimonio deshabilitado exitosamente.');
                                        $('#refrescarTablaPatrimonios').click();
                                    } else
                                        alertaError('');
                                }
                                cerrarAlertaTiempo();
                            });
                    $('#idPatrimonio2').val('');
                    $('#monto7').val('');
                    $('#formAccionDes-HabPat').val('');
                    $.magnificPopup.close();
                    $('.menuCUExistente').css('visibility', 'hidden');
                };
            }])
        .controller('controlInversion', ['$scope', function (s) {
            $('.tabUno').removeClass('active');
            $('.tabDos').removeClass('active');
            $('.tabTres').removeClass('active');
            $('.tabCuatro').addClass('active');
            $('#refrescarTablaInversion').click();
            s.sociedad = s.cedJuridica = s.fecha = s.monto = s.observacion = '';
            s.agregarInversion = function () {
                if (s.fecha != '') {
                    if (validateDate(s.fecha)) {
                        $.post('../controlador/permanentes.php',
                                {
                                    sociedad: s.sociedad,
                                    cedJuridica: s.cedJuridica,
                                    fecha: convertDate(s.fecha),
                                    monto: s.monto,
                                    observacion: s.observacion,
                                    accion: 'nuevaInversion'
                                })
                                .success(function (resp) {
                                    resp = resp.substring(resp.length - 1);
                                    if (resp === '1') {
                                        alertaExito('Inversión agregada exitosamente.');
                                        $('#refrescarTablaInversion').click();
                                    } else
                                        alertaError('');
                                    cerrarAlertaTiempo();
                                });
                        s.sociedad = s.cedJuridica = s.fecha = s.monto = s.observacion = '';
                        $.magnificPopup.close();
                        $('.menuCUExistente').css('visibility', 'hidden');
                    } else {
                        $('#fecha').css('border', '2px solid red');
                        $('#notaFechaMala1').fadeIn();
                    }
                } else
                    $('#fecha').css('border', '2px solid red');
            };
            s.editarInversion = function () {
                if ($('#nuevaFecha').val() != '') {
                    if (validateDate($('#nuevaFecha').val())) {
                        $.post('../controlador/permanentes.php',
                                {
                                    idInversion: $('#idInversion').val(),
                                    sociedad: $('#nuevaSociedad').val(),
                                    cedJuridica: $('#nuevaCedJuridica').val(),
                                    fecha: convertDate($('#nuevaFecha').val()),
                                    monto: $('#nuevoMonto').val(),
                                    observacion: $('#nuevaObservacion').val(),
                                    accion: 'editarInversion'
                                })
                                .success(function (resp) {
                                    resp = resp.substring(resp.length - 1);
                                    if (resp === '1') {
                                        alertaExito('Inversión editada exitosamente.');
                                        $('#refrescarTablaInversion').click();
                                    } else
                                        alertaError('');
                                    cerrarAlertaTiempo();
                                });
                        $('#idInversion').val('');
                        $('#nuevaSociedad').val('');
                        $('#nuevaCedJuridica').val('');
                        $('#nuevaFecha').val('');
                        $('#nuevoMonto').val('');
                        $('#nuevaObservacion').val('');
                        $.magnificPopup.close();
                        $('.menuCUExistente').css('visibility', 'hidden');
                    } else {
                        $('#nuevaFecha').css('border', '2px solid red');
                        $('#notaFechaMala1').fadeIn();
                    }
                } else
                    $('#nuevaFecha').css('border', '2px solid red');
            };
            s.hab_deshabInversion = function () {
                $.post('../controlador/permanentes.php',
                        {
                            idInversion: $('#idInversion2').val(),
                            monto: $('#monto7').val(),
                            accion: $('#formAccionDes-HabInv').val()
                        })
                        .success(function (resp) {
                            resp = resp.substring(resp.length - 1);
                            if (resp === '1') {
                                alertaExito('Inversión habilitada exitosamente.');
                                $('#refrescarTablaInversion').click();
                            } else
                            {
                                if (resp === '2') {
                                    alertaExito('Inversión deshabilitada exitosamente.');
                                    $('#refrescarTablaInversion').click();
                                } else
                                    alertaError('');
                            }
                            cerrarAlertaTiempo();
                        });
                $('#idInversion2').val('');
                $('#monto7').val('');
                $('#formAccionDes-HabInv').val('');
                $.magnificPopup.close();
                $('.menuCUExistente').css('visibility', 'hidden');
            };
        }]);
//----------------------------------------ADMINISTRAR
angular.module('RouteAdministrar')
        .controller('controlPrincipalPeriodo', ['$scope', function () {
            }])

        .controller('controlAnticipos', ['$scope', function (s) {
                $('#refrescarTablaAnticipos').click();
                s.tipoAnt = '0';
                s.formulario = s.tipoPago = s.monto = s.fecha = '';
                s.agregarAnticipo = function () {
                    if (s.tipoAnt !== '0') {
                        if (s.fecha != '') {
                            if (validateDate(s.fecha)) {
                                $.post('../controlador/administrarPeriodo.php',
                                        {
                                            formulario: s.formulario,
                                            tipoPago: s.tipoPago,
                                            tipoAnt: s.tipoAnt,
                                            monto: s.monto,
                                            fecha: convertDate(s.fecha),
                                            accion: 'nuevoAnticipo'
                                        })
                                        .success(function (resp) {
                                            resp = resp.substring(resp.length - 1);
                                            if (resp === '1') {
                                                alertaExito('Anticipo agregado exitosamente.');
                                                $('#refrescarTablaAnticipos').click();
                                            } else
                                                alertaError('');
                                            cerrarAlertaTiempo();
                                        });
                                s.tipoAnt = '0';
                s.formulario = s.tipoPago = s.monto = s.fecha = '';
                                $.magnificPopup.close();
                                $('.menuCUExistente').css('visibility', 'hidden');
                            } else {
                                $('#fechaAnticipo').css('border', '2px solid red');
                                $('#notaFechaMala').fadeIn();
                            }
                        } else
                            $('#fechaAnticipo').css('border', '2px solid red');
                    } else
                        $('.tipoAnticipo').css('border', '2px solid red');
                };
                s.editarAnticipo = function () {
                    if ($('#nuevoTipoAnticipo').val() !== '0') {
                        if ($('#nuevaFechaAnticipo').val() != '') {
                            if (validateDate($('#nuevaFechaAnticipo').val())) {
                                $.post('../controlador/administrarPeriodo.php',
                                        {
                                            idAnticipo: $('#idAnticipo').val(),
                                            formulario: $('#nuevoFormulario').val(),
                                            tipoPago: $('#nuevoTipoPago').val(),
                                            tipoAnt: $('#nuevoTipoAnticipo').val(),
                                            monto: $('#nuevoMonto').val(),
                                            fecha: convertDate($('#nuevaFechaAnticipo').val()),
                                            accion: 'editarAnticipo'
                                        })
                                        .success(function (resp) {
                                            resp = resp.substring(resp.length - 1);
                                            if (resp === '1') {
                                                alertaExito('Anticipo editado exitosamente.');
                                                $('#refrescarTablaAnticipos').click();
                                            } else
                                                alertaError('');
                                            cerrarAlertaTiempo();
                                        });
                                $('#nuevoTipoAnticipo > option[value="0"]').attr('selected', 'selected');
                                $('#idAnticipo').val('');
                                $('#nuevoFormulario').val('');
                                $('#nuevoTipoPago').val('');
                                $('#nuevoMonto').val('');
                                $('#nuevaFechaAnticipo').val('');
                                $.magnificPopup.close();
                                $('.menuCUExistente').css('visibility', 'hidden');
                            } else {
                                $('#nuevaFechaActivo').css('border', '2px solid red');
                                $('#notaFechaMala').fadeIn();
                            }
                        } else
                            $('#nuevaFechaAnticipo').css('border', '2px solid red');
                    } else
                        $('.tipoAnticipo').css('border', '2px solid red');
                };
                s.eliminarAnticipo = function () {
                    $.post('../controlador/administrarPeriodo.php',
                            {
                                idAnticipo: $('#idAnticipo2').val(),
                                accion: 'eliminarAnticipo'
                            })
                            .success(function (resp) {
                                resp = resp.substring(resp.length - 1);
                                if (resp === '1') {
                                    alertaExito('Anticipo eliminado exitosamente.');
                                    $('#refrescarTablaAnticipos').click();
                                } else
                                    alertaError('');
                                cerrarAlertaTiempo();
                            });
                    $('#idAnticipo2').val('');
                    $.magnificPopup.close();
                    $('.menuCUExistente').css('visibility', 'hidden');
                };
            }])

        .controller('controlDeclaracion', ['$scope', function (s) {

                $.post('../controlador/declaraciones.php', {accion: 'consultarPeriodo'})
                        .success(function (resp) {
                            resp = resp.substring(resp.length - 1);
                            if (resp === '0') //si hay periodo
                                $('#mantenimientoDeclaracion').show();
                        });

                s.cargarDeclaracion = function () {
                    $.isLoading({ text: "Cargando ",position:"inside",'class': ""});
                    $.get('../controlador/listarDeclaracion.php')
                            .success(function (data) {
                                $('#mostrarDeclaracion').html(data);
                                $.isLoading('hide');
                            });
                };
                s.cargarDeclaracion();
                s.editarDeclaracion = function () {
                    $('.decAnt input').prop('disabled', false);
                    $('#editarDA').hide();
                    $('#guardarDA').show();
                };
                s.guardarDeclaracion = function () {
                    $('.decAnt input').prop('disabled', true);
                    $('#guardarDA').hide();
                    $('#editarDA').show();
                    if (aspectosModificados.length > 0) {
                        var aspectoValor = [];
                        var long = aspectosModificados.length;
                        for (var i = 0; i < long; i++) {
                            //aspectoValor.push(JSON.stringify({id:aspectosModificados[i],valor:$('#aspectoDJ'+aspectosModificados[i]).val()}));
                            aspectoValor[aspectosModificados[i]] = $('#aspectoDJ' + aspectosModificados[i]).val();
                        }
                        $.post('../controlador/declaraciones.php', {aspectos: aspectoValor, accion: 'guardarAspectos'})
                                .success(function (resp) {
                                    resp = resp.substring(resp.length - 1);
                                    if (resp === '1') {
                                        alertaExito('Cambios guardados exitosamente.');
                                        s.cargarDeclaracion();
                                    } else
                                        alertaError('');
                                    cerrarAlertaTiempo();
                                });
                        aspectosModificados = [];
                    }
                };
            }])
            .controller('controlMovimientos', ['$scope', function (s) {
                $('#refrescarTablaMovimientos').click();
                s.agregarMovimiento = function (){
                    if($('#observacion').val().length < 2)
                        $('#observacion').val($('#observacion').val().replace(/\n/g, ""));
                    if(validarDatosMovimientos() === '1')
                    {
                        dolares = 0;
                        if($('#dolare').prop('checked'))
                            dolares = 1;
                        pasivo = '';
                        if($('#cuenta').val() === '7-01-01')
                            pasivo = $('#pasivoMOV').val();
                        $.post('../controlador/administrarPeriodo.php', 
                        {
                            grupo: $('#grupo').val(),
                            proveedor: $('#proveedor').val(),
                            cedula: $('#cedula').val(),
                            comprobante: $('#comprobante').val(),
                            observacion: $('#observacion').val(),
                            fecha: convertDate($('#fecha').val()),
                            cuenta: $('#cuenta').val(),
                            monto: $('#mont').val(),
                            dolares: dolares,
                            idPasivo: pasivo, 
                            accion: 'nuevoMovimiento'
                        })
                        .success(function (resp) {
                            resp = resp.substring(resp.length - 1);
                            if (resp === '1')//$('#refrescarTablaMovimientos').click();
                                location.reload();
                            else
                                alertaError('');
                            cerrarAlertaTiempo();
                        });
                    }
                };
                s.eliminarMovimiento = function(){
                    $.post('../controlador/administrarPeriodo.php', 
                        {
                            idMovimiento: $('#idMovimiento2').val(),
                            pasivo: $('#pasivoActual2').val(),
                            monto: $('#montoActual2').val(),
                            dolares: $('#dolareActual2').val(),
                            accion: 'eliminarMovimiento'
                        })
                        .success(function (resp) {
                            resp = resp.substring(resp.length - 1);
                                if (resp === '1') {
                                    alertaExito('Movimiento eliminado exitosamente.');
                                    $('#refrescarTablaMovimientos').click();
                                } else
                                    alertaError('');
                                cerrarAlertaTiempo();
                        });
                        $('#idMovimiento2').val('');
                        $('#pasivoActual2').val('');
                        $('#montoActual2').val('');
                        $('#dolareActual2').val('');
                        $.magnificPopup.close();
                        $('.menuCUExistente').css('visibility', 'hidden');
                };
                s.limpiarCeldas = function(){
                    $('#pasivoMOV option').removeAttr('selected');
                    $('#saldoPasivoMOV').val('999999999999999999999999999999999999');
                    $('#idMovimiento').val('');
                    $('#montoActual').val('');
                    $('#pasivoActual').val('');
                    $('#dolareActual').val('');
                    $('#grupo').val('');
                    $('#proveedor').val('');
                    $('#proveedor').prop('disabled',true);
                    $('#cedula').val('');
                    $('#cedula').prop('disabled',true);
                    $('#comprobante').val('');
                    $('#comprobante').prop('disabled',true);
                    $('#observacion').val('');
                    $('#observacion').prop('disabled',true);
                    $('#fecha').val('');
                    $('#fecha').prop('disabled',true);
                    $('#cuenta').val('');
                    $('#cuenta').prop('disabled',true);
                    $('#cuenta').next().text('');
                    $('#mont').val('');
                    $('#mont').prop('disabled',true);
                    $('#dolare').prop('checked',false);
                    $('#dolare').prop('disabled',true);
                    $('#grupo').focus();
                    $('#pasivoMOV').slideUp();
                    $('#celdasMOV').fadeOut();
                    $('#agregarMOV').fadeOut();
                    $('#cambiosMOV').fadeOut();
                };
                s.editarMovimiento = function (){
                    if(validarDatosMovimientos() === '1')
                    {
                        dolares = 0;
                        if($('#dolare').prop('checked'))
                            dolares = 1;
                        pasivo = '';
                        if($('#cuenta').val() === '7-01-01')
                            pasivo = $('#pasivoMOV').val();
                        $.post('../controlador/administrarPeriodo.php', 
                        {
                            idMovimiento : $('#idMovimiento').val(),
                            grupo: $('#grupo').val(),
                            proveedor: $('#proveedor').val(),
                            cedula: $('#cedula').val(),
                            comprobante: $('#comprobante').val(),
                            observacion: $('#observacion').val(),
                            fecha: convertDate($('#fecha').val()),
                            cuenta: $('#cuenta').val(),
                            monto: $('#mont').val(),
                            montoActual: $('#montoActual').val(),
                            dolaresActual: $('#dolareActual').val(),
                            dolares: dolares,
                            idPasivo: pasivo, 
                            pasivoActual: $('#pasivoActual').val(),
                            accion: 'editarMovimiento'
                        })
                        .success(function (resp) {
                            resp = resp.substring(resp.length - 1);
                            if (resp === '1')//$('#refrescarTablaMovimientos').click();
                                location.reload();
                            else
                                alertaError('');
                            cerrarAlertaTiempo();
                        });
                        $('.menuCUExistente').css('visibility', 'hidden');
                    }
                };
            }])
            .controller('controlMensual', ['$scope', function (s) {
                $('#refrescarReporteMensual').click();
            }])
            .controller('controlEstadoResultados', ['$scope', function (s) {
                $('#refrescarEstadoResultados').click();
            }])
            .controller('controlBalanceGeneral', ['$scope', function (s) {
                $('#refrescarEstadoResultados').click();
                $('#refrescarBalanceGeneral').click();
            }])
            .controller('controlDeclaracionJurada', ['$scope', function (s) {
                $('#refrescarDeclaracionJurada').click();
            }]);

//----------------------------------------BITACORA
angular.module('moduleBitacora')
        .controller('controlBitacora', ['$scope', function (s) {
                $('#refrescarTablaBitacora').click();
            }]);
