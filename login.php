<?php
$title = "Sign In";
require_once 'includes/header.php';
require_once 'db/conexion.php';

//If data was submitted via a form POST request, then...
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $contraseña = md5($contraseña);

    $query = mysqli_query($con, "SELECT * FROM usuarios where usuario = '$usuario' AND contraseña = '$contraseña';");
    while ($row = mysqli_fetch_array($query)) {
        $usuario_id = $row['usuario_id'];
        $nombre = $row['nombre'];
        $tipo = $row['tipo_usuario_id'];
        if ($tipo == 3) {
            $_SESSION['admin'] = $nombre;
            header("Location: index.php");
        } elseif ($tipo == 2) {
            $_SESSION['usuario'] = $nombre;
            $_SESSION['usuario_id'] = $usuario_id;
            header("Location: index.php");
        }
    }
    if (!$row) {
        echo '<div class="alert alert-danger" role="alert"> Username or Password incorrect</div>';
    }
}
?>
<div class="text-center h1" style="color: blue;">
    <p>SISTEMA DE QUEJAS ONLINE</p>
</div>
<main class="form-signin rounded bg-dark mx-auto w-50  py-4 text-white shadow">

    <form class="mx-auto text-center w-75" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <!--<img class="mb-4" src="https://getbootstrap.com/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
        <h1 class="h3 mb-3 fw-normal">Sign In</h1>

        <div class="form-floating">
            <input type="text" class="form-control bg-secondary p-2 text-dark  rounded-pill border-dark" name="usuario" placeholder="Usuario">
            <label for="floatingText">Usuario</label>
        </div>
        <br>
        <div class="form-floating">
            <input type="password" class="form-control bg-secondary p-2 text-dark  rounded-pill border-dark" name="contraseña" placeholder="Contraseña">
            <label for="floatingPassword">Contraseña</label>
        </div>
        <br>
        <button class="w-50 btn btn-lg btn-success text-white border-white rounded-pill" type="submit">Sign in</button>
    </form>
</main>

<?php require_once 'includes/footer.php' ?>