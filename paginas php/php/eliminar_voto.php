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

if (isset($_POST['receta_id'], $_POST['usuario_id'])) {
    $receta_id = (int)$_POST['receta_id'];
    $usuario_id = $mysqli->real_escape_string($_POST['usuario_id']);

    // Obtener la calificación del voto para restarla
    $get_vote_query = "SELECT calificacion FROM votos WHERE id_usuario = ? AND id_receta = ?";
    $stmt = $mysqli->prepare($get_vote_query);
    $stmt->bind_param("si", $usuario_id, $receta_id);
    $stmt->execute();
    $vote_result = $stmt->get_result();

    if ($vote_row = $vote_result->fetch_assoc()) {
        $calificacion = $vote_row['calificacion'];

        // Eliminar el voto
        $delete_query = "DELETE FROM votos WHERE id_usuario = ? AND id_receta = ?";
        $stmt = $mysqli->prepare($delete_query);
        $stmt->bind_param("si", $usuario_id, $receta_id);
        $stmt->execute();

        // Actualizar calificación promedio y número de votos en la receta
        $sql = "SELECT calificacion_promedio, numero_votos FROM recetas WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $receta_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $calificacion_actual = $row['calificacion_promedio'];
            $numero_votos = $row['numero_votos'];

            // Recalcular solo si hay votos
            if ($numero_votos > 1) {
                $nueva_calificacion_promedio = ($calificacion_actual * $numero_votos - $calificacion) / ($numero_votos - 1);
                $nuevo_numero_votos = $numero_votos - 1;
            } else {
                $nueva_calificacion_promedio = 0;
                $nuevo_numero_votos = 0;
            }

            $update_query = "UPDATE recetas SET calificacion_promedio = ?, numero_votos = ? WHERE id = ?";
            $stmt = $mysqli->prepare($update_query);
            $stmt->bind_param("dii", $nueva_calificacion_promedio, $nuevo_numero_votos, $receta_id);
            $stmt->execute();

            $_SESSION['mensaje'] = "Tu voto ha sido eliminado.";
        }
    } else {
        $_SESSION['mensaje'] = "No se encontró el voto para eliminar.";
    }
}

header("Location: ../../receta.php?id=" . $receta_id);
exit();
?>
