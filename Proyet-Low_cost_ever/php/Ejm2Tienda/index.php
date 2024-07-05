<?php
// index.php
include 'db.php';

$productos = $pdo->query('SELECT * FROM productos')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo de la Tienda" class="logo">
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="reportes.php">Reportes</a></li>
                <li><a href="admin.php">Administración</a></li>
            </ul>
        </nav>
    </header>

    <h1>Productos Disponibles</h1>
    <form action="comprar.php" method="post">
        <table>
            <tr>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Unidades Disponibles</th>
                <th>Cantidad</th>
            </tr>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                    <td><?php echo htmlspecialchars($producto['unidades']); ?></td>
                    <td>
                        <input type="number" name="cantidad[<?php echo $producto['id']; ?>]" min="0" max="<?php echo $producto['unidades']; ?>" value="0">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <input type="submit" value="Comprar">
    </form>
</body>
</html>










<!-- 
Alogo.png en el mismo directorio que tus archivos PHP.

Este ejemplo proporciona una estructura básica para un sitio web con PHP, CSS y SQL que incluye la gestión de productos, la realización de compras, la administración de stock y la generación de reportes. Para una implementación completa, deberías considerar aspectos adicionales como la autenticación de usuarios, validaciones más robustas, y una interfaz de usuario más amigable. -->