<?php
$title = "Estado de la queja";
require_once 'includes/header.php';
require_once 'db/conexion.php';


if (!isset($_GET['id'])) {
    echo "<h1 class='text-danger'>Por favor intenta de nuevo</h1>";
} else {
    $idqueja = $_GET['id'];
    mysqli_query($con, "UPDATE quejas SET estado_id = 2 where queja_id = $idqueja");
?>
    <div class="alert alert-danger text-center" role="alert">
        La queja se decarto correctamente
    </div>
<?php
}
require_once 'includes/footer.php';
?>