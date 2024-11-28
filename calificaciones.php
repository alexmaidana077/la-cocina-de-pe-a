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

// Comprobamos si se ha seleccionado un filtro
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'votos'; // Default: 'votos'

if ($filtro == 'votos') {
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
} elseif ($filtro == 'favoritos') {
    // Consultar las recetas favoritas del usuario
    $sqlFavoritos = "
        SELECT 
            r.id, r.img, r.nombre, r.micro, r.calificacion_promedio, r.numero_votos 
        FROM 
            recetas r
        INNER JOIN 
            favoritos f ON r.id = f.receta_id
        WHERE 
            f.usuarios_id = ?
    ";
    $stmtFavoritos = $conn->prepare($sqlFavoritos);
    $stmtFavoritos->bind_param("s", $email);
    $stmtFavoritos->execute();
    $result = $stmtFavoritos->get_result();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/styles.css">
    <title>Calificaciones del usuario</title>
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

<main  class="fav">
    <h1>Tus calificaciones</h1>

    <!-- Botones de filtro -->
    <div class="btns-fav">
        <button onclick="window.location.href='calificaciones.php?filtro=votos'" class="btn btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart-fill" viewBox="0 0 16 16">
  <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1z"/>
</svg> Calificadas</button>
        <button onclick="window.location.href='calificaciones.php?filtro=favoritos'" class="btn btn-outline-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
</svg> Favoritas</button>
    </div>
<div class="titulo">
    <h2>Recetas <?= $filtro == 'votos' ? 'Votadas' : 'Favoritas' ?></h2>
    <div class="contenedor_visualizar">
        
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
                        <a href="receta.php?id=<?= $row['id'] ?>" class="btn btn-primary">Ver Receta</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No has <?= $filtro == 'votos' ? 'votado en' : 'añadido a favoritos' ?> ninguna receta.</p>
        <?php endif; ?>
    </div>
    
</div>
</main>

<footer>
        <div class="footerContainer">
            <div class="redes">
                <a href=""><img src="img/iconos/facebook-f.png" alt=""></a>
                <a href=""><img src="img/iconos/instagram-f.png" alt=""></a>
                <a href=""><img src="img/iconos/whatsapp-f.png" alt=""></a>
                <a href=""><img src="img/iconos/x-f.png" alt=""></a>
            </div>
        
            <p>Copyright &copy;2024; Diseñado por: La Triple M</p>
        
        </div>

    </footer>

    <!-- Vincular Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<?php
// Cerrar la conexión a la base de datos
if ($filtro == 'votos') {
    $stmtVotos->close();
} else {
    $stmtFavoritos->close();
}
$conn->close();
?>
</body>
</html>
