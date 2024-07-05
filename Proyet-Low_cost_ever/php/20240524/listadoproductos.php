<?php
include_once 'conexion.php';

$sqlConsulta = "SELECT producto, descripcion, precio, unidades FROM productos";

$sentenciaSelect = $mbd->prepare($sqlConsulta);
$sentenciaSelect->execute();

$resultado = $sentenciaSelect->fetchAll();

//Nuevo SELECT WHERE unidades < 10
$sqlConsultaMenor = "SELECT producto, descripcion, precio, unidades FROM productos WHERE unidades < 10";

$sentenciaSelectMenor = $mbd->prepare($sqlConsultaMenor);
$sentenciaSelectMenor->execute();

$resultadoMenor = $sentenciaSelectMenor->fetchAll();
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
                    <td class="uds"><?php echo $dato['unidades']?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        </div>
    </div>

    <!--Mostrar la segunda tabla de stock mínimo -->
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <table class="table table-striped">
                <thead>
                    <tr><th>Producto</th><th>Descripcion</th><th>€/ud</th><th>Unidades</th></tr>
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

    <!--Mostrar en mensaje toda la info -->
    <div class="row">
        <div class="col-md-12">
            <?php foreach($resultadoMenor as $datoM): ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $datoM['producto'] . " " . $datoM['descripcion'] . " " . $datoM['precio'] . " " . $datoM['unidades'] ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<script src="jsScript.js"></script>
<?php include 'piepagina.php' ?>