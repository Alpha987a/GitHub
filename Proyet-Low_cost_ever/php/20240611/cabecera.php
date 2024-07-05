<?php session_start(); ?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!--Estilos de bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!--Estilos propios-->
    <link rel="stylesheet" href="css/sign-in.css">
    <style>
      
    </style>
  </head>
  <body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="contacto.php">Contacto</a>
            </li>
            <?php if(!isset($_SESSION['user'])):?>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
            <?php endif ?>
            <?php if(isset($_SESSION['user'])):?>
              <?php if($_SESSION['rol']!==3):?>
                <li class="nav-item">
                  <a class="nav-link" href="listadoclientes.php">Clientes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="listadoproductos.php">Productos</a>
                </li>
              <?php endif ?>
              <?php if($_SESSION['rol'] == 1): ?>
                <li class="nav-item">
                <a class="nav-link" href="registrousuario.php">Registro Usuarios</a>
              </li>
              <?php endif ?>
            <?php endif ?>
          </ul>
          <?php if(isset($_SESSION['user'])):?>
              <div class=" border border-secondary-subtle nav-item p-1 col-3 d-flex justify-content-around align-items-center">
                  <img src="avatar.png" alt="foto perfil" width="20%">
                  <span> <?php echo $_SESSION['user'] ?> </span>
                  <a class="nav-link" href="logout.php">cerrar</a>
              </div>
            <?php endif ?>
          </div>
    </div>
    </nav>
    </header>