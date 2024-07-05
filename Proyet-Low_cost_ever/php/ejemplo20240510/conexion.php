<?php
$usuario = 'webapp';
$contraseña = 'z0740392g';
try{
$mbd = new PDO('mysql:host=localhost;dbname=prueba', $usuario, $contraseña);
echo 'Conexión correcta';

}catch(PDOExption $e){
    print "Error: ". $e->getMessage() . '<br>';
    die();
}

?>