<?php 
    include_once 'conexion.php';
    include 'menu.php';

    try{
        $sql = "SELECT alumnos.nombre, alumnos.apellidos, cursos.curso, AVG(notas.nota) AS media_notas FROM alumnos JOIN notas ON alumnos.id = notas.alumnos_id JOIN cursos ON alumnos.cursos_id = cursos.id GROUP BY alumnos.id  ORDER BY alumnos.apellidos";

        $snt = $mbd->prepare($sql);
        $snt->execute();
        $notaMedia = $snt->fetchAll(PDO::FETCH_ASSOC);

    }catch (PDOexception $e){
        echo 'Error: ' . $e->getMessage();
        exit();
    }
?>

<div class="container col-md-12 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h2>Nota media curso por alumno</h2>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Apellidos</th>
                        <th>Nombre</th>
                        <th>Curso</th>
                        <th>Nota media</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($notaMedia as $nota):?>
                    <tr>
                        <td><?php echo $nota['apellidos']?></td>
                        <td><?php echo $nota['nombre'] ?></td>
                        <td><?php echo $nota['curso']?></td>
                        <td><?php echo $nota['media_notas']?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'?>