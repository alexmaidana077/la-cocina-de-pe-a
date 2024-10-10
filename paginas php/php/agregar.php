<?php
 
 session_start();

$servidor = "localhost";
$usuario = "root";
$contraseña ="";
$BDName = "cocina";

$conn = new mysqli ($servidor,$usuario,$contraseña,$BDName);

if ($conn->connect_error) {
}
$target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Crear carpeta con permisos de escritura
    }

    // Subir imagen
    $img = $_FILES['img']['name'];
    $target_file = $target_dir . basename($img);
    
    if (move_uploaded_file($_FILES['img']['tmp_name'], $target_file)) {
        // Escapar los datos del formulario
        $micro = $_POST['micro'];
        $nombre = $_POST['nombre'];
        $categorias = $_POST['categorias'];
        $preparacion = $_POST['preparacion'];
        $ingredientes = $_POST['ingredientes'];


        // Insertar en la tabla publicaciones
        $sql = "INSERT INTO recetas (img, nombre,micro,categorias,preparacion,ingredientes) VALUES ('$target_file','$nombre' ,'$micro','$categorias','$preparacion','$ingredientes')";

        if ($conn->query($sql) === TRUE) {
            echo "Publicación agregada con éxito.";
        } else {
            echo "Error al agregar la publicación: " . $conn->error;
        }
    } else {
        echo "Error al subir la imagen.";
    }

    $co
?>