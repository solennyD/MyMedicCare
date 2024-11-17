<?php
session_start();

// Verificar si el usuario está autenticado y es un administrador
if (!isset($_SESSION["administrador"])) {
    // Si no está autenticado como administrador, redirigir al usuario al inicio de sesión del administrador
    header("Location: login_administrador.php");
    exit(); // Detener la ejecución del script después de redirigir
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "mediccare");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se ha proporcionado un ID de cita para eliminar
if (isset($_GET['eliminar_id'])) {
    // Obtener el ID de la cita a eliminar
    $eliminar_id = $_GET['eliminar_id'];

    // Query para eliminar la cita
    $sql_eliminar = "DELETE FROM cita WHERE id = ?";
    $stmt_eliminar = $conexion->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("i", $eliminar_id);
    $stmt_eliminar->execute();

    // Verificar si se eliminó correctamente la cita
    if ($stmt_eliminar->affected_rows > 0) {
        $mensaje = "La cita se ha eliminado correctamente.";
    } else {
        $mensaje = "No se pudo eliminar la cita.";
    }

    // Cerrar la declaración
    $stmt_eliminar->close();
}

// Query para obtener todas las citas
$sql = "SELECT * FROM cita";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Citas</title>
    <!-- Coloca aquí tus enlaces a estilos CSS -->
</head>
<body>
    <h1 style="text-align: center;">Lista de Citas</h1>
    
    <!-- Mostrar mensaje de eliminación si existe -->
    <?php if (isset($mensaje)): ?>
        <div style="text-align: center; padding: 10px; background-color: #f44336; color: white;">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
    
    <!-- Tabla para mostrar las citas -->
    <table border="1" cellspacing="0" cellpadding="5" style="margin: 0 auto;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Apellidos</th>
                <th>Cédula</th>
                <th>Correo</th>
                <th>Estatus</th>
                <th>Fecha de Registro</th>
                <th>Nombres</th>
                <th>Teléfono</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $fila['id']; ?></td>
                    <td><?php echo $fila['apellidos']; ?></td>
                    <td><?php echo $fila['cedula']; ?></td>
                    <td><?php echo $fila['correo']; ?></td>
                    <td><?php echo $fila['estatus']; ?></td>
                    <td><?php echo $fila['fecha_registro']; ?></td>
                    <td><?php echo $fila['nombres']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td>
                        <a href="?eliminar_id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta cita?')">Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
<?php
// Cerrar conexión y liberar recursos
$resultado->close();
$conexion->close();
?>
