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

// Consulta para obtener los datos de clase
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
                            <a class="nav-link" href="pages/categorias.html">Categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="paginas php/agregar.html">agregar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/nosotros.html">Acerca de Nosotros</a>
                        </li>
                        <?php
                        // Iniciar la sesión si no se ha iniciado
                        session_start();
                        
                        // Verificar si el usuario ha iniciado sesión
                        if (!isset($_SESSION['usuario'])) {
                            // Si no ha iniciado sesión, mostrar los botones de registro e inicio de sesión
                            echo '
                            <li class="nav-item">
                                <a class="nav-link" href="paginas php/registro.html">Registrarse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="paginas php/login.html">Iniciar Sesión</a>
                            </li>';
                        } else {
                            // Si el usuario ha iniciado sesión, mostrar el botón para cerrar sesión
                            echo '
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
        <div class="card">
            <img src="img/comidas/hambur.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">hamburguesa</h5>
              <p class="card-text">Una jugosa carne, cubierta con queso cheddar derretido, entre dos suaves panes tostados. Sencilla pero deliciosa.
            </p>
            <a href="paginas php/php/ver_receta.php" class="btn btn-primary">Ver Receta</a>
            </div>
          </div>
          <div class="card">
            <img src="img/comidas/polenta.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Polenta</h5>
              <p class="card-text">Una cremosa polenta con tuco rojo casero. La polenta suave contrasta con la salsa de tomate especiada y aromática.</p>
              <a href="paginas php/php/ver_receta.php?receta=hamburguesa" class="btn btn-primary">Ver Receta</a>
            </div>
          </div>
          <div class="card">
            <img src="img/comidas/sorrentinos.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Sorrentinos</h5>
              <p class="card-text">Sorrentinos rellenos, cubiertos de tuco rojo casero. Pasta y salsa en armonía.</p>
              <a href="paginas php/php/ver_receta.php?receta=hamburguesa" class="btn btn-primary">Ver Receta</a>
            </div>
          </div>

          <div class="card">
            <img src="img/comidas/tortilla_papa.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Tortilla de Papa</h5>
              <p class="card-text">Tortilla dorada de papas tiernas, ligada con huevos. Crujiente por fuera, suave por dentro.</p>
              <a href="paginas php/php/ver_receta.php?receta=hamburguesa" class="btn btn-primary">Ver Receta</a>
            </div>
          </div>
          <div class="card">
            <img src="img/comidas/torta_jamoyqueso.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Tarta de Jamon y Queso</h5>
              <p class="card-text">Masa crujiente rellena de jamón y queso fundido. Salado y reconfortante.</p>
              <a href="paginas php/php/ver_receta.php?receta=hamburguesa" class="btn btn-primary">Ver Receta</a>
            </div>
          </div>
          <div class="card">
            <img src="img/comidas/pasteldepapa.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Pastel De Papa</h5>
              <p class="card-text">Capas de puré y carne picada, gratinado al horno. Clásico reconfortante.</p>
              <a href="paginas php/php/ver_receta.php?receta=hamburguesa" class="btn btn-primary">Ver Receta</a>
            </div>
          </div>
          <div class="card">
            <img src="img/comidas/napo.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Napolitana</h5>
              <p class="card-text">Milanesa cubierta de tomate, jamón y queso derretido. Crujiente y sabrosa.</p>
              <a href="paginas php/php/ver_receta.php?receta=hamburguesa" class="btn btn-primary">Ver Receta</a>
            </div>
          </div>
          <div class="card">
            <img src="img/comidas/locro.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Locro</h5>
              <p class="card-text">Guiso espeso de maíz, carnes y legumbres. Tradicional y contundente.</p>
              <a href="paginas php/php/ver_receta.php?receta=hamburguesa" class="btn btn-primary">Ver Receta</a>
            </div>
          </div>     
</div>

<?php while ($row = $result->fetch_assoc()): ?>
    <div class="card">

        <?php if (!empty($row['img'])): ?>
           <img src="<?= htmlspecialchars($row['img']) ?>" class="card-img-top" alt="Imagen de la receta">
        <?php else: ?>
            <p>No hay imagen disponible</p>
        <?php endif; ?>

        <div class="card-body">
            <?php if (!empty($row['nombre'])): ?>
                <p class="card-text">Nombre: <?= htmlspecialchars($row['nombre']) ?></p>
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
            <a href="paginas_php/php/ver_receta.php?receta=<?= urlencode($row['nombre']) ?>" class="btn btn-primary">Ver Receta</a>
        </div>
    </div>
<?php endwhile; ?>


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
