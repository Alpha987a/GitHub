<?php 
//Conecta con la BBDD
include_once 'conexion.php';

//Recoger datos del formulario Nuevo Usuario
if($_SERVER['REQUEST_METHOD']==='POST'){
    $producto = filter_input(INPUT_POST, 'producto', FILTER_SANITIZE_STRING); //$_POST['producto']
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING); //$_POST['descripcion'];
    $precio = filter_input(INPUT_POST, 'precio', FILTER_SANITIZE_STRING); //$_POST['precio'];
    $unidades = filter_input(INPUT_POST, 'unidades', FILTER_SANITIZE_STRING); //$_POST['unidades'];
    
    $sqlInsert = "INSERT INTO productos (producto, descripcion, precio, unidades) VALUES (?, ?, ?, ?)";

    $sentenciaInsert = $mbd->prepare($sqlInsert);
    $sentenciaInsert->execute(array($producto,$descripcion,$precio, $unidades));

    //Tenemos el producto creado en la tabla producto
    //Recoger el id de ese producto insertado
    $producto_last = $mbd->lastInsertId();
    
    //Inicar el proceso de procesar imágenes y guardarlas en el directorio
    //Indicar el nombre del directorio (la carpeta)
    $uploadDir='uploads/';

    //crear directorio si no exite
    if(!is_dir($uploadDir)){
        mkdir($uploadDir, 0777, true);
    }

    if(!isset($_FILES)){
        $errormessage = 'No hay imágenes para subir';
    }else {         
        //recoger de $_FILES cada una de las imágenes
        foreach($_FILES['imagen']['tmp_name'] as $key=>$tmp_name){
            $filename = basename($_FILES['imagen']['name'][$key]);
            $ruta = $uploadDir . $filename;
            $filenameSinExtension = pathinfo($filename, PATHINFO_FILENAME);

            //Mover la imagen a la ubicación del directorio
            if(move_uploaded_file($tmp_name, $ruta)){
                //Insertar cada imagen una a una en la tabla imágenes
                $sqlImagenes = "INSERT INTO imagenes (productos_id, ruta, alt) VALUES (?, ?, ?)";
                $sentenciaImagenes = $mbd->prepare($sqlImagenes);
                $sentenciaImagenes->execute(array($producto_last, $ruta, $filenameSinExtension));
            } 
        }
    }

   header('location:listadoproductos.php');

    //header('location:registroproducto.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">

    </form>
</body>
</html>
