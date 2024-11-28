<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cocina";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la categoría desde la URL
$categoria = $_GET['categoria'] ?? '';

// Consulta para seleccionar las recetas que coinciden con la categoría
$sql = "SELECT id, img, nombre, micro, calificacion_promedio, numero_votos FROM recetas WHERE categorias = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Vincular el parámetro de categoría
$stmt->bind_param("s", $categoria);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logos/1 copy.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>La cocina de Peña Nosotros</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <!-- Nombre a la izquierda -->
                <a class="navbar-brand" href="index.php"><img src="img/logos/10.png" alt="Logo"></a>

                <!-- Botón colapsable en móviles -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Elementos del menú -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Botón para cerrar el menú -->
                    <span class="close-btn" onclick="document.getElementById('navbarNav').classList.remove('show')">&times;</span>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/categorias.php">Categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/nosotros.php">Acerca de Nosotros</a>
                        </li>
                        <?php
                        // Iniciar la sesión si no se ha iniciado
                        session_start();
                        
                        // Verificar si el usuario ha iniciado sesión
                        if (!isset($_SESSION['usuario_id'])) {
                            // Si no ha iniciado sesión, mostrar los botones de registro e inicio de sesión
                            echo '
                            <li class="nav-item">
                                <a class="nav-link" href="paginas php/registro.html">Registrarse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="paginas php/login.html">Iniciar Sesión</a>
                            </li>';
                        } else {
                            echo '
                            <li clas="nav-item">
                                <a class="nav-link" href="calificaciones.php">Calificaciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="paginas php/php/logout.php">Cerrar Sesión</a>
                            </li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <hr style="margin-top: 90px;">
        <h1 class="tit" style="margin-top: 40px;">Recetas de la categoría: <?= htmlspecialchars($categoria) ?></h1>
        <div class="contenedor_visualizar">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card">
                    <?php if (!empty($row['img'])): ?>
                        <img src="<?= htmlspecialchars($row['img']) ?>" class="card-img-top" alt="Imagen de la receta">
                    <?php else: ?>
                        <p>No hay imagen disponible</p>
                    <?php endif; ?>

                    <div class="card-body">
                        <?php if (!empty($row['nombre'])): ?>
                            <p class="card-title"><?= htmlspecialchars($row['nombre']) ?></p>
                        <?php else: ?>
                            <p>No hay nombre disponible</p>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                        <?php if (!empty($row['micro'])): ?>
                            <p class="card-text">Descripción: <?= htmlspecialchars($row['micro']) ?></p>
                        <?php else: ?>
                            <p>No hay descripción disponible</p>
                        <?php endif; ?>
                        <div class="calificacion_promedio">
                            <h3> <?= round($row['calificacion_promedio'], 1) ?> ⭐</h3>
                            <p>(Basado en <?= $row['numero_votos'] ?> votos)</p>
                        </div>
                        <a href="receta.php?id=<?= $row['id'] ?>" class="btn btn-primary">Ver Receta</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No se encontraron recetas en esta categoría.</p>
        <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="footerContainer">
            <div class="redes">
                <a href=""><img src="../img/iconos/whatsapp-f.png" alt=""></a>
                <a href=""><img src="../img/iconos/instagram-f.png" alt=""></a>
                <a href=""><img src="../img/iconos/facebook-f.png" alt=""></a>
                <a href=""><img src="../img/iconos/x-f.png" alt=""></a>
            </div>
            <p>Copyright &copy;2024; Diseñado por: La Triple M</p>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
