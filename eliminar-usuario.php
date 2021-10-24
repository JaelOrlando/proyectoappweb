<?php
require_once 'includes/header.php';
require_once 'db/conexion.php';
if (!isset($_GET['id'])) {
    echo "<h1 class='text-danger'>Por favor inicia sesión</h1>";
} else {
    $id = $_GET['id'];
    mysqli_query($con, "DELETE FROM usuarios where usuario_id = $id");
    header("Location: ver-usuarios.php");
}
?>