<?php
$title = "Estadisticas";
require_once 'includes/header.php';
require_once 'db/conexion.php';

$result = mysqli_query($con, "SELECT * FROM quejas WHERE eliminado = 0");
$numquejas = mysqli_num_rows($result);

$porcentaje = 100/$numquejas;

$result = mysqli_query($con, "SELECT * FROM quejas WHERE estado_id = 1 AND eliminado = 0");
$numpendientes = mysqli_num_rows($result);
$numpendientes=$porcentaje*$numpendientes;

$result = mysqli_query($con, "SELECT * FROM quejas WHERE estado_id = 2 AND eliminado = 0");
$numdescartadas = mysqli_num_rows($result);
$numdescartadas=$porcentaje*$numdescartadas;

$result = mysqli_query($con, "SELECT * FROM quejas WHERE estado_id = 3 AND eliminado = 0");
$numresueltas = mysqli_num_rows($result);
$numresueltas=$porcentaje*$numresueltas;

$result = mysqli_query($con, "SELECT * FROM usuarios WHERE tipo_usuario_id = 2 AND eliminado = 0");
$numusuarios = mysqli_num_rows($result);
$pusuarios = 100/$numusuarios;

$result = mysqli_query($con, "SELECT * FROM usuarios WHERE tipo_usuario_id = 2 AND eliminado = 0");
$usuariosa = mysqli_num_rows($result);
$usuariosa = $pusuarios*$usuariosa;

$result = mysqli_query($con, "SELECT * FROM usuarios WHERE tipo_usuario_id = 2 AND eliminado = 1");
$usuariose = mysqli_num_rows($result);
$usuariose = $pusuarios*$usuariose;

?>
<div class="display-2 text-center text-danger">
    Estadisticas
</div>
<br>
<div class="h4 text-center">
    Numero de Quejas: <?php echo $numquejas ?>
</div>
<br>
<div class="progress">
    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $numpendientes."%" ?>" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
    <div class="progress-bar bg-danger" role="progressbar" style="width:  <?php echo $numdescartadas."%" ?>" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $numresueltas."%" ?>" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<br>
<div class="h5 text-center row align-items-center">
    <div class="col-3"><?php echo "Pendientes: ".$numpendientes/$porcentaje ?> <i class="bi bi-circle-fill" style="color: #FFC107;"></i></div>
    <div class="col-3"><?php echo "Descartadas: ".$numdescartadas/$porcentaje ?> <i class="bi bi-circle-fill" style="color: #DC3545;"></i></div>
    <div class="col-3"><?php echo "Resueltas: ".$numresueltas/$porcentaje ?> <i class="bi bi-circle-fill" style="color: #198754;"></i></div>
</div>

<br><br><br>
<div class="h4 text-center">
    Numero de Usuarios: <?php echo $numusuarios ?>
</div>
<br>
<div class="progress">
    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $usuariosa."%" ?>" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
    <div class="progress-bar bg-danger" role="progressbar" style="width:  <?php echo $usuariose."%" ?>" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<br>
<div class="h5 text-center row align-items-center">
    <div class="col-3"><?php echo "Usuarios Activos: ".$usuariosa/$pusuarios ?> <i class="bi bi-circle-fill" style="color: #198754;"></i></div>
    <div class="col-3"><?php echo "Usuarios Eliminados: ".$usuariose/$pusuarios ?> <i class="bi bi-circle-fill" style="color: #DC3545;"></i></div>
</div>

<!-- 
    <div class="alert alert-warning text-center" role="alert">
        Su queja aun esta en revisión
    </div>
    <div class="alert alert-danger text-center" role="alert">
        Su queja no a procedido debido a que usted uso lenguaje inapropiado
    </div>
    <div class="alert alert-success text-center" role="alert">
        El administrador le dejo el siguiente mensaje:
    </div>
    <br>
    <div class="text-center h5">
        <p>Mensaje enviado por el administrador</p>
    </div>
 -->

<?php

require_once 'includes/footer.php';
?>