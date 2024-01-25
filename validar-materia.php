<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre=$_POST['nombre'];
        
        include('conexion.php');
        $sql="INSERT INTO materias (nombre) values (:nombre)";
        $consulta=$conexion->prepare($sql);
        $consulta->bindParam(':nombre',$nombre);
        $consulta->execute();
        header('location:index.php');
            
        

    }else{
        header('location:index.php');
        exit();
    }
?>