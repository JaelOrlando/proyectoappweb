<?php
$title = "Estado de la queja";
require_once 'includes/header.php';
require_once 'db/conexion.php';

if (!isset($_GET['id'])) {
    echo "<h1 class='text-danger'>Por favor inicia sesión</h1>";
} else {
    $idqueja = $_GET['id'];
    $query = mysqli_query($con, "SELECT qu.respuesta, q.estado_id FROM quejas q inner join queja qu on q.q_id = qu.q_id WHERE queja_id = $idqueja");
    while ($row = mysqli_fetch_array($query)) {
        $respuesta = $row['respuesta'];
        $estado_id = $row['estado_id'];
    }
?>

    <? if ($estado_id == 1) { ?>
        <div class="alert alert-warning text-center" role="alert">
            Su queja aun esta en revisión
        </div>
        <div class="text-center">
            <a href="ver-quejas.php?usuario=<?php echo $_SESSION['usuario']; ?>"><i class="bi bi-arrow-return-left" style="font-size: 70px; color: blue"></i></a>
        </div>
    <?php } elseif ($estado_id == 2) { ?>
        <div class="alert alert-danger text-center" role="alert">
            Su queja no a procedido debido a que usted uso lenguaje inapropiado
        </div>
        <div class="text-center">
            <a href="ver-quejas.php?usuario=<?php echo $_SESSION['usuario']; ?>"><i class="bi bi-arrow-return-left" style="font-size: 70px; color: blue"></i></a>
        </div>
    <?php } elseif ($estado_id == 3) { ?>
        <div class="alert alert-success text-center" role="alert">
            El administrador le dejo el siguiente mensaje:
        </div>
        <div class="text-center h5">
            <?php echo $respuesta ?>
        </div>
        <div class="text-center">
            <a href="ver-quejas.php?usuario=<?php echo $_SESSION['usuario']; ?>"><i class="bi bi-arrow-return-left" style="font-size: 70px; color: blue"></i></a>
        </div>
<?php
    }
}
require_once 'includes/footer.php';
?>