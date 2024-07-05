<?php 
//Conecta con la BBDD
include_once 'conexion.php';

//Recoger datos del formulario Nuevo Usuario
if($_POST){
    $usuario = $_POST['email'];
    $password = $_POST['password'];
    $tipousuario = $_POST['tipousuario'];

    $sqlInsert = "INSERT INTO usuarios (id, email, password, tipousuario) VALUES (?, ?, ?, ?)";

    $sentenciaInsert = $mbd->prepare($sqlInsert);
    $sentenciaInsert->execute(array(NULL,$usuario,$password,$tipousuario));

    header('location:registrousuario.php');
}









?>