<?php include 'cabecera.php' ?>

<div class="container col-md-6 text-center mb-5">
<form id="formregistro" action="procesarproducto.php" method="POST">
    <img class="mb-4" src="market.png" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Alta Producto</h1>

    <div class="row mb-3">
      <div class="form-floating col">
        <input name="producto" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label class="ms-3" for="floatingInput">Producto</label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="form-floating col">
        <input name="descripcion" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label class="ms-3" for="floatingInput">Descripción</label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="form-floating col">
        <input name="precio" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label class="ms-3" for="floatingInput">Precio</label>
      </div>
      <div class="form-floating col">
        <input name="unidades" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label class="ms-3" for="floatingInput">Unidades</label>
      </div>
    </div>
    
    <button class="btn btn-primary w-100 py-2" type="submit">Registro</button>
  </form>
  </div>

  <?php include 'piepagina.php' ?>