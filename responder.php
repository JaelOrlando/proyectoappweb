<?php
$title = "Estado de la queja";
require_once 'includes/header.php';
require_once 'db/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $respuesta = $_POST['respuesta'];
    $idqueja = $_GET['id'];

    mysqli_query($con, "UPDATE quejas SET respuesta = '$respuesta', estado_id = 3 WHERE queja_id = $idqueja");
    echo '<div class="alert alert-success" role="alert"> Respuesta enviada</div>';
}

if (!isset($_GET['id'])) {
    echo "<h1 class='text-danger'>Por favor inicia sesión</h1>";
} else {
    $idqueja = $_GET['id'];

?>
    <form action="" method="POST">
        <div class="mb-3 text-center">
            <label class="h3">Ingrese la Respuesta para el Usuario</label>
            <textarea class="form-control rounded border border-dark" name="respuesta" style="height: 250px;" required></textarea>
        </div>
        <div class="container mb-3">
            <div class="text-center">
                <input type="submit" class="btn btn-success" value="Enviar Queja">
            </div>
        </div>
    </form>
<?php
}

require_once 'includes/footer.php';
?>