<?php
include_once('Conexion.php');


function cerrarSesion() {
    session_start();
    session_unset();
    session_destroy();
    header('location: public/index.php');
    exit();
  }


  function get_id_usuario($usuario) {
  
    $conn = Conexion();
    
    if (!$conn) {
      die("Error de conexión: " . mysqli_connect_error());
    }
  
   
    
    $query = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
    $resultado = mysqli_query($conn, $query);
    
    
    if (mysqli_num_rows($resultado) == 0) {
      die("Usuario no encontrado");
    }
    
   
    $user = mysqli_fetch_assoc($resultado);
    $id_usuario = $user['id'];
    
    
   /*  mysqli_close($conn); */
    
    
    return $id_usuario;
  }
  


?>