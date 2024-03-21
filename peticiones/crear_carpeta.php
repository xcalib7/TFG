<?php
session_start();

    $nombreCarpeta=$_POST['nombre'];

    $rutaBase = '../private/usuarios/' . $_SESSION['usuario'] /* . '/' */;
    

    chdir($rutaBase);

        if(is_dir($nombreCarpeta)){
            echo "La carpeta ya existe" .$rutaBase.'/'.$nombreCarpeta;
        }else{
            if (mkdir($nombreCarpeta, 0777, true)) {
                // Carpeta creada con éxito
                echo "Carpeta creada con éxito. ". $nombreCarpeta;
                
            } else {
                // Error al crear la carpeta
                echo "Error al crear la carpeta.";
            }
        }
