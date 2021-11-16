<?php
$title = "Nueva Queja";
require_once 'includes/header.php';
require_once 'db/conexion.php';

if (isset($_POST['enviar'])) {
    $asunto = $_POST['asunto'];
    $queja = $_POST['queja'];
    $usuario = $_GET['id'];
    $target_dir = 'imagenes/';


    $groserias = ['puto', 'pendejo', 'idiota', 'madre', 'inutil', 'baboso', 'mames', 'estupido', 'tonto', 'pedo', 'culo', 'culera', 'puta', 'verga', 'maricon', 'pinche', 'huevon', 'huevos', 'tarado', 'wey'];

    $quejatmp = $queja;
    $quejaori = $queja;
    for ($j = 0; $j < count($groserias); $j++) {
        $len = strlen($groserias[$j]);
        $queja = str_replace($groserias[$j], str_repeat('*', $len), strtolower($queja));
    }
    $quejafil = $queja;

    if (strcmp($quejatmp, $quejafil) != 0) {
        $fil = 2;
    } else {
        $fil = 1;
    }

    if (isset($_FILES['imagen'])) {
        $imagenes = $_FILES['imagen'];
        for ($i = 0; $i < 5; $i++) {
            if (!isset($imagenes["name"][$i])) {
                $imagenes["name"][$i] = '';
            }
            if ($imagenes["name"][$i] != '') {
                $orig_file = $imagenes["tmp_name"][$i];
                $destination = $target_dir . $imagenes["name"][$i];
                move_uploaded_file($orig_file, $destination);
            }
        }
        $imagen1 = $imagenes["name"][0];
        $imagen2 = $imagenes["name"][1];
        $imagen3 = $imagenes["name"][2];
        $imagen4 = $imagenes["name"][3];
        $imagen5 = $imagenes["name"][4];
    }

    mysqli_query($con, "INSERT INTO imagenes (imagen1, imagen2, imagen3, imagen4, imagen5) VALUES ('$imagen1', '$imagen2', '$imagen3', '$imagen4', '$imagen5');");

    $query = mysqli_query($con, "SELECT imagen_id  from imagenes;");
    while ($row = mysqli_fetch_array($query)) {
        $imagen_id = $row['imagen_id'];
    }

    mysqli_query($con, "INSERT INTO queja (asunto, queja) VALUES ('$asunto', '$queja');");

    $query = mysqli_query($con, "SELECT q_id  from queja;");
    while ($row = mysqli_fetch_array($query)) {
        $q_id = $row['q_id'];
    }

    $query2 = mysqli_query($con, "SELECT tipo_usuario_id from usuarios where usuario_id = $usuario");
    while ($row = mysqli_fetch_array($query2)) {
        $tipo_usuario_id = $row['tipo_usuario_id'];
    }

    if ($usuario == 2) {
        $estado = 2;
    } elseif ($usuario > 2) {
        if ($fil == 1) {
            $estado = 1;
        } else {
            $estado = 2;
        }
    }

    mysqli_query($con, "call agregarQueja($q_id, $fil, $imagen_id, $estado, $usuario, $tipo_usuario_id);");
?>
    <div class="alert alert-success text-center" role="alert">
        Gracias por sus comentarios!!
        <br>
        La queja fue enviada correctamente
        <?php if ($_GET['id'] != 1 && $_GET['id'] != 2) { ?>
            <br>
            El administrador pronto dará respuesta
            <br>
        <?php } ?>
    </div>
<?php
}

function nuevaQueja($usuario)
{ ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3 container text-center w-50">
            <label class="h3">Asunto</label>
            <input type="text" name="asunto" class="form-control rounded border border-dark" required>
        </div>
        <div class="mb-3 text-center">
            <label class="h3">Comentarios:</label>
            <textarea class="form-control rounded border border-dark" name="queja" style="height: 180px;" required></textarea>
        </div>
        <div class="mb-3 container text-center w-50">
            <label class="h3">*Maximo 5 archivos*</label>
            <input type="file" accept="image/*" class="form-control" name="imagen[]" value="" multiple>
        </div>
        <div class="container mb-3">
            <div class="text-center">
                <input type="submit" class="btn btn-success" name="enviar" value="Enviar Queja">
            </div>
        </div>
    </form>

    <?php }

if (!isset($_SESSION['usuario'])) {
    if (isset($_GET['id'])) { ?>
        <div class="alert alert-warning text-center" role="alert">
            <p>Usted esta como ANONIMO el administrador no podra darle solucion a su queja</p>
        </div>
    <?php nuevaQueja($_GET['id']);
    } else
        echo "<h1 class='text-danger'>Por favor inicia sesión</h1>";
} else {
    nuevaQueja($_GET['id']);
    ?>


<?php
}
require_once 'includes/footer.php';
?>