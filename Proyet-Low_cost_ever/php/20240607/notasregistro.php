<?php
    include_once 'conexion.php';
    include 'menu.php';

    try{
        //Obtener el listado de alumnos para el <select>
        $sql_list_alumnos = "SELECT id, nombre, apellidos FROM alumnos ORDER BY apellidos";
        $snt_list_alumnos = $mbd->prepare($sql_list_alumnos);
        $snt_list_alumnos->execute();
        $list_alumnos = $snt_list_alumnos->fetchAll(PDO::FETCH_ASSOC);

        //obtener el listado de cursos para el <select>

        $sql_list_cursos = "SELECT id, curso FROM cursos ORDER BY curso";
        $snt_list_cursos = $mbd->prepare($sql_list_cursos);
        $snt_list_cursos->execute();
        $list_cursos = $snt_list_cursos->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo 'Error: ' . $e->getMessage();
        exit();
    }

    if($_SERVER['REQUEST_METHOD']==='POST'){
        try{
        $alumno_id = filter_input(INPUT_POST, 'alumno', FILTER_VALIDATE_INT);
        $curso_id = filter_input(INPUT_POST, 'curso', FILTER_VALIDATE_INT);
        $nota = filter_input(INPUT_POST, 'nota', FILTER_SANITIZE_STRING);
        
        $sql_ins_notas ="INSERT INTO notas (alumnos_id, cursos_id, nota) VALUES (?,?,?)";

        $snt_ins_notas = $mbd->prepare($sql_ins_notas);
        $snt_ins_notas->execute(array($alumno_id, $curso_id, $nota));

        header('location:index.php');
        exit;
        }catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
            exit();
        }
    }
?>

<div class="container col-md-6">
    <h2>Registro de notas</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="form-group mb-3">
            <label class="form-label" for="alumno">Listado alumnos</label>
            <select class="form-control" name="alumno" id="select-alumno">
                <?php foreach ($list_alumnos as $alumno): ?>
                    <option value="<?php echo htmlspecialchars($alumno['id']) ?>" 
                        <?php echo htmlspecialchars($alumno['apellidos'] . " " . $alumno['nombre']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="curso">Listado cursos</label>
            <select class="form-control" name="curso" id="select-curso">
                <?php foreach ($list_cursos as $curso): ?>
                <option value="<?php echo htmlspecialchars($curso['id']); ?>">
                    <?php echo htmlspecialchars($curso['curso']);?>
                </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="nota">Nota</label>
            <input class="form-control" type="text" name="nota" id="registro-nota">
        </div>
        <button class="btn btn-primary" type="submit">Registrar nota</button>
    </form>
</div>

<?php include 'footer.php' ?>