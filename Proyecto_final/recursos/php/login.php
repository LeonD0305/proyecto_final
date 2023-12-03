<?php
session_start();

$conexion = new mysqli("localhost", "usuario_bd", "contrasena_bd", "nombre_bd");

if ($conexion->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE correo = '$correo'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        if (password_verify($contrasena, $fila["contrasena"])) {
            $_SESSION["usuario_id"] = $fila["id"];
            $_SESSION["usuario_nombre"] = $fila["nombre"];
            header("Location: paginas/inicio.html"); // Redirigir al inicio después de iniciar sesión
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}

$conexion->close();
?>
