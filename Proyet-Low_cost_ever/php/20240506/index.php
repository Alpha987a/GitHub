<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Introducción a PHP</h1>
    <!-- bloque de código PHP -->
    <?php
    $saludo = "Hola";
    $a = 2;
    $b = 2;
    $suma = $a + $b;
    $resta = $a - $b;
    $multiplicacion = $a * $b;
    $division = $a / $b;
    $modulo = $a / $b;
    
    //Imprimir en el html
    echo $saludo . "<br>";
    echo $suma;
    
    //Otra forma de imprimir en pantalla
    echo "<p>" . $saludo . "</p>";
    echo "<p>" . $suma . "</p>";
   //Otra forma de imprimir en pantalla con Interpolación de variables
    echo "<p> $saludo </p>";
    echo "<p> $Resultado suma: $suma </p>";
    echo "<p> $Resultado resta: $resta </p>";
    echo "<p> $Resultado multiplicacion: $multiplicacion </p>";
    echo "<p> $Resultado division: $division </p>";
    echo "<p> $Resultado modulo: $modulo </p>";
    ?>
    <!-- Estoy en HTML fuera de PHP -->
    <p><?php echo $saludo ?></p>"
    <p><?php echo $suma ?></p>



</body>
</html>