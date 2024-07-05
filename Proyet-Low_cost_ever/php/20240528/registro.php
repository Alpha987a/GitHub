<?php 
    include_once 'conexion.php';

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $rol = $_POST['rol'];

        //Hash del password
        $hasedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sqlRegistro = 'INSERT INTO usuarios (usuario, password, rol) VALUES (?,?,?)';

        $sentenciaRegistro = $mbd->prepare($sqlRegistro);
        $sentenciaRegistro->execute(array($usuario, $hasedPassword, $rol));

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
<div class="container col-md-4">
    <h1>Registro usuarios</h1>
<form action="registro.php" method="post">
    <div class="form-group mb-3">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" class="form-control" id="usuario">
    </div>
    <div class="form-group mb-3">
        <label for="password">Contraseña</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    <div class="form-group mb-3">
        <select name="rol" id="rol" class="form-control">
            <option value="1">Administrador</option>
            <option value="2">Usuario</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Agregar</button>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>