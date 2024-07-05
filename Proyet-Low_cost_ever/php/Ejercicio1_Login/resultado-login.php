<!DOCTYPE html>
<html lang="es">
<head>
    <title>resultado-login.php</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Resultado - Login</h1>
    <form action="resultado-login.php" method="post">
        <label for="role">Rol:</label>
        <input type="text" name="role" id="role" required>
        <input type="submit" value="Comprobar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $role = $_POST['role'];

        if ($role === "administrador") {
            echo '<p>Autorizado a modificar datos. <a href="data.php">Ir a la Data</a></p>';
        } elseif ($role === "usuario") {
            echo '<p>Solo visualización de datos. <a href="data.php">Ir a la Data</a></p>';
        } else {
            echo '<p>Acceso denegado.</p>';
        }
    }
    ?>
</body>
</html>