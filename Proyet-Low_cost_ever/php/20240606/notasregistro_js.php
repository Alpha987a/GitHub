<?php
    include_once 'conexion.php';
    include 'menu.php';

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
                
            </select>
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="curso">Listado cursos</label>
            <select class="form-control" name="curso" id="select-curso">
                
            </select>
        </div>
        <div class="form-group mb-3">
            <label class="form-label" for="nota">Nota</label>
            <input class="form-control" type="text" name="nota" id="registro-nota">
        </div>
        <button class="btn btn-primary" type="submit">Registrar nota</button>
    </form>
</div>

<script>
    const alumnoSelect = document.getElementById('select-alumno');
    const cursoSelect = document.getElementById('select-curso');

    document.addEventListener('DOMContentLoaded',function(){
        fetch('obtener_alumnos.php')
        .then(response=>response.json())
        .then(data=>{
            data.forEach(alumno=>{
                const option = document.createElement('option');
                option.value = alumno.id;
                option.textContent = alumno.apellidos;
                alumnoSelect.appendChild(option);
            });
        }).catch(error =>console.log('Error en alumnos data: ', error));
    });

</script>

<?php include 'footer.php' ?>