<?php 
  session_start();
  if (isset($_SESSION['usuario'])) {
    header("Location: ../Menu.php");
  } else {
    header("Location: ../Login.php");
  }
?>
