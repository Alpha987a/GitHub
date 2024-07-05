
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Ejercicio3_TiendaReporte</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Tienda en línea</h1>

    <?php
    // Mantener los productos y el historial de compras en una variable de sesión para persistencia entre solicitudes
    session_start();

    // Inicializar productos si no están definidos
    if (!isset($_SESSION['productos'])) {
        $_SESSION['productos'] = [
            ["id" => 1, "nombre" => "Producto A", "precio" => 10, "almacenes" => [20, 15]],
            ["id" => 2, "nombre" => "Producto B", "precio" => 15, "almacenes" => [10, 5]],
            ["id" => 3, "nombre" => "Producto C", "precio" => 20, "almacenes" => [0, 2]],
        ];
    }

    // Inicializar historial de compras
    if (!isset($_SESSION['historial_compras'])) {
        $_SESSION['historial_compras'] = [];
    }

    $productos = $_SESSION['productos'];
    $historial_compras = $_SESSION['historial_compras'];

    // Verificar si se realizó una compra
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $compras = $_POST['compras'];
        $total_compra = 0;
        $compra_detalle = [];

        foreach ($compras as $producto_id => $cantidad) {
            if ($cantidad > 0) {
                // Buscar el producto en la lista de productos
                foreach ($productos as &$producto) {
                    if ($producto["id"] == $producto_id) {
                        // Calcular el costo del producto por la cantidad comprada
                        $subtotal = $producto["precio"] * $cantidad;
                        $total_compra += $subtotal;

                        // Reducir la disponibilidad de los almacenes
                        for ($i = 0; $i < count($producto["almacenes"]); $i++) {
                            if ($producto["almacenes"][$i] >= $cantidad) {
                                $producto["almacenes"][$i] -= $cantidad;
                                break;
                            }
                        }

                        // Guardar detalles de la compra
                        $compra_detalle[] = [
                            "nombre" => $producto["nombre"],
                            "cantidad" => $cantidad,
                            "subtotal" => $subtotal,
                        ];

                        break;
                    }
                }
            }
        }

        // Agregar la compra al historial de compras
        $historial_compras[] = [
            "compra_detalle" => $compra_detalle,
            "total_compra" => $total_compra,
        ];

        // Guardar productos y historial en la sesión para persistencia
        $_SESSION['productos'] = $productos;
        $_SESSION['historial_compras'] = $historial_compras;

        echo '<div class="report">';
        echo '<h2>Reporte de la Compra</h2>';
        echo '<p>Total de la compra: $' . number_format($total_compra, 2) . '</p>';
        echo '<table>';
        echo '<tr><th>Producto</th><th>Cantidad</th><th>Subtotal</th></tr>';

        foreach ($compra_detalle as $detalle) {
            echo '<tr>';
            echo '<td>' . $detalle["nombre"] . '</td>';
            echo '<td>' . $detalle["cantidad"] . '</td>';
            echo '<td>$' . number_format($detalle["subtotal"], 2) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';
    }
    ?>

    <!-- Formulario para hacer compras -->
    <form action="" method="post">
        <h2>Lista de productos</h2>
        <table>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Disponibilidad</th>
            </tr>
            <?php
            foreach ($productos as $producto) {
                $total_disponibilidad = array_sum($producto["almacenes"]);
                echo '<tr>';
                echo '<td>' . $producto["nombre"] . '</td>';
                echo '<td>$' . number_format($producto["precio"], 2) . '</td>';
                echo '<td><input type="number" name="compras[' . $producto["id"] . ']" min="0" value="0"></td>';
                echo '<td>' . $total_disponibilidad . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
        <input type="submit" class="btn" value="Comprar">
    </form>

    <!-- Historial de compras -->
    <?php
    if (!empty($historial_compras)) {
        echo '<div class="report">';
        echo '<h2>Historial de Compras</h2>';
        echo '<table>';
        echo '<tr><th>Compra #</th><th>Total Compra</th></tr>';

        foreach ($historial_compras as $index => $compra) {
            echo '<tr>';
            echo '<td>' . ($index + 1) . '</td>';
            echo '<td>$' . number_format($compra["total_compra"], 2) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';
    }
    ?>

    <!-- Informe general -->
    <?php
    if (!empty($historial_compras)) {
        echo '<div class="report">';
        echo '<h2>Informe General</h2>';

        // Calcular cantidad total de productos vendidos por producto
        $productos_vendidos = [];

        foreach ($historial_compras as $compra) {
            foreach ($compra["compra_detalle"] as $detalle) {
                $nombre = $detalle["nombre"];
                $cantidad = $detalle["cantidad"];

                if (!isset($productos_vendidos[$nombre])) {
                    $productos_vendidos[$nombre] = 0;
                }

                $productos_vendidos[$nombre] += $cantidad;
            }
        }

        echo '<table>';
        echo '<tr><th>Producto</th><th>Cantidad Vendida</th><th>Disponibilidad Total</th></tr>';

        foreach ($productos as $producto) {
            $nombre = $producto["nombre"];
            $total_disponibilidad = array_sum($producto["almacenes"]);
            $cantidad_vendida = isset($productos_vendidos[$nombre]) ? $productos_vendidos[$nombre] : 0;

            echo '<tr>';
            echo '<td>' . $nombre . '</td>';
            echo '<td>' . $cantidad_vendida . '</td>';
            echo '<td>' . $total_disponibilidad . '</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '</div>';
    }
    ?>

</body>
</html>




<!-- ```
Este código realiza los siguientes cambios:

- Usa variables de sesión (`$_SESSION`) para almacenar el estado de los productos y el historial de compras. Esto garantiza la persistencia de datos entre solicitudes.
- Al realizar una compra, se actualiza la disponibilidad de productos en el almacén, reduciendo la cantidad según lo que el usuario compra.
- Muestra el historial de compras con el total de cada compra y el detalle de productos comprados.
- Proporciona un informe general con la cantidad total de productos vendidos por producto y la disponibilidad actual.

Recuerda que este código es un ejemplo simplificado para ilustrar la lógica de compra y actualización de productos en un almacén. Para un sistema de producción real, se necesitaría un manejo más robusto de la persistencia de datos, autenticación y autorización, validación de entrada, y medidas de seguridad adecuadas. -->