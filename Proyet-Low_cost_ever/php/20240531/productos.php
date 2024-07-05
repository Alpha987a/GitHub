<?php 
    include_once 'conexion.php';
    include 'menu.php';
    if(!isset($_SESSION['user'])){
        header('location:login.php');
        exit;
    }

?>

<div class="container">
<h2>Productos</h2>
</div>

<?php include 'footer.php'?>