<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>B&A</title>
    <link href='../estilo/bootstrap/css/bootstrap.min.css' rel="stylesheet" media="screen">
    <link href="../estilo/estilos.css" rel="stylesheet" type="text/css"/>
    <link href="../estilo/hover-min.css" rel="stylesheet" type="text/css"/>
    <link href="../estilo/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="../estilo/magnific-popup.css" rel="stylesheet" type="text/css"/>
    <link href="../estilo/dataTable.bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="../estilo/jAlert.css" rel="stylesheet" type="text/css"/>
    <link rel="icon" href="../imagenes/faviconB&A.png">
</head>
<!--------------------------------------------------CERRAR SESION----------------------------->
<div id="cerrarSesion" class="zoom-anim-dialog white-popup-block-pequeña mfp-hide emergenteVentana">
    <form role="form" action='../controlador/acceso.php' method="post" id="formCerrarSesion">
        <center><h4>Cerrar Sesión</h4><hr></center>
        <div class="form-group">
            <center><span style='color:black'>¿Desea salir y cerrar sesión?</span><br><br>
                <input type='hidden' name='accion' value='salir'/>
                <button type="submit" class="btn botonfondoAzul"><span>Aceptar</span></button>
                <button onclick='cerrarEmergente();' type="reset" class="btn btn-danger"><span>Cancelar</span></button></center>
        </div>
    </form>
</div>
<!--------------------------------------------------TIPO DE CAMBIO----------------------------->
<div id="tipoDeCambio" class="zoom-anim-dialog white-popup-block-mini mfp-hide emergenteVentana">
    <form class='form-horizontal' role="form" id="formTipoDeCambio">
        <center><h4>Tipo de Cambio</h4><hr>
        <div class="form-group" style='padding-top: 20px;'>
            <?php
                if($_SESSION['tipoUsuario'] === '1')
                {
                    echo '<div id="tipoCambio2"></div>
                    </div><br><button type="submit" class="btn botonfondoAzul botonDolar"><span>Guardar Cambios</span></button></center>';
                }
                else
                    echo '<div id="tipoCambio3"></div></div>';
            ?>
        </center>
    </form>
</div>