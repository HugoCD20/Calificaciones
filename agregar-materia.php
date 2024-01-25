<?php
session_start();
if(!isset($_SESSION['id'])){
    header('location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
            <ul class="lista">
                <a href="index.php"><li>Inicio</li></a>            
                <a href="registro.php"><li>Registro</li></a>  
                <a href="Promedios.php"><li>Promedios</li></a>
                <a href="materias.php"><li>Materias</li></a>     
                <?php
                if(isset($_SESSION['id'])){
                    echo "<a href='Cerrar-sesion.php'><li>Cerrar sesion</li></a>";
                }else{
                    echo "<a href='login.php'><li>Login</li></a>";
                }
                ?>        
                        
            </ul>
        </header>
    <main>
        <div class="content-1">
            <h1>ASIGNAR MATERIAS</h1>
                  <?php
                    include('conexion.php');  
                    $matricula= $_SESSION['id_estudiante'];
                    if($matricula==null){
                        header("location:index.php");
                        exit();
                    }    
                      $sql="SELECT * FROM materias";
                      $consulta= $conexion->prepare($sql);
                      $consulta->execute();
                      echo "
                        <p> Matricula: $matricula</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>Materia:</th>
                                    <th>Calificacion:</th>
                                    <th></th>
                                </tr>
                            </thead>
                        <tbody>
                        ";
                      if ($consulta->rowCount() > 0) {
                        while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
                            echo"  
                                <tr>
                                <form action='asignar-materia.php' method='POST'>
                                <input type='hidden' name='id' value='$registro[id]'>
                                    <td><label for='materia'>$registro[nombre]:</label></td>
                                    <td> <input class='text-2' type='text' id='materia' name='materia' required></td>
                                    <td><button>Agregar</button></td>
                                </form>
                                </tr>
                                    ";
                            if(isset($_SESSION['error'])){
                                echo $_SESSION['error'];
                                $_SESSION['error']=null;
                            }
                            
                        }
                      }
                      
                  ?>
                  </tbody>
              </table>
        </div>
    </main>
    <footer>SEP</footer>
</body>
</html>