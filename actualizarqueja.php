<?php
$title = "Nueva Queja";
require_once 'includes/header.php';
require_once "db/conexion.php";

$id = $_GET['id'];
$usuario = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $asunto = $_POST['asunto'];
    $queja = $_POST['queja'];
    mysqli_query($con, "UPDATE quejas SET asunto = '$asunto', queja = '$queja' WHERE queja_id = $id");
    header("Location: ver-quejas.php?usuario=$usuario");
}

function actualizar($con, $id)
{
    $query = mysqli_query($con, "SELECT * FROM quejas WHERE queja_id = $id");
    while ($row = mysqli_fetch_array($query)) {
        $asunto = $row['asunto'];
        $queja = $row['queja'];
        $imagen_id = $row['imagen_id'];
        $query2 = mysqli_query($con, "SELECT * FROM imagenes WHERE imagen_id = $imagen_id");
        while ($row2 = mysqli_fetch_array($query2)) {
            $imagen1 = $row2['imagen1'];
            $imagen2 = $row2['imagen2'];
            $imagen3 = $row2['imagen3'];
            $imagen4 = $row2['imagen4'];
            $imagen5 = $row2['imagen5'];
            $imagenes = [$imagen1, $imagen2, $imagen3, $imagen4, $imagen5];
        }
    } ?>
    <form action="" method="POST">
        <div class="mb-3 container text-center w-50">
            <label class="h3">Asunto</label>
            <input type="text" name="asunto" class="form-control rounded border border-dark" value="<?php echo $asunto ?>" required>
        </div>
        <div class="mb-3 text-center">
            <label class="h3">Comentarios:</label>
            <textarea class="form-control rounded border border-dark" name="queja" style="height: 200px;" required><?php echo $queja ?></textarea>
        </div>
        <div class="container mb-3">
            <div class="text-center">
                <input type="submit" class="btn btn-success" name="enviar" value="Actualizar Queja">
            </div>
        </div>
    </form>

<?php }


actualizar($con, $id);

?>


<?php
require_once 'includes/footer.php';
?>