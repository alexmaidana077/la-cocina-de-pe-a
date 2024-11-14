<?php

$servername = "localhost";
$username = "root"; 
$contra = "";
$dbname = "cocina";

$conn = new mysqli($servername, $username, $contra,$dbname);

if ($conn -> connect_error){
    die ("Conexión Fallida:" . $conn-> connect_error);
}

$sql = "SELECT * FROM recetas";
$result = $conn -> query ($sql);

if (!$result){
    die ("Error en la Consulta:" . $conn -> error);
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
                    <span class="close-btn" onclick="document.getElementById('navbarNav').classList.remove('show')">&times;</span>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="nosotros.html">Acerca de Nosotros</a>
                        </li>
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
               
                <div class="tarjeta" style="background-image:url(../img/comidas/desayuno.jpg);">
                    <div class="detalles">
                        <h2>DESAYUNOS</h2>
                        <a href="sub_categoria.html">Ver todos</a>
                    </div>
                </div>

                <div class="tarjeta" style="background-image:url(../img/comidas/entrada.jpg);">
                    <div class="detalles">
                        <h2>ENTRADAS</h2>
                        <a href="sub_categoria.html">Ver todos</a>
                    </div>
                </div>

                <div class="tarjeta" style="background-image:url(../img/comidas/principal.jpg);">
                    <div class="detalles">
                        <h2>PLATOS PRINCIPALES</h2>
                        <a href="sub_categoria.html">Ver todos</a>
                    </div>
                </div>


                <div class="tarjeta" style="background-image:url(../img/comidas/guarniciones.jpg);">
                    <div class="detalles">
                        <h2>GUARNICIÓN</h2>
                        <a href="sub_categoria.html">Ver todos</a>
                    </div>
                </div>

                <div class="tarjeta" style="background-image:url(../img/comidas/postre.jpg);">
                    <div class="detalles">
                        <h2>POSTRES</h2>
                        <a href="sub_categoria.html">Ver todos</a>
                    </div>
                </div>
               
                
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
    <!-- Vincular Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>