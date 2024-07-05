<?php
$usuario = 'if0_36625747';
$pass = '1q2w3e4rAzSxDc';
try{
    $mbd = new PDO('mysql:host=sql302.infinityfree.com;dbname=if0_36625747_lowcostever', $usuario, $pass);
    //echo 'Conexión correcta';
}catch(PDOException $e){
    print "Error: " . $e->getMessage() . '<br>';
    die();
}
?>