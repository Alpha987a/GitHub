<?php
include 'db.php';

// Obtener productos
$stmt = $conn->prepare("SELECT * FROM productos");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Realizar una compra
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
    $purchases = $_POST['quantity'];
    $totalCost = 0;
    $ticket = [];
    $discounts = [
        'Camiseta' => 3, // 5% de descuento si se compran entre 5 y 9
        'Toalla' => 9,
        'Bañador' => 5,
    ];

    $conn->beginTransaction();

    try {
        // Insertar un nuevo ticket
        $conn->exec("INSERT INTO tickets () VALUES ()");
        $ticketId = $conn->lastInsertId();

        foreach ($products as &$product) {
            $productId = $product['id'];
            $quantity = intval($purchases[$productId]);

            if ($quantity > 0 && $product['stock'] >= $quantity) {
                $productName = $product['nombre'];
                $price = $product['precio'];
                $discount = 0;

                // Aplicar descuentos
                if (isset($discounts[$productName])) {
                    if ($quantity >= 5 && $quantity < 10) {
                        $discount = 0.05;
                    } elseif ($quantity >= 10) {
                        $discount = 0.10;
                    }
                }

                $cost = $price * $quantity * (1 - $discount);
                $totalCost += $cost;
                $product['stock'] -= $quantity;

                // Insertar detalles del ticket
                $stmt = $conn->prepare("INSERT INTO ticket_detalles (ticket_id, producto_id, cantidad, total) VALUES (?, ?, ?, ?)");
                $stmt->execute([$ticketId, $productId, $quantity, $cost]);

                $ticket[] = [
                    'product' => $productName,
                    'quantity' => $quantity,
                    'cost' => $cost,
                    'discount' => $discount * 100,
                ];

                // Actualizar stock del producto
                $stmt = $conn->prepare("UPDATE productos SET stock = ? WHERE id = ?");
                $stmt->execute([$product['stock'], $productId]);
            }
        }

        $conn->commit();

        $_SESSION['message'] = "Compra realizada con éxito. Ticket ID: $ticketId";
        $_SESSION['ticket'] = $ticket;
        $_SESSION['totalCost'] = $totalCost;

    } catch (Exception $e) {
        $conn->rollBack();
        $_SESSION['message'] = "Error al realizar la compra: " . $e->getMessage();
    }

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Lista de Productos</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Lista de Productos</h1>

   


    <?php if (isset($_SESSION['message'])): ?>
        <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>

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
                    <td><?php echo htmlspecialchars($product['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($product['precio']); ?></td>
                    <td><?php echo htmlspecialchars($product['stock']); ?></td>
                    <td>
                        <?php if ($product['stock'] > 0): ?>
                            <input type="number" name="quantity[<?php echo $product['id']; ?>]" min="0" max="<?php echo $product['stock']; ?>" value="0">
                        <?php else: ?>
                            <span>Agotado</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <input type="submit" name="buy" value="Comprar">
    </form>

    <?php if (isset($_SESSION['ticket'])): ?>
        <h2>Detalle del Ticket</h2>
        <ul>
            <?php foreach ($_SESSION['ticket'] as $item): ?>
                <li>
                    <?php echo "{$item['quantity']} x {$item['product']} - $".number_format($item['cost'], 2)." (Descuento: {$item['discount']}%)"; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <p>Total a pagar: €<?php echo number_format($_SESSION['totalCost'], 2); ?></p>
    <?php endif; ?>

    <h2>Historial de Compras</h2>
    <button onclick="location.href='reporte.php'">Generar Reporte</button>
</body>
</html>
