<?php
require_once 'includes/header.php';
require_once 'db/conexion.php';

if (!isset($_GET['id'])) {
    echo "<h1 class='text-danger'>Por favor inicia sesión</h1>";
} else {
    $queja_id = $_GET['id'];
    $usuario = $_GET['usuario'];
    mysqli_query($con, "UPDATE queja SET eliminado = 1 WHERE q_id = $queja_id");
    mysqli_query($con, "UPDATE imagenes SET eliminado = 1 WHERE imagen_id = $queja_id");
    header("Location: ver-quejas.php?usuario=$usuario");

?>

<?php
}
require_once 'includes/footer.php';
?>