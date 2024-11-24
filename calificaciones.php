<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}

$servidor = "localhost";
$usuario = "root";
$contra = "";
$DbNombre = "cocina";

$conn = new mysqli($servidor, $usuario, $contra, $DbNombre);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$email = $_SESSION['usuario_id'];

// Consultar datos del usuario
$sqlUsuario = "SELECT usuario, email FROM usuario WHERE email = ?";
$stmtUsuario = $conn->prepare($sqlUsuario);
$stmtUsuario->bind_param("s", $email);
$stmtUsuario->execute();
$stmtUsuario->bind_result($usuario, $email);
$stmtUsuario->fetch();
$stmtUsuario->close();

// Consultar las recetas votadas por el usuario
$sqlVotos = "
    SELECT 
        r.id, r.img, r.nombre, r.micro, r.calificacion_promedio, r.numero_votos 
    FROM 
        recetas r
    INNER JOIN 
        votos v ON r.id = v.id_receta
    WHERE 
        v.id_usuario = ?
";
$stmtVotos = $conn->prepare($sqlVotos);
$stmtVotos->bind_param("s", $email);
$stmtVotos->execute();
$result = $stmtVotos->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
</head>
<body>

<header>

</header>

    <main>

    <h1>Tus Votos</h1>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <?php if (!empty($row['img'])): ?>
                    <img src="<?= htmlspecialchars($row['img']) ?>" alt="Imagen de la receta">
                <?php else: ?>
                    <p class="card-img-placeholder">No hay imagen disponible</p>
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['nombre']) ?></h5>
                    <p><?= htmlspecialchars($row['micro']) ?></p>
                    <div class="calificacion_promedio">
                        <strong><?= round($row['calificacion_promedio'], 1) ?> ⭐</strong>
                        <p>(<?= $row['numero_votos'] ?> votos)</p>
                    </div>
                    <a href="receta.php?id=<?= $row['id'] ?>" class="btn">Ver Receta</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No has votado en ninguna receta.</p>
    <?php endif; ?>
</main>


<footer>

</footer>


    <?php
    // Cerrar la conexión a la base de datos
    $stmtVotos->close();
    $conn->close();
    ?>
</body>
</html>
