<?php
$title = "Usuarios";
require_once 'includes/header.php';
require_once 'db/conexion.php';

if (!isset($_SESSION['admin'])) {
    echo "<h1 class='text-danger'>Por favor inicia sesión</h1>";
} else {

?>
    <div class="h1 text-center text-primary">
        USUARIOS REGISTRADOS
    </div>

    <div class="row justify-content-around">
        <?php
        $query = mysqli_query($con, "SELECT * FROM usuarios u inner join tipos_usuario t on u.tipo_usuario_id = t.tipo_usuario_id where tipo_usuario = 'Usuario' and eliminado = 0");
        while ($row = mysqli_fetch_array($query)) {
            $usuario_id = $row['usuario_id'];
            $nombre = $row['nombre'];
            $paterno = $row['paterno'];
            $materno = $row['materno'];
            $email = $row['email'];
            $telefono = $row['telefono'];
            $tipo = $row['tipo_usuario_id'];
            $tipo_usuario = $row['tipo_usuario'];
        ?>
            <div class="col-3 my-3 mx-1 ">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h3 class="card-title text-center"><?php echo $tipo_usuario ?></h3>
                        <p class="card-text"><b>Nombre</b> <?php echo $nombre ?></p>
                        <p class="card-text"><b>Apellido Paterno:</b> <?php echo $paterno ?></p>
                        <p class="card-text"><b>Apellido Materno:</b> <?php echo $materno ?></p>
                        <p class="card-text"><b>Email:</b> <?php echo $email ?></p>
                        <p class="card-text"><b>Telefono:</b> <?php echo $telefono ?></p>
                        <div class="text-center">
                            <a onclick="return confirm('¿Seguro que quieres eliminar el usuario');" href="eliminar-usuario.php?id=<?php echo $usuario_id ?>" class="btn btn-danger rounded-pill">Delete</a>
                        </div>

                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php
}
require_once 'includes/footer.php';
?>