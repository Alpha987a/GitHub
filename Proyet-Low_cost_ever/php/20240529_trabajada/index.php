<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Pagina inicio</h1>
    <?php if(isset($_SESSION['user'])): ?>
        <p>Bienveni@: <?php echo htmlspecialchars($_SESSION['user']);?></p>
        <p><a href="logout.php">Cerrar sesión</a></p>
    <?php endif ?>
    <?php if(!isset($_SESSION['user'])):?>
        <p><a href="login.php">Iniciar sesión</a></p>
    <?php endif ?>
    <p><a href="usuarios.php">Listado usuarios</a></p>
</body>
</html>