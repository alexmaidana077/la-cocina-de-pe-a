<?php

session_start();

// Conexión a la base de datos
$servidor = "localhost";
$Usuario = "root";
$Contra = ""; 
$DbNombre = "cocina";

$conn = new mysqli($servidor, $Usuario, $Contra, $DbNombre);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $usuario =  $_POST['usuario']; 

    // Se verifica si se ingresaron valores en email y contraseña
    if (!empty($email) && !empty($contraseña) && !empty($usuario)){
        
        // En esta parte del código se hashea la contraseña
        $contraseña_hashed = password_hash($contraseña, PASSWORD_DEFAULT); 

        // Se insertan los datos en la tabla de usuarios
        $sql = "INSERT INTO usuario (email, contraseña, usuario) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $contraseña_hashed, $usuario);  // se verifican los datos ingresados el email,contraseña

        if ($stmt->execute()) {
            echo "Registro exitoso";
            echo "<script>window.location.href = '../login.html';</script>";
        } else {
            if ($conn->errno == 1062) {
                echo "Error: El correo ya existe";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos obligatorios.";
    }
}

$conn->close();
?>
