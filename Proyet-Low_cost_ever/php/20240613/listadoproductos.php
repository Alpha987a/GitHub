<?php
include_once 'conexion.php';
include 'cabecera.php';
if(!isset($_SESSION['user'])){
    header('location:login.php');
    exit;
}
if(!isset($_SESSION['user']) || $_SESSION['rol']>= 3 ){
    header('location:login.php');
    exit;
}

$sqlConsulta = "SELECT id, producto, descripcion, precio, unidades FROM productos";

$sentenciaSelect = $mbd->prepare($sqlConsulta);
$sentenciaSelect->execute();

$resultado = $sentenciaSelect->fetchAll();

//Nuevo SELECT WHERE unidades < 10
$sqlConsultaMenor = "SELECT producto, descripcion, precio, unidades FROM productos WHERE unidades < 10";

$sentenciaSelectMenor = $mbd->prepare($sqlConsultaMenor);
$sentenciaSelectMenor->execute();

$resultadoMenor = $sentenciaSelectMenor->fetchAll();
?>
<div class="container col-12 mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Descripcion</th>
                    <th>€/ud</th>
                    <th>Uds</th>
                    <th>
                        <button class="btn btn-secondary" type="button" onclick="addProducto()">Añadir</button>
                    </th>
                    <th>
                        <button class="btn btn-secondary" type="button" onclick="stockProducto()">Stock</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($resultado as $dato):?>
                <tr>
                    <td><?php echo $dato['producto']?></td>
                    <td><?php echo $dato['descripcion']?></td>
                    <td><?php echo $dato['precio']?></td>
                    <td class="uds"><?php echo $dato['unidades']?></td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="editProducto('<?php echo $dato['id']?>','<?php echo $dato['producto']?>','<?php echo $dato['descripcion']?>','<?php echo $dato['precio']?>','<?php echo $dato['unidades']?>')">Editar</button>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning" onclick="deleteProducto('<?php echo $dato['id']?>')">Eliminar</button>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        </div>
    </div>

      
    <!-- Modal añadir Producto -->
    <div class="modal fade" id="addProdModal" tabindex="-1" role="dialog" aria-labelledby="addProdModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="procesarproducto.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header d-flex justify-content-between">
                        <h5>Añadir producto</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                             <div class="form-floating col">
                                <input name="producto" type="text" class="form-control" id="add-producto">
                                <label class="ms-3" for="producto">Producto</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-floating col">
                                <input name="descripcion" type="text" class="form-control" id="add-descripcion">
                                <label class="ms-3" for="descripcion">Descripción</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-floating col">
                                <input name="precio" type="text" class="form-control" id="add-precio">
                                <label class="ms-3" for="precio">Precio</label>
                            </div>
                            <div class="form-floating col">
                                <input name="unidades" type="text" class="form-control" id="add-unidades">
                                <label class="ms-3" for="unidades">Unidades</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-floating">
                                <input class="btn btn-secondary" type="file" id="imagen" name="imagen[]" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- fin modal añadir producto -->

    <!-- Modal editar Producto -->
    <div class="modal fade" id="editProdModal" tabindex="-1" role="dialog" aria-labelledby="editProdModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="modificarproducto.php" method="post">
                    <div class="modal-header d-flex justify-content-between">
                        <h5>Editar producto</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <input name="id" type="text" id="edit-id" hidden>
                        <div class="row mb-3">
                             <div class="form-floating col">
                                <input name="producto" type="text" class="form-control" id="edit-producto">
                                <label class="ms-3" for="producto">Producto</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-floating col">
                                <input name="descripcion" type="text" class="form-control" id="edit-descripcion">
                                <label class="ms-3" for="descripcion">Descripción</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-floating col">
                                <input name="precio" type="text" class="form-control" id="edit-precio">
                                <label class="ms-3" for="precio">Precio</label>
                            </div>
                            <div class="form-floating col">
                                <input name="unidades" type="text" class="form-control" id="edit-unidades">
                                <label class="ms-3" for="unidades">Unidades</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- fin modal editar producto -->

    <!-- Modal eliminar Producto -->
    <div class="modal fade" id="deleteProdModal" tabindex="-1" role="dialog" aria-labelledby="deleteProdModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="eliminarproductos.php" method="post">
                    <div class="modal-header d-flex justify-content-between">
                        <h5>Eliminar producto</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <input name="id" type="text" id="delete-id" hidden>
                        <div class="row mb-3">
                             <p>Esta acción eliminará el producto</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- fin modal eliminar producto -->

    <!-- Modal stock Producto -->
    <div class="modal fade" id="stockProdModal" tabindex="-1" role="dialog" aria-labelledby="stockProdModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5>Stock minimo producto</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                             <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Descripcion</th>
                                        <th>€/ud</th>
                                        <th>Unidades</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($resultadoMenor as $datoM):?>
                                    <tr>
                                        <td><?php echo $datoM['producto'] ?></td>
                                        <td><?php echo $datoM['descripcion'] ?></td>
                                        <td><?php echo $datoM['precio'] ?></td>
                                        <td><?php echo $datoM['unidades'] ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                             </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
            </div>
        </div>
    </div> <!-- fin modal stock producto -->
</div>


<script>
    //FUNCIONES DE LLAMADAS A LOS MODAL DE PRODUCTOS
    function addProducto(){
        var modal = new bootstrap.Modal(document.getElementById('addProdModal'));
        modal.show();
    }

    function editProducto(id, producto, descripcion, precio, unidades){
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-producto').value = producto;
        document.getElementById('edit-descripcion').value = descripcion;
        document.getElementById('edit-precio').value = precio;
        document.getElementById('edit-unidades').value = unidades;

        var modal = new bootstrap.Modal(document.getElementById('editProdModal'));
        modal.show();
    }

    function deleteProducto(id){
        document.getElementById('delete-id').value = id;

        var modal = new bootstrap.Modal(document.getElementById('deleteProdModal'));
        modal.show();
    }

    function stockProducto(){
        
        var modal = new bootstrap.Modal(document.getElementById('stockProdModal'));
        modal.show();
    }

</script>


<script src="jsScript.js"></script>
<?php include 'piepagina.php' ?>