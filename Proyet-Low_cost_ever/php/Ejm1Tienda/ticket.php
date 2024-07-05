<!-- Mostrar el Ticket -->

<?php
// ticket.php
include 'db.php';

$compra_id = $_GET['compra_id'];

$stmt = $pdo->prepare('SELECT * FROM compras WHERE id = ?');
$stmt->execute([$compra_id]);
$compra = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT dc.*, p.nombre FROM detalles_compras dc JOIN productos p ON dc.producto_id = p.id WHERE dc.compra_id = ?');
$stmt->execute([$compra_id]);
$detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Compra</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ticket de Compra</h1>
    <p>ID de Compra: <?php echo $compra['id']; ?></p>
    <p>Fecha: <?php echo $compra['fecha']; ?></p>
    <p>Total: $<?php echo $compra['total']; ?></p>
    <h2>Detalles</h2>
    <ul>
        <?php foreach ($detalles as $detalle): ?>
            <li><?php echo $detalle['nombre']; ?> - Cantidad: <?php echo $detalle['cantidad']; ?> - Precio Unitario: $<?php echo $detalle['precio']; ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php">Volver a la tienda</a>
</body>
</html>
