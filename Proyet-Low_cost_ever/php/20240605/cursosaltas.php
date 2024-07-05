<?php 
    include_once 'conexion.php';
    include 'menu.php';

    if($_SERVER['REQUEST_METHOD']==='POST'){
        try{
            $curso = filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_STRING);
            $sql_ins_curso = "INSERT INTO cursos (curso) VALUES (?)";

            $snt_ins_curso = $mbd->prepare($sql_ins_curso);
            $snt_ins_curso->execute(array($curso));

            header('location:index.php');
            exit;
        }catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
            exit();
        }
    }
?>

<div class="container col-md-6">
    <h2>Alta cursos</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="form-group mb-3">
            <label class="form-label" for="curso">Nombre curso</label>
            <input class="form-control" type="text" name="curso" id="alta-curso">
        </div>
        <button class="btn btn-primary" type="submit">Alta</button>
    </form>
</div>

<?php include 'footer.php' ?>