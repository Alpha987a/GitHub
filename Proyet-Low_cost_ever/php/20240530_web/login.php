<?php
  include_once 'conexion.php';
  include 'cabecera.php';
 if(isset($_SESSION['user'])){
  header('location:index.php');
  exit;
 }
  //procesar el formulario
  if($_SERVER['REQUEST_METHOD']==='POST'){
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING); //$email = $_POST['email]
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    try{
      $sqlLogin = "SELECT email, password, nombreapellidos FROM usuarios WHERE email = :email";

      $sentenciaLogin = $mbd->prepare($sqlLogin);
      $sentenciaLogin->bindParam(':email', $email, PDO::PARAM_STR);
      $sentenciaLogin->execute();

      //recuperar la consulta en un array asociativo
      $resultado = $sentenciaLogin->fetch(PDO::FETCH_ASSOC);

      //Verificar que el usuario es correcto
      if($resultado){
        //Verificar que la contraseña es correcta
        if(password_verify($password, $resultado['password'])){
          //crear variable de sesion
          $_SESSION['user']=$resultado['nombreapellidos'];

          header('location:index.php');
          exit;
        }else{
          $mensajeError = "Credenciales incorrectas";
        } 
      }else{
        $mensajeError = "Usuario no es correcto";
      }

    }
    catch(PDOException $e) {
        $mensajeError= "Database error: " . $e->getMessage();
    }
  }


?>
<div class="container col-md-6 text-center mb-5">
  <form action="login.php" method="POST">
    <img class="mb-4" src="market.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <div class="row mb-3">
      <div class="form-floating">
        <input name="email" type="email" class="form-control" id="email" >
        <label class="ms-3" for="email">Email address</label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="form-floating">
        <input name="password" type="password" class="form-control" id="password" >
        <label class="ms-3" for="password">Password</label>
      </div>
    </div>
    
    <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
  </form>
  <div class="mt-3">
    <?php if(isset($mensajeError)):?>
      <div class="alert alert-warning">
        <?php echo htmlspecialchars($mensajeError)?>
      </div>
    <?php endif ?>
  </div>
</div>

  <?php include 'piepagina.php' ?>