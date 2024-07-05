<?php
include_once 'conexion.php';

$sqlConsulta = "SELECT id, nombreapellidos, email, direccion, ciudad, provincia, pais FROM usuarios WHERE tipousuario=3";

$sentenciaSelect = $mbd->prepare($sqlConsulta);
$sentenciaSelect->execute();

$resultado = $sentenciaSelect->fetchAll();

//var_dump($resultado);
?>

<?php include 'cabecera.php' ?>

<div class="container col-12 mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">email</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Provincia</th>
                        <th scope="col">País</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultado as $dato): ?>
                        <tr>
                            <th scope="row"><?php echo $dato['id'] ?></th>
                            <td><?php echo  $dato['nombreapellidos']; ?></td>
                            <td><?php echo  $dato['email']; ?></td>
                            <td><?php echo  $dato['direccion']; ?></td>
                            <td><?php echo  $dato['ciudad']; ?></td>
                            <td><?php echo  $dato['provincia']; ?></td>
                            <td><?php echo  $dato['pais']; ?></td>
                            <td>
                                <button class="btn btn-primary btn-edit" onclick="editCliente('<?php echo $dato['id'] ?>','<?php echo  $dato['nombreapellidos']; ?>','<?php echo  $dato['email']; ?>','<?php echo  $dato['direccion']; ?>','<?php echo  $dato['ciudad']; ?>','<?php echo  $dato['provincia']; ?>','<?php echo  $dato['pais']; ?>')">Editar</button>
                            </td>
                            <td>
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
</script>
<?php include 'piepagina.php' ?>