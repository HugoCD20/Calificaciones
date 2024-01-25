<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        $matricula=$_POST['matricula'];
        

        include('conexion.php');
        $sql="INSERT INTO estudiantes (id,nombre,apellidos) values (:matricula,:nombre,:apellidos)";
        $consulta=$conexion->prepare($sql);
        $consulta->bindParam(':nombre',$nombre);
        $consulta->bindParam(':apellidos',$apellidos);
        $consulta->bindParam(':matricula',$matricula);
        $consulta->execute();

        header('location:index.php');
            
        

    }else{
        header('location:index.php');
        exit();
    }
?>