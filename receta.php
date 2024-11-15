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

$receta_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$sql = "SELECT * FROM recetas WHERE id = ?";
$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $mysqli->error);
}

$stmt->bind_param("i", $receta_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()):
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logos/1 copy.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>La cocina de Peña Receta</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"><img src="img/logos/10.png" alt="Logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <span class="close-btn" onclick="document.getElementById('navbarNav').classList.remove('show')">&times;</span>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="pages/categorias.html">Categorías</a></li>
                        <li class="nav-item"><a class="nav-link" href="pages/nosotros.html">Acerca de Nosotros</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="contenedor_receta">
            <div class="texto" id="titulo">
                <h1 class="card-title"><?= htmlspecialchars($row['nombre']) ?></h1>
                <p class="card-text"><strong>Descripción: </strong><?= htmlspecialchars($row['micro']) ?></p>
            </div>
            <?php if (!empty($row['img'])): ?>
                <img src="<?= htmlspecialchars($row['img']) ?>" alt="Imagen de la receta" class="img-fluid">
            <?php else: ?>
                <p>No hay imagen disponible</p>
            <?php endif; ?>
        </div>

        <div class="contenedor_ingredientes" id="ingredientes">
            <h1>Ingredientes</h1>
            <div class="ingredientes">
                <div class="overflow-auto" style="height: 200px;">
                    <ul id="scrollspyHeading1">
                        <?php
                        $ingredientes = explode(',', $row['ingredientes']);
                        foreach ($ingredientes as $ingrediente): ?>
                            <li><?= htmlspecialchars(trim($ingrediente)) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="Contendor_Preparacion" id="preparacion">
            <h1>Preparación</h1>
            <div class="paso_de_preparacion">
                <ul>
                    <?php
                    $preparaciones = explode(',', $row['preparacion']);
                    foreach ($preparaciones as $preparacion): ?>
                        <li><?= htmlspecialchars(trim($preparacion)) ?></li>
                    <?php endforeach; ?>
                </ul>
                <div class="botones">
                    <button type="button" class="btn btn-primary" id="leer">Reproducir</button>
                    <button type="button" class="btn btn-warning" id="detener">Detener Reproducción</button>
                    <button type="button" class="btn btn-danger" id="reproducir">Reproducir Desde Donde Se Quedó</button>
                </div>
            </div>
            <?php
            if (isset($_SESSION['mensaje'])) {
                echo "<div class='alert alert-info'>" . htmlspecialchars($_SESSION['mensaje']) . "</div>";
                unset($_SESSION['mensaje']);
            }
        ?>

        <div class="calificacion">
            <h3>Calificación</h3>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <?php
                $usuario_id = $_SESSION['usuario_id'];
                
                // Verificar si el usuario ya votó
                $check_query = "SELECT calificacion FROM votos WHERE id_usuario = ? AND id_receta = ?";
                $check_stmt = $mysqli->prepare($check_query);
                $check_stmt->bind_param("si", $usuario_id, $receta_id);
                $check_stmt->execute();
                $voto_result = $check_stmt->get_result();
                $check_stmt->close();
                ?>

                <?php if ($voto_result->num_rows > 0): ?>
                    <p>Ya has calificado esta receta.</p>
                    <form action="paginas/php/php/eliminar_voto.php" method="post">
                        <input type="hidden" name="receta_id" value="<?= htmlspecialchars($receta_id) ?>">
                        <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($usuario_id) ?>">
                        <button type="submit" class="btn btn-danger">Eliminar mi voto</button>
                    </form>
                <?php else: ?>
                    <form action="paginas/php/php/calificar_receta.php" method="post">
                        <input type="hidden" name="receta_id" value="<?= htmlspecialchars($receta_id) ?>">
                        <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($usuario_id) ?>">
                        <label>
                            Calificación:
                            <select name="calificacion" required>
                                <option value="1">1 estrella ⭐</option>
                                <option value="2">2 estrellas ⭐⭐</option>
                                <option value="3">3 estrellas ⭐⭐⭐</option>
                                <option value="4">4 estrellas ⭐⭐⭐⭐</option>
                                <option value="5">5 estrellas ⭐⭐⭐⭐⭐</option>
                            </select>
                        </label>
                        <button type="submit" class="btn btn-primary">Enviar Calificación</button>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <p>Inicia sesión para calificar esta receta.</p>
                <a href="paginas/php/login.html" class="btn btn-secondary">Iniciar Sesión</a>
            <?php endif; ?>
        </div>

        <div class="calificacion_promedio">
            <h3>Calificación promedio: <?= round($row['calificacion_promedio'] ?? 0, 1) ?> estrellas</h3>
            <p>(Basado en <?= $row['numero_votos'] ?? 0 ?> votos)</p>
        </div>
        </div>
        
       
    </main>

    <footer>
        <div class="footerContainer">
            <div class="redes">
                <a href=""><img src="img/iconos/whatsapp-f.png" alt=""></a>
                <a href=""><img src="img/iconos/instagram-f.png" alt=""></a>
                <a href=""><img src="img/iconos/facebook-f.png" alt=""></a>
                <a href=""><img src="img/iconos/x-f.png" alt=""></a>
            </div>
            <p>Copyright &copy;2024; Diseñado por: La Triple M</p>
        </div>
    </footer>
    <script src="js/lector.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
else:
    echo "<p>Receta no encontrada.</p>";
endif;
$mysqli->close();
?>
