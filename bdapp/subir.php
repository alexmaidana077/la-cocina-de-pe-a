<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("db.php");

    $target_dir = "uploads/";
    $nombre = $_POST['nombre'];
    $ingredientes = $_POST['ingredientes']; // JSON de ingredientes
    $micro = $_POST['micro'];
    $categorias = $_POST['categorias'];
    $preparacion = $_POST['preparacion']; // JSON de pasos de preparación
    $imgBase64 = $_POST['img'];

    $imageFileName = uniqid() . '.jpg';
    $target_file = $target_dir . $imageFileName;
    $imgData = base64_decode($imgBase64);
    $fileSaved = file_put_contents($target_file, $imgData);

    if ($fileSaved !== false) {
        $query = "INSERT INTO recetas(nombre, ingredientes, micro, categorias, preparacion, img) VALUES ('$nombre', '$ingredientes', '$micro', '$categorias', '$preparacion', '$target_file')";
        $result = $mysql->query($query);

        if ($result === true) {
            echo "Datos e imagen insertados correctamente";
        } else {
            echo "Error al insertar en la base de datos: " . $mysql->error;
        }
    } else {
        echo "Error al guardar la imagen en el servidor";
    }

    $mysql->close();
} else {
    echo "Solicitud POST fallida";
}
?>
