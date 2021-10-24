<?php
$title = "Index";
require_once 'includes/header.php';
require_once 'db/conexion.php';

?>
<div class="text-center h1" style="color: blue;">
    <p>SISTEMA DE QUEJAS ONLINE</p>
</div>


<?php if (isset($_SESSION['admin'])) { ?>
    <div class="row row-cols-1 row-cols-sm-3 sm-3 p-5 text-center">
        <div class="col">
            <a href="ver-quejas.php?admin=<?php echo $_SESSION['admin'] ?>"><i class="bi bi-list" style="font-size: 100px; color: blue;"></i></a>
            <br><label class="fs-3">Ver Todas <br> Las Quejas</label>
        </div>
        <div class="col">
            <a href="ver-usuarios.php"><i class="bi bi-person-lines-fill" style="font-size: 100px; color: blue"></i></a>
            <br><label class="fs-3">Ver Usuarios</label>
        </div>
        <div class="col">
            <a href="estadisticas.php"><i class="bi bi-clipboard-data" style="font-size: 100px; color: blue"></i></a>
            <br><label class="fs-3">Estadisticas</label>
        </div>
    </div>
<?php } elseif (isset($_SESSION['usuario'])) { ?>
    <div class="row row-cols-1 row-cols-sm-2 sm-2 p-5 text-center">
        <div class="col">
            <a href="nueva-queja.php?id=<?php echo $_SESSION['usuario_id']; ?>"><i class="bi bi-journal-plus" style="font-size: 100px; color: blue"></i></a>
            <br><label class="fs-3">Nueva Queja</label>
        </div>
        <div class="col">
            <a href="ver-quejas.php?usuario=<?php echo $_SESSION['usuario']; ?>"><i class="bi bi-list" style="font-size: 100px; color: blue"></i></a>
            <br><label class="fs-3">Ver Mis Quejas</label>
        </div>
    </div>
<?php } else { ?>
    <div class="text-center text-dark lead fw-bold"">
        Bienvenido al sistema de quejas donde podrá enviar sus quejas las cuales seran revisadas por el administrador.
        Para que se le pueda dar solucion a sus quejas debe ser un usuario registrado
    </div>

<?php }

$query = mysqli_query($con, "SELECT * FROM quejas ORDER BY queja_id DESC");
if (!isset($_SESSION['admin'])) { ?>


    <ul class=" h4 list-group mt-5 rounded">
        <?php if (mysqli_num_rows($query) == 0) { ?>
            <div class="text-center h3" style="color: red;">
                <p>No hay Quejas</p>
            </div>
        <?php } else { ?>
            <?php while ($row = mysqli_fetch_array($query)) {
                $usuario_id = $row['usuario_id'];
                $asunto = $row['asunto'];
                $queja = $row['queja'];
                $imagen_id = $row['imagen_id'];
                $query2 = mysqli_query($con, "SELECT nombre FROM usuarios where usuario_id = '$usuario_id'");
                while ($row2 = mysqli_fetch_array($query2)) {
                    $nombre = $row2['nombre'];
                }
                $query3 = mysqli_query($con, "SELECT * FROM imagenes where imagen_id = $imagen_id"); ?>
                <li class="list-group">
                    <?php while ($row2 = mysqli_fetch_array($query3)) {
                        $imagen1 = $row2['imagen1'];
                        $imagen2 = $row2['imagen2'];
                        $imagen3 = $row2['imagen3'];
                        $imagen4 = $row2['imagen4'];
                        $imagen5 = $row2['imagen5'];
                        $imagenes = [$imagen1, $imagen2, $imagen3, $imagen4, $imagen5]; ?>
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
                                        <img src="imagenes/<?php echo $imagenes[$i] ?>" alt="" width=" 15%">
                                <?php }
                                } ?>
                            </div>
                            <div class="card-footer text-muted">
                                Hace 1 dia
                            </div>
                        </div>
                    <?php } ?>
                </li>
            <?php } ?>
            </ul>
    <?php }
    }
    require_once 'includes/footer.php' ?>