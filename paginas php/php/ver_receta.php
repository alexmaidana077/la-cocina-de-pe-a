<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // Si no ha iniciado sesión, mostrar un alert y redirigir al inicio de sesión
    echo '<script>window.location.href = "../login.html";</script>';
    exit();
}

// Si el usuario ha iniciado sesión, redirigir a la página de la receta
echo "<script>window.location.href = '../../pages/receta.html';</script>";
exit();
?>
