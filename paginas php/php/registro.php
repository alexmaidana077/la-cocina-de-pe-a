<?php

session_start();

// Conexión a la base de datos
$servidor = "localhost";
$Usuario = "root";
$Contra = ""; 
$DbNombre = "Cocina";

$conn = new mysqli($servidor, $Usuario, $Contra, $DbNombre);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $gmail = $_POST['gmail'];
    $contraseña = $_POST['contraseña'];
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL; // verifica si se ingreso algun valor o si no se ingresa NULL

    //se verifica si se ingresaron valores en gmail y contraseña
    if (!empty($gmail) && !empty($contraseña)) {
        
        //En esta parte del codigo se hashea la contraseña, el PASSWORD_DEFAULT sirve para asegurarc que se utilice el metodo mas seguro que este disponible
        $contraseña_hashed = password_hash($contraseña, PASSWORD_DEFAULT); 

        //se insertan los datos en la tabla de usuarios
        $sql = "INSERT INTO usuarios (gmail, contraseña, usuario) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $gmail, $contraseña_hashed, $usuario);

        if ($stmt->execute()) {
            echo "Registro exitoso";
        } else{
        if ($conn -> errno = 1062){
            echo "Error: Correro ya utilizado";
        }else {
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
