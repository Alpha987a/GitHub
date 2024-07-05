<?php session_start();?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appweb</title>

    <!-- Estilos Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <a href="#" class="navbar-brand">AppWeb</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php if(isset($_SESSION['user'])): ?>
                        <li class="nav-item"><a class="nav-link" href="productos.php">Productos</a></li>
                        <?php if($_SESSION['rol']== 1): ?>
                            <li class="nav-item"><a class="nav-link" href="usuarios.php">Usuarios</a></li>
                            <li class="nav-item"><a class="nav-link" href="registro.php">Registro</a></li>
                        <?php endif ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
    </header>