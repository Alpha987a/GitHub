<!-- Aquí tienes un ejemplo de una sola página con PHP y CSS que muestra una lista de productos a la venta, permite realizar pedidos y emitir tickets de compra, y muestra un historial de compras. Esta página también lleva un registro de la disponibilidad de cada producto en el almacén y muestra un informe detallado de las compras hechas y la cantidad de productos vendidos. El código es una representación simplificada para fines de demostración.

```php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lista de Productos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Lista de Productos</h1>

    
<?php
// Simulando una base de datos de productos
$products = [
    ['id' => 1, 'name' => 'Producto A', 'price' => 10.0, 'stock' => 10],
    ['id' => 2, 'name' => 'Producto B', 'price' => 20.0, 'stock' => 5],
    ['id' => 3, 'name' => 'Producto C', 'price' => 30.0, 'stock' => 2],
];

// Historial de compras (inicialmente vacío)
$tickets = [];

session_start();

// Cargar historial de compras desde la sesión (para persistencia temporal)
if (isset($_SESSION['tickets'])) {
    $tickets = $_SESSION['tickets'];
}

// Realizar una compra
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
    $purchases = $_POST['quantity'];
    $totalCost = 0;
    $ticket = [];

    foreach ($products as &$product) {
        $productId = $product['id'];
        $quantity = intval($purchases[$productId]);

        if ($quantity > 0 && $product['stock'] >= $quantity) {
            $cost = $product['price'] * $quantity;
            $totalCost += $cost;
            $product['stock'] -= $quantity;

            $ticket[] = [
                'product' => $product['name'],
                'quantity' => $quantity,
                'cost' => $cost,
            ];
        }
    }

    if (count($ticket) > 0) {
        $tickets[] = ['items' => $ticket, 'total' => $totalCost];
        $_SESSION['tickets'] = $tickets; // Actualizar sesión
    }
}
?>

    <form action="" method="post">
        <table>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad Disponible</th>
                <th>Cantidad a Comprar</th>
            </tr>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['stock']; ?></td>
                    <td>
                        <input type="number" name="quantity[<?php echo $product['id']; ?>]" min="0" max="<?php echo $product['stock']; ?>" value="0">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <input type="submit" name="buy" value="Comprar">
    </form>

    <?php if (count($tickets) > 0): ?>
        <h2>Historial de Compras</h2>
        <ul>
            <?php foreach ($tickets as $index => $ticket): ?>
                <li>
                    Ticket #<?php echo $index + 1; ?> - Total: $<?php echo $ticket['total']; ?>
                    <ul>
                        <?php foreach ($ticket['items'] as $item): ?>
                            <li><?php echo "{$item['quantity']} x {$item['product']} - $".$item['cost']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>


<!-- ```

```css
/* style.css */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
}

h1, h2 {
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #ccc;
}

th, td {
    padding: 10px;
    text-align: left;
}

input[type="number"] {
    width: 50px;
    padding: 5px;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #555;
}
```

Este ejemplo simula una lista de productos con un sistema de compra, permitiendo emitir tickets y mantener un historial de compras en una sola página con PHP y CSS. Los tickets se almacenan en la sesión para demostrar la persistencia temporal de datos. Cada ticket contiene detalles sobre los productos comprados y su costo total. Se realiza un seguimiento del stock de cada producto y se restringe la compra si no hay suficiente disponibilidad. -->