<?php 
    include_once 'conexion.php';
    include 'menu.php';

    if(!isset($_SESSION['user']) || $_SESSION['rol']!== 1 ){
        header('location:login.php');
        exit;
    }

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

<?php include 'footer.php' ?>