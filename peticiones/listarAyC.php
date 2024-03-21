<?php
session_start();
$usuario=$_SESSION['usuario'];


/* $ruta_personal = "../../app/private/usuarios/$usuario"; */
$ruta_personal = "../../app/private/usuarios/$usuario";


if (is_dir("$ruta_personal")) {
  $directorio = opendir($ruta_personal);
  $carpetas = array();
  $archivos = array();

  while (($archivo = readdir($directorio)) !== false) {
    if ($archivo == "." || $archivo == "..") {
      continue;
    }

    if (is_dir("$ruta_personal/$archivo")) {
      $carpetas[] = $archivo;
    } else {
      $archivos[] = $archivo;
    }
  }

  closedir($directorio);

  $datos = array(
    'carpetas' => $carpetas,
    'archivos' => $archivos
  );
  
  echo json_encode($datos);
} 

?>
