<?php
include_once 'conexion.php';

$sqlConsulta = "SELECT producto, descripcion, precio, unidades FROM productos";

$sentenciaSelect = $mbd->prepare($sqlConsulta);
$sentenciaSelect->execute();

$resultado = $sentenciaSelect->fetchAll();
?>

<?php include 'cabecera.php' ?>

<div class="container col-12 mt-5">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">

        <table class="table table-striped">
            <thead>
                <tr><th>Producto</th><th>Descripcion</th><th>€/ud</th><th>Uds</th></tr>
            </thead>
            <tbody>
                <?php foreach($resultado as $dato):?>
                <tr>
                    <td><?php echo $dato['producto']?></td>
                    <td><?php echo $dato['descripcion']?></td>
                    <td><?php echo $dato['precio']?></td>
                    <td><?php echo $dato['unidades']?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        </div>
    </div>
</div>

<?php include 'piepagina.php' ?>