<?php
// Verificar si se ha enviado un ID para eliminar
if(isset($_GET['id'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

    // Verificar si hay errores de conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Obtener el ID del centro a eliminar
    $id = $_GET['id'];

    // Query para eliminar el centro
    $sql = "DELETE FROM centroatenmedi WHERE CentroAtencionMed = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Verificar si se eliminó correctamente el centro
    if ($stmt->affected_rows > 0) {
        $mensaje = "El centro se ha eliminado correctamente.";
    } else {
        $mensaje = "No se pudo eliminar el centro.";
    }

    // Cerrar la declaración
    $stmt->close();
    
    // Cerrar conexión
    $conexion->close();

    // Redireccionar después de 3 segundos
    header("refresh:3;url=centroMedicos.php");
    exit();
} else {
    // Si no se proporcionó un ID, redireccionar a la página de ver_centros.php
    header("Location: centroMedico.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Centro de Atención Médica</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Mostrar mensaje de eliminación -->
        <?php if(isset($mensaje)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
