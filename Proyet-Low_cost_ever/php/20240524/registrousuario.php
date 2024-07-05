<?php include 'cabecera.php' ?>

<div class="container col-md-6 text-center mb-5">
<form id="formregistro" action="procesarregistro.php" method="POST">
    <img class="mb-4" src="market.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Registro nuevo usuario</h1>

    <div class="row mb-3">
      <div class="form-floating col">
        <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label class="ms-3" for="floatingInput">Email address</label>
      </div>
    
      <div class="form-floating col">
        <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label class="ms-3" for="floatingPassword">Password</label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="form-floating col">
        <input name="nombre" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label class="ms-3" for="floatingInput">Nombre</label>
      </div>
      <div class="form-floating col">
        <input name="apellidos" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label class="ms-3" for="floatingInput">Apellidos</label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="form-floating">
        <input name="direccion" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label class="ms-3" for="floatingInput">Direccion</label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="form-floating col">
        <input name="ciudad" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label class="ms-3" for="floatingInput">Ciudad</label>
      </div>
      <div class="form-floating col">
        <input name="provincia" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label class="ms-3" for="floatingInput">Provincia</label>
      </div>
      <div class="form-floating col">
        <input name="pais" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label class="ms-3" for="floatingInput">País</label>
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
    <!-- <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div> -->
    <button class="btn btn-primary w-100 py-2" type="submit">Registro</button>
  </form>
  </div>

  <?php include 'piepagina.php' ?>