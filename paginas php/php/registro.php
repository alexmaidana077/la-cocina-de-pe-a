<?php
session_start();

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
    
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $usuario = $_POST['usuario'];

    if (!empty($email) && !empty($contraseña) && !empty($usuario)) {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Por favor, ingrese un email válido.";
            exit;
        }

        $sql_check_email = "SELECT email FROM usuario WHERE email = ?";
        $stmt_check = $conn->prepare($sql_check_email);

        if (!$stmt_check) {
            die("Error al preparar la consulta de verificación: " . $conn->error);
        }

        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();
        
        if ($stmt_check->num_rows > 0) {
            echo "Error: El correo ya está registrado.";
            exit;
        }
        $stmt_check->close();

        $contraseña_hashed = password_hash($contraseña, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuario (email, contraseña, usuario) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error al preparar la consulta de inserción: " . $conn->error);
        }

        $stmt->bind_param("sss", $email, $contraseña_hashed, $usuario);

        if ($stmt->execute()) {
            echo "Registro exitoso";
            echo "<script>window.location.href = '../login.html';</script>";
        } else {
            if ($conn->errno == 1062) {
                echo "Error: El correo ya está registrado.";
            } else {
                echo "Error en la ejecución: " . $conn->error;
            }
        }
        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos obligatorios.";
    }
}

$conn->close();
?>