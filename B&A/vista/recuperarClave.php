<!DOCTYPE html>
<html ng-app="moduleUsuarios">
    <?php include('../includes/head.php'); ?>
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
                                        <img src="../imagenes/logoB&A.png"/></center>
                                </div>
                            </div>
                            <div class="form-bottom" ng-controller="controlRecuperarClave">
                                <span style='font-size: 16px;' class='letraAzul'>Recuperación de contraseña</span>
                                <div class="alert alert-info" style='font-size: 13px;'>
                                    Por favor ingrese su nombre de usuario y correo electrónico con el cual este registrado en el sistema.
                                    Se le enviará un correo electrónico con una nueva contraseña, la cual posteriormente puede cambiar.
                                </div>
                                <form role="form" ng-submit="recuperarClave();">
                                    <div class="form-group">
                                        <label class="sr-only" for="usuario"></label>
                                        <input type="text" maxlength="50" required ng-model="usuario" name="usuario" placeholder="Usuario..." class="form-username form-control input" id="usuario">
                                    </div>
                                    <input name='accion' type='hidden' value='recuperar'/>
                                    <div class="form-group">
                                        <label class="sr-only" for="email"></label>
                                        <input type="email" maxlength="50" required ng-model="email" name="email" placeholder="Correo Electrónico..." class="form-password form-control input" id="email">
                                    </div>
                                    <button type="submit" class="btn botonfondoAzul"><span>Enviar</span></button>
                                </form>
                                <br><br><span class='letraAzul' style='font-style: italic;'>Si desea diríjase a </span><a href='../index.php'>Inicio de Sesión</a>
                            </div>
                        </div>
                        </body>

                        </html>
                        <?php include('../includes/scripts.php'); ?>