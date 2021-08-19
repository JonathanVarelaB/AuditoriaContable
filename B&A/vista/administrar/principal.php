<?php 
    session_start();
?>

<!--creado = 1,revisado = 2,aprobado = 3-->
<div style="text-align:right;color:black;padding:8% 10% 0 0;box-shadow: red;"><strong>Período</strong>&nbsp;&nbsp;&nbsp;<span class='letraAzul'><?php echo $_SESSION['idAnnoPeriodo']; ?></span><br><br>
    <strong>Fecha de cierre</strong>&nbsp;&nbsp;&nbsp;<span class='letraAzul'><?php echo $_SESSION['cierrePeriodo'].' '.$_SESSION['idAnnoPeriodo']; ?></span><br><br>
    <strong>Creó</strong>&nbsp;&nbsp;&nbsp;<span class='letraAzul'><?php echo $_SESSION['creadorPeriodo']; ?></span><br><br>
    <?php 
    if($_SESSION['revisarPeriodo'] != '')
        echo "<strong>Revisó</strong>&nbsp;&nbsp;&nbsp;<span class='letraAzul'>".$_SESSION['revisarPeriodo']."</span><br><br>";
    if($_SESSION['aprobarPeriodo'] != '')
        echo "<strong>Aprobó</strong>&nbsp;&nbsp;&nbsp;<span class='letraAzul'>".$_SESSION['aprobarPeriodo']."</span><br><br>";
    ?>
    <strong>Estado</strong>&nbsp;&nbsp;&nbsp;<span class='letraAzul'><?php echo $_SESSION['estadoPeriodo']; ?></span><br><br><br>
    <?php 
    if($_SESSION['estadoPeriodo'] == 'Creado')
        echo '<button style="width:250px;border-radius: 30px;" class="btn botonfondoAzul">Revisado</button>';
    if($_SESSION['estadoPeriodo'] == 'Revisado')
        echo '<button style="width:250px;border-radius: 30px;" class="btn botonfondoAzul">Aprobar</button>';
    ?></div>