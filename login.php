<?php
session_start();
if(isset($_SESSION['id'])){
    header('location:index.php');
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
  <style>
    label {
      display: block;
      margin-top: 10px;
    }
  </style>
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
      <h2>INICIAR SESION</h2>
      <form class="form-1" action="validar-login.php" method="post">
          <label for="nombre">Profesor:</label>
          <input class="text" type="text" id="nombre" name="nombre" required>
          
          <label for="contrasena">contraseña:</label>
          <input class="text" type="password" id="contrasena" name="contrasena" required>
          
          <label for="enviar"></label>
          <button type="submit">Enviar</button>
        </form>
   </main>
    <footer>SEP</footer>
</body>
</html>
