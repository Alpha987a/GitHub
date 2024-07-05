<?php
    include_once 'conexion.php';

if($_POST){

    $id = $_POST['id'];

    $sqlDelete = "DELETE FROM usuarios WHERE id = $id";
    $sentenciaDelete = $mbd->prepare($sqlDelete);
    $sentenciaDelete->execute();
}
?>