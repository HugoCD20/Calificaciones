<?php  session_start(); ?>
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
          <h1>Estudiantes</h1>
            <table>
                <thead>
                  <tr>
                    <th>Nombre(s)</th>
                    <th>Apellido(s)</th>
                    <th>Matricula</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $_SESSION['id_estudiante']=null;
                    include('conexion.php');                
                      $sql="SELECT * FROM estudiantes";
                      $consulta= $conexion->prepare($sql);
                      $consulta->execute();
                      if ($consulta->rowCount() > 0) {
                        while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
                            echo "
                                  <form action='ver-calificacion.php' method='POST' >
                                  <input type='hidden' name='nombre' value='$registro[nombre]'>
                                  <input type='hidden' name='apellido' value='$registro[apellidos]'>
                                  <input type='hidden' name='matricula' value='$registro[id]'>
                                    <tr>
                                      <td>$registro[nombre]</td>
                                      <td>$registro[apellidos]</td>
                                      <td>$registro[id]</td>
                                      <td><button name='accion' value='ver'>Ver</button><button class='boton-1' name='accion' value='agregar'>Agregar</button></td>
                                    </tr>
                                  </form>
                            
                            ";
                        }
                      }else{
                        echo "
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                            
                            ";
                      }
                  ?>
                </tbody>
              </table>
        </div>
    </main>
    <footer>SEP</footer>
</body>
</html>