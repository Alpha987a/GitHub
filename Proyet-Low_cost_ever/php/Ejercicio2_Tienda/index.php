
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Tienda_de_ropa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Tienda de ropa</h1>
    <form action="index.php" method="post">
        <h2>Seleccione los artículos a comprar:</h2>
        <label for="article_a">camiseta (Precio: 3€):</label>
        <input type="number" id="article_a" name="article_a" min="0" value="0">
        
        <label for="article_b">bañador (Precio: 9€):</label>
        <input type="number" id="article_b" name="article_b" min="0" value="0">
        
        <label for="article_c">toalla (Precio: 5€):</label>
        <input type="number" id="article_c" name="article_c" min="0" value="0">

        <label for="article_4">zapatilla (Precio: 30€):</label>
        <input type="number" id="article_d" name="article_d" min="0" value="0">

        <label for="article_5">sandalia (Precio: 10€):</label>
        <input type="number" id="article_e" name="article_e" min="0" value="0">

        <label for="article_6">gorra (Precio: 5€):</label>
        <input type="number" id="article_f" name="article_f" min="0" value="0">

        <label for="article_7">pantalon largo (Precio: 12€):</label>
        <input type="number" id="article_g" name="article_g" min="0" value="0">

        <label for="article_8">pantalon corto (Precio: 10€):</label>
        <input type="number" id="article_h" name="article_h" min="0" value="0">

        <label for="article_9">sombrero (Precio: 5€):</label>
        <input type="number" id="article_i" name="article_i" min="0" value="0">
        
        <input type="submit" value="Calcular Total">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $article_a_count = intval($_POST['article_a']);
        $article_b_count = intval($_POST['article_b']);
        $article_c_count = intval($_POST['article_c']);
        $article_d_count = intval($_POST['article_d']);
        $article_e_count = intval($_POST['article_e']);
        $article_f_count = intval($_POST['article_f']);
        $article_g_count = intval($_POST['article_g']);
        $article_h_count = intval($_POST['article_h']);
        $article_i_count = intval($_POST['article_i']);
       
        // Precios unitarios
        $price_a = 3;
        $price_b = 9;
        $price_c = 5;
        $price_d = 30;
        $price_e = 10;
        $price_f = 5;
        $price_g = 12;
        $price_h = 10;
        $price_i = 5;

        // Calcular el total de cada artículo
        $total_articles_discount = $article_a_count + $article_b_count + $article_c_count;
        $total_articles = $article_a_count + $article_b_count + $article_c_count + $article_d_count + $article_e_count+ $article_f_count + $article_g_count+ $article_h_count + $article_i_count;
        $total_cost = ($article_a_count * $price_a) + ($article_b_count * $price_b) + ($article_c_count * $price_c)+ ($article_d_count * $price_d) + ($article_e_count * $price_e)+ ($article_f_count * $price_f) + ($article_g_count * $price_g)+ ($article_h_count * $price_h) + ($article_i_count * $price_i);

        // Calcular el descuento
        $discount = 0;
        if ($total_articles_discount >= 10) {
            $discount = 0.10; // 10% de descuento
        } elseif ($total_articles_discount >= 5) {
            $discount = 0.05; // 5% de descuento
        }

        // Calcular el monto total con descuento
        $discount_amount = $total_cost * $discount;
        $final_total = $total_cost - $discount_amount;

        echo "<h2>Resumen de la Compra:</h2>";
        echo "<p>camiseta: $article_a_count</p>";
        echo "<p>bañador: $article_b_count</p>";
        echo "<p>toalla: $article_c_count</p>";
        echo "<p>zapatilla: $article_d_count</p>";
        echo "<p>sandalia: $article_e_count</p>";
        echo "<p>gorra: $article_f_count</p>";
        echo "<p>pantalon largo: $article_g_count</p>";
        echo "<p>pantalon corto: $article_h_count</p>";
        echo "<p>sombrero: $article_i_count</p>";
        echo "<p>Total de artículos: $total_articles</p>";
        echo "<p>Total a pagar (sin descuento): €$total_cost</p>";
        echo "<p>Descuento aplicado: " . ($discount * 100) . "%</p>";
        echo "<p>Monto del descuento: €$discount_amount</p>";
        echo "<p>Total a pagar (con descuento): €$final_total</p>";
    }
    ?>
</body>
</html>






