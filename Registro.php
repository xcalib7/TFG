<?php
include_once('Conexion.php');
session_start();
$conn = Conexion();

if (isset($_POST['enviar'])) {

    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    
    $contrasena_confirmar = $_POST['contrasena_confirmar'];

    $errores = [];

    if (empty($nombre)) {
        $errores[] = 'Por favor ingrese su nombre completo';
    }

    if (empty($usuario)) {
        $errores[] = 'Por favor ingrese un nombre de usuario';
    }

    if (empty($contrasena)) {
        $errores[] = 'Por favor ingrese una contraseña';
    }

    if ($contrasena != $contrasena_confirmar) {
        $errores[] = 'Las contraseñas no coinciden';
    }

    if (empty($errores)) {

        $hash= password_hash($contrasena, PASSWORD_BCRYPT);

        $query = "INSERT INTO usuarios (nombre, usuario, contrasena) VALUES ('$nombre', '$usuario', '$hash')";

        $error_registro = [];


        if (mysqli_query($conn, $query)) {
            $_SESSION['exito_reg'] = true;
        } else {
            $_SESSION['error_reg'] = true;
        }
    }
}


?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<script>
     $(document).ready(function(){
        $('.alert-success').delay(3000).fadeOut();
    })
</script>

<body style="background-color: lightgray;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-container text-center">
                    <img src="images/formulario-registro.png" style="width: 150px; height: 150px;"><br><br>
                    <?php if (!empty($errores)) : ?>

                        <div class="alert alert-danger">
                            <?php foreach ($errores as $error) : ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <form action="Registro.php" method="post">
                        <input type="text" name="nombre" placeholder="Nombre completo" class="form-control" style="margin-bottom: 20px;"><br>
                        <input type="text" name="usuario" placeholder="Usuario" class="form-control" style="margin-bottom: 20px;"><br>
                        <input type="password" name="contrasena" placeholder="Contraseña" class="form-control" style="margin-bottom: 20px;"><br>
                        <input type="password" name="contrasena_confirmar" placeholder="Confirmar contraseña" class="form-control" style="margin-bottom: 20px;"><br>
                        <input type="submit" name="enviar" value="Registrarse" class="btn btn-primary">
                    </form>
                    <br><br>
                    <p>¿Ya tienes una cuenta? <a href="Login.php">Inicia sesión aquí</a></p>

                    <?php if (isset($_SESSION['error_reg'])) : ?>


                        <?php echo ' <div class="alert alert-danger ">  Hubo un error al registrar el usuario.  </div>' ?>

                        <?php unset($_SESSION['error_reg']) ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['exito_reg'])) : ?>
                    <?php echo '<div class="alert alert-success ">  Usuario registrado con éxito. </div>' ?>    
                    <?php unset($_SESSION['exito_reg']) ?>
                    <?php endif; ?>





                </div>
            </div>
        </div>
    </div>
</body>

</html>