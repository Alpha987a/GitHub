<?php 
//Conecta con la BBDD
include_once 'conexion.php';

//Recoger datos del formulario Nuevo Usuario
if($_POST){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nombreapellidos = $_POST['nombre'] . " " . $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $provincia = $_POST['provincia'];
    $pais = $_POST['pais'];
    $tipousuario = $_POST['tipousuario'];

    $sqlInsert = "INSERT INTO usuarios (id, email, password, nombreapellidos, direccion, ciudad, provincia, pais, tipousuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $sentenciaInsert = $mbd->prepare($sqlInsert);
    $sentenciaInsert->execute(array(NULL,$email,$password,$nombreapellidos, $direccion, $ciudad, $provincia, $pais, $tipousuario));

    header('location:registrousuario.php');
}









?>