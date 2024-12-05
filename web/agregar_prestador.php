<?php
// Verificar si se ha enviado el formulario de agregar prestador
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    // Conexión a la base de datos
    $conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "12345678", "", "mediccare");

    // Verificar si hay errores de conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Query para insertar el nuevo prestador
    $sql = "INSERT INTO prestador (nombre_prestador, direccion, telefono, email) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $direccion, $telefono, $email);
    $stmt->execute();

    // Cerrar la declaración
    $stmt->close();

    // Cerrar conexión
    $conexion->close();

    // Redireccionar a prestador.php después de agregar
    header("Location: prestador.php");
    exit();
} else {
    // Redireccionar a prestador.php si no se envía el formulario
    header("Location: prestador.php");
    exit();
}
?>
