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
          <h1>PROMEDIO DE CALIFICACIONES DE ESTUDIANTES</h1>
            <table>
                <thead>
                  <tr>
                    <th>Nombre(s)</th>
                    <th>Apellido(s)</th>
                    <th>Matricula</th>
                    <th>Promedio</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                      $_SESSION['id_estudiante'] = null;
                      include('conexion.php');

                      $sql = "SELECT * FROM estudiantes";
                      $consulta = $conexion->prepare($sql);
                      $consulta->execute();

                      $estudiantes = array();

                      if ($consulta->rowCount() > 0) {
                          while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
                              $sql2 = "SELECT AVG(calificacion) as Promedio FROM calificacion WHERE id_estudiante=:id";
                              $consulta2 = $conexion->prepare($sql2);
                              $consulta2->bindParam(':id', $registro['id']);
                              $consulta2->execute();

                              if ($consulta2->rowCount() > 0) {
                                  while ($registro2 = $consulta2->fetch(PDO::FETCH_ASSOC)) {
                                      $Promedio = $registro2['Promedio'];
                                      $Promedio = number_format($Promedio, 2);

                                      // Almacena los datos en un array asociativo
                                      $estudiantes[] = array(
                                          'nombre' => $registro['nombre'],
                                          'apellidos' => $registro['apellidos'],
                                          'id' => $registro['id'],
                                          'promedio' => $Promedio,
                                      );
                                  }
                              }
                          }

                          // Ordena el array en función del campo 'promedio' de menor a mayor
                          usort($estudiantes, function ($a, $b) {
                              return strcmp($a['promedio'], $b['promedio']);
                          });

                          // Imprime los resultados ordenados
                          foreach ($estudiantes as $estudiante) {
                              echo "
                                  <tr>
                                      <td>{$estudiante['nombre']}</td>
                                      <td>{$estudiante['apellidos']}</td>
                                      <td>{$estudiante['id']}</td>
                                      <td>{$estudiante['promedio']}</td>
                                  </tr>
                              ";
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