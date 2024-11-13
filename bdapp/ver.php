<?php
// Archivo: ver.php
// Incluye el archivo de conexión a la base de datos
require_once("db.php");

// Obtiene la categoría desde la URL
$categorias = isset($_GET['categorias']) ? $_GET['categorias'] : '';

// Si se recibe una categoría, realiza la consulta con el filtro
$query = "SELECT nombre FROM recetas WHERE categorias = '$categorias'"; // Filtra por la categoría
$result = $mysql->query($query);

$nombres = array();

// Verifica si hay resultados
if ($result->num_rows > 0) {
    // Guarda cada nombre en el array
    while ($row = $result->fetch_assoc()) {
        $nombres[] = $row['nombre'];
    }
}

// Convierte el array en JSON y lo envía como respuesta
echo json_encode($nombres);

// Cierra la conexión
$mysql->close();
?>
