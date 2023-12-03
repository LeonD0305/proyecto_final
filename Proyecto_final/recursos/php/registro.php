<?php
$conexion = new mysqli("localhost", "admin", "", "register");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telf = $_POST['telf'];

    // Insertar datos en la base de datos
    $query = "INSERT INTO usuarios (nombre, correo, telf) VALUES ('$nombre', '$correo', '$telf')";

    if ($conexion->query($query) === TRUE) {
        // Redirigir al usuario a la página de inicio
        header("Location: /final_project/paginas/inicio.html");
        exit();  // Importante para detener la ejecución del script después de la redirección
    } else {
        echo "Error al registrar el usuario: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
