<?php

$servername = "localhost";
$username = "root"; 
$contra = "";
$dbname = "cocina";

$conn = new mysqli($servername, $username, $contra, $dbname);

if ($conn -> connect_error){
    die ("Conexión Fallida:" . $conn->connect_error);
}

// Consulta SQL para obtener categorías únicas
$sql = "SELECT DISTINCT categorias FROM recetas";
$result = $conn -> query($sql);

if (!$result){
    die ("Error en la Consulta:" . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Vincular Bootstrap CSS -->
    <link rel="shortcut icon" href="../img/logos/1 copy.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>La cocina de Peña Categoria</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <!-- Nombre a la izquierda -->
                <a class="navbar-brand" href="../index.php"><img src="../img/logos/10.png" alt="Logo"></a>

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
                            <a class="nav-link" href="../pages/categorias.php">Categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/nosotros.php">Acerca de Nosotros</a>
                        </li>
                        <?php
                        // Iniciar la sesión si no se ha iniciado
                        session_start();
                        
                        // Verificar si el usuario ha iniciado sesión
                        if (!isset($_SESSION['usuario_id'])) {
                            // Si no ha iniciado sesión, mostrar los botones de registro e inicio de sesión
                            echo '
                            <li class="nav-item">
                                <a class="nav-link" href="../paginas php/registro.html">Registrarse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../paginas php/login.html">Iniciar Sesión</a>
                            </li>';
                        } else {
                            echo '
                            <li clas="nav-item">
                                <a class="nav-link" href="../calificaciones.php">Calificaciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../paginas php/php/logout.php">Cerrar Sesión</a>
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
        <h1 class="tit" style="margin-top: 40px;">¡Deléitate con Nuestras Categorias!</h1>
        
        <div class="contenedor_categoria">
            <div class="grupo-tarjetas">
                <?php
                $imagenes_categorias = [
                    "Desayunos" => "../img/comidas/desayuno.jpg",
                    "Entradas" => "../img/comidas/entrada.jpg",
                    "Platos Principales" => "../img/comidas/principal.jpg",
                    "Guarnicion" => "../img/comidas/guarniciones.jpg",
                    "Postres" => "../img/comidas/postre.jpg"
                ];
                
                while ($row = $result->fetch_assoc()) {
                    $categoria = $row['categorias'];
                    $imagen = isset($imagenes_categorias[$categoria]) ? $imagenes_categorias[$categoria] : "../img/comidas/default.jpg"; // Imagen por defecto
                ?>
                    <div class="tarjeta" style="background-image:url('<?php echo $imagen; ?>');">
                        <div class="detalles">
                            <h2><?php echo strtoupper($categoria); ?></h2>
                            <a href="../sub_categoria.php?categoria=<?php echo urlencode($categoria); ?>">Ver todos</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
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

<?php $conn->close(); ?>
