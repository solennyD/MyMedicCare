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

// Verificar si se ha proporcionado una cédula o pasaporte para eliminar
if (isset($_GET['eliminar_cedula_pasaporte'])) {
    // Obtener la cédula o pasaporte del usuario a eliminar
    $eliminar_cedula_pasaporte = $_GET['eliminar_cedula_pasaporte'];

    // Query para eliminar el usuario por cédula o pasaporte
    $sql_eliminar = "DELETE FROM usuario WHERE cedula_pasaporte = ?";
    $stmt_eliminar = $conexion->prepare($sql_eliminar);
    $stmt_eliminar->bind_param("s", $eliminar_cedula_pasaporte);
    $stmt_eliminar->execute();

    // Verificar si se eliminó correctamente el usuario
    if ($stmt_eliminar->affected_rows > 0) {
        $mensaje = "El usuario se ha eliminado correctamente.";
    } else {
        $mensaje = "No se pudo eliminar el usuario.";
    }

    // Cerrar la declaración
    $stmt_eliminar->close();
}

// Query para obtener todos los usuarios
$sql = "SELECT nombre, apellido, cedula_pasaporte, correo, fecha_nacimiento, telefono FROM usuario";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Usuarios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos CSS */
        .container {
            margin-top: 50px;
        }
        .btn {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Usuarios</h1>
        
        <!-- Mostrar mensaje de eliminación si existe -->
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-<?php echo $mensaje_class; ?>" role="alert">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        
        <!-- Tabla para mostrar los usuarios -->
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cédula o Pasaporte</th>
                    <th>Correo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Teléfono</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $fila['nombre']; ?></td>
                        <td><?php echo $fila['apellido']; ?></td>
                        <td><?php echo $fila['cedula_pasaporte']; ?></td>
                        <td><?php echo $fila['correo']; ?></td>
                        <td><?php echo $fila['fecha_nacimiento']; ?></td>
                        <td><?php echo $fila['telefono']; ?></td>
                        <td>
                            <a href="?eliminar_cedula_pasaporte=<?php echo $fila['cedula_pasaporte']; ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?')" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="pagina_de_administrador.php" class="btn btn-primary"><i class="fas fa-home"></i> Volver al Inicio</a>
    </div>
</body>
</html>
<?php
// Cerrar conexión y liberar recursos
$resultado->close();
$conexion->close();
?>
