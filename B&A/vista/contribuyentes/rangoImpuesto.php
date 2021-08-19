<?php include('../emergentes/emergentesContribuyentes.php'); ?>
<div id='usuarioExistente' class='emergenteVentana'>
    <div id="contenidoPeriodoReducido">
        <br>
        <div class="btn-group" style='float:left'>
            <button title='Agregar Rango de Período' href='#nuevoRangoPeriodoTipo' class='btn btn-sm botonColor emergente' id='agregarRIV'>Agregar<span id='opcMenuConfig'> Rango de Período</span>&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"></span></button>
        </div>
        <br><br><h5>Rangos de Períodos Existentes</h5><hr>
        <div class="form-group" >
            <label class="control-label col-sm-1" for="tipoRango">Tipo</label>
            <div class="col-sm-3"  style='padding-top: 5px;'>
                <select class='form-control' id='tipoRango' ng-model="tipoRango" ng-change="cargarPeriodosRangos();">
                    <option value="0">Seleccione</option>
                    <option value="1">Físico</option>
                    <option value="2">Jurídico</option>
                </select>
            </div>
        </div>
        <div class="form-group" >
            <label class="control-label col-sm-1" for="periodoRango">Período</label>
            <div class="col-sm-3" >
                <select class='form-control' id='periodoRango' ng-model="periodoRango" ng-change="mostrarRangos();">
                    <option value="0">Ninguno</option>
                </select>
            </div>
        </div>
    </div>
    <div id="contenidoPeriodoReducido">
        <center>
            <div style='padding-top: 50px;' id="rangoDiv"></div>
        </center>
    </div>
</div>
<script>
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
</script>