<?php
include_once 'conexion.php';

$sqlConsulta = "SELECT email, nombreapellidos, direccion, ciudad, provincia, pais FROM usuarios WHERE tipousuario=3";

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
                        <th scope="col">Nombre</th>
                        <th scope="col">email</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Provincia</th>
                        <th scope="col">País</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultado as $dato): ?>
                        <tr>
                            <th scope="row"><?php echo  $dato['nombreapellidos']; ?></th>
                            <td><?php echo  $dato['email']; ?></td>
                            <td><?php echo  $dato['direccion']; ?></td>
                            <td><?php echo  $dato['ciudad']; ?></td>
                            <td><?php echo  $dato['provincia']; ?></td>
                            <td><?php echo  $dato['pais']; ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include 'piepagina.php' ?>