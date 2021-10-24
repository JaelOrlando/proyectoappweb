<?php
$title = "Sign Up";
require_once 'includes/header.php';
require_once 'db/conexion.php';
if (isset($_GET['usuario'])) {
    echo '<div class="alert alert-danger" role="alert"> Usuario en uso, Favor de elegir otro</div>';
}
if (isset($_POST['registrar'])){
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
?>
<div class="text-center h1" style="color: blue;">
    <p>SISTEMA DE QUEJAS ONLINE</p>
</div>
<form action="" method="POST">
    <div class="bg-dark text-white mx-auto px-4 py-5 w-50">
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Usuario*</label>
                <input type="text" class="form-control bg-secondary text-dark border border-dark" id="usuario" name="usuario" placeholder="Usuario" required>
            </div>
            <div class="col mb-3">
                <label class="form-label">Contraseña*</label>
                <input type="password" class="form-control bg-secondary text-dark border border-dark" name="contraseña" placeholder="Contraseña" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre(s)*</label>
            <input type="text" class="form-control bg-secondary text-dark border border-dark" id="nombre" name="nombre" placeholder="Nombre(s)" required>
        </div>
        <div class="row">
            <div class=" col mb-3">
                <label class="form-label">Apellidos Paterno*</label>
                <input type="text" class="form-control bg-secondary text-dark border border-dark" id="paterno" name="paterno" placeholder="Paterno" required>
            </div>
            <div class="col mb-3">
                <label class="form-label">Apellidos Materno*</label>
                <input type="text" class="form-control bg-secondary text-dark border border-dark" id="materno" name="materno" placeholder="Materno" required>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Correo Electronico*</label>
                <input type="email" class="form-control bg-secondary text-dark border border-dark" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="col mb-3">
                <label class="form-label">Telefono de Contacto*</label>
                <input type="text" class="form-control bg-secondary text-dark border border-dark" id="telefono" name="telefono" placeholder="1234567890" required>
            </div>
        </div>
        <input type="submit" class="btn btn-success" name="registrar" value="Registrarse">
    </div>
</form>
<br>

<?php require_once 'includes/footer.php' ?>