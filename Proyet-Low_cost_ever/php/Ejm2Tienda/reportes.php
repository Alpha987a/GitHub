<?php
// reportes.php
include 'db.php';

$compras = $pdo->query('SELECT * FROM compras')->fetchAll(PDO::FETCH_ASSOC);
$clientes = $pdo->query('SELECT * FROM clientes')->fetchAll(PDO::FETCH_ASSOC);
$productos = $pdo->query('SELECT * FROM productos')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Reportes</h1>
    <h2>Historial de Compras</h2>
    <ul>
        <?php foreach ($compras as $compra): ?>
            <li>
                Compra ID: <?php echo $compra['id']; ?> - Total: $<?php echo $compra['total']; ?> - Fecha: <?php echo $compra['fecha']; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Clientes</h2>
    <ul>
        <?php foreach ($clientes as $cliente): ?>
            <li>
                Nombre: <?php echo $cliente['nombre']; ?> - Email: <?php echo $cliente['email']; ?> - Teléfono: <?php echo $cliente['telefono']; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Productos</h2>
    <ul>
        <?php foreach ($productos as $producto): ?>
            <li>
                Nombre: <?php echo $producto['nombre']; ?> - Descripción: <?php echo $producto['descripcion']; ?> - Precio: $<?php echo $producto['precio']; ?> - Unidades Disponibles: <?php echo $producto['unidades']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
