<?php

if($_POST){
    $usuario = $_POST['email'];
    $password = $_POST['password'];
}
header('location:index.php');
?>