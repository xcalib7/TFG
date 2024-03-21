<?php

include_once('Conexion.php');
session_start();
$conn = Conexion();

if (isset($_POST['enviar'])) {

  $usuario = $_POST['usuario'];
  $contrasena = $_POST['contrasena'];

  $query = "SELECT contrasena FROM usuarios WHERE usuario='$usuario'";

  $resultado = mysqli_query($conn, $query);

  if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);

    if (password_verify($contrasena, $fila['contrasena'])) {
      $_SESSION['usuario']= $usuario;
      header('location: Menu.php');
    } else {
      $_SESSION['error'] = true;
    }
  } else {
    $_SESSION['error'] = true;
  };



}

?>



<html>

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body style="background-color: lightgray;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-md-offset-3">
        <div class="form-container text-center">
          <img src="images/nubeIS.png" style="width: 150px; height: 150px;"><br><br>
          <form action="Login.php" method="post">
            <input type="text" name="usuario" placeholder="Usuario" class="form-control" style="margin-bottom: 20px;"><br>
            <input type="password" name="contrasena" placeholder="Contraseña" class="form-control" style="margin-bottom: 20px;"><br>
            <input type="submit" name="enviar" value="Iniciar sesión" class="btn btn-primary">
          </form>
          <br><br>
          <p>¿No tienes una cuenta? <a href="Registro.php">Regístrate aquí</a></p>

          <?php if (isset($_SESSION['error'])) : ?>
          <?php echo ' <div class="alert alert-danger ">  Usuario o contraseña incorrectos.  </div>' ?>
          <?php unset($_SESSION['error']) ?>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</body>

</html>