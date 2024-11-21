<?php
session_start();

$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$BDName = "cocina";

$conn = new mysqli($servidor, $usuario, $contraseña, $BDName);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$img = $_FILES['img']['name'];
$target_file = $target_dir . basename($img);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verificar si es una imagen real
$check = getimagesize($_FILES['img']['tmp_name']);
if ($check === false) {
    echo "El archivo no es una imagen.";
    $uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
    $uploadOk = 0;
}

if ($uploadOk && move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
    $micro = $conn->real_escape_string($_POST['micro']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $categorias = $conn->real_escape_string($_POST['categorias']);
    $preparacion = $conn->real_escape_string($_POST['preparacion']);
    $ingredientes = $conn->real_escape_string($_POST['ingredientes']);

    $sql = "INSERT INTO recetas (img, nombre, micro, categorias, preparacion, ingredientes) 
            VALUES ('$target_file', '$nombre', '$micro', '$categorias', '$preparacion', '$ingredientes')";

    if ($conn->query($sql) === TRUE) {
        echo "Publicación agregada con éxito.";
    } else {
        echo "Error al agregar la publicación: " . $conn->error;
    }
} else {
    echo "Error al subir la imagen.";
}

$conn->close();
?>
