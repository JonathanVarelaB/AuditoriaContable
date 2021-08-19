<!DOCTYPE html>
<html>
    <?php include('../includes/head.php'); ?>
    <body>
        <?php include('../includes/encabezado.php'); ?>
        <div id='contenido' class='container'>
            <center>
                <br>
                <?php
                if (isset($_GET['t'])) {
                    echo "<br><h2 style='color:maroon'>Error</h2><br>";
                    if ($_GET['t'] == 1) {
                        //acceso denegado
                        echo '<span>No puede accesar a la página indicada</span>';
                    }
                    if ($_GET['t'] == 2) {
                        //error BD
                        echo '<span>No se logró realizar la conexion con la base de datos, intente más tarde</span>';
                    }
                } else {
                    //ingreso a la pagina de error
                    echo "<h2 style='color:maroon'>Página de error</h2><br>";
                }
                ?>
                <br><br><span>Si desea diríjase a </span><a href='../index.php'>Inicio de Sesión</a>
            </center>
        </div>
       <div id='copyright' style="color: white;width: 100%;text-align: right;">
        <span style="padding-right: 30px;">2016 ©</span>
    </div>
    </body>
</html>
<?php include('../includes/scripts.php'); ?>
