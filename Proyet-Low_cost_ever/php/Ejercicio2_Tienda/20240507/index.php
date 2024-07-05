<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Primer uso de Php</h1>

    <?php 
        //aquí va solo el código php, no html

        //declaración y asignación de variables siempre con $ delante
        $nombre = 'Ernesto';
        $edad = 50;
        $apellido = 'Domenech';

        //mostrar el valor de una varible en html
        echo $nombre;

        //concatenación de html y php
        echo '<p>Mi nombre es: ' . $nombre . '</p>';

        //interpolación de html y php: ojo ésto va con comillas dobles
        echo "<p>Mi edad es: $edad </p>";
    ?>
    <!--Estoy fuera de php, aquí ya se puede escribir html-->
    <p>Mi apellido es: <?php echo $apellido ?></p>

    <h2>Condicional if - else</h2>
    <?php
        //El bloque condicional "if" evalua el valor de una variable
        //Realiza una acción tras comparar el valor
        $resultado = 6;

        //Sintaxis de comparación: ==; ===; <=; >=; <; >; !=; !
        if($resultado >= 5){
            echo "<h3 class='aprobado'>$nombre prueba superada </h3>";
        }else{
            echo "<h3 class='suspenso'>$nombre prueba no superada</h3>";
        }
    ?>

    <h2>Condicional if - elseif - else</h2>

    <?php
        //if - elseif - else permite hacer varias comparaciones
        $resultado = 'A';

        if($resultado == 'A'){
            echo "<h3 class='aprobado'>$nombre prueba superada de forma fantástica</h3>";
        }elseif($resultado == 'B'){
            echo "<h3 class='justito'>$nombre prueba superada muy justito</h3>";
        }else{
            echo "<h3 class='suspenso'>$nombre muy mal, no has superado la prueba</h3>";
        }
    ?>
    <h2>Bloque condicional switch</h2>
    <?php
        //es un bloque de comparación condicional, en el que se compara
        //una variable hasta encontrar su coincidencia
        //Si no hay coincidencia se ejecuta el bloque default
        //en cada bloque añadimos "break" que interrumpe la evaluación
        //si hay coincidencia.
        switch($resultado)
        {
            case 'A':
                echo "<h3 class='aprobado'>$nombre has superado la prueba de forma fantástica</h3>";
                break;
            case 'B':
                echo "<h3 class='justito'>$nombre apruebas por los pelos</h3>";
                break;
            default:
                echo "<h3 class='suspenso'>$nombre prueba no superada</h3>";
                if($resultado == 'C'){
                    echo "<h3>$nombre tienes una última oportunidad en recuperación</h3>";
                }else{
                    echo "<h3>$nombre, lo siento pero quedas expulsado</h3>";
                }
                break;
        }
    ?>
</body>
</html>


<!-- 
Ejemplo de página web con PHP y estilos CSS, que hagan lo siguiente: venta de mas de 10 artículos, descuentos por compra de los artículos a=3,b=9 y c=5. Si en la compra hay 10 artículos entre a, b y c. el descuento será del 10%. Si en la compra hay de 5 a 9 artículos entre a, b y c, el descuento será de 5%. Si en la compra hay menos de 5 artículos entre a, b y c, no habrá descuento. Muestre la lista de la compra con el calculo del monto total a pagar y su descuento. -->