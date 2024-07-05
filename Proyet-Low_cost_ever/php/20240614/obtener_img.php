<?php
    include_once 'conexion.php';
try{
    //SQL para obtener todas las imagenes
    $sql_imagenes = "SELECT id, productos_id, ruta, alt FROM imagenes";
    $snt = $mbd->prepare($sql_imagenes);
    $snt->execute();

    $imgProd = $snt->fetchAll(PDO::FETCH_ASSOC);

}catch (PDOexception $e){
    echo 'Error: ' . $e->getMessage();
    exit();
}

header('Content-Type: application/json');
echo json_encode($imgProd);
?>