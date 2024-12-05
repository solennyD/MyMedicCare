<?php
session_start();

// Verificar si el usuario está autenticado y es un administrador
if (!isset($_SESSION["administrador"])) {
    // Si no está autenticado como administrador, redirigir al usuario al inicio de sesión del administrador
    header("Location: login_administrador.php");
    exit(); // Detener la ejecución del script después de redirigir
}

// Conexión a la base de datos
$conexion = new mysqli("mediccare.cf8oqyo8g9xv.us-east-2.rds.amazonaws.com", "admin", "12345678", "mediccare");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
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
