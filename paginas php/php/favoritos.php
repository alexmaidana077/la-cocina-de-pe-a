<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Debes iniciar sesión para usar favoritos.']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$receta_id = isset($_POST['receta_id']) ? (int)$_POST['receta_id'] : 0;

if ($receta_id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'ID de receta inválido.']);
    exit;
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cocina";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Error al conectar con la base de datos.']);
    exit;
}

// Verificar si la receta ya está marcada como favorita por el usuario
$query = "SELECT id FROM favoritos WHERE usuarios_id = ? AND receta_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("si", $usuario_id, $receta_id); // Cambié el tipo de parámetro a 'ii' para enteros
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Si ya es favorito, eliminarlo
    $delete_query = "DELETE FROM favoritos WHERE usuarios_id = ? AND receta_id = ?";
    $delete_stmt = $mysqli->prepare($delete_query);
    $delete_stmt->bind_param("si", $usuario_id, $receta_id); // Cambié el tipo de parámetro a 'ii' para enteros
    $delete_stmt->execute();
    echo json_encode(['status' => 'success', 'message' => 'Receta eliminada de favoritos.']);
} else {
    // Si no es favorito, agregarlo
    $insert_query = "INSERT INTO favoritos (usuarios_id, receta_id) VALUES (?, ?)";
    $insert_stmt = $mysqli->prepare($insert_query);
    $insert_stmt->bind_param("si", $usuario_id, $receta_id); // Cambié el tipo de parámetro a 'ii' para enteros
    $insert_stmt->execute();
    echo json_encode(['status' => 'success', 'message' => 'Receta añadida a favoritos.']);
}

$mysqli->close();
?>
