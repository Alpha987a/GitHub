<?php 
include_once 'conexion.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $id = $_POST['id'];

    $sqlDelete = "DELETE FROM productos WHERE id= :id";

    $sentenciaDelete = $mbd->prepare($sqlDelete);

    $sentenciaDelete->bindParam(':id', $id, PDO::PARAM_INT);
    $sentenciaDelete->execute();

    header('location:listadoproductos.php');
}
?>