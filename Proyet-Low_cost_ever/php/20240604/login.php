<?php 
    include_once 'conexion.php';
    include 'menu.php';
    
    //si existe la sesion reenviar a index.php
    if(isset($_SESSION['user'])){
        header('location:index.php');
        exit;
    }

    //procesar el formulario de login
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $usuario = filter_input(INPUT_POST, 'usuario',FILTER_SANITIZE_STRING); //$usuario = $_POST['usuario'];
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING); //$password = $_POST['password'];

        try {
            $sqlLogin = "SELECT usuario, password, rol FROM usuarios WHERE usuario = :userBD";

            $sentenciaLogin = $mbd->prepare($sqlLogin);
            $sentenciaLogin->bindParam(':userBD', $usuario, PDO::PARAM_STR);
            $sentenciaLogin->execute();

            //Recoger los datos en un array
            $resultado = $sentenciaLogin->fetch(PDO::FETCH_ASSOC);

            //Verificar que la contraseña es correcta
            if($resultado){                   
                if(password_verify($password, $resultado['password'])){
                    $_SESSION['user'] = $resultado['usuario']; //$usuario;
                    $_SESSION['rol'] = $resultado['rol'];
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
    
<div class="container col-md-4">
    <h1>Login</h1>
    <?php if(isset($mensajeError)):?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($mensajeError);?>
        </div>
    <?php endif ?>
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

<?php include 'footer.php' ?>