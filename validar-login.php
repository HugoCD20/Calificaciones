<?php
session_start();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre=$_POST['nombre'];
        $contraseña=$_POST['contrasena'];

        include('conexion.php');
        $sql="SELECT * FROM profesor where nombre=:nombre and contraseña=:contrasena";
        $consulta=$conexion->prepare($sql);
        $consulta->bindParam(':nombre',$nombre);
        $consulta->bindParam(':contrasena',$contraseña);
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['id']=$registro['id'];
                header('location:index.php');
                exit();
            }
        }else{
            header('location:index.php');
            exit();
        }
    }else{
        header('location:index.php');
        exit();
    }
?>