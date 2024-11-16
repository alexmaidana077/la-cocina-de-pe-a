<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cocina";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
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
    <title>La cocina de Peña Nosotros</title>
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
                            <a class="nav-link" href="categorias.php">Categorías</a>
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
                            // Si el usuario ha iniciado sesión, mostrar el botón para cerrar sesión
                            echo '
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
        <div class="presentacion">
            <h1>Bienvenidos a La Cocina de Peña</h1>
            <p>¡Explora un universo de delicias culinarias con Sabores del Mundo! Nuestra página está diseñada para los
                amantes de la cocina que buscan descubrir nuevas recetas, perfeccionar sus habilidades culinarias y
                disfrutar de una experiencia gastronómica única. Desde recetas tradicionales que han pasado de
                generación en generación hasta innovadoras creaciones modernas, aquí encontrarás una variedad de platos que se
                adaptan a todos los gustos y ocasiones.</p>
            <p>En La Cocina de Peña, nos apasiona la cocina tanto como a ti. Ya seas un chef experimentado o un
                entusiasta de la cocina casera, nuestro objetivo es proporcionarte recetas fáciles de seguir, consejos útiles y
                trucos que te ayudarán a crear comidas memorables. Además, ofrecemos guías sobre ingredientes, técnicas de
                cocina y cómo hacer que cada comida sea especial.</p>
            <p>Navega a través de nuestras categorías, encuentra recetas para cada momento del día, y déjate inspirar
                por las imágenes y descripciones que acompañan cada plato. ¡Comienza tu aventura culinaria con nosotros y
                transforma cada comida en una celebración del sabor!</p>
        </div>
         <!-- nosotros -->
        <!-- juan -->
         <hr>
         <div class="div_nosotros">
            <div class="info_nosotros">
                <h1>Juan Mattia</h1>
                <h5>"Lider"</h5>
                <p>Como líder de este increíble equipo, fui quien tuvo la idea de nombrar nuestro sistema 'La Cocina de Peña', en honor a nuestro querido amigo y compañero, Sergio Peña. Considero que tengo buenas habilidades de liderazgo, ya que sé cómo gestionar un equipo de manera eficiente y comunicarme de forma clara a la hora de organizar o planificar un proyecto.
                </p>
                <p>Soy muy competente en CSS, y como pueden ver, esta página tiene un diseño responsive que quedó bastante genial. Debo admitir que me costó bastante lograrlo, pero al final lo conseguimos.</p>
                <div class="info">
                    <a href="">
                        <div class="insta">
                            <img src="../img/iconos/instagram.png" >
                            <span>@juan.mttia</span>
                        </div>
                    </a>
                </div>
            </div>
            <img src="../img/nosotros/maui.png" alt="" class="foto">
        </div>
        <!-- matias -->
        <div class="div_nosotros">
            <img src="../img/nosotros/ozuna.png" alt="" class="foto">
            <div class="info_nosotros2">
                <h1>Matias Puegher</h1>
                <h5>Sub-Lider</h5>
                <p>Como líder de este increíble equipo, fui quien tuvo la idea de nombrar nuestro sistema 'La Cocina de Peña', en honor a nuestro querido amigo y compañero, Sergio Peña. Considero que tengo buenas habilidades de liderazgo, ya que sé cómo gestionar un equipo de manera eficiente y comunicarme de forma clara a la hora de organizar o planificar un proyecto.
                </p>
                <p>Soy muy competente en CSS, y como pueden ver, esta página tiene un diseño responsive que quedó bastante genial. Debo admitir que me costó bastante lograrlo, pero al final lo conseguimos.</p>
                <div class="info2">
                    <a href="">
                        <div class="insta2">
                            <img src="../img/iconos/instagram.png" >
                            <span>@Matias_puegher0</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- maidana -->
        <div class="div_nosotros">
            <div class="info_nosotros">
                <h1>Alex maidana</h1>
                <h5>Otro</h5>
                <p>Como líder de este increíble equipo, fui quien tuvo la idea de nombrar nuestro sistema 'La Cocina de Peña', en honor a nuestro querido amigo y compañero, Sergio Peña. Considero que tengo buenas habilidades de liderazgo, ya que sé cómo gestionar un equipo de manera eficiente y comunicarme de forma clara a la hora de organizar o planificar un proyecto.
                </p>
                <p>otro</p>
                <div class="info">
                    <a href="">
                        <div class="insta">
                            <img src="../img/iconos/instagram.png" >
                            <span>@Alex.maidana645</span>
                        </div>
                    </a>
                </div>
            </div>
            <img src="../img/nosotros/russel.png" alt="" class="foto">
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
    <!-- Vincular Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>