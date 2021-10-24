<?php
$title = "Registro";
require_once 'includes/header.php';
require_once 'db/conexion.php';

if (!isset($_POST['registrar'])) {
    echo "<h1 class='text-danger'>Por favor Registrate desde Sign-up</h1>";
} else {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $contraseña = md5($contraseña);
    $nombre = $_POST['nombre'];
    $materno = $_POST['materno'];
    $paterno = $_POST['paterno'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $tipo_usuario = 2;

    $user = mysqli_query($con, "SELECT usuario from usuarios where usuario = '$usuario'");
    while ($row = mysqli_fetch_array($user)) {
        $us = $row['usuario'];
    }
    if (isset($us)) {
        header("Location: signup.php?usuario");
    } else {
        mysqli_query($con, "call agregarUsuario('$usuario', '$nombre', '$paterno', '$materno', '$email', '$telefono', '$contraseña', $tipo_usuario);");
    }

?>

    <div class="alert alert-success text-center" role="alert">
        Registro Correcto!!
        <br>
        Por Favor Inicie Sesión
    </div>

<?php
}
require_once 'includes/footer.php';
?>