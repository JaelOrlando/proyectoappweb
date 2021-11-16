<?php
$title = "Restablecer Quejas";
require_once 'includes/header.php';
require_once 'db/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
    mysqli_query($con, "UPDATE queja SET eliminado = 0 where q_id = $id");
    mysqli_query($con, "UPDATE imagenes SET eliminado = 0 where imagen_id = $id");

    header("Location: restablecerquejas.php");
}

if (!isset($_SESSION['usuario'])) {
    echo "<h1 class='text-danger'>Por favor inicia sesión</h1>";
} else {

?>
    <div class="h1 text-center text-primary">
        USUARIOS REGISTRADOS
    </div>

    <div class="row justify-content-around">
        <?php
        $usuario_id = $_SESSION['usuario_id'];
        $query = mysqli_query($con, "SELECT * FROM quejas q inner join queja qu on q.q_id = qu.q_id inner join imagenes i on q.imagen_id = i.imagen_id inner join usuarios u on q.usuario_id = u.usuario_id where q.usuario_id = $usuario_id and qu.eliminado = 1");
        if (mysqli_num_rows($query) == 0) { ?>
            <div class="text-center h3" style="color: red;">
                <p>No hay quejas eliminadas</p>
            </div>
            <?php } else {
            while ($row = mysqli_fetch_array($query)) {
                $queja_id = $row['queja_id'];
                $usuario_id = $row['usuario_id'];
                $asunto = $row['asunto'];
                $queja = $row['queja'];
                $nombre = $row['nombre'];
                $fecha = $row['fecha'];
                $imagen1 = $row['imagen1'];
                $imagen2 = $row['imagen2'];
                $imagen3 = $row['imagen3'];
                $imagen4 = $row['imagen4'];
                $imagen5 = $row['imagen5'];
                $imagenes = [$imagen1, $imagen2, $imagen3, $imagen4, $imagen5];
            ?>
                <li class="list-group">
                    <div class="card text-center my-3">
                        <div class="card-header">
                            <h4><?php echo "$nombre" ?></h4>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo "$asunto" ?></h5>
                            <p class="card-text h6"><?php echo "$queja" ?></p>
                            <?php for ($i = 0; $i < count($imagenes); $i++) {
                                if ($imagenes[$i] == '') {
                                    break;
                                } else { ?>
                                    <img src="imagenes/<?php echo $imagenes[$i] ?>" alt="" width=" 12%">
                            <?php }
                            } ?>
                            <div class="row-1 mx-auto my-3">
                                <a href="restablecerquejas.php?id=<?php echo $queja_id ?>" class="border border-5 border-info rounded-pill btn btn-outline-info  mx-auto w-25 text-dark">Restablecer Queja</a>
                            </div>
                        </div>
                        <div class="card-footer text-dark  bg-secondary">
                            <div class="mb-2">
                                <?php echo $fecha ?>
                            </div>
                        </div>
                    </div>
                </li>
        <?php }
        } ?>
    </div>
<?php
}
require_once 'includes/footer.php';
?>