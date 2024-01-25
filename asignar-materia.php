<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    $materia=$_POST['materia'];
    $id=$_POST['id'];
    $matricula= $_SESSION['id_estudiante'];
    include('conexion.php');

    $sql2="SELECT * FROM calificacion where id_estudiante=:matricula and id_materia=:id";
    $consulta2=$conexion->prepare($sql2);
    $consulta2->bindParam(':matricula',$matricula);
    $consulta2->bindParam(':id',$id);
    $consulta2->execute();
    if ($consulta2->rowCount() > 0) {
        while ($registro2 = $consulta2->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['error']="<p class='error'>Ya hay una calificacion asignada a esta materia</p>";
        }
    }else{
        $sql="INSERT INTO calificacion (id_estudiante,id_materia,calificacion) values (:matricula,:id,:materia)";
            $consulta=$conexion->prepare($sql);
            $consulta->bindParam(':matricula',$matricula);
            $consulta->bindParam(':id',$id);
            $consulta->bindParam(':materia',$materia);
            $consulta->execute();
    }
    header('location:agregar-materia.php');
}else{
    header('location:index.php');
}

?>