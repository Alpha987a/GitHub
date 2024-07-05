<?php 
    session_start();

    //si el usuario no está autentificado, no podrá entrar
    //esta página y se envía a la página de login
    if(!isset($_SESSION['user'])){
        header('location:login.php');
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Listado usuarios</h1>
</body>
</html>