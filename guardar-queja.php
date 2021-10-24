<?php
$title = "Guardar Queja";
require_once 'includes/header.php';
require_once 'db/conexion.php';



if (!isset($_POST['enviar'])) {
    echo "<h1 class='text-danger'>Por favor crea una queja</h1>";
} else {
    $asunto = $_POST['asunto'];
    $queja = $_POST['queja'];
    $usuario = $_GET['id'];

    $target_dir = 'imagenes/';

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

    $query2 = mysqli_query($con, "SELECT tipo_usuario_id from usuarios where usuario_id = $usuario");
    while ($row = mysqli_fetch_array($query2)) {
        $tipo_usuario_id = $row['tipo_usuario_id'];
    }

    if ($usuario == 2) {
        $estado = 2;
    } elseif ($usuario > 2) {
        $estado = 1;
    }

    mysqli_query($con, "INSERT INTO quejas (asunto, queja, filtro_id, imagen_id, estado_id, usuario_id, tipo_usuario_id) VALUES ('$asunto', '$queja', 1, $imagen_id, $estado, $usuario, $tipo_usuario_id);");
    /*
    $groserias = ['puto', 'pendejo', 'idiota', 'chinga tu madre'];
    $gro = mysqli_query($con, "SELECT filtro_id FROM quejas where usuario_id = $usuario");
    while ($row = mysqli_fetch_array($gro)) {
        $filtro = $row['filtro_id'];
        
        for ($i=0; $i < count($groserias); $i++) { 

        }
    }*/

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
require_once 'includes/footer.php';
?>