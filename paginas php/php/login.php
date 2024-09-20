<?php

session_start();

//conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contra = "";
$DbNombre = "Cocina";

$conn = new mysqli ($servidor, $usuario, $contra, $DbNombre);

//se verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn -> connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $gmail = $_POST['gmail'];
    $contraseña = $_POST['contraseña'];

    // Verificar que los campos no estén vacíos
    if (!empty($gmail) && !empty($contraseña)){

    }
}
?>