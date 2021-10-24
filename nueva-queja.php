<?php
$title = "Nueva Queja";
require_once 'includes/header.php';

function nuevaQueja($usuario)
{ ?>
    <form action="guardar-queja.php?id=<?php echo $usuario ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3 container text-center w-50">
            <label class="h3">Asunto</label>
            <input type="text" name="asunto" class="form-control rounded border border-dark" required>
        </div>
        <div class="mb-3 text-center">
            <label class="h3">Comentarios:</label>
            <textarea class="form-control rounded border border-dark" name="queja" style="height: 250px;" required></textarea>
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