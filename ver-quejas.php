<?php
$title = "Ver Quejas";
require_once 'includes/header.php';
require_once 'db/conexion.php';

function verQuejaUsuario($user, $con)
{
    $usuario_id = $_SESSION['usuario_id'];
    $query = mysqli_query($con, "SELECT * FROM quejas q inner join usuarios u on q.usuario_id = u.usuario_id inner join imagenes i on q.imagen_id = i.imagen_id where q.usuario_id = $usuario_id and q.eliminado = 0 order by queja_id desc");
?>
    <div class="h1 text-center text-primary">
        <p>QUEJAS DE <?php echo strtoupper($user) ?>:</p>
    </div>
    <ul class=" h4 list-group mt-5 rounded">
        <?php if (mysqli_num_rows($query) == 0) { ?>
            <div class="text-center h3" style="color: red;">
                <p>No hay Quejas</p>
            </div>
        <?php } else { ?>
            <?php while ($row = mysqli_fetch_array($query)) {
                $queja_id = $row['queja_id'];
                $usuario_id = $row['usuario_id'];
                $asunto = $row['asunto'];
                $queja = $row['queja'];
                $imagen_id = $row['imagen_id'];
                $nombre = $row['nombre'];
                $imagen1 = $row['imagen1'];
                $imagen2 = $row['imagen2'];
                $imagen3 = $row['imagen3'];
                $imagen4 = $row['imagen4'];
                $imagen5 = $row['imagen5'];
                $imagenes = [$imagen1, $imagen2, $imagen3, $imagen4, $imagen5]; ?>
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
                                <a href="estado-queja.php?id=<?php echo $queja_id ?>&usuario=<?php echo $user ?>" class="border border-5 border-warning rounded-pill btn btn-outline-warning mx-auto w-25 text-dark">Ver Status</a>
                                <a href="actualizarqueja.php?id=<?php echo $queja_id ?>" class="border border-5 border-info rounded-pill btn btn-outline-info  mx-auto w-25 text-dark">Actualizar</a>
                                <a onclick="return confirm('¿Seguro que quieres eliminar el usuario');" href="eliminar-queja.php?id=<?php echo $queja_id ?>&usuario=<?php echo $user ?>" class="border border-5 border-danger rounded-pill btn btn-outline-danger mx-auto w-25 text-dark">Eliminar</a>
                            </div>
                        </div>
                        <div class="card-footer text-dark  bg-secondary">
                            <div class="mb-2">
                                Hace 1 dia
                            </div>
                        </div>
                    </div>
                </li>
        <?php }
        } ?>
    </ul>

<?php }

function verQuejasAdministrador($con)
{
    $query = mysqli_query($con, "SELECT * FROM quejas q inner join usuarios u on q.usuario_id = u.usuario_id inner join imagenes i on q.imagen_id = i.imagen_id WHERE q.estado_id = 1 and q.eliminado = 0 ORDER BY q.queja_id DESC");
?>
    <div class="h1 text-center text-primary">
        <p>TODAS LAS QUEJAS</p>
    </div>
    <div class="row justify-content-around">
        <div class="col-5">
            <div class="h4 text-center">
                Quejas Pendientes:
            </div>
            <ul class=" h4 list-group mt-2 rounded">
                <?php if (mysqli_num_rows($query) == 0) { ?>
                    <div class="text-center h3" style="color: red;">
                        <p>No hay Quejas</p>
                    </div>
                <?php } else { ?>
                    <?php while ($row = mysqli_fetch_array($query)) {
                        $queja_id = $row['queja_id'];
                        $usuario_id = $row['usuario_id'];
                        $asunto = $row['asunto'];
                        $queja = $row['queja'];
                        $imagen_id = $row['imagen_id'];
                        $nombre = $row['nombre'];
                        $imagen1 = $row['imagen1'];
                        $imagen2 = $row['imagen2'];
                        $imagen3 = $row['imagen3'];
                        $imagen4 = $row['imagen4'];
                        $imagen5 = $row['imagen5'];
                        $imagenes = [$imagen1, $imagen2, $imagen3, $imagen4, $imagen5]; ?>
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
                                            <img src="imagenes/<?php echo $imagenes[$i] ?>" alt="" width="25%">
                                    <?php }
                                    } ?>
                                    <div class="in-line mx-auto mt-3">
                                        <a href="responder.php?id=<?php echo $queja_id ?>" class="btn btn-success">Responder</a>
                                        <!--<a href="descartar.php?id=<?php #echo $queja_id 
                                                                        ?>" class="btn btn-danger">Descartar</a>-->
                                    </div>
                                </div>
                                <div class="card-footer text-dark  bg-secondary">
                                    <div class="mb-2">
                                        Hace 1 dia
                                    </div>

                                </div>
                            </div>
                        </li>
                <?php }
                } ?>
            </ul>
        </div>

        <?php
        $res = mysqli_query($con, "SELECT * FROM quejas q inner join usuarios u on q.usuario_id = u.usuario_id inner join imagenes i on q.imagen_id = i.imagen_id WHERE q.estado_id = 2 OR q.estado_id = 3 and q.eliminado = 0 ORDER BY q.queja_id DESC"); ?>
        <div class="col-5">
            <div class="h4 text-center">
                Quejas Resueltas:
            </div>
            <ul class=" h4 list-group mt-3 rounded">
                <?php if (mysqli_num_rows($res) == 0) { ?>
                    <div class="text-center h3" style="color: red;">
                        <p>No hay Quejas</p>
                    </div>
                <?php } else { ?>
                    <?php while ($row = mysqli_fetch_array($res)) {
                        $queja_id = $row['queja_id'];
                        $usuario_id = $row['usuario_id'];
                        $asunto = $row['asunto'];
                        $queja = $row['queja'];
                        $respuesta = $row['respuesta'];
                        $filtro_id = $row['filtro_id'];
                        $imagen_id = $row['imagen_id'];
                        $estado = $row['estado_id'];
                        $nombre = $row['nombre'];
                        $imagen1 = $row['imagen1'];
                        $imagen2 = $row['imagen2'];
                        $imagen3 = $row['imagen3'];
                        $imagen4 = $row['imagen4'];
                        $imagen5 = $row['imagen5'];
                        $imagenes = [$imagen1, $imagen2, $imagen3, $imagen4, $imagen5]; ?>
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
                                            <img src="imagenes/<?php echo $imagenes[$i] ?>" alt="" width=" 25%">
                                    <?php }
                                    } ?>
                                    <div class="in-line mx-auto mt-3">
                                        <?php if ($estado == 2) {
                                            if ($usuario_id == 2) { ?>
                                                <a class="btn btn-warning disabled">Usuario Anonimo</a>
                                            <?php }
                                            if ($filtro_id == 2 && $estado == 2) { ?>
                                                <a class="btn btn-warning disabled">Queja descartada</a>
                                            <?php }
                                        } else { ?>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#respuesta<?php echo $queja_id ?>">
                                                Ver Respuesta
                                            </button>

                                            <div class="modal fade" id="respuesta<?php echo $queja_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Respuesta</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $respuesta ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="card-footer text-dark  bg-secondary">
                                    <div class="mb-2">
                                        Hace 1 dia
                                    </div>

                                </div>
                            </div>

                            <!-- Modal -->
                        </li>
                <?php }
                } ?>
            </ul>
        </div>
    </div>

<?php }

if (isset($_SESSION['admin'])) {
    verQuejasAdministrador($con);
} elseif (isset($_SESSION['usuario'])) {
    verQuejaUsuario($_GET['usuario'], $con);
} else {
    echo "<h1 class='text-danger'>Please check the details and try again</h1>";

?>

<?php
}
require_once 'includes/footer.php';
?>