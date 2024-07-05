<?php 
//Conecta con la BBDD
include_once 'conexion.php';

//Recoger datos del formulario Nuevo Usuario
if($_SERVER['REQUEST_METHOD']==='POST'){
    $producto = $_POST['producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $unidades = $_POST['unidades'];
    
    $sqlInsert = "INSERT INTO productos (id, producto, descripcion, precio, unidades) VALUES (?, ?, ?, ?, ?)";

    $sentenciaInsert = $mbd->prepare($sqlInsert);
    $sentenciaInsert->execute(array(NULL,$producto,$descripcion,$precio, $unidades));

   header('location:listadoproductos.php');

    //header('location:registroproducto.php');
}









?>