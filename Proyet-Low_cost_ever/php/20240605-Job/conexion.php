<?php
$usuario = 'webapp';
$contraseña = '1234qwer';
try{
    $mbd = new PDO('mysql:host=localhost;dbname=escuela', $usuario, $contraseña);
    //echo 'Conexión correcta';
}catch(PDOException $e){
    print "Error: " . $e->getMessage() . '<br>';
    die();
}
?>