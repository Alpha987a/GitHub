<?php 
include_once 'conexion.php';
include 'menu.php';

//Seleccionar los cursos de la tabla cursos
try{
    $sql_listado_cursos = "SELECT id, curso FROM cursos ORDER BY curso";
    $snt_list_cursos = $mbd->prepare($sql_listado_cursos);
    $snt_list_cursos->execute();

    $list_cursos = $snt_list_cursos->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo 'Error: ' . $e->getMessage();
    exit();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
try {

    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
    $curso = filter_input(INPUT_POST, 'curso', FILTER_VALIDATE_INT); //$_POST['curso']

    //insertar valores del formulario en la tabla alumnos
    $sql_ins_alumno = "INSERT INTO alumnos (nombre, apellidos, cursos_id) VALUES (?,?,?)";

    $snt_ins_alumno = $mbd->prepare($sql_ins_alumno);
    $snt_ins_alumno->execute(array($nombre, $apellidos, $curso));

    header('location:index.php');
    exit;
}catch(PDOException $e){
    echo 'Error: ' . $e->getMessage();
    exit();
}
}
?>

<!-- HTML del formulario de registro -->

<div class="container col-md-6">
    <h2>Alta alumnos</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="form-group mb-3">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" type="text" name="nombre" id="alta-nombre">
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="apellidos">Apellidos</label>
            <input class="form-control" type="text" name="apellidos" id="alta-apellidos">
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="curso">Cursos</label>
            <select class="form-control" name="curso" id="alta-curso">
                <?php foreach($list_cursos as $curso): ?>
                <option value="<?php echo htmlspecialchars($curso['id']);?>"><?php echo htmlspecialchars($curso['curso']);?></option>
                <?php endforeach ?>
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Alta</button>
    </form>
</div>

<?php include 'footer.php' ?>