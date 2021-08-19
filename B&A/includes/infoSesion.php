<div id='pie'>
    <div id='infoSesion' data-toggle="tooltip" title=<?php echo '"'.$_SESSION['nombreUsuario'].' - '.$_SESSION['emailUsuario'].'"';?>>
        <span><strong>Usuario:</strong> <?php echo $_SESSION['nombreCompleto']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
        <span style='white-space: nowrap'><strong>Inicio:</strong> <?php echo $_SESSION['fechaUsuario']; ?></span>
    </div>
    <div id='copyright'>
        <span>2016 ©</span>
    </div>
</div>