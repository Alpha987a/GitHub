<?php
include 'db.php';

// Obtener historial de compras
$stmt = $conn->prepare("
    SELECT t.id AS ticket_id, t.fecha, td.producto_id, p.nombre, td.cantidad, td.total, p.stock
    FROM tickets t
    JOIN ticket_detalles td ON t.id = td.ticket_id
    JOIN productos p ON td.producto_id = p.id
    ORDER BY t.fecha DESC
");
$stmt->execute();
$historial = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Reporte de Compras</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Reporte de Compras</h1>
    <?php if (count($historial) > 0): ?>
        <table>
            <tr>
                <th>Ticket ID</th>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Stock Restante</th>
            </tr>
            <?php foreach ($historial as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['ticket_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                    <td><?php echo htmlspecialchars($row['total']); ?></td>
                    <td><?php echo htmlspecialchars($row['stock']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay compras registradas.</p>
    <?php endif; ?>
    <button onclick="location.href='index.php'">Volver</button>
</body>
</html>
