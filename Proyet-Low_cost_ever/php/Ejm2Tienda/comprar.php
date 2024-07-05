<?php
// comprar.php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cantidades = $_POST['cantidad'];
    $total = 0;
    $descuento_ids = [1, 2, 3]; // IDs de productos con descuento

    // Crear cliente temporal para la compra
    $stmt = $pdo->prepare('INSERT INTO clientes (nombre, email, telefono) VALUES (?, ?, ?)');
    $stmt->execute(['Cliente Temporal', 'temp@tienda.com', '123456789']);
    $cliente_id = $pdo->lastInsertId();

    // Registrar compra
    $stmt = $pdo->prepare('INSERT INTO compras (cliente_id, total) VALUES (?, ?)');
    $stmt->execute([$cliente_id, $total]);
    $compra_id = $pdo->lastInsertId();

    foreach ($cantidades as $producto_id => $cantidad) {
        if ($cantidad > 0) {
            $stmt = $pdo->prepare('SELECT * FROM productos WHERE id = ?');
            $stmt->execute([$producto_id]);
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);

            $precio = $producto['precio'];
            if (in_array($producto_id, $descuento_ids)) {
                if ($cantidad >= 5 && $cantidad <= 9) {
                    $precio *= 0.95;
                } elseif ($cantidad > 9) {
                    $precio *= 0.90;
                }
            }

            $subtotal = $precio * $cantidad;
            $total += $subtotal;

            // Registrar detalles de la compra
            $stmt = $pdo->prepare('INSERT INTO detalles_compras (compra_id, producto_id, cantidad, precio) VALUES (?, ?, ?, ?)');
            $stmt->execute([$compra_id, $producto_id, $cantidad, $precio]);

            // Actualizar stock
            $stmt = $pdo->prepare('UPDATE productos SET unidades = unidades - ? WHERE id = ?');
            $stmt->execute([$cantidad, $producto_id]);
        }
    }

    // Actualizar total de la compra
    $stmt = $pdo->prepare('UPDATE compras SET total = ? WHERE id = ?');
    $stmt->execute([$total, $compra_id]);

    header('Location: ticket.php?compra_id=' . $compra_id);
    exit;
}
?>
