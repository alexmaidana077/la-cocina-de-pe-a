<?php

session_start();

//conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contra = "";
$DbNombre = "Cocina";

$conn = new mysqli ($servidor, $usuario, $contra, $DbNombre);

//se verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn -> connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $gmail = $_POST['gmail'];
    $contraseña = $_POST['contraseña'];

    // Verificar que los campos no estén vacíos
    if (!empty($gmail) && !empty($contraseña)){
          // Preparar la consulta para verificar el usuario
          $sql = "SELECT contraseña FROM usuarios WHERE gmail = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s", $gmail);
          $stmt->execute();
          $stmt->store_result();

          if ($stmt->num_rows > 0) {
              // Vincular el resultado de la contraseña
              $stmt->bind_result($hashed_password);
              $stmt->fetch();
              
              // Verificación de contraseña
              if (password_verify($contraseña, $hashed_password)) {
                  // Iniciar sesión y almacenar el gmail en la variable de sesión
                  $_SESSION['usuario'] = $gmail;
  
                  // Redirección a la pagina principal
                  header("Location: bienvenida.php");
                  exit();
              } else {
                  echo "Contraseña incorrecta.";
              }
          } else {
              echo "No existe una cuenta con ese correo.";
          }
  
          // Cerrar la declaración
          $stmt->close();
      } else {
          echo "Por favor, completa todos los campos.";
      }
  }
  
  // Cerrar la conexión a la base de datos
$conn->close();
?>