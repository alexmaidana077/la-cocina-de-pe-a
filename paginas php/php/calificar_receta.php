<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cocina";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

if (isset($_POST['receta_id'], $_POST['usuario_id'], $_POST['calificacion'])) {
    $receta_id = (int)$_POST['receta_id'];
    $usuario_id = $mysqli->real_escape_string($_POST['usuario_id']);
    $calificacion = (int)$_POST['calificacion'];

    $query = "INSERT INTO votos (id_usuario, id_receta, calificacion) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }

    $stmt->bind_param("sii", $usuario_id, $receta_id, $calificacion);

    if ($stmt->execute()) {
        echo "Calificación guardada correctamente.";
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }
        // Actualizar la calificación promedio de la receta
        $sql = "SELECT calificacion_promedio, numero_votos FROM recetas WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $receta_id);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($row = $result->fetch_assoc()) {
            $calificacion_actual = $row['calificacion_promedio'];
            $numero_votos = $row['numero_votos'];

            $nueva_calificacion_promedio = ($calificacion_actual * $numero_votos + $calificacion) / ($numero_votos + 1);
            $nuevo_numero_votos = $numero_votos + 1;

            $sql = "UPDATE recetas SET calificacion_promedio = ?, numero_votos = ? WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("dii", $nueva_calificacion_promedio, $nuevo_numero_votos, $receta_id);
            $stmt->execute();
        }
        header("Location: receta.php?id=" . $receta_id);
        exit();
    }

?>
