<?php
//conectar con la BBDD
include_once 'conexion.php';

if($_POST){
$nombreapellidos = $_POST['nombreapellidos'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$provincia =$_POST['provincia'];
$pais = $_POST['pais'];
$id = $_POST['id'];

$sqlUpdate = "UPDATE usuarios SET nombreapellidos= $nombreapellidos, direccion= $direccion, ciudad= $ciudad, provincia= $provincia, pais= $pais WHERE id = $id"; 

$sentenciaUpdate = $mbd->prepare($sqlUpdate);
$sentenciaUpdate->execute();

}
?>