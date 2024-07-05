<?php 
    include_once 'conexion.php';
    session_start();
    //si existe la sesion reenviar a index.php

    if(isset($_SESSION['user'])){
        header('location:index.php');
        exit;
    }

    //procesar el formulario de login
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $usuario = filter_input(INPUT_POST, 'usuario',FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        try {
            $sqlLogin = "SELECT usuario, password FROM usuarios WHERE usuario = :userBD";

            $sentenciaLogin = $mbd->prepare($sqlLogin);
            $sentenciaLogin->bindParam(':userBD', $usuario, PDO::PARAM_STR);
            $sentenciaLogin->execute();

            //Recoger los datos en un array
            $resultado = $sentenciaLogin->fetch(PDO::FETCH_ASSOC);

            //Verificar que la contraseña es correcta
            if($resultado){
                if(password_verify($password, $resultado['password'])){
                    $_SESSION['user'] = $usuario;
                    header('location:index.php');
                    exit; 
                }
                else{
                    $mensajeError='Credenciales incorrectas';
                    }
            }
            else{
                $mensajeError='Usuario no correcto';
                }
        }
        catch(PDOException $e)
        {
            $mensajeError='Error en la base de datos: ' . $e->getMessage();
        }
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
    <h1>Login</h1>
    <?php echo $mensajeError ?>
<form action="login.php" method="post">
    <div class="form-group mb-3">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" class="form-control" id="usuario">
    </div>
    <div class="form-group mb-3">
        <label for="password">Contraseña</label>
        <input type="password" name="password" class="form-control" id="password">
    </div>
    <button type="submit" class="btn btn-primary">Iniciar</button>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>