<?php
$title = "Nueva Queja";
require_once 'includes/header.php';
require_once "db/conexion.php";

$id = $_GET['id'];
$usuario = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $asunto = $_POST['asunto'];
    $queja = $_POST['queja'];
    $groserias = ['puto', 'pendejo', 'idiota', 'madre', 'inutil', 'baboso', 'mames', 'estupido', 'tonto', 'pedo', 'culo', 'culera', 'puta', 'verga', 'maricon', 'pinche', 'huevon', 'huevos', 'tarado', 'wey'];
    
    $quejatmp = $queja;
    for ($j = 0; $j < count($groserias); $j++) {
        $len = strlen($groserias[$j]);
        $queja = str_replace($groserias[$j], str_repeat('*', $len), strtolower($queja));
    }
    $quejafil = $queja;

    if (strcmp($quejatmp, $quejafil) != 0) {
        $fil = 2;
    } else {
        $fil = 1;
        $estado = 1;
    }
    mysqli_query($con, "UPDATE queja SET asunto = '$asunto', queja = '$queja' WHERE q_id = $id");
    mysqli_query($con, "UPDATE quejas SET filtro_id = $fil, estado_id = $estado WHERE queja_id = $id");
    header("Location: ver-quejas.php?usuario=$usuario");
}

function actualizar($con, $id)
{
    $query = mysqli_query($con, "SELECT * FROM queja WHERE q_id = $id");
    while ($row = mysqli_fetch_array($query)) {
        $asunto = $row['asunto'];
        $queja = $row['queja'];
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