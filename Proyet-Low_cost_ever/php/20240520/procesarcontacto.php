<?php 
    //Procesar la información recibida por $_POST
    if($_POST){
        $email = $_POST['email'];
        $password = $_POST['password'];
    }

    // echo "<p> $email </p>";
    // echo "<p> $password </p>";
    // echo "<p> $checkme </p>";

    header('location:index.php');

?>