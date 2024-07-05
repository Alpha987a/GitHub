<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Primer uso de php</h1>
    <?php
    // aqui va solo el código, no html
    $nombre = 'Ernesto';
    $edad = 50;
    $apellido = 'Domenech';



    // declaración y asignación de variabl en html
    echo $nombre;

    // cocatenación de html y php
    echo '<p>Mi nombre es: '.$nombre . '<p>';

    // interpolación de html y php: ojo ésto va con comillas dobles
    echo "<p>  Mi edad es: $edad </p>";

    ?>
<!-- 
       ------ Estoy fuera de php, aquí ya se puede escribir html  ------ -->
<p>Mi apellido es: <?php echo $apellido  ?></p>

<h2>Condicional  if - else</h2> 

<?php
// El bloque condicional "if" evalua el valor de una variable
// realiza una acción tras comparar el valor
$resultado = 6;

// Sintaxis de comparación: ==; ===; <=; >=; <; >; !=;
if($resultado >= 5){
    echo "<h3 style='color:green'>$nombre prueba superada </h3>";
    }else{
        echo "<h3 class='suspenso'>$nombre prueba no superada</h3>";
    }

?>

<h2>Condicional if - elseif - else</h2>

<?php

    // if - elseif - else permite hacer varias comparaciones
  $resultado = 'A';
   
  if($resultado == 'A'){
    echo "<h3 class='aprobado">$nobre prueba superada de forma fantástica</h3>";
    }else{
        echo "<h3 class='suspenso'>$nombre prueba no superada</h3>";
    }
    
    ?>

    <?php
    // es un bloque de comparación condicional, en el que se compara una variable hasta encontrar su coincidencia
    // Si no hay conincidencia dçse ejecuta el bloque default en cada bloque añadimos "break" que interrumpe la evaluación si hay coincidencia. 

    switch($resultado){
     case 'A':
        echo "<h3 class='aprobado'>$nombre has superado la prueba de forma fantástica</h3>";
        break;
    case 'B':
         echo "<h3 class='justito'>$nombre apruebas por los pelos</h3>";
         break;
    default:
         echo "<h3 class='suspenso'>$nombre lamentable, vas a recuperación</h3>";
        break;        
    }else{
        echo "<h3>$nombre, lo siento pero quedas expulsado</h3>";
    }


    ?>

<body>
    
</body>
</html>


