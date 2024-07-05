<?php
include_once 'conexion.php';
include 'cabecera.php';
if(!isset($_SESSION['user'])){
    header('location:login.php');
    exit;
}


$sqlConsulta = "SELECT id, email, nombreapellidos, direccion, ciudad, provincia, pais FROM usuarios WHERE tipousuario=3";

$sentenciaSelect = $mbd->prepare($sqlConsulta);
$sentenciaSelect->execute();

$resultado = $sentenciaSelect->fetchAll();

?>

<div class="container col-12 mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">email</th>
                        <th scope="col">Acciones</th>
                        <th>
                            <button class="btn btn-secondary" onclick="addCliente()">Añadir</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultado as $dato): ?>
                        <tr>
                            <th scope="row"><?php echo $dato['id'] ?></th>
                            <td><?php echo  $dato['nombreapellidos']; ?></td>
                            <td><?php echo  $dato['email']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-edit" onclick="editCliente('<?php echo $dato['id'] ?>','<?php echo  $dato['nombreapellidos']; ?>','<?php echo  $dato['email']; ?>','<?php echo  $dato['direccion']; ?>','<?php echo  $dato['ciudad']; ?>','<?php echo  $dato['provincia']; ?>','<?php echo  $dato['pais']; ?>')">Editar</button>
                            </td>
                            <td>
                                <button onclick="deleteCliente('<?php echo $dato['id'] ?>')" class="btn btn-danger btn-delete">Eliminar</button>
                            </td>
                            <td>
                                <button class="btn btn-success" onclick="detalleCliente('<?php echo  $dato['direccion']; ?>','<?php echo  $dato['ciudad']; ?>','<?php echo  $dato['provincia']; ?>','<?php echo  $dato['pais']; ?>')">Detalles</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal de edición de la tabla -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editForm" action="modificarclientes.php" method="post">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="editModalLabel">Editar clientes</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                       <input type="text" id="edit-id" name="id" hidden> 
                       <div class="form-group">
                            <label for="nombre">Nombre y apellidos</label>
                            <input type="text" class="form-control" id="edit-nombre" name="nombre">
                       </div>
                       <div class="form-group">
                            <label for="email">email</label>
                            <input class="form-control" type="email" name="email" id="edit-email">
                       </div>
                       <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="edit-direccion" name="direccion">
                       </div>
                       <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control" id="edit-ciudad" name="ciudad">
                       </div>
                       <div class="form-group">
                            <label for="provincia">Provincia</label>
                            <input type="text" class="form-control" id="edit-provincia" name="provincia">
                       </div>
                       <div class="form-group">
                            <label for="pais">País</label>
                            <input type="text" class="form-control" id="edit-pais" name="pais">
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>        
            </div>
        </div>
    </div> <!--fin del Modal edición -->

    <!-- Modal eliminar registro de la tabla -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteForm" action="eliminarclientes.php" method="post">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="deleteModalLabel">Eliminar clientes</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                       <input type="text" id="delete-id" name="id" hidden> 
                       <div class="alert alert-warning">Esta acción no se puede deshacer</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>        
            </div>
        </div>
    </div> <!--fin del Modal eliminar -->

    <!--Modal añadir cliente -->
    <div  class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addForm" action="addcliente.php" method="post">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="addModalLabel">Añadir clientes</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                    <div class="row mb-3">
                        <div class="form-floating col">
                            <input name="email" type="email" class="form-control" id="add-email" required>
                            <label class="ms-3" for="email">Email address</label>
                        </div>
                        
                        <div class="form-floating col">
                            <input name="password" type="password" class="form-control" id="add-password" required>
                            <label class="ms-3" for="password">Password</label>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <div class="form-floating col">
                            <input name="nombre" type="text" class="form-control" id="add-nombre" required>
                            <label class="ms-3" for="nombre">Nombre</label>
                        </div>
                        <div class="form-floating col">
                            <input name="apellidos" type="text" class="form-control" id="add-apellidos" required>
                            <label class="ms-3" for="apellidos">Apellidos</label>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <div class="form-floating">
                            <input name="direccion" type="text" class="form-control" id="add-direccion">
                            <label class="ms-3" for="direccion">Direccion</label>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <div class="form-floating col">
                            <input name="ciudad" type="text" class="form-control" id="add-ciudad">
                            <label class="ms-3" for="ciudad">Ciudad</label>
                        </div>
                        <div class="form-floating col">
                            <input name="provincia" type="text" class="form-control" id="add-provincia">
                            <label class="ms-3" for="provincia">Provincia</label>
                        </div>
                        <div class="form-floating col">
                            <input name="pais" type="text" class="form-control" id="add-pais">
                            <label class="ms-3" for="pais">País</label>
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
    </div> <!--fin del modal añadir -->

    <!-- Modal detalle registro de la tabla -->
    <div class="modal fade" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="detalleModalLabel">Detalle cliente</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="modal-body">
                       <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Dirección</th>
                                    <th scope="col">Ciudad</th>
                                    <th scope="col">Provincia</th>
                                    <th scope="col">País</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td id="detalle-direccion"></td>
                                <td id="detalle-ciudad"></td>
                                <td id="detalle-provincia"></td>
                                <td id="detalle-pais"></td>
                            </tbody>
                       </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                    </div>       
            </div>
        </div>
    </div> <!--fin del Modal detalle -->
</div>

<script>
    function editCliente(id, nombre, email, direccion, ciudad, provincia, pais){
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nombre').value = nombre;
        document.getElementById('edit-email').value = email;
        document.getElementById('edit-direccion').value = direccion;
        document.getElementById('edit-ciudad').value = ciudad;
        document.getElementById('edit-provincia').value = provincia;
        document.getElementById('edit-pais').value = pais;

        var modal = new bootstrap.Modal(document.getElementById('editModal'));
        modal.show();
    }

    function deleteCliente(id){
        document.getElementById('delete-id').value = id;

        var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    function addCliente(){

        var modal = new bootstrap.Modal(document.getElementById('addModal'));
        modal.show();
    }

    function detalleCliente(direccion, ciudad, provincia, pais){
        document.getElementById('detalle-direccion').textContent= direccion;
        document.getElementById('detalle-ciudad').textContent= ciudad;
        document.getElementById('detalle-provincia').textContent= provincia;
        document.getElementById('detalle-pais').textContent= pais;

        var modal = new bootstrap.Modal(document.getElementById('detalleModal'));
        modal.show();
    }
</script>
<?php include 'piepagina.php' ?>