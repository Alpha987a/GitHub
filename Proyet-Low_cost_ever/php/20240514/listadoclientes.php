<?php
include_once 'conexion.php';

$sqlConsulta = "SELECT email, tipousuario FROM usuarios WHERE tipousuario=3";

$sentenciaSelect = $mbd->prepare($sqlConsulta);
$sentenciaSelect->execute();

$resultado = $sentenciaSelect->fetchAll();

//var_dump($resultado);
?>

<?php include 'cabecera.php' ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <?php foreach($resultado as $dato): ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $dato['email']; ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>

</div>

<?php include 'piepagina.php' ?>