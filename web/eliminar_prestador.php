<?php
// Verificar si se ha proporcionado un ID de prestador para eliminar
if (isset($_GET['id'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "mediccare");

    // Verificar si hay errores de conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Obtener el ID del prestador a eliminar
    $id_prestador = $_GET['id'];

    // Query para eliminar el prestador
    $sql = "DELETE FROM prestador WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_prestador);
    $stmt->execute();

    // Cerrar la declaración
    $stmt->close();

    // Cerrar conexión
    $conexion->close();

    // Redireccionar a prestador.php después de eliminar
    header("Location: prestador.php");
    exit();
} else {
    // Redireccionar a prestador.php si no se proporciona un ID válido
    header("Location: prestador.php");
    exit();
}
?>
