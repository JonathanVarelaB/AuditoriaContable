$(document).ready(function () {
        $(".dataTable thead th").each(function () {
            var title = $(this).text();
            if(title !== "Dólares"){
                    if(title === "Código Contable")
                        $(this).html("<input style='width:100px; border-radius:5px; color:black;' type='text' placeholder=' Cuenta' />");
                    else
                        $(this).html("<input style='width:100px; border-radius:5px; color:black;' type='text' placeholder=' " + title + "' />");
            }
        });
        // DataTable
        var table = $('.dataTable').DataTable();
        // Apply the search
        table.columns().every(function () {
            var that = this;
            $('input', this.header()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                            .search(this.value)
                            .draw();
                }
            });
        });
    });
    cuentas = [];
    $(document).ready(function () {
        var table = $('.dataTable').DataTable();
        $('.dataTable tbody').on('click', 'tr', function () {
            if($(this).prop('id') != 'actual'){
                var data = table.row(this).data();
                if ($(this).hasClass('info'))
                    desSeleccionarElemento(this);
                else
                    seleccionarElemento(this, 'mov', data);
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
        
         $.post('../controlador/administrarPeriodo.php', {accion: 'obtenerCuentas'})
            .success(function(resp){
            localStorage.cuentas = resp;
            });
            cuentas = $.parseJSON(localStorage.cuentas);
        
        $( "#cuenta" ).autocomplete({
            lookup: cuentas
        });
        obtenerAnnoPeriodo();
        obtenerPasivos();
        $('#saldoPasivoMOV').val('999999999999999999999999999999999999');
        $('#pasivoMOV').change(function(){
            if($('#pasivoMOV').val() !== '0')
                obtenerSaldoPasivo($('#pasivoMOV').val());
        });
        
        $('#actual td input, #actual td textarea').focus(function(){
            $(this).css('border','1px solid #0F0F3D');
        });
        $('#actual td input, #actual td textarea').focusout(function(){
            $(this).css('border','1px solid #ABADB3');
        });
        $('#grupo').focus();
        $('#fecha').focus(function(){
            $(this).next().fadeIn();
        });
        $('#fecha').focusout(function(){
             $(this).next().fadeOut();
        });
        $('#cuenta').focus(function(){
             $(this).next().text('');
        });
        $('#cuenta').focusout(function(){
            obtenerNombreCuenta(this);
            if($('#cuenta').val() == '7-01-01'){
                $('#pasivoMOV').slideDown();
                $('#pasivoMOV').focus();
            }
            else
                $('#pasivoMOV').slideUp();
        });
        $('#dolare').focus(function(){
            $('#seleccionarMoneda').click();
        });
        
        $(document).keydown(function(tecla){
            if (tecla.keyCode == 13) { 
                var actual = document.activeElement;
                if($(actual).prop('id') === 'fecha'){
                    if($(actual).val() === ''){
                        errorDatos(actual,'El campo fecha es obligatorio');
                        return false;
                    }
                    else{
                        if(!validateDate($(actual).val())){
                            errorDatos(actual,'La fecha no es válida');
                            return false;
                        }
                        else{
                            if(convertDate($(actual).val()) !== ($('#annoPeriodoMOV').val()+'/09/30'))
                            {
                                if(!compareDates(convertDate($(actual).val()),$('#annoPeriodoMOV').val()+'/09/30')){
                                    errorDatos(actual,'La fecha es mayor a la del cierre del período');
                                    return false;
                                }
                                else{
                                    if(!compareDates((parseInt($('#annoPeriodoMOV').val())-1)+'/09/30',convertDate($(actual).val()))){
                                        errorDatos(actual,'La fecha es menor a la del inicio del período');
                                        return false;
                                    }
                                }
                            }
                        }
                    }
                }
                else{
                    if($(actual).prop('id') === 'mont'){
                        if($(actual).val() === ''){
                            errorDatos(actual,'El campo monto es obligatorio');
                            return false;
                        }
                    }
                    else{
                        if($(actual).prop('id') === 'cuenta'){
                            if($(actual).val() === ''){
                                errorDatos(actual,'El campo cuenta es obligatorio');
                                return false;
                            }
                            else{
                                if(cuentas.indexOf($('#cuenta').val()) === -1){
                                    errorDatos(actual,'La cuenta '+$('#cuenta').val()+' no esta registrada.');
                                    return false;
                                }
                            }
                        }
                    }
                }
                avanzarFormMov(actual);
            }
        });
    });
    function avanzarFormMov(actual){
        var nuevo = $(actual).parent().next().children();
        nuevo.prop('disabled',false);
        nuevo.focus();
    }
    function tipoMoneda(valor){
        if(valor === '0')
            $('#dolare').prop('checked',false);
        if(valor === '1')
            $('#dolare').prop('checked',true);
        cerrarEmergente();
        $('#dolare').focus();
        if($('#idMovimiento').val() == '')
            $('#agregarMOV').click();
        else
            $('#cambiosMOV').click();
    }
    function errorDatos(elemento,msj){
        $(elemento).parent().next().children().prop('disabled',true);
        $(elemento).css('border','1px solid red');
        alertaError(msj);
        cerrarAlertaTiempo();
    }
    function obtenerNombreCuenta(elemento){
        $.post('../controlador/administrarPeriodo.php', {codigo:$(elemento).val(), accion: 'obtenerNombreCuenta'})
            .success(function(resp){
                $(elemento).next().text(resp);
            });
    }
    function obtenerSaldoPasivo(pasivo){
        $.post('../controlador/administrarPeriodo.php', {codigo:pasivo, accion: 'obtenerSaldoPasivo'})
            .success(function(resp){
                $('#saldoPasivoMOV').val(resp);
            });
    }
    function obtenerPasivos(){
        $.post('../controlador/administrarPeriodo.php', {accion: 'obtenerPasivos'})
            .success(function(resp){
                $('#pasivoMOV').html('<option value="0">Seleccione la cuenta</option>'+resp);
            });
    }
    function obtenerAnnoPeriodo(){
        $.post('../controlador/administrarPeriodo.php', {accion: 'obtenerAnnoPeriodo'})
            .success(function(resp){
                $('#annoPeriodoMOV').val(resp);
            });
    }
    