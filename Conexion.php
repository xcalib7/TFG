<?php



$host = "localhost";
$usuario = "root";
$contrasena = "";
$bdnombre = "drive";


$conn = mysqli_connect($host, $usuario, $contrasena, $bdnombre);


if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

function Conexion() { 
    global $conn; 
    return $conn; 
} 




?>

