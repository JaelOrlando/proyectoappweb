<?php
require_once 'includes/header.php';
require_once 'db/conexion.php';
if (!isset($_GET['id'])) {
    echo "<h1 class='text-danger'>Por favor inicia sesión</h1>";
} else {
    $id = $_GET['id'];
    mysqli_query($con, "UPDATE usuarios SET eliminado = 1 where usuario_id = $id");
    $query = mysqli_query($con, "SELECT q.queja_id, i.imagen_id FROM quejas q INNER JOIN imagenes i ON q.imagen_id = i.imagen_id where q.usuario_id = $id");
    while ($row = mysqli_fetch_array($query)){
        $queja_id = $row['queja_id'];
        $imagen_id = $row['imagen_id'];
        mysqli_query($con, "UPDATE queja SET eliminado = 1 where q_id = $queja_id");
        mysqli_query($con, "UPDATE imagenes SET eliminado = 1 where imagen_id = $imagen_id");
    }
    header("Location: ver-usuarios.php");
}
?>