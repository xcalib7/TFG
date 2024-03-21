<?php
include_once('Funciones.php');
session_start();
if (!isset($_SESSION['usuario'])) {
    header('location: public/index.php');
}

include_once('Funciones.php');


if (isset($_POST['cerrar_sesion'])) {


    cerrarSesion();
}



$usuario = $_SESSION['usuario'];


$carpeta_personal = "private/usuarios/$usuario";

if (!is_dir($carpeta_personal)) {
    mkdir($carpeta_personal, 0777, true);


    $fecha = date("Y-m-d H:i:s");
    $nombre = $usuario;
    $tipo = "carpeta";
    $id_usuario = get_id_usuario($_SESSION['usuario']);



    $stmt = $conn->prepare("INSERT INTO carpetas (nombre, tipo, ruta, usuario_id, fecha_creacion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $nombre, $tipo, $carpeta_personal, $id_usuario, $fecha);
    $stmt->execute();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpeta Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="styles/styleMenu.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



    <script src="js/funciones.js"></script>

    <script>
        listar();
    </script>


</head>

<body>
    <!-- <form action="Menu.php" method="post">
        <button type="submit" name="cerrar_sesion" class="btn btn-danger">Cerrar Sesión</button>
    </form> -->




    <div id="wrapper">


        <div id="sidebar">

            <!-- Boton para crear carpetas -->
            <button id="abrirModalBtn" class="btn btn-primary">Crear Carpeta</button>

            <!-- Modal para ingresar el nombre de la carpeta -->
            <div class="modal fade" id="nombreCarpetaModal" tabindex="-1" role="dialog" aria-labelledby="nombreCarpetaModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nombreCarpetaModalLabel">Ingresa el nombre de la carpeta</h5>

                        </div>
                        <div class="modal-body">
                            <input type="text" id="nombreCarpetaInput" class="form-control" placeholder="Nombre de la carpeta">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="crearCarpetaModalBtn">Crear Carpeta</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Boton para subir archivos y carpetas -->


            <div class="btn-group dropend">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Subir
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <input type="file" id="cargarArchivosInput" multiple style="display: none;">
                        <button class="dropdown-item" id="cargarArchivosBtn" class="btn btn-primary">Subir Archivos</button>
                    </li>
                    <li>
                        <input type="file" id="cargarCarpetasInput" webkitdirectory directory  multiple style="display: none;">
                        <button class="dropdown-item" id="cargarCarpetasBtn" class="btn btn-primary">Subir Carpetas</button>
                    </li>
                    
                </ul>
            </div>

        </div>

        <div id="main">


            <div id="container">

                <div id="carpetas"></div>
                <div id="archivos"></div>

            </div>


        </div>

    </div>







</body>

</html>