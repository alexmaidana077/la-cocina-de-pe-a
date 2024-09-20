<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "Cocina";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $gmail = $_POST['gmail'];
    $contraseña = $_POST['contraseña'];
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL; // verifica si se ingreso algun valor o si no se ingresa NULL

    
    if (!empty($gmail) && !empty($contraseña)) {
        
        $contraseña_hashed = password_hash($contraseña, PASSWORD_DEFAULT); 

        
        $sql = "INSERT INTO usuarios (gmail, contraseña, usuario) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $gmail, $contraseña_hashed, $usuario);

        if ($stmt->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos obligatorios.";
    }
}

$conn->close();
?>
