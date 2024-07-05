<?php include 'menu.php'?>

<div class="container">
    <h1>Pagina inicio</h1>
    <?php if(isset($_SESSION['user'])): ?>
        <p>Bienveni@: <?php echo htmlspecialchars($_SESSION['user']);?></p>
        <p>Rol: <?php echo $_SESSION['rol'];?></p>
        <?php endif ?>

</div>

<?php include 'footer.php'?>