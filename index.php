<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cocina";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM recetas";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La cocina de peña</title>
    <link rel="shortcut icon" href="img/logos/1 copy.png" type="image/x-icon">   
    <link rel="prerender" href="pages/nosotros.html">
    <link rel="prerender" href="pages/receta.html">
    <!-- Vincular Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <!-- Nombre a la izquierda -->
                <a class="navbar-brand" href="#"><img src="img/logos/10.png" alt="Logo"></a>

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
        <div class="container">
            <div class="carousel-container">
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/carusel/1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/carusel/2.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/carusel/3.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguente</span>
                    </button>
                </div>
            </div>
        </div>
        <h1 class="tit">¡Deléitate con Nuestras Mejores Recetas!</h1>
 <!-- ------cartas: ------------>
<div class="contenedor_visualizar">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card">
            <?php if (!empty($row['img'])): ?>
                <img src="<?= htmlspecialchars($row['img']) ?>" class="card-img-top" alt="Imagen de la receta">
            <?php else: ?>
                <div class="no-img">
                    <p>No hay imagen disponible</p>
                </div>
            <?php endif; ?>

            <div class="card-body">
                <?php if (!empty($row['nombre'])): ?>
                    <h5 class="card-title"><?= htmlspecialchars($row['nombre']) ?></h5>
                <?php else: ?>
                    <p>No hay nombre disponible</p>
                <?php endif; ?>

                <?php if (!empty($row['micro'])): ?>
                    <p class="card-text">Descripción: <?= htmlspecialchars($row['micro']) ?></p>
                <?php else: ?>
                    <p>No hay descripción disponible</p>
                <?php endif; ?>

                <div class="calificacion_promedio">
                    <h3><?= round($row['calificacion_promedio'], 1) ?> ⭐</h3>
                    <p>(Basado en <?= htmlspecialchars($row['numero_votos']) ?> votos)</p>
                </div>
                
                <a href="receta.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-primary">Ver Receta</a>
            </div>
        </div>
    <?php endwhile; ?>
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
</body>
</html>