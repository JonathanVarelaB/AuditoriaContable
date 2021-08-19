<!DOCTYPE html>
<html ng-app="moduleSesion">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>B&A</title>
        <link href='estilo/bootstrap/css/bootstrap.min.css' rel="stylesheet" media="screen">
        <link href="estilo/estilos.css" rel="stylesheet" type="text/css"/>
        <link href="estilo/hover-min.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" href="imagenes/faviconB&A.png">
    </head>
    <body>
        <div id='lugarAlerta' style='height: 100%;min-height: 100px;'></div>
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div id='login' class="col-sm-7 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div style='padding-right:20px;' class="form-top-left">
                                    <h2  class='letraAzul' id='nombreEmp'>Buzo & Asociados, S. A.</h2>
                                </div>
                                <div id='logoLogin' class="form-top-right"><center>
                                        <img src="imagenes/logoB&A.png"/></center>
                                </div>
                            </div>
                            <div class="form-bottom" ng-controller='controlSesion'>
                                <span style='font-size: 16px;' class='letraAzul'>Inicio de Sesión</span>
                                <form role="form" id="formAcceso" ng-submit="acceder();">
                                    <div class="form-group">
                                        <label class="sr-only" for="usuario"></label>
                                        <input type="text" maxlength="50" ng-model='usuario' required name="usuario" onfocus="cerrarAlerta();" placeholder="Usuario..." class="form-username form-control input" id="usuarioAcceso">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="contrasena"></label>
                                        <input type="password" maxlength="12" ng-model='contrasena' onfocus="cerrarAlerta();" required name="contrasena" placeholder="Contraseña..." class="form-password form-control input" id="contrasenaAcceso">
                                    </div>
                                    <div class="form-group">
                                        <a class='letraAzul' style='font-style: italic;' href='vista/recuperarClave.php'>¿Olvido su contraseña?</a>
                                    </div>
                                    <button type="submit" class="btn botonfondoAzul"><span style='color:white;'>Ingresar</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
    <script src='js/jquery-2.2.4.min.js'></script>
    <script src='js/bootstrap/js/bootstrap.min.js'></script>
    <script src='js/angular.min.js'></script>
    <script src='js/jquery.backstretch.min.js'></script>
    <script src='js/app.js'></script>
    <script src='js/controller.js'></script>
    <script src='js/script.js'></script>
    <script src='js/scriptFormularios.js'></script>
    <script>$.backstretch("imagenes/fondoLogin.jpg");</script>
