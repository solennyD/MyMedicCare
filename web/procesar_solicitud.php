<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $cedula_pasaporte = $_POST["cedula_pasaporte"];
    $prestador = $_POST["prestador"];
    $monto_solicitado = $_POST["monto_solicitado"];
    $fecha_solicitud = $_POST["fecha_solicitud"];
    $estado = $_POST["estado"];
    $tipo = $_POST["tipo"];


    // inserción en la base de datos utilizando MySQLi
    $conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $sql = "INSERT INTO preautorizaciones (cedula_pasaporte, prestador, monto_solicitado, fecha_solicitud, estado, tipo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssdsss", $cedula_pasaporte, $prestador, $monto_solicitado, $fecha_solicitud, $estado, $tipo);

    if ($stmt->execute()) {
        // Mostrar un mensaje de éxito en color verde
        echo "<div style='color: green;'>Solicitud procesada correctamente. Serás redirigido a la página de visualización de solicitudes.</div>";

        // Redirigir a la página de visualización de solicitudes
        header("refresh:3;url=visualizar_solicitudes.php");
        exit();
    } else {
        // Mostrar un mensaje de error en color rojo
        echo "<div style='color: red;'>Error al procesar la solicitud: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conexion->close();
} else {
    // Si no se ha enviado el formulario, redirigir a la página de inicio o mostrar un mensaje de error.
    header("Location: index.php");
    exit();
}
?>
