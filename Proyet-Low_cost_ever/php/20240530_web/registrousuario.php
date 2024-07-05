<?php include 'cabecera.php';

if(!isset($_SESSION['user'])){
    header('location:login.php');
    exit;
   }
?>

<div class="container col-md-6 text-center mb-5">
<form id="formregistro" action="procesarregistro.php" method="POST">
    <img class="mb-4" src="market.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Registro nuevo usuario</h1>

    <div class="row mb-3">
      <div class="form-floating col">
        <input name="email" type="email" class="form-control" id="email">
        <label class="ms-3" for="email">Email address</label>
      </div>
    
      <div class="form-floating col">
        <input name="password" type="password" class="form-control" id="password" >
        <label class="ms-3" for="password">Password</label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="form-floating col">
        <input name="nombre" type="text" class="form-control" id="nombre">
        <label class="ms-3" for="nombre">Nombre</label>
      </div>
      <div class="form-floating col">
        <input name="apellidos" type="text" class="form-control" id="apellidos" >
        <label class="ms-3" for="apellidos">Apellidos</label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="form-floating">
        <input name="direccion" type="text" class="form-control" id="direccion" >
        <label class="ms-3" for="direccion">Direccion</label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="form-floating col">
        <input name="ciudad" type="text" class="form-control" id="ciudad" >
        <label class="ms-3" for="ciudad">Ciudad</label>
      </div>
      <div class="form-floating col">
        <input name="provincia" type="text" class="form-control" id="provincia" >
        <label class="ms-3" for="floatingInput">Provincia</label>
      </div>
      <div class="form-floating col">
        <input name="pais" type="text" class="form-control" id="pais" >
        <label class="ms-3" for="pais">País</label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="form-floating">
        <select name="tipousuario" id="tipousuario" class="form-control">
          <option selected value="0">Tipo usuario</option>
          <option value="1">Admin</option>
          <option value="2">Staff</option>
          <option value="3">Costumer</option>
        </select>
      </div>
  </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Registro</button>
  </form>
  </div>

  <?php include 'piepagina.php' ?>