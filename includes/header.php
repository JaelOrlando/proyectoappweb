<?php
include_once 'includes/session.php';
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
    <!--  Google Icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title><?php echo $title ?></title>
</head>

<body style="background-color: lightgray;">
    <nav class="navbar navbar-expand-md navbar-dark fixed bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><i class="bi bi-house-door" style="font-size: 30px"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <?php if (isset($_SESSION['admin'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary mx-1" aria-current="" href="ver-quejas.php?admin=<?php echo $_SESSION['admin'] ?>">Ver Todas Las Quejas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary mx-1" href="ver-usuarios.php">Usuarios Registrados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary mx-1" href="estadisticas.php">Estadisticas</a>
                        </li>
                    <?php } elseif (isset($_SESSION['usuario'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary mx-1" aria-current="" href="nueva-queja.php?id=<?php echo $_SESSION['usuario_id']; ?>">Nueva Queja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary mx-1" aria-current="" href="ver-quejas.php?usuario=<?php echo $_SESSION['usuario']; ?>">Ver Mis Quejas</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-primary mx-1" aria-current="" href="nueva-queja.php?id=2">Nueva Queja</a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="d-flex mx-2">
                    <?php if (isset($_SESSION['admin'])) { ?>
                        <a href="#" style="background-color: green; color: white;" class="rounded-pill navbar-item nav-link mx-2 disabled"><span>Bienvenido <?php echo strtoupper($_SESSION['admin']) ?></span></a>
                        <a class="nav-item nav-link text-white btn btn-danger rounded-pill" href="logout.php">Logout</a>
                    <?php } elseif (isset($_SESSION['usuario'])) { ?>
                        <a href="#" style="background-color: blue; color: white;" class="rounded-pill navbar-item nav-link mx-2 disabled"><span>Bienvenido <?php echo strtoupper($_SESSION['usuario']) ?></span></a>
                        <a class="nav-item nav-link text-white btn btn-danger rounded-pill" href="logout.php">Logout</a>
                    <?php } else { ?>
                        <a href="login.php" class="btn rounded-pill btn-outline-success mx-2">Login</a>
                        <a href="signup.php" class="btn rounded-pill btn-outline-primary">Sign Up</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
    <div class="container pt-2 pb-4 ">