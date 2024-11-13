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

    // Comprobar si ya existe un voto para esta receta y usuario
    $check_query = "SELECT calificacion FROM votos WHERE id_usuario = ? AND id_receta = ?";
    $check_stmt = $mysqli->prepare($check_query);
    $check_stmt->bind_param("si", $usuario_id, $receta_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Si el usuario ya votó, redirigir con un mensaje
        $_SESSION['mensaje'] = "Ya has votado en esta receta.";
    } else {
        // Insertar el nuevo voto
        $insert_query = "INSERT INTO votos (id_usuario, id_receta, calificacion) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($insert_query);
        $stmt->bind_param("sii", $usuario_id, $receta_id, $calificacion);
        $stmt->execute();

        // Actualizar la calificación promedio y el número de votos de la receta
        $sql = "SELECT calificacion_promedio, numero_votos FROM recetas WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $receta_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $calificacion_actual = $row['calificacion_promedio'];
            $numero_votos = $row['numero_votos'];

            // Recalcular la calificación promedio
            $nueva_calificacion_promedio = ($calificacion_actual * $numero_votos + $calificacion) / ($numero_votos + 1);
            $nuevo_numero_votos = $numero_votos + 1;

            $sql = "UPDATE recetas SET calificacion_promedio = ?, numero_votos = ? WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("dii", $nueva_calificacion_promedio, $nuevo_numero_votos, $receta_id);
            $stmt->execute();
        }

        $_SESSION['mensaje'] = "Voto registrado exitosamente.";
    }

    // Redirigir a la página de la receta con el mensaje correspondiente
    header("Location: ../../receta.php?id=" . $receta_id);
    exit();
}

$mysqli->close();
?>
