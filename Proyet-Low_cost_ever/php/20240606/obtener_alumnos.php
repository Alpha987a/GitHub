<?php 
include_once 'conexion.php';

try{
    //preparar la consulta para obtener los alumnos y cursos
    $sql = "SELECT alumnos.id, alumnos.nombre, alumnos.apellidos, cursos.id, cursos.curso FROM alumnos JOIN cursos ON alumnos.cursos_id = cursos.id";

    $snt = $mbd->prepare($sql);
    $snt->execute();

    $cursosAlumno = $snt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOexception $e){
    echo 'Error: ' . $e->getMessage();
    exit();
}

//devolver los datos como JSON
header('Content-Type: application/json');
echo json_encode($cursosAlumno);
?>