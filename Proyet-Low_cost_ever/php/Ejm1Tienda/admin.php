<!-- Página de Administración -->

<?php
// admin.php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['incrementar'])) {
    $id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    $stmt = $pdo->prepare('UPDATE productos SET unidades = unidades + ? WHERE id = ?');
    $stmt->execute([$cantidad, $id]);

    header('Location: admin.php');
    exit;
}

$productos = $pdo->query('SELECT * FROM productos')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Administración de Productos</h1>
    <form action="admin.php" method="post">
        <table>
            <tr>
                <th>Producto</th>
                <th>Unidades Disponibles</th>
                <th>Incrementar</th>
            </tr>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($producto['unidades']); ?></td>
                    <td>
                        <input type="number" name="cantidad" min="1" value="0">
                        <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
                        <input type="submit" name="incrementar" value="Incrementar">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </form>
</body>
</html>
