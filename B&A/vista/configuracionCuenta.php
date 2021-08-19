<?php 
    session_start();
    if(!isset($_SESSION['idUsuario']))
        header('Location: ../index.php');
?>
<!DOCTYPE html>
<html>
    <?php include('../includes/head.php'); ?>
    <body id="bodyNormal" ng-app="moduleUsuarios">
        <div class="fix1">
            <?php include('../includes/encabezado.php'); ?>
            <div id='ubicacion'>
                <a href='inicio.php'><span style='color:#2098D1'><span  class="glyphicon glyphicon-home"></span><span id='opcMenuConfig'>&nbsp;&nbsp;Inicio</span></span></a>
                <span style='color:white'>/</span>
                <span style='color:white'>Contraseña</span>
                <?php include('../includes/menuConfig.php'); ?>
            </div>
        </div>
        <div id='lugarAlerta'></div>
        <div id='contenido' class='container'>
            <div class="container" id='controlUsuarios'>
                <br><span id='tituloPag'>Cambio de Contraseña</span><hr>
            </div>
            <div id="recuperacion" ng-controller="cambioContrasena">
                <div class="alert alert-info">
                    La contraseña debe ser de longitud mayor a 4 y menor a 13.<br>
                    Se pueden utilizar números y letras (minúsculas y mayúsculas).
                </div>
                <form role="form" id="formCambioContraseña" ng-submit="cambiarContrasena();">
                    <div class="form-group">
                        <label  for="contraseñaVieja">Contraseña Actual</label>
                        <input type="password" maxlength="12" onfocus="cerrarAlerta();" ng-model="cActual" required name="contraseñaVieja" placeholder="Contraseña Actual..." class="form-username form-control" id="contraseñaVieja">
                    </div><br>
                    <div class="form-group">
                        <label  for="contraseñaNueva">Contraseña Nueva</label>
                        <input type="password" maxlength="12" onfocus="cerrarAlerta();" ng-model='cNueva' required name="contraseñaNueva" placeholder="Contraseña Nueva..." class="form-password form-control" id="contraseñaNueva">
                    </div>
                    <div class="form-group">
                        <label  for="contraseñaNueva2">Repita Contraseña Nueva</label>
                        <input type="password" maxlength="12" onfocus="cerrarAlerta();" ng-model="cNueva2" required name="contraseñaNueva2" placeholder="Repita Contraseña Nueva..." class="form-password form-control" id="contraseñaNueva2">
                    </div>
                    <center><button type="submit" class="btn botonfondoAzul"><span>Guardar cambios</span></button></center>
                </form>
            </div>
        </div>
        <?php include('../includes/infoSesion.php'); ?>
    </body>

</html>
<?php include('../includes/scripts.php'); ?>