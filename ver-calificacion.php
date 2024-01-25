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
    </header>
    <main>
        <div class="content-1">
                  <?php
                  session_start();
                    include('conexion.php');    

                      $nombre=$_POST['nombre'];    
                      if($nombre==null){
                        header("location:index.php");
                        exit();
                    }     
                      $apellidos=$_POST['apellido'];       
                      $matricula=$_POST['matricula'];
                       $_SESSION['id_estudiante']=$matricula;
                      if($_POST['accion']=='agregar'){
                            header('location:agregar-materia.php');
                            exit();
                      }
                      $sql="SELECT * FROM calificacion where id_estudiante =:id";
                      $consulta= $conexion->prepare($sql);
                      $consulta->bindParam(':id',$matricula);
                      $consulta->execute();
                      echo "
                        <h1> $nombre  $apellidos</h1>
                        <p> Matricula: $matricula</p>
                        <table>
                            <thead>
                                <tr>
                                    <th>Materia:</th>
                                    <th>Calificacion:</th>
                                </tr>
                            </thead>
                        <tbody>";
                      if ($consulta->rowCount() > 0) {
                        while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
                            $sql2="SELECT * FROM materias where id =:id";
                            $consulta2= $conexion->prepare($sql2);
                            $consulta2->bindParam(':id',$registro['id_materia']);
                            $consulta2->execute();
                            if ($consulta2->rowCount() > 0) {
                                while ($registro2 = $consulta2->fetch(PDO::FETCH_ASSOC)) {
                                    echo"
                                        <tr>
                                            <td>$registro2[nombre]</td>
                                            <td>$registro[calificacion]</td>
                                        </tr>
                                    ";
                                }
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