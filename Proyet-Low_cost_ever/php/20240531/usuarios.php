<?php 
    include 'menu.php';

    //si el usuario no está autentificado, no podrá entrar
    //esta página y se envía a la página de login
    if(!isset($_SESSION['user']) || $_SESSION['rol'] !== 1){
        header('location:login.php');
        exit;
    }
?>

<div class="container">
    <h1>Listado usuarios</h1>
</div>

<?php include 'footer.php' ?>