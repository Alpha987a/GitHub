<?php
//conectar con BBDD
include_once 'conexion.php';


if($_SERVER['REQUEST_METHOD']==='POST'){
    //recoger datos formulario
    $id = $_POST['id'];
    $producto = $_POST['producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $unidades = $_POST['unidades'];

    //sentencia de modificar registro en tabla BBDD
    $sqlUpdate = "UPDATE productos SET producto = :producto, descripcion = :descripcion, precio= :precio, unidades= :unidades WHERE id = :id";

    //preparar el sql para PDO
    $sentenciaUpdate = $mbd->prepare($sqlUpdate);

    //parametrizar los valores del sql
    $sentenciaUpdate->bindParam(':id', $id, PDO::PARAM_INT);
    $sentenciaUpdate->bindParam(':producto', $producto, PDO::PARAM_STR);
    $sentenciaUpdate->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $sentenciaUpdate->bindParam(':precio', $precio, PDO::PARAM_STR);
    $sentenciaUpdate->bindParam(':unidades', $unidades, PDO::PARAM_INT);

    //ejecutar la sentencia
    $sentenciaUpdate->execute();

    header('location:listadoproductos.php');
}

?>